/**
 Layout Name: Woodcars
 Author: Studio Montana (Sebastien Chandonay / Cyril Tissot)
 Author URI: http://www.studio-montana.com
 License: GNU General Public License v2 or later
 License URI: http://www.gnu.org/licenses/gpl-2.0.html

 This theme, like WordPress, is licensed under the GPL.
 Use it to make something cool, have fun, and share what you've learned with others.
 */

(function($) {

	$(document).ready(function() {
		
		/**
		 * header manager
		 */
		if (!$(".entry-content .et_pb_section:first-child div:first-child").hasClass("travelone_et_pb_header")){
			$("body").addClass("no-divi-header");
		}

		/** Responsive header */
		$(".site-navigation").css("display", "inline-block");
		function responsive_header() {
			if (!$("body").hasClass("responsive-header")) {
				if (($("#masthead .site-header-container").width() - $("#masthead .site-header-container .site-branding").outerWidth()) <= $("#masthead .site-header-container .site-navigation").outerWidth()) {
					$("body").addClass("responsive-header");
				} else {
					$("body").removeClass("responsive-header");
				}
			}
		}
		var responsive_header_timer = null;
		$(window).on('resize', function() {
			if (responsive_header_timer != null)
				clearTimeout(responsive_header_timer);
			responsive_header_timer = setTimeout(responsive_header, 500);
		});
		responsive_header();
	});
	
})(jQuery);