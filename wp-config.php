<?php
define( 'DISALLOW_FILE_MODS', true );
// Isso impede que o WordPress tente redirecionar URLs que ele acha "erradas"
//define('WP_CONTENT_URL', '/wp-content');
//remove_filter('template_redirect', 'redirect_canonical');

/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do banco de dados
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config.php/
 *
 * @package WordPress
 */

// ** Configurações do banco de dados - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', "wordpress"  );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', "wordpress" );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', "66ddb5fc4f0728471e5cd075fa21add28d4b4f9afa8a3ef3" );

/** Nome do host do MySQL */
define( 'DB_HOST', "localhost" );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         'fx:<;(TR=tb?j|9bS#N4Y-wh9NqLtg}ZNIojD/MOtextA@1wA8SQ*]0vyr~8&aF]'  );
define( 'SECURE_AUTH_KEY',  'w8jQtJT1yXgWk4Rn(KiI+<L>X9js2fFqef%bw.~Q(>s $,-LkPtn^ +9S$xYK>zw' );
define( 'LOGGED_IN_KEY',    '#rG1ef(DoBmt,;wb2AzPmWl8$GoWh3)nF7G7U>R>Kf9G ^vh f.<Q>vD5:GOfaBU' );
define( 'NONCE_KEY',        '$U27k8nSsScqzDH;L@8c?!.W>8a6bM?|Dt_c~!81u@kPbXXn$w4s~BYh?`(-1#?f' );
define( 'AUTH_SALT',        '14=4D Rv^.Rq&(Lt)TuA!6Cye9-yJ YivK?d][iOZSSjr32,= 6t/!fJrR$(64 %' );
define( 'SECURE_AUTH_SALT', 'XiR {vNLRp{)a#i*rox.g] f(fY.rgR1&j(N7~nuL$|N+guW*+a(lhja~K/2s:ga' );
define( 'LOGGED_IN_SALT',   '0/l/xbz9{u*l8:X<` yU[x EjmcyWa H,|1iEy;y9z`4_>Q=*Htrao9HwRAq<::x' );
define( 'NONCE_SALT',       'MZ#F7%TTk#Dt~rh0z0vJR;ngEDwIx`>M~c7fjqlO)(5l!]s&*^E .i!s/y]kn@{B' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'inca_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
ini_set('display_errors','Off' );
define( 'WP_DEBUG', false );
define('FS_METHOD', 'direct');

/* Adicione valores personalizados entre esta linha até "Isto é tudo". */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
?>