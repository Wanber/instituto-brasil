<?php get_header(); ?>
    <div id="wrap">
        <section class="cursos-box">
            <div class="w-container">
                <h1 class="titulo-cursos-page">pós
                    <strong>graduação</strong>
                </h1>
                <p class="subtitulo-page-cursos">Dê um salto em sua carreira, cursos aprovados pelo MEC com qualidade e
                    certificado pela Universidade Cândido Mendes.</p></div>
        </section>

        <section class="w-container">
            <div id="box-cursos-carousel" class="w-col w-col-12">
                <div class="row-nossos-cursos w-row" id="carr_cursos2" style="display: none">

					<?php
					$parametros_areas = [
						'select' => 'cdcurso_area,dscurso_area,area_alias',
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

                        <a href="<?php echo get_page_link(get_page_id_by_slug('cursos')) . $area->area_alias ?>"
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

		$curso_request = get_query_var('curso', NULL);

		$parametros_curso = [
			'select' => 'cdcurso,nmcurso,carga_horaria,cdtpcurso,cdcurso_area,alias,cdpromocao,taxa_matricula,sigla',
			'where'  => "alias='" . $curso_request . "'",
			'offset' => 0,
			'limit'  => 1,
		];

		$curso = api_request('courses', $parametros_curso)[0];

		if ($curso == NULL) {
			die('
                <div class="w-container"><h3>Curso não encontrado</h3></div>
            ');
		}

		preg_match_all('/\d+/', $curso->sigla, $numeros);
		$curso->carga_horaria = end($numeros[0]);

		$parametros_area = ['select' => 'dscurso_area', 'where' => 'cdcurso_area=' . $curso->cdcurso_area];
		$parametros_tipo = ['select' => 'nmtpcurso', 'where' => 'cdtpcurso=' . $curso->cdtpcurso];
		$parametros_promocao = ['cdpromocao' => $curso->cdpromocao];
		$parametros_disciplinas = ['cdcurso' => $curso->cdcurso];
		$parametros_planos_matricula = ['cdtpcurso' => $curso->cdtpcurso];
		$parametros_planos_material_didatico = ['carga_horaria' => $curso->carga_horaria];

		$curso->area = api_request('courses_areas', $parametros_area)[0];
		$curso->tipo = api_request('courses_types', $parametros_tipo)[0];
		$curso->promocao = api_request('promotions', $parametros_promocao);
		$curso->disciplinas = api_request('courses_disciplines', $parametros_disciplinas);
		$curso->planos_matricula = api_request('enroll_plan', $parametros_planos_matricula);
		$curso->planos_material_didatico = api_request('courseware_plan', $parametros_planos_material_didatico);
		?>

        <section class="w-container" style="margin-top: 20px">

            <h3 class="nome-curso-page" style="margin-top: 0"><?php echo $curso->nmcurso ?></h3>

            <div class="img-destaque-curso">
                <img src="<?php echo get_template_directory_uri() ?>/images/foto-destaque-page-curso.png">
            </div>
            <div class="box-bt-curso">
                <a class="btn-curso-page w-button" href="<?php echo get_page_link(get_page_id_by_slug('matricula')) ?>">
                    FAZER MATRICULA
                </a>
            </div>
            <!--descriçao do curso-->
            <div class="desc-curso">

				<?php
				$args = [
					'numberposts' => -1,
					'post_type'   => 'post',
					'meta_key'    => 'curso_alias',
					'meta_value'  => $curso_request,
				];
				$the_query = new WP_Query($args);
				if ($the_query->have_posts()):
					while ($the_query->have_posts()) : $the_query->the_post();
						the_content();
					endwhile;
				endif;
				?>

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

                <h2 class="titulo-detalhes-cursos">Taxa de matrícula</h2>
                <table class="table table-bordered">
                    <!--thead>
                    <tr>
                        <th>Parcelas</th>
                        <th>Valor</th>
                    </tr>
                    </thead-->
                    <tbody>

						<?php foreach ($curso->planos_matricula as $plano_matricula) : ?>
							<?php if ($plano_matricula->nparcelas != '1')
								continue; ?>
                            <tr>
                                <td class="text-center" style="background: #34987B; color: white">Valor</td>
                                <td class="text-center">
                                    R$ <?php echo strpos($valor = str_replace('.', ',', $plano_matricula->valor), ',') > -1 ? $valor : $valor . ',00' ?></td>
                            </tr>
						<?php endforeach; ?>

                    </tbody>
                </table>

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
                                <a href="<?php echo get_page_link(get_page_id_by_slug('matricula')) ?>"
                                   class="btn-curso-page-detalhes w-button">Matricule-se
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <h2 class="titulo-detalhes-cursos">Material didático em apostila</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Parcelas</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>

						<?php foreach ($curso->planos_material_didatico as $plano_material_didatico) : ?>
                            <tr>
                                <td class="text-center">Por <?php echo $plano_material_didatico->nparcelas ?>x</td>
                                <td class="text-center">
                                    R$ <?php echo strpos($valor = str_replace('.', ',', $plano_material_didatico->valor), ',') > -1 ? $valor : $valor . ',00' ?>
                                </td>
                            </tr>
						<?php endforeach; ?>

                    </tbody>
                </table>
            </div>

        </section>


	<?php endwhile; ?>

<?php else: ?>
    <p>Nenhum post encontrado!</p>
<?php endif; ?>

<?php get_footer(); ?>