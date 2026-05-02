<?php get_header(); ?>

<main class="tmcp-page-content">
    <div class="tmcp-container">
        <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
