/**
 * When Customer click on Submit button this will be called
 * @fires event:click
 * @since 1.0
 */
jQuery( document ).ready(function($) {
	jQuery( '.tzc-convert-time' ).on( 'click', function() {
		jQuery( '.tzc-show-ouput' ).html( '<strong>Calculating...</strong>' );
		var data = {
			from_month: 	jQuery( '#tzc_from_month option:selected' ).val(),
			from_day: 		jQuery( '#tzc_from_day option:selected' ).val(),
			from_year: 		jQuery( '#tzc_from_year option:selected' ).val(), 
			from_hour: 		jQuery( '#tzc_from_hour option:selected' ).val(),
			from_minute: 	jQuery( '#tzc_from_minute option:selected' ).val(),
			from_tz:    	jQuery( '#tzc_from_tz option:selected' ).val(),
			to_tz: 			jQuery( '#tzc_to_tz option:selected' ).val(),
			action: 		'tzc_calculate_timezone'
		};

		jQuery.post( tzc_timezone_conversion_params.ajax_url, data, function( response ) {
			jQuery( '.tzc-show-ouput' ).html( '<h4>' + response + '</h4>' );
		});
	});

	jQuery("#tzc_from_tz").select2();
	jQuery("#tzc_to_tz").select2();
});