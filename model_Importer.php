<?php
/**
 * Created by PhpStorm.
 * User: seyed at Watch1354@gmail.com
 * Date: 2017-12-07
 * Time: 1:13 PM
 */

class model_Importer
{
    public  function enable_importing_the_model(){

        global $product;
        $logger = wc_get_logger();
        $context = array( 'source' => 'Woocommerce_3d_Product' );
        $logger->debug( 'Product id='.$product->get_id(), $context );
        $product_type = $product->get_type();
        $available_attributes = $product->get_attributes();

        foreach ($available_attributes as $attribute_name=>$options){

            // enable  3d player  when attribute clarauuid exist
            if (!strcmp($attribute_name, 'pa_image_url')) {
                $this->image_url = $product->get_attribute($attribute_name);
                if (!empty($this->image_url)) {
                    $logger->debug( "3d-product is enabled", $context );

                }
        }}
        $this->embed_just_player();
        $this->embed_player_image();
}


    public  function embed_just_player(){
        wp_enqueue_script( 'claraplayer', 'https://clara.io/js/claraplayer.min.js');

        remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

        load_template( rtrim(plugin_dir_path(__FILE__),'/').'/templates/player_template.php' );

    }
    public function embed_player_image() {
        global $product;
        // load scripts to init 3d player
        wp_enqueue_script( 'imageConfigurator', rtrim(plugin_dir_url(__FILE__),'/') . '/assets/sceneLoader.js');
        $dataToBePassed = array(
            'imageUrl' => $this->image_url,
        );
        // variables will be json encoded here
        wp_localize_script('imageConfigurator', 'php_vars', $dataToBePassed);
    }
}