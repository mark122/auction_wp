<?php
defined( 'ABSPATH' ) || exit;

// Logo Source
if (!function_exists('ibid_logo_source')) {
    function ibid_logo_source(){
        
        // REDUX VARIABLE
        global $ibid_redux;
        // html VARIABLE
        $html = '';
        // Metaboxes
        $mt_custom_header_options_status = get_post_meta( get_the_ID(), 'ibid_custom_header_options_status', true );
        $mt_metabox_header_logo = get_post_meta( get_the_ID(), 'ibid_metabox_header_logo', true );
        if (is_page()) {
            if (isset($mt_custom_header_options_status) && isset($mt_metabox_header_logo) && $mt_custom_header_options_status == 'yes') {
                $html .='<img src="'.esc_url($mt_metabox_header_logo).'" alt="'.esc_attr(get_bloginfo()).'" />';
            }else{
                if(!empty($ibid_redux['ibid_logo']['url'])){
                    $html .='<img src="'.esc_url($ibid_redux['ibid_logo']['url']).'" alt="'.esc_attr(get_bloginfo()).'" />';
                }else{ 
                    $html .= $ibid_redux['ibid_logo_text'];
                }
            }
        }else{
            if(!empty($ibid_redux['ibid_logo']['url'])){
                $html .='<img src="'.esc_url($ibid_redux['ibid_logo']['url']).'" alt="'.esc_attr(get_bloginfo()).'" />';
            }elseif(isset($ibid_redux['ibid_logo_text'])){ 
                $html .= $ibid_redux['ibid_logo_text'];
            }else{
                $html .= esc_html(get_bloginfo());
            }
        }
        return $html; 
    }
}
// Logo Area
if (!function_exists('ibid_logo')) {
    function ibid_logo(){
    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
        global $ibid_redux;
        // html VARIABLE
        $html = '';
        $html .='<div class="logo logo-image">';
            $html .='<a href="'.esc_url(get_site_url()).'">';
                $html .= ibid_logo_source();
            $html .='</a>';
        $html .='</div>';
        return $html;
        // REDUX VARIABLE
     } else {
        global $ibid_redux;
        // html VARIABLE
        $html = '';
        $html .='<div class="logo logo-h">';
            $html .='<a href="'.esc_url(get_site_url()).'">';
                $html .= esc_html(get_bloginfo());
            $html .='</a>';
        $html .='</div>';
        return $html;
     } 
    }
}
// Add specific CSS class by filter
if (!function_exists('ibid_body_classes')) {
    function ibid_body_classes( $classes ) {
        global  $ibid_redux;
        $plugin_redux_status = '';
        if ( ! class_exists( 'ReduxFrameworkPlugin' ) ) {
            $plugin_redux_status = 'missing-redux-framework';
        }
        $plugin_modeltheme_status = '';
        if ( ! class_exists( 'ReduxFrameworkPlugin' ) ) {
            $plugin_modeltheme_status = 'missing-modeltheme-framework';
        }
        // CHECK IF FEATURED IMAGE IS FALSE(Disabled)
        $post_featured_image = '';
        if (is_single()) {
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                if ($ibid_redux['post_featured_image'] == false) {
                    $post_featured_image = 'hide_post_featured_image';
                }else{
                    $post_featured_image = '';
                }
            }
        }
        // CHECK IF THE NAV IS STICKY
        $is_nav_sticky = '';
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            if ($ibid_redux['is_nav_sticky'] == true) {
                // If is sticky
                $is_nav_sticky = 'is_nav_sticky';
            }else{
                // If is not sticky
                $is_nav_sticky = '';
            }
        }
        // CHECK IF THE NAV IS STICKY
        $is_category_menu = '';
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            if ($ibid_redux['ibid_header_category_menu_mobile'] == true) {
                // If is sticky
                $is_category_menu = 'is_category_menu';
            }else{
                // If is not sticky
                $is_category_menu = '';
            }
        }
        // DIFFERENT HEADER LAYOUT TEMPLATES
        $header_version = 'first_header';
        if (is_page()) {
            $mt_custom_header_options_status = get_post_meta( get_the_ID(), 'ibid_custom_header_options_status', true );
            $mt_header_custom_variant = get_post_meta( get_the_ID(), 'ibid_header_custom_variant', true );
            $header_version = 'first_header';
            if (isset($mt_custom_header_options_status) AND $mt_custom_header_options_status == 'yes') {
                if ($mt_header_custom_variant == '1') {
                    // Header Layout #1
                    $header_version = 'first_header';
                }elseif ($mt_header_custom_variant == '2') {
                    // Header Layout #2
                    $header_version = 'second_header';
                }elseif ($mt_header_custom_variant == '3') {
                    // Header Layout #3
                    $header_version = 'third_header';
                }elseif ($mt_header_custom_variant == '4') {
                    // Header Layout #4
                    $header_version = 'fourth_header';
                }elseif ($mt_header_custom_variant == '5') {
                    // Header Layout #5
                    $header_version = 'fifth_header';
                }elseif ($mt_header_custom_variant == '6') {
                    // Header Layout #6
                    $header_version = 'sixth_header';
                }elseif ($mt_header_custom_variant == '7') {
                    // Header Layout #7
                    $header_version = 'seventh_header';
                }elseif ($mt_header_custom_variant == '8') {
                    // Header Layout #8
                    $header_version = 'eighth_header';
                }elseif ($mt_header_custom_variant == '9') {
                    // Header Layout #8
                    $header_version = 'ninth_header';
                }else{
                    // if no header layout selected show header layout #1
                    $header_version = 'first_header';
                }
            }else{
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    if ($ibid_redux['header_layout'] == 'first_header') {
                        // Header Layout #1
                        $header_version = 'first_header';
                    }elseif ($ibid_redux['header_layout'] == 'second_header') {
                        // Header Layout #2
                        $header_version = 'second_header';
                    }elseif ($ibid_redux['header_layout'] == 'third_header') {
                        // Header Layout #3
                        $header_version = 'third_header';
                    }elseif ($ibid_redux['header_layout'] == 'fourth_header') {
                        // Header Layout #4
                        $header_version = 'fourth_header';
                    }elseif ($ibid_redux['header_layout'] == 'fifth_header') {
                        // Header Layout #5
                        $header_version = 'fifth_header';
                    }elseif ($ibid_redux['header_layout'] == 'sixth_header') {
                        // Header Layout #6
                        $header_version = 'sixth_header';
                    }elseif ($ibid_redux['header_layout'] == 'seventh_header') {
                        // Header Layout #7
                        $header_version = 'seventh_header';
                    }elseif ($ibid_redux['header_layout'] == 'eighth_header') {
                        // Header Layout #8
                        $header_version = 'eighth_header';
                    }elseif ($ibid_redux['header_layout'] == 'ninth_header') {
                        // Header Layout #8
                        $header_version = 'ninth_header';
                    }else{
                        // if no header layout selected show header layout #1
                        $header_version = 'first_header';
                    }
                }
            }
        }else{
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                if ($ibid_redux['header_layout'] == 'first_header') {
                    // Header Layout #1
                    $header_version = 'first_header';
                }elseif ($ibid_redux['header_layout'] == 'second_header') {
                    // Header Layout #2
                    $header_version = 'second_header';
                }elseif ($ibid_redux['header_layout'] == 'third_header') {
                    // Header Layout #3
                    $header_version = 'third_header';
                }elseif ($ibid_redux['header_layout'] == 'fourth_header') {
                    // Header Layout #4
                    $header_version = 'fourth_header';
                }elseif ($ibid_redux['header_layout'] == 'fifth_header') {
                    // Header Layout #5
                    $header_version = 'fifth_header';
                }elseif ($ibid_redux['header_layout'] == 'sixth_header') {
                    // Header Layout #6
                    $header_version = 'sixth_header';
                }elseif ($ibid_redux['header_layout'] == 'seventh_header') {
                    // Header Layout #7
                    $header_version = 'seventh_header';
                }elseif ($ibid_redux['header_layout'] == 'eighth_header') {
                    // Header Layout #8
                    $header_version = 'eighth_header';
                }elseif ($ibid_redux['header_layout'] == 'ninth_header') {
                    // Header Layout #8
                    $header_version = 'ninth_header';
                }else{
                    // if no header layout selected show header layout #1
                    $header_version = 'first_header';
                }
            }
        }

        $wc_vendors_status = '';
        if (class_exists('WC_Vendors')) {
            $wc_vendors_status = 'wc_vendors_active';
        }


        $mt_footer_row1 = '';
        $mt_footer_row2 = '';
        $mt_footer_row3 = '';
        $mt_footer_row4 = '';
        $mt_footer_bottom = '';
        
        $mt_footer_row1_status = get_post_meta( get_the_ID(), 'mt_footer_row1_status', true );
        $mt_footer_row2_status = get_post_meta( get_the_ID(), 'mt_footer_row2_status', true );
        $mt_footer_row3_status = get_post_meta( get_the_ID(), 'mt_footer_row3_status', true );
        $mt_footer_bottom_bar = get_post_meta( get_the_ID(), 'mt_footer_bottom_bar', true );

        if (isset($mt_footer_row1_status) && !empty($mt_footer_row1_status)) {
            $mt_footer_row1 = 'hide-footer-row-1';
        }
        if (isset($mt_footer_row2_status) && !empty($mt_footer_row2_status)) {
            $mt_footer_row2 = 'hide-footer-row-2';
        }
        if (isset($mt_footer_row3_status) && !empty($mt_footer_row3_status)) {
            $mt_footer_row3 = 'hide-footer-row-3';
        }
        if (isset($mt_footer_bottom_bar) && !empty($mt_footer_bottom_bar)) {
            $mt_footer_bottom = 'hide-footer-bottom';
        }


        $classes[] = esc_attr($mt_footer_row1) . ' ' . esc_attr($mt_footer_row2) . ' ' . esc_attr($mt_footer_row3) . ' ' . esc_attr($mt_footer_bottom) . ' ' . esc_attr($wc_vendors_status) . ' ' . esc_attr($plugin_modeltheme_status) . ' ' . esc_attr($plugin_redux_status) . ' ' . esc_attr($is_nav_sticky) . ' ' . esc_attr($is_category_menu) . ' ' . esc_attr($header_version) . ' ' . esc_attr($post_featured_image) . ' ';

        return $classes;
    }
    add_filter( 'body_class', 'ibid_body_classes' );
}


// Mobile Dropdown Menu Button
if (!function_exists('ibid_burger_dropdown_button')) {
    function ibid_burger_dropdown_button(){
        echo '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>';
    }
    add_action('ibid_burger_dropdown_button', 'ibid_burger_dropdown_button');
}


// Mobile Burger Aside variant
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
    if ($ibid_redux['ibid_mobile_burger_select'] == 'sidebar') {
        if (!function_exists('ibid_burger_aside_button')) {
            function ibid_burger_aside_button(){
                echo '<button id="aside-menu" type="button" class="navbar-toggle" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>';
            }
            add_action('ibid_before_mobile_navigation_burger', 'ibid_burger_aside_button');
        }
    }
}

if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
    if ($ibid_redux['ibid_mobile_burger_select'] == 'sidebar') {
        if (!function_exists('ibid_burger_aside_menu')) {
            function ibid_burger_aside_menu(){

                global $ibid_redux;
                if( function_exists( 'YITH_WCWL' ) ){
                    $wishlist_url = YITH_WCWL()->get_wishlist_url();
                }else{
                    $wishlist_url = '#';
                }

                echo'<div class="mt-header">
                        <div class="header-aside">
                            <div class="aside-navbar">
                                <div class="aside-tabs">
                                    <a href="#mt-first-menu">'.esc_html__('Menu','ibid').'</a>
                                    <a href="#mt-second-menu">'.esc_html__('Categories','ibid').'</a>
                                </div>
                                <div class="nav-title">'.esc_html__('Menu','ibid').'</div>
                                    <div class="mt-nav-content">
                                        <div class="mt-first-menu">
                                            <div class="bot_nav_wrap">
                                                <ul class="menu nav navbar-nav pull-left nav-effect nav-menu">';
                                                    if ( has_nav_menu( 'primary' ) ) {
                                                    $defaults = array(
                                                        'menu'            => '',
                                                        'container'       => false,
                                                        'container_class' => '',
                                                        'container_id'    => '',
                                                        'menu_class'      => 'menu',
                                                        'menu_id'         => '',
                                                        'echo'            => true,
                                                        'fallback_cb'     => false,
                                                        'before'          => '',
                                                        'after'           => '',
                                                        'link_before'     => '',
                                                        'link_after'      => '',
                                                        'items_wrap'      => '%3$s',
                                                        'depth'           => 0,
                                                        'walker'          => ''
                                                    );
                                                    $defaults['theme_location'] = 'primary';
                                                    wp_nav_menu( $defaults );
                                                    }else{
                                                    echo '<p class="no-menu text-right">';
                                                        echo esc_html__('Primary navigation menu is missing.', 'ibid');
                                                    echo '</p>';
                                                    }   
                                                echo '</ul>
                                            </div>
                                        </div>
                                        <div class="mt-second-menu">';

                                        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                                        echo'<div class="bot_nav_cat_inner">
                                                <div class="bot_nav_cat">
                                                    <ul class="bot_nav_cat_wrap">';
                                                    if ( has_nav_menu( 'category' ) ) {
                                                        $defaults = array(
                                                            'menu'            => '',
                                                            'container'       => false,
                                                            'container_class' => '',
                                                            'container_id'    => '',
                                                            'menu_class'      => 'menu',
                                                            'menu_id'         => '',
                                                            'echo'            => true,
                                                            'fallback_cb'     => false,
                                                            'before'          => '',
                                                            'after'           => '',
                                                            'link_before'     => '',
                                                            'link_after'      => '',
                                                            'items_wrap'      => '%3$s',
                                                            'depth'           => 0,
                                                            'walker'          => ''
                                                        );
                                                        $defaults['theme_location'] = 'category';
                                                        wp_nav_menu( $defaults );
                                                    }else{
                                                        echo '<p class="no-menu text-right">';
                                                            echo esc_html__('Category navigation menu is missing.', 'ibid');
                                                        echo '</p>';
                                                    }
                                            echo'</ul>
                                            </div>
                                        </div>';
                                       }
                                    echo '</div>
                                    </div>
                                    <div class="aside-footer">';
                                        if (isset($ibid_redux['ibid_top_header_order_tracking_link']) && $ibid_redux['ibid_top_header_order_tracking_link'] != '') {
                                            echo '<a class="top-order" href="'.esc_url($ibid_redux['ibid_top_header_order_tracking_link']).'">
                                                <i class="fa fa-truck"></i>'.esc_html__('Order Tracking', 'ibid').'</a>';
                                        }
                                        if( function_exists( 'YITH_WCWL' ) ){
                                            echo '<a class="top-payment" href="'.esc_url($wishlist_url).'">
                                            <i class="fa fa-heart-o"></i>'.esc_html__('Wishlist', 'ibid').'</a>';
                                        }
                                    echo '</div>
                                </div>
                            </div>
                        </div>';
                echo '<div class="aside-bg"></div>';
            }
    add_action('ibid_after_mobile_navigation_burger', 'ibid_burger_aside_menu');
    }
}}


// Mobile Icons Top Group
if (!function_exists('ibid_header_mobile_icons_group')) {
    function ibid_header_mobile_icons_group(){

        if ( class_exists( 'ReduxFrameworkPlugin' ) ) { 
            if (ibid_redux('ibid_header_mobile_switcher_top') == true) {

                $cart_url = "#";
                if ( class_exists( 'WooCommerce' ) ) {
                    $cart_url = wc_get_cart_url();
                }
                #YITH Wishlist rul
                if( function_exists( 'YITH_WCWL' ) ){
                    $wishlist_url = YITH_WCWL()->get_wishlist_url();
                }else{
                    $wishlist_url = '#';
                }

                if (ibid_redux('ibid_header_mobile_switcher_top_search') == true) {
                    echo '<div class="mobile_only_icon_group search">
                                <a href="#" class="mt-search-icon">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                            </div>';
                }
                if (ibid_redux('ibid_header_mobile_switcher_top_cart') == true) {
                    echo '<div class="mobile_only_icon_group cart">
                                <a  href="' .esc_url($cart_url).'">
                                    <i class="fa fa-shopping-basket"></i>
                                </a>
                            </div>';
                }
                if (ibid_redux('ibid_header_mobile_switcher_top_wishlist') == true) {
                    echo '<div class="mobile_only_icon_group wishlist">
                                <a class="top-payment" href="'.esc_url($wishlist_url).'">
                                  <i class="fa fa-heart-o"></i>
                                </a>
                            </div>';
                }

                if(ibid_redux('is_popup_enabled') == true) {
                    if (is_user_logged_in() || is_account_page()) {
                        $user_url = get_permalink( get_option('woocommerce_myaccount_page_id') );;
                        $data_attributes = '';
                    }else{
                        $user_url = '#';
                        $data_attributes = 'data-modal="modal-log-in" class="modeltheme-trigger"';
                    }
                }else{
                    $user_url = get_permalink( get_option('woocommerce_myaccount_page_id') );;
                    $data_attributes = '';
                }

                if (ibid_redux('ibid_header_mobile_switcher_top_account') == true) {
                    echo '<div class="mobile_only_icon_group account">
                                <a href="' .esc_url($user_url). '" '.wp_kses_post($data_attributes).'>
                                    <i class="fa fa-user"></i>
                                </a>
                        </div>';
               }
            }
        }

    }
    add_action('ibid_before_mobile_navigation_burger', 'ibid_header_mobile_icons_group');
}

// Mobile Icons Bottom Group
if (!function_exists('ibid_footer_mobile_icons_group')) {
    function ibid_footer_mobile_icons_group(){

        if ( class_exists( 'ReduxFrameworkPlugin' ) ) { 
            if (ibid_redux('ibid_header_mobile_switcher_footer') == true) {

                $cart_url = "#";
                if ( class_exists( 'WooCommerce' ) ) {
                    $cart_url = wc_get_cart_url();
                }

                #YITH Wishlist rul
                if( function_exists( 'YITH_WCWL' ) ){
                    $wishlist_url = YITH_WCWL()->get_wishlist_url();
                }else{
                    $wishlist_url = '#';
                }
                
                echo '<div class="mobile_footer_icon_wrapper">';
                    if (ibid_redux('ibid_header_mobile_switcher_footer_search') == true) {
                        echo '<div class="col-md-3 search">
                                    <a href="#" class="mt-search-icon">
                                        <i class="fa fa-search" aria-hidden="true"></i>'.esc_html__('Search','ibid').'
                                    </a>
                                </div>';
                    }
                    if (ibid_redux('ibid_header_mobile_switcher_footer_cart') == true) {
                        echo '<div class="col-md-3 cart">
                                    <a  href="' .esc_url($cart_url). '">
                                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>'.esc_html__('Cart','ibid').'
                                    </a>
                                </div>';
                    }
                    if (ibid_redux('ibid_header_mobile_switcher_footer_wishlist') == true) {
                        echo '<div class="col-md-3 wishlist">
                                    <a class="top-payment" href="'  .esc_url($wishlist_url).'">
                                      <i class="fa fa-heart-o"></i>'.esc_html__('Wishlist','ibid').'
                                    </a>
                                </div>';
                    }
                    if (ibid_redux('ibid_header_mobile_switcher_footer_account') == true) {

                        if(ibid_redux('is_popup_enabled') == true) {
                            if (is_user_logged_in() || is_account_page()) {
                                $user_url = get_permalink( get_option('woocommerce_myaccount_page_id') );;
                                $data_attributes = '';
                            }else{
                                $user_url = '#';
                                $data_attributes = 'data-modal="modal-log-in" class="modeltheme-trigger"';
                            }
                        }else{
                            $user_url = get_permalink( get_option('woocommerce_myaccount_page_id') );;
                            $data_attributes = '';
                        }

                        echo '<div class="col-md-3 account">
                                    <a href="' .esc_url($user_url). '" '.wp_kses_post($data_attributes).'>
                                      <i class="fa fa-user"></i>'.esc_html__('Account','ibid').'
                                    </a>
                                </div>';
                    }
                echo '</div>';
            }
        }
    }
    add_action('ibid_before_footer_mobile_navigation', 'ibid_footer_mobile_icons_group');
}

// Top Header Banner
if (!function_exists('ibid_my_banner_header')) {
    function ibid_my_banner_header() {
        echo '<div class="ibid-top-banner text-center">
                    <span class="discount-text">'.ibid_redux('discout_header_text').'</span>
                    <div class="text-center row">';
                    echo do_shortcode('[shortcode_countdown_v2 insert_date="'.ibid_redux('discout_header_date').'"]');
              echo '</div>
              <a class="button btn" href="'.ibid_redux('discout_header_btn_link').'">'.ibid_redux('discout_header_btn_text').'</a>
              </div>';
    }
}

//GET HEADER TITLE/BREADCRUMBS AREA
if (!function_exists('ibid_header_title_breadcrumbs')) {
    function ibid_header_title_breadcrumbs(){
        echo '<div class="ibid-breadcrumbs">';
            echo '<div class="container">';
                echo '<div class="row">';

                    if(!function_exists('bcn_display')){
                        echo '<div class="col-md-12">';
                            echo '<ol class="breadcrumb">';
                                echo ibid_breadcrumb();
                            echo '</ol>';
                        echo '</div>';
                    } else {
                        echo '<div class="col-md-12">';
                            echo '<div class="breadcrumbs breadcrumbs-navxt" typeof="BreadcrumbList" vocab="https://schema.org/">';
                                echo bcn_display();
                            echo '</div>';
                        echo '</div>';
                    }
                    echo '<div class="col-md-12">';
                        if (is_singular('post')) {
                            echo '<h1>'.get_the_title().'</h1>';
                        }elseif (is_singular('cause')) {
                            echo '<h1>'.get_the_title().'</h1>';    
                        }elseif (is_page()) {
                            echo '<h1>'.get_the_title().'</h1>';
                        }elseif (is_singular('product')) {
                            echo '<h1>'.esc_html__( 'Our Shop', 'ibid' ) . get_search_query().'</h1>';
                        }elseif (is_search()) {
                            echo '<h1>'.esc_html__( 'Search Results for: ', 'ibid' ) . get_search_query().'</h1>';
                        }elseif (is_category()) {
                            echo '<h1>'.esc_html__( 'Category: ', 'ibid' ).' <span>'.single_cat_title( '', false ).'</span></h1>';
                        }elseif (is_tag()) {
                            echo '<h1>'.esc_html__( 'Tag: ', 'ibid' ) . single_tag_title( '', false ).'</h1>';
                        }elseif (is_author() || is_archive()) {
                            if (function_exists("is_shop") && is_shop()) {
                            }else{
                                echo '<h1>'.get_the_archive_title().'</h1>';
                            }
                        }elseif (is_home()) {
                            echo '<h1>'.esc_html__( 'From the Blog', 'ibid' ).'</h1>';
                        }
                        
                    echo'</div>';
                    if (is_singular('cause')) {
                        global $ibid_redux;
                        $cause_goal = get_post_meta( get_the_ID(), 'cause_goal', true );
                        if ($cause_goal) {
                            echo '<div class="col-md-12">';
                                echo' <h4>'.esc_html__('Goal: ', 'ibid').'</span>'.esc_html($cause_goal).'</h4>';
                            echo'</div>';
                        }
                    }
                echo'</div>';
            echo'</div>';
        echo'</div>';
    }
}


// Mobile Dropdown Menu Button
if (!function_exists('ibid_get_login_link')) {
    function ibid_get_login_link(){

        if(ibid_redux('is_popup_enabled') == true) {
            if (is_user_logged_in() || is_account_page()) {
                $user_url = get_permalink( get_option('woocommerce_myaccount_page_id') );;
                $data_attributes = '';
            }else{
                $user_url = '#';
                $data_attributes = 'data-modal="modal-log-in" class="modeltheme-trigger"';
            }
        }else{
            $user_url = get_permalink( get_option('woocommerce_myaccount_page_id') );;
            $data_attributes = '';
        }
        ?>

        <a href="<?php echo esc_url($user_url); ?>" <?php echo wp_kses_post($data_attributes); ?>>
            <?php esc_html_e('Sign In','ibid'); ?>
        </a>

        <?php 
    }
    add_action('ibid_login_link_a', 'ibid_get_login_link');
}


/**
*
* Adds the blue donation cause select when editing a product
*
* @since 3.3
*
* @package ibid
*/
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
    if (ibid_redux('ibid_enable_fundraising') == 'enable') {
        if (!function_exists('ibid_charity_select_cause_form_group')) {
            function ibid_charity_select_cause_form_group($product_id){
                ?>
                <?php
                    //Charity metas
                    $meta_product_cause = get_post_meta( $product_id, 'product_cause', true );
                ?>
                <!-- Charity Cause -->
                <h3 class="ibid-relist-auction"><?php esc_html_e( 'Charity Cause', 'ibid' ); ?></h3>
                <div id="auction_tab" class="panel woocommerce_options_panel" style="display: block;">
                    <div class="row">
                        <div class="col-md-4">
                            <p class=" form-field _auction_item_condition_field">
                                <select id="product_cause" name="product_cause" class="form-control select short">
                                    <option value=""><?php esc_html_e( 'Select a Charity Cause', 'ibid' ); ?></option>
                                    <?php
                                    $cause_posts = get_posts( array( 'post_type' => 'cause', 'posts_per_page' => -1) );
                                    foreach ($cause_posts as $cause_post) {
                                        $selected = '';
                                        if ((isset($meta_product_cause) && !empty($meta_product_cause)) && $meta_product_cause == $cause_post->ID) {
                                            $selected = 'selected';
                                        } ?>
                                        <option <?php echo esc_attr($selected); ?> value="<?php echo esc_attr($cause_post->ID); ?>"><?php echo esc_html($cause_post->post_title); ?></option>
                                    <?php } ?>
                                </select>
                            </p>
                        </div>
                        <div class="col-md-8">
                            <p><i><?php esc_html_e( 'If this auction will be charity auction you can select a cause to support, from the dropdown. Otherwise, leave it unselected.', 'ibid' ); ?></i></p>
                        </div>
                    </div>
                </div>
                <?php 
            }
        }
        add_action('ibid_before_add_auction_form', 'ibid_charity_select_cause_form_group');
    }
}



/**
*
* Adds the blue attachment field on auction edit view
*
* @since 3.3
*
* @package ibid
*/
if (!function_exists('ibid_product_attachment_form_group')) {
    function ibid_product_attachment_form_group($product_id){
        ?>
        <?php 
            //Attach PDF
            $meta_attach_pdf = get_post_meta( $product_id, 'ibid_pdf_attach', true );
        ?>
        <!-- PDF Attachment link -->
        <h4 class="ibid-relist-auction"><?php esc_html_e( 'PDF Attachment link', 'ibid' ); ?></h4>
        <div class="dokan-product-attach-pdf">
            <label for="post_content" class="form-label">
                <?php esc_html_e( 'Paste a PDF/Doc Link (Google Docs)', 'ibid' ); ?>
                <?php ibid_dokan_wcfm_tooltip(esc_attr__('Host your PDF on Google Docs and copy the link on this box. The document can also be hosted on any other PDF/Document Host.', 'ibid')); ?>
            </label>
            <input type="text" class="form-control wc_input_attach_pdf short wc_attach_pdf" style="" name="ibid_pdf_attach" id="ibid_pdf_attach" value="<?php echo esc_attr($meta_attach_pdf); ?>">
        </div>
        <?php 
    }
}
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
    if (ibid_redux('ibid_auction_attachment_link') == true) {
        add_action('ibid_after_add_auction_form', 'ibid_product_attachment_form_group');
    }
}


/**
*
* Adds the blue auctions box to marketplace plugins such as dokan/wcfm
*
* @since 3.3
*
* @package ibid
*/
if (!function_exists('ibid_custom_auctions_blue_box')) {
    function ibid_custom_auctions_blue_box($product_id){

        $style = 'display: none;';
        if ($product_id) {
            $_product = wc_get_product( $product_id );
            if( $_product->is_type( 'auction' ) ) {
                $style = 'display: block;';
            }
        }

        ?>

        <div class="ibid-auction-settings" style="<?php echo esc_attr($style); ?>">

            <?php do_action('ibid_before_add_auction_form', $product_id); ?>

            <?php
                // Auction Fields
                $meta_auction_item_condition = get_post_meta( $product_id, '_auction_item_condition', true );
                $meta_auction_type = get_post_meta( $product_id, '_auction_type', true );
                $meta_auction_proxy = get_post_meta( $product_id, '_auction_proxy', true );
                $meta_auction_sealed = get_post_meta( $product_id, '_auction_sealed', true );

                // WSA Page Options
                $simple_auctions_proxy_auction_on = get_option('simple_auctions_proxy_auction_on');
                $simple_auctions_sealed_on = get_option('simple_auctions_sealed_on');

                $meta_auction_start_price = get_post_meta( $product_id, '_auction_start_price', true );
                $meta_auction_bid_increment = get_post_meta( $product_id, '_auction_bid_increment', true );
                $meta_auction_reserved_price = get_post_meta( $product_id, '_auction_reserved_price', true );
                $meta_regular_price = get_post_meta( $product_id, '_regular_price', true );

                $meta_auction_dates_from = get_post_meta( $product_id, '_auction_dates_from', true );
                $meta_auction_dates_to = get_post_meta( $product_id, '_auction_dates_to', true );
            ?>
            <!-- Auction Settings -->
            <h3><?php esc_html_e( 'Auction Settings', 'ibid' ); ?></h3>
            <div id="auction_tab" class="panel woocommerce_options_panel" style="display: block;">

                <div class="row">
                    <div class="col-md-4">
                        <p class=" form-field _auction_item_condition_field">
                            <label for="_auction_item_condition"><?php esc_html_e( 'Item condition', 'ibid' ); ?></label>
                            <select style="" id="_auction_item_condition" name="_auction_item_condition" class="form-control select short">
                                <option value="new" <?php if($meta_auction_item_condition == 'new'){echo 'selected';} ?>><?php echo esc_html__('New', 'ibid'); ?></option>
                                <option value="used" <?php if($meta_auction_item_condition == 'used'){echo 'selected';} ?>><?php echo esc_html__('Used', 'ibid'); ?></option>
                            </select>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class=" form-field _auction_type_field">
                            <label for="_auction_type"><?php esc_html_e( 'Auction type', 'ibid' ); ?></label>
                            <select id="_auction_type" name="_auction_type" class="form-control select short">
                                <?php $auction_type_options = ibid_auction_type_options(); ?>
                                <?php if($auction_type_options){ ?>
                                    <?php foreach ($auction_type_options as $key => $auction_type_option) { ?>
                                        <option value="<?php echo esc_attr($key); ?>" <?php if($meta_auction_type == $key){echo 'selected'; } ?>><?php echo esc_attr($auction_type_option); ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </p>
                    </div>
                    <div class="col-md-2">
                        <p class="form-field _auction_proxy_field ">
                            <label for="_auction_proxy"><?php esc_html_e( 'Proxy bidding?', 'ibid' ); ?></label><span class="woocommerce-help-tip"></span>

                            <?php 
                            // default
                            $proxy_status = 'no';
                            // page option
                            if(isset($simple_auctions_proxy_auction_on) && $simple_auctions_proxy_auction_on == 'yes') {
                                $proxy_status = 'yes';
                            } 
                            // custom field option
                            if(isset($meta_auction_proxy) && $meta_auction_proxy == 'yes') {
                                $proxy_status = 'yes';
                            }
                            ?>

                            <input type="checkbox" class="wcfm-checkbox checkbox" style="" name="_auction_proxy" id="_auction_proxy" value="<?php echo esc_attr($proxy_status); ?>" <?php if($proxy_status == 'yes'){echo 'checked';} ?>>
                        </p>
                    </div>
                    <?php if(isset($simple_auctions_sealed_on) && $simple_auctions_sealed_on == 'yes') { ?>
                        <div class="col-md-2">
                            <p class="form-field _auction_sealed_field ">
                                <label for="_auction_sealed"><?php esc_html_e( 'Sealed bidding?', 'ibid' ); ?></label><span class="woocommerce-help-tip"></span>
                                <input type="checkbox" class="wcfm-checkbox checkbox" style="" name="_auction_sealed" id="_auction_sealed" value="<?php if($meta_auction_sealed == 'yes'){echo 'yes';} ?>" <?php if($meta_auction_sealed == 'yes'){echo 'checked';} ?>>
                            </p>
                        </div>
                    <?php } ?>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <p class="form-field _auction_start_price_field ">
                            <label for="_auction_start_price"><?php esc_html_e( 'Start Price', 'ibid' ); ?> <?php echo esc_html( get_woocommerce_currency_symbol() ); ?></label>
                            <input type="text" autocomplete="off" class="form-control wc_input_price short wc_input_price" style="" name="_auction_start_price" id="_auction_start_price" value="<?php echo esc_attr($meta_auction_start_price); ?>" step="any" min="0">
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="form-field _auction_bid_increment_field ">
                            <label for="_auction_bid_increment"><?php esc_html_e( 'Bid increment', 'ibid' ); ?> <?php echo esc_html( get_woocommerce_currency_symbol() ); ?></label>
                            <input type="text" autocomplete="off" class="form-control wc_input_price short wc_input_price" style="" name="_auction_bid_increment" id="_auction_bid_increment" value="<?php echo esc_attr($meta_auction_bid_increment); ?>" step="any" min="0">
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="form-field _auction_reserved_price_field ">
                            <label for="_auction_reserved_price"><?php esc_html_e( 'Reserve price (', 'ibid' ); ?><?php echo esc_html( get_woocommerce_currency_symbol() ); ?><?php esc_html_e( ')', 'ibid' ); ?></label><span class="woocommerce-help-tip"></span>
                            <input type="text" autocomplete="off" class="form-control wc_input_price short wc_input_price" style="" name="_auction_reserved_price" id="_auction_reserved_price" value="<?php echo esc_attr($meta_auction_reserved_price); ?>" step="any" min="0">
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <p class="_regular_price_field ">
                            <label for="_regular_price"><?php esc_html_e( 'Buy it now price (', 'ibid' ); ?><?php echo esc_html( get_woocommerce_currency_symbol() ); ?><?php esc_html_e( ') = Regular Price', 'ibid' ); ?></label><span class="woocommerce-help-tip"></span>
                            <input type="text" autocomplete="off" class="form-control wc_input_price short wc_input_price" style="" name="_regular_price" id="_regular_price" value="<?php echo esc_attr($meta_regular_price); ?>">
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="auction_dates_fields">
                            <label for="_auction_dates_from"><?php esc_html_e( 'Auction Date - Start', 'ibid' ); ?></label>
                            <input type="text" autocomplete="off" class="form-control ibid_datetime_picker" name="_auction_dates_from" id="_auction_dates_from" value="<?php echo esc_attr($meta_auction_dates_from); ?>" autocomplete="off" placeholder="<?php esc_attr_e( 'From… YYYY-MM-DD HH:MM', 'ibid' ); ?>">
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="auction_dates_fields">
                            <label for="_auction_dates_to"><?php esc_html_e( 'Auction Date - End', 'ibid' ); ?></label>
                            <input type="text" autocomplete="off" class="form-control ibid_datetime_picker" name="_auction_dates_to" id="_auction_dates_to" value="<?php echo esc_attr($meta_auction_dates_to); ?>" autocomplete="off" placeholder="<?php esc_attr_e( 'To… YYYY-MM-DD HH:MM', 'ibid' ); ?>">
                        </p>
                    </div>
                </div>
            </div>

            <?php 
                // RELIST OPTIONS
                $meta_auction_automatic_relist = get_post_meta( $product_id, '_auction_automatic_relist', true );
                $meta_auction_relist_fail_time = get_post_meta( $product_id, '_auction_relist_fail_time', true );
                $meta_auction_relist_not_paid_time = get_post_meta( $product_id, '_auction_relist_not_paid_time', true );
                $meta_auction_relist_duration = get_post_meta( $product_id, '_auction_relist_duration', true );
            ?>
            <!-- Automatic relist auction -->
            <h4 class="ibid-relist-auction"><?php esc_html_e( 'Automatic relist auction', 'ibid' ); ?></h4>
            <div class="row">
                <div class="col-md-4">
                    <p class=" form-field field_auction_automatic_relist">
                        <input type="checkbox" class="wcfm-checkbox wcfm_half_ele_checkbox checkbox" style="" name="_auction_automatic_relist" id="_auction_automatic_relist" value="<?php if($meta_auction_automatic_relist == 'yes'){echo 'yes';} ?>" <?php if($meta_auction_automatic_relist == 'yes'){echo 'checked';} ?>><label for="_auction_automatic_relist"><?php esc_html_e( 'Enable relist auction', 'ibid' ); ?></label>
                    </p>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <p class=" form-field _auction_item_condition_field">
                        <label for="_auction_relist_fail_time"><?php esc_html_e( 'Relist if fail after n hours', 'ibid' ); ?></label>
                        <input type="number" class="form-control wc_input_price short" style="" name="_auction_relist_fail_time" id="_auction_relist_fail_time" value="<?php echo esc_attr($meta_auction_relist_fail_time); ?>" step="any" min="0">
                    </p>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <p class=" form-field _auction_item_condition_field">
                        <label for="_auction_relist_not_paid_time"><?php esc_html_e( 'Relist if not paid after n hours', 'ibid' ); ?></label>
                        <input type="number" class="form-control wc_input_price short" style="" name="_auction_relist_not_paid_time" id="_auction_relist_not_paid_time" value="<?php echo esc_attr($meta_auction_relist_not_paid_time); ?>" step="any" min="0">
                    </p>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <p class=" form-field _auction_item_condition_field">
                        <label for="_auction_item_condition"><?php esc_html_e( 'Relist auction duration in h', 'ibid' ); ?></label>
                        <input type="number" class="form-control wc_input_price short" style="" name="_auction_relist_duration" id="_auction_relist_duration" value="<?php echo esc_attr($meta_auction_relist_duration); ?>" step="any" min="0">
                    </p>
                </div>
            </div>

            <?php do_action('ibid_after_add_auction_form', $product_id); ?>

        </div>

        <?php
    }
}
if(class_exists( 'WooCommerce_simple_auction' )){
    add_action('ibid_dokan_edit_product_before_short_description', 'ibid_custom_auctions_blue_box');
    if (class_exists('WCFM') && !class_exists('WCFMu')) {
        add_action('ibid_wcfm_edit_product_before_tabs', 'ibid_custom_auctions_blue_box');
    }
    add_action('ibid_wcmp_auctions_tab_content', 'ibid_custom_auctions_blue_box');
}


/**
*
* Adds the blue auctions box to marketplace plugins such as dokan/wcfm
*
* @since 3.3
*
* @package ibid
*/
if (!function_exists('ibid_uaplugin_custom_auctions_blue_box')) {
    function ibid_uaplugin_custom_auctions_blue_box($product_id){

        $style = 'display: none;';
        if ($product_id) {
            $_product = wc_get_product( $product_id );
            if( $_product->is_type( 'auction' ) ) {
                $style = 'display: block;';
            }
        }

        ?>

        <div class="ibid-auction-settings" style="<?php echo esc_attr($style); ?>">

            <?php do_action('ibid_before_add_auction_form', $product_id); ?>

            <?php
                // Auction Fields
                $meta_auction_item_condition = get_post_meta( $product_id, 'woo_ua_product_condition', true );

                $meta_auction_start_price = get_post_meta( $product_id, 'woo_ua_opening_price', true );
                $meta_auction_bid_increment = get_post_meta( $product_id, 'woo_ua_bid_increment', true );
                $meta_auction_reserved_price = get_post_meta( $product_id, 'woo_ua_lowest_price', true );
                $meta_regular_price = get_post_meta( $product_id, '_regular_price', true );

                $meta_auction_dates_to = get_post_meta( $product_id, 'woo_ua_auction_end_date', true );
            ?>
            <!-- Auction Settings -->
            <h3><?php esc_html_e( 'Auction Settings', 'ibid' ); ?></h3>
            <div id="auction_tab" class="panel woocommerce_options_panel" style="display: block;">

                <div class="row">
                    <div class="col-md-4">
                        <p class=" form-field _auction_item_condition_field">
                            <label for="_auction_item_condition"><?php esc_html_e( 'Item condition', 'ibid' ); ?></label>
                            <select style="" id="_auction_item_condition" name="woo_ua_product_condition" class="form-control select short">
                                <option value="new" <?php if($meta_auction_item_condition == 'new'){echo 'selected';} ?>><?php esc_html_e( 'New', 'ibid' ); ?></option>
                                <option value="used" <?php if($meta_auction_item_condition == 'used'){echo 'selected';} ?>><?php esc_html_e( 'Used', 'ibid' ); ?></option>
                            </select>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <p class="form-field _auction_start_price_field ">
                            <label for="_auction_start_price"><?php esc_html_e( 'Start Price', 'ibid' ); ?> <?php echo esc_html( get_woocommerce_currency_symbol() ); ?></label>
                            <input type="text" autocomplete="off" class="form-control wc_input_price short wc_input_price" style="" name="woo_ua_opening_price" id="_auction_start_price" autocomplete="off" value="<?php echo esc_attr($meta_auction_start_price); ?>" step="any" min="0">
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="form-field _auction_bid_increment_field ">
                            <label for="_auction_bid_increment"><?php esc_html_e( 'Bid increment', 'ibid' ); ?> <?php echo esc_html( get_woocommerce_currency_symbol() ); ?></label>
                            <input type="text" autocomplete="off" class="form-control wc_input_price short wc_input_price" style="" name="woo_ua_bid_increment" id="_auction_bid_increment" autocomplete="off" value="<?php echo esc_attr($meta_auction_bid_increment); ?>" step="any" min="0">
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="form-field _auction_reserved_price_field ">
                            <label for="_auction_reserved_price"><?php esc_html_e( 'Reserve price (', 'ibid' ); ?><?php echo esc_html( get_woocommerce_currency_symbol() ); ?><?php esc_html_e( ')', 'ibid' ); ?></label><span class="woocommerce-help-tip"></span>
                            <input type="text" autocomplete="off" class="form-control wc_input_price short wc_input_price" style="" name="woo_ua_lowest_price" id="_auction_reserved_price" autocomplete="off" value="<?php echo esc_attr($meta_auction_reserved_price); ?>" step="any" min="0">
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <p class="_regular_price_field ">
                            <label for="_regular_price"><?php esc_html_e( 'Buy it now price (', 'ibid' ); ?><?php echo esc_html( get_woocommerce_currency_symbol() ); ?><?php esc_html_e( ') = Regular Price', 'ibid' ); ?></label><span class="woocommerce-help-tip"></span>
                            <input type="text" autocomplete="off" class="form-control wc_input_price short wc_input_price" style="" name="_regular_price" id="_regular_price" value="<?php echo esc_attr($meta_regular_price); ?>">
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="auction_dates_fields">
                            <label for="_auction_dates_to"><?php esc_html_e( 'Auction Date - End', 'ibid' ); ?></label>
                            <input type="text" autocomplete="off" class="form-control ibid_datetime_picker" name="woo_ua_auction_end_date" id="_auction_dates_to" value="<?php echo esc_attr($meta_auction_dates_to); ?>" autocomplete="off" placeholder="<?php esc_attr_e( 'To… YYYY-MM-DD HH:MM', 'ibid' ); ?>">
                        </p>
                    </div>
                </div>
            </div>

            <?php do_action('ibid_after_add_auction_form', $product_id); ?>

        </div>

        <?php
    }
}
if(class_exists('Ultimate_WooCommerce_Auction_Pro')){
    add_action('ibid_dokan_edit_product_before_short_description', 'ibid_uaplugin_custom_auctions_blue_box');
}
if(class_exists('Ultimate_WooCommerce_Auction_Free')){
    add_action('ibid_dokan_edit_product_before_short_description', 'ibid_uaplugin_custom_auctions_blue_box');
    add_action('ibid_wcfm_edit_product_before_tabs', 'ibid_uaplugin_custom_auctions_blue_box');
    add_action('ibid_wcmp_auctions_tab_content', 'ibid_uaplugin_custom_auctions_blue_box');
}





/**
*
* Adds the blue auctions box to marketplace plugins such as dokan/wcfm
*
* @since 3.5
*
* @package ibid
*/
if (!function_exists('ibid_auction_type_options')) {
    function ibid_auction_type_options(){
        $options = array(
            'normal' => __('Normal', 'ibid'),
            'reverse' => __('Reverse', 'ibid'),
        );

        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            if (ibid_redux('ibid_vendor_auction_normal') == false) {
                unset($options['normal']);
            }
            if (ibid_redux('ibid_vendor_auction_reverse') == false) {
                unset($options['reverse']);
            }
        }

        return $options;
    }
}


/**
*
* Adds the blue auctions box to marketplace plugins such as dokan/wcfm
*
* @since 3.5
*
* @package ibid
*/
if (!function_exists('ibid_yith_auctions_pro_custom_auctions_blue_box')) {
    function ibid_yith_auctions_pro_custom_auctions_blue_box($product_id){

        $style = 'display: none;';
        if ($product_id) {
            $_product = wc_get_product( $product_id );
            if( $_product->is_type( 'auction' ) ) {
                $style = 'display: block;';
            }
        }

        ?>

        <div class="ibid-auction-settings yith-auctions-pro-box" style="<?php echo esc_attr($style); ?>">

            <?php do_action('ibid_before_add_auction_form', $product_id); ?>

            <?php
                // Auction Fields
                $meta_auction_item_condition = get_post_meta( $product_id, '_yith_wcact_item_condition', true );
                $meta_auction_type = get_post_meta( $product_id, '_yith_wcact_auction_type', true );
                $meta_auction_sealed = get_post_meta( $product_id, '_yith_wcact_auction_sealed', true );

                $meta_auction_start_price = get_post_meta( $product_id, '_yith_auction_start_price', true );
                $meta_auction_bid_increment = get_post_meta( $product_id, '_yith_auction_minimum_increment_amount', true );
                $meta_auction_reserved_price = get_post_meta( $product_id, '_yith_auction_reserve_price', true );
                $meta_regular_price = get_post_meta( $product_id, '_yith_auction_buy_now', true );

                $meta_auction_dates_from = get_post_meta( $product_id, '_yith_auction_for', true );
                $datetime_from_attr = date("Y-m-d H:i:s", $meta_auction_dates_from);

                $meta_auction_dates_to = get_post_meta( $product_id, '_yith_auction_to', true );
                $datetime_to_attr = date("Y-m-d H:i:s", $meta_auction_dates_to);
            ?>
            <!-- Auction Settings -->
            <h3><?php esc_html_e( 'Auction Settings', 'ibid' ); ?></h3>
            <div id="auction_tab" class="panel woocommerce_options_panel" style="display: block;">

                <div class="row">
                    <div class="col-md-3">
                        <p class=" form-field _auction_item_condition_field">
                            <label for="_yith_wcact_item_condition">
                                <?php esc_html_e( 'Item condition', 'ibid' ); ?> 
                                <?php ibid_dokan_wcfm_tooltip(esc_attr__('E.g: new, used, damaged...', 'ibid')); ?>
                            </label>
                            <input type="text" autocomplete="off" class="form-control" name="_yith_wcact_item_condition" id="_yith_wcact_item_condition" value="<?php echo esc_attr($meta_auction_item_condition); ?>">
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class=" form-field _auction_type_field">
                            <label for="_auction_type">
                                <?php esc_html_e( 'Auction type', 'ibid' ); ?> 
                                <?php ibid_dokan_wcfm_tooltip(esc_attr__('Normal auction, the higher bid wins, in a reverse auction, the lower bid wins.', 'ibid')); ?>
                            </label>
                            <select id="_auction_type" name="_yith_wcact_auction_type" class="form-control select short">
                                <?php $auction_type_options = ibid_auction_type_options(); ?>
                                <?php if($auction_type_options){ ?>
                                    <?php foreach ($auction_type_options as $key => $auction_type_option) { ?>
                                        <option value="<?php echo esc_attr($key); ?>" <?php if($meta_auction_type == $key){echo 'selected'; } ?>><?php echo esc_attr($auction_type_option); ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="form-field _auction_sealed_field ">
                            <label><?php esc_html_e( 'Make sealed?', 'ibid' ); ?></label>
                            <div class="clearfix"></div>
                            <input type="checkbox" class="wcfm-checkbox checkbox" name="_yith_wcact_auction_sealed" id="_yith_wcact_auction_sealed" value="<?php if($meta_auction_sealed == 'yes'){echo 'yes';} ?>" <?php if($meta_auction_sealed == 'yes'){echo 'checked';} ?> />
                            <label for="_yith_wcact_auction_sealed"><?php esc_html_e( 'Yes', 'ibid' ); ?></label> 
                            <?php ibid_dokan_wcfm_tooltip(esc_attr__('Enable if you want to make this a sealed auction. All bids will be hidden.', 'ibid')); ?>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <p class="form-field _auction_start_price_field ">
                            <label for="_yith_auction_start_price">
                                <?php esc_html_e( 'Start Price*', 'ibid' ); ?> <?php echo esc_html( get_woocommerce_currency_symbol() ); ?> 
                                <?php ibid_dokan_wcfm_tooltip(esc_attr__('Set a starting price for this auction.', 'ibid')); ?>
                            </label>
                            <input type="text" autocomplete="off" class="form-control wc_input_price short wc_input_price" style="" name="_yith_auction_start_price" id="_yith_auction_start_price" value="<?php echo esc_attr($meta_auction_start_price); ?>" step="any" min="1" required>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="form-field _auction_bid_increment_field ">
                            <label for="_yith_auction_minimum_increment_amount">
                                <?php esc_html_e( 'Bid increment', 'ibid' ); ?> <?php echo esc_html( get_woocommerce_currency_symbol() ); ?> 
                                <?php ibid_dokan_wcfm_tooltip(esc_attr__('Set the minimum increment amount for manual bids. Note: If you set automatic bidding, this value will be overridden by the value of "Automatic bid increment".', 'ibid')); ?>
                            </label>
                            <input type="text" autocomplete="off" class="form-control wc_input_price short wc_input_price" style="" name="_yith_auction_minimum_increment_amount" id="_yith_auction_minimum_increment_amount" value="<?php echo esc_attr($meta_auction_bid_increment); ?>" step="any" min="1">
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="form-field _auction_reserved_price_field ">
                            <label for="_yith_auction_reserve_price">
                                <?php esc_html_e( 'Reserve price, in', 'ibid' ); ?> <?php echo esc_html( get_woocommerce_currency_symbol() ); ?>
                                <?php ibid_dokan_wcfm_tooltip(esc_attr__('Set the reserve price for this auction.', 'ibid')); ?>
                            </label>
                            <input type="text" autocomplete="off" class="form-control wc_input_price short wc_input_price" style="" name="_yith_auction_reserve_price" id="_yith_auction_reserve_price" value="<?php echo esc_attr($meta_auction_reserved_price); ?>" step="any" min="1">
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="_regular_price_field ">
                            <label for="_yith_auction_buy_now">
                                <?php esc_html_e( 'Buy now price, in', 'ibid' ); ?> <?php echo esc_html( get_woocommerce_currency_symbol() ); ?>
                                <?php ibid_dokan_wcfm_tooltip(esc_attr__('Set the Buy Now price for this auction.', 'ibid')); ?>
                            </label>
                            <input type="text" autocomplete="off" class="form-control wc_input_price short wc_input_price" style="" name="_yith_auction_buy_now" id="_yith_auction_buy_now" value="<?php echo esc_attr($meta_regular_price); ?>">
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <p class="auction_dates_fields">
                            <label for="_yith_auction_for"><?php esc_html_e( 'Auction Start Date', 'ibid' ); ?></label>
                            <input type="text" autocomplete="off" class="form-control ibid_datetime_picker" name="_yith_auction_for" id="_yith_auction_for" value="<?php echo esc_attr($datetime_from_attr); ?>" autocomplete="off" placeholder="<?php esc_attr_e( 'From… YYYY-MM-DD HH:MM', 'ibid' ); ?>">
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="auction_dates_fields">
                            <label for="_yith_auction_to"><?php esc_html_e( 'Auction  End Date', 'ibid' ); ?></label>
                            <input type="text" autocomplete="off" class="form-control ibid_datetime_picker" name="_yith_auction_to" id="_yith_auction_to" value="<?php echo esc_attr($datetime_to_attr); ?>" autocomplete="off" placeholder="<?php esc_attr_e( 'To… YYYY-MM-DD HH:MM', 'ibid' ); ?>">
                        </p>
                    </div>
                </div>
            </div>

            <?php
                // Advanced options
                // Override bid type options
                $auction_bid_type_onoff = get_post_meta( $product_id, '_yith_auction_bid_type_onoff', true );
                $bid_type_set_radio = get_post_meta( $product_id, '_yith_wcact_bid_type_set_radio', true );
                $bid_type_radio = get_post_meta( $product_id, '_yith_wcact_bid_type_radio', true );
                $ywcact_automatic_product_bid_simple = get_post_meta( $product_id, 'ywcact_automatic_product_bid_simple', true );
                // Override fee options
                $_yith_auction_fee_onoff = get_post_meta( $product_id, '_yith_auction_fee_onoff', true );
                $_yith_auction_fee_ask_onoff = get_post_meta( $product_id, '_yith_auction_fee_ask_onoff', true );
                $_yith_auction_fee_amount = get_post_meta( $product_id, '_yith_auction_fee_amount', true );
                // Override rescheduling options
                $_yith_auction_reschedule_onoff = get_post_meta( $product_id, '_yith_auction_reschedule_onoff', true );
                $_yith_auction_reschedule_closed_without_bids_onoff = get_post_meta( $product_id, '_yith_auction_reschedule_closed_without_bids_onoff', true );
                $_yith_auction_reschedule_reserve_no_reached_onoff = get_post_meta( $product_id, '_yith_auction_reschedule_reserve_no_reached_onoff', true );
                $_yith_wcact_auction_automatic_reschedule = get_post_meta( $product_id, '_yith_wcact_auction_automatic_reschedule', true );
                $_yith_wcact_automatic_reschedule_auction_unit = get_post_meta( $product_id, '_yith_wcact_automatic_reschedule_auction_unit', true );
                // Override overtime options
                $_yith_auction_overtime_onoff = get_post_meta( $product_id, '_yith_auction_overtime_onoff', true );
                $_yith_auction_overtime_set_onoff = get_post_meta( $product_id, '_yith_auction_overtime_set_onoff', true );
                $_yith_check_time_for_overtime_option = get_post_meta( $product_id, '_yith_check_time_for_overtime_option', true );
                $_yith_overtime_option = get_post_meta( $product_id, '_yith_overtime_option', true );
            ?>
            <br />
            <h4><?php esc_html_e( 'Advanced options', 'ibid' ); ?></h4>
            <p><?php esc_html_e( 'In this section you can override the plugin general settings and set specific settings for this auction product.', 'ibid' ); ?></p>
            <div class="row">
                <div class="col-md-12">
                    <!-- Override bid type options -->
                    <div class="ibid-fields-group-bordered ibid-fields-group-yith_auction_bid_type_onoff">
                        <div class="row">
                            <div class="col-md-12 ibid-single-field">
                                <p class="">
                                    <label><?php esc_html_e( 'Override bid type options', 'ibid' ); ?></label>
                                    <div class="clearfix"></div>
                                    <input type="checkbox" class="wcfm-checkbox checkbox" name="_yith_auction_bid_type_onoff" id="_yith_auction_bid_type_onoff" value="<?php if($auction_bid_type_onoff == 'yes'){echo 'yes';} ?>" <?php if($auction_bid_type_onoff == 'yes'){echo 'checked';} ?> />
                                    <label for="_yith_auction_bid_type_onoff"><?php esc_html_e( 'Enable', 'ibid' ); ?></label> 
                                    <?php ibid_dokan_wcfm_tooltip(esc_attr__('Enable to set specific bid type options for this auction', 'ibid')); ?>
                                </p>
                            </div>
                            <div class="col-md-4 ibid-single-field ibid-conditional-bid_type_set_radio ibid-single-field" style="display: none;">
                                <p class=" form-field">
                                    <label for="_yith_wcact_bid_type_set_radio">
                                        <?php esc_html_e( 'Set bid type', 'ibid' ); ?> 
                                        <?php ibid_dokan_wcfm_tooltip(esc_attr__('With the automatic bidding the user enters the maximum he is willing to pay for the item. The system will automatically bid for the user with the smallest amount possible every time, once his maximum limit is reached', 'ibid')); ?>
                                    </label>
                                    <select id="_yith_wcact_bid_type_set_radio" name="_yith_wcact_bid_type_set_radio" class="form-control select short">
                                        <option value="manual" <?php if($bid_type_set_radio == 'Manual'){echo 'selected'; } ?>><?php echo esc_html__('Manual', 'ibid'); ?></option>
                                        <option value="automatic" <?php if($bid_type_set_radio == 'automatic'){echo 'selected'; } ?>><?php echo esc_html__('Automatic', 'ibid'); ?></option>
                                    </select>
                                </p>
                            </div>
                            <div class="col-md-4 ibid-single-field ibid-conditional-bid_type_radio" style="display: none;">
                                <p class=" form-field">
                                    <label for="_yith_wcact_bid_type_radio">
                                        <?php esc_html_e( 'Auction bid type', 'ibid' ); ?> 
                                        <?php ibid_dokan_wcfm_tooltip(esc_attr__('With the simple type you can set only one bid increment amount, independently from the current bid value. With the advanced type you can set different auctomatic bid increments based on the current bid value.', 'ibid')); ?>
                                    </label>
                                    <select id="_yith_wcact_bid_type_radio" name="_yith_wcact_bid_type_radio" class="form-control select short">
                                        <option value="simple" <?php if($bid_type_set_radio == 'simple'){echo 'selected'; } ?>><?php echo esc_html__('Simple', 'ibid'); ?></option>
                                        <option disabled value="advanced" <?php if($bid_type_set_radio == 'Advanced'){echo 'selected'; } ?>><?php echo esc_html__('Advanced', 'ibid'); ?></option>
                                    </select>
                                </p>
                            </div>
                            <div class="col-md-12 ibid-single-field ibid-conditional-ywcact_automatic_product_bid_simple ibid-single-field" style="display: none;">
                                <p class="">
                                    <label for="ywcact_automatic_product_bid_simple">
                                        <?php esc_html_e( 'Automatic bid increment in', 'ibid' ); ?> <?php echo get_woocommerce_currency_symbol(); ?>
                                        <?php ibid_dokan_wcfm_tooltip(esc_attr__('Set the bidding increment for automatic bidding. You can create more rules to set different bid increments based on the auctions current bid and then set a last rule to cover all the offers made after the last current bid step', 'ibid')); ?>
                                    </label>
                                    <div class="">
                                        <span><?php esc_html_e( 'Set an automatic bid increment of', 'ibid' ); ?> <?php echo get_woocommerce_currency_symbol(); ?></span>
                                        <input type="number" autocomplete="off" class="form-control" style="" name="ywcact_automatic_product_bid_simple" id="ywcact_automatic_product_bid_simple" value="<?php echo esc_attr($ywcact_automatic_product_bid_simple); ?>">
                                    </div>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- Override fee options -->
                    <div class="ibid-fields-group-bordered ibid-fields-group_yith_auction_fee_onoff">
                        <div class="row">
                            <div class="col-md-4 ibid-single-field">
                                <p class="">
                                    <label><?php esc_html_e( 'Override fee options', 'ibid' ); ?></label>
                                    <div class="clearfix"></div>
                                    <input type="checkbox" class="wcfm-checkbox checkbox" name="_yith_auction_fee_onoff" id="yith_auction_fee_onoff" value="<?php if($_yith_auction_fee_onoff == 'yes'){echo 'yes';} ?>" <?php if($_yith_auction_fee_onoff == 'yes'){echo 'checked';} ?> />
                                    <label for="yith_auction_fee_onoff"><?php esc_html_e( 'Yes', 'ibid' ); ?></label> 
                                    <?php ibid_dokan_wcfm_tooltip(esc_attr__('Enable to set specific fee options for this auction', 'ibid')); ?>
                                </p>
                            </div>
                            <div class="col-md-4 ibid-single-field ibid-conditional-fee_ask_onoff" style="display: none;">
                                <p class="">
                                    <label><?php esc_html_e( 'Ask fee payment before bidding', 'ibid' ); ?></label>
                                    <div class="clearfix"></div>
                                    <input type="checkbox" class="wcfm-checkbox checkbox" name="_yith_auction_fee_ask_onoff" id="yith_auction_fee_ask_onoff" value="<?php if($_yith_auction_fee_ask_onoff == 'yes'){echo 'yes';} ?>" <?php if($_yith_auction_fee_ask_onoff == 'yes'){echo 'checked';} ?> />
                                    <label for="yith_auction_fee_ask_onoff"><?php esc_html_e( 'Yes', 'ibid' ); ?></label> 
                                    <?php ibid_dokan_wcfm_tooltip(esc_attr__('Enable to ask users to pay a fee before placing a bid.', 'ibid')); ?>
                                </p>
                            </div>
                            <div class="col-md-3 ibid-single-field ibid-conditional-fee_amount" style="display: none;">
                                <p class="">
                                    <label for="_yith_auction_fee_amount">
                                        <?php esc_html_e( 'Fee amount in', 'ibid' ); ?> <?php echo get_woocommerce_currency_symbol(); ?>
                                        <?php ibid_dokan_wcfm_tooltip(esc_attr__('Set the fee for this auction, a user needs to pay, before being able to place a bid', 'ibid')); ?>
                                    </label>
                                    <input type="number" autocomplete="off" class="form-control wc_input_price short wc_input_price" style="" name="_yith_auction_fee_amount" id="_yith_auction_fee_amount" value="<?php echo esc_attr($_yith_auction_fee_amount); ?>">
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- Override rescheduling options -->
                    <div class="ibid-fields-group-bordered ibid-fields-group_yith_auction_reschedule_onoff">
                        <div class="row">
                            <div class="col-md-6 ibid-single-field ">
                                <p class="">
                                    <label><?php esc_html_e( 'Override rescheduling options', 'ibid' ); ?></label>
                                    <div class="clearfix"></div>
                                    <input type="checkbox" class="wcfm-checkbox checkbox" name="_yith_auction_reschedule_onoff" id="_yith_auction_reschedule_onoff" value="<?php if($_yith_auction_reschedule_onoff == 'yes'){echo 'yes';} ?>" <?php if($_yith_auction_reschedule_onoff == 'yes'){echo 'checked';} ?> />
                                    <label for="_yith_auction_reschedule_onoff"><?php esc_html_e( 'Yes', 'ibid' ); ?></label> 
                                    <?php ibid_dokan_wcfm_tooltip(esc_attr__('Enable to set specific rescheduling options for this auction and override the general rescheduling options.', 'ibid')); ?>
                                </p>
                            </div>
                            <div class="col-md-6 ibid-single-field ibid-conditional-yith-reschedule_closed_without_bids_onoff" style="display: none;">
                                <p class="">
                                    <label><?php esc_html_e( 'Reschedule ended auctions without bids', 'ibid' ); ?></label>
                                    <div class="clearfix"></div>
                                    <input type="checkbox" class="wcfm-checkbox checkbox" name="_yith_auction_reschedule_closed_without_bids_onoff" id="_yith_auction_reschedule_closed_without_bids_onoff" value="<?php if($_yith_auction_reschedule_closed_without_bids_onoff == 'yes'){echo 'yes';} ?>" <?php if($_yith_auction_reschedule_closed_without_bids_onoff == 'yes'){echo 'checked';} ?> />
                                    <label for="_yith_auction_reschedule_closed_without_bids_onoff"><?php esc_html_e( 'Yes', 'ibid' ); ?></label> 
                                    <?php ibid_dokan_wcfm_tooltip(esc_attr__('Enable to automatically reschedule ended auctions without bid.', 'ibid')); ?>
                                </p>
                            </div>
                            <div class="col-md-6 ibid-single-field ibid-conditional-reschedule_reserve_no_reached_onoff" style="display: none;">
                                <p class="">
                                    <label><?php esc_html_e( 'Reschedule ended auctions with the reserve price not reached', 'ibid' ); ?></label>
                                    <div class="clearfix"></div>
                                    <input type="checkbox" class="wcfm-checkbox checkbox" name="_yith_auction_reschedule_reserve_no_reached_onoff" id="_yith_auction_reschedule_reserve_no_reached_onoff" value="<?php if($_yith_auction_reschedule_reserve_no_reached_onoff == 'yes'){echo 'yes';} ?>" <?php if($_yith_auction_reschedule_reserve_no_reached_onoff == 'yes'){echo 'checked';} ?> />
                                    <label for="_yith_auction_reschedule_reserve_no_reached_onoff"><?php esc_html_e( 'Yes', 'ibid' ); ?></label> 
                                    <?php ibid_dokan_wcfm_tooltip(esc_attr__('Enable to automatically reschedule ended auctions if the reserve price was not reached by any submitted bids.', 'ibid')); ?>
                                </p>
                            </div>
                            <div class="col-md-6 ibid-single-field ibid-conditional-yith-reschedule-timer" style="display: none;">
                                <p class="">
                                    <label for="_yith_wcact_auction_automatic_reschedule">
                                        <?php esc_html_e( 'Auctions will be rescheduled for another', 'ibid' ); ?> 
                                        <?php ibid_dokan_wcfm_tooltip(esc_attr__('Set the length of time for which the auction will run again. The auction will reset itself to the original auction product settings and all previous bids will be removed.', 'ibid')); ?>
                                    </label>
                                    <input type="number" class="form-control" name="_yith_wcact_auction_automatic_reschedule" id="_yith_wcact_auction_automatic_reschedule" value="<?php echo esc_attr($_yith_wcact_auction_automatic_reschedule); ?>" />
                                    <select name="_yith_wcact_automatic_reschedule_auction_unit" class="form-control">
                                        <option value="days" <?php if($_yith_wcact_automatic_reschedule_auction_unit == 'days'){echo 'selected'; } ?>><?php echo esc_html__('days', 'ibid'); ?></option>
                                        <option value="hours" <?php if($_yith_wcact_automatic_reschedule_auction_unit == 'hours'){echo 'selected'; } ?>><?php echo esc_html__('hours', 'ibid'); ?></option>
                                        <option value="minutes" <?php if($_yith_wcact_automatic_reschedule_auction_unit == 'minutes'){echo 'selected'; } ?>><?php echo esc_html__('minutes', 'ibid'); ?></option>
                                    </select>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Override overtime options -->
                    <div class="ibid-fields-group-bordered ibid-fields-group_yith_auction_reschedule_onoff">
                        <div class="row">
                            <div class="col-md-4 ibid-single-field ">
                                <p class="">
                                    <label><?php esc_html_e( 'Override overtime options', 'ibid' ); ?></label>
                                    <div class="clearfix"></div>
                                    <input type="checkbox" class="wcfm-checkbox checkbox" name="_yith_auction_overtime_onoff" id="_yith_auction_overtime_onoff" value="<?php if($_yith_auction_overtime_onoff == 'yes'){echo 'yes';} ?>" <?php if($_yith_auction_overtime_onoff == 'yes'){echo 'checked';} ?> />
                                    <label for="_yith_auction_overtime_onoff"><?php esc_html_e( 'Yes', 'ibid' ); ?></label> 
                                    <?php ibid_dokan_wcfm_tooltip(esc_attr__('Enable to set specific overtime options for this auction and override the general overtime options.', 'ibid')); ?>
                                </p>
                            </div>
                            <div class="col-md-4 ibid-single-field ibid-conditional-set-overtime" style="display: none;">
                                <p class="">
                                    <label><?php esc_html_e( 'Set overtime', 'ibid' ); ?></label>
                                    <div class="clearfix"></div>
                                    <input type="checkbox" class="wcfm-checkbox checkbox" name="_yith_auction_overtime_set_onoff" id="_yith_auction_overtime_set_onoff" value="<?php if($_yith_auction_overtime_set_onoff == 'yes'){echo 'yes';} ?>" <?php if($_yith_auction_overtime_set_onoff == 'yes'){echo 'checked';} ?> />
                                    <label for="_yith_auction_overtime_set_onoff"><?php esc_html_e( 'Yes', 'ibid' ); ?></label> 
                                    <?php ibid_dokan_wcfm_tooltip(esc_attr__('Enable to extend the auction duration if someone puts a bid when the auction is about to end.', 'ibid')); ?>
                                </p>
                            </div>
                            <div class="col-md-12 ibid-single-field ibid-conditional-override-settings" style="display: none;">
                                <p class="">
                                    <label><?php esc_html_e( 'Override settings', 'ibid' ); ?> 
                                        <?php ibid_dokan_wcfm_tooltip(esc_attr__('Set the overtime rule when the auction is about to end.', 'ibid')); ?>
                                    </label>
                                    
                                    <div class="clearfix"></div>
                                    
                                    <div class="">
                                        <span for="ywcact_general_overtime_before" class=""><?php esc_html_e( 'If someone adds a bid', 'ibid' ); ?></span>
                                        <input type="number" autocomplete="off" class="form-control" min="0" id="_yith_check_time_for_overtime_option" name="_yith_check_time_for_overtime_option" value="<?php echo esc_attr($_yith_check_time_for_overtime_option); ?>">
                                        <span for="ywcact_general_overtime" class=""><?php esc_html_e( 'minutes before the auction ends, extend the auction for another', 'ibid' ); ?></span>
                                        <input type="number" autocomplete="off" class="form-control" min="0" id="_yith_overtime_option" name="_yith_overtime_option" value="<?php echo esc_attr($_yith_overtime_option); ?>">
                                        <span class=""><?php esc_html_e( 'minutes', 'ibid' ); ?></span>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php do_action('ibid_after_add_auction_form', $product_id); ?>

        </div>

        <?php
    }
}
if (function_exists('YITH_Auctions') ) {
    // dokan
    add_action('ibid_dokan_edit_product_before_short_description', 'ibid_yith_auctions_pro_custom_auctions_blue_box');
    // wcfm
    if (!class_exists('WCFMu')) {
        add_action('ibid_wcfm_edit_product_before_tabs', 'ibid_yith_auctions_pro_custom_auctions_blue_box');
    }
    // wcmp
    add_action('ibid_wcmp_auctions_tab_content', 'ibid_yith_auctions_pro_custom_auctions_blue_box');
}


if (!function_exists('ibid_dokan_wcfm_tooltip')) {
    function ibid_dokan_wcfm_tooltip($text = '' ){
        if (class_exists('WCFM') && !class_exists('WCFMu')) {
            echo '<i class="img_tip wcfmfa fa-question" data-tip="'.esc_attr($text).'" data-hasqtip="39" aria-describedby="qtip-39"></i>';
        }else{
            echo '<i class="fa fa-question-circle tips" aria-hidden="true" data-title="'.esc_attr($text).'"></i>';
        }
    }
}