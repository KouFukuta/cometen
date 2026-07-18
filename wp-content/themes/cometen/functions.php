<?php

function cometen_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'automatic-feed-links' );

    register_nav_menus( [
        'primary' => 'メインメニュー',
        'footer'  => 'フッターメニュー',
    ] );
}
add_action( 'after_setup_theme', 'cometen_setup' );

function cometen_enqueue_assets() {
    $theme_dir = get_template_directory();

    wp_enqueue_style(
        'cometen-style',
        get_template_directory_uri() . '/css/style.min.css',
        [],
        filemtime( $theme_dir . '/css/style.min.css' )
    );

    wp_enqueue_script(
        'cometen-slideshow',
        get_template_directory_uri() . '/js/slideshow.js',
        [],
        filemtime( $theme_dir . '/js/slideshow.js' ),
        true
    );

    wp_enqueue_script(
        'cometen-scripts',
        get_template_directory_uri() . '/js/scripts.js',
        [],
        filemtime( $theme_dir . '/js/scripts.js' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'cometen_enqueue_assets' );

function cometen_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'cometen_hero', [
        'title'    => 'ヒーロー画像',
        'priority' => 30,
    ] );

    $defaults = [
        'DSC04075.jpg',
        'DSC00770.jpg',
        'DSC02158.jpg',
        'DSC03972.jpg',
        '0825_3.jpg',
        'DSC02291.jpg',
    ];

    foreach ( $defaults as $i => $filename ) {
        $slot = $i + 1;
        $setting_id = "cometen_hero_image_{$slot}";

        $wp_customize->add_setting( $setting_id, [
            'default'           => get_template_directory_uri() . '/img/hero/' . $filename,
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ] );

        $wp_customize->add_control(
            new WP_Customize_Image_Control( $wp_customize, $setting_id, [
                'label'    => "ヒーロー画像 {$slot}",
                'section'  => 'cometen_hero',
                'settings' => $setting_id,
            ] )
        );
    }
}
add_action( 'customize_register', 'cometen_customize_register' );

function cometen_get_hero_images() {
    $images = [];
    for ( $i = 1; $i <= 6; $i++ ) {
        $url = get_theme_mod( "cometen_hero_image_{$i}" );
        if ( $url ) {
            $images[] = $url;
        }
    }
    return $images;
}

function cometen_news_posts_per_page( $query ) {
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( $query->is_home() || $query->is_archive() ) {
        $query->set( 'posts_per_page', 10 );
        $query->set( 'ignore_sticky_posts', true );
        $query->set( 'cometen_news_order', true );
    }
}
add_action( 'pre_get_posts', 'cometen_news_posts_per_page' );

function cometen_order_news_by_display_date( $orderby, $query ) {
    if ( ! $query->get( 'cometen_news_order' ) ) {
        return $orderby;
    }

    global $wpdb;

    $start_date = $wpdb->prepare(
        "(SELECT MAX(meta_value)
            FROM {$wpdb->postmeta}
            WHERE post_id = {$wpdb->posts}.ID
                AND meta_key = %s)",
        'start_date'
    );

    $end_date = $wpdb->prepare(
        "(SELECT MAX(meta_value)
            FROM {$wpdb->postmeta}
            WHERE post_id = {$wpdb->posts}.ID
                AND meta_key = %s)",
        'end_date'
    );

    $normalized_start_date = "REPLACE(REPLACE(REPLACE(REPLACE(REPLACE({$start_date}, '-', ''), '/', ''), '年', ''), '月', ''), '日', '')";
    $normalized_end_date = "REPLACE(REPLACE(REPLACE(REPLACE(REPLACE({$end_date}, '-', ''), '/', ''), '年', ''), '月', ''), '日', '')";
    $period_start_date = "CASE
        WHEN NULLIF({$start_date}, '') IS NOT NULL
            AND NULLIF({$end_date}, '') IS NOT NULL
            AND {$normalized_start_date} <> {$normalized_end_date}
        THEN {$start_date}
        ELSE NULL
    END";
    $display_date = "COALESCE({$period_start_date}, DATE({$wpdb->posts}.post_date))";
    $sortable_date = "REPLACE(REPLACE(REPLACE(REPLACE(REPLACE({$display_date}, '-', ''), '/', ''), '年', ''), '月', ''), '日', '')";
    $posted_at = "{$wpdb->posts}.post_date";

    return "{$sortable_date} DESC, {$posted_at} DESC, {$wpdb->posts}.ID DESC";
}
add_filter( 'posts_orderby', 'cometen_order_news_by_display_date', 10, 2 );

function cometen_empty_news_date_default( $field ) {
    $field['default_value'] = '';

    return $field;
}
add_filter( 'acf/load_field/name=start_date', 'cometen_empty_news_date_default' );
add_filter( 'acf/load_field/name=end_date', 'cometen_empty_news_date_default' );

function cometen_has_news_period( $start_date, $end_date ) {
    if ( ! $start_date || ! $end_date ) {
        return false;
    }

    $normalized_start_date = preg_replace( '/[^0-9]/', '', $start_date );
    $normalized_end_date   = preg_replace( '/[^0-9]/', '', $end_date );

    return $normalized_start_date !== $normalized_end_date;
}
