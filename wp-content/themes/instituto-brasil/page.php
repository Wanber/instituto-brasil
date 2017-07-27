<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <section class="w-container">

            <h3><?php the_title(); ?></h3>
            <p><?php the_content(); ?></p>

        </section>

    <?php endwhile; ?>

<?php else: ?>
    <p>Nenhum post encontrado!</p>
<?php endif; ?>

<?php get_footer(); ?>