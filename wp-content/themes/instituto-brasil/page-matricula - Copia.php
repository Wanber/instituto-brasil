<?php if (isset($_REQUEST['salvar'])) : ?>

    <?php $dados_matricula = json_decode(file_get_contents('php://input'), TRUE); ?>
    <?php
    global $wpdb;
    $wpdb->insert('matriculas', array('matricula_json' => json_encode($dados_matricula)));
    ?>
    <?php
    $array = ['status' => true,
        'codeEnrolment' => $wpdb->insert_id,
        'codeMaterial' => 0,
        'enrolment' => $dados_matricula];
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
    $headers = array('Content-Type: text/html; charset=UTF-8', 'From: Instituto Prominas <' . get_option('admin_email') . '>');

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

    $pdf->setSourceFile(dirname(__FILE__) . '/matricula/modelo_inscricao.pdf');

    $pdf->AddPage();
    $tplIdx = $pdf->importPage(1);
    $pdf->useTemplate($tplIdx, 0, 0, 210);

    $pdf->SetFont('Helvetica');
    $pdf->SetFontSize('10px');
    $pdf->SetTextColor(112, 32, 40);

    $pdf->SetXY(8, 55);
    $pdf->Write(0, safeStr($dados['nmcliente']));

    $pdf->SetXY(8, 65);
    $pdf->Write(0, safeStr($dados['dados']['curso']['nmcurso']));

    $pdf->SetXY(8, 77);
    $pdf->Write(0, $dados['email']);

    $pdf->SetXY(8, 88);
    $pdf->Write(0, $dados['nucpfcnpj']);

    $dt_nascimento = $dados['dtnascimento'];
    $dt_nascimento_ex = explode('/', $dt_nascimento);

    $pdf->SetXY(75, 90);
    $pdf->Write(0, $dt_nascimento_ex[0]);

    $pdf->SetXY(85, 90);
    $pdf->Write(0, $dt_nascimento_ex[1]);

    $pdf->SetXY(97, 90);
    $pdf->Write(0, $dt_nascimento_ex[2]);

    $pdf->SetXY(120, 89);
    $pdf->Write(0, safeStr($dados['dados']['naturalidade']['nmcidade'] . '/' . $dados['dados']['naturalidade']['sgestado']));

    $pdf->SetXY(8, 100);
    $pdf->Write(0, $dados['nuidentidade']);

    $estado_civil = '';
    switch ($dados['cdestado_civil']) {
        case 'S':
            $estado_civil = 'Solteiro';
            break;
        case 'C':
            $estado_civil = 'Casado';
            break;
        case 'D':
            $estado_civil = 'Divorciado';
            break;
        case 'V':
            $estado_civil = 'Viúvo';
            break;
    }
    $pdf->SetXY(66, 100);
    $pdf->Write(0, safeStr($estado_civil));

    $pdf->SetXY(116, 100);
    $pdf->Write(0, safeStr('--'));//--------------------------- tem??

    $pdf->SetXY(8, 112);
    $pdf->Write(0, safeStr($dados['endereco']));

    $pdf->SetXY(163, 112);
    $pdf->Write(0, $dados['numero']);

    $pdf->SetXY(185, 112);
    $pdf->Write(0, $dados['complemento']);

    $pdf->SetXY(8, 122);
    $pdf->Write(0, safeStr($dados['bairro']));

    $pdf->SetXY(80, 122);
    $pdf->Write(0, safeStr($dados['dados']['cidade']['nmcidade']));

    $pdf->SetXY(180, 122);
    $pdf->Write(0, safeStr($dados['dados']['cidade']['sgestado']));

    $pdf->SetXY(8, 132);
    $pdf->Write(0, $dados['cep']);

    $pdf->SetXY(64, 132);
    $pdf->Write(0, $dados['telefone1']);

    $pdf->SetXY(124, 132);
    $pdf->Write(0, $dados['telefone2']);

    $pdf->SetXY(180, 132);
    $pdf->Write(0, '--');//---------------------------------tem??

    $pdf->SetXY(20, 143);
    $pdf->Write(0, safeStr($dados['nmpai']));

    $pdf->SetXY(20, 153);
    $pdf->Write(0, safeStr($dados['nmmae']));

    $pdf->SetXY(8, 164);
    $pdf->Write(0, safeStr($dados['nmcursograduacao']));

    $dt_colacao_grau = $dados['dtcolacaodegrau'];
    $dt_colacao_grau_ex = explode('/', $dt_colacao_grau);
    $pdf->SetXY(85, 164);
    $pdf->Write(0, $dt_nascimento_ex[1] . '/' . $dt_nascimento_ex[2]);

    $pdf->SetXY(139, 164);
    $pdf->Write(0, safeStr('Robert'));//--------------------------------isso mesmo?

    $parcelas = $dados['dados']['plano_curso']['parcela'];

    switch ($parcelas) {
        case '1':
            $pdf->SetXY(8, 245);
            break;
        case '6':
            $pdf->SetXY(59, 245);
            break;
        case '12':
            $pdf->SetXY(109, 245);
            break;
        case '18':
            $pdf->SetXY(157, 245);
            break;
    }
    $pdf->Write(0, 'X');

    $pdf->SetXY(40, 250);
    $pdf->Write(0, safeStr($dados['dados']['plano_curso']['parcela'] . 'x R$' . $dados['dados']['plano_curso']['valor']));

    $pdf->SetXY(166, 250);
    $pdf->Write(0, $dados['diapagamento']);

    $pdf->AddPage();
    $tplIdx2 = $pdf->importPage(2);
    $pdf->useTemplate($tplIdx2, 0, 0, 210, 295);

    $pdf->SetXY(100, 272);
    $pdf->Write(0, safeStr('Timóteo'));

    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

    $pdf->SetXY(148, 272);
    $pdf->Write(0, safeStr(strftime('%d', time())));

    $pdf->SetXY(162, 272);
    $pdf->Write(0, safeStr(ucfirst(utf8_encode(strftime('%B', time())))));

    $pdf->SetXY(192, 272);
    $pdf->Write(0, safeStr(strftime('%y', time())));

    $pdf->SetXY(128, 276);
    $pdf->Write(0, safeStr($dados['email']));

    $pdf->Output();
    ?>

<?php else : ?>

    <?php get_header(); ?>

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <section class="w-container">
                <h3 class="titulo-pagina"><?php the_title(); ?></h3>
                <br/>

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

                <br/><br/>

                <script type="text/javascript"
                        src="<?php echo get_template_directory_uri() ?>/matricula/inline.1f9c2c981f54aebac653.bundle.js"></script>
                <script type="text/javascript"
                        src="<?php echo get_template_directory_uri() ?>/matricula/polyfills.e5fc3032c38272a74cb2.bundle.js"></script>
                <script type="text/javascript"
                        src="<?php echo get_template_directory_uri() ?>/matricula/scripts.477f6a09a334e81e35eb.bundle.js"></script>
                <script type="text/javascript"
                        src="<?php echo get_template_directory_uri() ?>/matricula/vendor.64d79ae8127fe8b8c1c2.bundle.js"></script>
                <script type="text/javascript"
                        src="<?php echo get_template_directory_uri() ?>/matricula/main.6c5153fa7092702ce42f.bundle.js"></script>

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
