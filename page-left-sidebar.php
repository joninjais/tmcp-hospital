<?php
/**
 * Template Name: Left Sidebar
 * Template Post Type: page
 *
 * TMCP Hospital — Left Sidebar Page Template
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>
<?php tmcp_page_title_bar(); ?>

<div class="tmcp-site-content tmcp-layout-left">
    <?php get_sidebar(); ?>
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
