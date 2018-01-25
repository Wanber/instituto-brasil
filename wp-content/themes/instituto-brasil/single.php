<?php get_header() ?>
<div class="slide-single-top">
<?php echo do_shortcode('[rev_slider alias="banner_secundario"]') ?></div>
<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <?php
        $post = get_post();
        $thumb = get_the_post_thumbnail_url();
        ?>
<div class="w-container"><div class="w-row">
        <article <?php post_class('article hentry'); ?> id="post-<?php the_ID(); ?>" itemscope
                                                        itemtype="http://schema.org/Article">


            <div class="w-col w-col-8">

                <!--atributos do post-->
                <h1 class="titulo-single"><?php the_title() ?></h1>
                <p class="sub-titulo"><?php the_excerpt() ?></p>
                <div class="data-postagem"><i class="fa fa-clock-o" aria-hidden="true"></i>   publicado em <?php echo ucfirst(get_the_date('d \d\e F \d\e Y   \à\s H\hi')) ?></b></div>
                <!--<img class="imagem-destaque"><img src="<?php echo $thumb ?>?w=500&h=200"/>-->
                <p class="conteudo-single"><?php the_content() ?></p>
                

                <!--tags-->
                <?php if ($tags = get_the_tags()) : ?>

                    Tags:
                    <span class="span-blog-tags">

                    <?php foreach ($tags as $tag) : ?>
                        <a href="<?php echo get_term_link($tag) ?>">
                            <?php echo $tag->name ?>
                        </a>
                    <?php endforeach; ?>

                </span>

                <?php endif; ?>

                <br/>

                <!--categorias-->
                <?php if ($cats = get_the_category()) : ?>

                    Categorias:
                    <span class="span-blog-tags">

                    <?php foreach ($cats as $cat) : ?>
                        <a href="<?php echo get_term_link($cat) ?>">
                            <?php echo $cat->name ?>
                        </a>
                        <?php echo $cat == end($cats) ? '' : ', ' ?>
                    <?php endforeach; ?>

                </span>

                <?php endif; ?>

            </div>

        </article>

    <?php endwhile; ?></dv><div class="w-col w-col-4"><div class="itens-fique-ligado-single w-row">

                    <?php
                    $the_query = new WP_Query(array(
                        'category_name' => 'blog',
                        'posts_per_page' => 4
                    ));

                    while ($the_query->have_posts()) : $the_query->the_post(); ?>

                        <?php $thumb = get_the_post_thumbnail_url() . '?w=230&h=153'; ?>

                        <!--loop-->
                        <a href="<?php the_permalink() ?>" class="column-fique-ligado-single w-col w-col-10">
                            <img class="img-fique-ligado" src="<?php echo $thumb ?>">
                            <div class="row-descricao-item-fique-ligado w-row">
                                <div class="column1-item-fique-ligado w-col w-col-3">
                                    <div class="dia-item-fique-ligado">
                                        <div class="label-data-item-fique-ligado">
                                            <strong class="important-text"><?php echo get_post_time('d') ?></strong>
                                        </div>
                                    </div>
                                    <div class="mes-item-fique-ligado">
                                        <div class="label-mes-item-gique-ligado"><?php echo strtoupper(get_post_time('M', false, null, true)) ?></div>
                                    </div>
                                </div>
                                <div class="column2-item-fique-ligado w-col w-col-9">
                                    <div class="label-descricao-item-fique-ligado">
                                        <?php the_title() ?>
                                    </div>
                                </div>
                            </div>
                        </a>

                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>

                </div>

    <?php get_sidebar() ?>

<?php endif; ?>
</div></div></div>
<div class="secao-nossos-cursos secao-principal">
        <div class="w-container">
            <div class="center-container">
                <h1 class="titulo-fique-ligado titulo-secao"><?php the_field('titulo_sessao_3', get_page_id_by_slug('home')) ?></h1>
                <p class="subtitulo-fique-ligado subtitulo-secao"><?php the_field('descricao_sessao_3', get_page_id_by_slug('home'), false) ?></p>

                <div class="row-nossos-cursos w-row" id="carr_cursos">

                    <?php
                    $parametros_areas = [
                        'select' => 'cdcurso_area,dscurso_area,area_alias'
                    ];

                    $GLOBALS['areas_curso'] = api_request('courses_areas', $parametros_areas);
                    ?>

                    <?php foreach ($GLOBALS['areas_curso'] as $area) : ?>

                        <?php
                        $img = 'layout_03.png';

                        switch ($area->area_alias) {
                            case 'direito' :
                                $img = 'direito.png';
                                break;
                            case 'educacao' :
                                $img = 'educacao.png';
                                break;
                            case 'empresarial' :
                                $img = 'administrativo.png';
                                break;
						  case 'saude' :
                                $img = 'saude.png';
                                break;
						  case 'engenharia' :
                                $img = 'engenharia.png';
                                break;
						  case 'ambiental' :
                                $img = 'ambiental.png';
                                break;
						  case 'mba-executivo' :
                                $img = 'excutivo.png';
                                break;
						  case 'area-social' :
                                $img = 'social.png';
                                break;
                        }
                        ?>

                        <a href="<?php echo get_page_link(get_page_id_by_slug('cursos')) . '?a=' . $area->cdcurso_area ?>"
                           class="w-col w-col-2">
                            <img class="image-copy img-item-nossos-cursos"
                                 src="<?php echo get_template_directory_uri() ?>/images/<?php echo $img ?>">
                            <h1 class="titulo-item-nossos-cursos"><strong><?php echo $area->dscurso_area ?></strong>
                            </h1>
                            <p class="descrica-nossos-cursos">
                                <!--nada-->
                            </p>
                        </a>

                    <?php endforeach; ?>

                </div>

            </div>
        </div>
    </div>
<?php get_footer(); ?>