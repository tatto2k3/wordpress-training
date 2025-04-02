<?php
/*This file is part of Magic Elementor child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/
$newsx_paper_free_theme = wp_get_theme();
if (!defined('NEWSX_PAPER_FREE_VERSION')) {
	// Replace the version number of the theme on each release.
	define('NEWSX_PAPER_FREE_VERSION', $newsx_paper_free_theme->get('Version'));
}

function newsx_paper_free_fonts_url()
{
	$fonts_url = '';

	$font_families = array();

	$font_families[] = 'Poppins:400,600';
	$font_families[] = 'Roboto:400,600,700';

	$query_args = array(
		'family' => urlencode(implode('|', $font_families)),
		'subset' => urlencode('latin,latin-ext'),
	);

	$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');

	return esc_url_raw($fonts_url);
}


function newsx_paper_free_enqueue_child_styles()
{
	wp_enqueue_style('newsx-paper-free-google-font', newsx_paper_free_fonts_url(), array(), null);
	wp_enqueue_style('newsx-paper-free-parent-style', get_template_directory_uri() . '/style.css', array('newsx-paper-style'), NEWSX_PAPER_FREE_VERSION, 'all');
	wp_enqueue_style('newsx-paper-free-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array('bootstrap', 'newsx-paper-style', 'newsx-paper-main-style', 'newsx-paper-default-style'), NEWSX_PAPER_FREE_VERSION, 'all');
}
add_action('wp_enqueue_scripts', 'newsx_paper_free_enqueue_child_styles');





add_filter('excerpt_more', 'newsx_paper_free_exerpt_empty_string', 999);
function newsx_paper_free_exerpt_empty_string($more)
{
	if (is_admin()) {
		return $more;
	}
	return '';
}
/**
 * Customizer additions.
 */
require get_stylesheet_directory() . '/inc/customizer.php';


function newsx_paper_free_excerpt_length($length)
{
	if (is_admin()) {
		return $length;
	} else {
		return 25;
	}
}
add_filter('excerpt_length', 'newsx_paper_free_excerpt_length', 9999);

function newsx_paper_free_readmore_text()
{
	$newsx_paper_free_posts_read = get_theme_mod('newsx_paper_free_posts_read', esc_html__('Read More', 'newsx-paper-free'));
?>
	<a class="newsx-paper-readmore" href="<?php the_permalink(); ?>"><?php echo esc_html($newsx_paper_free_posts_read); ?> <i class="fas fa-long-arrow-alt-right"></i></a>
<?php
}
