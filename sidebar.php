<?php
/**
 * TMCP Hospital — Sidebar
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( is_active_sidebar( 'sidebar-main' ) ) : ?>
<aside class="tmcp-widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'tmcp-hospital' ); ?>">
    <?php dynamic_sidebar( 'sidebar-main' ); ?>
</aside>
<?php endif;
