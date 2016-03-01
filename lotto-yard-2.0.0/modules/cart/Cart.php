<?php 

define('CART_PARTIALS_URI', trailingslashit(get_template_directory_uri() . '/fragments/cart-partials'));
define('CART_TRANSLATION_URL', trailingslashit(get_template_directory_uri() . '/languages/translations'));

function init_cart()
{
    wp_enqueue_script('angular', plugin_dir_url(__FILE__) . 'libs/angular.min.js', array('jquery'), '10-02-2016', false);
    wp_enqueue_script('ng-dialog', plugin_dir_url(__FILE__) . 'libs/ngDialog.js', array('jquery'), '10-02-2016', true);
    wp_enqueue_script('angular-cache', plugin_dir_url(__FILE__) . 'libs/angular-cache.min.js', array('jquery'), '10-02-2016', true);
    wp_enqueue_script('angular-resource', plugin_dir_url(__FILE__) . 'libs/angular-resource.min.js', array('jquery'), '10-02-2016', true);
    wp_enqueue_script('fancybox', plugin_dir_url(__FILE__) . 'libs/fancybox/jquery.fancybox.pack.js', array('jquery'), '10-02-2016', false);
    wp_enqueue_style('fancybox-style', plugin_dir_url(__FILE__) .'libs/fancybox/jquery.fancybox.css', array('jquery'), '10-02-2016');
    wp_enqueue_script('angular-fancybox-plus', plugin_dir_url(__FILE__) . 'libs/angular-fancybox-plus.js', array('jquery'), '10-02-2016', true);
    wp_register_script('angular-app', plugin_dir_url(__FILE__) . 'app.js', array('jquery'), '10-02-2016', true);

    wp_localize_script(
        'angular-app',
        'CART_CONFIG',
        array(
            'CART_PARTIALS_URI' => CART_PARTIALS_URI,
            'CART_TRANSLATION_URL' => CART_TRANSLATION_URL
        )
    );
    wp_enqueue_script('angular-app');

    wp_enqueue_script('ng-cart', plugin_dir_url(__FILE__) . 'cartjs/ngCart.js', array('jquery'), '10-02-2016', true);
    wp_enqueue_script('mainctrl', plugin_dir_url(__FILE__) . 'cartjs/mainCtrl.js', array('jquery'), '10-02-2016', true);
    wp_enqueue_script('mapper', plugin_dir_url(__FILE__) . 'cartjs/Mapper.js', array('jquery'), '10-02-2016', true);
    wp_enqueue_script('phonescodes', plugin_dir_url(__FILE__) . 'cartjs/phonescodes.js', array('jquery'), '10-02-2016', true);
    wp_enqueue_script('countdown-directive', plugin_dir_url(__FILE__) . 'cartjs/Directives/countdownDirective.js', array('jquery'), '10-02-2016', true);
    wp_enqueue_script('animate-numbers-directive', plugin_dir_url(__FILE__) . 'cartjs/Directives/animateNumbersDirective.js', array('jquery'), '10-02-2016', true);
}
add_action('wp_enqueue_scripts', 'init_cart');
