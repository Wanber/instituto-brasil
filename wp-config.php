<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações
// com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('FS_METHOD', 'direct');
define('DB_NAME', 'wp_institutoposbrasil');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '1234');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'H^h?^n3w-d]/PKM7{z^T$t8>*|fT9=OjJyx-$tO<=$M:mA4su)u?I{HsqjWLHJot');
define('SECURE_AUTH_KEY',  'Fll6fvE$2#Q_1^^n]8Q&,q-Y`c^OC0]L.y4b|lcd4133A*q3k-^7V?)_9x#KZ*!R');
define('LOGGED_IN_KEY',    'rjw26`^mj#y+AH90XrY3@j?xSy-t$;UX@xEc1tekUw^bB84AMbvmH86~)wxkyxM|');
define('NONCE_KEY',        'V[z@ccRK$a|iT5;tOSMlX&ep0LDw&eZIaCBXJx0gjj_Ldme$[VVjYMY Fd?c#oaj');
define('AUTH_SALT',        'y,pv4S@i]2D;!3uCC.=Gvd]KOCG[ls]Y+B36_<y3.{>cWd~p/~tT>?XQcXpSO#ZH');
define('SECURE_AUTH_SALT', 'k(qAXEZM_vlQf%6b*7hLBH_mCv1?CA[f{4sD06leg~%{t#Yk4_yuD:L|T;KU{kot');
define('LOGGED_IN_SALT',   'D1,gyQNub.2 >;c@OL]{ip7x(Mvsq75M#[U*Bh nTTQwRh$%O^ZL8|[~wUO14!2/');
define('NONCE_SALT',       'i.Dc0=*d?;=LCmq*daD}S~qF_o?_PovtQxmCR#.,z.jD4yb{$rS+v!bjX]zg7`V6');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
