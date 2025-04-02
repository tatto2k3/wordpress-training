<?php
/*
Plugin Name: My Custom Shortcodes
Description: Các Shortcodes tùy chỉnh của tôi
Version: 1.0
Author: Tat To
*/

function custom_blog_posts_popular_shortcode()
{
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 4,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $query = new WP_Query($args);
    $output = '';

    $output .= '<div class="post-title-popular">Phổ biến</div>';
    if ($query->have_posts()) :
        $output .= '<ul style="padding-left: 0;margin: 0;">';
        while ($query->have_posts()) : $query->the_post();
            $output .= '<li class="post-item">';

            if (has_post_thumbnail()) {
                $output .= '<div class="post-thumbnail">';
                $output .= get_the_post_thumbnail(get_the_ID(), 'thumbnail');
                $output .= '</div>';
            }

            $output .= '<div class="post-content">';
            $output .= '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
            $excerpt = wp_trim_words(get_the_content(), 10, '...');
            $output .= '<p>' . $excerpt . '</p>';
            $output .= '</div>';

            $output .= '</li>';
        endwhile;
        $output .= '</ul>';
    else :
        $output .= '<p>Không có bài viết nào.</p>';
    endif;

    wp_reset_postdata();

    return $output;
}

add_shortcode('blog_posts', 'custom_blog_posts_popular_shortcode');

function custom_blog_posts_styles()
{
    if (is_page() || is_single()) {
        wp_enqueue_style('custom-blog-posts-style', plugin_dir_url(__FILE__) . 'css/blog-posts.css');
    }
}
add_action('wp_enqueue_scripts', 'custom_blog_posts_styles');


function custom_blog_and_categories_shortcode($atts)
{
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 4,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'paged'          => $paged,
    );

    $query = new WP_Query($args);
    $output = '';

    $output .= '<div class="blog-and-categories-layout" style="display: flex; gap: 30px; flex-wrap: wrap;">';

    $output .= '<div class="blog-posts" style="flex: 1; min-width: 60%;">';

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $output .= '<div class="post-item" style="margin-bottom: 20px;">';
            if (has_post_thumbnail()) {
                $output .= '<div class="post-thumbnail" style="margin-bottom: 10px; width: 500px;">';
                $output .= get_the_post_thumbnail(get_the_ID(), 'thumbnail');
                $output .= '</div>';
            }
            $output .= '<div class="blog-title-and-text">';
            $categories = get_the_category();
            if (! empty($categories)) {
                $output .= '<p style="margin: 0; font-size: 14px; color: #777;">Danh mục: ';
                $category_list = array();
                foreach ($categories as $category) {
                    $category_list[] = '<a href="' . esc_url(get_category_link($category->term_id)) . '" style="text-decoration: none; color: #007bff;">' . esc_html($category->name) . '</a>';
                }
                $output .= implode(', ', $category_list) . '</p>';
            }
            $output .= '<h2 style="font-size: 16px; margin: 0;"><a href="' . get_permalink() . '" style="text-decoration: none; color: #333;">' . get_the_title() . '</a></h2>';
            $output .= '<p style="font-size: 14px; color: #555;">' . get_the_excerpt() . '</p>';
            $output .= '</div>';

            $output .= '</div>';
        endwhile;
    else :
        $output .= '<p>Không có bài viết nào.</p>';
    endif;

    wp_reset_postdata();

    $big = 999999999;
    $output .= '<div class="pagination" style="margin-top: 20px;">';
    $output .= paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $query->max_num_pages,
        'prev_text' => '&laquo; Trước',
        'next_text' => 'Sau &raquo;',
    ));
    $output .= '</div>';

    $output .= '</div>';
    $output .= '<div class="post-categories" style="flex: 1; min-width: 30%;">';

    $categories = get_categories();
    if ($categories) {
        $output .= '<ul class="category-list">';
        $output .= '<li class="category-item">';
        $output .= '<a href="' . esc_url(get_bloginfo('url')) . '" class="category-link ' . (!is_category() ? 'active' : '') . '">Tất cả</a>';
        $output .= '</li>';

        foreach ($categories as $category) {
            $is_active = (is_category($category->term_id)) ? 'active' : '';
            $output .= '<li class="category-item">';
            $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="category-link ' . $is_active . '">' . $category->name . '</a>';
            $output .= '</li>';
        }

        $output .= '</ul>';
    } else {
        $output .= '<p>Không có danh mục nào.</p>';
    }

    $output .= '</div>';
    $output .= '</div>';

    return $output;
}

add_shortcode('blog_and_categories', 'custom_blog_and_categories_shortcode');
