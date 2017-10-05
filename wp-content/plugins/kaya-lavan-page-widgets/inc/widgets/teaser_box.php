<?php
/**
 * Teaser Box
 */
 class Lavan_Teaser_Box_Widget extends WP_Widget{
  public function __construct(){
  global $lavan_plugin_name;	
     parent::__construct('kaya-teaser-widget',
        __('Lavan-Teaser Box (PB)',$lavan_plugin_name),
         array('description' => __('Use this widget to add Teaserbox with Description',$lavan_plugin_name)  )
     );
   }
   public function widget($args, $instance){
   global $lavan_plugin_name;	
      $instance = wp_parse_args($instance, array(

          'title' => __('Enter Teaser Box Title',$lavan_plugin_name),
          'title_color' => '#fff',
          'description' => __('enter Teaser description', $lavan_plugin_name ),
          'description_color' => '#a9a9a9',
          'read_more_text' => __('Readmore', $lavan_plugin_name),
          'readmore_button_link' => '#',
          'animation_names'  => '',

        ));

      echo $args['before_widget'];

        echo '<div class="teaser_box_wrapper wow '.$instance['animation_names'].' ">';

          if($instance['title']): echo '<h2 style="color:'.$instance['title_color'].'!important;">'.$instance['title'].'</h2>';  endif;

          if($instance['description']): echo '<p style="color:'.$instance['description_color'].'!important;">'.$instance['description'].'</p>';  endif;

          if($instance['read_more_text']):

            echo '<a href="'.$instance['readmore_button_link'].'" class="readmore">'.$instance['read_more_text'].'</a>';

            endif;

        echo '</div>';

      echo $args['after_widget'];

   }

   public function form( $instance ){
   global $lavan_plugin_name;	
           $instance = wp_parse_args($instance, array(

          'title' => __('Enter Teaser Box Title', $lavan_plugin_name),
          'title_color' => '#fff',
          'description' => __('enter Teaser description', $lavan_plugin_name),
          'description_color' => '#a9a9a9',
          'read_more_text' => __('Readmore', $lavan_plugin_name),
          'readmore_button_link' => '#',
          'animation_names'  => '',

        ));

    ?>
<script type="text/javascript">
(function($){
  "use strict";
 $('.teaser_box_color_picker').each(function(){
 $(this).wpColorPicker(); 
 }); 
})(jQuery);
</script>    
<div class="input-elements-wrapper">    
  <p class="two_third">
    <label for="<?php echo $this->get_field_id('title') ?>">
    <?php _e('Title', $lavan_plugin_name) ?>
    </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo esc_attr($instance['title']) ?>" />
  </p>
  <p class="one_third_last">
    <label for="<?php echo $this->get_field_id('title_color') ?>">
    <?php _e('Title Color', $lavan_plugin_name) ?>
    </label>
    <input type="text"  class="teaser_box_color_picker" id="<?php echo $this->get_field_id('title_color') ?>"  
    name="<?php echo $this->get_field_name('title_color') ?>" value = "<?php echo $instance['title_color'] ?>" />
  </p>
</div>
<div class="input-elements-wrapper">  
  <p class="two_third">
    <label for="<?php echo $this->get_field_id('description') ?>">
    <?php _e('Description', $lavan_plugin_name) ?>
    </label>
    <textarea type="text" id="<?php echo $this->get_field_id('description') ?>" class="widefat" name="<?php echo $this->get_field_name('description') ?>" value = "<?php echo $instance['description'] ?>" > <?php echo $instance['description'] ?></textarea>
  </p>
  <p class="one_third_last">
    <label for="<?php echo $this->get_field_id('description_color') ?>">
    <?php _e('Description Color', $lavan_plugin_name) ?>
    </label>
    <input type="text" id="<?php echo $this->get_field_id('description_color') ?>" class="teaser_box_color_picker" name="<?php echo $this->get_field_name('description_color') ?>" value = "<?php echo $instance['description_color'] ?>" />
  </p>
</div>
<div class="input-elements-wrapper">  
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('read_more_text') ?>">
    <?php _e('Readmore Button Text', $lavan_plugin_name) ?>
    </label>
    <input type="text" id="<?php echo $this->get_field_id('read_more_text') ?>" class="widefat" name="<?php echo $this->get_field_name('read_more_text') ?>" value = "<?php echo $instance['read_more_text'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('readmore_button_link') ?>">
    <?php _e('Readmore Button link', $lavan_plugin_name) ?>
    </label>
    <input type="text" id="<?php echo $this->get_field_id('readmore_button_link') ?>" class="widefat" name="<?php echo $this->get_field_name('readmore_button_link') ?>" value = "<?php echo $instance['readmore_button_link'] ?>" />
    <small><?php _e('Ex : http://www.google.com',$lavan_plugin_name); ?></small>
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
  lavan_kaya_register_widgets('teaser-box-widget',__FILE__);
?>