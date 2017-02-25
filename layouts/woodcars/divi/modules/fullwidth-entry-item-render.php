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

$module_post_type = $this->shortcode_atts['module_post_type'];
$module_page = $this->shortcode_atts['module_page'];
$module_post = $this->shortcode_atts['module_post'];
$module_class = $this->shortcode_atts['module_class'];

$class = ET_Builder_Element::get_module_order_class($function_name);

$this->shortcode_content = trim(et_builder_replace_code_content_entities($this->shortcode_content));

if (!empty($module_post_type) && $module_post_type != 'none'){ 
	if ($module_post_type == 'page'){
		$post_item = get_post($module_page);
	}else if ($module_post_type == 'post'){
		$post_item = get_post($module_post);
	}
	if ($post_item){
		global $post;
		$post = $post_item;
		setup_postdata($post);
		$style_container = '';
		if (has_post_thumbnail()){
			list($src, $width, $height) = wp_get_attachment_image_src(get_post_thumbnail_id(), 'dimarino-medium');
			$style_container .= "background:	url('$src') no-repeat center center;";
			$style_container .= "-webkit-background-size: cover;";
			$style_container .= "-moz-background-size: cover;";
			$style_container .= "-o-background-size: cover;";
			$style_container .= "-ms-background-size: cover;";
			$style_container .= "background-size: cover;";
			$style_container .= "overflow: hidden;";
		}
		?>
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>" class="woody_woodcars_et_pb woody_woodcars_et_pb_fullwidth_entry_item <?php echo esc_attr($class." ".$module_class); ?> entry-item">
			<div class="container" style="<?php echo $style_container; ?>">
				<div class="text">
					<div class="title"><?php the_title(); ?></div>
					<div class="excerpt"><?php the_excerpt(); ?></div>
				</div>
				<div class="more"><?php _e("read more", 'woody'); ?></div>
			</div>
		</a>
		<?php 
		wp_reset_postdata();
	}
}
?>