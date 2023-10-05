<?php

/** Tells WordPress to load the WordPress theme and output it */
define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template, ensuring composer install has been ran */
if (!file_exists(__DIR__ . '/wordpress/wp-blog-header.php')) {
    die('<p>Run \'composer install\' to get started.</p>');
}
require_once __DIR__ . '/wordpress/wp-blog-header.php';
