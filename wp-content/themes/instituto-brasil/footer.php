<footer class="rodape secao-principal">
    <div class="w-container">
        <div class="center-container">
            <div class="row1-rodape w-row">
                <div class="w-clearfix w-col w-col-4">

                    <script language="JavaScript">
                        function teste() {
                            $('#newsletter_btn').hide();
                            $('#newsletter').show();
                        }
                    </script>

                    <form action="" method="post">
                        <input type="text" name="newsletter" id="newsletter" placeholder="Seu email">
                        <button type="button" id="newsletter_btn" onclick="teste()"
                                class="btn-cadastre-se-receba-novidades btn-padrao w-button">
                            cadastre-se e receba novidades
                        </button>
                    </form>

                    <br />

                    <?php
                    $parametros_areas = [
                        'select' => 'cdcurso_area,dscurso_area,area_alias'
                    ];

                    $areas_curso = $GLOBALS['areas_curso'] ?
                        $GLOBALS['areas_curso'] : api_request('courses_areas', $parametros_areas);
                    ?>

                    <?php foreach ($areas_curso as $area) : ?>

                        <a href="<?php echo get_page_link(get_page_id_by_slug('cursos')) . $area->area_alias ?>"
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

<script>
    (function ($) {
        $('#cssmenu').prepend('<div id="menu-button">Menu</div>');
        $('#cssmenu #menu-button').on('click', function () {
            var menu = $(this).next('ul');
            if (menu.hasClass('open')) {
                menu.removeClass('open');
            } else {
                menu.addClass('open');
            }
        });
    })(jQuery);
</script>

<script>
    (function ($) {
        $('#menu-p').prepend('<div id="menu-button">Menu</div>');
        $('#menu-p #menu-button').on('click', function () {
            var menu = $(this).next('ul');
            if (menu.hasClass('open')) {
                menu.removeClass('open');
            } else {
                menu.addClass('open');
            }
        });
    })(jQuery);
</script>

<?php
if (@$_REQUEST['newsletter'] != '') {
    $add = add_newsletter_stefano(htmlspecialchars(addslashes($_REQUEST['newsletter'])));

    if ($add == '1')
        echo '
            <script>
                (function ($) {
                    swal({
                        title: "Sucesso!",
                        text: "Você foi inscrito em nossa newsletter",
                        type: "success",
                        confirmButtonText: "OK"
                    });
                })(jQuery);
            </script>
        ';
    elseif ($add == '0')
        echo '
            <script>
                (function ($) {
                    swal({
                        title: "Erro!",
                        text: "Informe um email válido",
                        type: "error",
                        confirmButtonText: "OK"
                    });
                })(jQuery);
            </script>
        ';
    elseif ($add == '-1')
        echo '
            <script>
                (function ($) {
                    swal({
                        title: "Aviso!",
                        text: "Você já foi inscrito anteriormente",
                        type: "warning",
                        confirmButtonText: "OK"
                    });
                })(jQuery);
            </script>
        ';
}
?>

<?php wp_footer(); ?>

</body>
</html>