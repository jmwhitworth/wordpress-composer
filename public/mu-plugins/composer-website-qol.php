<?php

/*
Plugin Name: Composer Website Quality of Life
Description: Tweaks WordPress to work nice as a Composer deployment, surpressing warnings and hiding irrelevant menus.
Author: Jack Whitworth
Version: 1.0.0
Author URI: https://jackwhitworth.com
*/

namespace ComposerQOL;


if ( !function_exists('\ComposerQOL\customDisableSiteHealthTests') ) {
    /**
     * Disables site health warnings that aren't relevant to a Composer based deployment
     * @param array: $tests
     * @return array
     */
    function customDisableSiteHealthTests( array $tests ): array
    {
        unset($tests['direct']['theme_version']);
        unset($tests['direct']['plugin_version']);
        unset($tests['async']['background_updates']);
        return $tests;
    }
}
add_filter('site_status_tests', '\ComposerQOL\customDisableSiteHealthTests');


if (!function_exists('\ComposerQOL\cleanUpAdminHead')) {
    /**
     * Clean up wp core functions that execute during admin_head
     */
    function cleanUpAdminHead(): void
    {
        remove_action('admin_notices', 'update_nag', 3);
    }
    add_action( 'admin_head', '\ComposerQOL\cleanUpAdminHead', 1 );
}


if ( !function_exists('\ComposerQOL\allowRedisFileEditing') ) {
    /**
     * Allows file modifications for Redis
     */
    function allowRedisFileEditing( $allow_file_mod, $context )
    {
        if ( in_array($context, ['object_cache_dropin'])) {
            return true;
        }
        return $allow_file_mod;
    }
}
\add_filter( 'file_mod_allowed', '\ComposerQOL\allowRedisFileEditing', 10, 2 );


if ( !function_exists('\ComposerQOL\s3UploadsS3ClientParams') ) {
    /**
     * Taken from: https://github.com/humanmade/S3-Uploads/issues/576
     * Changes required settings for Cloudflare R2 to work with S3-Uploads plugin
     * @param array: $params
     * @return array
     */
    function s3UploadsS3ClientParams( array $params ): array
    {
        if (defined('S3_UPLOADS_ENDPOINT')) {
            $params['endpoint'] = S3_UPLOADS_ENDPOINT;
            $params['use_path_style_endpoint'] = true;
        }
        return $params;
    }
}
add_filter( 's3_uploads_s3_client_params', '\ComposerQOL\s3UploadsS3ClientParams' );


if ( !function_exists('\ComposerQOL\enabledPhpMailerSMTP') ) {
    /**
     * Enables WordPress' built-in SMTP client using the credentials from .env file
     */
    function enabledPhpMailerSMTP( $phpmailer ) {
        $phpmailer->isSMTP();     
        $phpmailer->Host       = SMTP_SERVER;  
        $phpmailer->SMTPAuth   = SMTP_AUTH;
        $phpmailer->Port       = SMTP_PORT;
        $phpmailer->Username   = SMTP_USERNAME;
        $phpmailer->Password   = SMTP_PASSWORD;
        $phpmailer->SMTPSecure = SMTP_SECURE;
        $phpmailer->From       = SMTP_FROM;
        $phpmailer->FromName   = SMTP_NAME;
    }
}
\add_action( 'phpmailer_init', '\ComposerQOL\enabledPhpMailerSMTP' );
