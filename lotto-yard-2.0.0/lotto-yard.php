<?php
/*
    Plugin Name: Lotto Yard Devs
    Description: Lotto Yard Plugin
    Version: 2.0.0
    Author URI: Lotto Yard Devs
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
