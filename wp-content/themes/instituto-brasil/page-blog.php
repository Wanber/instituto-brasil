<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <section class="w-container">

            <h3><?php the_title(); ?></h3>
            <p><?php the_content(); ?></p>

            <?php
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;

            $the_query = new WP_Query(array(
                'category_name' => 'blog',
                'posts_per_page' => 2,
                'paged' => $paged
            ));

            while ($the_query->have_posts()) : $the_query->the_post();
                get_template_part('content', 'list');
            endwhile;

            if ($the_query->max_num_pages > 1) :

                if ($paged > 1) : echo get_previous_posts_link('Página anterior'); endif;
                if ($paged != $the_query->max_num_pages) :
                    echo get_next_posts_link('Próxima página', $the_query->max_num_pages);
                endif;

            endif;

            wp_reset_postdata();
            ?>

        </section>

    <?php endwhile; ?>

<?php else: ?>
    <p>Nenhum post encontrado!</p>
<?php endif; ?>

<?php get_footer(); ?>