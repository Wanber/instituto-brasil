<?php get_header(); ?>
    <div class="slide-single-top">
		<?php echo do_shortcode('[rev_slider alias="banner_secundario"]') ?>
    </div>
<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<?php

		$parametros_areas = [
			'select' => 'cdcurso_area,dscurso_area,area_alias',
		];

		$areas = api_request('courses_areas', $parametros_areas);
		$area_request = api_get_curso_area_by_alias(get_query_var('area', NULL), $areas);
		$query_area = $area_request != NULL ? ' AND cdcurso_area=' . $area_request->cdcurso_area : '';

		$parametros_tipo = [
			'select' => 'cdtpcurso,nmtpcurso',
			'where'  => "alias='pos-graduacao'",
			'limit'  => 1,
		];

		$tipo = api_request('courses_types', $parametros_tipo)[0];

		$parametros_cursos = [
			'select' => 'cdcurso,nmcurso,carga_horaria,cdtpcurso,cdcurso_area,alias,cdpromocao,sigla',
			'where'  => "ativosite='S'=ativo='S' AND cdtpcurso=" . $tipo->cdtpcurso . $query_area,
			'offset' => 0,
			'limit'  => 999,
		];

		$cursos = [];

		foreach (api_request('courses', $parametros_cursos) as $curso) :

			$curso->area = api_get_curso_area($curso->cdcurso_area, $areas);
			$curso->tipo = $tipo;

			$cursos[] = $curso;
		endforeach;
		?>

        <h1 class="titulo-pagina"><?php the_title(); ?></h1>
        <section class="w-container">

            <div class="w-row">

                <div class="w-col w-col-12">

                    <table id="cursos" class="table table-bordered">
                        <thead>
                            <th>Curso</th>
                            <th>Tipo</th>
                            <th>Área</th>
                            <th>Carga horária</th>
                        </thead>
                        <tbody>
							<?php foreach ($cursos as $curso) : ?>

								<?php preg_match_all('/\d+/', $curso->sigla, $numeros); ?>
								<?php $curso->carga_horaria = end($numeros[0]); ?>

                                <tr>
                                    <td>
                                        <a href="<?php echo get_page_link(get_page_id_by_slug('curso')) . $curso->alias; ?>">
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


                    <script>
                        //$(document).ready(function () {
                        jQuery(function ($) {
                            $('#cursos').filterTable({
                                label: '',
                                placeholder: 'Informe o nome do curso...'
                            });
                        });
                    </script>

                </div>

        </section>

	<?php endwhile; ?>

<?php else: ?>
    <p>Nenhum post encontrado!</p>
<?php endif; ?>

<?php get_footer(); ?>