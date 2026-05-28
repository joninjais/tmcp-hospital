<?php
/**
 * TMCP Hospital — Archive / Blog Index Template
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$sidebar_pos  = tmcp_get_sidebar_position();
$blog_layout  = get_theme_mod( 'tmcp_blog_layout', 'list' );
$show_thumb   = get_theme_mod( 'tmcp_show_featured_image', true );
$readmore_txt = esc_html( get_theme_mod( 'tmcp_readmore_text', 'อ่านต่อ' ) );
?>
<?php tmcp_page_title_bar(); ?>

<div class="<?php echo esc_attr( tmcp_layout_class( $sidebar_pos ) ); ?>">

    <main class="tmcp-content-area" id="main">

        <?php if ( have_posts() ) : ?>

        <div class="tmcp-blog-loop tmcp-blog-<?php echo esc_attr( $blog_layout ); ?>">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class( 'tmcp-post-card' ); ?> itemscope itemtype="https://schema.org/Article">

                <?php if ( $show_thumb && has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" class="tmcp-post-thumb" tabindex="-1" aria-hidden="true">
                    <?php the_post_thumbnail( 'medium_large', [ 'loading' => 'lazy', 'itemprop' => 'image' ] ); ?>
                </a>
                <?php endif; ?>

                <div class="tmcp-post-card-body">
                    <div class="tmcp-post-meta">
                        <?php
                        $cats = get_the_category();
                        if ( $cats ) {
                            echo '<a class="tmcp-meta-cat-link" href="' . esc_url( get_category_link( $cats[0]->term_id ) ) . '">' . esc_html( $cats[0]->name ) . '</a>';
                        }
                        ?>
                        <span class="tmcp-meta-date" itemprop="datePublished"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></span>
                        <span class="tmcp-meta-author" itemprop="author"><?php the_author(); ?></span>
                    </div>

                    <h2 class="tmcp-post-title" itemprop="headline">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>

                    <div class="tmcp-post-excerpt" itemprop="description">
                        <?php the_excerpt(); ?>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="tmcp-btn-readmore"><?php echo $readmore_txt; ?></a>
                </div>

            </article>

        <?php endwhile; ?>

        </div><!-- .tmcp-blog-loop -->

        <?php tmcp_pagination(); ?>

        <?php else : ?>
        <p class="tmcp-no-results"><?php esc_html_e( 'ไม่พบเนื้อหาที่ต้องการ', 'tmcp-hospital' ); ?></p>
        <?php endif; ?>

    </main>

    <?php if ( $sidebar_pos !== 'none' ) get_sidebar(); ?>

</div>

<?php get_footer(); ?>
