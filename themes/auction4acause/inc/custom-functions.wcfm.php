<?php
defined( 'ABSPATH' ) || exit;

/**
* Template Products -> WooCommerce_simple_auction
*
* Saves the metas for auction settings
*
* @since 1.4
*
* @package ibid
*/
if (class_exists('WooCommerce_simple_auction') || class_exists('Ultimate_WooCommerce_Auction_Free') || function_exists('YITH_Auctions')) {
    if (!function_exists('ibid_save_auction_metas')) {
        function ibid_save_auction_metas( $new_product_id, $wcfm_products_manage_form_data ) {

            global $WCFM;
            if (!class_exists('WCFMu')){
                if(isset($wcfm_products_manage_form_data['_auction'])){
                    wp_set_object_terms( $new_product_id, 'auction', 'product_type' );
                }
                if(isset($wcfm_products_manage_form_data['_auction_item_condition'])){
                    update_post_meta( $new_product_id, '_auction_item_condition', $wcfm_products_manage_form_data['_auction_item_condition'] );
                }
                if(isset($wcfm_products_manage_form_data['_auction_type'])){
                    update_post_meta( $new_product_id, '_auction_type', $wcfm_products_manage_form_data['_auction_type'] );
                }
                if(isset($wcfm_products_manage_form_data['_auction_proxy'])){
                    update_post_meta( $new_product_id, '_auction_proxy', 'yes' );
                }else{
                    update_post_meta( $new_product_id, '_auction_proxy', 'no' );
                }
                if(isset($wcfm_products_manage_form_data['_auction_sealed'])){
                    update_post_meta( $new_product_id, '_auction_sealed', 'yes' );
                }else{
                    update_post_meta( $new_product_id, '_auction_sealed', 'no' );
                }
                if(isset($wcfm_products_manage_form_data['_auction_start_price'])){
                    update_post_meta( $new_product_id, '_auction_start_price', $wcfm_products_manage_form_data['_auction_start_price'] );
                }
                if(isset($wcfm_products_manage_form_data['_auction_bid_increment'])){
                    update_post_meta( $new_product_id, '_auction_bid_increment', $wcfm_products_manage_form_data['_auction_bid_increment'] );
                }
                if(isset($wcfm_products_manage_form_data['_auction_reserved_price'])){
                    update_post_meta( $new_product_id, '_auction_reserved_price', $wcfm_products_manage_form_data['_auction_reserved_price'] );
                }
                if(isset($wcfm_products_manage_form_data['_auction'])){
                    if(isset($wcfm_products_manage_form_data['_regular_price'])){
                        update_post_meta( $new_product_id, '_regular_price', $wcfm_products_manage_form_data['_regular_price'] );
                    }
                }
                if(isset($wcfm_products_manage_form_data['_auction_dates_from'])){
                    update_post_meta( $new_product_id, '_auction_dates_from', $wcfm_products_manage_form_data['_auction_dates_from'] );
                }
                if(isset($wcfm_products_manage_form_data['_auction_dates_to'])){
                    update_post_meta( $new_product_id, '_auction_dates_to', $wcfm_products_manage_form_data['_auction_dates_to'] );
                }


                // RELIST OPTIONS
                if(isset($wcfm_products_manage_form_data['_auction_automatic_relist'])){
                    update_post_meta( $new_product_id, '_auction_automatic_relist', 'yes' );
                }else{
                    update_post_meta( $new_product_id, '_auction_automatic_relist', 'no' );
                }
                if(isset($wcfm_products_manage_form_data['_auction_relist_fail_time'])){
                    update_post_meta( $new_product_id, '_auction_relist_fail_time', $wcfm_products_manage_form_data['_auction_relist_fail_time'] );
                }
                if(isset($wcfm_products_manage_form_data['_auction_relist_not_paid_time'])){
                    update_post_meta( $new_product_id, '_auction_relist_not_paid_time', $wcfm_products_manage_form_data['_auction_relist_not_paid_time'] );
                }
                if(isset($wcfm_products_manage_form_data['_auction_relist_duration'])){
                    update_post_meta( $new_product_id, '_auction_relist_duration', $wcfm_products_manage_form_data['_auction_relist_duration'] );
                }
            }

            //CHARITY META
            if(isset($wcfm_products_manage_form_data['product_cause'])){
                update_post_meta( $new_product_id, 'product_cause', $wcfm_products_manage_form_data['product_cause'] );
            }

            //CHARITY META
            if(isset($wcfm_products_manage_form_data['ibid_pdf_attach'])){
                update_post_meta( $new_product_id, 'ibid_pdf_attach', $wcfm_products_manage_form_data['ibid_pdf_attach'] );
            }   
            

            // ULTIMATE AUCTIONS CUSTOM FIELDS
            if (!class_exists('WCFMu')){
                if(isset($wcfm_products_manage_form_data['woo_ua_product_condition'])){
                    update_post_meta( $new_product_id, 'woo_ua_product_condition', $wcfm_products_manage_form_data['woo_ua_product_condition'] );
                }
                if(isset($wcfm_products_manage_form_data['woo_ua_opening_price'])){
                    update_post_meta( $new_product_id, 'woo_ua_opening_price', $wcfm_products_manage_form_data['woo_ua_opening_price'] );
                }
                if(isset($wcfm_products_manage_form_data['woo_ua_bid_increment'])){
                    update_post_meta( $new_product_id, 'woo_ua_bid_increment', $wcfm_products_manage_form_data['woo_ua_bid_increment'] );
                }
                if(isset($wcfm_products_manage_form_data['woo_ua_lowest_price'])){
                    update_post_meta( $new_product_id, 'woo_ua_lowest_price', $wcfm_products_manage_form_data['woo_ua_lowest_price'] );
                }
                if(isset($wcfm_products_manage_form_data['_regular_price'])){
                    update_post_meta( $new_product_id, '_regular_price', $wcfm_products_manage_form_data['_regular_price'] );
                }
                if(isset($wcfm_products_manage_form_data['woo_ua_auction_end_date'])){
                    update_post_meta( $new_product_id, 'woo_ua_auction_end_date', $wcfm_products_manage_form_data['woo_ua_auction_end_date'] );
                    update_post_meta( $new_product_id, 'woo_ua_auction_started', '1' );
                    update_post_meta( $new_product_id, 'woo_ua_auction_has_started', '1' );
                }
            }


            // YITH Auctions - Since iBid 3.5
            if (function_exists('YITH_Auctions') && !class_exists('WCFMu')) {
                // row 1
                if(isset($wcfm_products_manage_form_data['_yith_wcact_item_condition'])){
                    update_post_meta( $new_product_id, '_yith_wcact_item_condition', $wcfm_products_manage_form_data['_yith_wcact_item_condition'] );
                }
                if(isset($wcfm_products_manage_form_data['_yith_wcact_auction_type'])){
                    update_post_meta( $new_product_id, '_yith_wcact_auction_type', $wcfm_products_manage_form_data['_yith_wcact_auction_type'] );
                }
                if(isset($wcfm_products_manage_form_data['_yith_wcact_auction_sealed'])){
                    update_post_meta( $new_product_id, '_yith_wcact_auction_sealed', 'yes' );
                }else{
                    update_post_meta( $new_product_id, '_yith_wcact_auction_sealed', 'no' );
                }
                // row 2
                if(isset($wcfm_products_manage_form_data['_yith_auction_start_price'])){
                    update_post_meta( $new_product_id, '_yith_auction_start_price', $wcfm_products_manage_form_data['_yith_auction_start_price'] );
                }
                if(isset($wcfm_products_manage_form_data['_yith_auction_minimum_increment_amount'])){
                    update_post_meta( $new_product_id, '_yith_auction_minimum_increment_amount', $wcfm_products_manage_form_data['_yith_auction_minimum_increment_amount'] );
                }
                if(isset($wcfm_products_manage_form_data['_yith_auction_reserve_price'])){
                    update_post_meta( $new_product_id, '_yith_auction_reserve_price', $wcfm_products_manage_form_data['_yith_auction_reserve_price'] );
                }
                if(isset($wcfm_products_manage_form_data['_yith_auction_buy_now'])){
                    update_post_meta( $new_product_id, '_yith_auction_buy_now', $wcfm_products_manage_form_data['_yith_auction_buy_now'] );
                }
                // row 3
                if(isset($wcfm_products_manage_form_data['_yith_auction_for'])){
                    $date_for_unix = strtotime(date($wcfm_products_manage_form_data['_yith_auction_for']));
                    update_post_meta( $new_product_id, '_yith_auction_for', $date_for_unix );
                }
                if(isset($wcfm_products_manage_form_data['_yith_auction_to'])){
                    $date_to_unix = strtotime(date($wcfm_products_manage_form_data['_yith_auction_to']));
                    update_post_meta( $new_product_id, '_yith_auction_to', $date_to_unix );
                }
                // Advanced #1
                if(isset($wcfm_products_manage_form_data['_yith_auction_bid_type_onoff'])){
                    update_post_meta( $new_product_id, '_yith_auction_bid_type_onoff', 'yes' );
                }else{
                    update_post_meta( $new_product_id, '_yith_auction_bid_type_onoff', 'no' );
                }
                if(isset($wcfm_products_manage_form_data['_yith_wcact_bid_type_set_radio'])){
                    update_post_meta( $new_product_id, '_yith_wcact_bid_type_set_radio', $wcfm_products_manage_form_data['_yith_wcact_bid_type_set_radio'] );
                }
                if(isset($wcfm_products_manage_form_data['_yith_wcact_bid_type_radio'])){
                    update_post_meta( $new_product_id, '_yith_wcact_bid_type_radio', $wcfm_products_manage_form_data['_yith_wcact_bid_type_radio'] );
                }
                if(isset($wcfm_products_manage_form_data['ywcact_automatic_product_bid_simple'])){
                    update_post_meta( $new_product_id, 'ywcact_automatic_product_bid_simple', $wcfm_products_manage_form_data['ywcact_automatic_product_bid_simple'] );
                }
                // Advanced #2
                if(isset($wcfm_products_manage_form_data['_yith_auction_fee_onoff'])){
                    update_post_meta( $new_product_id, '_yith_auction_fee_onoff', 'yes' );
                }else{
                    update_post_meta( $new_product_id, '_yith_auction_fee_onoff', 'no' );
                }
                if(isset($wcfm_products_manage_form_data['_yith_auction_fee_ask_onoff'])){
                    update_post_meta( $new_product_id, '_yith_auction_fee_ask_onoff', 'yes' );
                }else{
                    update_post_meta( $new_product_id, '_yith_auction_fee_ask_onoff', 'no' );
                }
                if(isset($wcfm_products_manage_form_data['_yith_auction_fee_amount'])){
                    update_post_meta( $new_product_id, '_yith_auction_fee_amount', $wcfm_products_manage_form_data['_yith_auction_fee_amount'] );
                }
                // Advanced #3
                if(isset($wcfm_products_manage_form_data['_yith_auction_reschedule_onoff'])){
                    update_post_meta( $new_product_id, '_yith_auction_reschedule_onoff', 'yes' );
                }else{
                    update_post_meta( $new_product_id, '_yith_auction_reschedule_onoff', 'no' );
                }
                if(isset($wcfm_products_manage_form_data['_yith_auction_reschedule_closed_without_bids_onoff'])){
                    update_post_meta( $new_product_id, '_yith_auction_reschedule_closed_without_bids_onoff', 'yes' );
                }else{
                    update_post_meta( $new_product_id, '_yith_auction_reschedule_closed_without_bids_onoff', 'no' );
                }
                if(isset($wcfm_products_manage_form_data['_yith_auction_reschedule_reserve_no_reached_onoff'])){
                    update_post_meta( $new_product_id, '_yith_auction_reschedule_reserve_no_reached_onoff', 'yes' );
                }else{
                    update_post_meta( $new_product_id, '_yith_auction_reschedule_reserve_no_reached_onoff', 'no' );
                }
                if(isset($wcfm_products_manage_form_data['_yith_wcact_auction_automatic_reschedule'])){
                    update_post_meta( $new_product_id, '_yith_wcact_auction_automatic_reschedule', $wcfm_products_manage_form_data['_yith_wcact_auction_automatic_reschedule'] );
                }
                if(isset($wcfm_products_manage_form_data['_yith_wcact_automatic_reschedule_auction_unit'])){
                    update_post_meta( $new_product_id, '_yith_wcact_automatic_reschedule_auction_unit', $wcfm_products_manage_form_data['_yith_wcact_automatic_reschedule_auction_unit'] );
                }
                // Advanced #4
                if(isset($wcfm_products_manage_form_data['_yith_auction_overtime_onoff'])){
                    update_post_meta( $new_product_id, '_yith_auction_overtime_onoff', 'yes' );
                }else{
                    update_post_meta( $new_product_id, '_yith_auction_overtime_onoff', 'no' );
                }
                if(isset($wcfm_products_manage_form_data['_yith_auction_overtime_set_onoff'])){
                    update_post_meta( $new_product_id, '_yith_auction_overtime_set_onoff', 'yes' );
                }else{
                    update_post_meta( $new_product_id, '_yith_auction_overtime_set_onoff', 'no' );
                }
                if(isset($wcfm_products_manage_form_data['_yith_check_time_for_overtime_option'])){
                    update_post_meta( $new_product_id, '_yith_check_time_for_overtime_option', $wcfm_products_manage_form_data['_yith_check_time_for_overtime_option'] );
                }
                if(isset($wcfm_products_manage_form_data['_yith_overtime_option'])){
                    update_post_meta( $new_product_id, '_yith_overtime_option', $wcfm_products_manage_form_data['_yith_overtime_option'] );
                }
            }

        }
        add_action( 'after_wcfm_products_manage_meta_save', 'ibid_save_auction_metas', 50, 2 );
    }
}
