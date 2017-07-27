<?php get_header(); ?>

    <section class="section" role="main">

        <?php if (have_posts()) : ?>

            <h2 class="pagetitle">
                <?php _e('Searching for', 'adelle-theme'); ?> &quot;<?php the_search_query(); ?>&quot;
            </h2>

            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('content', 'list'); ?>

            <?php endwhile; ?>

            <?php the_posts_pagination(array(
                'mid_size' => 5,
                'prev_text' => __('Previous', 'defato'),
                'next_text' => __('Next', 'defato'),
            )); ?>

        <?php else : get_template_part('content', 'none'); endif; ?>

    </section><!-- .section -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>