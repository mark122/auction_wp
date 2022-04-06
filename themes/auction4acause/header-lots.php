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
                <?php do_action('ibid_products_search_form'); ?>
            </div>
        </div>
    </div>
        
    <div id="page" class="hfeed site">
