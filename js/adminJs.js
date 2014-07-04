/**
 * File Name childTheme.js
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 07.02.14
 **/
jQuery(document).ready(function($) {
	
	if ( jQuery('body').hasClass('post-type-book-club') ) {
		
		// Hide second tab of map metabox
		jQuery('#metabox-tabs').parent().parent().parent().hide();
		
		// Append waring text.
		jQuery('.address .gmw-location-section-description').append('<p style="color:red">Please only add information you are comfortable releasing on the web.</p>');
		
		// hide auto finder
		jQuery('#wppl-meta-box .current-location, #wppl-meta-box .autocomplete').hide();
		
		// remove street and apt/suit
		var locationTable = jQuery('#wppl-meta-box .gmw-location-manually-wrapper .gmw-location-section-inner .address .gmw-admin-location-table tbody');
		jQuery(locationTable.children()[0]).hide();
		jQuery(locationTable.children()[1]).hide();
		
		// pre-populate user email field
		var emailField = jQuery('#acf-field-_book_club__email');
		if ( emailField.val() == '' ) {
			emailField.val(customAdminObj.user_email);
		}
	}
	
});