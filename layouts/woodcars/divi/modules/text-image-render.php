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

$module_image = $this->shortcode_atts['module_image'];
$module_image_position = $this->shortcode_atts['module_image_position'];
$module_alt = $this->shortcode_atts['module_alt'];
$module_size = $this->shortcode_atts['module_size'];
$module_class = $this->shortcode_atts['module_class'];

$class = ET_Builder_Element::get_module_order_class($function_name);

$this->shortcode_content = trim(et_builder_replace_code_content_entities($this->shortcode_content));

$img = "";
$image_id = woodkit_get_image_id_for_url($module_image);
if (empty($image_id)){
	$img = '<img src="'.esc_url($module_image).'" alt="'.esc_attr($module_alt).'" />';
}else{
	$img = wp_get_attachment_image($image_id, 'woodychild-'.$module_size, false, array('alt' => esc_attr($module_alt)));
}

?>
<div class="woody_woodcars_et_pb woody_woodcars_et_pb_text_image <?php echo esc_attr($class." ".$module_class); ?> <?php echo $module_size; ?> image-<?php echo $module_image_position; ?>">
	<div class="content">
		<?php 
		if (!empty($module_image_position) && $module_image_position == 'left'){
			?>
			<div class="image"><?php echo $img; ?></div>
			<div class="text"><?php echo $this->shortcode_content; ?></div>
			<?php
		}else{
			?>
			<div class="text"><?php echo $this->shortcode_content; ?></div>
			<div class="image"><?php echo $img; ?></div>
			<?php
		}
		?>
		<div style="clear: both;"></div>
	</div>
</div>
