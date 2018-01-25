<?php get_header(); ?>

    <div class="w-container" style="margin-top: 10px">

        <?php if (have_posts()) : ?>

            <?php $queried_object = get_queried_object(); ?>

            <?php the_archive_description('<div class="">', '</div>'); ?>


            <?php while (have_posts()) : the_post(); ?>
                <?php $thumb = get_the_post_thumbnail_url() . '?w=100&h=100'; ?>

                <?php get_template_part('content', 'list'); ?>

            <?php endwhile; ?>

            <div class="btn-blog">
                <?php the_posts_pagination(array(
                    'mid_size' => 5,
                    'prev_text' => __('Previous', 'defato'),
                    'next_text' => __('Next', 'defato'),
                )); ?>

            </div>

        <?php else : ?>

            <?php get_template_part('content', 'none'); ?>

        <?php endif; ?>

    </div>


<?php get_sidebar(); ?>

<?php get_footer(); ?>