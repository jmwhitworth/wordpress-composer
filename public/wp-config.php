<?php

/**
 * Define root path
 */
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', __DIR__ . '/../');
}

/**
 * Define root path
 */
if (!defined('PUBLIC_PATH')) {
    define('PUBLIC_PATH', __DIR__ . '/');
}

/**
 * Define path to WordPress
 */
if (!defined('ABSPATH')) {
    define('ABSPATH', PUBLIC_PATH . 'admin/');
}

/**
 * Include the dependencies form Composer
 */
require ROOT_PATH . 'vendor/autoload.php';

/**
 * Include the configuration for the current environment
 */
require ROOT_PATH . 'config/app.php';

/**
 * Load WordPress
 */
require_once ABSPATH . 'wp-settings.php';

/**
 * Settings requires WordPress to be available.
 */
require_once ROOT_PATH . 'config/settings.php';