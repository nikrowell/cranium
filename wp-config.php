<?php

require 'env.php';

$table_prefix = env('DB_PREFIX', 'wp_');

if (env('WP_HOME') && env('WP_SITEURL')) {
    define('WP_HOME', env('WP_HOME'));
    define('WP_SITEURL', env('WP_SITEURL'));
}

define('DB_HOST', env('DB_HOST', 'localhost'));
define('DB_NAME', env('DB_NAME'));
define('DB_USER', env('DB_USER'));
define('DB_PASSWORD', env('DB_PASSWORD'));
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('ABSPATH', dirname(__FILE__).'/');
define('WP_POST_REVISIONS', false);
define('AUTOSAVE_INTERVAL', 86400);
define('DISALLOW_FILE_EDIT', true);
define('EMPTY_TRASH_DAYS', 30);

define('WP_DEBUG', env('WP_DEBUG', false));
define('WP_DEBUG_LOG', env('WP_DEBUG_LOG', false));
define('WP_DEBUG_DISPLAY', env('WP_DEBUG_DISPLAY', false));

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link  WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */

define('AUTH_KEY',         'XyrI)4^~M`~yApQQ p2MKkD}xKxmmwdW>Fj(e cdh02xby+L{ c (jlkJNH@be4U');
define('SECURE_AUTH_KEY',  'XKwx, 4K M+-+Vww;l)Ss8-!|E..se*;K-oBICq-dH|?(!pB+xvpoKB}1g3Zfxy+');
define('LOGGED_IN_KEY',    '@/#Bg (Z,JY,rK}PfJ`a[i,4&]_Et`|?7}r6a2PU*>e41/O?O)G}1EEv5RH ~^4<');
define('NONCE_KEY',        '5?V|Db/iX]-[z1fgWG|`Vb[$=Kekuao52>Knc<qv3:mp2Wy;tstI=1sRm3$ojp?v');
define('AUTH_SALT',        'zZ#cN.j a8kEAzb/pbWNEyb-s.gi*rH^8Q`r6e+9}G~wHo+1l=z}tj94tjnf]tCJ');
define('SECURE_AUTH_SALT', 'qp$|F=Rni/`$Gc5c<|>4-YH4(_O7-^Z/hC53 6##vAB-h{/PP-)/u}/)mxj6*}~)');
define('LOGGED_IN_SALT',   'ff6D|!wLh0> (|X$CHjHpy|o-Jhu =iaM4*x[kf&Y+7(^+B#0 _,fIxH:_~~j!Ox');
define('NONCE_SALT',       '2|%5u||HqEL}b?J/92AAZJ!VabkPPO,(|s/&2Tv_xIM+3*7^Q`cP!|S#PmpY(q+A');

require_once(ABSPATH.'wp-settings.php');