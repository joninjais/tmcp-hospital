<?php
/**
 * TMCP Hospital — Customizer Settings (OceanWP-like)
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ================================================================
   REGISTER SETTINGS
   ================================================================ */
function tmcp_customizer_register( WP_Customize_Manager $wp_customize ) {

    /* ── PANEL: General ──────────────────────────────────── */
    $wp_customize->add_panel( 'tmcp_general', [
        'title'    => __( 'General Settings', 'tmcp-hospital' ),
        'priority' => 30,
    ] );

    // Section: Site Layout
    $wp_customize->add_section( 'tmcp_site_layout', [
        'title' => __( 'Site Layout', 'tmcp-hospital' ),
        'panel' => 'tmcp_general',
    ] );
    $wp_customize->add_setting( 'tmcp_site_layout', [
        'default'           => 'wide',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'tmcp_site_layout', [
        'label'   => __( 'Site Layout', 'tmcp-hospital' ),
        'section' => 'tmcp_site_layout',
        'type'    => 'select',
        'choices' => [
            'wide'  => __( 'Wide (Full Width)', 'tmcp-hospital' ),
            'boxed' => __( 'Boxed', 'tmcp-hospital' ),
        ],
    ] );
    $wp_customize->add_setting( 'tmcp_content_max_width', [
        'default'           => '1140',
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( 'tmcp_content_max_width', [
        'label'       => __( 'Content Max Width (px)', 'tmcp-hospital' ),
        'section'     => 'tmcp_site_layout',
        'type'        => 'number',
        'input_attrs' => [ 'min' => 800, 'max' => 1920, 'step' => 10 ],
    ] );

    /* ── PANEL: Header ───────────────────────────────────── */
    $wp_customize->add_panel( 'tmcp_header', [
        'title'    => __( 'Header', 'tmcp-hospital' ),
        'priority' => 35,
    ] );

    // Section: Header Style
    $wp_customize->add_section( 'tmcp_header_style', [
        'title' => __( 'Header Style', 'tmcp-hospital' ),
        'panel' => 'tmcp_header',
    ] );
    $wp_customize->add_setting( 'tmcp_header_style', [
        'default'           => 'inline',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'tmcp_header_style', [
        'label'   => __( 'Header Style', 'tmcp-hospital' ),
        'section' => 'tmcp_header_style',
        'type'    => 'select',
        'choices' => [
            'inline'   => __( 'Inline (Logo + Nav side by side)', 'tmcp-hospital' ),
            'centered' => __( 'Centered Logo + Nav', 'tmcp-hospital' ),
            'stacked'  => __( 'Stacked (Logo above Nav)', 'tmcp-hospital' ),
        ],
    ] );
    $wp_customize->add_setting( 'tmcp_sticky_header', [
        'default'           => true,
        'sanitize_callback' => 'tmcp_sanitize_checkbox',
    ] );
    $wp_customize->add_control( 'tmcp_sticky_header', [
        'label'   => __( 'Sticky Header', 'tmcp-hospital' ),
        'section' => 'tmcp_header_style',
        'type'    => 'checkbox',
    ] );
    $wp_customize->add_setting( 'tmcp_header_search', [
        'default'           => true,
        'sanitize_callback' => 'tmcp_sanitize_checkbox',
    ] );
    $wp_customize->add_control( 'tmcp_header_search', [
        'label'   => __( 'Show Search Icon', 'tmcp-hospital' ),
        'section' => 'tmcp_header_style',
        'type'    => 'checkbox',
    ] );

    // Section: Logo
    $wp_customize->add_section( 'tmcp_logo_settings', [
        'title' => __( 'Logo Size', 'tmcp-hospital' ),
        'panel' => 'tmcp_header',
    ] );
    $wp_customize->add_setting( 'tmcp_logo_width', [
        'default'           => '120',
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( 'tmcp_logo_width', [
        'label'       => __( 'Logo Width (px) — 0 = auto', 'tmcp-hospital' ),
        'section'     => 'tmcp_logo_settings',
        'type'        => 'number',
        'input_attrs' => [ 'min' => 0, 'max' => 600, 'step' => 1 ],
    ] );
    $wp_customize->add_setting( 'tmcp_logo_height', [
        'default'           => '50',
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( 'tmcp_logo_height', [
        'label'       => __( 'Logo Height (px) — 0 = auto', 'tmcp-hospital' ),
        'section'     => 'tmcp_logo_settings',
        'type'        => 'number',
        'input_attrs' => [ 'min' => 0, 'max' => 300, 'step' => 1 ],
    ] );
    $wp_customize->add_setting( 'tmcp_logo_max_width', [
        'default'           => '0',
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( 'tmcp_logo_max_width', [
        'label'       => __( 'Logo Max Width (px) — 0 = ไม่จำกัด', 'tmcp-hospital' ),
        'section'     => 'tmcp_logo_settings',
        'type'        => 'number',
        'input_attrs' => [ 'min' => 0, 'max' => 800, 'step' => 1 ],
    ] );

    // Section: Top Bar
    $wp_customize->add_section( 'tmcp_topbar', [
        'title' => __( 'Top Bar', 'tmcp-hospital' ),
        'panel' => 'tmcp_header',
    ] );
    $wp_customize->add_setting( 'tmcp_topbar_enable', [
        'default'           => true,
        'sanitize_callback' => 'tmcp_sanitize_checkbox',
    ] );
    $wp_customize->add_control( 'tmcp_topbar_enable', [
        'label'   => __( 'Enable Top Bar', 'tmcp-hospital' ),
        'section' => 'tmcp_topbar',
        'type'    => 'checkbox',
    ] );
    $wp_customize->add_setting( 'tmcp_topbar_phone', [
        'default'           => '076-571505',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'tmcp_topbar_phone', [
        'label'   => __( 'Phone Number', 'tmcp-hospital' ),
        'section' => 'tmcp_topbar',
        'type'    => 'text',
    ] );
    $wp_customize->add_setting( 'tmcp_topbar_email', [
        'default'           => 'tm11354@moph.go.th',
        'sanitize_callback' => 'sanitize_email',
    ] );
    $wp_customize->add_control( 'tmcp_topbar_email', [
        'label'   => __( 'Email Address', 'tmcp-hospital' ),
        'section' => 'tmcp_topbar',
        'type'    => 'email',
    ] );
    $wp_customize->add_setting( 'tmcp_topbar_address', [
        'default'           => '166 ม.9 ถนนเพชรเกษม ต.ท้ายเหมือง จ.พังงา 82120',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'tmcp_topbar_address', [
        'label'   => __( 'Address', 'tmcp-hospital' ),
        'section' => 'tmcp_topbar',
        'type'    => 'text',
    ] );
    $wp_customize->add_setting( 'tmcp_topbar_text_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tmcp_topbar_text_color', [
        'label'   => __( 'Top Bar Text / Icon Color', 'tmcp-hospital' ),
        'section' => 'tmcp_topbar',
    ] ) );

    /* ── PANEL: Typography ───────────────────────────────── */
    $wp_customize->add_panel( 'tmcp_typography', [
        'title'    => __( 'Typography', 'tmcp-hospital' ),
        'priority' => 40,
    ] );
    $wp_customize->add_section( 'tmcp_font_sizes', [
        'title' => __( 'Font Sizes', 'tmcp-hospital' ),
        'panel' => 'tmcp_typography',
    ] );
    $font_size_controls = [
        'tmcp_body_font_size'        => [ 'label' => __( 'Body Font Size (px)', 'tmcp-hospital' ),        'default' => '15', 'min' => 10, 'max' => 24 ],
        'tmcp_heading_font_size_h1'  => [ 'label' => __( 'H1 Font Size (px)', 'tmcp-hospital' ),         'default' => '36', 'min' => 20, 'max' => 80 ],
        'tmcp_heading_font_size_h2'  => [ 'label' => __( 'H2 Font Size (px)', 'tmcp-hospital' ),         'default' => '28', 'min' => 16, 'max' => 60 ],
        'tmcp_heading_font_size_h3'  => [ 'label' => __( 'H3 Font Size (px)', 'tmcp-hospital' ),         'default' => '22', 'min' => 14, 'max' => 50 ],
        'tmcp_menu_font_size'        => [ 'label' => __( 'Menu Font Size (px)', 'tmcp-hospital' ),        'default' => '14', 'min' => 10, 'max' => 20 ],
    ];
    foreach ( $font_size_controls as $id => $args ) {
        $wp_customize->add_setting( $id, [
            'default'           => $args['default'],
            'sanitize_callback' => 'absint',
        ] );
        $wp_customize->add_control( $id, [
            'label'       => $args['label'],
            'section'     => 'tmcp_font_sizes',
            'type'        => 'number',
            'input_attrs' => [ 'min' => $args['min'], 'max' => $args['max'], 'step' => 1 ],
        ] );
    }

    /* ── SECTION: Colors ─────────────────────────────────── */
    $wp_customize->add_section( 'tmcp_colors', [
        'title'    => __( 'Colors', 'tmcp-hospital' ),
        'priority' => 45,
    ] );
    $color_settings = [
        'tmcp_primary_color' => [ 'default' => '#1E0842', 'label' => __( 'Primary Color', 'tmcp-hospital' ) ],
        'tmcp_accent_color'  => [ 'default' => '#7C3AED', 'label' => __( 'Accent / Link Color', 'tmcp-hospital' ) ],
        'tmcp_link_hover'    => [ 'default' => '#3B1478', 'label' => __( 'Link Hover Color', 'tmcp-hospital' ) ],
        'tmcp_topbar_color'  => [ 'default' => '#07041A', 'label' => __( 'Top Bar Background', 'tmcp-hospital' ) ],
        'tmcp_footer_bg'     => [ 'default' => '#07041A', 'label' => __( 'Footer Background', 'tmcp-hospital' ) ],
    ];
    foreach ( $color_settings as $id => $args ) {
        $wp_customize->add_setting( $id, [
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ] );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, [
            'label'   => $args['label'],
            'section' => 'tmcp_colors',
        ] ) );
    }

    /* ── PANEL: Blog ─────────────────────────────────────── */
    $wp_customize->add_panel( 'tmcp_blog', [
        'title'    => __( 'Blog', 'tmcp-hospital' ),
        'priority' => 50,
    ] );

    // Section: Blog Archive Layout
    $wp_customize->add_section( 'tmcp_blog_layout', [
        'title' => __( 'Blog / Archive Layout', 'tmcp-hospital' ),
        'panel' => 'tmcp_blog',
    ] );
    $wp_customize->add_setting( 'tmcp_blog_layout', [
        'default'           => 'list',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'tmcp_blog_layout', [
        'label'   => __( 'Blog Layout', 'tmcp-hospital' ),
        'section' => 'tmcp_blog_layout',
        'type'    => 'select',
        'choices' => [
            'list' => __( 'List', 'tmcp-hospital' ),
            'grid' => __( 'Grid (2 columns)', 'tmcp-hospital' ),
        ],
    ] );
    $wp_customize->add_setting( 'tmcp_blog_sidebar', [
        'default'           => 'right',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'tmcp_blog_sidebar', [
        'label'   => __( 'Blog Sidebar Position', 'tmcp-hospital' ),
        'section' => 'tmcp_blog_layout',
        'type'    => 'select',
        'choices' => [
            'right' => __( 'Right Sidebar', 'tmcp-hospital' ),
            'left'  => __( 'Left Sidebar', 'tmcp-hospital' ),
            'none'  => __( 'No Sidebar (Full Width)', 'tmcp-hospital' ),
        ],
    ] );
    $wp_customize->add_setting( 'tmcp_show_featured_image', [
        'default'           => true,
        'sanitize_callback' => 'tmcp_sanitize_checkbox',
    ] );
    $wp_customize->add_control( 'tmcp_show_featured_image', [
        'label'   => __( 'Show Featured Image in Loop', 'tmcp-hospital' ),
        'section' => 'tmcp_blog_layout',
        'type'    => 'checkbox',
    ] );
    $wp_customize->add_setting( 'tmcp_excerpt_length', [
        'default'           => '30',
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( 'tmcp_excerpt_length', [
        'label'       => __( 'Excerpt Length (words)', 'tmcp-hospital' ),
        'section'     => 'tmcp_blog_layout',
        'type'        => 'number',
        'input_attrs' => [ 'min' => 5, 'max' => 100 ],
    ] );
    $wp_customize->add_setting( 'tmcp_readmore_text', [
        'default'           => 'อ่านต่อ',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'tmcp_readmore_text', [
        'label'   => __( 'Read More Button Text', 'tmcp-hospital' ),
        'section' => 'tmcp_blog_layout',
        'type'    => 'text',
    ] );

    // Section: Single Post
    $wp_customize->add_section( 'tmcp_single_post', [
        'title' => __( 'Single Post', 'tmcp-hospital' ),
        'panel' => 'tmcp_blog',
    ] );
    $wp_customize->add_setting( 'tmcp_single_sidebar', [
        'default'           => 'right',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'tmcp_single_sidebar', [
        'label'   => __( 'Single Post Sidebar', 'tmcp-hospital' ),
        'section' => 'tmcp_single_post',
        'type'    => 'select',
        'choices' => [
            'right' => __( 'Right Sidebar', 'tmcp-hospital' ),
            'left'  => __( 'Left Sidebar', 'tmcp-hospital' ),
            'none'  => __( 'No Sidebar', 'tmcp-hospital' ),
        ],
    ] );
    $wp_customize->add_setting( 'tmcp_single_featured_image', [
        'default'           => true,
        'sanitize_callback' => 'tmcp_sanitize_checkbox',
    ] );
    $wp_customize->add_control( 'tmcp_single_featured_image', [
        'label'   => __( 'Show Featured Image', 'tmcp-hospital' ),
        'section' => 'tmcp_single_post',
        'type'    => 'checkbox',
    ] );
    $wp_customize->add_setting( 'tmcp_single_author_box', [
        'default'           => true,
        'sanitize_callback' => 'tmcp_sanitize_checkbox',
    ] );
    $wp_customize->add_control( 'tmcp_single_author_box', [
        'label'   => __( 'Show Author Box', 'tmcp-hospital' ),
        'section' => 'tmcp_single_post',
        'type'    => 'checkbox',
    ] );
    $wp_customize->add_setting( 'tmcp_single_related', [
        'default'           => true,
        'sanitize_callback' => 'tmcp_sanitize_checkbox',
    ] );
    $wp_customize->add_control( 'tmcp_single_related', [
        'label'   => __( 'Show Related Posts', 'tmcp-hospital' ),
        'section' => 'tmcp_single_post',
        'type'    => 'checkbox',
    ] );

    /* ── SECTION: Sidebar ────────────────────────────────── */
    $wp_customize->add_section( 'tmcp_sidebar_settings', [
        'title'    => __( 'Sidebar', 'tmcp-hospital' ),
        'priority' => 52,
    ] );
    $wp_customize->add_setting( 'tmcp_page_sidebar', [
        'default'           => 'none',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'tmcp_page_sidebar', [
        'label'   => __( 'Default Page Sidebar', 'tmcp-hospital' ),
        'section' => 'tmcp_sidebar_settings',
        'type'    => 'select',
        'choices' => [
            'right' => __( 'Right Sidebar', 'tmcp-hospital' ),
            'left'  => __( 'Left Sidebar', 'tmcp-hospital' ),
            'none'  => __( 'No Sidebar (Full Width)', 'tmcp-hospital' ),
        ],
    ] );

    /* ── PANEL: Footer ───────────────────────────────────── */
    $wp_customize->add_panel( 'tmcp_footer', [
        'title'    => __( 'Footer', 'tmcp-hospital' ),
        'priority' => 55,
    ] );

    // Section: Footer Widgets
    $wp_customize->add_section( 'tmcp_footer_widgets', [
        'title' => __( 'Footer Widgets', 'tmcp-hospital' ),
        'panel' => 'tmcp_footer',
    ] );
    $wp_customize->add_setting( 'tmcp_footer_columns', [
        'default'           => '4',
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( 'tmcp_footer_columns', [
        'label'   => __( 'Footer Widget Columns', 'tmcp-hospital' ),
        'section' => 'tmcp_footer_widgets',
        'type'    => 'select',
        'choices' => [ '1' => '1', '2' => '2', '3' => '3', '4' => '4' ],
    ] );
    $wp_customize->add_setting( 'tmcp_footer_widgets_bg', [
        'default'           => '#07041A',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tmcp_footer_widgets_bg', [
        'label'   => __( 'Widget Area Background Color', 'tmcp-hospital' ),
        'section' => 'tmcp_footer_widgets',
    ] ) );
    $wp_customize->add_setting( 'tmcp_footer_widgets_text_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tmcp_footer_widgets_text_color', [
        'label'   => __( 'Widget Area Text Color', 'tmcp-hospital' ),
        'section' => 'tmcp_footer_widgets',
    ] ) );

    // Section: Footer Bottom
    $wp_customize->add_section( 'tmcp_footer_bottom', [
        'title' => __( 'Footer Bottom Bar', 'tmcp-hospital' ),
        'panel' => 'tmcp_footer',
    ] );
    $wp_customize->add_setting( 'tmcp_footer_bottom_bg', [
        'default'           => '#07041A',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tmcp_footer_bottom_bg', [
        'label'   => __( 'Bottom Bar Background Color', 'tmcp-hospital' ),
        'section' => 'tmcp_footer_bottom',
    ] ) );
    $wp_customize->add_setting( 'tmcp_footer_bottom_text_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tmcp_footer_bottom_text_color', [
        'label'   => __( 'Bottom Bar Text Color', 'tmcp-hospital' ),
        'section' => 'tmcp_footer_bottom',
    ] ) );
    $wp_customize->add_setting( 'tmcp_footer_copyright', [
        'default'           => 'Copyright &copy; {year} โรงพยาบาลท้ายเหมืองชัยพัฒน์ — All Rights Reserved',
        'sanitize_callback' => 'wp_kses_post',
    ] );
    $wp_customize->add_control( 'tmcp_footer_copyright', [
        'label'   => __( 'Copyright Text (use {year} for current year)', 'tmcp-hospital' ),
        'section' => 'tmcp_footer_bottom',
        'type'    => 'textarea',
    ] );

    /* ── SECTION: Back To Top ────────────────────────────── */
    $wp_customize->add_section( 'tmcp_back_to_top', [
        'title'    => __( 'Back To Top', 'tmcp-hospital' ),
        'priority' => 57,
    ] );
    $wp_customize->add_setting( 'tmcp_back_to_top', [
        'default'           => true,
        'sanitize_callback' => 'tmcp_sanitize_checkbox',
    ] );
    $wp_customize->add_control( 'tmcp_back_to_top', [
        'label'   => __( 'Enable Back to Top Button', 'tmcp-hospital' ),
        'section' => 'tmcp_back_to_top',
        'type'    => 'checkbox',
    ] );
    $wp_customize->add_setting( 'tmcp_back_to_top_position', [
        'default'           => 'right',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'tmcp_back_to_top_position', [
        'label'   => __( 'Position', 'tmcp-hospital' ),
        'section' => 'tmcp_back_to_top',
        'type'    => 'select',
        'choices' => [
            'right' => __( 'Right', 'tmcp-hospital' ),
            'left'  => __( 'Left', 'tmcp-hospital' ),
        ],
    ] );

    /* ── SECTION: Breadcrumbs ────────────────────────────── */
    $wp_customize->add_section( 'tmcp_breadcrumbs', [
        'title'    => __( 'Breadcrumbs', 'tmcp-hospital' ),
        'priority' => 58,
    ] );
    $wp_customize->add_setting( 'tmcp_breadcrumbs_enable', [
        'default'           => true,
        'sanitize_callback' => 'tmcp_sanitize_checkbox',
    ] );
    $wp_customize->add_control( 'tmcp_breadcrumbs_enable', [
        'label'   => __( 'Enable Breadcrumbs', 'tmcp-hospital' ),
        'section' => 'tmcp_breadcrumbs',
        'type'    => 'checkbox',
    ] );
    $wp_customize->add_setting( 'tmcp_breadcrumbs_home_text', [
        'default'           => 'หน้าหลัก',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'tmcp_breadcrumbs_home_text', [
        'label'   => __( 'Home Text', 'tmcp-hospital' ),
        'section' => 'tmcp_breadcrumbs',
        'type'    => 'text',
    ] );
}
add_action( 'customize_register', 'tmcp_customizer_register' );

/* ================================================================
   SANITIZE HELPERS
   ================================================================ */
function tmcp_sanitize_checkbox( $val ) {
    return (bool) $val;
}

/* ================================================================
   LIVE CSS OUTPUT FROM CUSTOMIZER
   ================================================================ */
function tmcp_customizer_live_css() {
    $primary          = get_theme_mod( 'tmcp_primary_color',            '#1E0842' );
    $accent           = get_theme_mod( 'tmcp_accent_color',             '#7C3AED' );
    $topbar           = get_theme_mod( 'tmcp_topbar_color',             '#07041A' );
    $topbar_text      = get_theme_mod( 'tmcp_topbar_text_color',        '#ffffff' );
    $linkhov          = get_theme_mod( 'tmcp_link_hover',               '#3B1478' );
    $footer_bg        = get_theme_mod( 'tmcp_footer_bg',                '#07041A' );
    $fw_bg            = get_theme_mod( 'tmcp_footer_widgets_bg',        '' );
    $fw_text          = get_theme_mod( 'tmcp_footer_widgets_text_color','#ffffff' );
    $fb_bg            = get_theme_mod( 'tmcp_footer_bottom_bg',         '' );
    $fb_text          = get_theme_mod( 'tmcp_footer_bottom_text_color', '#ffffff' );
    $body_fs          = absint( get_theme_mod( 'tmcp_body_font_size',         15 ) );
    $h1_fs            = absint( get_theme_mod( 'tmcp_heading_font_size_h1',   36 ) );
    $h2_fs            = absint( get_theme_mod( 'tmcp_heading_font_size_h2',   28 ) );
    $h3_fs            = absint( get_theme_mod( 'tmcp_heading_font_size_h3',   22 ) );
    $menu_fs          = absint( get_theme_mod( 'tmcp_menu_font_size',         14 ) );
    $max_w            = absint( get_theme_mod( 'tmcp_content_max_width',    1140 ) );
    $layout           = get_theme_mod( 'tmcp_site_layout', 'wide' );
    $btt_pos          = get_theme_mod( 'tmcp_back_to_top_position', 'right' );
    $logo_w           = absint( get_theme_mod( 'tmcp_logo_width',  120 ) );
    $logo_h           = absint( get_theme_mod( 'tmcp_logo_height',  50 ) );
    $logo_max_w       = absint( get_theme_mod( 'tmcp_logo_max_width', 0 ) );

    // Resolve footer widget bg — fall back to legacy tmcp_footer_bg
    $fw_bg_resolved = $fw_bg ?: $footer_bg;
    $fb_bg_resolved = $fb_bg ?: $footer_bg;

    echo "<style id='tmcp-customizer-css'>\n";
    echo ":root{\n";
    echo "  --tmcp-primary:{$primary};\n";
    echo "  --tmcp-accent:{$accent};\n";
    echo "  --tmcp-topbar:{$topbar};\n";
    echo "  --tmcp-topbar-text:{$topbar_text};\n";
    echo "  --tmcp-link-hover:{$linkhov};\n";
    echo "  --tmcp-footer-bg:{$footer_bg};\n";
    echo "  --tmcp-footer-widgets-bg:{$fw_bg_resolved};\n";
    echo "  --tmcp-footer-widgets-text:{$fw_text};\n";
    echo "  --tmcp-footer-bottom-bg:{$fb_bg_resolved};\n";
    echo "  --tmcp-footer-bottom-text:{$fb_text};\n";
    echo "  --tmcp-content-max-width:{$max_w}px;\n";
    echo "}\n";
    echo "body{font-size:{$body_fs}px;}\n";
    echo "h1{font-size:{$h1_fs}px;}\n";
    echo "h2{font-size:{$h2_fs}px;}\n";
    echo "h3{font-size:{$h3_fs}px;}\n";
    echo ".tmcp-navbar-menu ul li a{font-size:{$menu_fs}px;}\n";
    echo ".tmcp-container,.tmcp-navbar-inner,.tmcp-topbar-inner,.tmcp-footer-widgets-inner{max-width:{$max_w}px;}\n";
    echo ".tmcp-site-content{max-width:{$max_w}px;}\n";
    echo "a:not([class]){color:{$accent};}\n";
    echo "a:not([class]):hover{color:{$linkhov};}\n";

    // Logo size
    $logo_w_css     = $logo_w     ? "{$logo_w}px"     : 'auto';
    $logo_h_css     = $logo_h     ? "{$logo_h}px"     : 'auto';
    $logo_maxw_css  = $logo_max_w ? "{$logo_max_w}px" : 'none';
    echo ".tmcp-navbar-logo img,.tmcp-navbar-logo .custom-logo{width:{$logo_w_css};height:{$logo_h_css};max-width:{$logo_maxw_css};object-fit:contain;}\n";

    if ( $layout === 'boxed' ) {
        echo "body{background:#f0f0f0;}\n";
        echo ".tmcp-site-wrapper{max-width:{$max_w}px;margin:0 auto;background:#fff;box-shadow:0 0 40px rgba(0,0,0,.1);}\n";
    }
    $btt_opp = ( $btt_pos === 'left' ) ? 'right:auto;left:20px;' : 'right:20px;left:auto;';
    echo ".tmcp-back-to-top{{$btt_opp}}\n";
    echo "</style>\n";
}
add_action( 'wp_head', 'tmcp_customizer_live_css' );
