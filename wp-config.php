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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',          'tO^?[:2fuC,DIq<^2i[P{r1It YL%t-;iMICNY0mMHKeQDSR~@7-}r81@8v67vbQ' );
define( 'SECURE_AUTH_KEY',   'fvTy&=hWh6}AN/S<4-_?[oH!=]U[rI<-dr-Wy0Z<_#f |H%a5SnU(|4X?D4#5`C|' );
define( 'LOGGED_IN_KEY',     ' .*M+wU:9E`{tB<Xc{Uaf.r7S 85Gng0M+ZkR-.PNu)nH2RdPJoO-@cY49!Yev+~' );
define( 'NONCE_KEY',         'L|+ $0-Q~6f|whhI6Gd^R} #bTB<s;l^)s*(Z3_&,0 ag=!2tslu*3@=w!-<>eF:' );
define( 'AUTH_SALT',         'eE{2@0.N%`@oiNF.SLmTrD4gA)Z4;&|h*kr{25/W?N.D~&yV/i/:h=@m}<H<p@1`' );
define( 'SECURE_AUTH_SALT',  'ofhLYZuIMs1H+w_6=l[gvZ@ipu7+a|rYu,{u+uf^m11>Q)=sZUn)VEbN2YfRg`mB' );
define( 'LOGGED_IN_SALT',    '6C>E^#)G/tnNE8MOe/6GyYa4QXxcG*=).v IF ;o7QF5/7Hck>:Zr[(TkK+802NV' );
define( 'NONCE_SALT',        '% Cm=b&q+gicx:>472i`AS!3qPz/iJ0O/%hib#,l{z ;XB<.+82x_t=YWi-Iu_KR' );
define( 'WP_CACHE_KEY_SALT', ' pANpax~Y8OT%5uH(`0zpGh&ii#%XWTG>Qx~%84HWZ&Ndrko;(}r:DOm01DvIR2!' );


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
	define( 'WP_DEBUG_LOG', true );
	define( 'WP_DEBUG_DISPLAY', true );
	@ini_set( 'display_errors', 1 );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
