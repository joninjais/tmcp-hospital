<?php
$footer_cols = absint( get_theme_mod( 'tmcp_footer_columns', 4 ) );
$has_footer_widgets = false;
for ( $i = 1; $i <= 4; $i++ ) {
    if ( is_active_sidebar( 'footer-' . $i ) ) {
        $has_footer_widgets = true;
        break;
    }
}
if ( $footer_cols < 1 ) $footer_cols = 4;
?>

<?php if ( $has_footer_widgets ) : ?>
<div class="tmcp-footer-widgets">
    <div class="tmcp-footer-widgets-inner tmcp-fw-cols-<?php echo esc_attr( $footer_cols ); ?>">
        <?php for ( $i = 1; $i <= $footer_cols; $i++ ) : ?>
            <?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
            <div class="tmcp-footer-col">
                <?php dynamic_sidebar( 'footer-' . $i ); ?>
            </div>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
</div>
<?php endif; ?>

<footer class="tmcp-site-footer">
    <div class="tmcp-container">
        <?php
        $copyright_raw = get_theme_mod(
            'tmcp_footer_copyright',
            'Copyright &copy; {year} โรงพยาบาลท้ายเหมืองชัยพัฒน์ — All Rights Reserved'
        );
        $copyright = str_replace( '{year}', esc_html( date( 'Y' ) ), $copyright_raw );
        echo wp_kses_post( $copyright );
        ?>
    </div>
</footer>

</div><!-- .tmcp-site-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
