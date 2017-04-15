<?php
/**
 * Theme Name: Dimarino
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
 *  Icon Module
 */
class Woody_Woodcars_ET_Builder_Module_Fullwidth_Entry_Item extends ET_Builder_Module {
	function init() {
		$this->name							= esc_html__('Entry item', 'woody');
		$this->slug							= 'woody_woodcars_et_pb_fullwidth_entry_item';
		$this->custom_css_tab   			= false;
		$this->type							= 'child';
		$this->child_title_var				= 'admin_label_child';
		$this->advanced_setting_title_text	= esc_html__('New entry item', 'woody');
		$this->settings_text				= esc_html__('Entry item settings', 'woody');

		$this->whitelisted_fields = array(
				'module_post_type',
				'module_page',
				'module_post',
				'admin_label_child',
				'module_class',
		);

		$this->fields_defaults = array(
				'module_post_type' => array('none'),
				'module_page' => array('none'),
				'module_post' => array('none'),
		);
	}

	function get_fields() {

		$post_types_items = array('none' => esc_html__("Choose type of post", 'woody'), 'page' => esc_html__("page", 'woody'), 'post' => esc_html__("post", 'woody'));
		
		$pages = get_posts(array("post_type" => "page", "numberposts" => -1, "suppress_filters" => false));
		$pages_items = array('none' => esc_html__("Choose page", 'woody'));
		if (!empty($pages)){
			foreach ($pages as $page){
				$pages_items[$page->ID] = esc_html__(get_the_title($page));
			}
		}
		
		$posts = get_posts(array("post_type" => "post", "numberposts" => -1, "suppress_filters" => false));
		$posts_items = array('none' => esc_html__("Choose post", 'woody'));
		if (!empty($posts)){
			foreach ($posts as $post){
				$posts_items[$post->ID] = esc_html__(get_the_title($post));
			}
		}

		$fields = array(
				// General
				'module_post_type' => array(
						'label'					=> esc_html__('Post type', 'woody'),
						'type'					=> 'select',
						'option_category'		=> 'basic_option',
						'options'         		=> $post_types_items,
						'default'         		=> 'none',
						'affects' 				=> array(
								'#et_pb_module_page',
								'#et_pb_module_post',
						),
				),
				'module_page' => array(
						'label'             => esc_html__("Page", 'woody'),
						'type'              => 'select',
						'option_category'   => 'basic_option',
						'options'           => $pages_items,
						'default'         	=> 'none',
						'depends_show_if' 	=> 'page',
				),
				'module_post' => array(
						'label'             => esc_html__("Post", 'woody'),
						'type'              => 'select',
						'option_category'   => 'basic_option',
						'options'           => $posts_items,
						'default'         	=> 'none',
						'depends_show_if' 	=> 'post',
				),
				'admin_label_child' => array(
						'label'       			=> esc_html__('Admin Label', 'et_builder'),
						'type'        			=> 'text',
						'description' 			=> esc_html__('This will change the label of the module in the builder for easy identification.', 'woody'),
				),
				'module_class' => array(
						'label'           => esc_html__( 'CSS Class', 'et_builder' ),
						'type'            => 'text',
						'option_category' => 'configuration',
						'tab_slug'        => 'custom_css',
						'option_class'    => 'et_pb_custom_css_regular',
				),

		);

		return $fields;
	}

	function shortcode_callback($atts, $content = null, $function_name) {

		ob_start();

		/** module-renders can be overrided in child theme */
		include(get_stylesheet_directory().'/layouts/'.WOODCARS_LAYOUT_SLUG.'/divi/modules/fullwidth-entry-item-render.php');

		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}
new Woody_Woodcars_ET_Builder_Module_Fullwidth_Entry_Item;