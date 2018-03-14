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
define('DB_NAME', 'wordpress_db');

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
define('AUTH_KEY',         'dx?-@HiLw`b65gR8s/1% |Cpbv9H&BaFA}:Jeu<yd}Jfb_:l{YzhMy0|GyYd%`WG');
define('SECURE_AUTH_KEY',  'W!IZ]F>FkZHrmC%1*$A|TC|Avc<QQCes!u8ugVu3m_r! 5E:?QeFO>3q`}ItU7KS');
define('LOGGED_IN_KEY',    'M8h#!h5)2?1,)mu0A-[pH:$1t:e3q0c7:4nU0/ |4nPAh=ck=YKfDxl))0f`*{%m');
define('NONCE_KEY',        'OxCahf5+v6:>=<>iYmOB.[P;uo5m<Ir_<*9UG&6(6LXgIq*ssB~mb|ZQ24;1tEIZ');
define('AUTH_SALT',        '&jwanTY:3G+}k ,uW+IQSAa+j#.x8{11fjUR4exyo8+l<tsYrccf1@~*EGI*^-_+');
define('SECURE_AUTH_SALT', 'L$V<3BVB=`~wopgVgxeQy6:a/,m&^lC%6Y7GCqvL>E>QACO&z68w;xunW2T/n17`');
define('LOGGED_IN_SALT',   's-3%3QT09`19:(5KcM[z4,|QTIip@Vh(A~F%w$sd9BZW!v(5F@Yv-D)vrK*9;C-4');
define('NONCE_SALT',       'ZoE$=!4H<*BoG?<o=5,w(&R(!lB}cFR0QiXdU8tWJ4OUUQc|bH?3?69fEx!4>>IU');

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
