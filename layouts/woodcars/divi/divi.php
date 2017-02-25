<?php
/**
 * Theme Name: LaSiesta
 * Author: Sébastien Chandonay
 * Author URI: http://www.seb-c.com
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Copyright 2016 Sébastien Chandonay (email : please contact from website)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Load Modules
 */
function woody_woodcars_divi_add_module_after() {
	/** modules can be overrided in child theme */
	require_once (get_stylesheet_directory () . '/layouts/'.WOODCARS_LAYOUT_SLUG.'/divi/modules/fullwidth-header.php');
	require_once (get_stylesheet_directory () . '/layouts/'.WOODCARS_LAYOUT_SLUG.'/divi/modules/fullwidth-content.php');
	require_once (get_stylesheet_directory () . '/layouts/'.WOODCARS_LAYOUT_SLUG.'/divi/modules/fullwidth-entry.php');
	require_once (get_stylesheet_directory () . '/layouts/'.WOODCARS_LAYOUT_SLUG.'/divi/modules/fullwidth-entry-item.php');
	require_once (get_stylesheet_directory () . '/layouts/'.WOODCARS_LAYOUT_SLUG.'/divi/modules/text-image.php');
}
add_action ( "woodkit_divi_add_module_after", "woody_woodcars_divi_add_module_after" );

/**
 * Admin scripts
 */
function woody_woodcars_divi_admin_enqueue_scripts_after() {
	
	/** js file can be overrided in child theme */
	wp_enqueue_script ( "leadformance-divi-module-builder-script", get_stylesheet_directory_uri () . "/layouts/".WOODCARS_LAYOUT_SLUG."/divi/js/builder.js", array (
			'jquery' 
	), '1.0' );
	
}
if (class_exists ( 'Woodkit' )) // Woodkit plugin support
	add_action ( 'woodkit_divi_admin_enqueue_scripts_after', 'woody_woodcars_divi_admin_enqueue_scripts_after' );
else
	add_action ( 'admin_enqueue_scripts', 'woody_woodcars_divi_admin_enqueue_scripts_after' );
