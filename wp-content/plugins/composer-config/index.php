<?php
/*
Plugin Name:  Composer Config
Description:  Surpresses Site health & update core screens to surpress inaccurate warnings and undesired auto-updates
Version:      1.0
Author:       Jack Whitworth
Author URI:   https://jackwhitworth.com
*/

namespace ComposerConfig;


/**
 * Disables the automatic updater
 */
\define( 'AUTOMATIC_UPDATER_DISABLED', true );


/**
 * Clean up wp core functions that execute during admin_head
 */
if (!function_exists('\ComposerConfig\cleanUpAdminHead')) {
    function cleanUpAdminHead(): void
    {
        \remove_action('admin_notices', 'update_nag', 3);
    }
    \add_action( 'admin_head', '\ComposerConfig\cleanUpAdminHead', 1 );
}


/**
 * Removes undesired links from the admin menu
 */
if (!function_exists('\ComposerConfig\adminMenuLinks')) {
    function adminMenuLinks(): void
    {
        \remove_submenu_page('index.php', 'update-core.php');
        \remove_submenu_page('tools.php', 'site-health.php');
    }
    \add_action('admin_menu', '\ComposerConfig\adminMenuLinks');
}


/**
 * Redirects from undesired links back to admin url
 */
if (!function_exists('\ComposerConfig\actionsByScreen')) {
    function actionsByScreen(): void
    {
        if (\is_admin()) {
            $screenId = \get_current_screen()->id;
            if ($screenId === 'update-core' || $screenId === 'site-health' ) {
                \wp_redirect(admin_url());
                exit;
            }
        }
    }
    \add_action('current_screen', '\ComposerConfig\actionsByScreen');
}


/**
 * Removes undesired widgets from dashboard
 */
if (!function_exists('\ComposerConfig\editAdminDashboard')) {

    function editAdminDashboard(): void
    {
        global $wp_meta_boxes;
        // Remove the 'Site Health' widget
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health']);
    }
    \add_action('wp_dashboard_setup', '\ComposerConfig\editAdminDashboard', 999);
}
