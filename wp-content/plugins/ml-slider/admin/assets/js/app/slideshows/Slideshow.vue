<script>
import { Axios, Slideshow, Settings } from '../api'
import { AnalyticsNotice } from '../notices'
import { EventManager } from '../utils'
import QS from 'qs'
import Swal from 'sweetalert2'
import { mapGetters, mapState } from 'vuex'
import { MainTour } from '../tour'

export default {
	props: {
		id: {
			type: [Number],
			default: null
		},
		settings: {
			type: [Object, Boolean],
			default: false
		},
		tourStatus: {
			type: [String, Boolean],
			default: false
		},
		showOptIn: {
			type: [String, Boolean],
			default: false
		},
	},
	data() {
		return {
			allowedElements: ['metaslider-ui', 'updraft-ad-container', 'metaslider-admin-notice'],
			titleChanged: '',
			isSettingsPage: true
		}
	},
	computed: {
		...mapGetters({
			current: 'slideshows/getCurrent'
		}),
		...mapState({
			locked: state => state.slideshows.locked
		}),
	},
	created() {
		const urlParams = new URLSearchParams(window.location.search);
		const page = urlParams.get('page');

		this.isSettingsPage = page !== null && page === 'metaslider-settings';

		window.metaslider_slider_id = this.id // used in admin.js
		this.$store.commit('slideshows/setCurrent', this.id)
		this.$store.dispatch('slideshows/getSingleSlideshow', this.id)

		// @since 3.97 - Is this the Settings page?
		if (this.isSettingsPage) {
			this.$store.dispatch('slideshows/getRecentSlideshows')
		}
	},
	mounted() {
		// Show only the allowed elements on our page (keeps rogue notices from showing)
		document.querySelectorAll('#wpbody-content > *').forEach(element => {
			let identifiers = element.className.split(' ').concat(element.id)
			if (identifiers && this.allowedElements.filter(elm => identifiers.indexOf(elm) > -1).length) {
				element.style.display = 'block'
			}
		})

		EventManager.$on('metaslider/save', () => {
			this.save()
		})

		EventManager.$on('metaslider/preview', data => {

			let slideshowId = data && data.hasOwnProperty('slideshowId') ? data.slideshowId : this.current.id
			let themeId = data && data.hasOwnProperty('themeId') ? data.themeId : this.current.theme.folder

			this.save().then(() => {
				this.preview(slideshowId, themeId)
			})
		})

		EventManager.$on(['metaslider/creating-slides', 'metaslider/updating-slide'], () => {
			this.$store.commit('slideshows/setLocked', true)
		})
		EventManager.$on([
			'metaslider/slides-created', 'metaslider/slide-create-failed',
			'metaslider/slide-updated', 'metaslider/slide-update-failed', 
			'metaslider/slide-duplicated', 'metaslider/slide-duplicate-failed'
		], () => {
			this.$store.commit('slideshows/setLocked', false)
		})

		EventManager.$on('metaslider/duplicate', () => {
			this.save().then(() => {
				this.notifyInfo('metaslider/duplicate-pre', this.__('Duplicating...', 'ml-slider'), true)
				this.duplicate()
			})
		})

		// Listen for a successful save and enable buttons
		EventManager.$on(['metaslider/save-success', 'metaslider/save-error'], () => {
			this.$store.commit('slideshows/setLocked', false)
		})

		// Listen to start the tour (only if there's an id and it hasnt been seen)
		EventManager.$on('metaslider/start-tour', () => {
			!this.tourStatus && this.id && this.startTour()
		})

		// Listen when trying to edit a slide in trashed slides screen
		EventManager.$on('metaslider/cant-edit-trashed-slide', () => {
			this.notifyError('metaslider/slide-edit-failed', this.__('To edit this slide, click "Restore" and then "Return to Published Slides"', 'ml-slider'), true)
		})

		if (!this.showOptIn) {
			EventManager.$emit('metaslider/start-tour')
		}

		if (this.showOptIn) {
			EventManager.$emit('metaslider/open-utility-modal', AnalyticsNotice)
		}

		window.addEventListener('load', () => {
			setTimeout(() => {
				this.notifyInfo('metaslider/app-loaded', this.__('MetaSlider dashboard loaded', 'ml-slider'))
			}, 1500)
		})

		this.titleChanged = this.current.title
	},
	methods: {
		async save() {
			if(this.current.title == '') {
				this.notifyError('metaslider/title-saved', this.__('Please add a slideshow title'), true)
			} else {
				if (this.locked) return
				this.$store.commit('slideshows/setLocked', true)
				this.notifyInfo('metaslider/saving', this.__('Saving...', 'ml-slider'))

				// TODO: this is temporary until there is a slide component
				this.orderSlides()

				let data = window.jQuery('#ms-form-settings').serializeArray()
				await this.saveSettings(data).then(() => {

					// Todo: refactor out slides logic
					let slides = this.prepareSlideData(data)
					slides.length > 20 && this.notifyInfo(
						'metaslider/saving-more-notice',
						this.sprintf(this.__('Saving %s slides. This may take a few moments.', 'ml-slider'), slides.length),
						true
					)
					this.showSlideSaveNotification = false
					setTimeout(() => { this.showSlideSaveNotification = true }, 4000)
					return this.saveSlides(slides).then(() => {

						// TODO: refactor out with psuedocode below
						this.cropSlidesTheOldWay()
						this.notifySuccess('metaslider/save-success', this.__('Slideshow saved', 'ml-slider'), true)
					}).catch(error => {

						// If the input vars are too low, reload the page with the error message
						if (error.response.data.data && error.response.data.data.current_input_vars || error.response.data.includes('max_input_vars')) {
							window.location.replace(this.metasliderPage + '&id=' + this.current.id + '&input_vars_error=true')
						}

						throw error
					})
				}).catch(error => {
					this.notifyError('metaslider/save-error', error.response, true)
				})
			}

			// TODO: refactor like this in a future branch
			// let touchedSlides = getTouchedSlides()

			// Only update slides that need it
			// touchedSlides.forEach(element => {
			// Save
			// Crop
			// })

			// Look into only cropping if not already cropping, or better yet, to kill the initial cropping process
		},
		preview(slideshowId, themeId) {
			EventManager.$emit('metaslider/open-preview', {
				slideshowId: slideshowId,
				themeId: themeId
			})
		},
		async duplicate(slideshowId, themeId) {
			Slideshow.duplicate().then(response => {
				this.notifySuccess('metaslider/duplicate-success', this.__('Duplicated successfully. Reloading...', 'ml-slider'), true)
				setTimeout(() => {
					localStorage.removeItem('metaslider-vuex-' + this.siteId)
					window.location.replace(this.metasliderPage + '&id=' + response.data.data)
				}, 1500)
			}).catch(error => {
				this.notifyError('metaslider/duplicate-error', error, true)
			})
		},
		startTour() {
			EventManager.tourEnabled = true

			// Slight timeout to avoid any funky layouts like poopy.life
			setTimeout(() => {
				MainTour.start()
			}, 750)

			// Set an event to handle cancelling the tour
			MainTour.on('cancel', () => { this.cancelTour() })
		},
		saveSettings(data) {
			let settings = data.filter(input => 'title' === input.name || input.name.startsWith('settings'))
			return Settings.save(settings).then(() => {
				this.notifySuccess('metaslider/save-setting-success', this.__('Settings saved', 'ml-slider'))
			})
		},
		prepareSlideData(data) {
			let slides = new Set(
				data.filter(input => input.name.startsWith('attachment'))
					.map(slide => slide.name.match(/attachment\[([\s\S]*?)\]/)[1])
			)

			let allSlides = [...slides].map(slide => {
				return data.filter(input => input.name.startsWith('attachment[' + slide + ']'))
			})
			return allSlides
		},
		saveSlides(slides) {
			return new Promise((resolve, reject) => {

				// Pro users have a sigificant amoutn of extra input variables because of scheduling
				let chunks = this.proUser ? 20 : 50
				Slideshow.save(slides, chunks).then(response => {
					if (Array.isArray(response) && response.length) {

						// Only notify the user every 4 seconds
						if (this.showSlideSaveNotification && response.length >= 10) {
							this.notifyInfo(
								'metaslider/saving-more',
								this.sprintf(
									this.__('Still working... %s slides remaining...', 'ml-slider'),
									Math.floor(response.length / 10) * 10
								),
								true
							)
							this.showSlideSaveNotification = false
							setTimeout(() => { this.showSlideSaveNotification = true }, 4000)
						}

						// if there are slides that need to be processed call the function again with the remaining data
						resolve(this.saveSlides(response))
					} else { resolve(response) }
				}).catch(error => { reject(error) })
			})
		},
		orderSlides() {
			document.querySelectorAll('#metaslider-slides-list .slide input.menu_order').forEach((element, index) => {
				element.value = index
			})
		},
		cropSlidesTheOldWay() {
			window.jQuery.when(window.jQuery('.metaslider table#metaslider-slides-list').trigger('resizeSlides')).done(function() {
				let $ = window.jQuery
				$('button[data-thumb]').each(function() {
					let $this = $(this)
					$('button[data-editor_id=' + $this.attr('data-editor_id') + ']')
						.attr('data-thumb', $this.attr('data-thumb'))
						.attr('data-width', $this.attr('data-width'))
						.attr('data-height', $this.attr('data-height'))
				})
				$('select.cropMultiply').each(function() {
					let $this = $(this);
					$this.attr('data-value', $this.val());
				});
			})
		},
		cancelTour() {
			EventManager.tourEnabled = false
			MainTour.setPosition()
				.then(() => {
					this.notifySuccess('metaslider/tour-cancelled', this.__('Tour cancelled successfully', 'ml-slider'), false)
				})
				.catch(() => {
					this.notifySuccess('metaslider/tour-cancelled-failed', this.__('Tour cancelled unsuccessfully', 'ml-slider'), false)
				})
		},
		// NOTE: this doesn't permanently delete, just move to trash
		deleteSlideshow(event) {
			Swal.queue([{
				icon: 'warning',
				iconHtml: '<div class="dashicons dashicons-warning" style="transform: scale(3.5);"></div>',
				title: this.__('Are you sure?', 'ml-slider'),
				text: this.__('This slideshow will be moved to the "Trash" area.', 'ml-slider'),
				confirmButtonText: this.__('Confirm', 'ml-slider'),
				showCancelButton: true,
				confirmButtonColor: '#e82323',
				focusCancel: true,
				showLoaderOnConfirm: true,
				allowOutsideClick: () => !Swal.isLoading(),
				preConfirm: () => {
					const nonce = event.target.getAttribute('data-nonce');

					if (!nonce) {
						Swal.insertQueueStep({
							icon: 'error',
							title: this.__('Invalid nonce token', 'ml-slider'),
							confirmButtonText: this.__('OK', 'ml-slider'),
							text: this.__('Unable to proceed due to invalid nonce token.', 'ml-slider')
						})
					}

					// TODO: Refactor to use api object
					return Axios.post('slideshow/delete', QS.stringify({
						action: 'ms_delete_slideshow',
						slideshow_id: this.current.id,
						nonce: nonce
					})).then(response => {
						console.log('MetaSlider:', response.data.data)
					}).catch(error => {
						let errorMessage = this.getErrorMessage(error.response)
						this.notifyError('metaslider/delete-error', error)
						Swal.insertQueueStep({
							icon: 'error',
							title: this.__('Something went wrong', 'ml-slider'),
							confirmButtonText: this.__('OK', 'ml-slider'),
							text: errorMessage
						})
					})
				}
			}]).then(result => {
				localStorage.removeItem('metaslider-vuex-' + this.siteId)
				if (!result.dismiss) {
					// use replace because the resource is deleted
					window.location.replace(
						this.current.id 
							? this.metasliderPage + '&action=delete-notify&slideshows=' + this.current.id
							: this.metasliderPage
					);
				}

			})
		},
	}
}
</script>

<style lang="scss">
	@import '../assets/styles/main.scss';
</style>
