<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Topbar -->
<div class="tmcp-topbar">
    <div class="tmcp-topbar-inner">
        <div class="tmcp-topbar-contacts">
            <a href="tel:1669"><span>🚑</span> 1669</a>
            <a href="tel:076571505"><span>📞</span> 076-571505</a>
            <a href="mailto:tm11354@moph.go.th"><span>✉</span> tm11354@moph.go.th</a>
            <a href="https://maps.app.goo.gl/vw9FZBzTtaZN4mKDA" target="_blank" rel="noopener">
                <span>📍</span>
                <span class="addr-text">166 ม.9 ถนนเพชรเกษม ต.ท้ายเหมือง จ.พังงา 82120</span>
            </a>
        </div>
    </div>
</div>

<!-- Navbar -->
<nav class="tmcp-navbar" role="navigation">
    <div class="tmcp-navbar-inner">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="tmcp-navbar-logo">
            <img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2024/12/tmname_logo_horizon-1.jpg'); ?>"
                 alt="<?php bloginfo('name'); ?>" width="120" height="50">
        </a>
        <div class="tmcp-navbar-menu" id="tmcpMenu">
            <?php
            wp_nav_menu([
                'theme_location' => 'navbar_main',
                'menu'           => 4,
                'container'      => false,
                'items_wrap'     => '<ul>%3$s</ul>',
                'fallback_cb'    => false,
            ]);
            ?>
        </div>
        <button class="tmcp-burger" id="tmcpBurger" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>
<script>
document.getElementById('tmcpBurger').addEventListener('click', function() {
    document.getElementById('tmcpMenu').classList.toggle('open');
});
</script>
