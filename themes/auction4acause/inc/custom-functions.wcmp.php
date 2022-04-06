<?php 
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wcmp_default_product_types' ) ) {

    function wcmp_default_product_types() {
        return array(
            'simple'   => __( 'Simple product', 'ibid' ),
            'auction'   => __( 'Auction', 'ibid' ),
        );
    }

}

/**
* Add Custom Tab in add product page.
* @author WC Marketplace
* @Version 3.3.0
*/
function ibid_wcmp_add_custom_product_data_tabs( $tabs ) {
   $tabs['advanced'] = array(
       'label'    => __( 'MT Auction Settings', 'ibid' ),
       'target'   => 'custom_tab_product_data',
       'class'    => array(),
       'priority' => 100,
   );
   return $tabs;
}
add_filter( 'wcmp_product_data_tabs', 'ibid_wcmp_add_custom_product_data_tabs' );

/**
* Add Custom Tab content in add product page.
* @author WC Marketplace
* @Version 3.3.0
*/
function ibid_wcmp_add_custom_product_data_content( $pro_class_obj, $product, $post ) {
    ?>
    <div role="tabpanel" class="tab-pane fade" id="custom_tab_product_data">
        <div class="row-padding">
            <?php do_action('ibid_wcmp_auctions_tab_content', $post->ID); ?>
        </div>
    </div>
    <?php
}
add_action( 'wcmp_product_tabs_content', 'ibid_wcmp_add_custom_product_data_content', 10, 3 );

/**
* Save Custom Tab content data.
* @author WC Marketplace
* @Version 3.3.0
*/
function ibid_wcmp_save_custom_product_data( $product, $post_data ) {
    // WooCommerce simple auctions Custom Fields
    if( isset($post_data['post_ID']) && isset($post_data['_auction_item_condition'])){
        update_post_meta( absint( $post_data['post_ID'] ), '_auction_item_condition', $post_data['_auction_item_condition']);
    }
    if( isset($post_data['post_ID']) && isset($post_data['_auction_type'])){
        update_post_meta( absint( $post_data['post_ID'] ), '_auction_type', $post_data['_auction_type']);
    }
    if( isset($post_data['post_ID']) && isset($post_data['_auction_proxy'])){
        update_post_meta( absint( $post_data['post_ID'] ), '_auction_proxy', $post_data['_auction_proxy']);
    }
    if( isset($post_data['post_ID']) && isset($post_data['_auction_sealed'])){
        update_post_meta( absint( $post_data['post_ID'] ), '_auction_sealed', $post_data['_auction_sealed']);
    }
    if( isset($post_data['post_ID']) && isset($post_data['_auction_start_price'])){
        update_post_meta( absint( $post_data['post_ID'] ), '_auction_start_price', $post_data['_auction_start_price']);
    }
    if( isset($post_data['post_ID']) && isset($post_data['_auction_bid_increment'])){
        update_post_meta( absint( $post_data['post_ID'] ), '_auction_bid_increment', $post_data['_auction_bid_increment']);
    }
    if( isset($post_data['post_ID']) && isset($post_data['_auction_reserved_price'])){
        update_post_meta( absint( $post_data['post_ID'] ), '_auction_reserved_price', $post_data['_auction_reserved_price']);
    }
    if( isset($post_data['post_ID']) && isset($post_data['_regular_price'])){
        update_post_meta( absint( $post_data['post_ID'] ), '_regular_price', $post_data['_regular_price']);
    }
    if( isset($post_data['post_ID']) && isset($post_data['_auction_dates_from'])){
        update_post_meta( absint( $post_data['post_ID'] ), '_auction_dates_from', $post_data['_auction_dates_from']);
    }
    if( isset($post_data['post_ID']) && isset($post_data['_auction_dates_to'])){
        update_post_meta( absint( $post_data['post_ID'] ), '_auction_dates_to', $post_data['_auction_dates_to']);
    }
    // WooCommerce simple auctions Custom Fields - 
    if( isset($post_data['post_ID']) && isset($post_data['_auction_automatic_relist'])){
        update_post_meta( $post_data['post_ID'], '_auction_automatic_relist', 'yes' );
    }else{
        update_post_meta( $post_data['post_ID'], '_auction_automatic_relist', 'no' );
    }
    if( isset($post_data['post_ID']) && isset($post_data['_auction_relist_fail_time'])){
        update_post_meta( $post_data['post_ID'], '_auction_relist_fail_time', $post_data['_auction_relist_fail_time'] );
    }
    if( isset($post_data['post_ID']) && isset($post_data['_auction_relist_not_paid_time'])){
        update_post_meta( $post_data['post_ID'], '_auction_relist_not_paid_time', $post_data['_auction_relist_not_paid_time'] );
    }
    if( isset($post_data['post_ID']) && isset($post_data['_auction_relist_duration'])){
        update_post_meta( $post_data['post_ID'], '_auction_relist_duration', $post_data['_auction_relist_duration'] );
    }
    // Donation cause meta
    if( isset($post_data['post_ID']) && isset($post_data['product_cause'])){
        update_post_meta( absint( $post_data['post_ID'] ), 'product_cause', $post_data['product_cause']);
    }
    // PDF attchment meta
    if( isset($post_data['post_ID']) && isset($post_data['ibid_pdf_attach'])){
        update_post_meta( absint( $post_data['post_ID'] ), 'ibid_pdf_attach', $post_data['ibid_pdf_attach']);
    }


   // Ultimate Auction Custom Fields
   if( isset($post_data['post_ID']) && isset($post_data['woo_ua_product_condition'])){
       update_post_meta( absint( $post_data['post_ID'] ), 'woo_ua_product_condition', $post_data['woo_ua_product_condition']);
   }
   if( isset($post_data['post_ID']) && isset($post_data['woo_ua_opening_price'])){
       update_post_meta( absint( $post_data['post_ID'] ), 'woo_ua_opening_price', $post_data['woo_ua_opening_price']);
   }
   if( isset($post_data['post_ID']) && isset($post_data['woo_ua_bid_increment'])){
       update_post_meta( absint( $post_data['post_ID'] ), 'woo_ua_bid_increment', $post_data['woo_ua_bid_increment']);
   }
   if( isset($post_data['post_ID']) && isset($post_data['woo_ua_lowest_price'])){
       update_post_meta( absint( $post_data['post_ID'] ), 'woo_ua_lowest_price', $post_data['woo_ua_lowest_price']);
   }
   if( isset($post_data['post_ID']) && isset($post_data['_regular_price'])){
       update_post_meta( absint( $post_data['post_ID'] ), '_regular_price', $post_data['_regular_price']);
   }
   if( isset($post_data['post_ID']) && isset($post_data['woo_ua_auction_end_date'])){
        update_post_meta( absint( $post_data['post_ID'] ), 'woo_ua_auction_end_date', $post_data['woo_ua_auction_end_date']);
        update_post_meta( absint( $post_data['post_ID'] ), 'woo_ua_auction_started', '1' );
        update_post_meta( absint( $post_data['post_ID'] ), 'woo_ua_auction_has_started', '1' );
   }
}
add_action( 'wcmp_process_product_object', 'ibid_wcmp_save_custom_product_data', 10, 2 ); ?>
