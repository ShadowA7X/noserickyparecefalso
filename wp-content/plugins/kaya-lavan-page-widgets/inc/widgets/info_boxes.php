<?php
// Info Boxes
class Lavan_Info_Boxes extends WP_Widget{
  public function __construct(){
  global $lavan_plugin_name;	
    parent::__construct(
        'info-boxes',
          __('Lavan-Info Boxes (PB)', $lavan_plugin_name), // Name
        array(
            'description' => __('Info boxes',$lavan_plugin_name) , 'class' => 'lavan_class'
          )
      );
} 
public function widget( $args, $instance){
global $lavan_plugin_name;
        $instance= wp_parse_args($instance, array(
              'info_box_type' => __('success', $lavan_plugin_name),
              'info_box_content' => '',
              'animation_names' => '',
          ));
        echo $args['before_widget'];
          echo '<div class="info_box '.$instance['info_box_type'].' wow '.$instance['animation_names'].'">';
              echo $instance['info_box_content'];
              echo '<img src="'.constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'images/'.$instance['info_box_type'].'_btn.png " class="delete">';
          echo '</div>';
        echo $args['after_widget'];

    }
    public function form($instance){
    global $lavan_plugin_name;	
        $instance= wp_parse_args($instance, array(
              'info_box_type' => __('success',$lavan_plugin_name),
              'info_box_content' => '',
              'animation_names' => '',
          ));
      ?>
<div class="input-elements-wrapper">
	<p> <label for="<?php echo $this->get_field_id('info_box_type') ?>"><?php _e('Info Box Type',$lavan_plugin_name) ?>
	</label>
	<select id="<?php echo $this->get_field_id('info_box_type') ?>" name="<?php echo $this->get_field_name('info_box_type') ?>">
		<option value="success" id="<?php echo $this->get_field_id('info_box_type') ?>" <?php selected( 'success',$instance['info_box_type'] ) ?> >
		<?php _e('Success', $lavan_plugin_name)?></option>
		<option value="info" id="<?php echo $this->get_field_id('info_box_type') ?>" <?php selected( 'info',$instance['info_box_type'] ) ?> >
		<?php _e('Info', $lavan_plugin_name) ?></option>
		<option value="warning" id="<?php echo $this->get_field_id('info_box_type') ?>" <?php selected( 'warning',$instance['info_box_type'] ) ?> >
		<?php _e('Warning', $lavan_plugin_name) ?></option>
		<option value="error" id="<?php echo $this->get_field_id('info_box_type') ?>" <?php selected( 'error',$instance['info_box_type'] ) ?> >
		<?php _e('Error', $lavan_plugin_name) ?></option>      
	</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('info_box_content') ?>"><?php _e('Info Box Content',$lavan_plugin_name) ?></lable>
		<textarea type="text" id="<?php echo $this->get_field_id('info_box_content') ?>" class="widefat" name="<?php echo
		$this->get_field_name('info_box_content') ?>" value = "<?php echo $instance['info_box_content'] ?>" > <?php echo
		$instance['info_box_content'] ?></textarea>
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
 lavan_kaya_register_widgets('info-boxes',__FILE__);
?>