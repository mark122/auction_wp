<?php 

function ibid_multi_categ_search($params, $content) {
    extract( shortcode_atts( 
        array(
            'width_type'                  =>'',
            'extra_class'                 =>''
        ), $params ) );

    
    $html = '';
    $html .= '<div class="mt-product-search mt-multicateg '.$extra_class.'">
                <div class="ibid-header-searchform tabs">
                  <nav>
                    <ul>';
                    $terms_c = get_terms( 'product_cat' );
                    $html .= '<li><a href="#form-1">'.esc_html__('All','modeltheme').'</a></li>';
                    $count = 1;
                     foreach ($terms_c as $term) {
                        $count++;
                        $html .= '<li><a href="#form-'.$count.'">'.$term->name.'</a></li>';
                    }
                    $html .= '</ul>
                  </nav>';
                  $html .= '<div class="content-wrap">';

                    $html .= '<section id="form-1">';
                      $html .= '<form name="header-search-form" method="GET" autocomplete="off" class="woocommerce-product-search menu-search" action="' .home_url('/'). '">';
                     
                      $html .= '
                      <div class="slider-state-search col-md-9 '.esc_attr($width_type).'">
                            <input type="search" class="search-field form-control search-keyword" placeholder="'.esc_html__( 'Search all products...','modeltheme' ).'" value="'.get_search_query().'" name="s" onkeyup="ibid_fetch_products()" />
                      </div>
                      <div class="slider-state-submit col-md-3 '.esc_attr($width_type).' submit">
                            <button type="submit" class="form-control btn btn-warning"><i class="fa fa-search" aria-hidden="true"></i>'.esc_html__('Search','modeltheme').'</button>
                          </div>
                      <input type="hidden" name="post_type" value="product" />
                      </form>
                        <div class="data_fetch"></div>
                    </section>';
                    $c = 1;
                    foreach ($terms_c as $term) {
                      $c++;
                      $html .= '<section id="form-'.$c.'">';
                        $html .= '<form name="header-search-form" method="GET" autocomplete="off" class="woocommerce-product-search menu-search" action="' .home_url('/'). '">';
                        $html .= '<input type="hidden" value="'.$term->slug.'" name="product_cat">';
                        
                        $html .= '
                        <div class="slider-state-search col-md-9 '.esc_attr($width_type).'">
                              <input type="search" class="search-field form-control search-keyword" placeholder="'.esc_html__( 'Search in','modeltheme' ).' '.$term->name.'" value="'.get_search_query().'" name="s" onkeyup="ibid_fetch_products()" />
                        </div>
                        <div class="slider-state-submit col-md-3 '.esc_attr($width_type).' submit">
                              <button type="submit" class="form-control btn btn-warning"><i class="fa fa-search" aria-hidden="true"></i>'.esc_html__('Search','modeltheme').'</button>
                            </div>
                        <input type="hidden" name="post_type" value="product" />
                        </form>
                        <div class="data_fetch"></div>
                      </section>';
                    }
                  $html .= '</div>

                </div>
              </div>';
    return $html;
}
add_shortcode('multi_categ_search', 'ibid_multi_categ_search');
