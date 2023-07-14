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
define( 'DB_NAME', 'mysite' );

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
define( 'AUTH_KEY',         '6[NI)`iAAt]?|T&Bk-3%c:%PLv&XB:?DE?G5QeyN;(f7HWV,sXWpx|J4na$3X1J`' );
define( 'SECURE_AUTH_KEY',  'vJkfa&U!p~Sv@caNxw*sCEq(-kSrh^k`4E ]o{79!t*Nuc.- LskXKDN;/:Kr`f#' );
define( 'LOGGED_IN_KEY',    'k:N>>#.M0TK~8E[cnJ7_zr.ya-28H4%:O1RXA@f!60holPJMoiTL+3o.RK6N(6>y' );
define( 'NONCE_KEY',        '{](>X:!aAg{Z5upV}4INdc{AF)2p,qr}}3;[Va^:o:#]/_}DEygXe1ug_ouQPUDR' );
define( 'AUTH_SALT',        'ySM3-xqo%HGJ)Ff4Fpc`MRdz=0D/B)t:T%P<17JM$rY z6*PA;z(D!)ib:_j}{nk' );
define( 'SECURE_AUTH_SALT', 'R=hQV#45pgIyvmf+;{>fTK7r|>I>)NGxi;;p+Kb1}!|W:Z@;X)a.`-(0ob@ p]y7' );
define( 'LOGGED_IN_SALT',   '8{/f&R*{XJ_4Xm#$6__wS[vhEH5$B10T&Vthju!zANqhPSH]&1?rv%jKtqy[r]u#' );
define( 'NONCE_SALT',       ',79&;{6TCVG*y9QE:I*se&waG@CtQj([h0fn(Z}bC=@Lq WDsq)Vh-W<Fr@h5i:B' );

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
