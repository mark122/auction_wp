<?php
namespace Elementor;

class ibid_shop_categories_with_grids_widget extends Widget_Base {
	
	public function get_name() {
		return 'shop-categories-with-grids';
	}
	
	public function get_title() {
		return 'iBid - Products Table (Products Grid)';
	}
	
	public function get_icon() {
		return 'fab fa-elementor';
	}
	
	public function get_categories() {
		return [ 'ibid-widgets' ];
	}
	
	

	protected function _register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'modeltheme' ),
			]
		);

		$product_category = array();
        if ( class_exists( 'WooCommerce' ) ) {
          $product_category_tax = get_terms( 'product_cat', array(
            'parent'      => '0'
          ));
          if ($product_category_tax) {
            foreach ( $product_category_tax as $term ) {
              if ($term) {
                $product_category[$term->name] = $term->slug;
              }
            }
          }
        }
		$this->add_control(
			'number',
			[
			'label' => __( 'Number of products to show', 'modeltheme' ),
			'label_block' => true,
			'type' => Controls_Manager::TEXT,
			'default' => '4',
			]
		);
		$this->add_control(
			'product_image_width',
			[
				'label' => __( 'Column: Products Image - width', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'fullwidth' => __( 'Fullwidth of the cell', 'modeltheme' ),
					'small_tile' => __( 'Small tile', 'modeltheme' ),
				]
			]
		);
	    $this->add_control(
			'column_sku',
			[
				'label' => __( 'Column: SKU (Status)', 'modeltheme' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme' ),
				'label_off' => __( 'Hide', 'modeltheme' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'column_current_bid_price',
			[
				'label' => __( 'Column: Current Bid value/Price (Status)', 'modeltheme' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme' ),
				'label_off' => __( 'Hide', 'modeltheme' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'column_current_bid_price_label',
			[
				'label' => __( 'Column: Current Bid value/Price (Text)', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$this->add_control(
			'column_expires_on',
			[
				'label' => __( 'Column: Expires On (Status)', 'modeltheme' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme' ),
				'label_off' => __( 'Hide', 'modeltheme' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'column_stock',
			[
				'label' => __( 'Column: Stock (Status)', 'modeltheme' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme' ),
				'label_off' => __( 'Hide', 'modeltheme' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'column_place_bid',
			[
				'label' => __( 'Column: Place Bid (Status)', 'modeltheme' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme' ),
				'label_off' => __( 'Hide', 'modeltheme' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'column_place_bid_label',
			[
				'label' => __( 'Column: Place Bid (Text)', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->end_controls_section();

	}
	
	protected function render() {
		global $ibid_redux;
        $settings 		= $this->get_settings_for_display();
        $number 	= $settings['number'];
        $column_sku 	= $settings['column_sku'];
        $column_stock 	= $settings['column_stock'];
        $product_image_width 	= $settings['product_image_width'];
        $column_current_bid_price 	= $settings['column_current_bid_price'];
        $column_current_bid_price_label 	= $settings['column_current_bid_price_label'];
        $column_expires_on 	= $settings['column_expires_on'];
        $column_place_bid 	= $settings['column_place_bid'];
        $column_place_bid_label 	= $settings['column_place_bid_label'];



        $args = array(
        'post_type'   =>  'product',
        'posts_per_page'  => -1,
        // 'tax_query' => array(
        //     array(
        //         'taxonomy' => 'product_type',
        //         'field'    => 'slug',
        //         'terms'    => 'auction', 
        //     ),
        // ),
        'posts_per_page'  => $number,
        'orderby'     =>  'date',
        'order'       =>  'DESC'
    );

    $prods = new \WP_Query($args);


    $shortcode_content = '';
    $shortcode_content .= '<div class="woocommerce_categories grid">';


        $image_width = '';
        if ($product_image_width == 'small_tile') {
            $image_width = 'small_tile70';
        }

        $shortcode_content .= '<table id="DataTable-icondrops-active" class="table" cellspacing="0" width="100%">';
            $shortcode_content .= '<thead>';
                $shortcode_content .= '<tr>';
                    $shortcode_content .= '<th>'.esc_html__('Image','modeltheme').'</th>';
                    $shortcode_content .= '<th>'.esc_html__('Title','modeltheme').'</th>';
                    // SKU
                    if ($column_sku == true) {
                        $shortcode_content .= '<th>'.esc_html__('SKU','modeltheme').'</th>';
                    }
                    // Current Bid/Price
                    if ($column_current_bid_price == true) {
                        if ($column_current_bid_price_label != '') {
                            $current_bid_price_label = $column_current_bid_price_label;
                        }else{
                            $current_bid_price_label = esc_html__('Current Bid','modeltheme');
                        }
                        $shortcode_content .= '<th>'.$current_bid_price_label.'</th>';
                    }
                    // expires on
                    if ($column_expires_on == true) {
                        $shortcode_content .= '<th>'.esc_html__('Expires On','modeltheme').'</th>';
                    }
                    // stock
                    if ($column_stock == true) {
                        $shortcode_content .= '<th>'.esc_html__('In stock','modeltheme').'</th>';
                    }
                    // place bid
                    if ($column_place_bid == true) {
                        if ($column_place_bid_label != '') {
                            $place_bid_label = $column_place_bid_label;
                        }else{
                            $place_bid_label = esc_html__('Place Bid','modeltheme');
                        }
                        $shortcode_content .= '<th>'.$place_bid_label.'</th>';
                    }
                $shortcode_content .= '</tr>';
            $shortcode_content .= '</thead>';

            $shortcode_content .= '<tbody>';
            while ($prods->have_posts()) {
                $prods->the_post();
                global $product;

                    $end_time = '';
                    if ($product->get_type() == 'auction'){
                        $end_time = $product->get_auction_end_time();
                    }

                    $shortcode_content .= '<tr>';
                        $shortcode_content .= '<td class="featured-image '.$image_width.'">'.get_the_post_thumbnail( $prods->post->ID, 'ibid_member_pic350x350' ).'</td>';
                        $shortcode_content .= '<td class="product-title"><a href="'.get_permalink().'">'.$product->get_title().'</a></td>';
                        // SKU
                        if ($column_sku == true) {
                            $shortcode_content .= '<td>'.$product->get_sku().'</td>';
                        }
                        // Current Bid/Price
                        if ($column_current_bid_price == true) {
                            $shortcode_content .= '<td>'.$product->get_price_html().'</td>';
                        }
                        // expires on
                        if ($column_expires_on == true) {
                            $shortcode_content .= '<td>' .$end_time.'</td>';
                        }
                        // stock
                        if ($column_stock == true) {
                            if ($product->get_stock_status() == 'instock') {
                                $stock_text = '<span class="label label-success">'.__('In Stock','modeltheme').'</span>';
                            }elseif ($product->get_stock_status() == 'outofstock') {
                                $stock_text = '<span class="label label-danger">'.__('Out Of Stock','modeltheme').'</span>';
                            }elseif ($product->get_stock_status() == 'onbackorder') {
                                $stock_text = '<span class="label label-info">'.__('On backorder','modeltheme').'</span>';
                            }else{
                                $stock_text = '<span class="label label-default">'.$product->get_stock_status().'</span>';
                            }
                            $shortcode_content .= '<td class="'.$product->get_stock_status().'">'.$stock_text.'</td>';
                        }
                        // place bid
                        if ($column_place_bid == true) {
                            $shortcode_content .= '<td class="add-cart"><a href="' . esc_url( $product->add_to_cart_url() ) . '" data-quantity="1" class="button product_type_'.$product->get_type().' add_to_cart_button ajax_add_to_cart" data-product_id="'.esc_attr(get_the_ID()).'" aria-label="Add <'.esc_attr(get_the_title()).'> to your cart" rel="nofollow">'.$product->add_to_cart_text().'</a></td>';   
                        }

                    $shortcode_content .= '</tr>';
            }
                            
        $shortcode_content .= '</tbody>';
        $shortcode_content .= '</table>';
                       
    $shortcode_content .= '</div>';

    wp_reset_postdata();

    echo $shortcode_content;
    
}
	
	protected function _content_template() {

    }
	
	
}