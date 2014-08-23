<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'FhSIMbw4UO');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'Gg C3kVff;|$48S<@-U>oe-z|A6T3m1>+A!:Ib*Hbs7+}JJ%;6rs|3|(9!<*IaBM');
define('SECURE_AUTH_KEY',  'fwo3nu5@9s =)EExOn,CmWgSLayUDz{Z,>LV_N+Gd!VtwyU8+fuXp*RjYu  mUq(');
define('LOGGED_IN_KEY',    'e{;acgq:$Wi6:q8sjzhftngMJaNS)4;9k8;{[%Mv9oLO )cz,hzjbYjBRsz]yp|e');
define('NONCE_KEY',        'q|=&`+%a#6{<;)z><xWW|_o:F}u1o1>3F,Os,;q?8-cr-,U}[`iMj-U^N@=0879%');
define('AUTH_SALT',        'me-9g*)m46`eniPIwz4u?-?WzQ<M]:-X4J~N4+vkzM-*DrYu{CC+-~R6r%GbL8a:');
define('SECURE_AUTH_SALT', '^F>QSr/_v7&3Tq}0-G|:lO9FdTm7!-[|F+>ev_|g8Qw!oGHUbA<(>xX/Pq:1aD(1');
define('LOGGED_IN_SALT',   'N@-<O^?OyWQO1P-{30ZhRbe4iBz1`P@H[E|#&kJ`wh$ne|+]zT-L(YSS[->C+NoR');
define('NONCE_SALT',       '9_.$9ZBY*]w(/TZC6i>PoX6l73X(&rKx%![O6rkw}C){e|hT+vIJ?U#t3}bJK_i+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
