<?php

function lotto_admin_enqueue()
{
    if (is_user_logged_in()) {
        wp_enqueue_script('lotto-admin-js', plugin_dir_url(__FILE__) . 'js/lotto-admin.js', array('jquery'), date('Y-m-d'), true);
        wp_register_style('lotto-admin', plugin_dir_url(__FILE__) . 'css/lotto-admin.css', false, '2.0.0');
        wp_enqueue_style('lotto-admin');
    }
}
add_action('wp_enqueue_scripts', 'lotto_admin_enqueue');
add_action('admin_enqueue_scripts', 'lotto_admin_enqueue');

function lotto_admin_bar_btn($wp_admin_bar)
{
    $args = array(
        'id' => 'button-for-transients',
        'title' => 'Delete Transients and Local Storage',
        'href' => '#',
        'meta' => array(
            'class' => 'button-for-transients'
        )
    );
    $wp_admin_bar->add_node($args);
}

add_action('admin_bar_menu', 'lotto_admin_bar_btn', 50);

function lotto_del_transients()
{
    global $wpdb;
    $wpdb->get_results("DELETE FROM `".$wpdb->prefix . "options` WHERE `option_name` LIKE ('_transient_lotto_%')", OBJECT);

    die();
}
add_action('wp_ajax_del_transients', 'lotto_del_transients');
