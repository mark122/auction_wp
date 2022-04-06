/*
 File name:          Custom Admin JS
*/
(function ($) {
  'use strict';

	jQuery( document ).ready(function() {

 		var selected =  jQuery("#ibid_custom_header_options_status").val();
    if (selected == 'yes') {
    	jQuery('.cmb_id_ibid_header_custom_variant').show();
    	jQuery('.cmb_id_ibid_metabox_header_logo').show();
    }else{
    	jQuery('.cmb_id_ibid_header_custom_variant').hide();
    	jQuery('.cmb_id_ibid_metabox_header_logo').hide();
    }

    jQuery( "#ibid_custom_header_options_status" ).change(function () {
	 		var selected =  jQuery(this).val();
      if (selected == 'yes') {
      	jQuery('.cmb_id_ibid_header_custom_variant').show();
      	jQuery('.cmb_id_ibid_metabox_header_logo').show();
      }else{
      	jQuery('.cmb_id_ibid_header_custom_variant').hide();
      	jQuery('.cmb_id_ibid_metabox_header_logo').hide();
      }
    });
	});
} (jQuery) )