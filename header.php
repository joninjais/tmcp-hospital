<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="tmcp-site-wrapper">

<?php if ( get_theme_mod( 'tmcp_topbar_enable', true ) ) :
    $phone   = sanitize_text_field( get_theme_mod( 'tmcp_topbar_phone',   '076-571505' ) );
    $email   = sanitize_email( get_theme_mod( 'tmcp_topbar_email',   'tm11354@moph.go.th' ) );
    $address = sanitize_text_field( get_theme_mod( 'tmcp_topbar_address', '166 ม.9 ถนนเพชรเกษม ต.ท้ายเหมือง จ.พังงา 82120' ) );
?>
<!-- Topbar -->
<div class="tmcp-topbar">
    <div class="tmcp-topbar-inner">
        <div class="tmcp-topbar-contacts">
            <a href="tel:1669"><span aria-hidden="true">🚑</span> 1669</a>
            <?php if ( $phone ) : ?>
            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><span aria-hidden="true">📞</span> <?php echo esc_html( $phone ); ?></a>
            <?php endif; ?>
            <?php if ( $email ) : ?>
            <a href="mailto:<?php echo esc_attr( $email ); ?>"><span aria-hidden="true">✉</span> <?php echo esc_html( $email ); ?></a>
            <?php endif; ?>
            <?php if ( $address ) : ?>
            <a href="https://maps.app.goo.gl/vw9FZBzTtaZN4mKDA" target="_blank" rel="noopener noreferrer">
                <span aria-hidden="true">📍</span>
                <span class="addr-text"><?php echo esc_html( $address ); ?></span>
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
$sticky_class  = get_theme_mod( 'tmcp_sticky_header', true ) ? 'tmcp-navbar--sticky' : '';
$header_style  = get_theme_mod( 'tmcp_header_style', 'inline' );
$show_search   = get_theme_mod( 'tmcp_header_search', true );
?>
<!-- Navbar -->
<nav class="tmcp-navbar tmcp-navbar--<?php echo esc_attr( $header_style ); ?> <?php echo esc_attr( $sticky_class ); ?>" role="navigation" aria-label="<?php esc_attr_e( 'Main Navigation', 'tmcp-hospital' ); ?>">
    <div class="tmcp-navbar-inner">

        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="tmcp-navbar-logo">
            <?php
            $custom_logo_id = (int) get_theme_mod( 'custom_logo' );
            if ( $custom_logo_id ) {
                echo wp_get_attachment_image( $custom_logo_id, 'full', false, [
                    'class'   => 'custom-logo',
                    'alt'     => esc_attr( get_bloginfo( 'name' ) . ' logo' ),
                    'loading' => 'eager',
                ] );
            } else {
                $logo_url = esc_url( get_site_url() . '/wp-content/uploads/2024/12/tmname_logo_horizon-1.jpg' );
                echo '<img src="' . $logo_url . '" alt="' . esc_attr( get_bloginfo( 'name' ) . ' logo' ) . '" width="120" height="50" loading="eager">';
            }
            ?>
        </a>

        <?php if ( $header_style === 'centered' ) : ?>
        <!-- Centered style: full-width inner, nav below logo -->
        <div class="tmcp-navbar-menu" id="tmcpMenu">
            <?php wp_nav_menu( [
                'theme_location' => 'navbar_main',
                'menu'           => 4,
                'container'      => false,
                'items_wrap'     => '<ul role="menubar">%3$s</ul>',
                'fallback_cb'    => false,
            ] ); ?>
        </div>
        <?php elseif ( $header_style === 'stacked' ) : ?>
        <div class="tmcp-navbar-menu" id="tmcpMenu">
            <?php wp_nav_menu( [
                'theme_location' => 'navbar_main',
                'menu'           => 4,
                'container'      => false,
                'items_wrap'     => '<ul role="menubar">%3$s</ul>',
                'fallback_cb'    => false,
            ] ); ?>
        </div>
        <?php else : /* inline (default) */ ?>
        <div class="tmcp-navbar-menu" id="tmcpMenu">
            <?php wp_nav_menu( [
                'theme_location' => 'navbar_main',
                'menu'           => 4,
                'container'      => false,
                'items_wrap'     => '<ul role="menubar">%3$s</ul>',
                'fallback_cb'    => false,
            ] ); ?>
        </div>
        <?php endif; ?>

        <div class="tmcp-navbar-actions">
            <?php if ( $show_search ) : ?>
            <button class="tmcp-search-btn" id="tmcpSearchBtn" aria-label="<?php esc_attr_e( 'ค้นหา', 'tmcp-hospital' ); ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
                    <path d="M20 20l-3-3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
            <?php endif; ?>
            <button class="tmcp-burger" id="tmcpBurger" aria-label="<?php esc_attr_e( 'Toggle menu', 'tmcp-hospital' ); ?>" aria-expanded="false" aria-controls="tmcpMenu">
                <span></span><span></span><span></span>
            </button>
        </div>

    </div>
</nav>
<script>
(function(){
    var burger = document.getElementById('tmcpBurger');
    var menu   = document.getElementById('tmcpMenu');
    if (burger && menu) {
        burger.addEventListener('click', function(){
            var open = menu.classList.toggle('open');
            burger.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    }
})();
</script>
