<?php
/**
* Plugin Name: ModelTheme Framework
* Plugin URI: http://modeltheme.com/
* Description: ModelTheme Framework required by the iBid Theme.
* Version: 3.5.2
* Author: ModelTheme
* Author http://modeltheme.com/
* Text Domain: modeltheme
* Last Plugin Update: 07-Mar-2022
*/
$plugin_dir = plugin_dir_path( __FILE__ );


// CMB METABOXES
function modeltheme_cmb_initialize_cmb_meta_boxes() {
    if ( ! class_exists( 'cmb_Meta_Box' ) )
        require_once ('init.php');
}
add_action( 'init', 'modeltheme_cmb_initialize_cmb_meta_boxes', 9999 );


function modeltheme_load_textdomain(){
    $domain = 'modeltheme';
    load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'modeltheme_load_textdomain' );


/**

||-> Function: modeltheme_framework()

*/
function modeltheme_framework() {
    // SCRIPTS
    wp_enqueue_script( 'js-mt-plugins', plugin_dir_url( __FILE__ ) . 'js/mt-plugins.js', array(), '1.0.0', true );
    wp_enqueue_script( 'filters-main', plugin_dir_url( __FILE__ ) . 'js/filters-main.js', array(), '1.0.0', true );
    wp_enqueue_script( 'filters-mixitup.min', plugin_dir_url( __FILE__ ) . 'js/filters-mixitup.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'flipclock', plugin_dir_url( __FILE__ ) . 'js/mt-coundown-version2/flipclock.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'map-pins', plugin_dir_url( __FILE__ ) . 'js/map-pins.js', array(), '1.0.0', true );
    wp_enqueue_script( 'tabs-custom', plugin_dir_url( __FILE__ ) . 'js/tabs-custom.js', array(), '1.0.0', true );
    wp_enqueue_script( 'magnific-popup', plugin_dir_url( __FILE__ ) . 'js/mt-video/jquery.magnific-popup.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'modeltheme_framework' );


/**
||-> Function: modeltheme_enqueue_admin_scripts()
*/
function modeltheme_enqueue_admin_scripts( $hook ) {
    // CSS
    wp_register_style( 'modelteme-framework-admin-style',  plugin_dir_url( __FILE__ ) . 'css/modelteme-framework-admin-style.css' );
    wp_enqueue_style( 'modelteme-framework-admin-style' );
    // JS
    wp_enqueue_script( 'js-modeltheme-admin-custom', plugin_dir_url( __FILE__ ) . 'js/modeltheme-custom-admin.js', array(), '1.0.0', true );
    
}
add_action('admin_enqueue_scripts', 'modeltheme_enqueue_admin_scripts');

function ibid_RemoveDemoModeLink() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}
add_action('init', 'ibid_RemoveDemoModeLink');

// Remove the demo link and the notice of integrated demo from the redux-framework plugin
 function remove_demo() {

    // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
    if (class_exists('ReduxFrameworkPlugin')) {
       remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2);
    }
    // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
    remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));
}

require "inc/demo-importer-v2/extensions/mt_activator/MTA_API.php";
// WIDGETS
require_once('inc/widgets/widgets.php');
// CUSTOM FUNCTIONS
require_once('inc/custom.functions.php');
// LOAD METABOXES
require_once('inc/metaboxes/metaboxes.php');
// LOAD POST TYPES
require_once('inc/post-types/post-types.php');
// LOAD SHORTCODES
require_once('inc/shortcodes/shortcodes.php');
// DEMO IMPORTER
require_once('inc/demo-importer-v2/wbc907-plugin-example.php');
// Mega Menu
require_once('inc/mega-menu/modeltheme-mega-menu.php'); // MEGA MENU
// GOOGLE MAPS
require_once('inc/sb-google-maps-vc-addon/sb-google-maps-vc-addon.php'); // GMAPS
//Elementor Widgets
if ( class_exists('Elementor\Core\Admin\Admin') ) {
    require_once('inc/shortcodes/elementor/functions.php');
}

function modeltheme_remove_menu_items() {
    if( !current_user_can( 'administrator' ) ):
        remove_menu_page( 'edit.php?post_type=cf_mega_menu' );
        remove_menu_page( 'edit.php?post_type=member' );
        remove_menu_page( 'edit.php?post_type=testimonial' );
        remove_menu_page( 'edit.php?post_type=shop_order' );
        remove_menu_page( 'admin.php?page=vc-welcome' );
    endif;
}
add_action( 'admin_menu', 'modeltheme_remove_menu_items' );



function ibid_get_auction_price_status_for_grids($product_id, $buy_bid_btn_status = ''){
    $product = wc_get_product( $product_id );

    // metas
    // if ( class_exists( 'WooCommerce_simple_auction' ) || class_exists('Ultimate_WooCommerce_Auction_Free') || class_exists('Ultimate_WooCommerce_Auction_Pro')) {
    $product_cause = get_post_meta( $product_id, 'product_cause', true );
    if (isset($product_cause) && !empty($product_cause)) {
        $cause_id = $product_cause;
    }else{
        $cause_id = '';
    }

    if ( class_exists( 'WooCommerce_simple_auction' )){
        $meta_auction_current_bid = get_post_meta( $product_id, '_auction_current_bid', true );
        $meta_auction_start_price = get_post_meta( $product_id, '_auction_start_price', true );
        $meta_auction_closed = get_post_meta( $product_id, '_auction_closed', true );
        $meta_auction_end_date = get_post_meta( $product_id, '_auction_dates_to', true );
    }elseif(class_exists('Ultimate_WooCommerce_Auction_Free') || class_exists('Ultimate_WooCommerce_Auction_Pro')){
        $meta_auction_current_bid = get_post_meta( $product_id, 'woo_ua_auction_current_bid', true );
        $meta_auction_start_price = get_post_meta( $product_id, 'woo_ua_opening_price', true );
        $meta_auction_closed = get_post_meta( $product_id, 'woo_ua_auction_closed', true );
        $meta_auction_end_date = get_post_meta( $product_id, 'woo_ua_auction_end_date', true );
        #sealed
        $meta_uwa_auction_silent = get_post_meta( $product_id, 'uwa_auction_silent', true );
    }
    // var_dump($buy_bid_btn_status);

    if( $product->is_type('auction') ){
        if ($meta_auction_closed == '') {
            if ($meta_auction_current_bid || $meta_auction_start_price) {
                if ( class_exists( 'WooCommerce_simple_auction' )){
                    if($product->get_auction_sealed() == 'yes'){ 
                        echo '<p>'.esc_html__('Sealed bid auction ','modeltheme').'</p>';
                    }else {
                        if ($meta_auction_current_bid) {
                            echo '<p>'.esc_html__('Current bid: ','modeltheme').''.wc_price($meta_auction_current_bid).'</p>';
                        }elseif($meta_auction_start_price){
                            echo '<p>'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';
                        }
                    }
                }elseif(class_exists('Ultimate_WooCommerce_Auction_Pro')){
                    if($meta_uwa_auction_silent == 'yes'){ 
                        echo '<p>'.esc_html__('Sealed bid auction ','modeltheme').'</p>';
                    }else {
                        if ($meta_auction_current_bid) {
                            echo '<p>'.esc_html__('Current bid: ','modeltheme').''.wc_price($meta_auction_current_bid).'</p>';
                        }elseif($meta_auction_start_price){
                            echo '<p>'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';
                        }
                    }
                }elseif(class_exists('Ultimate_WooCommerce_Auction_Free')){
                    if ($meta_auction_current_bid) {
                        echo '<p>'.esc_html__('Current bid: ','modeltheme').''.wc_price($meta_auction_current_bid).'</p>';
                    }elseif($meta_auction_start_price){
                        echo '<p>'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';
                    }
                }
                echo '<p>'.esc_html__('Expires on: ','modeltheme').' <span class="end_date_prod">' .date_i18n( get_option( 'date_format' ),  strtotime($meta_auction_end_date)).'</span></p>';

                do_action('ibid_donation_cause_text', $cause_id);
                
                if ($buy_bid_btn_status == 'button_on') {
                    echo '<div class="button-bid text-center">
                            <a href="'.esc_url(get_permalink($product_id)).'">'.esc_html__('Bid Now','modeltheme').'</a>
                        </div>';
                }
            }
        }else {
            echo '<p class="price">'.esc_html__('Auction closed','modeltheme').'</p>';
        }
    }else{
        echo '<p>'.$product->get_price_html().'</p>';
                
        do_action('ibid_donation_cause_text', $cause_id);

        if ($buy_bid_btn_status == 'button_on') {
            echo '<div class="button-bid button-other-type text-center"><a href="' . esc_url( $product->add_to_cart_url() ) . '" data-quantity="1" class="button product_type_'.$product->get_type().' add_to_cart_button ajax_add_to_cart" data-product_id="'.esc_attr(get_the_ID()).'" aria-label="Add <'.esc_attr(get_the_title()).'> to your cart" rel="nofollow">'.$product->add_to_cart_text().'</a></div>'; 
        }
    }
}
add_action('ibid_product_filters_shortcode_price_and_button', 'ibid_get_auction_price_status_for_grids', 10, 2);
add_action('ibid_mt_products_slider_shortcode_price', 'ibid_get_auction_price_status_for_grids', 10, 2);
add_action('ibid_domains_list_shortcode_price_and_button', 'ibid_get_auction_price_status_for_grids', 10, 2);
add_action('ibid_shop_products_domains_shortcode_price_and_button', 'ibid_get_auction_price_status_for_grids', 10, 2);
add_action('ibid_categories_listed_shortcode_price_and_button', 'ibid_get_auction_price_status_for_grids', 10, 2);
add_action('ibid_mt_products_carousel', 'ibid_get_auction_price_status_for_grids', 10, 2);
add_action('ibid_mt_products_filters', 'ibid_get_auction_price_status_for_grids', 10, 2);
add_action('ibid_mt_latest_products_boxed', 'ibid_get_auction_price_status_for_grids', 10, 2);
// iBid - Projects List Type
add_action('ibid_projects_list_shortcode_price_and_button', 'ibid_get_auction_price_status_for_grids', 10, 2);