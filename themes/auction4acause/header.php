<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
#Redux global variable
global $ibid_redux;
?>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
        <link rel="shortcut icon" href="<?php echo esc_url(ibid_redux('ibid_favicon', 'url')); ?>">
    <?php } ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
    <?php

    /**
    * Since WordPress 5.2
    */
    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    }

    /**
    * Login/Register popup hooked
    */
    do_action('ibid_after_body_open_tag');

    
    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
        if ($ibid_redux['ibid-enable-popup'] == true) {
            echo ibid_popup_modal(); 
        }
    }?>
    <div class="modeltheme-overlay"></div>

    
    <!-- Fixed Search Form -->
    <div class="fixed-search-overlay">
        <!-- Close Sidebar Menu + Close Overlay -->
        <i class="icon-close icons"></i>
        <!-- INSIDE SEARCH OVERLAY -->
        <div class="fixed-search-inside">
            <div class="modeltheme-search">
                <div class="ibid-header-searchform">

                    <h3><?php echo apply_filters('ibid_search_title', esc_html__('Search for Auctions or Products...', 'ibid')); ?></h3>

                    <form name="header-search-form" method="GET" class="woocommerce-product-search menu-search" action="<?php echo esc_url(home_url('/')); ?>">
                        <?php do_action('ibid_products_search_form'); ?>
                        <input type="text" name="s" class="search-field" maxlength="128" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php esc_attr_e('Search...', 'ibid'); ?>">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <input type="hidden" name="post_type" value="product" />
                    </form>
                </div>
            </div>
        </div>
    </div>
        
    <div id="page" class="hfeed site">
    <?php
        if (is_page()) {
            $mt_custom_header_options_status = get_post_meta( get_the_ID(), 'ibid_custom_header_options_status', true );
            $mt_header_custom_variant = get_post_meta( get_the_ID(), 'ibid_header_custom_variant', true );
            if (isset($mt_custom_header_options_status) AND $mt_custom_header_options_status == 'yes') {
                get_template_part( 'templates/header-template'.esc_html($mt_header_custom_variant) );
            }else{
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    // DIFFERENT HEADER LAYOUT TEMPLATES
                    if ($ibid_redux['header_layout'] == 'first_header') {
                        // Header Layout #1
                        get_template_part( 'templates/header-template1' );
                    }elseif ($ibid_redux['header_layout'] == 'second_header') {
                        // Header Layout #2
                        get_template_part( 'templates/header-template2' );
                    }elseif ($ibid_redux['header_layout'] == 'third_header') {
                        // Header Layout #3
                        get_template_part( 'templates/header-template3' );
                    }elseif ($ibid_redux['header_layout'] == 'fourth_header') {
                        // Header Layout #4
                        get_template_part( 'templates/header-template4' );
                    }elseif ($ibid_redux['header_layout'] == 'fifth_header') {
                        // Header Layout #5
                        get_template_part( 'templates/header-template5' );
                    }elseif ($ibid_redux['header_layout'] == 'sixth_header') {
                        // Header Layout #5
                        get_template_part( 'templates/header-template6' );
                    }elseif ($ibid_redux['header_layout'] == 'seventh_header') {
                        // Header Layout #5
                        get_template_part( 'templates/header-template7' );
                    }elseif ($ibid_redux['header_layout'] == 'eighth_header') {
                        // Header Layout #5
                        get_template_part( 'templates/header-template8' );
                    }elseif ($ibid_redux['header_layout'] == 'ninth_header') {
                        // Header Layout #5
                        get_template_part( 'templates/header-template9' );
                    }else{
                        // if no header layout selected show header layout #1
                        get_template_part( 'templates/header-template1' );
                    } 
                }else{
                    // if no header layout selected show header layout #1
                    get_template_part( 'templates/header-template1' );
                }
            }
        }else{
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                // DIFFERENT HEADER LAYOUT TEMPLATES
                if ($ibid_redux['header_layout'] == 'first_header') {
                    // Header Layout #1
                    get_template_part( 'templates/header-template1' );
                }elseif ($ibid_redux['header_layout'] == 'second_header') {
                    // Header Layout #5
                    get_template_part( 'templates/header-template2' );
                }elseif ($ibid_redux['header_layout'] == 'third_header') {
                    // Header Layout #5
                    get_template_part( 'templates/header-template3' );
                }elseif ($ibid_redux['header_layout'] == 'fourth_header') {
                        // Header Layout #4
                        get_template_part( 'templates/header-template4' );
                }elseif ($ibid_redux['header_layout'] == 'fifth_header') {
                    // Header Layout #5
                    get_template_part( 'templates/header-template5' );
                }elseif ($ibid_redux['header_layout'] == 'sixth_header') {
                    // Header Layout #5
                    get_template_part( 'templates/header-template6' );
                }elseif ($ibid_redux['header_layout'] == 'seventh_header') {
                        // Header Layout #5
                        get_template_part( 'templates/header-template7' );
                }elseif ($ibid_redux['header_layout'] == 'eighth_header') {
                        // Header Layout #5
                        get_template_part( 'templates/header-template8' );
                }elseif ($ibid_redux['header_layout'] == 'ninth_header') {
                        // Header Layout #5
                        get_template_part( 'templates/header-template9' );
                }else{
                    // if no header layout selected show header layout #1
                    get_template_part( 'templates/header-template1' );
                }
            }else{
                // if no header layout selected show header layout #1
                get_template_part( 'templates/header-template1' );
            }
        }