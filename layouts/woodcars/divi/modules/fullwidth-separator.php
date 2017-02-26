<?php
/**
 * Theme Name: WoodyChild
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

class Woody_Woodcars_ET_Builder_Module_Fullwidth_Separator extends ET_Builder_Module {
	function init() {
		$this->name				= esc_html__('Seperator/Title fullwidth', 'woody');
		$this->slug				= 'woody_woodcars_et_pb_fullwidth_separator';
		$this->custom_css_tab   = false;
		$this->fullwidth		= true;

		$this->whitelisted_fields = array(
				'module_title',
				'module_title_style',
				'module_background_color',
				'admin_label',
				'module_class',
		);

		$this->fields_defaults = array(
				'module_title_style' => array('dark'),
		);
	}

	function get_fields() {

		$fields = array(
				// General
				'module_title' => array(
						'label'              	=> esc_html__("Title", 'woody'),
						'type'               	=> 'text',
						'option_category'    	=> 'basic_option',
				),
				'module_title_style' => array(
						'label'					=> esc_html__('Title style', 'woody'),
						'type'					=> 'select',
						'option_category'		=> 'layout',
						'options'         		=> array(
								'dark'  => esc_html__('Dark', 'woody'),
								'light' => esc_html__('Light', 'woody'),
						),
						'default'         		=> 'dark',
				),
				'module_background_color' => array(
						'label'              	=> esc_html__("Background color", 'woody'),
						'type'				 	=> 'color-alpha',
						'option_category' 	 	=> 'layout',
						'description' 		 	=> __("displayed as background of search form (front of background image)", 'woody'),
				),
				'admin_label' => array(
						'label'       			=> esc_html__('Admin Label', 'et_builder'),
						'type'        			=> 'text',
						'description' 			=> esc_html__('This will change the label of the module in the builder for easy identification.', 'et_builder'),
				),
				'module_class' => array(
						'label'           		=> esc_html__( 'CSS Class', 'et_builder' ),
						'type'            		=> 'text',
						'option_category' 		=> 'configuration',
						'tab_slug'        		=> 'custom_css',
						'option_class'    		=> 'et_pb_custom_css_regular',
				),

		);

		return $fields;
	}

	function shortcode_callback($atts, $content = null, $function_name) {

		ob_start();

		/** module-renders can be overrided in child theme */
		include(get_stylesheet_directory().'/layouts/'.WOODCARS_LAYOUT_SLUG.'/divi/modules/fullwidth-separator-render.php');

		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}
new Woody_Woodcars_ET_Builder_Module_Fullwidth_Separator;