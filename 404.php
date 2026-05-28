<?php
/**
 * TMCP Hospital — 404 Page
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>
<?php tmcp_page_title_bar(); ?>

<div class="tmcp-site-content tmcp-layout-full">
    <main class="tmcp-content-area" id="main">
        <section class="tmcp-404-section">
            <div class="tmcp-404-code" aria-hidden="true">404</div>
            <h2 class="tmcp-404-heading"><?php esc_html_e( 'ขออภัย ไม่พบหน้าที่คุณต้องการ', 'tmcp-hospital' ); ?></h2>
            <p class="tmcp-404-desc"><?php esc_html_e( 'หน้าที่คุณค้นหาอาจถูกลบ เปลี่ยนชื่อ หรือไม่มีอยู่ชั่วคราว', 'tmcp-hospital' ); ?></p>

            <div class="tmcp-404-search">
                <?php get_search_form(); ?>
            </div>

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="tmcp-btn-primary">
                <?php esc_html_e( '← กลับหน้าหลัก', 'tmcp-hospital' ); ?>
            </a>
        </section>
    </main>
</div>

<?php get_footer(); ?>
