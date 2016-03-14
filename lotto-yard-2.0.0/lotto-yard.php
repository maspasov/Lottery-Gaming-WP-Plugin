<?php
/*
    Plugin Name: Lottery Platform Functionality
    Description: A plugin added Classes for Lotto Yard API, ngCart and CarbonFields
    Version: 2.0.0
    Author URI: Lotto Yard WP Team
 */

define('LOTTO_YARD', 'lotto-yard');
define('LOTTO_PLUGIN_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);

include_once(LOTTO_PLUGIN_ROOT.'bootstrap/app.php');

/**
 * Update Plugin Checker
 */
$MyUpdateChecker = PucFactory::buildUpdateChecker(
   'http://pluginsprod.lottoyard.com/wp-update-server/?action=get_metadata&slug=' . LOTTO_YARD, //Metadata URL.
   __FILE__, //Full path to the main plugin file.
   LOTTO_YARD //Plugin slug. Usually it's the same as the name of the directory.
);

add_filter('plugin_action_links', 'lotto_disable_plugin_deactivation', 10, 4);
function lotto_disable_plugin_deactivation($actions, $plugin_file, $plugin_data, $context)
{
    // Remove edit link for all
    if (array_key_exists('edit', $actions)) {
        unset($actions['edit']);
    }
    // Remove deactivate link for crucial plugins
    if (array_key_exists('deactivate', $actions) && in_array($plugin_file, array(
            'lotto-yard/lotto-yard.php',
        ))) {
        unset($actions['deactivate']);
    }
    return $actions;
}
