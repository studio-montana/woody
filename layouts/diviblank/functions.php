<?php
/**
 Layout Name: Diviblank
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

define('DIVIBLANK_LAYOUT_SLUG', 'diviblank');

/**
 * Unregister Divi post-types
 */
function woody_diviblank_delete_divi_post_types(){
	unregister_post_type('project');
}
add_action('init','woody_diviblank_delete_divi_post_types');

/**
 * Diviblank layout setup.
 *
 * @return void
 *
 */
function woody_diviblank_setup() {
	
}
add_action ( 'after_setup_theme', 'woody_diviblank_setup' );