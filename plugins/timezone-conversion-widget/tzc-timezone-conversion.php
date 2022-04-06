<?php
/**
 * Plugin Name: Timezone Conversion Widget
 * Plugin URI: https://kartechify.com/product/timezone-conversion-widget/
 * Description: A light weight plugin to convert the time as per the timezone specified in from and to timezone field.
 * Version: 1.4
 * Author: Kartik Parmar
 * Author URI: https://www.kartechify.com
 * Requires PHP: 5.6
 * License: GPL2
 *
 * @package TimezoneConversionWidget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'TZC_PLUGIN_FILE' ) ) {
	define( 'TZC_PLUGIN_FILE', __FILE__ );
}

/**
 * Register and load the widget
 *
 * @since 1.0
 * @hook widgets_init
 */
function tzc_load_widget() {
	register_widget( 'tzc_widget' );
}

add_action( 'widgets_init', 'tzc_load_widget' );

/**
 * Load plugin text domain and specify the location of localization po & mo files
 *
 * @since 1.1
 */
function tzc_update_po_file() {
	$domain = 'tzc-widget';
	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

	if ( $loaded = load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '-' . $locale . '.mo' ) ) {
		return $loaded;
	} else {
		load_plugin_textdomain( $domain, false, basename( dirname( __FILE__ ) ) . '/i18n/languages/' );
	}
}
// Language Translation.
add_action( 'init', 'tzc_update_po_file' );

if ( ! class_exists( 'Tzc_widget' ) ) {

	/**
	 * Creating the widget
	 *
	 * @since 1.0
	 */
	class Tzc_widget extends WP_Widget {

		/**
		 * Default Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {

			add_action( 'init', array( $this, 'tzc_include_files' ) );
			add_action( 'init', array( &$this, 'tzc_load_ajax' ) );

			parent::__construct(
				'tzc_timezone_conversion', // Base ID of your widget .
				__( 'Timezone Conversion', 'tzc-widget' ), // Widget name will appear in UI.
				array( 'description' => __( 'Timezone Conversion', 'tzc-widget' ) ) // Widget description.
			);
		}

		/**
		 * This function will include files
		 *
		 * @since 1.0
		 */
		public function tzc_include_files() {
			include_once plugin_dir_path( __FILE__ ) . '/includes/tzc-functions.php';
			include_once plugin_dir_path( __FILE__ ) . '/includes/tzc-timezone-calculator.php';
		}

		/**
		 * This function will load ajax
		 *
		 * @since 1.0
		 */
		public static function tzc_load_ajax() {
			add_action( 'wp_ajax_tzc_calculate_timezone', array( 'Tzc_Timezone_Conversion', 'tzc_calculate_timezone' ) );
			add_action( 'wp_ajax_nopriv_tzc_calculate_timezone', array( 'Tzc_Timezone_Conversion', 'tzc_calculate_timezone' ) );
		}

		/**
		 * Creating widget front-end
		 *
		 * @param array $args
		 * @param array $instance
		 * @since 1.0
		 */
		public function widget( $args, $instance ) {

			$title = apply_filters( 'tzc_widget_title', $instance['title'] );

			// before and after widget arguments are defined by themes.
			echo $args['before_widget'];

			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			if ( isset( $instance['tzc_translate'] ) && 'on' === $instance['tzc_translate'] ) {
				tzc_widget::tzc_field();
			}

			echo $args['after_widget'];
		}

		/**
		 * Widget Backend
		 *
		 * @param array $instance Insance.
		 * @since 1.0
		 */
		public function form( $instance ) {

			if ( isset( $instance['title'] ) ) {
				$title = $instance['title'];
			}
			else {
				$title = __( 'Timezone Conversion', 'tzc-widget' );
			}

			// Widget admin form.
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php __( 'Title:', 'tzc-widget' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'tzc_translate' ); ?>"><?php _e( 'Enable Timezone Conversion:', 'tzc-widget' ); ?></label>
				<?php

				$tzc_translate = '';
				if ( isset( $instance['tzc_translate'] ) && 'on' === $instance['tzc_translate'] ) {
					$tzc_translate = 'checked';
				}
				?>
				<input class="checkbox" type="checkbox" <?php echo $tzc_translate; ?> id="<?php echo esc_attr( $this->get_field_id( 'tzc_translate' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tzc_translate' ) ); ?>" />
			</p>
			<?php
		}

		/**
		 * Updating widget replacing old instances with new
		 *
		 * @param array $new_instance New Instance.
		 * @param array $old_instance Old Instance.
		 * @since 1.0
		 */
		public function update( $new_instance, $old_instance ) {
			$instance                  = array();
			$instance['title']         = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
			$instance['tzc_translate'] = ( ! empty( $new_instance['tzc_translate'] ) ) ? wp_strip_all_tags( $new_instance['tzc_translate'] ) : '';

			return $instance;
		}

		/**
		 * Display language selection dropdown on front end
		 *
		 * @since 1.0
		 */
		public static function tzc_field() {

			$from_time        = __( 'From Timezone:', 'tzc-widget' );
			$choose_date_time = __( 'Choose Date & Time:', 'tzc-widget' );
			$to_time          = __( 'To Timezone:', 'tzc-widget' );
			$converted_time   = __( 'Converted Time:', 'tzc-widget' );
			$submit           = __( 'Submit', 'tzc-widget' );

			$form_label = apply_filters(
				'tzc_form_label',
				array(
					'from_time'        => $from_time,
					'choose_date_time' => $choose_date_time,
					'to_time'          => $to_time,
					'converted_time'   => $converted_time,
					'submit'           => $submit,
				)
			);

			?>
			<div id="timezone_conversion_element"></div>
				<form action="" method="post">
				<dl>
					<dt><?php esc_html_e( $form_label['choose_date_time'] ); ?></dt>
					<dd>
						<select id="tzc_from_month" name="from_month">
							<?php echo tzc_month_select_options(); ?>
						</select>
						<select id="tzc_from_day" name = "from_day">
							<?php echo tzc_day_select_options(); ?>
						</select>
						<select id="tzc_from_year" name = "from_year">
							<?php echo tzc_year_select_options(); ?>
						</select>
						</select>
						-
						<select id="tzc_from_hour" name="from_hour">
							<?php echo tzc_hour_select_options(); ?>
						</select>
						:
						</select>
						<select id="tzc_from_minute" name="from_minute">
							<?php echo tzc_minute_select_options(); ?>
						</select>
					</dd>
				</dl>
				<dl>
					<dt><?php esc_html_e( $form_label['from_time'] ); ?></dt>
					<dd>
						<select id="tzc_from_tz" class="timezone" name="from_tz">
						<?php echo tzc_timezone_select_options(); ?>
						</select>
					</dd>
				</dl>
				<dl>
					<dt><?php esc_html_e( $form_label['to_time'] ); ?></dt>
					<dd>
						<select id="tzc_to_tz" class="timezone" name="to_tz">
						<?php echo tzc_timezone_select_options(); ?>
						</select>
					</dd>
				</dl>

				<dl>
					<dt><?php esc_html_e( $form_label['converted_time'] ); ?></dt>
					<dd class="tzc-show-ouput">
					</dd>
				</dl>
				<br />
				<div class="controls">
					<button type="button" class="tzc-convert-time">
						<?php esc_html_e( $form_label['submit'] ); ?>
					</button>
				</div>
				</form>
			<?php
		}
	}
}