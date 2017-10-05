<?php
// Vspace Widget
 class Lavan_Vspace_Widget extends WP_Widget{
   public function __construct(){
   global $lavan_plugin_name; 
   parent::__construct(  'kaya-vspace',
      __('Lavan-Vertical Space (PB)',$lavan_plugin_name),
      array( 'description' => __('Use this widget to add vertical height in between block rows', $lavan_plugin_name),'class' => 'kaya_title' )
    );
   }

    public function widget( $args , $instance ){
    global $lavan_plugin_name;  
        echo $args['before_widget'];
        $instance = wp_parse_args($instance, array(
            'height' => '20',
         ));
        echo '<div class="vspace" style="margin-bottom: '.$instance['height'].'px;"> </div>';
        echo  $args['after_widget'];
    }
    public function form( $instance ){
    global $lavan_plugin_name;  
        $instance = wp_parse_args( $instance, array(
            'height' => '30',
        ));
        ?>
<div class="input-elements-wrapper">        
  <p>
    <label for="<?php echo $this->get_field_id('height'); ?>">
    <?php _e('Height',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('height') ?>" id="<?php echo $this->get_field_id('height') ?>" class="widefat" value="<?php echo $instance['height'] ?>" />
  </p>
</div>
<?php
  }
 }
 lavan_kaya_register_widgets('vspace-widget',__FILE__);
?>