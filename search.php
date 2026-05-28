<?php
/**
 * TMCP Hospital — Search Results Template
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

        <p class="tmcp-search-count">
            <?php
            global $wp_query;
            /* translators: 1: number, 2: query */
            printf(
                esc_html__( 'พบ %1$d ผลลัพธ์สำหรับ "%2$s"', 'tmcp-hospital' ),
                (int) $wp_query->found_posts,
                esc_html( get_search_query() )
            );
            ?>
        </p>

        <div class="tmcp-blog-loop tmcp-blog-<?php echo esc_attr( $blog_layout ); ?>">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class( 'tmcp-post-card' ); ?>>

                <?php if ( $show_thumb && has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" class="tmcp-post-thumb" tabindex="-1" aria-hidden="true">
                    <?php the_post_thumbnail( 'medium_large', [ 'loading' => 'lazy' ] ); ?>
                </a>
                <?php endif; ?>

                <div class="tmcp-post-card-body">
                    <div class="tmcp-post-meta">
                        <span class="tmcp-meta-date"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></span>
                    </div>
                    <h2 class="tmcp-post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="tmcp-post-excerpt"><?php the_excerpt(); ?></div>
                    <a href="<?php the_permalink(); ?>" class="tmcp-btn-readmore"><?php echo $readmore_txt; ?></a>
                </div>

            </article>

        <?php endwhile; ?>

        </div>

        <?php tmcp_pagination(); ?>

        <?php else : ?>

        <div class="tmcp-no-results-box">
            <p><?php printf( esc_html__( 'ไม่พบผลลัพธ์สำหรับ "%s"', 'tmcp-hospital' ), '<strong>' . esc_html( get_search_query() ) . '</strong>' ); ?></p>
            <p><?php esc_html_e( 'ลองค้นหาด้วยคำอื่น หรือใช้ฟอร์มด้านล่าง', 'tmcp-hospital' ); ?></p>
            <?php get_search_form(); ?>
        </div>

        <?php endif; ?>

    </main>

    <?php if ( $sidebar_pos !== 'none' ) get_sidebar(); ?>

</div>

<?php get_footer(); ?>
