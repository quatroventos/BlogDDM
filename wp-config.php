<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache


/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', '4v55' );

/** MySQL database username */
define( 'DB_USER', '4v55' );

/** MySQL database password */
define( 'DB_PASSWORD', 'r8x6d7u8' );

/** MySQL hostname */
define( 'DB_HOST', 'mysql.4v.com.br' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'B6]?VfO9a5Z^?xAZw!m@jj$rqWC.kAOv-cJrr;{4&.ze6>qgBY7 .g_w%Tdc&I>e' );
define( 'SECURE_AUTH_KEY',   'AR:!e5sk0-HH|YOQS)27$dFVUB qFOne,r/DBVl.D}gt}4,f?1Fp=e]DG cwM7Pw' );
define( 'LOGGED_IN_KEY',     'T&t8gRl7^{9E3r_WG88AfG9n7LINB2;z~JPB^LHDAi`!W=vBbHGF1[I.B+cEp0 o' );
define( 'NONCE_KEY',         'n`K1qn8VWs3.5!SYm3psY;U%/@ZN@%Wb!Q/AW4Le2YDZ1@2mlR]IM!:$dJwOBp).' );
define( 'AUTH_SALT',         'pd?qD/1A]WC%_QxC]=@vM6||nRgGKGPFJcN1-bE&o4}6dORj!R5%v ,nnHi{q52&' );
define( 'SECURE_AUTH_SALT',  'WEQ<W^8byI)hqX)WXLq(luctNI4,LYoJY9W#im(q{|us>8/4q5nA.(&vNKRm]XV4' );
define( 'LOGGED_IN_SALT',    '{S1;cU)ulO<BFOBVxU4fc8%o#2J|*0C=M3;&|DjQM%B.3P3r##%nDoE&$jt]Gw>j' );
define( 'NONCE_SALT',        '[)?(`%#4XD2fh#C_..1% hGcocLMDUpaot6}28cAy`wnF#`7*7[[ei#@_SS1,QZ/' );
define( 'WP_CACHE_KEY_SALT', 'oLx4*$`!?`.n7NwiwaC~R~:@qCRTHS2u;$eZJm?%#O2fuNchHzd:IR;xyzA#@`t.' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
