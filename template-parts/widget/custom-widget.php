<?php
// Register and load the widget
function wpb_load_widget() {
    register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

// Creating the widget
class wpb_widget extends WP_Widget {

function __construct() {
parent::__construct(

// Base ID of your widget
'wpb_widget',

// Widget name will appear in UI
__('Social Widget', 'wpb_widget_domain'),

// Widget description
array( 'description' => __( 'Social Media Widget', 'wpb_widget_domain' ), )
);
}

// Creating widget front-end

public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
$desc = apply_filters( 'widget_desc', $instance['desc'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
/*echo $args['before_title'] . $title . $args['after_title'];*/
echo '<a class="' . $title . '" href="' . $desc . '"><span class="hidden">icon</span></a>';
?>
<?php

// This is where you run the code and display the output
//echo __( 'Hello, World!', 'wpb_widget_domain' );
echo $args['after_widget'];
}

// Widget Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
$desc = $instance[ 'desc' ];
}
else {
$title = __( 'fa fa-facebook', 'wpb_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Icon Class:' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Social Link:' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" type="text" value="<?php echo esc_attr( $desc ); ?>" />
</p>
<?php
}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['desc'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['desc'] ) : '';
return $instance;
}
} // Class wpb_widget ends here