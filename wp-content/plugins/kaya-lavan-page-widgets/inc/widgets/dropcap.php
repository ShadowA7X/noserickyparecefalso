<?php
/* Dropcap */

class Lavan_Dropcap_Widget extends WP_Widget {
  public function __construct() {
  global $lavan_plugin_name;  
    // widget actual processes
    parent::__construct(
      'dropcap-widget', // Base ID
     ucfirst($lavan_plugin_name).' '.__(' - Dropcap',$lavan_plugin_name).'&nbsp;<a class="widget_video_tutorials" target="_blank" href="https://youtu.be/38weyeAzqZE">'.__('Watch this video', $lavan_plugin_name).'</a>',
      array( 'description' => __( 'Use this widget to create drop cap with text or Font Awesome icons', $lavan_plugin_name ), ) // Args
    );
  }

  public function widget( $args, $instance ) {
    echo $args['before_widget'];
    global $lavan_plugin_name;
  $instance = wp_parse_args( $instance, array(

      'title' => __('Dropcap Title',$lavan_plugin_name),
        'dropcap_text' => 'A',
        'dropcap_bg_color' => '#333333',
        'description' => __('Enter Description Here',$lavan_plugin_name),
        'readmore_text' => '',
        'link' => '',
        'dropcap_color' => '#ffffff',
        'title_color' => '#ffffff',
        'description_color' => '#787878',
        'dropap_align' => __('center', $lavan_plugin_name),
        'awesome_icon_name' => '',
        'dropap_font_size' => '',
        'text_wrap' => __('false',$lavan_plugin_name),
        'border_radius' => '',
        'border_color' => '#151515',
        'animation_names' => '',
    ) ); 
    ?>
<?php 
  $dropcap_rand = rand(1,500);
  if( $instance['dropcap_bg_color'] ):
    ?>
      <style type="text/css">
            .dropca-<?php echo $dropcap_rand; ?> .dropcap_bg:hover, .dropca-<?php echo $dropcap_rand; ?> .dropcap_bg:hover {
                background-color: <?php echo $instance['dropcap_color']; ?>!important;
                color: <?php echo $instance['dropcap_bg_color']; ?>!important;
            }
          .dropcap a:hover{
            opacity: 0.8!important;
          }
      </style>
  <?php 
  endif;
 if($instance['dropcap_bg_color'] || $instance['border_color'] ): 

  $padding = round($instance['dropap_font_size'] / 4).'px'; 

endif;

if($instance['border_color']){
  $border_color = '1px solid '.$instance['border_color'];
  $border_shadow = '0px 3px 0px 0px '.$instance['border_color'];
}else{ $border_color = '0px solid '.$instance['border_color']; $border_shadow =''; }

 $line_height = round($instance['dropap_font_size'] /2 ).'px';

 $text_wrap = $instance['text_wrap'] == 'true' ? 'inherit' : 'hidden';

 $icon_size = round($instance['dropap_font_size'] / 2);

  $dropcap_data = array(

      'width' => round( $instance['dropap_font_size'] / 2 ).'px',
      'height' => round( $instance['dropap_font_size'] / 2).'px',
     'line-height' => $line_height,
      'font-size' => $icon_size.'px',
      'background-color' => $instance['dropcap_bg_color'],
      'color' => $instance['dropcap_color'].'',
      'padding' =>  $padding,
      'border' => $border_color,
      'border-radius' => $instance['border_radius'].'%',
      'box-shadow' => $border_shadow,

  );

   $dropcap_styles =array();
    foreach ($dropcap_data as $key => $value) {
       $dropcap_styles[] = $key.':'.$value;
   }

  if($instance['dropcap_bg_color']): $hover = 'this.style.background="'.$instance["dropcap_color"].'"; this.style.color="'.$instance["dropcap_bg_color"].'"'; 
  $hoverout = 'this.style.background="'.$instance["dropcap_bg_color"].'"; this.style.color="'.$instance["dropcap_color"].'"';  
    else:
      $hoverout='';
    $hover='';

endif;

   ?>
<div class="dropcap dropcap_<?php echo $instance['dropap_align']; ?> dropca-<?php echo $dropcap_rand; ?> wow <?php echo $instance['animation_names']?> " > 
  <div class="dropcap_bg align<?php echo $instance['dropap_align']; ?>  <?php echo $this->get_field_id('dropcap_bg_color')
   ?>" style="<?php echo  implode('; ',$dropcap_styles); ?>">
    <?php
    if( $instance['awesome_icon_name'] ){
    echo ' <i class="fa '.$instance['awesome_icon_name'].'" > </i>';
    }else {
    ?>
    <strong style="font-weight:blod;"><?php echo $instance['dropcap_text']; ?></strong>
    <?php  } ?>

    </div>
    <div class="description" style="overflow:<?php echo $text_wrap; ?>">
      
    <?php if (trim($instance['title'])){
    if( $instance['link'] ){ ?>
    <a href="<?php echo esc_url($instance['link']); ?>" >
    <?php } ?>
    <h3 style="color:<?php echo $instance['title_color']; ?>!important; text-align:<?php echo $instance['dropap_align']; ?>"><?php echo $instance['title']; ?>
    </h3>
    <?php if( $instance['link'] ){ ?> </a> <?php }  } ?>
    <p style="color:<?php echo $instance['description_color']; ?>!important; text-align:<?php echo $instance['dropap_align']; ?>"><?php echo $instance['description']; ?></p>
    <?php if( $instance['readmore_text'] ): echo '<a href="'.esc_url($instance['link']).'" class="readmore readmore-1">'.esc_attr($instance['readmore_text']).'</a>'; endif;  ?>
  </div>
</div>
<?php echo $args['after_widget'];

  }

  public function form( $instance ) {
  global $lavan_plugin_name;  
    $instance = wp_parse_args( $instance, array(

        'title' => __('Dropcap Title',$lavan_plugin_name),
        'dropcap_text' => 'A',
        'dropcap_bg_color' => '#333333',
        'description' => __('Enter Description Here',$lavan_plugin_name),
        'readmore_text' => '',
        'link' => '',
        'dropcap_color' => '#ffffff',
        'title_color' => '#ffffff',
        'description_color' => '#787878',
        'dropap_align' => __('center',$lavan_plugin_name),
        'awesome_icon_name' => '',
        'dropap_font_size' => '',
        'text_wrap' => __('false', $lavan_plugin_name),
        'border_radius' => '0',
        'border_color' => '#151515',
        'animation_names' => '',

    ) );

    $font_sizes = array(16,24,32,48,64,128);
    ?>
<script type="text/javascript">
(function($){
  "use strict";
  $('.dropcap_color_picker').each(function(){
  $(this).wpColorPicker();  
  });
  })(jQuery);
</script>

<div class="input-elements-wrapper">    
  <p>
    <label for="<?php echo $this->get_field_id('awesome_icon_name') ?>">
    <?php _e('Awesome Icon Name',$lavan_plugin_name) ?>
    </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('awesome_icon_name') ?>" name="<?php echo $this->get_field_name('awesome_icon_name') ?>" value="<?php echo esc_attr($instance['awesome_icon_name']) ?>" />
    <small>
    <?php _e('Ex: fa-home, for More Awesome icons click',$lavan_plugin_name); ?>
    <a href='http://fontawesome.io/icons/' target='_blank'> click here </a></small>
  </p>
</div>
<div class="input-elements-wrapper">
  <p class="one_fourth">     
    <label for="<?php echo $this->get_field_id('dropcap_text') ?>">
    <?php _e('Enter Dropcap Text',$lavan_plugin_name) ?>
    </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('dropcap_text') ?>" name="<?php echo $this->get_field_name('dropcap_text') ?>" value="<?php echo esc_attr($instance['dropcap_text']) ?>" />
    <small>
    <?php _e('Ex: A  <stong> Note: </strong>It Works only when above icon name field is empty ',$lavan_plugin_name) ?>
    </small> 
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('dropap_font_size') ?>">
    <?php _e('Dropcap Size',$lavan_plugin_name)?>
    </label>
    <select id="<?php echo $this->get_field_id('dropap_font_size') ?>"  class="small-text" name="<?php echo $this->get_field_name
    ('dropap_font_size') ?>">
    <?php  foreach ($font_sizes as $font_size) {
    echo '<option value="' .$font_size. '"  id="' .$font_size. '"',  $instance['dropap_font_size'] == $font_size  ? 'selected = "selected"' : '',' >'.$font_size.'</option>';
    }
    ?>
    </select>
    <small><?php _e('px',$lavan_plugin_name); ?></small>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('dropap_align') ?>">
    <?php _e('Dropcap Position',$lavan_plugin_name)?>
    </label>
    <select id="<?php echo $this->get_field_id('dropap_align') ?>" name="<?php echo $this->get_field_name('dropap_align') ?>">
      <option value="left" <?php selected('left', $instance['dropap_align']) ?>>
      <?php _e('Position Left', $lavan_plugin_name) ?>
      </option>
      <option value="right" <?php selected('right', $instance['dropap_align']) ?>>
      <?php _e('Position Right', $lavan_plugin_name) ?>
      </option>
      <option value="center" <?php selected('center', $instance['dropap_align']) ?>>
      <?php _e('Position Center', $lavan_plugin_name) ?>
      </option>
    </select>
  </p>
</div>
<div class="input-elements-wrapper">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('dropcap_bg_color') ?>">
    <?php _e('Dropcap Background Color',$lavan_plugin_name) ?>
    </label>
    <input type="text" class="dropcap_color_picker" id="<?php echo $this->get_field_id('dropcap_bg_color') ?>" name="<?php echo $this->get_field_name('dropcap_bg_color') ?>" value="<?php echo esc_attr($instance['dropcap_bg_color']) ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('dropcap_color') ?>">
    <?php _e('Dropcap Text Color',$lavan_plugin_name) ?>
    </label>
    <input type="text" class="dropcap_color_picker" id="<?php echo $this->get_field_id('dropcap_color') ?>" name="<?php echo $this->get_field_name('dropcap_color') ?>" value="<?php echo esc_attr($instance['dropcap_color']) ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('border_color') ?>">
    <?php _e('Dropcap Border Color',$lavan_plugin_name) ?>
    </label>
    <input type="text" class="dropcap_color_picker" id="<?php echo $this->get_field_id('border_color') ?>" name="<?php echo $this->get_field_name('border_color') ?>" value="<?php echo esc_attr($instance['border_color']) ?>" />
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('border_radius') ?>">
    <?php _e('Dropcap Border Radius',$lavan_plugin_name) ?>
    </label>
    <input type="text" class="small-text" id="<?php echo $this->get_field_id('border_radius') ?>" name="<?php echo $this->get_field_name('border_radius') ?>" value="<?php echo esc_attr($instance['border_radius']) ?>" />
    <small><?php _e(' %',$lavan_plugin_name); ?></small>
    <br/>
    <small>
    <?php _e('Ex:10,20 <stont> Note: </stong>It applies only percentage(%)',$lavan_plugin_name) ?>
    </small>
  </p>
</div> 
<div class="input-elements-wrapper">
  <p class="two_third"> 
    <label for="<?php echo $this->get_field_id('title') ?>">
    <?php _e('Title', '') ?>
    </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo esc_attr($instance['title']) ?>" />
  </p>
  <p class="one_third_last">
    <label for="<?php echo $this->get_field_id('title_color') ?>">
    <?php _e('Title Color',$lavan_plugin_name) ?>
    </label>
    <input type="text" class="dropcap_color_picker" id="<?php echo $this->get_field_id('title_color') ?>" name="<?php echo $this->get_field_name('title_color') ?>" value="<?php echo esc_attr($instance['title_color']) ?>" />
  </p>
</div>
<div class="input-elements-wrapper">
  <p class="two_third">
    <label for="<?php echo $this->get_field_id('description') ?>">
    <?php  _e('Description' ,$lavan_plugin_name); ?>
    </label>
    <textarea type="text" class="widefat" name="<?php echo $this->get_field_name('description') ?>" id="<?php echo $this->get_field_id('description') ?>" ><?php echo esc_attr($instance['description']) ?></textarea>
  </p>
  <p class="one_third_last">
    <label for="<?php echo $this->get_field_id('description_color') ?>">
    <?php _e('Description Color',$lavan_plugin_name) ?>
    </label>
    <input type="text" class="dropcap_color_picker" id="<?php echo $this->get_field_id('description_color') ?>" name="<?php echo $this->get_field_name('description_color') ?>" value="<?php echo esc_attr($instance['description_color']) ?>" />
  </p>
</div>
<div class="input-elements-wrapper">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('readmore_text') ?>">
    <?php _e('Readmore Button Text',$lavan_plugin_name) ?>
    </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('readmore_text') ?>" name="<?php echo $this->get_field_name('readmore_text') ?>" value="<?php echo esc_attr($instance['readmore_text']) ?>" />
    <small>
    <?php _e('<stong>Note: </strong>Keep it empty to not display the readmore button ',$lavan_plugin_name) ?>
    </small>
  </p>
  <p class="one_fourth"> 
    <label for="<?php echo $this->get_field_id('link') ?>">
    <?php _e('Readmore Button Link',$lavan_plugin_name) ?>
    </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('link') ?>" name="<?php echo $this->get_field_name('link') ?>" value="<?php echo esc_attr($instance['link']) ?>" />
    <small>
    <?php _e('Ex:http://www.google.com',$lavan_plugin_name) ?>
    </small>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('text_wrap') ?>">
    <?php _e('Text Wrapping',$lavan_plugin_name)?>
    </label>
    <select id="<?php echo $this->get_field_id('text_wrap') ?>" name="<?php echo $this->get_field_name('text_wrap') ?>">
      <option value="true" <?php selected('true', $instance['text_wrap']) ?>>
      <?php _e('True', $lavan_plugin_name) ?>
      </option>
      <option value="false" <?php selected('false', $instance['text_wrap']) ?>>
      <?php _e('False', $lavan_plugin_name) ?>
      </option>
    </select>
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
lavan_kaya_register_widgets('dropcap-widget',__FILE__);
?>