<footer class="rodape secao-principal">
    <div class="w-container">
        <div class="center-container">
            <div class="row1-rodape w-row">
                <div class="w-clearfix w-col w-col-4">
                    <a class="btn-cadastre-se-receba-novidades btn-padrao w-button" href="#">
                        cadastre-se e receba novidades
                    </a>

                    <?php
                    $parametros_areas = [
                        'select' => 'cdcurso_area,dscurso_area,area_alias'
                    ];

                    $areas_curso = $GLOBALS['areas_curso'] ?
                        $GLOBALS['areas_curso'] : api_request('courses_areas', $parametros_areas);
                    ?>

                    <?php foreach ($areas_curso as $area) : ?>

                        <a href="<?php echo get_page_link(get_page_id_by_slug('cursos')) . '?a=' . $area->cdcurso_area ?>"
                           class="link-rodape">
                            &gt; <?php echo $area->dscurso_area ?>
                        </a>

                    <?php endforeach; ?>

                </div>
                <div class="column-4 w-col w-col-4">
                    <h3 class="label-titulo-item-rodape">redes sociais</h3>
                    <div class="row-icon-rodape w-row">
                        <?php if ($facebook = get_field('link_facebook', get_page_id_by_slug('home'))) : ?>
                            <a class="w-col w-col-4 w-col-tiny-4" href="<?php echo $facebook ?>" target="_blank">
                                <img class="img-icon"
                                     src="<?php echo get_template_directory_uri() ?>/images/icon1_17.png">
                            </a>
                        <?php endif; ?>
                        <?php if ($instagram = get_field('link_instagram', get_page_id_by_slug('home'))) : ?>
                            <a class="w-col w-col-4 w-col-tiny-4" href="<?php echo $instagram ?>" target="_blank">
                                <img class="img-icon"
                                     src="<?php echo get_template_directory_uri() ?>/images/icon2_20.png">
                            </a>
                        <?php endif; ?>
                        <?php if ($youtube = get_field('link_youtube', get_page_id_by_slug('home'))) : ?>
                            <a class="w-col w-col-4 w-col-tiny-4" href="<?php echo $youtube ?>" target="_blank">
                                <img class="img-icon"
                                     src="<?php echo get_template_directory_uri() ?>/images/icon3_19.png">
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="column-3 w-col w-col-4">
                    <h3 class="fale-conosco label-titulo-item-rodape">fale conosco</h3>
                    <?php the_field('fale_conosco', get_page_id_by_slug('home')) ?>
                </div>
            </div>
            <div class="w-row">
                <div class="column1-rodape w-col w-col-6">
                    <div class="text-rodape">@2017 - Instituto Pós Brasil - Todos os direitos reservados</div>
                </div>
                <div class="column w-col w-col-6">
                    <a href="http://jobsart.com.br/" target="_blank" class="text-rodape"><strong>JOBSART</strong></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>