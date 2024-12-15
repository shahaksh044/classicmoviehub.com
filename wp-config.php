<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'classic_cmh' );

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
define( 'AUTH_KEY',         '@+hJ(AO3z9o2{Wu&KD+P+O/C!Av+y<jvODTc7&~x_=Ft/mpO8!Nf0`!m.kgS$5|?' );
define( 'SECURE_AUTH_KEY',  'mGwtm2@2?L;qa,Q>XNB3-g%_fmmq@P<Or-el?-Xzq^U-dekTu fh2o<f8;Qx?Zhl' );
define( 'LOGGED_IN_KEY',    'NoEL3F]G[|=U04z9bdJmkA.@$2_g*fk1.JYy!($2{Q`{[Fb81%$u0CmV,p2A=e|M' );
define( 'NONCE_KEY',        'jl[0iK.5l )y&l}KC2g yMnv:nirD3$Q7*9<cF[M?+Pf8h9erA3_t`)8-aS=n2b!' );
define( 'AUTH_SALT',        'Q/~X+W$,e+=V#~.7F$6s{*@HKdpDZ}_H6kNzce)R?S^am4wSb3F,=7A[9,G)kSHn' );
define( 'SECURE_AUTH_SALT', 'OCL[H+SLQUCunZy0f<O]l#/6L80oYv34tf9/?G#]Bs;nd0df&d8?x2SgMifqXQA/' );
define( 'LOGGED_IN_SALT',   '}W24>n&U>6|nbZr~x36asPrVjbeJ0{r;&=7JhlGqE`(G=L6YN{w89HIoC)kzqq6.' );
define( 'NONCE_SALT',       'qw^h7ZDtU+Fr?|Up.I/OvYR?qh95bd OjS^tA#P:VE~ocD.Gh|%~+e_9 p/+3[fk' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'agatti_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
//define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false); // Logs are written to wp-content/debug.log


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
