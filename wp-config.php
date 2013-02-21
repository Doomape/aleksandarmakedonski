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
define('DB_NAME', 'aleksandarmakedonski');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'N0Cqw&A$Tprk:l12r/2~_16|ik17hv&zLk*$pFXAW f?(JbXv[NI<>SYST9=0ydm');
define('SECURE_AUTH_KEY',  'DH671}6Ll2Ag7/QaTkoBAj=nzwVF.hl^qm{iI@-8zH*}.N~x?8hMj=@)Fu3RakJ3');
define('LOGGED_IN_KEY',    'r%=+ wu+)woAHB1|kAopa[!B=T+LKwbcOH]Rdc.m0i 8vEX9Nb6<sq}E%.SWNO O');
define('NONCE_KEY',        'nsUKt0tn;(u{TaD)Df6-fJntI1tE^=75RY4!S1!&0sRB Y]C@c&}0M@gXsphgT*s');
define('AUTH_SALT',        'Nm-ChHE*j?96HAF{byL%0vh+]fo4T]%sKc mf^3Zpp97 0+lWd}Q9c3YROV;=|kL');
define('SECURE_AUTH_SALT', '{n2QuOYbZphqu)s .+EZg@N*zO:]1@_b=&-}E*c~}XhG<2*n.Kr.l,}Kx#W`8<Ez');
define('LOGGED_IN_SALT',   '6NTu!+ad)tG,^sGEswbJ9d 9mF!rm/LN@/(,mm:@jC,U3~sHj}KSla-A}Pz&MO6(');
define('NONCE_SALT',       ',%}`zLy_H_:s>HqVg%Q8nV2O.vlgU{+OjZN(SCd` fEHdF!:>Ym@thY|7} z2{vZ');

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
