<?php

/**
 * About setup
 *
 * @package NewsX Paper
 */

require_once trailingslashit(get_template_directory()) . 'inc/about/class.about.php';

if (!function_exists('newsx_paper_about_setup')) :

	/**
	 * About setup.
	 *
	 * @since 1.0.0
	 */
	function newsx_paper_about_setup()
	{
		$theme = wp_get_theme();
		$xtheme_name = $theme->get('Name');
		$xtheme_domain = $theme->get('TextDomain');
		if ($xtheme_domain == 'x-magazine') {
			$theme_slug = $xtheme_domain;
		} else {
			$theme_slug = 'newsx-paper';
		}



		$config = array(
			// Menu name under Appearance.
			'menu_name'               => sprintf(esc_html__('%s Info', 'newsx-paper'), $xtheme_name),
			// Page title.
			'page_name'               => sprintf(esc_html__('%s Info', 'newsx-paper'), $xtheme_name),
			/* translators: Main welcome title */
			'welcome_title'         => sprintf(esc_html__('Welcome to %s! - Version ', 'newsx-paper'), $theme['Name']),
			// Main welcome content
			// Welcome content.
			'welcome_content' => sprintf(esc_html__('%1$s is now installed and ready to use. We want to make sure you have the best experience using the theme and that is why we gathered here all the necessary information for you. Thanks for using our theme!', 'newsx-paper'), $theme['Name']),

			// Tabs.
			'tabs' => array(
				'getting_started' => esc_html__('Getting Started', 'newsx-paper'),
				'recommended_actions' => esc_html__('Recommended Actions', 'newsx-paper'),
				'useful_plugins'  => esc_html__('Useful Plugins', 'newsx-paper'),
				'free_pro'  => esc_html__('Free Vs Pro', 'newsx-paper'),
			),

			// Quick links.
			'quick_links' => array(
				'xmagazine_url' => array(
					'text'   => esc_html__('UPGRADE NewsX Paper PRO', 'newsx-paper'),
					'url'    => 'https://wpthemespace.com/product/newsx-paper-pro/?add-to-cart=6534',
					'button' => 'danger',
				),

				'update_url' => array(
					'text'   => esc_html__('NewsX Paper PRO Video', 'newsx-paper'),
					'url'    => 'https://www.youtube.com/watch?v=dEFBLfCbBbg',
					'button' => 'danger',
				),

			),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__('Demo Content', 'newsx-paper'),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf(esc_html__('Demo content is pro feature. To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'newsx-paper'), esc_html__('One Click Demo Import', 'newsx-paper')),
					'button_text' => esc_html__('UPGRADE For  Demo Content', 'newsx-paper'),
					'button_url'  => 'https://wpthemespace.com/product/newsx-paper-pro/?add-to-cart=6534',
					'button_type' => 'primary',
					'is_new_tab'  => true,
				),

				'two' => array(
					'title'       => esc_html__('Theme Options', 'newsx-paper'),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__('Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'newsx-paper'),
					'button_text' => esc_html__('Customize', 'newsx-paper'),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
				),
				'three' => array(
					'title'       => esc_html__('Show Video', 'newsx-paper'),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf(esc_html__('You may show NewsX Paper short video for better understanding', 'newsx-paper'), esc_html__('One Click Demo Import', 'newsx-paper')),
					'button_text' => esc_html__('Show video', 'newsx-paper'),
					'button_url'  => 'https://www.youtube.com/watch?v=dEFBLfCbBbg',
					'button_type' => 'primary',
					'is_new_tab'  => true,
				),
				'five' => array(
					'title'       => esc_html__('Set Widgets', 'newsx-paper'),
					'icon'        => 'dashicons dashicons-tagcloud',
					'description' => esc_html__('Set widgets in your sidebar, Offcanvas as well as footer.', 'newsx-paper'),
					'button_text' => esc_html__('Add Widgets', 'newsx-paper'),
					'button_url'  => admin_url() . '/widgets.php',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
				'six' => array(
					'title'       => esc_html__('Theme Preview', 'newsx-paper'),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__('You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized. Theme demo only work in pro theme', 'newsx-paper'),
					'button_text' => esc_html__('View Demo', 'newsx-paper'),
					'button_url'  => 'https://px.wpteamx.com/demos',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
				'seven' => array(
					'title'       => esc_html__('Contact Support', 'newsx-paper'),
					'icon'        => 'dashicons dashicons-sos',
					'description' => esc_html__('Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'newsx-paper'),
					'button_text' => esc_html__('Contact Support', 'newsx-paper'),
					'button_url'  => 'https://wpthemespace.com/support/',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
			),

			'useful_plugins'        => array(
				'description' => esc_html__('Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'newsx-paper'),
				'already_activated_message' => esc_html__('Already activated', 'newsx-paper'),
				'version_label' => esc_html__('Version: ', 'newsx-paper'),
				'install_label' => esc_html__('Install and Activate', 'newsx-paper'),
				'activate_label' => esc_html__('Activate', 'newsx-paper'),
				'deactivate_label' => esc_html__('Deactivate', 'newsx-paper'),
				'content'                   => array(
					array(
						'slug' => 'magical-addons-for-elementor',
						'icon' => 'svg',
					),
					array(
						'slug' => 'magical-products-display'
					),
					array(
						'slug' => 'magical-posts-display'
					),
					array(
						'slug' => 'click-to-top'
					),
					array(
						'slug' => 'gallery-box',
						'icon' => 'svg',
					),
					array(
						'slug' => 'magical-blocks'
					),
					array(
						'slug' => 'easy-share-solution',
						'icon' => 'svg',
					),
					array(
						'slug' => 'wp-edit-password-protected',
						'icon' => 'svg',
					),
				),
			),
			// Required actions array.
			'recommended_actions'        => array(
				'install_label' => esc_html__('Install and Activate', 'newsx-paper'),
				'activate_label' => esc_html__('Activate', 'newsx-paper'),
				'deactivate_label' => esc_html__('Deactivate', 'newsx-paper'),
				'content'            => array(
					'magical-blocks' => array(
						'title'       => __('Magical Posts Display', 'newsx-paper'),
						'description' => __('Now you can add or update your site elements very easily by Magical Products Display. Supercharge your Elementor block with highly customizable Magical Blocks For WooCommerce.', 'newsx-paper'),
						'plugin_slug' => 'magical-products-display',
						'id' => 'magical-posts-display'
					),
					'go-pro' => array(
						'title'       => '<a target="_blank" class="activate-now button button-danger" href="https://wpthemespace.com/product/newsx-paper-pro/?add-to-cart=6534">' . __('UPGRADE NewsX Paper PRO', 'newsx-paper') . '</a>',
						'description' => __('You will get more frequent updates and quicker support with the Pro version.', 'newsx-paper'),
						//'plugin_slug' => 'x-instafeed',
						'id' => 'go-pro'
					),

				),
			),
			// Free vs pro array.
			'free_pro'                => array(
				'free_theme_name'     => $xtheme_name,
				'pro_theme_name'      => $xtheme_name . __(' Pro', 'newsx-paper'),
				'pro_theme_link'      => 'https://wpthemespace.com/product/newsx-paper-pro/',
				/* translators: View link */
				'get_pro_theme_label' => sprintf(__('Get %s', 'newsx-paper'), 'NewsX Paper Pro'),
				'features'            => array(
					array(
						'title'       => esc_html__('Daring Design for Devoted Readers', 'newsx-paper'),
						'description' => esc_html__('NewsX Paper\'s design helps you stand out from the crowd and create an experience that your readers will love and talk about. With a flexible home page you have the chance to easily showcase appealing content with ease.', 'newsx-paper'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Mobile-Ready For All Devices', 'newsx-paper'),
						'description' => esc_html__('NewsX Paper makes room for your readers to enjoy your articles on the go, no matter the device their using. We shaped everything to look amazing to your audience.', 'newsx-paper'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Home slider', 'newsx-paper'),
						'description' => esc_html__('NewsX Paper gives you extra slider feature. You can create awesome home slider in this theme.', 'newsx-paper'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Widgetized Sidebars To Keep Attention', 'newsx-paper'),
						'description' => esc_html__('NewsX Paper comes with a widget-based flexible system which allows you to add your favorite widgets over the Sidebar as well as on offcanvas too.', 'newsx-paper'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Auto Set-up Feature', 'newsx-paper'),
						'description' => esc_html__('You can import demo site only one click so you can setup your site like demo very easily.', 'newsx-paper'),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Multiple Header Layout', 'newsx-paper'),
						'description' => esc_html__('NewsX Paper gives you extra ways to showcase your header with miltiple layout option you can change it on the basis of your requirement', 'newsx-paper'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('One Click Demo install', 'newsx-paper'),
						'description' => esc_html__('You can import demo site only one click so you can setup your site like demo very easily.', 'newsx-paper'),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Extra Drag and drop support', 'newsx-paper'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Advanced News Filter', 'newsx-paper'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('News/posts Carousel', 'newsx-paper'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Diffrent Style Blog', 'newsx-paper'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Flexible Home Page Design', 'newsx-paper'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Pro Service Section', 'newsx-paper'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Animation Home Text', 'newsx-paper'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Advance Customizer Options', 'newsx-paper'),
						'description' => esc_html__('Advance control for each element gives you different way of customization and maintained you site as you like and makes you feel different.', 'newsx-paper'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Advance Pagination', 'newsx-paper'),
						'description' => esc_html__('Multiple Option of pagination via customizer can be obtained on your site like Infinite scroll, Ajax Button On Click, Number as well as classical option are available.', 'newsx-paper'),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),

					array(
						'title'       => esc_html__('Premium Support and Assistance', 'newsx-paper'),
						'description' => esc_html__('We offer ongoing customer support to help you get things done in due time. This way, you save energy and time, and focus on what brings you happiness. We know our products inside-out and we can lend a hand to help you save resources of all kinds.', 'newsx-paper'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('No Credit Footer Link', 'newsx-paper'),
						'description' => esc_html__('You can easily remove the Theme: NewsX Paper by NewsX Paper copyright from the footer area and make the theme yours from start to finish.', 'newsx-paper'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
				),
			),

		);

		newsx_paper_About::init($config);
	}

endif;

add_action('after_setup_theme', 'newsx_paper_about_setup');

function newsx_paper_pnotice_output()
{

?>
	<div class="mgadin-hero">
		<div class="mge-info-content">
			<div class="mge-info-hello">
				<?php
				$current_theme = wp_get_theme();
				$current_theme_name = $current_theme->get('Name');
				$current_user = wp_get_current_user();


				$demo_link = esc_url('https://wpthemespace.com/product/newsx-paper-pro/');
				$pro_link = esc_url('https://wpthemespace.com/product/newsx-paper-pro/?add-to-cart=6534');

				esc_html_e('Hello, ', 'newsx-paper');
				echo esc_html($current_user->display_name);
				?>

				<?php esc_html_e('👋🏻', 'newsx-paper'); ?>
			</div>
			<div class="mge-info-desc">
				<div><?php printf(esc_html__('Hi Buddy!! Now You are using the Free version of %1$s theme.', 'newsx-paper'), $current_theme_name); ?></div>
				<div><?php echo esc_html('Stop limiting your website\'s potential! Upgrade to the NewsX Paper Pro theme and unlock  Advanced customization, stunning demos, popup video news, dynamic sliders, engaging news cards & tabs, unlimited options with our Auto-Setup feature. Don\'t wait – go Pro now and create a website that truly shines!', 'newsx-paper'); ?></div>
				<div style="color:rgb(151, 0, 0);font-weight:700"><?php echo esc_html('🎉 A Gift Just for You! Enjoy 20% Off – Use Code ( bl2420 ) in checkout page 🎊', 'newsx-paper'); ?></div>
			</div>
			<div class="mge-info-actions">
				<a href="<?php echo esc_url($pro_link); ?>" target="_blank" class="button button-primary upgrade-btn">
					<?php esc_html_e('Upgrade Pro', 'newsx-paper'); ?>
				</a>
				<a href="<?php echo esc_url($demo_link); ?>" target="_blank" class="button button-primary demo-btn">
					<?php esc_html_e('View details', 'newsx-paper'); ?>
				</a>
				<button class="button button-info btnend"><?php esc_html_e('Dismiss this notice', 'newsx-paper') ?></button>
			</div>

		</div>

	</div>
<?php
}


//Admin notice 
function newsx_paper_new_optins_texts()
{
	$hide_date = get_option('newsx_paper_text_info1');
	if (!empty($hide_date)) {
		$clickhide = round((time() - strtotime($hide_date)) / 24 / 60 / 60);
		if ($clickhide < 25) {
			return;
		}
	}

?>
	<div class="mgadin-notice notice notice-success mgadin-theme-dashboard mgadin-theme-dashboard-notice mge is-dismissible meis-dismissible">
		<?php newsx_paper_pnotice_output(); ?>
	</div>
<?php

}
add_action('admin_notices', 'newsx_paper_new_optins_texts');

function newsx_paper_new_optins_texts_init()
{
	if (isset($_GET['xbnotice']) && $_GET['xbnotice'] == 1) {
		update_option('newsx_paper_text_info1', current_time('mysql'));
	}
}
add_action('init', 'newsx_paper_new_optins_texts_init');
