<?php
/**
 Layout Name: Woodcars
 Author: Studio Montana (Sebastien Chandonay / Cyril Tissot)
 Author URI: http://www.studio-montana.com
 License: GNU General Public License v2 or later
 License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License, version 2, as
 published by the Free Software Foundation.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.
 
 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

define('WOODCARS_LAYOUT_SLUG', 'woodcars');

if (!class_exists('Woodcars')){ // This theme needs Woodcars
	function woody_woodcars_woody_dependencies(){
		$class = 'notice notice-warning is-dismissible';
		$message = __('Notice : your theme layout needs <strong>Woodcars</strong> plugin.', 'woody');
		$message_2 = __('Please look at Woodcars plugin website.', 'woodcars');
		$message_url = "http://www.seb-c.com/produits/woodcars";
		printf( '<div class="%1$s"><p>%2$s&nbsp;<a href="%3$s" target="_blank">%4$s</a></p></div>', $class, $message, $message_url, $message_2);
	}
	add_action('admin_notices', "woody_woodcars_woody_dependencies");
}

/**
 * Unregister Divi post-types
 */
function woody_woodcars_delete_divi_post_types(){
	unregister_post_type('project');
}
add_action('init','woody_woodcars_delete_divi_post_types');

/**
 * Divi Builder modules
*/
require_once(get_stylesheet_directory().'/layouts/'.WOODCARS_LAYOUT_SLUG.'/divi/divi.php');

/**
 * Woodcars layout setup.
 *
 * @return void
 *
 */
function woody_woodcars_setup() {

	/** Customizer */
	include (get_template_directory () . '/layouts/'.WOODCARS_LAYOUT_SLUG.'/inc/customizer.php');
}
add_action ( 'after_setup_theme', 'woody_woodcars_setup' );

/**
 *  Woodcars default vehicle make color
 */
function woody_woodcars_woodcars_default_make_color($color_hex){
	return "#ffd800";
}
add_filter("woodcars_default_make_color", "woody_woodcars_woodcars_default_make_color");

/**
 * Single vehicle template
 */
function woody_woodcars_woodcars_template_single_vehicle_after(){
	?>
	<div class="contact-buttons">
		<?php 
		$current_lang = strtolower(get_current_lang());
		$phone = get_theme_mod('woody_woodcars_phonenumber_'.$current_lang);
		if (!empty($phone)){
			?>
			<a class="tel" href="tel:<?php echo esc_attr(str_replace(" ", "", $phone)); ?>"><i class="fa fa-phone"></i><span class="text"><?php _e("Call us", 'woody'); ?></span><span class="number"><?php echo $phone; ?></span></a>
			<?php 
		}
		$contact = get_theme_mod('woody_woodcars_contactpage_'.$current_lang);
		if (!empty($contact)){
			?>
			<a class="contact" href="<?php echo get_the_permalink($contact); ?>"><i class="fa fa-envelope"></i><span class="text"><?php _e("Contact us", 'woody'); ?></span></a>
			<?php 
		}
		?>
	</div>
	<?php
}
add_action('woodcars_template_single_vehicle_after', 'woody_woodcars_woodcars_template_single_vehicle_after');