<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wpadmin.ca/donation/
 * @since             1.0.0
 * @package           Wpadmin_Aws_Cdn
 *
 * @wordpress-plugin
 * Plugin Name:       WPAdmin AWS CDN 
 * Plugin URI:        https://wpadmin.ca/
 * Description:       The <strong>new</strong> & <strong>improved</strong> CDN For Amazon Cloudfront Distribution Plugin by WPAdmin. Setup Amazon Cloudfront <acronym title="Content Delivery Network">CDN</acronym> for your website. Now with intuitive layout and more flexibility.
 * Version:           2.0.12
 * Author:            WPAdmin
 * Author URI:        https://wpadmin.ca/donation/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpadmin-aws-cdn
 https://docs.aws.amazon.com/AWSJavaScriptSDK/latest/AWS/CloudFront.html#createDistribution-property
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);	
*/
$autoload = true;


if ( ! defined( 'wpawscdnbasedir' ) ) define( 'wpawscdnbasedir', plugin_dir_path( __FILE__ ) );

require(wpawscdnbasedir . 'class-aws-cdn.php');

