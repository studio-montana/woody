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
class Woody_Woodcars_ET_Builder_Module_Text_Image extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__ ( 'Text & Image', 'woody' );
		$this->slug = 'woody_woodcars_et_pb_text_image';
		$this->custom_css_tab = false;
		
		$this->whitelisted_fields = array (
				'module_text',
				'module_image',
				'module_image_position',
				'module_image_alt',
				'module_image_size',
				'module_text_background_color',
				'module_text_style',
				'module_image_size',
				'module_margin_before_after',
				'admin_label',
				'module_class' 
		);
		
		$this->fields_defaults = array (
				'module_image_position' => array (
						'right' 
				),
				'module_image_size' => array (
						'medium' 
				),
				'module_text_style' => array (
						'dark' 
				),
				'module_margin_before_after' => array (
						0 
				) 
		);
	}
	function get_fields() {
		$fields = array (
				// General
				'module_text' => array (
						'label' => esc_html__ ( "Text", 'woody' ),
						'type' => 'tiny_mce',
						'option_category' => 'basic_option' 
				),
				'module_image' => array (
						'label' => esc_html__ ( "Image", 'woody' ),
						'type' => 'upload',
						'option_category' => 'basic_option',
						'upload_button_text' => esc_attr__ ( 'Upload an image', 'et_builder' ),
						'choose_text' => esc_attr__ ( 'Choose an Image', 'et_builder' ),
						'update_text' => esc_attr__ ( 'Set This Image', 'et_builder' ),
						'option_category' => 'configuration',
						'tab_slug' => 'advanced',
						'description' => esc_html__ ( 'Display image on right or on left side.', 'woody' ) 
				),
				'module_image_position' => array (
						'label' => esc_html__ ( 'Image position', 'woody' ),
						'type' => 'select',
						'option_category' => 'layout',
						'options' => array (
								'right' => esc_html__ ( 'Right', 'woody' ),
								'left' => esc_html__ ( 'Left', 'woody' ) 
						),
						'default' => 'right' 
				),
				'module_image_alt' => array (
						'label' => esc_html__ ( 'Alternative text', 'woody' ),
						'type' => 'text',
						'option_category' => 'configuration',
						'tab_slug' => 'advanced' 
				),
				'module_image_size' => array (
						'label' => esc_html__ ( 'Image Size', 'woody' ),
						'type' => 'select',
						'option_category' => 'layout',
						'tab_slug' => 'advanced',
						'options' => array (
								'medium' => esc_html__ ( 'Medium', 'woody' ),
								'small' => esc_html__ ( 'Small', 'woody' ),
								'large' => esc_html__ ( 'Large', 'woody' ) 
						),
						'default' => 'medium' 
				),
				'module_text_background_color' => array (
						'label' => esc_html__ ( "Background color", 'woody' ),
						'type' => 'color-alpha',
						'option_category' => 'layout',
						'tab_slug' => 'advanced',
						'description' => __ ( "displayed as text's background", 'woody' ) 
				),
				'module_text_style' => array (
						'label' => esc_html__ ( 'Text style', 'woody' ),
						'type' => 'select',
						'option_category' => 'layout',
						'tab_slug' => 'advanced',
						'options' => array (
								'dark' => esc_html__ ( 'Dark', 'woody' ),
								'light' => esc_html__ ( 'Light', 'woody' ) 
						),
						'default' => 'dark' 
				),
				'module_margin_before_after' => array (
						'label' => esc_html__ ( 'Margin before & after', 'woody' ),
						'type' => 'range',
						'option_category' => 'layout',
						'tab_slug' => 'advanced',
						'default' => '0',
						'range_settings' => array (
								'min' => '0',
								'max' => '90',
								'step' => '6' 
						) 
				),
				'admin_label' => array (
						'label' => esc_html__ ( 'Admin Label', 'et_builder' ),
						'type' => 'text',
						'description' => esc_html__ ( 'This will change the label of the module in the builder for easy identification.', 'woody' ) 
				),
				'module_class' => array (
						'label' => esc_html__ ( 'CSS Class', 'et_builder' ),
						'type' => 'text',
						'option_category' => 'configuration',
						'tab_slug' => 'custom_css',
						'option_class' => 'et_pb_custom_css_regular' 
				) 
		);
		
		return $fields;
	}
	function shortcode_callback($atts, $content = null, $function_name) {
		ob_start ();
		
		/**
		 * module-renders can be overrided in child theme
		 */
		include (get_stylesheet_directory () . '/layouts/' . WOODCARS_LAYOUT_SLUG . '/divi/modules/text-image-render.php');
		
		$output = ob_get_contents ();
		ob_end_clean ();
		
		return $output;
	}
}
new Woody_Woodcars_ET_Builder_Module_Text_Image ();