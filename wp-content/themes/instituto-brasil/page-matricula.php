<?php if (isset($_REQUEST['salvar'])) : ?>

	<?php $dados_matricula = json_decode(file_get_contents('php://input'), true); ?>
	<?php $dados_matricula['dt_matricula'] = strftime('%d/%m/%Y', time()); ?>
	<?php
	global $wpdb;
	$wpdb->insert('matriculas', ['matricula_json' => json_encode($dados_matricula)]);
	?>
	<?php
	$array = ['status'        => true,
			  'codeEnrolment' => $wpdb->insert_id,
			  'codeMaterial'  => 0,
			  'enrolment'     => $dados_matricula];
	?>

	<?php //file_put_contents(dirname(__FILE__) . '/matricula/txts/' . $wpdb->insert_id . '.txt', $txt_matricula) ?>
	<?php file_put_contents(dirname(__FILE__) . '/matricula/txts/' . $wpdb->insert_id . '.txt', serialize($dados_matricula)) ?>
	<?php header('Content-Type: application/json'); ?>
	<?php ob_clean() ?>
	<?php echo json_encode($array) ?>
	<?php ob_flush() ?>

	<?php
	//print_r($json_input_data);
	?>

	<?php
	$to = get_field('email_para_recebimento_de_novas_matriculas', get_page_id_by_slug('matricula'));
	$subject = 'Instituro Prominas - Nova matrícula';
	$body = '<h3>Nova matrícula!</h3>';
	$body .= '<p>Um aluno acabou de se matricular, para ver a matrícula acesse o link:</p>';
	$body .= '<a href="' . get_site_url() . '/matricula/?comprovante=' . $wpdb->insert_id . '">' . get_site_url() . '/matricula/?comprovante=' . $wpdb->insert_id . '</a>';
	$headers = ['Content-Type: text/html; charset=UTF-8', 'From: Instituto Prominas <' . get_option('admin_email') . '>'];

	wp_mail($to, $subject, $body, $headers);
	?>

<?php elseif (isset($_REQUEST['comprovante'])) : ?>

	<?php
	function safeStr($valor)
	{
		return iconv('UTF-8', 'windows-1252', $valor);
	}

	require_once(dirname(__FILE__) . '/matricula/fpdf/fpdf.php');
	require_once(dirname(__FILE__) . '/matricula/fpdi/fpdi.php');

	$arquivo_dados = dirname(__FILE__) . '/matricula/txts/' . $_REQUEST['comprovante'] . '.txt';
	$dados = unserialize(file_get_contents($arquivo_dados));

	$pdf = new FPDI();

	$pdf->setSourceFile(dirname(__FILE__) . '/matricula/modelo_ficha_inscricao.pdf');

	$pdf->AddPage();
	$tplIdx = $pdf->importPage(1);
	$pdf->useTemplate($tplIdx, 0, 0, 210);

	$pdf->SetFont('helvetica');
	$pdf->SetFontSize('10px');
	$pdf->SetTextColor(0, 0, 0);

	$pdf->SetXY(163, 33);
	$pdf->Write(0, safeStr($_REQUEST['comprovante']));

	$pdf->SetXY(11, 47);
	$pdf->Write(0, safeStr($dados['nmcliente']));

	$pdf->SetXY(106, 47);
	$pdf->Write(0, safeStr($dados['dados']['naturalidade']['nmcidade']));

	$pdf->SetXY(11, 60);
	$pdf->Write(0, safeStr($dados['nucpfcnpj']));

	$pdf->SetXY(106, 60);
	$pdf->Write(0, safeStr(mb_strtolower($dados['sexo']) == 'm' ? 'Masculino' : 'Feminino'));

	$pdf->SetXY(11, 74);
	$pdf->Write(0, safeStr($dados['email']));

	$pdf->SetXY(106, 74);
	$pdf->Write(0, safeStr($dados['nmpai']));

	$pdf->SetXY(11, 87);
	$pdf->Write(0, safeStr($dados['nuidentidade']));

	$pdf->SetXY(106, 87);
	$pdf->Write(0, safeStr($dados['nmmae']));

	$pdf->SetXY(11, 101);
	$pdf->Write(0, safeStr($dados['orgaoexpedidor']));

	$pdf->SetXY(106, 101);
	$pdf->Write(0, safeStr($dados['telefone1']));

	$pdf->SetXY(11, 115);
	$pdf->Write(0, safeStr($dados['dados']['naturalidade']['nmestado']));

	$pdf->SetXY(106, 115);
	$pdf->Write(0, safeStr($dados['telefone2']));

	$pdf->SetXY(11, 129);
	$pdf->Write(0, safeStr($dados['dtnascimento']));

	$pdf->SetXY(106, 129);
	$pdf->Write(0, safeStr($dados['dtcolacaodegrau']));

	$pdf->SetXY(11, 142);
	$pdf->Write(0, safeStr($dados['nmcursograduacao']));

	$pdf->SetXY(106, 142);
	$pdf->Write(0, safeStr($dados['dados']['plano']['parcela'] . 'x R$' . $dados['dados']['plano']['valor'] . ',00'));

	$pdf->SetXY(13, 161);
	$pdf->Write(0, safeStr($dados['cep']));

	$pdf->SetXY(108, 161);
	$pdf->Write(0, safeStr($dados['endereco']));

	$pdf->SetXY(13, 174);
	$pdf->Write(0, safeStr($dados['numero']));

	$pdf->SetXY(108, 174);
	$pdf->Write(0, safeStr($dados['bairro']));

	$pdf->SetXY(13, 188);
	$pdf->Write(0, safeStr($dados['dados']['cidade']['nmcidade']));

	$pdf->SetXY(108, 188);
	$pdf->Write(0, safeStr($dados['dados']['cidade']['nmestado']));

	$pdf->SetXY(13, 207);
	$pdf->Write(0, safeStr($dados['dt_matricula']));

	$pdf->SetXY(108, 207);
	$pdf->Write(0, safeStr($dados['planomaterial'] == '0' ? 'Material online gratuito' : $dados['dados']['plano_material']['parcela'] . 'x R$' . $dados['dados']['plano_material']['valor'] . ',00'));

	$pdf->SetXY(13, 207);
	$pdf->Write(0, safeStr($dados['dt_matricula']));

	$pdf->SetXY(13, 220);
	$pdf->Write(0, safeStr($dados['dtpagtoinscricao']));

	$pdf->SetXY(108, 220);
	$pdf->Write(0, safeStr($dados['dados']['plano_curso']['parcela'] . 'x R$' . $dados['dados']['plano_curso']['valor'] . ',00'));

	$pdf->SetXY(13, 234);
	$pdf->Write(0, safeStr($dados['dados']['curso']['nmtpcurso']));

	$pdf->SetXY(108, 234);
	$pdf->Write(0, safeStr($dados['dados']['curso']['dscurso_area']));

	$pdf->SetXY(13, 248);
	$pdf->Write(0, safeStr($dados['dados']['cidade']['nmcidade']));

	$pdf->SetXY(108, 248);
	$pdf->Write(0, substr(safeStr($dados['dados']['curso']['nmcurso']), 0, 34));

	$pdf->SetXY(13, 261);
	$pdf->Write(0, safeStr('FRANCISROBERT PEREIRA TEIXEIRA'));

	$pdf->SetXY(108, 261);
	$pdf->Write(0, safeStr('Online'));

	$pdf->SetXY(74, 268);
	//$pdf->Write(0, safeStr($dados['dados']['plano_curso']['parcela'] . 'x R$' . $dados['dados']['plano_curso']['valor'] . ',00'));

	$pdf->SetXY(109, 273);
	$pdf->Write(0, safeStr(strlen($dados['diapagamento']) == 1 ? '0' . $dados['diapagamento'] : $dados['diapagamento']));

	//pagina 2

	$pdf->AddPage();
	$tplIdx2 = $pdf->importPage(2);
	$pdf->useTemplate($tplIdx2, 0, 0, 210, 295);

	$pdf->SetXY(75, 238);
	$pdf->Ln();
	$pdf->Cell(0, 0, safeStr(strtolower($dados['email'])), 0, 1, 'C');

	$pdf->SetXY(77, 243);
	$pdf->Ln();
	$pdf->Cell(0, 0, safeStr(strtoupper($dados['nmcliente'])), 0, 1, 'C');

	//fim

	$pdf->Output();
	?>

<?php else : ?>

	<?php get_header(); ?>

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

            <section class="w-container">
                <h3 class="titulo-pagina"><?php the_title(); ?></h3>
                <br />

                <script language="JavaScript"
                        src="<?php echo get_template_directory_uri() ?>/matricula/bootstrap.min.js"></script>
                <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/matricula/bootstrap.min.css">

                <style>
                    .card-panel {
                        text-align: center;
                        padding: 25px 0px 25px 0px;
                    }

                    .card-panel i {
                        margin-bottom: 5px;
                        font-size: 40px;
                    }

                    app-root .btn {
                        -webkit-box-shadow: none;
                        -moz-box-shadow: none;
                        box-shadow: none;
                        background: #34987B;
                        color: white !important;
                        text-shadow: none;
                        margin-right: 10px;
                    }
                </style>

                <base href="<?php echo get_site_url() ?>/matricula">

                <app-root>Carregando...</app-root>

                <br />
                <br />

                <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/matricula/inline.152d2e4f72575d2b8cfe.bundle.js"></script>
                <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/matricula/polyfills.563dbf3f5c790722ed8b.bundle.js"></script>
                <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/matricula/scripts.aa540bb00c59e796a4ec.bundle.js"></script>
                <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/matricula/vendor.23af63d619565b58e101.bundle.js"></script>
                <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/matricula/main.1fdff63ae7113001f5c6.bundle.js"></script>
                
                <style>
                    #cssmenu ul li span {
                        font-size: 1.24rem;
                    }
                </style>

            </section>

		<?php endwhile; ?>

	<?php else: ?>
        <p>Nenhum post encontrado!</p>
	<?php endif; ?>

	<?php get_footer(); ?>

<?php endif; ?>
