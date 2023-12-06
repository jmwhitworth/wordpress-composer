<?php
/**
 * This file contains configuration setting for WordPress that require core
 * WordPress functions to be available. This is file is included after WordPress
 * is loaded.
 */

/**
 * Prevents the redirection plugin logging data to the database.
 * The plugins logs an excessive number of 404 errors to the DB because of
 * 'missing' assets. The assets aren't infact truely missing, they are stored
 * on S3 but because the original request is pointed at the Heroku server it
 * thinks a 404 has occured. A further plugin later on rewrites the request to
 * point to S3 in order for the asset to be located.
 */
(function() {
    $filters = [
        'redirection_404_data', # Data to be inserted into the 404 table
        'redirection_log_data', # Data to be inserted into the redirect log table
        'redirection_log_404',  # Return true if the current 404 page should be logged, false
        'redirection_log',      # Action fired when something is logged
    ];

    if (function_exists('add_filter')) {
        # Prevents writes for existing sites that may have logging on.
        foreach ($filters as $filter) {
            \add_filter($filter, '__return_false');
        }

        # Set to off is someone tries to enable logging.
        \add_filter('redirection_save_options', function($options) {
            $options['expire_redirect'] = -1;
            $options['expire_404'] = -1;
            $options['ip_logging'] = -1;
            return $options;
        });
    }
})();
