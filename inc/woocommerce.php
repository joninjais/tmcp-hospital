<?php
/**
 * TMCP Hospital — WooCommerce Support
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ── Remove default WooCommerce content wrappers ──────── */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper',     10 );
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar',             'woocommerce_get_sidebar',                10 );

/* ── Add our own wrappers ────────────────────────────── */
add_action( 'woocommerce_before_main_content', 'tmcp_woo_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content',  'tmcp_woo_wrapper_end',   10 );
add_action( 'woocommerce_sidebar',             'tmcp_woo_sidebar',       10 );

function tmcp_woo_wrapper_start() {
    $sidebar_pos = get_theme_mod( 'tmcp_page_sidebar', 'none' );
    echo '<div class="' . esc_attr( tmcp_layout_class( $sidebar_pos ) ) . '">';
    echo '<div class="tmcp-content-area">';
}

function tmcp_woo_wrapper_end() {
    echo '</div>'; // .tmcp-content-area
    $sidebar_pos = get_theme_mod( 'tmcp_page_sidebar', 'none' );
    if ( $sidebar_pos !== 'none' && is_active_sidebar( 'sidebar-main' ) ) {
        get_sidebar();
    }
    echo '</div>'; // .tmcp-site-content
}

function tmcp_woo_sidebar() {
    // Handled inside tmcp_woo_wrapper_end
}
