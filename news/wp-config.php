<?php
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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'trigonic_news');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '=JA[NWwd(EL=(Sj/J@N/Fh6rCcj/p]RI<qY16YOo1%Y?ASs4QCv(L,g!r {b^rst');
define('SECURE_AUTH_KEY',  '3l4,-=uR*@#NE4w,whE 0.YsJ-(m,Laf8sX;.CPD!e1-}}I[AVJ=}RrW3^*Y8|or');
define('LOGGED_IN_KEY',    'bE})@@,9?/]Y.b{Drz,RPV?dPgQflgb)$U,OXq3Z(+y29p>)[!!;qs(ydmg3xy]#');
define('NONCE_KEY',        'hP38(~&.~1_7+YZmAuvD{sd!0VV_nd4<U9f&d8Skx-;`PRo(r3!7$-{EnEr]{3?^');
define('AUTH_SALT',        '?a$L7?tf#wr9({W9K&`+0(%Y1;v%qbT j9N 9xR;273<_r-/-aC!!Hj=wMh=%SC}');
define('SECURE_AUTH_SALT', 'B36S!U|b[ G#ipDL Vi{*e/3(QGL:Dzj0Ol|c+;C=rs[pe$G{6]V(a>sy)3Z,G~4');
define('LOGGED_IN_SALT',   '$wI<q-^)OCM!#;]sqQ2;5qYZM,hl|>j_fv)z~pq7VYJ;LWXFD-83{GON`uJQ:H.B');
define('NONCE_SALT',       '(muwXGQ_MR6/v`eC)^u</l@rkKq-+1!|Z3qkL@fuk8zYq/7:V[>lXq3<9K=Zh3n`');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
