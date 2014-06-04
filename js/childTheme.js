/**
 * File Name childTheme.js
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 2.0
 * @updated 03.14.14
 **/
// ######################################################################


/**
 * childTheme
 * @version 2.0
 * @updated 03.14.14
 **/
var childTheme = {
	
	
	
	haveSearched : 0
	
	
	
	/**
	 * init
	 * @version 2.0
	 * @updated 03.14.14
	 **/
	,init : function() {
		
		// this.setParams();
		
		this.mbpScaleFix();
		childTheme.submitSearch();
		
	} // end init : function
	
	
	
	/**
	 * submitSearch
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	,submitSearch : function() {
		
		jQuery('.gmw-pt-form input[type="submit"]').click(function(event) {
			
			if ( childTheme.haveSearched == 0 ) {
				var form = jQuery('.gmw-pt-form');
				event.preventDefault();

				var country = jQuery('#country', form).find(":selected").val();
				var address = jQuery('#gmw-address-1', form).val();
				jQuery('#gmw-address-1', form).val(address + ', ' + country);
				childTheme.haveSearched = 1;
				
			}
			
		});
		
	} // end submitSearch : function
	
	
	
	/**
	 * searchCountry
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	,searchCountry : function() {
		
		var countrySelect = jQuery('#country');
		var country;
		var address;
		countrySelect.change(function() {
			addressInput = jQuery('#gmw-address-1');
			address = addressInput.val();
			country = jQuery(this).find(":selected").val();
			if ( country ) {
				if ( !address ) {
					addressInput.val(country);
				} else {
					addressInput.val(address + ' ' + country);
				}
			}
		});
		
	} // end searchCountry : function
	
	
	
	/**
	 * mbpScaleFix
	 * @version 2.0
	 * @updated 03.14.14
	 **/
	,mbpScaleFix : function() {
		
		if ( typeof MBP !== 'undefined' ) {
			MBP.scaleFix();
		}
		
	} // end mbpScaleFix : function
	
	
	
	// ##################################################
	/**
	 * Setters
	 **/
	// ##################################################
	
	
	
	/**
	 * setParams
	 * 
	 * version 1.0
	 * updated 00.00.13
	 **/
	,setParams : function() {
		
		
		
	}  // end setParams : function
	
	
	
}; // end var childTheme






/**
 * jQuery
 **/
jQuery(document).ready(function() {
	
	childTheme.init();
	
});