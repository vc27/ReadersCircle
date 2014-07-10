/**
 * File Name childTheme.js
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 07.02.14
 **/
jQuery(document).ready(function(e){if(jQuery("body").hasClass("post-type-book-club")){jQuery("#metabox-tabs").parent().parent().parent().hide(),jQuery(".address .gmw-location-section-description").append('<p style="color:red">Please only add information you are comfortable releasing on the web.</p>'),jQuery("#wppl-meta-box .current-location, #wppl-meta-box .autocomplete").hide();var a=jQuery("#wppl-meta-box .gmw-location-manually-wrapper .gmw-location-section-inner .address .gmw-admin-location-table tbody");jQuery(a.children()[0]).hide(),jQuery(a.children()[1]).hide();var o=jQuery("#acf-field-_book_club__email");""==o.val()&&o.val(customAdminObj.user_email);var r=jQuery("#wpseo_meta");jQuery("h3 span",r).html("Book Club SEO"),jQuery("#linkdex, .linkdex").hide()}});