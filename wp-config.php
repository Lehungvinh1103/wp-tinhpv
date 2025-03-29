<?php
define( 'WP_CACHE', true );


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
define('DB_NAME', 'wp_test');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', 'vinhlh');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         'M-pRhD-<(4@d_u-&:]Fo+-V9O>]x._y:Bao~qT>7hUhjl*GH<t*z2^D$EUS4%q)N');
define('SECURE_AUTH_KEY',  'CCOJoP2*Z1$X+9tKvIMO1||h6f`iK_OECef@oQPQN!OK$Jl;]8.9{.j@7a90,*})');
define('LOGGED_IN_KEY',    'Icf$C7h`Qs:<:Uzyo<Q$w:-TNb1vH}jHWyrWL{zJYu[^A,&}y4sWn%<G;[bODCo7');
define('NONCE_KEY',        '*SI;nEm)UE/r;<]yu8rjVnu%dKa=#^r+Z)}_!Q_WmBtm dRC,DLAj{xDM1m_4GhB');
define('AUTH_SALT',        '(MDJ2D! V3Q5KmiT3Fl:{^{z3dud^m]_$Y2KstQ9f=AMk%K!p:+A=<o@8L5lOq&M');
define('SECURE_AUTH_SALT', ',%%5mc6^AN>ejxCvCJ.FiC$2Qpm1-3/UQ)jq2N+.6QC4lioL><{%5#MW6lVyz6;{');
define('LOGGED_IN_SALT',   '=IWG%+rU9DJnoN^*H@LMs(=@|_!%ArF08m(@~-QuRS2k9t86J~>6=qa4V9[~GxKa');
define('NONCE_SALT',       'L_iV&2fJ?83JcL9Y{Z ?&rr}7@spUXAfm?~X 6n2&&frL B7/b`=&>2{sH3(E%.B');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'sskkawp_';

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
define('WP_DEBUG', true);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
