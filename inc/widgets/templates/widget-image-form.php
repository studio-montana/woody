<table>
	<tr>
		<td><label for="<?php echo $this->get_field_id('img'); ?>"><?php _e('Image', 'woody'); ?> : </label></td>
		<td><input type="text" name="<?php echo $this->get_field_name('img'); ?>" id="<?php echo $this->get_field_id('img'); ?>" value="<?php echo $img; ?>" /></td>
		<td><span class="button" id="<?php echo $this->get_field_id('img'); ?>-media"><?php _e("Media", 'woody'); ?></span></td>
	</tr>
</table>
<script type="text/javascript">
jQuery(document).ready(function($){
	<?php 
	$jsvarsufix = str_replace("-", "", $this->get_field_id('img'));
	?>
	var imagemedia_<?php echo $jsvarsufix; ?> = false;
	var image_orig<?php echo $jsvarsufix; ?> = wp.media.editor.send.attachment;
	$('#<?php echo $this->get_field_id('img'); ?>-media').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		imagemedia_<?php echo $jsvarsufix; ?> = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if (imagemedia_<?php echo $jsvarsufix; ?>) {
				$("#<?php echo $this->get_field_id('img'); ?>").val(attachment.url);
			} else {
				return image_orig<?php echo $jsvarsufix; ?>.apply( this, [props, attachment] );
			};
		}
		wp.media.editor.open(button);
		return false;
	});
	
});
</script>