<?php get_header(); ?>

<main class="tmcp-page-content">
    <div class="tmcp-container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article style="margin-bottom:32px;padding-bottom:32px;border-bottom:1px solid #E8DEF8;">
                <h2 style="font-family:'Poppins',sans-serif;color:#1E0842;font-size:22px;margin-bottom:6px;">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <p style="color:#888;font-size:13px;margin-bottom:10px;"><?php the_date('j F Y'); ?></p>
                <?php the_excerpt(); ?>
            </article>
        <?php endwhile; else : ?>
            <p>ไม่พบเนื้อหา</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
