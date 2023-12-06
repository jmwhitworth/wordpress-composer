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
 * Tell WordPress we are using themes
 */
define('WP_USE_THEMES', true);

/**
 * Include WordPress
 */
if (!file_exists(ABSPATH . 'wp-blog-header.php')) {
    die('<code>composer install to get started</code>');
}
require_once ABSPATH . 'wp-blog-header.php';
