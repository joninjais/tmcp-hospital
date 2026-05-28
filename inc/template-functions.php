<?php
/**
 * TMCP Hospital — Template Helper Functions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ================================================================
   SIDEBAR POSITION HELPERS
   ================================================================ */

/**
 * Return the sidebar position ('right' | 'left' | 'none') for the current view.
 */
function tmcp_get_sidebar_position() {
    if ( is_singular( 'post' ) ) {
        return get_theme_mod( 'tmcp_single_sidebar', 'right' );
    }
    if ( is_home() || is_archive() || is_search() ) {
        return get_theme_mod( 'tmcp_blog_sidebar', 'right' );
    }
    if ( is_page() ) {
        // Per-page override stored as post meta
        $meta = get_post_meta( get_the_ID(), '_tmcp_sidebar_position', true );
        if ( $meta && in_array( $meta, [ 'right', 'left', 'none' ], true ) ) {
            return $meta;
        }
        return get_theme_mod( 'tmcp_page_sidebar', 'none' );
    }
    return 'none';
}

/**
 * Return CSS class string for site-content wrapper based on sidebar position.
 */
function tmcp_layout_class( $sidebar_pos = null ) {
    if ( null === $sidebar_pos ) {
        $sidebar_pos = tmcp_get_sidebar_position();
    }
    $classes = [ 'tmcp-site-content' ];
    if ( $sidebar_pos === 'none' ) {
        $classes[] = 'tmcp-layout-full';
    } elseif ( $sidebar_pos === 'left' ) {
        $classes[] = 'tmcp-layout-left';
    } else {
        $classes[] = 'tmcp-layout-right';
    }
    return implode( ' ', $classes );
}

/* ================================================================
   EXCERPT HELPERS
   ================================================================ */

/**
 * Custom excerpt length from Customizer.
 */
function tmcp_excerpt_length( $length ) {
    return absint( get_theme_mod( 'tmcp_excerpt_length', 30 ) );
}
add_filter( 'excerpt_length', 'tmcp_excerpt_length', 999 );

/**
 * Custom "Read More" link.
 */
function tmcp_excerpt_more( $more ) {
    $text = esc_html( get_theme_mod( 'tmcp_readmore_text', 'อ่านต่อ' ) );
    return '&hellip; <a class="tmcp-readmore" href="' . esc_url( get_permalink() ) . '">' . $text . '</a>';
}
add_filter( 'excerpt_more', 'tmcp_excerpt_more' );

/* ================================================================
   BACK-TO-TOP BUTTON
   ================================================================ */
function tmcp_back_to_top_output() {
    if ( ! get_theme_mod( 'tmcp_back_to_top', true ) ) return;
    ?>
    <button class="tmcp-back-to-top" id="tmcpBTT" aria-label="<?php esc_attr_e( 'Back to top', 'tmcp-hospital' ); ?>">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
            <path d="M9 14V4M4 9l5-5 5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
    <script>
    (function(){
        var btn = document.getElementById('tmcpBTT');
        if (!btn) return;
        window.addEventListener('scroll', function(){
            btn.classList.toggle('visible', window.pageYOffset > 300);
        }, {passive: true});
        btn.addEventListener('click', function(){
            window.scrollTo({top: 0, behavior: 'smooth'});
        });
    })();
    </script>
    <?php
}
add_action( 'wp_footer', 'tmcp_back_to_top_output' );

/* ================================================================
   SEARCH OVERLAY (inner pages)
   ================================================================ */
function tmcp_search_overlay_output() {
    if ( ! get_theme_mod( 'tmcp_header_search', true ) ) return;
    ?>
    <div class="tmcp-search-overlay" id="tmcpSearchOverlay" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'ค้นหา', 'tmcp-hospital' ); ?>">
        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" name="s" placeholder="<?php esc_attr_e( 'ค้นหาข้อมูลในเว็บไซต์นี้', 'tmcp-hospital' ); ?>" autocomplete="off" value="<?php echo esc_attr( get_search_query() ); ?>">
            <button type="button" class="tmcp-so-close" id="tmcpSearchClose" aria-label="<?php esc_attr_e( 'ปิด', 'tmcp-hospital' ); ?>">&#x2715;</button>
        </form>
    </div>
    <script>
    (function(){
        var overlay = document.getElementById('tmcpSearchOverlay');
        var openBtn = document.getElementById('tmcpSearchBtn');
        var closeBtn = document.getElementById('tmcpSearchClose');
        if (openBtn && overlay) {
            openBtn.addEventListener('click', function(e){
                e.preventDefault();
                overlay.classList.add('active');
                var inp = overlay.querySelector('input');
                if (inp) { inp.focus(); inp.select(); }
            });
        }
        if (closeBtn) {
            closeBtn.addEventListener('click', function(){
                overlay.classList.remove('active');
            });
        }
        document.addEventListener('keydown', function(e){
            if (e.key === 'Escape') { overlay.classList.remove('active'); }
        });
    })();
    </script>
    <?php
}
add_action( 'wp_footer', 'tmcp_search_overlay_output' );

/* ================================================================
   RELATED POSTS
   ================================================================ */
function tmcp_related_posts() {
    if ( ! get_theme_mod( 'tmcp_single_related', true ) ) return;
    global $post;
    $cats = get_the_category( $post->ID );
    if ( ! $cats ) return;

    $cat_ids = wp_list_pluck( $cats, 'term_id' );
    $related = new WP_Query( [
        'category__in'        => $cat_ids,
        'post__not_in'        => [ $post->ID ],
        'posts_per_page'      => 3,
        'ignore_sticky_posts' => true,
        'orderby'             => 'rand',
        'no_found_rows'       => true,
    ] );
    if ( ! $related->have_posts() ) return;
    ?>
    <section class="tmcp-related-posts">
        <h3 class="tmcp-related-title"><?php esc_html_e( 'บทความที่เกี่ยวข้อง', 'tmcp-hospital' ); ?></h3>
        <div class="tmcp-related-grid">
        <?php while ( $related->have_posts() ) : $related->the_post(); ?>
            <article class="tmcp-related-item">
                <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" class="tmcp-related-thumb">
                    <?php the_post_thumbnail( 'medium', [ 'loading' => 'lazy' ] ); ?>
                </a>
                <?php endif; ?>
                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <p class="tmcp-related-date"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></p>
            </article>
        <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </section>
    <?php
}

/* ================================================================
   PAGE TITLE BAR
   ================================================================ */
function tmcp_page_title_bar() {
    if ( is_front_page() ) return;
    $title = '';
    if ( is_home() && ! is_front_page() ) {
        $title = esc_html__( 'บทความ / ข่าวสาร', 'tmcp-hospital' );
    } elseif ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = get_the_author();
    } elseif ( is_search() ) {
        /* translators: %s: search query */
        $title = sprintf( __( 'ผลการค้นหา: "%s"', 'tmcp-hospital' ), get_search_query() );
    } elseif ( is_archive() ) {
        $title = get_the_archive_title();
    } elseif ( is_404() ) {
        $title = esc_html__( 'ไม่พบหน้าที่ต้องการ', 'tmcp-hospital' );
    } elseif ( is_singular() ) {
        $title = get_the_title();
    }
    if ( ! $title ) return;
    ?>
    <div class="tmcp-page-title-bar">
        <div class="tmcp-container">
            <h1 class="tmcp-page-title"><?php echo wp_kses_post( $title ); ?></h1>
            <?php tmcp_breadcrumbs(); ?>
        </div>
    </div>
    <?php
}

/* ================================================================
   PAGINATION
   ================================================================ */
function tmcp_pagination() {
    $args = [
        'prev_text' => '&#8592; ' . esc_html__( 'ก่อนหน้า', 'tmcp-hospital' ),
        'next_text' => esc_html__( 'ถัดไป', 'tmcp-hospital' ) . ' &#8594;',
        'mid_size'  => 2,
    ];
    echo '<nav class="tmcp-pagination" aria-label="' . esc_attr__( 'Pagination', 'tmcp-hospital' ) . '">';
    the_posts_pagination( $args );
    echo '</nav>';
}

/* ================================================================
   AUTHOR BOX
   ================================================================ */
function tmcp_author_box() {
    if ( ! get_theme_mod( 'tmcp_single_author_box', true ) ) return;
    ?>
    <div class="tmcp-author-box">
        <div class="tmcp-author-avatar">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', '', [ 'class' => 'tmcp-avatar' ] ); ?>
        </div>
        <div class="tmcp-author-info">
            <h4 class="tmcp-author-name"><?php the_author(); ?></h4>
            <?php if ( get_the_author_meta( 'description' ) ) : ?>
            <p class="tmcp-author-bio"><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
            <?php endif; ?>
            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="tmcp-author-link">
                <?php echo esc_html( sprintf( __( 'ดูบทความทั้งหมดของ %s', 'tmcp-hospital' ), get_the_author() ) ); ?>
            </a>
        </div>
    </div>
    <?php
}
