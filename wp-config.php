<?php

/** Define root path */
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', __DIR__ . '/');
}

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') ) {
    define('ABSPATH', ROOT_PATH . 'wordpress');
}

/** Load in all vendor packages */
require ROOT_PATH . 'vendor/autoload.php';

/** Load configuration for current environment */
require ROOT_PATH . 'config/app.php';

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
