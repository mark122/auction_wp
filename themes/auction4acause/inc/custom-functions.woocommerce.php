<?php 
defined( 'ABSPATH' ) || exit;

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {


	/**
	 * IBID_WC_List_Grid class
	 **/
	if ( ! class_exists( 'IBID_WC_List_Grid' ) ) {

		class IBID_WC_List_Grid {

			public function __construct() {
				// Hooks
  				add_action( 'wp' , array( $this, 'ibid_setup_gridlist' ) , 20);
			}

			/*-----------------------------------------------------------------------------------*/
			/* Class Functions */
			/*-----------------------------------------------------------------------------------*/

			// Setup
			function ibid_setup_gridlist() {
				if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
					add_action( 'wp_enqueue_scripts', array( $this, 'ibid_setup_scripts_script' ), 20);
					add_action( 'woocommerce_before_shop_loop', array( $this, 'ibid_gridlist_toggle_button' ), 30);
					add_action( 'woocommerce_after_shop_loop_item', array( $this, 'ibid_gridlist_buttonwrap_open' ), 9);
					add_action( 'woocommerce_after_shop_loop_item', array( $this, 'ibid_gridlist_buttonwrap_close' ), 11);
					add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 5);
					add_action( 'woocommerce_after_subcategory', array( $this, 'ibid_gridlist_cat_desc' ) );
				}
			}

			function ibid_setup_scripts_script() {
				add_action( 'wp_footer', array( $this, 'ibid_gridlist_set_default_view' ) );
			}

			// Toggle button
			function ibid_gridlist_toggle_button() {

				$grid_view = __( 'Grid view', 'ibid' );
				$list_view = __( 'List view', 'ibid' );

				$output = sprintf( '<nav class="gridlist-toggle"><a href="#" id="grid" title="%1$s"><span class="dashicons dashicons-grid-view"></span> <em>%1$s</em></a><a href="#" id="list" title="%2$s"><span class="dashicons dashicons-exerpt-view"></span> <em>%2$s</em></a></nav>', $grid_view, $list_view );

				echo apply_filters( 'ibid_gridlist_toggle_button_output', $output, $grid_view, $list_view );
			}

			// Button wrap
			function ibid_gridlist_buttonwrap_open() {
				echo apply_filters( 'gridlist_button_wrap_start', '<div class="gridlist-buttonwrap">' );
			}
			function ibid_gridlist_buttonwrap_close() {
				echo apply_filters( 'gridlist_button_wrap_end', '</div>' );
			}

			function ibid_gridlist_set_default_view() {
				global $ibid_redux;
				$default = 'grid';
				if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
					if ($ibid_redux['ibid_shop_grid_list_switcher'] && !empty($ibid_redux['ibid_shop_grid_list_switcher'])) {
						$default = $ibid_redux['ibid_shop_grid_list_switcher'];
					}
				}
				?>
					<script>
					if ( 'function' == typeof(jQuery) ) {
						jQuery(document).ready(function($) {
							if ($.cookie( 'gridcookie' ) == null) {
								$( 'ul.products' ).addClass( '<?php echo esc_html($default); ?>' );
								$( '.gridlist-toggle #<?php echo esc_html($default); ?>' ).addClass( 'active' );
							}
						});
					}
					</script>
				<?php
			}

			function ibid_gridlist_cat_desc( $category ) {
				global $woocommerce;
				echo apply_filters( 'ibid_gridlist_cat_desc_wrap_start', '<div itemprop="description">' );
					echo wp_kses_post($category->description);
				echo apply_filters( 'ibid_gridlist_cat_desc_wrap_end', '</div>' );

			}
		}

		$IBID_WC_List_Grid = new IBID_WC_List_Grid();
	}
}

if (!function_exists('ibid_mobile_shop_filters')) {
	add_action( 'woocommerce_before_shop_loop', 'ibid_mobile_shop_filters', 30);
	function ibid_mobile_shop_filters(){
		echo '<a href="#" class="ibid-shop-filters-button btn btn-success hide-on-desktops"><i class="fa fa-filter"></i> '.esc_html__('Filters', 'ibid').'</a>';
	}
}



// WooCommerce My account tab: My Auction Bids
if ( class_exists( 'WooCommerce_simple_auction' ) ) {


	if (!function_exists('ibid_bid_button_text')) {
		function ibid_bid_button_text( $product ) {
			if (ibid_redux('ibid_single_product_add_to_cart_btn_style') == 'style_text') {
				return esc_html__('Bid', 'ibid');
			}elseif (ibid_redux('ibid_single_product_add_to_cart_btn_style') == 'style_icon') {
				return '<i class="fa fa-gavel"></i>';
			}else{
				return $product;
			}
		}
		add_filter( 'bid_text', 'ibid_bid_button_text' );
	}


	/**
	* 1. Register new endpoint slug to use for My Account page
	*/
	if (!function_exists('ibid_my_auctions_tab_endpoint')) {
		function ibid_my_auctions_tab_endpoint() {
		    add_rewrite_endpoint( 'my-auction-bids', EP_ROOT | EP_PAGES );
		}
		add_action( 'init', 'ibid_my_auctions_tab_endpoint' );
	}

	/**
	 * 2. Add new query var
	 */
	if (!function_exists('ibid_my_auctions_tab_query_vars')) {
		function ibid_my_auctions_tab_query_vars( $vars ) {
		    $vars[] = 'my-auction-bids';
		    return $vars;
		}
		add_filter( 'woocommerce_get_query_vars', 'ibid_my_auctions_tab_query_vars', 0 );
	}

	/**
	 * 3. Insert the new endpoint into the My Account menu
	 */
	if (!function_exists('ibid_my_auctions_tab_link_my_account')) {
		function ibid_my_auctions_tab_link_my_account( $items ) {
		    $items['my-auction-bids'] = esc_html__('My Auction Bids', 'ibid');
		    return $items;
		}
		add_filter( 'woocommerce_account_menu_items', 'ibid_my_auctions_tab_link_my_account' );
	}

	/**
	* 4. Add content to the new endpoint
	*/
	if (!function_exists('ibid_my_auctions_tab_content')) {
		function ibid_my_auctions_tab_content() {
			echo do_shortcode( '[woocommerce_simple_auctions_my_auctions]' );
		}
		add_action( 'woocommerce_account_my-auction-bids_endpoint', 'ibid_my_auctions_tab_content' );
	}
}


if (!function_exists('ibid_custom_search_form')) {
	// add_action('ibid_products_search_form','ibid_custom_search_form');
	function ibid_custom_search_form(){ ?>
		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label>
		        <input type="hidden" name="post_type" value="product" />
				<input type="search" class="search-field" placeholder="<?php echo esc_attr__( 'Search...', 'ibid' ); ?>" value="" name="s">
				<input type="submit" class="search-submit" value="&#xf002">
			</label>
		</form>
	<?php }
}


if (!function_exists('ibid_auction_mask_display_name')) {
	if ( class_exists( 'WooCommerce_simple_auction' ) && class_exists( 'WooCommerce' )) {
		add_filter( 'woocommerce_simple_auctions_displayname', 'ibid_auction_mask_display_name' );
		function ibid_auction_mask_display_name( $displayname ) {
		    if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
		    	return $displayname;
		    } else {

		    	if (class_exists('ReduxFrameworkPlugin')) {
		    		if (ibid_redux('ibid_single_product_auction_history_username_format') == 'original') {
		    			return $displayname;
		    		}elseif (ibid_redux('ibid_single_product_auction_history_username_format') == 'hide_username') {
				        $length      = strlen( $displayname );
				        $displayname = $displayname[0] . str_repeat( '*', $length - 2 ) . $displayname[ $length - 1 ];
		    		}elseif (ibid_redux('ibid_single_product_auction_history_username_format') == 'show_message') {
				    	return esc_html__( 'Bidder Name Hidden', 'ibid' );
		    		}elseif (ibid_redux('ibid_single_product_auction_history_username_format') == 'user_id') {
					    
					    global $wpdb;
					    $users = $wpdb->get_results("SELECT ID FROM $wpdb->users WHERE display_name = '$displayname'");
					    if ($users) {
					    	$user_id = $users[0]->ID;
				    		return esc_html__('#', 'ibid').esc_html($user_id);
					    }else{
				    		return '';
					    }

		    		}elseif (ibid_redux('ibid_single_product_auction_history_username_format') == 'hidden') {
				    	return '';
		    		}
		    	}

		    }

		    return $displayname;
		}
	}
}

// Add to cart Projects
if (!function_exists('ibid_single_price')) {
	function ibid_single_price(){
		 if ( class_exists( 'WooCommerce_simple_auction' ) ) {
            $meta_auction_dates_to = get_post_meta( get_the_ID(), '_auction_dates_to', true );
            $meta_auction_closed = get_post_meta( get_the_ID(), '_auction_closed', true );
            $meta_auction_current_bid = get_post_meta( get_the_ID(), '_auction_current_bid', true );
            $meta_auction_start_price = get_post_meta( get_the_ID(), '_auction_start_price', true );

            $_product = wc_get_product( get_the_ID() );
            if( $_product->is_type( 'auction' ) ) {
                if ($meta_auction_closed == '') {
                    if (!empty($meta_auction_current_bid)) {
                        echo '<span class="price">'.esc_html__('Current Bid: ', 'ibid').wc_price($meta_auction_current_bid).'</span>';
                    }else{
                        echo '<span class="price">'.esc_html__('Starting bid: ', 'ibid').wc_price($meta_auction_start_price).'</span>';
                    }
                }else{
                    echo esc_html__('Auction Ended', 'ibid');
                }
            }else{
                wc_get_template( 'loop/price.php' );
            }
        }else{
            wc_get_template( 'loop/price.php' );
        }
        echo '<div class="modeltheme-button-bid text-center">
                <a href="'.esc_url(get_permalink(get_the_ID())).'">'.esc_html__('Bid Now','ibid').'</a>
             </div>';
    }
}

// Add project breadcrumbs
if (!function_exists('ibid_tab_header')) {
	function ibid_tab_header(){
		 echo '<div class="project-tabs"> 
			 	<ul>
			 		<li><a data-scroll href="#tab-description"> '.esc_html__('Details','ibid').'</a></li>
			 		<li><a data-scroll href="#tab-simle_auction_history"> '.esc_html__('Proposals','ibid').'</a></li>
			 	</ul>
			 </div>';
    }
}


// Add "Attachments" Tab
if (!function_exists('ibid_attach_pdf_product_tab')) {
	add_filter( 'woocommerce_product_tabs', 'ibid_attach_pdf_product_tab' );
	function ibid_attach_pdf_product_tab( $tabs ) {
	// Adds the new tab
		$ibid_pdf_attach = get_post_meta( get_the_ID(), 'ibid_pdf_attach', true );
	  	if($ibid_pdf_attach) {
		    $tabs['attach_tab'] = array(
		        'title'     => esc_html__( 'Attachments', 'ibid' ),
		        'callback'  => 'ibid_attach_pdf_product_tab_content'
		    );
		}
	    return $tabs;
	}
}
if (!function_exists('ibid_attach_pdf_product_tab_content')) {
	function ibid_attach_pdf_product_tab_content() {
	  $ibid_pdf_attach = get_post_meta( get_the_ID(), 'ibid_pdf_attach', true );
	  if($ibid_pdf_attach) {
		  echo '<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--attach panel entry-content wc-tab" id="attach-pdf" role="tabpanel" aria-labelledby="tab-attach-pdf">';
		  	echo '<h2>'.esc_html__('Attachments','ibid').'</h2>';
		  	echo '<a class="button btn" target="_blank" href="'.esc_url($ibid_pdf_attach).'">'.esc_html__('Download Brief','ibid').'</a>';
		  echo '</div>';
		}
	}
}

// Views counter on single
if (!function_exists('ibid_count_views')) {
	function ibid_count_views() {
	    global $product;   
	    $product_pageviews = get_post_meta(  get_the_ID(), 'pageview', true );
	    if ($product_pageviews) {
		    echo '<div class="mt-view-count"><i class="fa fa-eye"></i>';
		        echo '<span class="views">'.sprintf( _n( '%s view', '%s views', $product_pageviews, 'ibid' ), number_format_i18n( $product_pageviews ) ).'</span>';
		    echo '</div>';
	    }
	}
}


if(!class_exists('Mt_Freelancer_Mode') or get_option("freelancer_enabled") == "no") {
  if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
	if($ibid_redux['ibid_bid_message'] == true) {

	// Add note with bid
	if (!function_exists('ibid_custom_add_coment_textarea_on_bid')) { 
		function ibid_custom_add_coment_textarea_on_bid(){
			global $product, $ibid_redux;
			
			echo '<div class="coment-on-bid theme" style="clear:both">';
				echo '<textarea name="coment_on_bid" placeholder="'.esc_html__('Send a message with this bid*','ibid').'"></textarea>';
			echo '</div>';	
		}
	}
	add_action( 'woocommerce_after_bid_button', 'ibid_custom_add_coment_textarea_on_bid'); 

	if (!function_exists('ibid_check_if_there_is_note_on_bid')) { 
		function ibid_check_if_there_is_note_on_bid($product_data){
			global $_POST, $ibid_redux;

			if( (!isset($_POST['coment_on_bid'] ) or !$_POST['coment_on_bid']) ){
				wc_add_notice(esc_html__('You must add a note to your bid!', 'ibid'), 'error');
				return false;	
			}
			return $product_data;						
		}
	}
	add_filter( 'woocommerce_simple_auctions_before_place_bid_filter', 'ibid_check_if_there_is_note_on_bid');

	if (!function_exists('ibid_add_note_woocommerce_simple_auction_admin_history_header')) { 
		function ibid_add_note_woocommerce_simple_auction_admin_history_header(){
			global $_POST, $ibid_redux;
			echo '<th>';
				esc_html_e('Note', 'ibid');
			echo '</th>';	
		}
	}
	add_action( 'woocommerce_simple_auction_admin_history_header', 'ibid_add_note_woocommerce_simple_auction_admin_history_header');

	if (!function_exists('ibid_custom_save_comment_on_bid')) {
		function ibid_custom_save_comment_on_bid($log_bid_id, $product_id,$bid, $current_user ){
			global $_POST, $ibid_redux;
			
			if(isset($_POST['coment_on_bid'] ) AND $_POST['coment_on_bid']  AND ($log_bid_id )){
				add_post_meta($product_id, 'bid_note_'.$log_bid_id , sanitize_text_field( $_POST['coment_on_bid']),true);
			} 	
		}
	}
	add_action( 'woocommerce_simple_auctions_log_bid', 'ibid_custom_save_comment_on_bid', 10, 4);

	if (!function_exists('ibid_add_note_woocommerce_simple_auction_admin_history_row')) {
		function ibid_add_note_woocommerce_simple_auction_admin_history_row($product, $auction_history){
			global $ibid_redux;
	
			$bid_note = get_post_meta( $product->get_id(), 'bid_note_'.$auction_history->id, true );
			echo '<td>';
				echo esc_attr($bid_note);
			echo '</td>';		
		}
	}
	add_action( 'woocommerce_simple_auction_admin_history_row', 'ibid_add_note_woocommerce_simple_auction_admin_history_row',10,2);
 } 
}}

//Extend Auction End Time
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
	if ($ibid_redux['ibid_extend_bid_time'] == true) {

		add_action( 'woocommerce_simple_auctions_outbid', 'ibid_woocommerce_simple_auctions_extend_timer', 50 );
		add_action( 'woocommerce_simple_auctions_proxy_outbid', 'ibid_woocommerce_simple_auctions_extend_timer', 50 );

		if (!function_exists('ibid_woocommerce_simple_auctions_extend_timer')) {
			function ibid_woocommerce_simple_auctions_extend_timer($data) {

				$product_id = $data['product_id'];
				$product = wc_get_product( $product_id );
			 
			    if ('auction' === $product->get_type() ) {
			        $auctionend = new DateTime($product->get_auction_dates_to());
			        $auctionendformat = $auctionend->format('Y-m-d H:i:s');
			        $time = current_time( 'timestamp' );
			        $timemplus_redux = '+'.$ibid_redux['ibid_extend_bid_in_last_time'].' '.$ibid_redux['ibid_extend_bid_in_last_time_type'];
			        $timeplus5 = date('Y-m-d H:i:s', strtotime($timemplus_redux, $time)); // if bid is placed in less than 5 minutes before auction end time
			 
			        if (ibid_redux('ibid_extend_bid_time_type') == 'M') {
			        	$extend_with_seconds = ibid_redux('ibid_extend_bid_time_nr')*60;
			        }elseif(ibid_redux('ibid_extend_bid_time_type') == 'H'){
			        	$extend_with_seconds = ibid_redux('ibid_extend_bid_time_nr')*3600;
			        }else{
			        	$extend_with_seconds = ibid_redux('ibid_extend_bid_time_nr');
			        }

			        if ($timeplus5 > $auctionendformat) {
			        	$extend_with = 'PT'.esc_attr($extend_with_seconds).'S';
			            $auctionend->add(new DateInterval($extend_with)); // extend auction end time for 120 seconds
			            update_post_meta( $data['product_id'], '_auction_dates_to', $auctionend->format('Y-m-d H:i:s') );
			        }
			    }
			}
		}
	}
}



//Nextend Social Links
if (class_exists('NextendSocialLogin') && !class_exists('NextendSocialLoginPRO')) {
	if (!function_exists('ibid_get_social_btns_form')) {

		function ibid_get_social_btns_form() {
			echo do_shortcode('[nextend_social_login]');
		}

		add_action('woocommerce_after_customer_login_form','ibid_get_social_btns_form');
		// add_action('woocommerce_login_form_end','ibid_get_social_btns_form');
		// add_action('woocommerce_register_form_end','ibid_get_social_btns_form');
	}
}




//Shortcode : Selling value
if (!function_exists('ibid_product_selling_value')) {
	function ibid_product_selling_value( $id='' ) {
	       
	    // GET CURRENT USER ORDERS
	    $all_orders = wc_get_orders(
	        array(
	            'limit'    => -1,
	            'status'   => array( 'completed', 'processing'),
	        )
	    );
	    
	    $count = 0;
	    if($id) {
		    if($all_orders) {
			    foreach ( $all_orders as $single_order ) {
			        $order = wc_get_order( $single_order->get_id() );
			        $items = $order->get_items();
			        foreach ( $items as $item ) {
			            $product_id = $item->get_product_id();
			            if ( $product_id == $id ) {
			                $count = $count + absint( $item->get_total() ); 
			            }
			        }
			    }
		    }
		}
	    // RETURN HTML
	    return $count;
	}
}

// define the woocommerce_before_add_to_cart_form callback
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
	if ($ibid_redux['ibid_enable_fundraising'] == 'enable'){
		if (!function_exists('ibid_fundraising_stats_before_add_to_cart_form')) { 
			function ibid_fundraising_stats_before_add_to_cart_form() { 
		
		    $product_cause_id = get_post_meta( get_the_ID(), 'product_cause', true );
		    $money_goal = get_post_meta( $product_cause_id, 'cause_goal', true );
		    $variable_end_date = get_post_meta( $product_cause_id, 'mt_variable_end_date', true );
		    ?>
		    <?php if ( is_product() ){ ?>
		        <?php if (isset($money_goal) && !empty($money_goal)) { ?>
		            <?php 
		            $current_raised_money = ibid_product_selling_value(get_the_ID());
		            $goal_percentage = ($current_raised_money !== 0 ? ($current_raised_money / $money_goal) : 0) * 100;
		            $ending_datetime = date('Y-m-d H:i', strtotime($variable_end_date));
		            $blogtime = current_time( 'mysql' );
		            $blogtime_format = date('Y-m-d H:i', strtotime($blogtime));

		            ?>
		            <div class="campaign_donation_holder col-md-12 col-xs-12">
		                <div class="campaign_summary">

	                        <?php echo '<div class="ibid-supported-cause"><i class="fa fa-heart-o" aria-hidden="true"></i> '.esc_html__('Supporting: ', 'ibid').'<a class="cause-child" href="'.get_the_permalink($product_cause_id).'">'.get_the_title($product_cause_id).'</a></div>'; ?>

		                    <?php if($ending_datetime < $blogtime_format){ ?>
		                        <h3 class="text-center"><?php echo esc_html__('This campaign is now over.','ibid') ?></h3> 
		                    <?php } ?>
		                    <div class="progress_text center">
		                        <?php echo number_format($goal_percentage, 2); ?><?php echo esc_html__('% Funded','ibid'); ?>
		                    </div>
		                    <div class="clearfix"></div>
		                    <div class="campaign_procentage progress col-md-12">
		                        <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo number_format($goal_percentage, 2); ?>%;"></div>
		                    </div>

		                    <div class="campaign_donated ">
		                        <h3 class="campaign_donated_value"><span class="amount"><?php echo wc_price($current_raised_money); ?></span> <?php echo esc_html__('donated of','ibid'); ?> <span class="goal-amount"><?php echo wc_price($money_goal); ?></span> <?php echo esc_html__('goal','ibid'); ?></h3>
		                    </div>
		                    <?php if (!empty($variable_end_date)) { ?>
		                        <?php if($ending_datetime > $blogtime_format){ ?>
		                            <div class="campaign_days_left ">
		                                <h3 class="campaign_days_left_value"><?php echo esc_html__('Available until ','ibid') .  date('Y-m-d H:i', strtotime($variable_end_date)); ?></h3>
		                            </div>
		                        <?php } ?>
		                    <?php } ?>
		                </div>
		            </div>
		        <?php } ?>
		    <?php } ?>
	 	<?php }
		} 
		add_action( 'woocommerce_single_product_summary', 'ibid_fundraising_stats_before_add_to_cart_form', 5, 0 ); 
	}


	if (!function_exists('ibid_donation_cause_text_on_grids')) {
		function ibid_donation_cause_text_on_grids($product_id = ''){
		    global $ibid_redux;
		    if ($ibid_redux['ibid_enable_fundraising'] == 'enable') {
		        if(!empty($product_id)){
		            echo '<div class="ibid-supported-cause"><i class="fa fa-heart-o" aria-hidden="true"></i> '.esc_html__('Cause:','ibid').' <a class="cause-child" href="'.esc_url(get_permalink($product_id)).'" title="'. get_the_title($product_id) .'">'. get_the_title($product_id) .'</a></div>';
		        }
		    }
		}
		add_action('ibid_donation_cause_text', 'ibid_donation_cause_text_on_grids');
	}
}


//Single Product : Vendor Section - dokan
if (!function_exists('ibid_vendor_section')) {
	function ibid_vendor_section() {

	global $product, $dokan;
        $seller = $product->post->post_author;
        $author = get_user_by( 'id', $seller );
        $store_info = dokan_get_store_info( $author->ID );
        $vendor = dokan()->vendor->get( $seller );

        echo '<div class="ibid-vendor-section">';
        	echo '<div class="vendor-section-wrapper">';
        		echo '<div class="vendor-header">';
        			echo wp_kses_post( dokan_get_readable_seller_rating( $author->ID ) );
        		echo'</div>';

        		if($vendor->get_shop_name()) {
	        		echo '<div class="single-item">';
	        			echo '<span>'.esc_html__('Store Name: ','ibid').'</span>';
	        			echo '<span class="right">'.esc_attr($vendor->get_shop_name()).'</span>';
	        		echo '</div>';
        		}

        		echo '<div class="single-item">';
        			echo '<span>'.esc_html__('Vendor: ','ibid').'</span>';
        			echo '<a href="'.esc_url( dokan_get_store_url( $author->ID ) ).'"><span class="right">'.esc_attr($author->display_name).'</span></a>';
        		echo '</div>';

        		if(dokan_get_seller_address( $author->ID )) {
	        		echo '<div class="single-item">';
	        			echo '<span>'.esc_html__('Location: ','ibid').'</span>';
	        			echo '<span class="right">'.esc_attr(dokan_get_seller_address( $author->ID )).'</span>';
	        		echo '</div>';
	        	}

        	echo '</div>';
        echo '</div>';

	}
	if (class_exists('Dokan_Template_Products')) {
		add_action('woocommerce_ibid_vendor_section','ibid_vendor_section');
	}
}

//Single Product : Meta after Title
if (!function_exists('ibid_meta_after_title')) {
	function ibid_meta_after_title(){
		global $product;

		echo '<div class="ibid-title-meta-section">';
			echo '<div class="meta-section-item">';
				echo '<span>'.esc_html__('Views: ','ibid').'</span>';
				echo '<span>'.ibid_count_views().'</span>';
			echo '</div>';

			if ( $product->get_type() === 'auction'){
				if($product->get_condition()) {
					echo '<div class="meta-section-item">';
						echo '<span>'.esc_html__('Condition: ','ibid').'</span>';
						echo '<span><strong>'.esc_attr($product->get_condition()).'</strong></span>';
					echo '</div>';
				}
			}

			if($product->get_sku()) {
				echo '<div class="meta-section-item">';
					echo '<span>'.esc_html__('SKU: ','ibid').'</span>';
					echo '<span><strong>'.esc_attr($product->get_sku()).'</strong></span>';
				echo '</div>';
			}
		echo '</div>';
	}
	add_action('woocommerce_ibid_meta_after_title','ibid_meta_after_title');
}

if (!function_exists('ibid_search_form_categories_dropdown')) {
	function ibid_search_form_categories_dropdown(){
		 
		if(isset($_REQUEST['product_cat']) && !empty($_REQUEST['product_cat'])) {
			$optsetlect=$_REQUEST['product_cat'];
		} else {
			$optsetlect=0;  
		}

		$args = array(
			'show_option_none' => esc_html__( 'Category', 'ibid' ),
			'option_none_value'  => '',
			'hierarchical' => true,
			'class' => 'cat',
			'echo' => 1,
			'value_field' => 'slug',
			'orderby' => 'name',
			'show_count' => true,
			'hide_empty' => true,
			'selected' => $optsetlect
		);

		$args['taxonomy'] = 'product_cat';
		$args['name'] = 'product_cat';              
		$args['class'] = 'form-control1';

		wp_dropdown_categories($args);
			
	}
	add_action('ibid_products_search_form', 'ibid_search_form_categories_dropdown');
	add_action('ibid_header1_search_form_before', 'ibid_search_form_categories_dropdown');
	add_action('ibid_header2_search_form_before', 'ibid_search_form_categories_dropdown');
	add_action('ibid_header4_search_form_before', 'ibid_search_form_categories_dropdown');
	add_action('ibid_header5_search_form_before', 'ibid_search_form_categories_dropdown');
	// add_action('ibid_header6_search_form_before', 'ibid_search_form_categories_dropdown');
	// add_action('ibid_header8_search_form_before', 'ibid_search_form_categories_dropdown');
	// add_action('ibid_header9_search_form_before', 'ibid_search_form_categories_dropdown');
}


// Function to handle the thumbnail request
function ibid_get_the_post_thumbnail_src($img)
{
  return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : '';
}
