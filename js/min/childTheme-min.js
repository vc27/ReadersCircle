/**
 * File Name childTheme.js
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 2.0
 * @updated 03.14.14
 **/
var childTheme={haveSearched:0,init:function(){this.mbpScaleFix(),childTheme.submitSearch()},submitSearch:function(){jQuery('.gmw-pt-form input[type="submit"]').click(function(e){if(0==childTheme.haveSearched){var a=jQuery(".gmw-pt-form");e.preventDefault();var r=jQuery("#country",a).find(":selected").val(),n=jQuery("#gmw-address-1",a).val();jQuery("#gmw-address-1",a).val(n+", "+r),childTheme.haveSearched=1}})},searchCountry:function(){var e=jQuery("#country"),a,r;e.change(function(){addressInput=jQuery("#gmw-address-1"),r=addressInput.val(),a=jQuery(this).find(":selected").val(),a&&addressInput.val(r?r+" "+a:a)})},mbpScaleFix:function(){"undefined"!=typeof MBP&&MBP.scaleFix()},setParams:function(){}};jQuery(document).ready(function(){childTheme.init()});