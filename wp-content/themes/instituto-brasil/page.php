<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <section class="w-container">

            <h3 class="titulo-pagina"><?php the_title(); ?></h3>
            <p class="conteudo-pagina"><?php the_content(); ?></p>

        </section>

    <?php endwhile; ?>

<?php else: ?>
    <p>Nenhum post encontrado!</p>
<?php endif; ?>
<div class="slide-single">
<?php echo do_shortcode('[rev_slider alias="banner_secundario"]') ?></div>
<?php get_footer(); ?>