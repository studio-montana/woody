<?php 

// Creating the widget
class image_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
				// Base ID of your widget
				'image_widget',

				// Widget name will appear in UI
				__("Image", 'woody'),

				// Widget description
				array('description' => __("Display image", 'woody'),)
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {

		if ( isset( $instance['img'] )){
			$img = $instance['img'];
		}else{
			$img = "";
		}

		echo $args['before_widget'];

		include(locate_template('/inc/widgets/templates/widget-image-output.php'));

		echo $args['after_widget'];
	}

	// Widget Backend
	public function form( $instance ) {

		if ( isset( $instance['img'] )){
			$img = $instance['img'];
		}else{
			$img = "";
		}

		// Widget admin form
		include(locate_template('/inc/widgets/templates/widget-image-form.php'));
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['img'] = ( ! empty( $new_instance['img'] ) ) ? strip_tags( $new_instance['img'] ) : '';
		return $instance;
	}
}

// Register and load the widget
function image_load_widget() {
	register_widget('image_widget');
}

add_action( 'widgets_init', 'image_load_widget');
