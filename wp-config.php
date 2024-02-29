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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'stadiumsco' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'IPs&2Z+x5FSsk|,}TSOe~:gbQPFGCT*M-zqMKTYLu#-2c9v_)bGf.C720B9%MdVE' );
define( 'SECURE_AUTH_KEY',   'Ydk_wF;F-fj[[Ex^jTx_{?x> I5jf^/.6U887:pAt,4~NbKJ$%;~Am4vK)YK]SP8' );
define( 'LOGGED_IN_KEY',     'lvuo~#-~*#fvC+>^Y#l^J#!/)]$l8Ah3l]:ME2$:PlcmZ#Z&O.#6_qYo!M+l7%&f' );
define( 'NONCE_KEY',         '4UG|x/L_lsiu@&H^$lu8w#c*8:XF]mE(.1w.]Ib1Q)h<W;gC6,eWN~U+jG;1)Kd?' );
define( 'AUTH_SALT',         'QZ7saVT{wuJ@6x.tv$unY[lp`v+/7FK[]48wj;;O9|ZbyIP_j5]q3a`+qC]t[A}C' );
define( 'SECURE_AUTH_SALT',  'e<l _.$7>Xj}uq6$voruOp1=ug5V43 [r;fv0hGhzU+SMx[cg@(YU?!Jz;6jTz;I' );
define( 'LOGGED_IN_SALT',    'UQaR^]B>Y71LOC#~9=YMNMw-[oM@^b}$&4CsCDH,;%]EgjE-ti/)h/w7hw$8k`Jw' );
define( 'NONCE_SALT',        'MYjgR(3iY$m~(QTZ+Ax[KW(1nez(l4uJQmOA^pJf0-rw.*]!(?Cd3&-Mx1h]zYG3' );
define( 'WP_CACHE_KEY_SALT', '?aP[!f9WA%cWs>jcSC13NZ v#)rpG3)MAe=~$b@JmK}s4}Y5/u1OSbiE6<e#0!t[' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', true );
}

define( 'FS_METHOD', 'direct' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
