<?php

/*
Plugin Name: Woocommerce 3d Product
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Use thisplugin toshow your products in 3d view. Create an attribute named pa_image_url and the value must be image url. done
Version: 1.0
Author: Seyed Nabavi watch1354@gmail.com
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
};
/**
 * Check if WooCommerce is active
 **/

$active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
if ( in_array( 'woocommerce/woocommerce.php', $active_plugins ) ) {

    define('Woocommerce_3d_Product_DIR', rtrim(plugin_dir_path(__FILE__),'/'));

    add_action("init",'model_loader_init');

};



if (!function_exists('model_loader_init')) {
 function model_loader_init() {
        require_once Woocommerce_3d_Product_DIR . '/model_importer.php';
        $api = new model_Importer();

        add_action('woocommerce_before_single_product', array($api, 'enable_importing_the_model'));
    }
}


?>