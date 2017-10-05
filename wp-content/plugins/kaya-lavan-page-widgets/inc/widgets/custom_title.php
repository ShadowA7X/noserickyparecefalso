<?php
// Title Widget
 class Lavan_Title_Widget extends WP_Widget{
   public function __construct(){
   global $lavan_plugin_name;
   parent::__construct(  'kaya-title',
      __('Lavan-Custom Title (PB)',$lavan_plugin_name),
      array( 'description' => __('Use this widget to add custom title to the blocks',$lavan_plugin_name) ,'class' => 'kaya_title' )
    );
    }
    public function widget( $args , $instance ){
        echo $args['before_widget'];
        global $lavan_plugin_name;
        $instance = wp_parse_args($instance, array(
            'title' => __('Add Custom Title',$lavan_plugin_name),
            'title_font_size' => '',
            'title_font_weight' =>'',
            'title_font_style' =>'',
            'title_hover_color' =>'',
            'description' => '',
            'desc_color' => '#787878',
            'description_font_size' => '',
            'description_font_weight' =>'',
            'description_font_style' =>'',
            'title_color' => '#ffffff',
            'text_align' => __('left', $lavan_plugin_name),
            'animation_names' => '',
         ) );
    if( $instance['title'] ):
    if( $instance['text_align'] =='left'){ $plus_icon = 'right';}elseif( $instance['text_align'] =='right'){ $plus_icon = 'left';}else{ $plus_icon='right'; $plus_icon_left ="left"; }
    echo '<div class="custom_title kaya_title_'.$instance['text_align'].' wow '.$instance['animation_names'].'">';
        echo  '<h3 style="text-align:'.$instance['text_align'].'; color:'.$instance['title_color'].'!important; font-size:'.$instance['title_font_size'].'px; font-weight:'.$instance['title_font_weight'].'; font-style:'.$instance['title_font_style'].'">'.$instance['title'].'</h3>';
          if( $instance['text_align'] =='center'){ 
          echo '<i class="fa fa-plus" style="float: '.$plus_icon_left.'; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i>';
          }
          echo '<i class="fa fa-plus" style="float: '.$plus_icon.'; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i>';
     
    echo '</div>';
    if (trim($instance['description'])){
       echo '<p class="custom_title_des" style="text-align:'.$instance['text_align'].'; color:'.$instance['desc_color'].'!important; font-size:'.$instance['description_font_size'].'px; font-weight:'.$instance['description_font_weight'].'; font-style:'.$instance['description_font_style'].'">'.$instance['description'].'</p>';
     }
   ?>
    <div class="clear"> </div>
    <?php endif;
   
    echo  $args['after_widget'];
    }
    public function form( $instance ){
    global $lavan_plugin_name;  
        $instance = wp_parse_args( $instance, array(
            'title' => __('Custom Title', $lavan_plugin_name),
            'title_font_size' => '',
            'title_font_weight' =>'',
            'title_font_style' =>'',
            'description' => __('Add Custom Title Description', $lavan_plugin_name),
            'description_font_size' => '',
            'description_font_weight' =>'',
            'description_font_style' =>'',
            'desc_color' => '#787878',
            'title_color' => '#ffffff',
            'text_align' => __('left', $lavan_plugin_name),
            'animation_names' => '',
        ) );     
          ?>
<script type="text/javascript">
(function($){
  "use strict";
  $('.title_colr_picker').each(function(){
  $(this).wpColorPicker();
  });
})(jQuery);
</script>          
  <div class="input-elements-wrapper">          
      <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php _e('Title',$lavan_plugin_name) ?>
        </label>
        <input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo $instance['title'] ?>" />
      </p>
      <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('title_color'); ?>">
        <?php _e('Title Color',$lavan_plugin_name) ?>
        </label>
        <input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="title_colr_picker" value="<?php echo $instance['title_color'] ?>" />
      </p>
      <p class="one_fourth">
        <label for="<?php echo $this->get_field_id('text_align') ?>">
        <?php _e('Title Position',$lavan_plugin_name)?>
        </label>
        <select id="<?php echo $this->get_field_id('text_align') ?>" name="<?php echo $this->get_field_name('text_align') ?>">
        <option value="left" <?php selected('left', $instance['text_align']) ?>>
        <?php _e(' Left', $lavan_plugin_name)  ?>
        </option>
        <option value="right" <?php selected('right', $instance['text_align']) ?>>
        <?php _e('Right', $lavan_plugin_name) ?>
        </option>
        <option value="center" <?php selected('center', $instance['text_align']) ?>>
        <?php _e(' Center', $lavan_plugin_name) ?>
        </option>
        </select>
      </p>
      <p class="one_fourth_last">
        <label for="<?php echo $this->get_field_id('title_font_size') ?>">  <?php _e('Title Font Size',$lavan_plugin_name) ?> 
        </label>
        <input type="text" class="small-text" id="<?php echo $this->get_field_id('title_font_size') ?>" name="<?php echo $this->get_field_name('title_font_size') ?>" value="<?php echo esc_attr($instance['title_font_size']) ?>" />
        <small>  <?php _e('px',$lavan_plugin_name) ?>  </small> 
      </p>
  </div>
  <div class="input-elements-wrapper">
    <p class="one_fourth">
      <label for="<?php echo $this->get_field_id('title_font_weight') ?>"> <?php _e('title Font Weight',$lavan_plugin_name) ?></label>
      <select id="<?php echo $this->get_field_id('title_font_weight') ?>" name="<?php echo $this->get_field_name('title_font_weight') ?>">
      <option value="normal" <?php selected('normal', $instance['title_font_weight']) ?>> <?php esc_html_e('Normal', $lavan_plugin_name) ?>   </option>
      <option value="bold" <?php selected('bold', $instance['title_font_weight']) ?>>  <?php esc_html_e('Bold',$lavan_plugin_name) ?></option>
      </select>
    </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('title_font_style') ?>"> <?php _e('Title Font Style',$lavan_plugin_name) ?></label>
    <select id="<?php echo $this->get_field_id('title_font_style') ?>" name="<?php echo $this->get_field_name('title_font_style') ?>">
    <option value="normal" <?php selected('normal', $instance['title_font_style']) ?>> <?php esc_html_e('Normal', $lavan_plugin_name) ?>   </option>
    <option value="italic" <?php selected('italic', $instance['title_font_style']) ?>>  <?php esc_html_e('Italic', $lavan_plugin_name) ?></option>
    </select>
    </p>
  </div>
  <div class="input-elements-wrapper">  
  <p class="three_fourth">
    <label for="<?php echo $this->get_field_id('description'); ?>"> <?php _e('Description',$lavan_plugin_name) ?>  </label>
    <textarea name="<?php echo $this->get_field_name('description') ?>" id="<?php echo $this->get_field_id('description') ?>" class="widefat" value="<?php echo $instance['description'] ?>" > <?php echo esc_attr( $instance['description'] ) ?> </textarea>
  </p>
   <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('description_font_size'); ?>"> <?php _e('Description Font Size',$lavan_plugin_name) ?> </label>
    <input type="text" name="<?php echo $this->get_field_name('description_font_size') ?>" id="<?php echo $this->get_field_id('description_font_size') ?>" class="small-text" value="<?php echo esc_attr( $instance['description_font_size'] ) ?>" />
    <small><?php _e('px',$lavan_plugin_name); ?></small>
  </p>
</div>
<div class="input-elements-wrapper">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('description_font_weight') ?>"> <?php _e('Description Font Weight',$lavan_plugin_name) ?></label>
    <select id="<?php echo $this->get_field_id('description_font_weight') ?>" name="<?php echo $this->get_field_name('description_font_weight') ?>">
      <option value="normal" <?php selected('normal', $instance['description_font_weight']) ?>> <?php esc_html_e('Normal', $lavan_plugin_name) ?>   </option>
      <option value="bold" <?php selected('bold', $instance['description_font_weight']) ?>>  <?php esc_html_e('Bold',$lavan_plugin_name) ?></option>
    </select>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('description_font_style') ?>"> <?php _e('Description Font Style',$lavan_plugin_name) ?></label>
    <select id="<?php echo $this->get_field_id('description_font_style') ?>" name="<?php echo $this->get_field_name('description_font_style') ?>">
      <option value="normal" <?php selected('normal', $instance['description_font_style']) ?>> <?php esc_html_e('Normal', $lavan_plugin_name) ?>   </option>
      <option value="italic" <?php selected('italic', $instance['description_font_style']) ?>>  <?php esc_html_e('Italic', $lavan_plugin_name) ?></option>
    </select>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('desc_color'); ?>"> <?php _e('Description Color',$lavan_plugin_name) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('desc_color') ?>" id="<?php echo $this->get_field_id('desc_color') ?>" class="title_colr_picker" value="<?php echo $instance['desc_color'] ?>" />
  </p> 
  <p class="one_fourth_last">
  <label for="<?php echo $this->get_field_id('animation_names') ?>">  <?php _e('Select Animation Effect',
  $lavan_plugin_name) ?> 
  </label>
  <?php animation_effects($this->get_field_name('animation_names'), $instance['animation_names'] ); ?>
  </p>  
  </div>
<?php 
 }
 }
 lavan_kaya_register_widgets('title-widget',__FILE__);
?>