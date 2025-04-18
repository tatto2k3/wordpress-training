<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! defined( 'WP_B__SLUG' ) ) {
    define( 'WP_B__SLUG', 'bblocksdk' );
}

if ( ! defined( 'WP_B__VERSION' ) ) {
    define( 'WP_B__VERSION', time() );
}

if ( ! defined( 'WP_B__DIR' ) ) {
    define( 'WP_B__DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'WP_B__CONFIG' ) ) {
    define( 'WP_B__CONFIG', [
        'prefix' => 'apb_pro',
        'blockHandler' => 'ap-block-posts-editor-script',
        'permalinks' => [ 'bpapb' ],
        'features' => [
            'license' => true,
            'optIn' => true
        ],
        "isBlock" => true
    ] );
}



  