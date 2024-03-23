<?php
define( 'WP_CACHE', false ); // By SiteGround Optimizer

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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'xyzusnad_neonexpress' );

/** Database username */
define( 'DB_USER', 'xyzusnad_neonexpress' );

/** Database password */
define( 'DB_PASSWORD', 'Tango@4231' );

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
define( 'AUTH_KEY',         'dembg!T~dISl#!V#D-[9${O8 T@zozHx9&#Ts-.W.kl{$:abG)poP#RoM,{Mj[N{' );
define( 'SECURE_AUTH_KEY',  '0>u$EU6LYs5egzgu]t; ~B/X@N(v_`X,Mx-r ?f[)I?a5wz.StDG*lhqFXfa :Z2' );
define( 'LOGGED_IN_KEY',    '_:D.eR)Y?&&E6zLN$Z*S5H6fT}yivXHgU{|r[#{=@d3f@(U?dO.mWHFv0-=kw}I~' );
define( 'NONCE_KEY',        'Q~Ur7s&B3}(5EK:$ r#[TrmGGTt|XE:]f=L7f8[S.{PD0bN`GlsZt]pKrRH<jb/`' );
define( 'AUTH_SALT',        'o:pdybv;`D12s.hRPEB7s_YRxhux4:UEYY@4:9}La^.#|{IpHL&h,NdU4rnbyEcx' );
define( 'SECURE_AUTH_SALT', '$G1}7S`@9e8WSSxCyk.|vqN>cT-ywNf5Z8J&&Kh?Wpc$OPqil9lCM,P?x>$gT,uM' );
define( 'LOGGED_IN_SALT',   'KE:2o|m;!5`H5XPUk3$aP2u~.tu~VsOs9hG?COk%rA,#*Q`cF|x|$27`eJR{s44F' );
define( 'NONCE_SALT',       'a{Iz+/V`E(::SJtev}99k*b:6t1DJ~+-.xU<6@Snj*>WUrSH?iB?YLEH^8eJ~)~7' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
