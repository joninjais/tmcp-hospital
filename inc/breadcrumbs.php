<?php
/**
 * TMCP Hospital — Breadcrumbs
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function tmcp_breadcrumbs() {
    if ( ! get_theme_mod( 'tmcp_breadcrumbs_enable', true ) ) return;
    if ( is_front_page() ) return;

    $home_text = esc_html( get_theme_mod( 'tmcp_breadcrumbs_home_text', 'หน้าหลัก' ) );
    $sep       = '<span class="tmcp-bc-sep" aria-hidden="true">&#8250;</span>';
    $out       = '';

    $out .= '<nav class="tmcp-breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'tmcp-hospital' ) . '">';
    $out .= '<ol class="tmcp-bc-list">';
    $out .= '<li class="tmcp-bc-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . $home_text . '</a></li>';

    if ( is_category() ) {
        $cat = get_queried_object();
        if ( $cat->parent ) {
            $out .= '<li class="tmcp-bc-item">' . $sep . '<a href="' . esc_url( get_category_link( $cat->parent ) ) . '">' . esc_html( get_cat_name( $cat->parent ) ) . '</a></li>';
        }
        $out .= '<li class="tmcp-bc-item" aria-current="page">' . $sep . esc_html( single_cat_title( '', false ) ) . '</li>';

    } elseif ( is_tag() ) {
        $out .= '<li class="tmcp-bc-item" aria-current="page">' . $sep . esc_html( single_tag_title( '', false ) ) . '</li>';

    } elseif ( is_author() ) {
        $out .= '<li class="tmcp-bc-item" aria-current="page">' . $sep . esc_html( get_the_author() ) . '</li>';

    } elseif ( is_date() ) {
        if ( is_year() ) {
            $out .= '<li class="tmcp-bc-item" aria-current="page">' . $sep . get_the_date( 'Y' ) . '</li>';
        } elseif ( is_month() ) {
            $out .= '<li class="tmcp-bc-item"><a href="' . esc_url( get_year_link( get_the_date( 'Y' ) ) ) . '">' . get_the_date( 'Y' ) . '</a></li>';
            $out .= '<li class="tmcp-bc-item" aria-current="page">' . $sep . get_the_date( 'F Y' ) . '</li>';
        } else {
            $out .= '<li class="tmcp-bc-item"><a href="' . esc_url( get_year_link( get_the_date( 'Y' ) ) ) . '">' . get_the_date( 'Y' ) . '</a></li>';
            $out .= '<li class="tmcp-bc-item"><a href="' . esc_url( get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) ) ) . '">' . get_the_date( 'F Y' ) . '</a></li>';
            $out .= '<li class="tmcp-bc-item" aria-current="page">' . $sep . get_the_date() . '</li>';
        }

    } elseif ( is_single() ) {
        $cats = get_the_category();
        if ( $cats ) {
            $out .= '<li class="tmcp-bc-item">' . $sep . '<a href="' . esc_url( get_category_link( $cats[0]->term_id ) ) . '">' . esc_html( $cats[0]->name ) . '</a></li>';
        }
        $out .= '<li class="tmcp-bc-item" aria-current="page">' . $sep . esc_html( get_the_title() ) . '</li>';

    } elseif ( is_page() ) {
        $parents = array_reverse( get_post_ancestors( get_the_ID() ) );
        foreach ( $parents as $pid ) {
            $out .= '<li class="tmcp-bc-item">' . $sep . '<a href="' . esc_url( get_permalink( $pid ) ) . '">' . esc_html( get_the_title( $pid ) ) . '</a></li>';
        }
        $out .= '<li class="tmcp-bc-item" aria-current="page">' . $sep . esc_html( get_the_title() ) . '</li>';

    } elseif ( is_search() ) {
        /* translators: %s: search query */
        $out .= '<li class="tmcp-bc-item" aria-current="page">' . $sep . sprintf( esc_html__( 'ผลการค้นหา: "%s"', 'tmcp-hospital' ), esc_html( get_search_query() ) ) . '</li>';

    } elseif ( is_404() ) {
        $out .= '<li class="tmcp-bc-item" aria-current="page">' . $sep . esc_html__( 'ไม่พบหน้า (404)', 'tmcp-hospital' ) . '</li>';
    }

    $out .= '</ol></nav>';
    echo $out; // phpcs:ignore WordPress.Security.EscapeOutput
}
