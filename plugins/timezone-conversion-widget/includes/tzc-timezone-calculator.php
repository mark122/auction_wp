<?php
/**
 * Bookings and Appointment Plugin for WooCommerce
 *
 * Class for handling Bulk Booking Settings
 *
 * @author   Tyche Softwares
 * @package  BKAP/Bulk-Booking-Settings
 * @category Classes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tzc_Timezone_Conversion' ) ) {

	/**
	 * Class Tzc_Timezone_Conversion
	 */
	class Tzc_Timezone_Conversion {

		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {

			$this->define_constants();
			add_action( 'wp_enqueue_scripts', array( $this, 'tzc_front_side_scripts_js' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'tzc_front_side_scripts_css' ) );
		}

		/**
		 * Defining Constants
		 *
		 * @since 1.0
		 */
		public static function define_constants(){
			define( 'TZC_AJAX_URL', admin_url() . 'admin-ajax.php' );
			define( 'TZC_VERSION', '1.3' );
		}

		/**
		 * This function will call common function to includes js files required for frontend.
		 *
		 * @since 1.0
		 */
		public static function tzc_front_side_scripts_js() {

			wp_register_script( 'tzc-timezone-conversion', plugins_url( '/', TZC_PLUGIN_FILE ) . 'assets/js/tzc-timezone-conversion.js', array( 'jquery' ), TZC_VERSION, false );

			wp_localize_script(
				'tzc-timezone-conversion',
				'tzc_timezone_conversion_params',
				array( 'ajax_url' => TZC_AJAX_URL )
			);

			wp_enqueue_script( 'tzc-timezone-conversion' );
			wp_register_script( 'tzc-select2-js', plugins_url( '/', TZC_PLUGIN_FILE ) . 'assets/js/select2.min.js', array( 'jquery' ), TZC_VERSION, false );
			wp_enqueue_script( 'tzc-select2-js' );

		}

		/**
		 * This function will call common function to includes css files required for frontend.
		 *
		 * @since 1.0.0
		 */
		public static function tzc_front_side_scripts_css() {
			wp_enqueue_style( 'tzc-select2-css', plugins_url( '/', TZC_PLUGIN_FILE ) . 'assets/css/select2.min.css', __FILE__, TZC_VERSION );
		}

		/**
		 * This function is respensible for calculating the timezone based on the selected options.
		 *
		 * @since 1.0
		 */
		public static function tzc_calculate_timezone(){

			$from_month  = sanitize_text_field( $_POST['from_month'] );
			$from_day    = sanitize_text_field( $_POST['from_day'] );
			$from_year   = sanitize_text_field( $_POST['from_year'] );
			$from_hour   = sanitize_text_field( $_POST['from_hour'] );
			$from_minute = sanitize_text_field( $_POST['from_minute'] );
			$from_time   = $from_year . '/' . $from_month . '/' . $from_day . ' ';
			$from_time  .= $from_hour . ':' . $from_minute;

			$from_tz = sanitize_text_field( $_POST['from_tz'] );
			$to_tz   = sanitize_text_field( $_POST['to_tz'] );

			$tz_idents = timezone_identifiers_list();
			if ( in_array( $from_tz, $tz_idents ) && in_array( $to_tz, $tz_idents ) ) {
				$from_tz_obj    = new DateTimeZone( $from_tz );
				$to_tz_obj      = new DateTimeZone( $to_tz );
				$converted_time = new DateTime( $from_time, $from_tz_obj );
				$converted_time->setTimezone( $to_tz_obj );
			}

			$output = $converted_time->format( 'F j, Y \a\t g:i a' );
			$output = apply_filters( 'tzc_output_converted_date', $output, $converted_time );

			wp_send_json( $converted_time->format( 'F j, Y \a\t g:i a' ) );
		}

	}
	$tzc_timezone_conversion = new Tzc_Timezone_Conversion();
}
