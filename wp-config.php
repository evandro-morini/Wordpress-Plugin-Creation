<?php
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

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'wordpress' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '-UGRny=-gY%F>9}%jtYy@9y%Bjo6pv#3Dk!`CZ<O&hxK7T@={6]oiPYDtN,f1/2f' );
define( 'SECURE_AUTH_KEY',  '_;?}MDs$J][DUq%x5zr=O#]Kjkm~fQHkBj45rW`:!u(jlcer0k:KQ}84X#=2mISv' );
define( 'LOGGED_IN_KEY',    '?I/s4:A~,U6L}vXH}]!pGZV*ey+`u_8IdQgtF+9wCX3MFV2sb.-t,;?5=fLVL/rK' );
define( 'NONCE_KEY',        '=n(1o.i&&H{GDGL?xPWDtF$a*(<oJ,AQ#Y eh<>^O3X$Fs.G*H$b|mNETl,b,`@V' );
define( 'AUTH_SALT',        'Fy8q-hNT_BC7.w1fj-:N U%k2zE?}~?bqw|h5+(8s4`l4CW?/zFgV|Ov{9AGP#C`' );
define( 'SECURE_AUTH_SALT', 'j{hl{dc`Ha$4}$}[Hq{ .~sko5~T?2UE3tofF&KNX$0wv@]&:?hZafZTWTR<+eWV' );
define( 'LOGGED_IN_SALT',   '#j*!0/pzF;lwW4S=+^>%&HhycvBP+wQFu#m`zD}:b0^V`8>TH9uM0?To-25|=]O2' );
define( 'NONCE_SALT',       'TUfdN@Pl9#U.k&3<iF03GD|1=m:[+.xD;+]Pk)+fh%1cS5hh_$kTqQQ{Rv]BTS`X' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

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
