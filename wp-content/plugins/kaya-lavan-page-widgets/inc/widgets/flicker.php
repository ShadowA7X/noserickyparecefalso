<?php
//flicker
class Lavan_Flickr_Widget extends WP_Widget {
  public function __construct() {
  global $lavan_plugin_name;	
    // widget actual processes
    parent::__construct(
      'flickr-widget', // Base ID
      __('Lavan-Flickr (PB)', $lavan_plugin_name), // Name
      array( 'description' => __( 'Displays flickr image', $lavan_plugin_name ), ) // Args
    );
  }

public function widget( $args, $instance ) {
global $lavan_plugin_name;	
    //echo $args['before_widget'];
  $instance = wp_parse_args( $instance, array(
      'title' => __('Flickr Images', $lavan_plugin_name),
      'id' => '',
      'number' => '8',
      'animation_names' =>'',
      ));

// outputs the content of the widget

extract($args); // Make before_widget, etc available.

 $fli_name = empty($instance['title']) ? __('Flickr', $lavan_plugin_name) : apply_filters('widget_title', $instance['title']);

 $fli_id = $instance['id'];

 $fli_number = $instance['number'];

 $unique_id = $args['widget_id'];

 $instance['id'];

echo $before_widget;

echo $before_title . $fli_name . $after_title; ?>
<?php
$flicker_animation=(trim($instance['animation_names'])) ? 'wow '.$instance['animation_names'].' ' : '';
?>
<div class="<?php echo $flicker_animation; ?> flickr-widget">
  <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $fli_number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $fli_id; ?>"></script>
</div>
<?php echo $after_widget; ?>
<?php }

public function form($instance) {
global $lavan_plugin_name;	
// Get the options into variables, escaping html characters on the way
  $instance = wp_parse_args( $instance, array(

      'title' => __('Flickr Images', $lavan_plugin_name),
      'id' => '',
      'number' => '8',
      'animation_names' => '',

      ));

?>
<div class="input-elements-wrapper">
	<p>
	  <label for="<?php echo $this->get_field_id('title'); ?>">
	  <?php  _e('Flickr Name',$lavan_plugin_name); ?>
	  :
	  <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" class="widefat" value="<?php echo $instance['title'] ?>" />
	  </label>
	</p>
	<p>
	  <label for="<?php echo $this->get_field_id('id'); ?>">
	  <?php  _e('Flickr ID - ',$lavan_plugin_name); ?>
	  <a target="_blank" href="http://www.idgettr.com">idGettr</a> ex: 52617155@N08
	  <input id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" class="widefat" value="<?php echo $instance['id'] ?>"  />
	  </label>
	</p>
	<p>
	  <label for="<?php echo $this->get_field_id('number'); ?>">
	  <?php _e('Number of photos:',$lavan_plugin_name); ?>
	  <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" class="widefat" value="<?php echo $instance['number'] ?>"  />
	  </label>
	</p>
</div>
<div class="input-elements-wrapper">
	<p>
	  <label for="<?php echo $this->get_field_id('animation_names') ?>">  <?php _e('Select Animation Effect',
	  $lavan_plugin_name) ?> 
	  </label>
	  <?php animation_effects($this->get_field_name('animation_names'), $instance['animation_names'] ); ?>
	</p> 
</div>
<?php
}
}
lavan_kaya_register_widgets('flickr-widget',__FILE__);
?>