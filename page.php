<?php
/**
 * TMCP Hospital — Page Template (default)
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$sidebar_pos = tmcp_get_sidebar_position();
?>
<?php tmcp_page_title_bar(); ?>

<div class="<?php echo esc_attr( tmcp_layout_class( $sidebar_pos ) ); ?>">

    <main class="tmcp-content-area" id="main">
        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class( 'tmcp-page-article' ); ?>>
                <div class="tmcp-entry-content">
                    <?php the_content(); ?>
                </div>
                <?php
                wp_link_pages( [
                    'before' => '<div class="tmcp-page-links">',
                    'after'  => '</div>',
                ] );
                ?>
            </article>

            <?php if ( comments_open() || get_comments_number() ) : ?>
                <?php comments_template(); ?>
            <?php endif; ?>

        <?php endwhile; ?>
    </main>

    <?php if ( $sidebar_pos !== 'none' ) get_sidebar(); ?>

</div>

<?php get_footer(); ?>
