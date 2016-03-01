<?php
    /**
     * Include Plugins
     */
    include_once(LOTTO_PLUGIN_ROOT.'plugins/carbon-fields/carbon-fields-plugin.php');
    include_once(LOTTO_PLUGIN_ROOT.'plugins/plugin-updates/plugin-update-checker.php');

    /**
     * Include Helpers
     */
    include_once(LOTTO_PLUGIN_ROOT.'helpers/functions.php');

    /**
     * Include Admin Options
     */
    include_once(LOTTO_PLUGIN_ROOT.'admin/theme-options.php');
    include_once(LOTTO_PLUGIN_ROOT.'admin/custom-fields.php');
    include_once(LOTTO_PLUGIN_ROOT.'public/data-arrays.php');

    $whitelist = array('127.0.0.1', "::1");
    define('IS_LOCALHOST', in_array($_SERVER['REMOTE_ADDR'], $whitelist));
    define('TOKEN', carbon_get_theme_option('lotto_access_token')); //'PlamenToken89'
    define('BASE_API_URL', carbon_get_theme_option('lotto_base_api_url'));//'https://5.100.249.154/api/'
    define('CASHIER_URL', carbon_get_theme_option('lotto_cashier_url')); //'https://5.100.249.154/Cashier/'
    define('BRAND_ID', carbon_get_theme_option('lotto_brand_id'));
    define('NG_CART', carbon_get_theme_option('lotto_ngcart'));
    define('SITE_CURRENCY', carbon_get_theme_option('lotto_currency'));

    /**
     * Include Modules
     */
    if (NG_CART) {
        include_once(LOTTO_PLUGIN_ROOT.'modules/cart/Cart.php');
    }

    if (!class_exists('Init')) {
        include_once(LOTTO_PLUGIN_ROOT.'modules/api/Init.php');
    }

    if (!class_exists('Discounts')) {
        include_once(LOTTO_PLUGIN_ROOT.'modules/api/Discounts.php');
    }
