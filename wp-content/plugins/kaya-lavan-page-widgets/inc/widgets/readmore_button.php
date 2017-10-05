<?php
//readmore button 
class Lavan_Readmore_Button_Widget extends WP_Widget {
  public function __construct(){
  global $lavan_plugin_name;	
    parent::__construct(
    'lavan-readmore-button',
    __('Lavan - Button ',$lavan_plugin_name),   
    array( 'description' => __('Displays Readmore Butoom where ever you want', $lavan_plugin_name),'class' => 
    	'kaya_readmore',
      )
    );
}
  public function widget( $args , $instance){
  global $lavan_plugin_name;   
      $instance = wp_parse_args($instance, array(          
          'readmore_button_text' => __('Readmore',$lavan_plugin_name),
          'readmore_button_link' => '#',
          'readmore_button_color' => '#21cdec',
          'readmore_button_text_color' => '#ffffff',
          'readmore_button_hover_color' => '#333333',
          'readmore_button_hover_link_color' => '#ffffff',
          'readmore_button_alignment' => __('left',$lavan_plugin_name),
          'readmore_button_new_window' => '',
          'readmore_button_border_color' => '#333333',
          'readmore_button_border_hover_color' => '#21cdec',
          'readmore_button_border_width' => '2',
          'animation_names' => '',
          'readmore_button_margin_top' => '0',
          'font_icon_name' => '',
          'select_font_icon_type' => '',

      ));
        echo $args['before_widget']; 
          $button_hover =rand(1,100);
        ?>
        <style type="text/css">
        #mid_container_wrapper .widget_lavan-readmore-button .widget_readmore-<?php echo $button_hover; ?>:hover,
        footer .widget_lavan-readmore-button .widget_readmore-<?php echo $button_hover; ?>:hover,
        #sidebar .widget_lavan-readmore-button .widget_readmore-<?php echo $button_hover; ?>:hover {
            background-color: <?php echo $instance['readmore_button_hover_color']; ?>!important;
            color: <?php echo $instance['readmore_button_hover_link_color']; ?>!important;
            border-color:<?php echo $instance['readmore_button_border_hover_color']; ?>!important;
        }
         .widget_readmore-<?php echo $button_hover; ?>.aligncenter{
          display: table!important;
        }
        </style>
        <?php //echo $instance['font_icon_name']; ?>
        <?php $target_window = ( $instance['readmore_button_new_window'] == 'on' ) ? '_blank' : '_self';
             $button_animation =   ( trim( $instance['animation_names'] ) )  ? 'wow '. $instance['animation_names'] : '';
         ?>
        <a class="<?php  echo $button_animation; ?> widget_button widget_readmore-<?php echo $button_hover; ?> align<?php echo $instance['readmore_button_alignment']; ?>" href="<?php echo $instance['readmore_button_link']; ?>" target="<?php echo $target_window; ?>" style="background-color:<?php echo $instance['readmore_button_color']; ?>; color:<?php echo $instance['readmore_button_text_color']; ?>; border:<?php echo $instance['readmore_button_border_width'] ?>px solid <?php echo $instance['readmore_button_border_color']; ?>; margin-top:<?php echo $instance['readmore_button_margin_top'] ?>px;"><?php echo $instance['readmore_button_text']; ?></a>
         <?php   echo '<div class="clear">&nbsp;</div>';
        
        echo $args['after_widget'];

    }
    public function form($instance){
    global $lavan_plugin_name; 
      $instance = wp_parse_args($instance, array(          
          'readmore_button_text' => __('Readmore',$lavan_plugin_name),
          'readmore_button_link' => '#',
          'readmore_button_color' => '#21cdec',
          'readmore_button_text_color' => '#ffffff',
          'readmore_button_hover_color' => '#333333',
          'readmore_button_hover_link_color' => '#ffffff',
          'readmore_button_alignment' => __('left',$lavan_plugin_name),
          'readmore_button_new_window' => '',
          'readmore_button_border_color' => '#333333',
          'readmore_button_border_hover_color' => '#21cdec',
          'readmore_button_border_width' => '2',
          'animation_names' => '',
          'readmore_button_margin_top' => '0',
          'font_icon_name' => '',
          'select_font_icon_type' => '',

      ));?>
  <script type='text/javascript'>
    jQuery(document).ready(function($) {
      jQuery('.button_color_pickr').each(function(){
        jQuery(this).wpColorPicker();
      }); 
    });
  </script> 

<div class="input-elements-wrapper"> 
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('readmore_button_text'); ?>"><?php  _e('Button Text',$lavan_plugin_name); ?>
    </label>
    <input id="<?php echo $this->get_field_id('readmore_button_text'); ?>" name="<?php echo $this->get_field_name
    ('readmore_button_text'); ?>" type="text" class="widefat" value="<?php echo $instance['readmore_button_text'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('readmore_button_color'); ?>"><?php _e('Button BG Color',
    $lavan_plugin_name); ?> </label>
    <input id="<?php echo $this->get_field_id('readmore_button_color'); ?>" name="<?php echo $this->get_field_name('readmore_button_color'); ?>" type="text" class="button_color_pickr" value="<?php echo $instance['readmore_button_color'] ?>"  />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('readmore_button_text_color'); ?>"><?php  _e('Button Text Color',
    $lavan_plugin_name); ?></label>
    <input id="<?php echo $this->get_field_id('readmore_button_text_color'); ?>" name="<?php echo $this->get_field_name
    ('readmore_button_text_color'); ?>" type="text" class="button_color_pickr" value="<?php echo $instance
    ['readmore_button_text_color'] ?>" />
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('readmore_button_border_color'); ?>">  <?php  _e('Button Border Color',
    $lavan_plugin_name); ?></label> 
    <input id="<?php echo $this->get_field_id('readmore_button_border_color'); ?>" name="<?php echo $this->get_field_name
    ('readmore_button_border_color'); ?>" type="text" class="button_color_pickr" value="<?php echo $instance
    ['readmore_button_border_color'] ?>" />
  </p>
</div>
<div class="input-elements-wrapper"> 
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('readmore_button_hover_color'); ?>"><?php  _e('Button Hover BG Color',
    $lavan_plugin_name); ?></label>
    <input id="<?php echo $this->get_field_id('readmore_button_hover_color'); ?>" name="<?php echo $this->get_field_name
    ('readmore_button_hover_color'); ?>" type="text" class="button_color_pickr" value="<?php echo $instance
    ['readmore_button_hover_color'] ?>"  />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('readmore_button_hover_link_color'); ?>"> <?php _e('Button Hover Text Color',$lavan_plugin_name); ?> </label>
    <input id="<?php echo $this->get_field_id('readmore_button_hover_link_color'); ?>" name="<?php echo $this->get_field_name('readmore_button_hover_link_color'); ?>" type="text" class="button_color_pickr" value="<?php echo 
    $instance['readmore_button_hover_link_color'] ?>"  />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('readmore_button_border_hover_color'); ?>"> <?php _e('Button Hover Border Color',$lavan_plugin_name); ?> </label>
    <input id="<?php echo $this->get_field_id('readmore_button_border_hover_color'); ?>" name="<?php echo $this->get_field_name('readmore_button_border_hover_color'); ?>" type="text" class="button_color_pickr" value="<?php echo $instance['readmore_button_border_hover_color'] ?>"  />
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('readmore_button_border_width'); ?>">  <?php  _e('Button Border Width',
    $lavan_plugin_name); ?></label> 
     <input id="<?php echo $this->get_field_id('readmore_button_border_width'); ?>" name="<?php echo $this->get_field_name
    ('readmore_button_border_width'); ?>" type="text" class="small-text" value="<?php echo $instance
    ['readmore_button_border_width'] ?>" />
    <small><?php _e('PX',$lavan_plugin_name);?></small>
  </p>
    
</div>
<div class="input-elements-wrapper">
  <p class="one_fourth img_radio_select">
    <label for="<?php echo $this->get_field_id('readmore_button_alignment') ?>">  <?php _e('Button Alignment',
    $lavan_plugin_name) ?>  </label>
    <label>
    <input type="radio" id="<?php echo $this->get_field_id( 'readmore_button_alignment' ); ?>" name="<?php echo $this->get_field_name( 'readmore_button_alignment' ); ?>" value="center" <?php checked( $instance
    ['readmore_button_alignment'], 'center' ); ?>>  <img alt="Align Center" title="Align Center"  src="<?php 
    echo constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'images/button_center.png' ?>">
    </label>
    <label>
    <input type="radio" id="<?php echo $this->get_field_id( 'readmore_button_alignment' ); ?>" name="<?php echo $this->get_field_name( 'readmore_button_alignment' ); ?>" value="left" <?php checked( $instance['readmore_button_alignment'], 'left' ); ?>> <img alt="Align Left" title="Align Left" src="<?php echo constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'images/button_left.png' ?>">
    </label>
    <label> 
    <input type="radio" id="<?php echo $this->get_field_id( 'readmore_button_alignment' ); ?>" name="<?php echo $this->get_field_name( 'readmore_button_alignment' ); ?>" value="right" <?php checked( $instance['readmore_button_alignment'], 'right' ); ?>>  <img alt="Align Right" title="Align Right"  src="<?php echo constant(strtoupper(
    $lavan_plugin_name).'_PLUGIN_URL').'images/button_right.png' ?>">
    </label>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('readmore_button_link'); ?>"><?php  _e('Destination URL',
    $lavan_plugin_name); ?></label>
    <input id="<?php echo $this->get_field_id('readmore_button_link'); ?>" name="<?php echo $this->get_field_name
    ('readmore_button_link'); ?>" type="text" class="widefat" value="<?php echo $instance['readmore_button_link'] ?>"  />
    <small><?php _e('Ex: http://www.google.com',$lavan_plugin_name);?></small>
  </p>
   <p class="one_fourth">
     <label for="<?php echo $this->get_field_id('readmore_button_new_window') ?>"> <?php _e('Open In New Window',
     $lavan_plugin_name) ?>
     </label>
     <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("readmore_button_new_window"); ?>" name=
     "<?php echo $this->get_field_name("readmore_button_new_window"); ?>"<?php checked( (bool) $instance
     ["readmore_button_new_window"], true ); ?> />
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('readmore_button_margin_top'); ?>"><?php  _e('Margin Top',
    $lavan_plugin_name); ?></label>
    <input id="<?php echo $this->get_field_id('readmore_button_margin_top'); ?>" name="<?php echo $this->get_field_name
    ('readmore_button_margin_top'); ?>" type="text" class="small-text" value="<?php echo $instance['readmore_button_margin_top'] ?>" />
    <small><?php _e('px',$lavan_plugin_name) ?></small>
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
<?php }
}
lavan_kaya_register_widgets('readmore-button-widget',__FILE__);
?>