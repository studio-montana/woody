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
$module_image_alt = $this->shortcode_atts['module_image_alt'];
$module_image_size = $this->shortcode_atts['module_image_size'];
$module_text_background_color = $this->shortcode_atts['module_text_background_color'];
$module_text_style = $this->shortcode_atts['module_text_style'];
$module_margin_before_after = $this->shortcode_atts['module_margin_before_after'];
$module_class = $this->shortcode_atts['module_class'];

$class = ET_Builder_Element::get_module_order_class($function_name);

$this->shortcode_content = trim(et_builder_replace_code_content_entities($this->shortcode_content));

$img = "";
$image_id = woodkit_get_image_id_for_url($module_image);
if (empty($image_id)){
	$img = '<img src="'.esc_url($module_image).'" alt="'.esc_attr($module_image_alt).'" />';
}else{
	$img = wp_get_attachment_image($image_id, 'woody-'.$module_image_size, false, array('alt' => esc_attr($module_image_alt)));
}

if (!empty($module_text_background_color)){
	ET_Builder_Element::set_style($function_name, array(
	'selector'    => '%%order_class%% .content',
	'declaration' => sprintf('background-color: %1$s;',$module_text_background_color),
	));
}

if (!empty($module_margin_before_after)){
	ET_Builder_Element::set_style($function_name, array(
			'selector'    => '%%order_class%%',
			'declaration' => sprintf('margin: %1$spx 0;',$module_margin_before_after),
	));
}

?>
<div class="woody_woodcars_et_pb woody_woodcars_et_pb_text_image <?php echo esc_attr($class." ".$module_class); ?> <?php echo $module_image_size; ?> <?php echo $module_text_style; ?> image-<?php echo $module_image_position; ?>">
	<div class="content">
		<?php 
		if (!empty($module_image_position) && $module_image_position == 'left'){
			?>
			<div class="image"><div class="image-content"><?php echo $img; ?></div></div>
			<div class="text"><div class="text-content"><?php echo $this->shortcode_content; ?></div></div>
			<?php
		}else{
			?>
			<div class="text"><div class="text-content"><?php echo $this->shortcode_content; ?></div></div>
			<div class="image"><div class="image-content"><?php echo $img; ?></div></div>
			<?php
		}
		?>
		<div style="clear: both;"></div>
	</div>
</div>
