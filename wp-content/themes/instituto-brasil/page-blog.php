<?php get_header(); ?>
<div class="slide-single-top">
<?php echo do_shortcode('[rev_slider alias="banner_secundario"]') ?></div>
<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <section class="w-container">

            <div class="titulo-blog-page">» <?php the_title(); ?></div>
            <p><?php the_content(); ?></p>

            <?php
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;

            $the_query = new WP_Query(array(
                'category_name' => 'blog',
                'posts_per_page' => 9,
                'paged' => $paged
            ));

            while ($the_query->have_posts()) : $the_query->the_post();
                get_template_part('content', 'list');
            endwhile;

            if ($the_query->max_num_pages > 1) :
                echo ('<div class="btn-blog">');
                if ($paged > 1) : echo get_previous_posts_link('Página anterior'); endif;
                if ($paged != $the_query->max_num_pages) :
                    echo get_next_posts_link('Próxima página', $the_query->max_num_pages);
                endif;
echo ('</div>');
            endif;

            wp_reset_postdata();
            ?>

        </section>

    <?php endwhile; ?>

<?php else: ?>
    <p>Nenhum post encontrado!</p>
<?php endif; ?>

<?php get_footer(); ?>