<?php
namespace Elementor;

class ibid_domain_categories_with_thumbnails_widget extends Widget_Base {
  
  public function get_name() {
    return 'domain-categories';
  }
  
  public function get_title() {
    return 'iBid - Domains List View';
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
      'category',
      [
        'label' => __( 'Select Domain Category', 'modeltheme' ),
        'label_block' => true,
        'type' => Controls_Manager::SELECT,
        'options' => $product_category,
      ]
    );

    $this->add_control(
      'number',
      [
        'label' => __( 'Number of items to show', 'modeltheme' ),
        'label_block' => true,
        'type' => Controls_Manager::TEXT,
        'default' => '4',
      ]
    );
    $this->add_control(
      'number_of_columns',
      [
        'label' => __( 'Products per column', 'modeltheme' ),
        'label_block' => true,
        'type' => Controls_Manager::SELECT,
        'default' => '2',
        'options' => [
          '1' => __( '1', 'modeltheme' ),
          '2' => __( '2', 'modeltheme' ),
        ]
      ]
    );

    $this->add_control(
      'items_per_row',
      [
        'label' => __( 'Items Per Row', 'modeltheme' ),
        'label_block' => true,
        'type' => Controls_Manager::SELECT,
        'default' => '2',
        'options' => [
          'col-md-12' => __( '1 Items/Row', 'modeltheme' ),
          'col-md-6'  => __( '2 Items/Row', 'modeltheme' ),
        ]
      ]
    );

    $this->end_controls_section();

  }
  
  protected function render() {
    global $ibid_redux;
        $settings                         = $this->get_settings_for_display();
        $category                         = $settings['category'];
        $number                           = $settings['number'];
        $number_of_products_by_category   = $settings['number_of_products_by_category'];
        $items_per_row                    = $settings['items_per_row'];
        $number_of_columns                = $settings['number_of_columns'];


   $args = array(
        'post_type'   =>  'product',
        'posts_per_page'  => $number_of_products_by_category,
        'orderby'     =>  'date',
        'order'       =>  'DESC'
    );

    $blogposts = new \WP_Query($args);


    $shortcode_content = '';
    $shortcode_content .= '<div class="domain woocommerce_categories list">';

            $shortcode_content .= '<div class="domains_category">';
                if ( $blogposts->have_posts() ) {
                  while ($blogposts->have_posts()) {
                    $blogposts->the_post();
                global $product; 
                $shortcode_content .= '
                    <div class="'.$items_per_row.' domain-list-shortcode">
                        <div class="col-md-12 post">
                            <div class="woocommerce-title-metas">
                                <h3 class="archive-product-title">
                                      <a href="'.get_permalink().'"</a>'.$product->get_title().'</a>
                                </h3>
                            </div>';
                            $shortcode_content .= '
                            <div class="domain-bid">';
                             
                              ob_start();
                              // Hooked from modeltheme-framework.php - ibid_get_auction_price_status_for_grids
                              do_action('ibid_shop_products_domains_shortcode_price_and_button', get_the_ID(), 'button_on');
                              $shortcode_content .= ob_get_clean();
                           
                            $shortcode_content .= '</div>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</div>';
                }
            $shortcode_content .= '</div>';
        $shortcode_content .= '</div>';

    wp_reset_postdata();
}
    echo $shortcode_content;
}
  
  protected function _content_template() {

  }
  
  
}