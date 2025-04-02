<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define( 'DB_NAME', 'wordpress-training' );

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
define( 'AUTH_KEY',         's84Fhle. !Q3$+IEQM3A&JcKk4;8Wbti.}Pj/zDpZ@=$[:W5EtBHu>9R3o*Rk_Wr' );
define( 'SECURE_AUTH_KEY',  'RIb. o3G.=.OSwLdqvP^|H$jlj;k_FvpG~)[uzC7<m]Ub<*!<Y!x@}0jHXc2Z](!' );
define( 'LOGGED_IN_KEY',    '#Y3[N.PI{yYuc{|Ln3Q{3q<xR89ZL) 5TkbcoQZ4t3p+7+5E^eBt9p=GvI;lb297' );
define( 'NONCE_KEY',        '%fI4GU*xD;;1kppO>:(X/R4)*0)<:!le1uTC#5(IAy>IUcQM~J?xHj4Ovp1Z?@1U' );
define( 'AUTH_SALT',        'r{<l+?M3;jdB-};6L-cMU[b:yHGCPMM&0wg.2FFR#<Gg(p=:_9c3*# uzF+}5)XO' );
define( 'SECURE_AUTH_SALT', 'd*6F(U!^5TD)~VUbQy~!3n]A7{[(jt#&A$j98[}T0nZDO=g~JEyBPbF51BNB5)kN' );
define( 'LOGGED_IN_SALT',   'Vo0pZ:*2NR[`sDxtb}D}uk%pPvs{>6T2$ofo5E&LKt(&fO=Ry}v1g`p)mDU>IpFx' );
define( 'NONCE_SALT',       'yC:@WJCwjs[)eUtH[6>l7h=g7Uv2rPf{k=.aW>N.AHFRC)Veq+t *|L[a{18yf7N' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
