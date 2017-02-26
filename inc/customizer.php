<?php
/**
 * Theme Name: LeadFormance
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
defined ( 'ABSPATH' ) or die ( "Go Away!" );
function woody_customize_register($wp_customize_manager) {
	
	// get languages
	$langs = array ();
	if (function_exists ( "icl_get_languages" )) {
		$wpml_langs = icl_get_languages ();
		foreach ( $wpml_langs as $code => $al ) {
			$langs [] = strtolower ( $code );
		}
	} else {
		$langs [] = strtolower ( get_current_lang () );
	}
	
	// ------ Theme Layout section
	$wp_customize_manager->add_section ( 'woody_theme_layout_customizer', array (
			'title' => __ ( 'Theme Layout', 'woody' ) 
	) );
	// layout (here user can choose layout for his website)
	$wp_customize_manager->add_setting ( 'woody_layout' );
	$wp_customize_manager->add_control ( 'woody_layout', array (
			'label' => __ ( 'Layout', 'woody' ),
			'section' => 'woody_theme_layout_customizer',
			'settings' => 'woody_layout',
			'type' => 'select',
			'choices' => array (
					"none" => __ ( 'No layout', 'woody' ),
					"woodcars" => __ ( 'Woodcars', 'woody' ) 
			) 
	) );
}
add_action ( 'customize_register', 'woody_customize_register' );