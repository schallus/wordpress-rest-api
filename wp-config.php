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
$url = parse_url(getenv('DATABASE_URL') ? getenv('DATABASE_URL') : getenv('CLEARDB_DATABASE_URL'));

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', trim($url['path'], '/')); // wordpress_db

/** MySQL database username */
define('DB_USER', $url['user']); // root

/** MySQL database password */
define('DB_PASSWORD', $url['pass']); // ''

/** MySQL hostname */
define('DB_HOST', $url['host']); // localhost

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
define('AUTH_KEY',         getenv('AUTH_KEY')); // 'V4I/+k?]xUW[tQU|V$m-+m/<GzO(Mx%w`i]b3rl514B!H[3v=X$2O-<>~&|SRFd['
define('SECURE_AUTH_KEY',  getenv('SECURE_AUTH_KEY')); // '^jQZ5m6`6YZI]<^DcM2s^QB9T7-rl wvKia?le{2UkF*g)Lwu;4z8T;8S@[:9Qr '
define('LOGGED_IN_KEY',    getenv('LOGGED_IN_KEY')); // 'RMh:>iH6tPB6?I3->SkYT[^D5p,dYAPLOR=cW>Kn`{n~aXY$+Bi*lw[*SeeDwq?0'
define('NONCE_KEY',        getenv('NONCE_KEY')); // 'OMC+Q8(gJCQUQ3>&n<.E:Ak|p:P3N}-OT3~(LNl$& 2^u2g(}CnZkhVS(!mjv =<'
define('AUTH_SALT',        getenv('AUTH_SALT')); // 'xsKYrTS8<MZpfwN{GH_w!x1SxCR1werTd?2SQoAD?Zbc[_H?j!-5RVL|m+a*]33o'
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT')); // '&,?4ZQ##Itx1:slVHam;lQd]8UFu-e*)I*eQiO<U:eYi?RaN1G)3m`4i<%kWnnUF'
define('LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT')); // 'XS>o_Rp{WlB:5ZQ**gufu-B$&bc2;pOBs%$[7?Zi$tl]$;6fl.EYrFGU5?!Fl5.D'
define('NONCE_SALT',       getenv('NONCE_SALT')); // 'vPT;*8X2!P]2|ZcwQEFHFBn):WbcO(O;L7QNqGq8xBp@DE}!XFPfvveQK6VkOnM2'

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
