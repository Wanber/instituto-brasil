<?php

//desativa a edição do tema
//define('DISALLOW_FILE_EDIT', true);
//remove a barra de admin
add_filter('show_admin_bar', '__return_false');
//remove a tag do generator
remove_action('wp_head', 'wp_generator');
//habilita ediçao de menus
add_theme_support('menus');
//habilita thumb em posts
add_theme_support('post-thumbnails');
//habilita ediçao de titulo de pagina
add_theme_support('title-tag');
//habilita tags html5
add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
));

//habilita upload pelo tema
//include_once ABSPATH . 'wp-admin/includes/media.php';
//include_once ABSPATH . 'wp-admin/includes/file.php';
//include_once ABSPATH . 'wp-admin/includes/image.php';

//retornar somente texto no excerpt
add_filter('the_excerpt', function ($content) {
    return strip_tags(strip_shortcodes($content));
});

//limitar excerpt
add_filter('excerpt_length', function () {
    return 40;
});

/*intermediador de menu
add_filter('wp_nav_menu', function ($ulclass) {
    return $ulclass;
});

//registrar espaço para widgets
/*
function registrar_espacos_widgets () {

    register_sidebar( array(
        'name' => 'nome do espaço',
        'id' => 'slug_widget',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'registrar_espacos_widgets' );
*/

//ativar single.php para categorias
add_filter('single_template', function ($t) {

    foreach ((array)get_the_category() as $cat) {
        if (file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php"))
            return TEMPLATEPATH . "/single-{$cat->slug}.php";

        if ($cat->parent) {
            $cat = get_the_category_by_ID($cat->parent);

            if (file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php"))
                return TEMPLATEPATH . "/single-{$cat->slug}.php";
        }
    }
    return $t;
});

//Segurança
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

//funçoes uteis
function pegaMeioStr($inicio, $fim, $str)
{
    @$ex = explode($inicio, $str);
    @$ex2 = explode($fim, $ex[1]);
    return $ex2[0];
}

function get_page_id_by_slug($page_slug)
{
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

function get_attachment_url_by_slug($slug)
{
    $args = array(
        'post_type' => 'attachment',
        'name' => sanitize_title($slug),
        'posts_per_page' => 1,
        'post_status' => 'inherit',
    );
    $_header = get_posts($args);
    $header = $_header ? array_pop($_header) : null;
    return $header ? wp_get_attachment_url($header->ID) : '';
}

function contato($nome, $email, $assunto, $mensagem)
{
    $headers = 'From: ' . $nome . ' <' . $email . '>' . "\r\n";
    $mensagem .= '<br /><br />Mensagem enviada via formulário de contato pelo site <i>' . bloginfo('name') . '</i>';
    wp_mail(get_bloginfo("admin_email"), $assunto, $mensagem, $headers);
    return true;
}

//adiciona o css/js do tema ao header
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('theme-style', get_stylesheet_uri(), false, null, 'all');
    wp_enqueue_style('theme-main', get_template_directory_uri() . "/css/main.css", false, null, 'all');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/libs/bootstrap/css/bootstrap.min.css', false, null, 'all');
    wp_enqueue_style('slick-slider', get_template_directory_uri() . '/libs/slick-1.6.0/slick/slick.css', false, null, 'all');
    wp_enqueue_style('slick-slider-theme', get_template_directory_uri() . '/libs/slick-1.6.0/slick/slick-theme.css', false, null, 'all');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', false, null, 'all');
    wp_enqueue_style('font-awesome', '//fonts.googleapis.com/css?family=Open+Sans:300,400,600', false, null, 'all');
    wp_enqueue_style('normalize', get_template_directory_uri() . "/css/normalize.css", false, null, 'all');
    wp_enqueue_style('webflow', get_template_directory_uri() . "/css/webflow.css", false, null, 'all');
    wp_enqueue_style('theme', get_template_directory_uri() . "/css/css.css", false, null, 'all');
    wp_enqueue_style('webfont', '//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js', false, null, 'all');

    wp_enqueue_script('jquery');
    wp_enqueue_script('tether-js', get_template_directory_uri() . '/libs/tether/dist/js/tether.min.js', array(), null, true);
    wp_enqueue_script('slick-slider-js', get_template_directory_uri() . '/libs/slick-1.6.0/slick/slick.js', array(), null, true);
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/libs/bootstrap/js/bootstrap.min.js', array(), null, true);

    wp_enqueue_script('theme-js', get_template_directory_uri() . '/js/main.js', array(), null, true);
});

//texto do rodape admin
add_filter('admin_footer_text', function () {
    $my_theme = wp_get_theme();
    echo 'Desenvolvido por: ' . $my_theme->get('Author') . ' - <a href="mailto:wanber@outlook.com">wanber@outlook.com</a>';
});

//adiciona contador de visualizaçoes aos posts
add_action('wp_head', function ($post_id) {
    if (!is_single()) return;

    if (empty ($post_id)) {
        global $post;
        $post_id = $post->ID;
    }

    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
});

//adiciona contador de comentarios e compartilhamentos do fb
add_action('wp_head', function ($post_id) {
    if (!is_single()) return;

    if (empty ($post_id)) {
        global $post;
        $post_id = $post->ID;
    }

    $json = file_get_contents('http://graph.facebook.com/' . get_the_permalink($post_id));
    $obj = json_decode($json);

    $num_comentarios = $obj->share->comment_count;
    $num_comp = $obj->share->share_count;

    if (!is_numeric($num_comentarios) || !is_numeric($num_comp))
        return;

    $comen_key = 'wpb_fb_comments';
    $comp_key = 'wpb_fb_comp';

    $atual_coment_num = get_post_meta($post_id, $comen_key, true);
    $atual_comp_num = get_post_meta($post_id, $comp_key, true);

    if ($atual_coment_num == '') {
        delete_post_meta($post_id, $comen_key);
        add_post_meta($post_id, $comen_key, $num_comentarios);
    } else {
        update_post_meta($post_id, $comen_key, $num_comentarios);
    }
    if ($atual_comp_num == '') {
        delete_post_meta($post_id, $comp_key);
        add_post_meta($post_id, $comp_key, $num_comp);
    } else {
        update_post_meta($post_id, $comp_key, $num_comp);
    }
});

function api_request($request, $parametros)
{
    $api_base_url = '179.188.38.145/ucam/';

    $url = "http://" . $api_base_url . $request . '/';

    if($request == 'promotions')
        $url .=  $parametros['cdpromocao'];
    else if($request == 'courses_disciplines')
        $url .=  $parametros['cdcurso'];
    else if($request == 'disciplines')
        $url .=  $parametros['cddisciplina'];
    else
        $url .=  '?'.http_build_query($parametros, '', '&');

    $json = file_get_contents($url);
    $json_data = json_decode($json, false);

    return $json_data->ok ? $json_data->data : false;
}

function api_get_curso_area($cdcurso, array $cursos)
{
    foreach ($cursos as $curso)
        if ($curso->cdcurso_area == $cdcurso)
            return $curso;
}

function api_get_curso_tipo($cdtipo, array $tipos)
{
    foreach ($tipos as $tipo)
        if ($tipo->cdtpcurso == $cdtipo)
            return $tipo;
}

class CSS_Menu_Walker extends Walker
{

    var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {

        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array)$item->classes;

        /* Add active class */
        if (in_array('current-menu-item', $classes)) {
            $classes[] = 'active';
            unset($classes['current-menu-item']);
        }

        /* Check for children */
        $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
        if (!empty($children)) {
            $classes[] = 'has-sub';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '><span>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</span></a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= "</li>\n";
    }
}