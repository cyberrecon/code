<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'onemanops');

/** MySQL database username */
define('DB_USER', 'chrisd');

/** MySQL database password */
define('DB_PASSWORD', 'happinessis420;');

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
define('AUTH_KEY',         '/ki78xYy2YLJqw04[x9UpD$&8GHu&qaVsC-v_``/4[q(>9Wc/m *DBh6GB-R3+,G');
define('SECURE_AUTH_KEY',  '%cCzFg?8-|<79}d%ah% Vu6/.jq{{OyRE`|){TZl}l?6GrQ1-p6U:JSt%/]R]/R@');
define('LOGGED_IN_KEY',    '[6#:Q[npY`LS?*>`s.};2jg#p&@Y9{yvJa| @]:[YrCS ?7p*_TJ:b(4z%Wq3?0F');
define('NONCE_KEY',        '2iN,(W|i| -Y>}O_#<~`@j5 G|SK<o++1mi=(| %I-V?!?<&d[&,aMas+G(?.e:M');
define('AUTH_SALT',        '6cg:|;|s+i}+tva~sOarv+!}z7NOXMDGnm/F2rt-31+WAsqgatD(b_;J~?a>M#!@');
define('SECURE_AUTH_SALT', '22l[+hd-m[h>&W_)),GVJSFejb2FmE@i@7oz+I3(eDs~)pd{t_35biM^xnB92/^n');
define('LOGGED_IN_SALT',   '~X_gDn~h{Dp7e;AtM,W0%B}_K^QE~,^5{micZ(EyU%-25SY5*&&HQC1V-N`Yqvw^');
define('NONCE_SALT',       'tbyg`SxDK3&(O!:q>Z1J3WlEs;8U|KFC9o[6{VQKVlN2By3(|fclv=8y]F-pzc)C');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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


