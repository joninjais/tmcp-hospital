<?php
/**
 * TMCP Hospital — Comments Template
 */
if ( post_password_required() ) return;
?>
<div id="comments" class="tmcp-comments-area">

    <?php if ( have_comments() ) : ?>

    <h3 class="tmcp-comments-title">
        <?php
        $count = get_comments_number();
        if ( $count === '1' ) {
            printf( esc_html__( '1 ความคิดเห็นใน "%s"', 'tmcp-hospital' ), esc_html( get_the_title() ) );
        } else {
            printf( esc_html__( '%1$s ความคิดเห็นใน "%2$s"', 'tmcp-hospital' ), number_format_i18n( $count ), esc_html( get_the_title() ) );
        }
        ?>
    </h3>

    <ol class="tmcp-comment-list">
        <?php
        wp_list_comments( [
            'style'       => 'ol',
            'short_ping'  => true,
            'avatar_size' => 50,
            'callback'    => 'tmcp_comment_template',
        ] );
        ?>
    </ol>

    <?php the_comments_pagination( [
        'prev_text' => '&#8592; ' . esc_html__( 'ก่อนหน้า', 'tmcp-hospital' ),
        'next_text' => esc_html__( 'ถัดไป', 'tmcp-hospital' ) . ' &#8594;',
    ] ); ?>

    <?php endif; ?>

    <?php if ( ! comments_open() && get_comments_number() > 0 ) : ?>
    <p class="tmcp-comments-closed"><?php esc_html_e( 'ปิดรับความคิดเห็นแล้ว', 'tmcp-hospital' ); ?></p>
    <?php endif; ?>

    <?php
    comment_form( [
        'title_reply'          => esc_html__( 'แสดงความคิดเห็น', 'tmcp-hospital' ),
        'title_reply_to'       => esc_html__( 'ตอบกลับ %s', 'tmcp-hospital' ),
        'cancel_reply_link'    => esc_html__( 'ยกเลิก', 'tmcp-hospital' ),
        'label_submit'         => esc_html__( 'ส่งความคิดเห็น', 'tmcp-hospital' ),
        'class_submit'         => 'tmcp-btn-primary',
        'comment_notes_before' => '',
        'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'ความคิดเห็น', 'tmcp-hospital' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="5" required></textarea></p>',
    ] );
    ?>

</div><!-- .tmcp-comments-area -->

<?php
/**
 * Custom comment callback to render each comment.
 */
function tmcp_comment_template( $comment, $args, $depth ) {
    $tag = ( $comment->comment_type === 'pingback' || $comment->comment_type === 'trackback' ) ? 'li' : 'li';
    ?>
    <<?php echo esc_html( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent', $comment ); ?>>
    <article id="div-comment-<?php comment_ID(); ?>" class="tmcp-comment">
        <footer class="tmcp-comment-meta">
            <div class="tmcp-comment-author">
                <?php echo get_avatar( $comment, $args['avatar_size'], '', '', [ 'class' => 'tmcp-comment-avatar' ] ); ?>
                <div>
                    <b class="tmcp-comment-author-name"><?php comment_author_link( $comment ); ?></b>
                    <time class="tmcp-comment-date" datetime="<?php comment_time( 'c' ); ?>">
                        <?php echo esc_html( get_comment_date( 'j F Y', $comment ) ); ?>
                    </time>
                </div>
            </div>
            <?php edit_comment_link( esc_html__( 'แก้ไข', 'tmcp-hospital' ), '<span class="edit-link">', '</span>' ); ?>
        </footer>

        <div class="tmcp-comment-content">
            <?php if ( $comment->comment_approved === '0' ) : ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e( 'ความคิดเห็นของคุณรอการอนุมัติ', 'tmcp-hospital' ); ?></em>
            <?php endif; ?>
            <?php comment_text( $comment, array_merge( $args, [ 'add_below' => 'div-comment' ] ) ); ?>
        </div>

        <?php if ( $depth < $args['max_depth'] ) : ?>
        <div class="reply">
            <?php comment_reply_link( array_merge( $args, [
                'add_below' => 'div-comment',
                'depth'     => $depth,
                'max_depth' => $args['max_depth'],
                'before'    => '',
                'after'     => '',
            ] ) ); ?>
        </div>
        <?php endif; ?>
    </article>
    <?php
}
