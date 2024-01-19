<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'WooCommerce_developement' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '#2|;.oKG8FMu[bX3:37w8?rc[jK>,=V}OUiq+0|ZnaxC>&ltLoNXWkLFqS, $wJL' );
define( 'SECURE_AUTH_KEY',  'E=BXxhT2xa,8&B6ceKc^~Q5*}|<HL;a_9B+7K4A>5Ekzfl3|;7(#(_fI6v:vNy24' );
define( 'LOGGED_IN_KEY',    't4Gho+x.w`}!pFM.W#[)/I<VO1M{y7$zd 5+^|ZRb~Ktrb)Hj;qzuPOrPU}%VvAz' );
define( 'NONCE_KEY',        'hZ}Rr;M`#*~_OPB@VuSwU*-E0b3|`ut(%H]JC&%p7=139P>Gir(Fy)n+A;q$A:Ss' );
define( 'AUTH_SALT',        'e{{rdL!gotXQ|TDf1c6&UA?8j)Fd<og6W},0Q+yb}wcmnpnNKU]>T <1Rw_zNVSv' );
define( 'SECURE_AUTH_SALT', '+e41n<T-L]A)Fs[pYoEH2*[YN`T@4+&BZJDf>{wZkQ3%@8C R}_nGv?NvPGtRG|B' );
define( 'LOGGED_IN_SALT',   'Q|Np_3MO,>t-$,,GQtX/V/dcwB OKz`-5p`o6&&1c$>l9AdJp$Xa=AERZr4KBBt6' );
define( 'NONCE_SALT',       'YdW?Xt2,)%~<#@4CU0:,:m^8vqX%xu-1dr8MQzXrboWamFiaKHA_U%QOlGu|8_l7' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
