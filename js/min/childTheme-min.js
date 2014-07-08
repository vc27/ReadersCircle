/**
 * File Name childTheme.js
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 2.0
 * @updated 03.14.14
 **/
var childTheme={haveSearched:0,init:function(){this.mbpScaleFix(),childTheme.submitSearch(),childTheme.pmproCheckout()},pmproCheckout:function(){if(jQuery("body").hasClass("pmpro-checkout")){var e=jQuery("#username-wrap"),r=jQuery("#bemail"),u=jQuery("input",e);e.hide(),r.keyup(function(){u.val(r.val())})}},submitSearch:function(){jQuery('.gmw-pt-form input[type="submit"]').click(function(e){if(0==childTheme.haveSearched){var r=jQuery(".gmw-pt-form");e.preventDefault();var u=jQuery("#country",r).find(":selected").val(),a=jQuery("#gmw-address-1",r).val();jQuery("#gmw-address-1",r).val(a+", "+u),childTheme.haveSearched=1}})},searchCountry:function(){var e=jQuery("#country"),r,u;e.change(function(){addressInput=jQuery("#gmw-address-1"),u=addressInput.val(),r=jQuery(this).find(":selected").val(),r&&addressInput.val(u?u+" "+r:r)})},mbpScaleFix:function(){"undefined"!=typeof MBP&&MBP.scaleFix()},setParams:function(){}};jQuery(document).ready(function(){childTheme.init()});