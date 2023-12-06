<?php

/**
 * Load all environment variables for the .env.
 */
if (class_exists('Dotenv\Dotenv') && file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();

    // Ensures that database values are provided as no sensible default can be given
    $required = ['DB_NAME', 'DB_USER', 'DB_PASSWORD', 'DB_HOST'];    
    foreach($required as $req) {
        $dotenv->required([$req]);
    }
}

/**
 *  Database settings
 */
define( 'DB_NAME',     $_ENV['DB_NAME'] );
define( 'DB_USER',     $_ENV['DB_USER'] );
define( 'DB_PASSWORD', $_ENV['DB_PASSWORD'] );
define( 'DB_HOST',     $_ENV['DB_HOST'] );
define( 'DB_CHARSET',  $_ENV['DB_CHARSET'] ?? 'utf8' );
define( 'DB_COLLATE',  $_ENV['DB_COLLATE'] ?? '' );

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
$domain = $_ENV['DOMAIN'] ?? '';
define( 'WP_HOME',"{$transportLayer}://{$domain}" );
define( 'WP_SITEURL', WP_HOME . "/admin" );
$httpHost = isset($_SERVER['HTTPS_HOST']) ? $_SERVER['HTTPS_HOST'] : $domain;
define( 'WP_CONTENT_DIR', rtrim(PUBLIC_PATH, '/') );
define( 'WP_CONTENT_URL', $transportLayer . '://' . $httpHost );

/**
 * Redis
 */
define( 'WP_REDIS_DISABLED', (bool) $_ENV['WP_REDIS_DISABLED'] ?? false );
define( 'WP_REDIS_CLIENT',          $_ENV['WP_REDIS_CLIENT']   ?? 'predis' );
define( 'WP_REDIS_HOST',            $_ENV['WP_REDIS_HOST']     ?? 'localhost' );
define( 'WP_REDIS_PORT',            $_ENV['WP_REDIS_PORT']     ?? 6379 );
define( 'WP_REDIS_DATABASE',        $_ENV['WP_REDIS_DATABASE'] ?? 0 );
define( 'WP_CACHE',          (bool) $_ENV['WP_CACHE']          ?? true );
define( 'WP_CACHE_KEY_SALT',        $_ENV['WP_CACHE_KEY_SALT'] ?? $domain );

/**
 * S3 Offload Media: https://github.com/humanmade/S3-Uploads
 */
define( 'S3_UPLOADS_BUCKET',     $_ENV['S3_UPLOADS_BUCKET']     ?? '' );
define( 'S3_UPLOADS_REGION',     $_ENV['S3_UPLOADS_REGION']     ?? '' );
define( 'S3_UPLOADS_KEY',        $_ENV['S3_UPLOADS_KEY']        ?? '' );
define( 'S3_UPLOADS_SECRET',     $_ENV['S3_UPLOADS_SECRET']     ?? '' );
define( 'S3_UPLOADS_BUCKET_URL', $_ENV['S3_UPLOADS_BUCKET_URL'] ?? '' );

/**
 * If using R2 instead of S3
 */
if (isset($_ENV['S3_UPLOADS_ENDPOINT'])) {
    define("S3_UPLOADS_ENDPOINT", $_ENV['S3_UPLOADS_ENDPOINT']);
}
if (isset($_ENV['S3_UPLOADS_OBJECT_ACL'])) {
    define("S3_UPLOADS_OBJECT_ACL", $_ENV['S3_UPLOADS_OBJECT_ACL']);
}

/**
 * Disable file editing by WordPress admin pages
 * Plugin/theme installation or editing the theme
 */
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);

/**
 * The number of revisions to keep for all supporting post types
 */
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', $_ENV['WP_POST_REVISIONS'] ?? 5);
}

/**
 * How many days to wait until the trash is emptied
 */
if (!defined('EMPTY_TRASH_DAYS')) {
    define('EMPTY_TRASH_DAYS', $_ENV['EMPTY_TRASH_DAYS'] ?? 14);
}

/**
 * Disable the WP Cron
 */
if (!defined('DISABLE_WP_CRON')) {
    define('DISABLE_WP_CRON', $_ENV['DISABLE_WP_CRON'] ?? false);
}

/**
 * When upgrading WordPress stops the inclusion of themes and plugins
 */
if (!defined('CORE_UPGRADE_SKIP_NEW_BUNDLED')) {
    define('CORE_UPGRADE_SKIP_NEW_BUNDLED', true);
}

/**
 * Disable all WordPress auto updates
 */
if (!defined('AUTOMATIC_UPDATER_DISABLED')) {
    define('AUTOMATIC_UPDATER_DISABLED', true);
}

/**
 * SMTP email settings
 */
define( 'SMTP_username', $_ENV['SMTP_username'] ?? '' );
define( 'SMTP_password', $_ENV['SMTP_password'] ?? '' );
define( 'SMTP_server',   $_ENV['SMTP_server']   ?? '' );
define( 'SMTP_FROM',     $_ENV['SMTP_FROM']     ?? '' );
define( 'SMTP_NAME',     $_ENV['SMTP_NAME']     ?? '' );
define( 'SMTP_PORT',     $_ENV['SMTP_PORT']     ?? '' );
define( 'SMTP_SECURE',   $_ENV['SMTP_SECURE']   ?? '' );
define( 'SMTP_AUTH',     $_ENV['SMTP_AUTH']     ?? '' );
define( 'SMTP_DEBUG',    $_ENV['SMTP_DEBUG']    ?? 1 );
