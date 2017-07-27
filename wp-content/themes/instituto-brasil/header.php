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
    <link href="<?php bloginfo('url'); ?>/wp-content/themes/instituto-brasil/css/css.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
    <!--<style>
        .w-container {
            max-width: 1170px !important;
        }
    </style>-->

    <script type="text/javascript">WebFont.load({
            google: {
                families: ["Droid Sans:400,700", "Montserrat:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"]
            }
        });
    </script>

    <!-- [if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"
            type="text/javascript"></script>
    <![endif] -->

    <script type="text/javascript">!function (o, c) {
            var n = c.documentElement, t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
        }(window, document);
    </script>

    <?php wp_head(); ?>
</head>

<body class="body">

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

            <div class="menu-button w-nav-button">
                <div class="icon w-icon-nav-menu"></div>
            </div>
        </div>
    </div>
    <div class="menu-2 w-nav" data-animation="default" data-collapse="tiny" data-duration="400">
        <div class="w-container">
            <a class="brand w-nav-brand" href="<?php echo get_site_url() ?>">
                <img class="image-2"
                     src="<?php echo get_template_directory_uri() ?>/images/logo-instituto-pos-brasil.png">
            </a>

            <?php
            $menu_opts = array('menu' => 'Top principal', 'container' => 'nav', 'container_class' => 'nav-menu-2 w-clearfix w-nav-menu', 'container_id' => 'menu', 'menu_class' => 'w-list-unstyled list-inline', 'menu_id' => '',
                'echo' => false, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '%3$s', 'item_spacing' => 'preserve',
                'depth' => 0, 'walker' => '', 'theme_location' => '');

            echo str_replace('<a ', '<a class="item-menu-2 w-nav-link"', strip_tags(wp_nav_menu($menu_opts), '<nav><a><br>'));
            ?>

            <div class="menu-button-2 w-nav-button">
                <div class="w-icon-nav-menu"></div>
            </div>

            <!-- Button trigger modal -->
            <a class="btn-padrao w-button" data-toggle="modal" data-target="#portalModal">
                PORTAL DO ALUNO
            </a>

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

                        <a href="<?php the_field('link_ava_novo_aluno', get_page_id_by_slug('home')) ?>"
                           class="btn btn-default2"
                           target="_blank">Novo aluno</a>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

</header>