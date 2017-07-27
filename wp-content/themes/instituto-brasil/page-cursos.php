<?php get_header(); ?>
<div class="slide-single-top">
<?php echo do_shortcode('[rev_slider alias="banner_secundario"]') ?></div>
<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <?php

        $query_area = is_numeric($_REQUEST['a']) ? ' AND cdcurso_area=' . $_REQUEST['a'] : '';

        $parametros_tipo = [
            'select' => 'cdtpcurso,nmtpcurso',
            'where' => "alias='pos-graduacao'",
            'limit' => 1
        ];

        $tipo = api_request('courses_types', $parametros_tipo)[0];

        $parametros_cursos = [
            'select' => 'cdcurso,nmcurso,carga_horaria,cdtpcurso,cdcurso_area,alias,cdpromocao',
            'where' => "ativosite='S'=ativo='S' AND cdtpcurso=" . $tipo->cdtpcurso . $query_area,
            'offset' => 0,
            'limit' => 999
        ];

        $parametros_areas = [
            'select' => 'cdcurso_area,dscurso_area'
        ];

        $areas = api_request('courses_areas', $parametros_areas);

        $cursos = [];

        foreach (api_request('courses', $parametros_cursos) as $curso) :

            $curso->area = api_get_curso_area($curso->cdcurso_area, $areas);
            $curso->tipo = $tipo;

            $cursos[] = $curso;
        endforeach;
        ?>

        <section class="w-container">

            <div class="w-row">

                <div class="w-col w-col-12">

                    <table class="table table-bordered">
                        <thead>
                        <th>Curso</th>
                        <th>Tipo</th>
                        <th>Área</th>
                        <th>Carga horária</th>
                        </thead>
                        <tbody>
                        <?php foreach ($cursos as $curso) : ?>

                            <?php //var_dump($curso) ?>

                            <tr>
                                <td>
                                    <a href="<?php echo get_page_link(get_page_id_by_slug('curso')) . '?c=' . $curso->cdcurso; ?>">
                                        <?php echo $curso->nmcurso ?>
                                    </a>
                                </td>
                                <td><?php echo $curso->tipo->nmtpcurso ?></td>
                                <td><?php echo $curso->area->dscurso_area ?></td>
                                <td><?php echo $curso->carga_horaria ?> horas</td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>

                <div class="w-col w-col-2">

                    <?php
                    $parametros_areas = [
                        'select' => 'cdcurso_area,dscurso_area,area_alias'
                    ];

                    $GLOBALS['areas_curso'] = api_request('courses_areas', $parametros_areas);
                    ?>

                    <form action="" method="post">
                        <select>
                            <option disabled selected="selected">Área</option>
                            <?php foreach ($GLOBALS['areas_curso'] as $area) : ?>
                                <option <?php echo @$_REQUEST['a'] == $area->cdcurso_area ? 'selected="selected"' : '' ?>
                                        onclick="javascript: redireciona('<?php echo get_page_link(get_page_id_by_slug('cursos')) . '?a=' . $area->cdcurso_area ?>')">
                                    <?php echo $area->dscurso_area ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>

                </div>

            </div>

        </section>

    <?php endwhile; ?>

<?php else: ?>
    <p>Nenhum post encontrado!</p>
<?php endif; ?>

<?php get_footer(); ?>