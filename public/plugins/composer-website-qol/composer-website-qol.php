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


/**
 * Clean up wp core functions that execute during admin_head
 */
if (!function_exists('\ComposerQOL\cleanUpAdminHead')) {
    function cleanUpAdminHead(): void
    {
        remove_action('admin_notices', 'update_nag', 3);
    }
    add_action( 'admin_head', '\ComposerQOL\cleanUpAdminHead', 1 );
}


