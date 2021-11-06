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
define( 'DB_NAME', 'bd_silueta' );

/** MySQL database username */
define( 'DB_USER', 'user_silueta' );

/** MySQL database password */
define( 'DB_PASSWORD', '8taK6wrHo11?4' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'sz0m0b96dammigddrx780zji4j61hm2jro84lniwlj4mrrte1kojopuoma3iodbw' );
define( 'SECURE_AUTH_KEY',  'mupzuyiyonbaqqejudfikrswji7qivxljkhewiza03ifip59cpf1w7zirjc8spvo' );
define( 'LOGGED_IN_KEY',    'bpstzyt1tbtilcqhvjmoqivmmpmqdbhvw1qscw5rz6m2axc9aen3vz1fxb4nchtv' );
define( 'NONCE_KEY',        '8rfgpo5gf9irmhx12tvsh9dkkp2qica7julhrlzaev7d0shsekpr1d5ikej0fepm' );
define( 'AUTH_SALT',        'vj4inur5gjdzx57wdaaimt0mhbhmuqn90mxj6p8ltqagicxfwr7muzyhwouvbrsk' );
define( 'SECURE_AUTH_SALT', 'eqba5tep8fpw59y0zo5dqpod7kxad9bcyai4mywk2r64ajfdpzyq3qycr6rot5jn' );
define( 'LOGGED_IN_SALT',   '8caenst47d6orv9gcmnufqjhrn2ireirsemfvbexemhcb17oia9cxlcuponyrsvs' );
define( 'NONCE_SALT',       '9znpkoil6nee6wmb8amnupafxjehocdudy1qfu5kw1co6glufdfvgqgcslhmxxlq' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpdh_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
