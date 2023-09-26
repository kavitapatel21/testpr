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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'testpr' );

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

define( 'WP_POST_REVISIONS', TRUE);
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
define( 'AUTH_KEY',         'z^LUF935;5iE}G)AuY-K9<>?4Mxm;uZj$<qDDCr|r7;=75M2E_<ffI0f/`{F-mGA' );
define( 'SECURE_AUTH_KEY',  '3?I9`BH(1r+^z@p8I9s;/#i%.QpU?Y3)YGU3UKVlxs_.d$;gdFiMsAW&:(2mPo4z' );
define( 'LOGGED_IN_KEY',    '9pf21Mcw3Cp|m19+sd&?Il%T!`G Pw@mk>uiEI%.(u(pfp#VN>pxxp*JBnhlF#30' );
define( 'NONCE_KEY',        'f``:RD|/ [N$86vR8S =yu6^|&a&Ff,s^o{;*~NO5MUA;#A/Pn~,T-_b{AXiZ?z}' );
define( 'AUTH_SALT',        '>p/ a7@dh:}/t+6dz=BD^kg7[@.a`zv#lO,<veI>Mx4d($x=WeF2uzlCPu.>W$@}' );
define( 'SECURE_AUTH_SALT', '<z4{ld7oZq3,3!b uy)&_LL9-E5:b;fC9 xPSu@4Sfk(LqXnYO.,,t!X;9(a0W`J' );
define( 'LOGGED_IN_SALT',   'r5o3YSP,)6Qi1>]d{2hYCu>hS`J|AO=xfo6GIh%9VhP&}<I)3(y(,4BfhK^kH$ H' );
define( 'NONCE_SALT',       'O=cE*-./8?}}4,Zom.636HSTfW0]fGMO^X*BQNOUg8.Sw7X|]MK1d.oF5N#cY3$;' );

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


 //define( 'WP_DEBUG', true );
 //define( 'WP_DEBUG_LOG', true );
 //define( 'WP_DEBUG_DISPLAY', false );

define( 'WP_DEBUG', false );
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG_DISPLAY', false);

/**JWT authentication START */
//define('JWT_AUTH_SECRET_KEY', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3Rlc3RwciIsImlhdCI6MTY5MDk4MDE3NSwibmJmIjoxNjkwOTgwMTc1LCJleHAiOjE2OTE1ODQ5NzUsImRhdGEiOnsidXNlciI6eyJpZCI6IjEifX19.D7DzcWDrcLz1SClz1GyE4xh17BWs8VAyDWTc3rhlZ0g');
//define('JWT_AUTH_CORS_ENABLE', true);
/**JWT authentication END */

/* Add any custom values between this line and the "stop editing" line. */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';


/**.env file code [Start] */
require_once ABSPATH . '/dotenv.php';
define('custom_var', 'hello you got the value');
/**.env file code [End] */