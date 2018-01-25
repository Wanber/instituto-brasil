<?php get_header(); ?>

<?php echo do_shortcode('[rev_slider alias="banner_principal"]') ?>

    <div class="secao-instituto-pos-brasil secao-principal">
        <div class="w-container">
            <div class="center-container">
                <h1 class="titulo-instituto-pos-brasil titulo-secao"><?php the_field('titulo_sessao_1', get_page_id_by_slug('home')) ?></h1>
                <p class="subtitulo-secao"><?php the_field('descricao_sessao_1', get_page_id_by_slug('home'), false) ?></p>
                <div class="itens-instuto-pos-brasil w-row">

                    <?php
                    $the_query = new WP_Query(array(
                        'category_name' => 'institutos',
                        'posts_per_page' => 3
                    ));

                    while ($the_query->have_posts()) : $the_query->the_post(); ?>

                        <?php $thumb = get_the_post_thumbnail_url() . '?w=273&h=273'; ?>

                        <!--loop--><a href="<?php the_permalink() ?>">
                        <div class="column-instituto-pos-brasil w-col w-col-4">
                            <img class="img-instituto-pos-brasil" src="<?php echo $thumb ?>">
                            <h1 class="heading"><?php the_title() ?></h1>
                            <div class="text-block"><?php echo substr(get_the_excerpt(), 0,170); ?></div>
				  </div></a>

                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>

                </div>
            </div>
        </div>
        <img class="img-arredondamento" sizes="(max-width: 1920px) 100vw, 1920px"
             src="<?php echo get_template_directory_uri() ?>/images/layout_3.png"
             srcset="<?php echo get_template_directory_uri() ?>/images/layout_3-p-500.png 500w, <?php echo get_template_directory_uri() ?>/images/layout_3-p-800.png 800w, <?php echo get_template_directory_uri() ?>/images/layout_3-p-1080.png 1080w, <?php echo get_template_directory_uri() ?>/images/layout_3.png 1920w">
    </div>
    <div class="secao-fique-ligado secao-principal">
        <div class="w-container">
            <div class="center-container">
                <h1 class="titulo-fique-ligado titulo-secao"><?php the_field('titulo_sessao_2', get_page_id_by_slug('home')) ?></h1>
                <p class="subtitulo-fique-ligado subtitulo-secao"><?php the_field('descricao_sessao_2', get_page_id_by_slug('home'), false) ?></p>
                <div class="itens-fique-ligado w-row">

                    <?php
                    $the_query = new WP_Query(array(
                        'category_name' => 'blog',
                        'posts_per_page' => 4
                    ));

                    while ($the_query->have_posts()) : $the_query->the_post(); ?>

                        <?php $thumb = get_the_post_thumbnail_url() . '?w=230&h=153'; ?>

                        <!--loop-->
                        <a href="<?php the_permalink() ?>" class="column-fique-ligado w-col w-col-3">
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
            </div>
        </div>
        <div>
            <a class="btn--mais-noticias btn-padrao w-button"
               href="<?php echo get_page_link(get_page_id_by_slug('blog')) ?>">
                mais <strong class="important-text-3">notícias</strong>
            </a>
        </div>
    </div>
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
                           class="w-col w-col-3">
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

<?php echo do_shortcode('[rev_slider alias="banner_secundario"]') ?>

    <div class="secao-fique-ligado secao-principal">
        <div class="w-container">
            <div class="center-container">
                <h1 class="titulo-fique-ligado titulo-secao"><?php the_field('titulo_sessao_4', get_page_id_by_slug('home')) ?></h1>
                <?php echo do_shortcode('[logo_carousel_slider]') ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>