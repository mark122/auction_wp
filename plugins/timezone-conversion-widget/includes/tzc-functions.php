<?php
/**
 * Timezone Conversion Widget
 *
 * Functions for Timezone Conversion Widget.
 *
 * @author   Kartik Parmar
 * @package  TimezoneConversionWidget/Google-Calendar-Sync
 * @category Classes
 * @since 2.6
 */

/**
 * Function to list Timezones in select options
 *
 * @param string $selected_timezone Selected Timezone.
 * @return string
 */
function tzc_timezone_select_options( $selected_timezone = null ) {
	$tz_idents = timezone_identifiers_list();
	$output    = '';
	$dt        = new DateTime( 'now' );

	foreach ( $tz_idents as $zone ) {

		$this_tz = new DateTimeZone( $zone );
		$dt->setTimezone( $this_tz );
		$offset  = $dt->format( 'P' );
		$output .= "<option value=\"{$zone}\"";
		if ( $selected_timezone == $zone ) {
			$output .= ' selected';
		} 
		$output .= '>';
		$output .= $zone . " ( UTC/GMT {$offset} )<br />";
		$output .= '</option>';
	} 
	return $output;
}

/**
 * Common function to return selected value.
 *
 * @param array  $assoc_array Array of all values.
 * @param string $selected_value Selected Value.
 * @return string
 */
function tzc_select_options_for( $assoc_array, $selected_value = null ) {

	$output = '';
	foreach ( $assoc_array as $opt_value => $label ) {
		$output .= "<option value=\"{$opt_value}\"";
		if ( $selected_value == $opt_value ) {
			$output .= ' selected';
		}
		$output .= '>';
		$output .= $label;
		$output .= '</option>';
	}

	return $output;
}

/**
 * Function to show month field along with the selected value.
 *
 * @param string $selected_month Selected month.
 * @return string
 */
function tzc_month_select_options( $selected_month = null ) {
	$months = array(
		1  => 'January',
		2  => 'February',
		3  => 'March',
		4  => 'April',
		5  => 'May',
		6  => 'June',
		7  => 'July',
		8  => 'August',
		9  => 'September',
		10 => 'October',
		11 => 'November',
		12 => 'December',
	);

	if ( is_null( $selected_month ) ) {
		$selected_month = date( 'n' );
	}

	return tzc_select_options_for( $months, $selected_month ); 
}

/**
 * Function to show day field along with the selected value.
 *
 * @param string $selected_day Selected day.
 * @return string
 */
function tzc_day_select_options( $selected_day = null ) {
	$range = range( 1, 31 );
	$days  = array_combine( $range, $range );

	if ( is_null( $selected_day ) ) {
		$selected_day = date( 'd' );
	}

	return tzc_select_options_for( $days, $selected_day );
}

/**
 * Function to show year field along with the selected value.
 *
 * @param string $selected_year Selected year.
 * @return string
 */
function tzc_year_select_options( $selected_year = null ) {
	$start_year = (int) date( 'Y' );
	$end_year   = $start_year + 5;
	$range      = range( $start_year, $end_year );
	$years      = array_combine( $range, $range );

	if ( is_null( $selected_year ) ) {
		$selected_year = date( $start_year );
	}

	return tzc_select_options_for( $years, $selected_year );
}

/**
 * Function to show min format.
 *
 * @param string $minute Minute.
 * @return string
 */
function tzc_minute_option_format( $minute ) {
	return str_pad( $minute, 2, '0', STR_PAD_LEFT );
}

/**
 * Function to show minute field along with the selected value.
 *
 * @param string $selected_minute Selected month.
 * @return string
 */
function tzc_minute_select_options( $selected_minute = null ) {
	$range   = range( 0, 59 );
	$labels  = array_map( 'tzc_minute_option_format', $range );
	$minutes = array_combine( $range, $labels );

	if ( is_null( $selected_minute ) ) {
		$selected_minute = date( 'i' );
	}
	return tzc_select_options_for( $minutes, $selected_minute );
}

/**
 * Function to show hour format
 *
 * @param string $hour Hour.
 * @return string
 */
function tzc_hour_option_format( $hour ) {
	$hour_ampm = $hour < 12 ? $hour : $hour - 12;

	if ( $hour_ampm == 0 ) {
		$hour_ampm = 12;
	}

	$ampm    = $hour < 12 ? 'am' : 'pm';
	$output  = str_pad( $hour, 2, '0', STR_PAD_LEFT );
	$output .= " / {$hour_ampm} {$ampm}";

	return $output;
}

/**
 * Function to show hour field along with the selected value.
 *
 * @param string $selected_hour Selected hour.
 * @return string
 */
function tzc_hour_select_options( $selected_hour = null ) {
	$range  = range( 0, 23 );
	$labels = array_map( 'tzc_hour_option_format', $range );
	$hours  = array_combine( $range, $labels );

	if ( is_null( $selected_hour ) ) {
		$selected_hour = date( 'G' );
	}
	return tzc_select_options_for( $hours, $selected_hour );
}
