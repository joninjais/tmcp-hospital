<?php
/**
 * TMCP Hospital Theme — Functions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ── Include feature files ───────────────────────────── */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/breadcrumbs.php';
require get_template_directory() . '/inc/template-functions.php';
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce.php';
}

/* ── Theme setup ─────────────────────────────────────── */
function tmcp_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ] );
    add_theme_support( 'html5', [
        'search-form', 'comment-form', 'comment-list',
        'gallery', 'caption', 'style', 'script',
    ] );
    add_theme_support( 'customize-selective-refresh-widgets' );

    // WooCommerce
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Custom image sizes
    add_image_size( 'tmcp-thumb',  760, 430, true );
    add_image_size( 'tmcp-square', 400, 400, true );

    register_nav_menus( [
        'navbar_main'  => __( 'Main Navigation', 'tmcp-hospital' ),
        'footer_links' => __( 'Footer Links', 'tmcp-hospital' ),
        'social_links' => __( 'Social Links', 'tmcp-hospital' ),
    ] );

    load_theme_textdomain( 'tmcp-hospital', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'tmcp_setup' );

/* ── Content width ───────────────────────────────────── */
function tmcp_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'tmcp_content_width', 1140 );
}
add_action( 'after_setup_theme', 'tmcp_content_width', 0 );

/* ── Register widget areas ───────────────────────────── */
function tmcp_register_sidebars() {
    $defaults = [
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ];

    register_sidebar( array_merge( $defaults, [
        'name'        => __( 'Main Sidebar', 'tmcp-hospital' ),
        'id'          => 'sidebar-main',
        'description' => __( 'Appears on blog posts and pages with sidebar layout', 'tmcp-hospital' ),
    ] ) );

    for ( $i = 1; $i <= 4; $i++ ) {
        register_sidebar( array_merge( $defaults, [
            /* translators: %d: footer column number */
            'name'        => sprintf( __( 'Footer Column %d', 'tmcp-hospital' ), $i ),
            'id'          => 'footer-' . $i,
            'description' => sprintf( __( 'Footer widget area column %d', 'tmcp-hospital' ), $i ),
        ] ) );
    }
}
add_action( 'widgets_init', 'tmcp_register_sidebars' );

/* ── Enqueue assets ──────────────────────────────────── */
function tmcp_enqueue() {
    $ver = wp_get_theme()->get( 'Version' );
    wp_enqueue_style( 'tmcp-fonts', get_template_directory_uri() . '/fonts.css', [], $ver );
    wp_enqueue_style( 'tmcp-style', get_stylesheet_uri(), [ 'tmcp-fonts' ], $ver );
}
add_action( 'wp_enqueue_scripts', 'tmcp_enqueue' );

/* ── Auto-assign nav menu on activation ─────────────── */
function tmcp_on_activate() {
    $menus   = wp_get_nav_menus();
    $menu_id = 0;
    foreach ( $menus as $m ) {
        if ( $m->term_id == 4 || $m->slug === 'navbar-main' || $m->name === 'navbar_main' ) {
            $menu_id = (int) $m->term_id;
            break;
        }
    }
    if ( $menu_id ) {
        set_theme_mod( 'nav_menu_locations', [ 'navbar_main' => $menu_id ] );
    }
}
add_action( 'after_switch_theme', 'tmcp_on_activate' );
