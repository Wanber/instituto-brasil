<!DOCTYPE html>
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>><!--<![endif]-->
<head>
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>

    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <!--<style>
        .w-container {
            max-width: 1170px !important;
        }
    </style>-->

    <!-- [if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"
            type="text/javascript"></script>
    <![endif] -->

    <script type="text/javascript">!function (o, c) {
            var n = c.documentElement, t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
        }(window, document);
    </script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-105830278-1', 'auto');
  ga('send', 'pageview');

</script>
    <?php wp_head(); ?>
</head>

<body class="body">

<?php
global $wp;
$current_rel_uri = home_url(add_query_arg(array(), $wp->request)) . '/';
?>

<header>

    <div class="menu-1 w-nav" data-animation="default" data-collapse="medium" data-duration="400">
        <div class="container-2 w-container">

            <?php
            wp_nav_menu(array(
                'menu' => 'Top Menu',
                'container_id' => 'cssmenu',
                'walker' => new CSS_Menu_Walker()
            ));
            ?>
        </div>
    </div>
    <div id="box-header">
        <div class="menu-2 w-nav" data-animation="default" data-collapse="tiny" data-duration="400">
            <div class="w-container">
                <a class="brand w-nav-brand" href="<?php echo get_site_url() ?>">
                    <img class="image-2"
                         src="<?php echo get_template_directory_uri() ?>/images/logo-instituto-pos-brasil.png">
                </a>

                <?php
                /*
                wp_nav_menu(array(
                    'menu' => 'Main Navigation',
                    'container_id' => 'menu-p',
                    'walker' => new CSS_Menu_Walker()
                ));
                */
                ?>

                <div id="menu-p" class="menu-menu-principal-container">
                    <ul id="menu-menu-principal" class="menu">

                        <?php $pagina_sobre = get_page_by_title('Instituto Pós Brasil') ?>

                        <li id="menu-item-129" class="menu-item menu-item-type-post_type menu-item-object-page
                        <?php echo $current_rel_uri == get_page_link($pagina_sobre->ID) ? 'active' : '' ?>">
                            <a href="<?php echo get_page_link($pagina_sobre->ID) ?>"><span>Instituto<br>Pós Brasil</span></a>
                        </li>

                        <?php $pagina_cursos = get_page_by_title('Cursos') ?>

                        <li id="menu-item-81"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children has-sub">
                            <a href="<?php echo get_page_link($pagina_cursos->ID) ?>"><span>pós<br>graduação</span></a>
                            <ul>

                                <?php
                                $parametros_areas = [
                                    'select' => 'cdcurso_area,dscurso_area,area_alias'
                                ];

                                $GLOBALS['areas_curso'] = api_request('courses_areas', $parametros_areas);
                                ?>

                                <?php foreach ($GLOBALS['areas_curso'] as $area) : ?>

                                    <?php $link = get_page_link(get_page_id_by_slug('cursos')) . $area->area_alias ?>

                                    <li class="menu-item menu-item-type-custom menu-item-object-custom
                                    <?php echo $current_rel_uri == $link ? 'active' : '' ?>">
                                        <a href="<?php echo $link ?>">
                                            <span><?php echo $area->dscurso_area ?></span>
                                        </a>
                                    </li>

                                <?php endforeach; ?>

                            </ul>
                        </li>

                        <?php $pagina_como_funciona = get_page_by_title('Como Funciona') ?>

                        <li id="menu-item-126" class="menu-item menu-item-type-post_type menu-item-object-page
                        <?php echo $current_rel_uri == get_page_link($pagina_como_funciona->ID) ? 'active' : '' ?>">
                            <a href="<?php echo get_page_link($pagina_como_funciona->ID) ?>"><span>como<br>funciona</span></a>
                        </li>

                        <?php $pagina_matricula = get_page_by_title('Matrícula') ?>

                        <li id="menu-item-132" class="menu-item menu-item-type-post_type menu-item-object-page
                        <?php echo $current_rel_uri == get_page_link($pagina_matricula->ID) ? 'active' : '' ?>">
                            <a href="<?php echo get_page_link($pagina_matricula->ID) ?>"><span>quero me<br>inscrever</span></a>
                        </li>

                    </ul>
                </div>

                <!-- Button trigger modal -->
                <a class="btn-padrao w-button" data-toggle="modal" data-target="#portalModal">
                    PORTAL DO ALUNO
                </a>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="portalModal" tabindex="-1" role="dialog" aria-labelledby="portalModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="portalModalLabel">
                        <i class="fa fa-graduation-cap"></i> Acesse o Ambiente Virtual de Aprendizagem
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!--
                    <div class="dropdown">
                        <button class="btn btn-default2 dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                            Aluno
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" target="_blank"
                               href="<?php the_field('link_ava_pos_graduacao', get_page_id_by_slug('home')) ?>">
                                Pós graduação
                            </a>
                            <a class="dropdown-item" target="_blank"
                               href="<?php the_field('link_ava_aperfeicoamento', get_page_id_by_slug('home')) ?>">
                                Aperfeiçoamento
                            </a>
                            <a class="dropdown-item" target="_blank"
                               href="<?php the_field('link_ava_extensao', get_page_id_by_slug('home')) ?>">
                                Extensão
                            </a>
                        </div>
                        -->

                    <a href="<?php the_field('link_ava_novo_aluno', get_page_id_by_slug('home')) ?>"
                       class="btn btn-default2"
                       target="_blank">Pós graduação</a>

                    <a href="<?php the_field('link_ava_novo_aluno', get_page_id_by_slug('home')) ?>"
                       class="btn btn-default2"
                       target="_blank">Novo aluno</a>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

</header>