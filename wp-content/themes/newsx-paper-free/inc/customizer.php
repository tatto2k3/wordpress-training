<?php

/**
 * Newsx Paper free Theme Customizer
 *
 * @package Newsx Paper free Plus
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function newsx_paper_free_customize_register($wp_customize)
{

    $wp_customize->add_setting('newsx_paper_free_posts_read', array(
        'default'        => esc_html__('Latest News', 'newsx-paper-free'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsx_paper_free_posts_read', array(
        'label'      => __('Posts Read More Text', 'newsx-paper-free'),
        'section'    => 'newsx_paper_blog',
        'settings'   => 'newsx_paper_free_posts_read',
        'type'       => 'text',
    ));
}
add_action('customize_register', 'newsx_paper_free_customize_register', 99);
