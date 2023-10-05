<?php

/**
 * Load all environment variables for the .env.
 */
$required = [
    # Database
    'DB_NAME', 'DB_USER', 'DB_PASSWORD', 'DB_HOST',
    # Auth unique keys
    'AUTH_KEY', 'AUTH_SALT',
    'SECURE_AUTH_KEY', 'SECURE_AUTH_SALT',
    'LOGGED_IN_KEY', 'LOGGED_IN_SALT',
    'NONCE_KEY', 'NONCE_SALT'
];
if (class_exists('Dotenv\Dotenv') && file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
    
    foreach($required as $req) {
        $dotenv->required([$req]);
    }
}

/**
 *  Database settings
 */
define( 'DB_NAME',      $_ENV['DB_NAME'] );
define( 'DB_USER',      $_ENV['DB_USER'] );
define( 'DB_PASSWORD',  $_ENV['DB_PASSWORD'] );
define( 'DB_HOST',      $_ENV['DB_HOST'] );
define( 'DB_CHARSET',   $_ENV['DB_CHARSET'] ?? 'utf8' );
define( 'DB_COLLATE',   $_ENV['DB_COLLATE'] ?? '' );

/**
 * Authentication unique keys and salts.
 */
define( 'AUTH_KEY',         $_ENV['AUTH_KEY'] );
define( 'SECURE_AUTH_KEY',  $_ENV['SECURE_AUTH_KEY'] );
define( 'LOGGED_IN_KEY',    $_ENV['LOGGED_IN_KEY'] );
define( 'NONCE_KEY',        $_ENV['NONCE_KEY'] );
define( 'AUTH_SALT',        $_ENV['AUTH_SALT'] );
define( 'SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT'] );
define( 'LOGGED_IN_SALT',   $_ENV['LOGGED_IN_SALT'] );
define( 'NONCE_SALT',       $_ENV['NONCE_SALT'] );

/**
 * Database table prefix
 */
$table_prefix = $_ENV['TABLE_PREFIX'] ?? 'wp_';

/**
 * Debugging
 */
define( 'WP_DEBUG', (bool) $_ENV['WP_DEBUG'] ?? false );

/**
 * Server URL & Content directories
 */
$transportLayer = $_ENV['TRANSPORTLAYER'] ?? 'https';
$domain = $_ENV['DOMAIN'];
define( 'WP_SITEURL', "{$transportLayer}://{$domain}/wordpress" );
define( 'WP_HOME',"{$transportLayer}://{$domain}" );
$httpHost = isset($_SERVER['HTTPS_HOST']) ? $_SERVER['HTTPS_HOST'] : $domain;
define( 'WP_CONTENT_DIR', ROOT_PATH . 'wp-content' );
define( 'WP_CONTENT_URL', 'https://' . $httpHost . '/wp-content' );
