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
defined('ABSPATH') or die("Go Away!");

function woody_woodcars_customize_register($wp_customize_manager) {
	
	// get languages
	$langs = array();
	if (function_exists("icl_get_languages")){
		$wpml_langs =  icl_get_languages();
		foreach ($wpml_langs as $code => $al) {
			$langs[] = strtolower($code);
		}
	}else{
		$langs[] = strtolower(get_current_lang());
	}
	
	// pages
	$pages = get_posts(array("post_type" => "page", "suppress_filter" => true, "numberposts" => -1));
	$pages_choices = array(0 => __("No selection", 'woody'));
	foreach ($pages as $page){
		$lang = "";
		if (function_exists("icl_get_languages")){
			$lang_info = apply_filters('wpml_post_language_details', NULL, $page->ID) ;
			if (!empty($lang_info['language_code']))
				$lang = " (".$lang_info['language_code'].")";
		}
		$pages_choices[$page->ID] = $page->post_title.$lang;
	}
	
	// ------ Woodcars options section
	$wp_customize_manager->add_section('woody_woodcars_options_customizer', array(
			'title' => __('Woodcars options', 'woody'),
	));
	// phone-number (WPML support)
	if (!empty($langs)){
		foreach ($langs as $lang){
			$wp_customize_manager->add_setting('woody_woodcars_phonenumber_'.$lang);
			$wp_customize_manager->add_control('woody_woodcars_phonenumber_'.$lang, array(
					'label'      => __('Phone number', 'woody' )." (".$lang.")",
					'description'=> __('used on vehicle page', 'woody' ),
					'section'    => 'woody_woodcars_options_customizer',
					'settings'   => 'woody_woodcars_phonenumber_'.$lang,
			));
		}
	}
	// contact page (WPML support)
	if (!empty($langs)){
		foreach ($langs as $lang){
			$wp_customize_manager->add_setting('woody_woodcars_contactpage_'.$lang);
			$wp_customize_manager->add_control('woody_woodcars_contactpage_'.$lang, array(
					'label'      => __('Contact page', 'woody' )." (".$lang.")",
					'description'=> __('used on vehicle page', 'woody' ),
					'section'    => 'woody_woodcars_options_customizer',
					'settings'   => 'woody_woodcars_contactpage_'.$lang,
					'type'    => 'select',
					'choices'    => $pages_choices,
			));
		}
	}
}
add_action('customize_register', 'woody_woodcars_customize_register');