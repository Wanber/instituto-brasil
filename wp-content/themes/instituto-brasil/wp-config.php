<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'iebcl2ag_sorriso');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'iebcl2ag_sorriso');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'ZObu,yhG4(kX');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '3 EzM%N9nv?r:`0-V:e4$$f0YKB58|~L^YkjXuS|?xs &1D,1|Y.!V--c?XHueP,');
define('SECURE_AUTH_KEY',  '.uC.r{qdlw?u>A Hup*%D]241z;*,aV&ph`TnV=s4RiKJiiGyV|9%Nrk5p )p()Y');
define('LOGGED_IN_KEY',    '13b|3!C5>xA%{Baik3-2AC14UQI*++;qbV+nR*&,-|vgvWR{srxku)5Bgs:iyl4_');
define('NONCE_KEY',        'eSJtPfOsZD_ijq <u*}H;C+K74pWb$WunI@(f#F?##AN&<#+|rfn|{wj{>qgG~4o');
define('AUTH_SALT',        'WkfFanUW]MNbRbopenE}|E,q;UKF?Xry+3HjJjwR++Uu|[-uBdS hW)8D[.S}nIV');
define('SECURE_AUTH_SALT', '6/FrV}<|!LF.KrxiRZZ`x@AeI9&C4kMVU+*[N1[elbv{.tN;mg4{810ZM0^8<|nZ');
define('LOGGED_IN_SALT',   'pmneP.9j-z$Dw+Y>2ys5m,J8Lp%F`?4|&[6<G{qew;jS%n-sl;u[x!rATkQ}aOKn');
define('NONCE_SALT',       '{G`4~6--O|`C:u](:1D`hS3`5^U>>-[BT!IuT8%a3To~X0e?|5@>$UFQ8#C)cW[`');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wrdp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
