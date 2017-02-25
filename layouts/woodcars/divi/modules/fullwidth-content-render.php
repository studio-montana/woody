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

$module_fullscreen = $this->shortcode_atts['module_fullscreen'];
$module_parallax = $this->shortcode_atts['module_parallax'];
$module_text_style = $this->shortcode_atts['module_text_style'];
$module_background_image = $this->shortcode_atts['module_background_image'];
$module_use_background_color = $this->shortcode_atts['module_use_background_color'];
$module_background_color = $this->shortcode_atts['module_background_color'];
$module_class = $this->shortcode_atts['module_class'];

$class = ET_Builder_Element::get_module_order_class($function_name);

$this->shortcode_content = trim(et_builder_replace_code_content_entities($this->shortcode_content));

if (!empty($module_fullscreen) && $module_fullscreen == "on"){
	$module_class .= ' fullscreen';
}else{
	$module_class .= ' no-fullscreen';
}

if (!empty($module_background_image)){
	ET_Builder_Element::set_style($function_name, array(
	'selector'    => '%%order_class%%',
	'declaration' => sprintf('background:	url(\'%1$s\') no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; -ms-background-size: cover; background-size: cover; overflow: hidden;', $module_background_image),
	));
	if (!empty($module_parallax) && $module_parallax == 'on'){
		ET_Builder_Element::set_style($function_name, array(
		'selector'    => '%%order_class%%',
		'declaration' => 'background-attachment: fixed;',
		));
	}
}

if (!empty($module_use_background_color) && $module_use_background_color == 'on' && !empty($module_background_color)){
	ET_Builder_Element::set_style($function_name, array(
	'selector'    => '%%order_class%% .overlay',
	'declaration' => sprintf('background-color: %1$s;',$module_background_color),
	));
}

?>
<div class="woody_woodcars_et_pb woody_woodcars_et_pb_content woody_woodcars_et_pb_fullwidth_content <?php echo esc_attr($class." ".$module_class." ".$module_text_style); ?>">
	<div class="overlay">
		<div class="content">
			<?php 
			$content_trimed = trim($this->shortcode_content);
			if (!empty($content_trimed)){
				?>
				<div class="text"><?php echo $this->shortcode_content; ?></div>
				<?php 
			}
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
(function($) {
	$(document).ready(function() {
		var <?php echo $class; ?>_module_class = '.<?php echo $class; ?>';
		
		// fullscreen 
		<?php if (!empty($module_fullscreen) && $module_fullscreen == 'on'){ ?>
		function <?php echo $class; ?>_fullscreen(){
			if ($(<?php echo $class; ?>_module_class).length > 0){
				$(<?php echo $class; ?>_module_class).css("min-height", $(window).height()+"px");
			}
		}
		$(window).on('resize', function(){
			<?php echo $class; ?>_fullscreen();
		});
		<?php echo $class; ?>_fullscreen();
		<?php } ?>
		$(<?php echo $class; ?>_module_class).addClass('content-ready');
	});
})(jQuery);
</script>








