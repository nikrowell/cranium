<?php

/**
 * The base configurations of the WordPress.
 * @package WordPress
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file has been modified to allow for environment-specific settings
 * via an $env array where each key/value becomes a constant name/value.
 *
 *     $env['MY_CONSTANT_NAME'] = 'The constant value';
 *
 *     ... will be processed as ...
 *
 *     define('MY_CONSTANT_NAME', 'The constant value');
 *
 * Settings in this file should typically be the default production values.
 * To change these defaults, create a wp-config-local.php file and override any
 * $env['MY_CONSTANT_NAME'] with environment-specific values, and be sure
 * to ignore this overrides file in the repository.
 */

$env = array();
$env_overrides = 'wp-config-local.php';

// Database
$env['DB_HOST'] = 'TODO';
$env['DB_NAME'] = 'TODO';
$env['DB_USER'] = 'TODO';
$env['DB_PASSWORD'] = 'TODO';
$env['DB_CHARSET'] = 'utf8';
$env['DB_COLLATE'] = '';

// WordPress
$env['WP_DEBUG'] = false;
$env['WP_POST_REVISIONS'] = false;
$env['AUTOSAVE_INTERVAL'] = 86400;
$env['DISALLOW_FILE_EDIT'] = true;
$env['EMPTY_TRASH_DAYS'] = 30;

// Theme
$git_commit = trim((file_exists('./.git/refs/heads/master')) ? file_get_contents('./.git/refs/heads/master') : '');
$env['GIT_COMMIT'] = substr($git_commit, 0, 8);

if (file_exists(__DIR__.'/'.$env_overrides)) {
	require(__DIR__.'/'.$env_overrides);
}

foreach ($env as $name => $value) {
	if (is_array($value)) {
		$value = serialize($value);
	}
	if (!define($name, $value)) {
		exit('Error defining "'.$name.'" $env constant');
	}
}

unset($env, $env_overrides);

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */

// TODO: $table_prefix  = 'wp_';

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 */

define('AUTH_KEY',         'FE=r5G(_u).m:F0Z9 Sq]bA7ClA6RRE^00j%SE>EKyr(}#A|2hGKz|==+ThQRREQ');
define('SECURE_AUTH_KEY',  '`;/ELb/$#=~S!F{AhZXXvt0xkf|:(vp4/vxc a#}-4zu$06qikf9p,Z$:^t2Tt#s');
define('LOGGED_IN_KEY',    ',tQmQ;c|=hsof3!P:^%8cUh. }B+LKLh0naFXF&+$fnj~UR3YrKCRxH:3?)Nb$p^');
define('NONCE_KEY',        'gP:(![ry{ub{`g+$jkjLX&c/enDlJuMG:m]%iS-@W_fP^akt_CkqNdWKrr/xP|+^');
define('AUTH_SALT',        '-%K9t?Rr3>s,aX*|y:M^bV0LJjBWIQs!P%w/P+AXvGYz0e2)(DfS3^jG=MN;]Ni^');
define('SECURE_AUTH_SALT', 'Lbi.hpW[`@awUB.~3+ouC#1];lKoHohSwHlSm>&;T=[r.SRjHRL7|&eM#MZ 45hN');
define('LOGGED_IN_SALT',   '!E+iz5eEWt2=g=[DRZbdJieK4#+@K^y4EF@2*)W#N:w;]_Mq~KJb{.YGneop|1iX');
define('NONCE_SALT',       'Nu#tF@JtGd6Uj!+lD|M+0?G-I|DN5VF!59VrB8kea8%wnNmkz3!@|loMm(+!*Mts');

if (!defined('ABSPATH')) {
	define('ABSPATH', dirname(__FILE__) . '/');
}

require_once(ABSPATH . 'wp-settings.php');