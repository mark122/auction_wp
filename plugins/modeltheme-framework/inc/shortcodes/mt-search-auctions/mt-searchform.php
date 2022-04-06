<?php 
/**
||-> Shortcode: Car Search
*/
function modeltheme_shortcode_ico_search($params, $content) {
    extract( shortcode_atts( 
        array(
            'width_type'                  =>'',
            'popular_searches'                =>'',
            'animation'                   =>'',
            'mtsearchform_style_variant'        =>'',
            'extra_class'                   =>'',
        ), $params ) );
    
    $html = '';
    if (isset($btn_background_color_hover)) {
        $html .= '<style>
                  .slider-state-submit button:hover,
                  .mtsearchform-style-v2.mt-car-search .slider-state-submit button:before{
                    background: '.$btn_background_color_hover.' !important;
                  }
                  .mt-car-search .select2-container--default .select2-selection--single .select2-selection__rendered {
                      color: '.$mt_ico_search_text_color.' !important;
                  }
                  .mt-car-search .slider-state-search .search-field.form-control::-webkit-input-placeholder{
                      color: '.$mt_ico_search_text_color.' !important;
                  }
                  .mt-car-search .slider-state-search .search-field.form-control::-moz-placeholder{
                      color: '.$mt_ico_search_text_color.' !important;
                  }
                  .mt-car-search .slider-state-search .search-field.form-control:-ms-input-placeholder{
                      color: '.$mt_ico_search_text_color.' !important;
                  }
                  .mt-car-search .slider-state-search .search-field.form-control:-moz-placeholder{
                      color: '.$mt_ico_search_text_color.' !important;
                  }
                  .mt-car-search .search-field.form-control {
                       color: '.$mt_ico_search_text_color.' !important;
                  }
                  .mt-car-search .select2.select2-container .select2-selection .select2-selection__arrow::before{
                      color: '.$mt_ico_search_text_color.' !important;
                  }
                  .mtsearchform-style-v2.mt-car-search .slider-state-submit input {
                      border-color: '.$btn_background_color_normal.' !important;
                  }
                  .mtsearchform-style-v2.mt-car-search .slider-state-submit button:hover {
                      border-color: '.$btn_background_color_hover.' !important;
                  }
                  .mtsearchform-style-v2.mt-car-search .submit .form-control:hover{
                      color: '.$btn_text_color.' !important;
                  }
                </style>';
    }

    $html .= '<div class="mt-product-search mt-product-search-shortcode wow '.esc_attr($animation).' '.$mtsearchform_style_variant.' '.$extra_class.'">
                <div class="ibid-header-searchform">
                    <form name="header-search-form" autocomplete="off" method="GET" class="woocommerce-product-search menu-search" action="' .home_url('/'). '">';
                        $html .= '<input type="hidden" value="product" name="prodyct_cat">
                        <div class="slider-state-select select-categories col-md-3 '.esc_attr($width_type).'">          
                            <select name="product_cat" class="select-car-type form-control">';
                            if(isset($_REQUEST['product_cat']) && !empty($_REQUEST['product_cat'])) {
                              $optsetlect=$_REQUEST['product_cat'];
                            } else {
                              $optsetlect=0;  
                            }
                              $terms_c = get_terms( 'product_cat' );
                              $html .= "<option value=''>".esc_html__('Categories','modeltheme')."</option>";
                              foreach ($terms_c as $term) {
                                $html .= "<option value='{$term->slug}'>{$term->name}</option>";
                              }
                            $html .= '</select>
                          </div>

                        <div class="slider-state-search col-md-8 '.esc_attr($width_type).'">
                            <input type="search" class="search-field form-control search-keyword" placeholder="'.esc_html__( 'Search products...','modeltheme' ).'" value="'.get_search_query().'" name="s" onkeyup="ibid_fetch_products()" />
                        </div>

                        <div class="slider-state-submit col-md-1 '.esc_attr($width_type).' submit">
                            <button type="submit" class="form-control btn btn-warning"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                        <input type="hidden" name="post_type" value="product" />
                    </form>
                  <div class="data_fetch"></div>
                </div>
              </div>';
    return $html;
}
add_shortcode('mt_ico_search', 'modeltheme_shortcode_ico_search');
