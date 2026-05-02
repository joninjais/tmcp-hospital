<?php
/**
 * TMCP Hospital Theme — Functions
 */
if (!defined('ABSPATH')) exit;

/* ── Theme setup ─────────────────────────────────────── */
function tmcp_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('html5', [
        'search-form', 'comment-form', 'comment-list',
        'gallery', 'caption', 'style', 'script',
    ]);

    register_nav_menus([
        'navbar_main'  => __('Main Navigation', 'tmcp-hospital'),
        'footer_links' => __('Footer Links', 'tmcp-hospital'),
    ]);

    load_theme_textdomain('tmcp-hospital', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'tmcp_setup');

/* ── Content width ───────────────────────────────────── */
function tmcp_content_width() {
    $GLOBALS['content_width'] = apply_filters('tmcp_content_width', 1140);
}
add_action('after_setup_theme', 'tmcp_content_width', 0);

/* ── Enqueue assets ──────────────────────────────────── */
function tmcp_enqueue() {
    $ver = wp_get_theme()->get('Version');
    wp_enqueue_style('tmcp-fonts',  get_template_directory_uri() . '/fonts.css', [], $ver);
    wp_enqueue_style('tmcp-style',  get_stylesheet_uri(), ['tmcp-fonts'], $ver);
}
add_action('wp_enqueue_scripts', 'tmcp_enqueue');

/* ── Auto-assign nav menu on activation ─────────────── */
function tmcp_on_activate() {
    // Find existing navbar_main menu (ID 4) and assign to theme location
    $menus = wp_get_nav_menus();
    $menu_id = 0;
    foreach ($menus as $m) {
        if ($m->term_id == 4 || $m->slug === 'navbar-main' || $m->name === 'navbar_main') {
            $menu_id = (int) $m->term_id;
            break;
        }
    }
    if ($menu_id) {
        set_theme_mod('nav_menu_locations', ['navbar_main' => $menu_id]);
    }
}
add_action('after_switch_theme', 'tmcp_on_activate');
