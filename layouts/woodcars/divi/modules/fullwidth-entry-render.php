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

$module_title = $this->shortcode_atts['module_title'];
$module_class = $this->shortcode_atts['module_class'];

$class = ET_Builder_Element::get_module_order_class($function_name);

$this->shortcode_content = trim(et_builder_replace_code_content_entities($this->shortcode_content));

?>
<div class="woody_woodcars_et_pb woody_woodcars_et_pb_fullwidth_entry <?php echo esc_attr($class." ".$module_class); ?>">
	<div class="container">
	
		<?php if (!empty($module_title)){ ?>
		<div class="title">
			<span><?php echo $module_title; ?></span>
			<i class="fa fa-caret-down"></i>
		</div>
		<?php } ?>
		
		<div class="items">
			<?php echo $this->shortcode_content; ?>
		</div>
		
	</div>
	
	<script type="text/javascript">
	(function($) {
		$(document).ready(function() {
			if ($(".<?php echo esc_attr($class); ?>.woody_woodcars_et_pb_fullwidth_entry .items").length > 0){
				$(".<?php echo esc_attr($class); ?>.woody_woodcars_et_pb_fullwidth_entry .items").isotope({
					itemSelector : ".entry-item"
				});
			}
		});
	})(jQuery);
	</script>
	
</div>
