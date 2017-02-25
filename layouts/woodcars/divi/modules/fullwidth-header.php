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

class Woody_Woodcars_ET_Builder_Module_Fullwidth_Header extends ET_Builder_Module {
	function init() {
		$this->name				= esc_html__('Header fullwidth', 'woody');
		$this->slug				= 'woody_woodcars_et_pb_fullwidth_header';
		$this->custom_css_tab   = false;
		$this->fullwidth		= true;

		$this->whitelisted_fields = array(
				'module_fullscreen',
				'module_parallax',
				'module_use_custom_title',
				'module_custom_title',
				'module_text',
				'module_text_style',
				'module_use_custom_background_image',
				'module_custom_background_image',
				'module_use_background_color',
				'module_background_color',
				'admin_label',
				'module_class',
		);

		$this->fields_defaults = array(
				'module_fullscreen' => array('off'),
				'module_parallax' => array('off'),
				'module_use_custom_title' => array('off'),
				'module_text_style' => array('light'),
				'module_use_custom_background_image' => array('off'),
				'module_use_background_color' => array('off'),
		);
	}

	function get_fields() {

		$fields = array(
				// General
				'module_use_custom_title' => array(
						'label'              	=> esc_html__("Use custom title", 'woody'),
						'type'					=> 'yes_no_button',
						'option_category'		=> 'configuration',
						'options'         		=> array(
								'off' => esc_html__('No', 'woody'),
								'on'  => esc_html__('Yes', 'woody'),
						),
						'default'         		=> 'off',
						'affects' 				=> array(
								'#et_pb_module_custom_title',
						),
						'description' 			=> esc_html__("Use custom title if you don't want to display current page/post title", 'et_builder'),
				),
				'module_custom_title' => array(
						'label'              	=> esc_html__("Custom title", 'woody'),
						'type'					=> 'text',
						'option_category'		=> 'configuration',
				),
				'module_text' => array(
						'label'              	=> esc_html__("Text", 'woody'),
						'type'               	=> 'tiny_mce',
						'option_category'    	=> 'basic_option',
				),
				'module_fullscreen' => array(
						'label'					=> esc_html__('Fullscreen', 'woody'),
						'type'					=> 'yes_no_button',
						'option_category'		=> 'layout',
						'tab_slug' 				=> 'advanced',
						'options'         => array(
								'off' => esc_html__('No', 'woody'),
								'on'  => esc_html__('Yes', 'woody'),
						),
						'default'         		=> 'off',
						'description' 			=> esc_html__("Display header in fullscreen mode", 'et_builder'),
				),
				'module_parallax' => array(
						'label'					=> esc_html__('Use parallax', 'woody'),
						'type'					=> 'yes_no_button',
						'option_category'		=> 'layout',
						'tab_slug' 				=> 'advanced',
						'options'         => array(
								'off' => esc_html__('No', 'woody'),
								'on'  => esc_html__('Yes', 'woody'),
						),
						'default'         		=> 'off',
						'description' 			=> esc_html__("Fixe background image and generate parallax scroll", 'et_builder'),
				),
				'module_text_style' => array(
						'label'					=> esc_html__('Text style', 'woody'),
						'type'					=> 'select',
						'option_category'		=> 'layout',
						'tab_slug' 				=> 'advanced',
						'options'         		=> array(
								'light' => esc_html__('Light', 'woody'),
								'dark'  => esc_html__('Dark', 'woody'),
						),
						'default'         		=> 'light',
				),
				'module_use_custom_background_image' => array(
						'label'					=> esc_html__('Customize background image', 'woody'),
						'type'					=> 'yes_no_button',
						'option_category'		=> 'layout',
						'tab_slug' 				=> 'advanced',
						'options'         		=> array(
								'off' => esc_html__('No', 'woody'),
								'on'  => esc_html__('Yes', 'woody'),
						),
						'default'         		=> 'off',
						'affects' 				=> array(
								'#et_pb_module_custom_background_image',
						),
						'description' 			 => __("otherwise, featured image will be used (if exists)", 'woody'),
				),
				'module_custom_background_image' => array(
						'label'              	=> esc_html__("Background image", 'woody'),
						'type'               	=> 'upload',
						'option_category'    	=> 'layout',
						'tab_slug' 				=> 'advanced',
						'upload_button_text' 	=> esc_attr__('Upload an image', 'et_builder'),
						'choose_text'        	=> esc_attr__('Choose an Image', 'et_builder'),
						'update_text'        	=> esc_attr__('Set This Image', 'et_builder'),
						'description' 		 	=> __("displayed as background of search form", 'woody'),
						'depends_show_if' 		=> 'on',
				),
				'module_use_background_color' => array(
						'label'					=> esc_html__('Use background color', 'woody'),
						'type'					=> 'yes_no_button',
						'option_category'		=> 'layout',
						'tab_slug' 				=> 'advanced',
						'options'         		=> array(
								'off' => esc_html__('No', 'woody'),
								'on'  => esc_html__('Yes', 'woody'),
						),
						'default'         		=> 'off',
						'affects' 				=> array(
								'#et_pb_module_background_color',
						),
				),
				'module_background_color' => array(
						'label'              	=> esc_html__("Background color", 'woody'),
						'type'				 	=> 'color-alpha',
						'option_category' 	 	=> 'layout',
						'tab_slug' 				=> 'advanced',
						'description' 		 	=> __("displayed as background of search form (front of background image)", 'woody'),
						'depends_show_if' 		=> 'on',
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
		include(get_stylesheet_directory().'/layouts/'.WOODCARS_LAYOUT_SLUG.'/divi/modules/fullwidth-header-render.php');

		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}
new Woody_Woodcars_ET_Builder_Module_Fullwidth_Header;