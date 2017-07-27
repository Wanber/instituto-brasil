<?php get_header(); ?>
    <div id="wrap">
        <section class="cursos-box">
            <div class="w-container"><h1 class="titulo-cursos-page">pós <strong>graduação</strong></h1>
                <p class="subtitulo-page-cursos">tstetstestestset</p></div>
        </section>

        <section class="w-container">
            <div id="box-cursos-carousel" class="w-col w-col-12">
                <div class="row-nossos-cursos w-row" id="carr_cursos2" style="display: none">

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
                            case 'aa' :
                                $img = 'aa_05.png';
                                break;
                            case 'bb' :
                                $img = 'layout_07_07.png';
                                break;
                            case 'cc' :
                                $img = 'aa_05.png';
                                break;
                        }
                        ?>

                        <a href="<?php echo get_page_link(get_page_id_by_slug('cursos')) . '?a=' . $area->cdcurso_area ?>"
                           class="w-col w-col-2">
                            <img class="image-copy img-item-nossos-cursos"
                                 src="<?php echo get_template_directory_uri() ?>/images/<?php echo $img ?>">
                            <h1 class="titulo-item-nossos-cursos-page">
                                <strong><?php echo $area->dscurso_area ?></strong>
                            </h1>
                            <p class="descrica-nossos-cursos">
                                <!--nada-->
                            </p>
                        </a>

                    <?php endforeach; ?>

                </div>
            </div>
        </section>

    </div>
<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <?php

        if (!is_numeric($cdcurso = @$_REQUEST['c']))
            die('Curso não encontrado');

        $parametros_curso = [
            'select' => 'cdcurso,nmcurso,carga_horaria,cdtpcurso,cdcurso_area,alias,cdpromocao,taxa_matricula',
            'where' => "cdcurso=" . $cdcurso,
            'offset' => 0,
            'limit' => 1
        ];

        $curso = api_request('courses', $parametros_curso)[0];

        $parametros_area = ['select' => 'dscurso_area', 'where' => 'cdcurso_area=' . $curso->cdcurso_area];
        $parametros_tipo = ['select' => 'nmtpcurso', 'where' => 'cdtpcurso=' . $curso->cdtpcurso];
        $parametros_promocao = ['cdpromocao' => $curso->cdpromocao];
        $parametros_disciplinas = ['cdcurso' => $curso->cdcurso];

        $curso->area = api_request('courses_areas', $parametros_area)[0];
        $curso->tipo = api_request('courses_types', $parametros_tipo)[0];
        $curso->promocao = api_request('promotions', $parametros_promocao);
        $curso->disciplinas = api_request('courses_disciplines', $parametros_disciplinas);
        ?>

        <section class="w-container">

            <h3 class="nome-curso-page"><?php echo $curso->nmcurso ?></h3>

            <div class="img-destaque-curso">
                <img src="<?php echo get_template_directory_uri() ?>/images/foto-destaque-page-curso.png">
            </div>

            <div class="box-bt-curso">
                <a class="btn-curso-page w-button" data-toggle="modal" data-target="#portalModal">
                    FAZER MATRICULA
                </a>
            </div>

            <div class="w-col w-col-8">
                <h2 class="titulo-detalhes-cursos">Detalhes do Curso</h2>
                <div class="btn-curso-page-detalhes w-button">Carga horária: <?php echo $curso->carga_horaria ?>h</div>
                <div class="btn-curso-page-detalhes w-button">Área: <?php echo $curso->area->dscurso_area ?></div>
                <div class="btn-curso-page-detalhes w-button">Tipo: <?php echo $curso->tipo->nmtpcurso ?></div>

                <h2 class="titulo-detalhes-cursos">Matriz Curricular</h2>

                <table class="table table-bordered">
                    <thead>
                    <th>Modúlos</th>
                    <th>Disciplinas</th>
                    <th>Carga Horária</th>
                    </thead>
                    <tbody>
                    <?php foreach ($curso->disciplinas as $disciplina) : ?>
                        <tr>
                            <td class="nowrap">Módulo <?php echo $disciplina->modulo ?></td>
                            <td><?php echo $disciplina->nome ?></td>
                            <td><?php echo $disciplina->carga_horaria ?>h</td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="w-col w-col-4">
                Taxa de matrícula: <?php echo $taxa = $curso->taxa_matricula == null ? 'Grátis' : 'R$ ' . $taxa; ?>

                <h2 class="titulo-detalhes-cursos">Planos de Pagamento</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="3" class="text-center">Mensalidades do Curso</th>
                    </tr>
                    <tr>
                        <th class="text-center">Parcelas</th>
                        <th class="text-center">Valor</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $ultima_parcela = '' ?>
                    <?php foreach ($curso->promocao->parcelas as $parcela) : ?>
                        <?php if ($parcela->parcela == $ultima_parcela) : continue; endif; ?>
                        <tr>
                            <td class="text-center">Por <?php echo $parcela->parcela ?>x</td>
                            <td class="text-center">
                                R$ <?php echo str_replace('.', ',', $parcela->valorparcela) ?>
                            </td>
                        </tr>
                        <?php $ultima_parcela = $parcela->parcela ?>
                    <?php endforeach; ?>

                    <tr>
                        <td colspan="3" class="text-center">
                            <div class="btn-curso-page-detalhes w-button">Matricule-se</div>
                        </td>
                    </tr>

                    </tbody>
                </table>


                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="3" class="text-center">Material didático em apostila</th>
                    </tr>
                    <tr>
                        <th>Parcelas</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>oi</td>
                        <td>oi</td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </section>


    <?php endwhile; ?>

<?php else: ?>
    <p>Nenhum post encontrado!</p>
<?php endif; ?>

<?php get_footer(); ?>