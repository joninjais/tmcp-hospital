<?php
/**
 * Template Name: Full Width
 * Template Post Type: page
 *
 * TMCP Hospital — Full Width Page (no sidebar)
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>
<?php tmcp_page_title_bar(); ?>

<div class="tmcp-site-content tmcp-layout-full">
    <main class="tmcp-content-area" id="main">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
            <?php
            wp_link_pages( [
                'before' => '<div class="tmcp-page-links">',
                'after'  => '</div>',
            ] );
            ?>
        <?php endwhile; ?>
    </main>
</div>

<?php get_footer(); ?>
