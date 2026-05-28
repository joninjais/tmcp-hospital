<?php
/**
 * TMCP Hospital — Single Post Template
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$sidebar_pos = tmcp_get_sidebar_position();
?>
<?php tmcp_page_title_bar(); ?>

<div class="<?php echo esc_attr( tmcp_layout_class( $sidebar_pos ) ); ?>">

    <main class="tmcp-content-area" id="main">
    <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'tmcp-single-article' ); ?> itemscope itemtype="https://schema.org/Article">

            <?php if ( get_theme_mod( 'tmcp_single_featured_image', true ) && has_post_thumbnail() ) : ?>
            <div class="tmcp-post-featured-image">
                <?php the_post_thumbnail( 'large', [ 'loading' => 'eager', 'itemprop' => 'image' ] ); ?>
            </div>
            <?php endif; ?>

            <div class="tmcp-post-meta-full">
                <span class="tmcp-meta-cat">
                    <?php
                    $cats = get_the_category();
                    if ( $cats ) {
                        foreach ( $cats as $cat ) {
                            echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a> ';
                        }
                    }
                    ?>
                </span>
                <span class="tmcp-meta-date" itemprop="datePublished"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></span>
                <span class="tmcp-meta-author" itemprop="author"><?php the_author(); ?></span>
                <?php if ( comments_open() ) : ?>
                <span class="tmcp-meta-comments"><a href="<?php comments_link(); ?>"><?php comments_number( '0 ความคิดเห็น', '1 ความคิดเห็น', '% ความคิดเห็น' ); ?></a></span>
                <?php endif; ?>
            </div>

            <div class="tmcp-entry-content" itemprop="articleBody">
                <?php the_content(); ?>
            </div>

            <?php
            wp_link_pages( [
                'before' => '<div class="tmcp-page-links">' . esc_html__( 'หน้า:', 'tmcp-hospital' ),
                'after'  => '</div>',
            ] );
            ?>

            <?php
            $tags = get_the_tags();
            if ( $tags ) :
            ?>
            <div class="tmcp-post-tags">
                <span class="tmcp-tags-label"><?php esc_html_e( 'แท็ก:', 'tmcp-hospital' ); ?></span>
                <?php foreach ( $tags as $tag ) : ?>
                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="tmcp-tag-link"><?php echo esc_html( $tag->name ); ?></a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <nav class="tmcp-post-nav" aria-label="<?php esc_attr_e( 'Post navigation', 'tmcp-hospital' ); ?>">
                <div class="tmcp-post-nav-prev"><?php previous_post_link( '%link', '&#8592; %title' ); ?></div>
                <div class="tmcp-post-nav-next"><?php next_post_link( '%link', '%title &#8594;' ); ?></div>
            </nav>

        </article>

        <?php tmcp_author_box(); ?>
        <?php tmcp_related_posts(); ?>
        <?php comments_template(); ?>

    <?php endwhile; ?>
    </main>

    <?php if ( $sidebar_pos !== 'none' ) get_sidebar(); ?>

</div>

<?php get_footer(); ?>
