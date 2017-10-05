<?php
/* iconbox */
class Lavan_Iconbox_Widget extends WP_Widget {
  public function __construct() {
  global $lavan_plugin_name;
   // widget actual processes
   parent::__construct(
      'iconbox-widget', // Base ID
    ucfirst($lavan_plugin_name).' '.__(' - Icon Box (PB)',$lavan_plugin_name).'&nbsp;<a class="widget_video_tutorials" target="_blank" href="https://youtu.be/oqFIhlDyzHU">'.__('Watch this video', $lavan_plugin_name).'</a>',
   array( 'description' => __( 'Use this widget to create icon box with text or Font icons',  $lavan_plugin_name)) // Args
 );
 }
public function widget( $args, $instance ) {
  global $lavan_plugin_name;
  echo $args['before_widget'];
  $instance = wp_parse_args( $instance, array(
        'title' => __('Icon Box Title',$lavan_plugin_name),
        'title_font_weight'=>__('normal',$lavan_plugin_name),
        'iconbox_text' => '',
        'iconbox_bg_color' => '#ffffff',
        'iconbox_bg_hover_color' => '#fff',
        'iconbox_text_hover_color' => '#333333',
        'description' => __('Enter Description Here',$lavan_plugin_name),
        'readmore_text' => '',
        'link' => '#',
        'icon_color' => '#21cdec',
        'title_color' => '#333333',
        'description_color' => '#787878',
        'new_window'=>'',
        'iconbox_align' => __('center',$lavan_plugin_name),
        'awesome_icon_name' => __('glass',$lavan_plugin_name),
        'iconbox_font_size' => '32',
        'iconbox_container_size' => '65',
        'text_wrap' => '',
        'border_radius' => '3',
        'border_color' => '#21cdec',
        'border_hover_color' => '',
        'iconbox_rotate' => '0',
        'iconbox_link_disable' => '',
        'iconbox_icon_rotate_hover' => '',
        'animation_names' => '',
        'icon_url_id' => '',
        'font_icon_name' => '',
        'select_font_icon_type' => '',
        'icon_url' => '',
        'select_display_icon_type' => '',
        'icon_container_enable' => '',
        'enable_iconbox_scale' => '',
        'title_letter_space' => '0',
        'description_letter_space' => '',
        'title_font_style' => __('normal',$lavan_plugin_name),
        'title_font_size' => '18',
        'description_font_weight' => __('normal',$lavan_plugin_name),
        'description_font_style' => __('notmal',$lavan_plugin_name),
        'description_font_size' => '14',
    ) );
    if( $instance['select_font_icon_type'] == 'awesome_fonts' ){
     // wp_enqueue_style('fontawesome');
      wp_enqueue_style('fontawesome', constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'/icons/fontawesome/style.css',false, '', 'all');
    }
    if( $instance['select_font_icon_type'] == 'generaic_icons' ){
      wp_enqueue_style('genericons', constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'/icons/genericons/style.css',false, '', 'all');
    }
    if( $instance['select_font_icon_type'] == 'elegentline_icons' ){
      //wp_enqueue_style('elegantline');
      wp_enqueue_style('elegantline', constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'/icons/elegantline/style.css',false, '', 'all');
    }
    if( $instance['select_font_icon_type'] == 'icomoon_icons' ){
      wp_enqueue_style('icomoon', constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'/icons/icomoon/style.css',false, '', 'all');
    }
  $iconbox_rand = rand(1,500);
  $upload_img_id = wp_get_attachment_image_src($instance['icon_url_id'], "full");
  if($instance['icon_container_enable'] == 'on' ): 
    $icon_container_size = $instance['iconbox_container_size'] ? $instance['iconbox_container_size'] : '60';
    $container_bg_color  = $instance['iconbox_bg_color'] ? $instance['iconbox_bg_color'] : '';
    $container_bg_hover_color  = $instance['iconbox_bg_hover_color'] ? $instance['iconbox_bg_hover_color'] : '';
    $border_radius  = $instance['border_radius'] ? $instance['border_radius'] : '3';
    $icon_border_color  = $instance['border_color'] ? $instance['border_color'] : '';
    $border_hover_color  = $instance['border_hover_color'] ? $instance['border_hover_color'] : '';
    $container_image_height = round(($instance['iconbox_container_size'] / 2) - ( $instance['iconbox_font_size'] / 2 ) );
    $icon_left_align = ( $instance['iconbox_align'] == 'none' ) ? 'text-align:center;':'';
    $enable_iconbox_scale = ( $instance['enable_iconbox_scale'] == 'on' ) ? 'iconbox_icon_bg_scale':'';
    $img_icon_height = round(($instance['iconbox_container_size'] / 2) - ( $upload_img_id[1] / 2 ) );
  else:
      $icon_container_size = '';
      $container_bg_color = '';
      $container_bg_hover_color = '';
      $border_radius = '';
      $icon_border_color = '';
      $border_hover_color  = '';
      $container_image_height = '';
      $icon_left_align = ( $instance['iconbox_align'] == 'none' ) ? 'text-align:left;':'';
      $enable_iconbox_scale = '';
      $img_icon_height = '';
  endif;

  if( $instance['iconbox_rotate'] > '15' ):
    if( $instance['iconbox_align'] == 'left'){
     $margin = 'margin-right:30px;'; 
    }
    elseif( $instance['iconbox_align'] == 'right'){
      $margin = 'margin-left:30px;';
    }
    else{
      $margin ='';
    }
  else:
    $margin ='';
  endif;  
  if( $instance['iconbox_rotate'] > '15'){
    $margin_top = round( $instance['iconbox_container_size'] / 4).'px';
    $margin_bottom = round( $instance['iconbox_container_size'] / 3).'px'; 
  }else{
    $margin_top = '';
    $margin_bottom = '';

  }
  if($icon_border_color){
    $border_color = '1px solid '.$icon_border_color;
    $border_shadow = '0px 3px 0px 0px '.$icon_border_color;
  }else{ 
    $border_color = '0px solid '.$icon_border_color; $border_shadow ='';
     }
  $text_wrap = $instance['text_wrap'] == 'on' ? 'inherit' : 'hidden';
  $icon_size = round($instance['iconbox_font_size'] );
  $iconbox_data = array(
      'width' => $icon_container_size.'px!important',
      'height' => $icon_container_size.'px',
      'line-height' => $icon_container_size.'px',
      'font-size' => $icon_size.'px',
      //'background-color' => $container_bg_color,
      'color' => $instance['icon_color'].'',
      'border' => $border_color,
      'border-radius' => $border_radius.'px',
      'margin-top' =>  $margin_top,
      'margin-bottom' =>  $margin_bottom,
  );

   $iconbox_styles =array();
   foreach ($iconbox_data as $key => $value) {
       $iconbox_styles[] = $key.':'.$value;
   }   
   $iconbox_icon_rotate_hover = ( $instance['iconbox_icon_rotate_hover'] == 'on') ? 'on' :'off';
   $iconbox_animation =   ( trim( $instance['animation_names'] ) )  ? 'wow '. $instance['animation_names'] : '';
   ?>
    <?php //$new_tab = ($instance['new_tab'] == 'on') ? 'target: _blank' : ''; ?>
  <div class="<?php echo $iconbox_animation; ?> iconbox iconbox_<?php echo $instance['iconbox_align']; ?> iconbox-<?php echo $iconbox_rand; ?>" data-rotate="<?php echo $instance['iconbox_rotate'] ?>" data-rotate-hover="<?php echo $iconbox_icon_rotate_hover; ?>" data-bgcolor="<?php echo $container_bg_color; ?>" data-icon="<?php echo $instance['icon_color'] ?>" data-hoverbg="<?php echo $container_bg_hover_color; ?>" data-hovericon="<?php echo $instance['iconbox_text_hover_color'] ?>" data-border-hover="<?php echo $border_hover_color; ?>" data-border-color="<?php echo $icon_border_color; ?>" >
      <?php if($instance['iconbox_link_disable'] != 'on' &&  $instance['link']): ?>
         <a href="<?php echo $instance['link'] ?>" target="<?php echo $instance['new_window']; ?>">
      <?php endif; ?>
      <?php if( $instance['select_display_icon_type'] == 'image_icons' ){
          echo '<div class="icon_image iconbox_bg align'.$instance['iconbox_align'].'" style="'.$margin.' '.implode('; ',$iconbox_styles).'">';
            echo '<div class="iconbox_iconbg_conatiner '.$enable_iconbox_scale.'" style="background-color:'.$container_bg_color.'; border-radius:'.$border_radius.'px;">';
              echo '<img src="'.$instance['icon_url'].'" style="padding:'.$img_icon_height.'px; '. $icon_left_align .'" />';
          echo '</div></div>';
      }else{ ?>
          <div class="iconbox_bg align<?php echo $instance['iconbox_align']; ?>  <?php echo $this->get_field_id('iconbox_bg_color') ?>" style="<?php echo $margin .' '. $icon_left_align; ?> <?php  echo  implode('; ',$iconbox_styles); ?> ">
            <?php
            echo '<div class="iconbox_iconbg_conatiner '.$enable_iconbox_scale.'" style="background-color:'.$container_bg_color.'; border-radius:'.$border_radius.'px; width:'.$icon_container_size.'px; height:'.$icon_container_size.'px;">';
              if( $instance['select_display_icon_type'] == 'font_icons' ){
                //echo '<div class="iconbox_iconbg_conatiner" style="background-color:'.$container_bg_color.'; border-radius:'.$border_radius.'px; width:'.$icon_container_size.'px; height:'.$icon_container_size.'px;">';
                  display_font_icons( $instance['font_icon_name'], $instance['select_font_icon_type'] );
                
              }elseif( $instance['select_display_icon_type'] == 'letter_icons' ){
                        echo '<div class="" style="line-height:'.$icon_container_size.'px;">'. $instance['iconbox_text'].'</div>';
              }else{
                display_font_icons( $instance['font_icon_name'], $instance['select_font_icon_type'] );  
              }
            echo '</div>';
            echo '</div>';  
        } ?>
      
      <?php if($instance['iconbox_link_disable'] != 'on' && $instance['link']): ?>
        </a>
      <?php endif; ?>
      <div class="description" style="overflow:<?php echo $text_wrap; ?>">
        <?php if( trim(!empty( $instance['title']))){ ?>
         <?php if( $instance['link'] ){ ?>
            <a href="<?php echo esc_url($instance['link']); ?>" target="<?php echo $instance['new_window']; ?>" >
        <?php } ?>
          <h3 style="color:<?php echo $instance['title_color']; ?>!important; font-weight:<?php echo $instance['title_font_weight']; ?>; text-align:<?php echo $instance['iconbox_align']; ?>; letter-spacing:<?php echo $instance['title_letter_space'] ?>px; font-size:<?php echo $instance['title_font_size'] ?>px!important; font-style:<?php echo $instance['title_font_style'] ?>;"><?php echo $instance['title']; ?>
          </h3>
        <?php if( $instance['link'] ){ ?> </a> <?php } } ?>
          <p style="color:<?php echo $instance['description_color']; ?>!important; text-align:<?php echo $instance['iconbox_align']; ?>; letter-spacing:<?php echo $instance['description_letter_space'] ?>px; font-size:<?php echo $instance['description_font_size'] ?>px; font-weight:<?php echo $instance['description_font_weight'] ?>; font-style:<?php echo $instance['description_font_style'] ?>"><?php echo $instance['description']; ?></p>
        <?php if( $instance['readmore_text'] ): echo '<a href="'.esc_url($instance['link']).'" target="'.esc_url($instance['new_window']).'" class="readmore readmore-1">'.esc_attr($instance['readmore_text']).'</a>'; endif;  ?>
      </div>
  </div>
  <?php 
 echo $args['after_widget'];
  }

  public function form( $instance ) {
    global $lavan_plugin_name;
    $instance = wp_parse_args( $instance, array(
        'title' => __('Icon Box Title',$lavan_plugin_name),
        'title_font_weight'=>__('normal',$lavan_plugin_name),
        'iconbox_text' => '',
        'iconbox_bg_color' => '#ffffff',
        'iconbox_bg_hover_color' => '#fff',
        'iconbox_text_hover_color' => '#333333',
        'description' => __('Enter Description Here',$lavan_plugin_name),
        'readmore_text' => '',
        'link' => '#',
        'icon_color' => '#21cdec',
        'title_color' => '#333333',
        'description_color' => '#787878',
        'iconbox_align' => __('center',$lavan_plugin_name),
         'awesome_icon_name' => __('glass',$lavan_plugin_name),
        'iconbox_container_size' => '65',
        'new_window'=>'',
        'iconbox_font_size' => '32',
        'text_wrap' => '',
        'border_radius' => '3',
        'border_color' => '#21cdec',
        'border_hover_color' => '',
        'iconbox_rotate' => '0',
        'iconbox_link_disable' => '',
        'iconbox_icon_rotate_hover' => '',
        'animation_names' => '',
        'icon_url_id' => '',
        'font_icon_name' => '',
        'select_font_icon_type' => __('awesome_fonts',$lavan_plugin_name),
        'icon_url' => '',
        'select_display_icon_type' => __('font_icons',$lavan_plugin_name),
        'icon_container_enable' => '',
        'enable_iconbox_scale' => '',        
        'title_letter_space' => '0',
        'description_letter_space' => '',
        'title_font_style' => __('normal',$lavan_plugin_name),
        'title_font_size' => '18',
        'description_font_weight' => __('normal',$lavan_plugin_name),
        'description_font_style' => __('notmal',$lavan_plugin_name),
        'description_font_size' => '14',
    ) );
    $font_sizes = array(16,24,32,48,64,80,98,128);   ?> 
  <script type="text/javascript">
      (function($) {
      "use strict";
      $(function() {
      $(".icon_alignment input").change(function () {
      $("#<?php echo $this->get_field_id('text_wrap') ?>").parent().hide();
      var aling_left = $('.icon_alignment input[value="left"]');
      var aling_right = $('.icon_alignment input[value="right"]');
      if(  aling_left.is(":checked") ){
        $("#<?php echo $this->get_field_id('text_wrap') ?>").parent().show();
      }else if( aling_right.is(":checked") ){
        $("#<?php echo $this->get_field_id('text_wrap') ?>").parent().show();
      }
      else{
      }
      }).change();
      // Color Pickr 
       $('.iconbox_color_pickr').each(function(){
        $(this).wpColorPicker();
      });
  // Selecet icons type
   $("#<?php echo $this->get_field_id('select_display_icon_type') ?>").change(function () {
      $("#<?php echo $this->get_field_id('select_font_icon_type') ?>").parent().hide();
      $("#<?php echo $this->get_field_id('font_icon_name') ?>").hide();
      $("#<?php echo $this->get_field_id('icon_url'); ?>").parent().hide();
      $("#<?php echo $this->get_field_id('iconbox_text'); ?>").parent().hide();
      $(".<?php echo $this->get_field_id('iconbox_font_size'); ?>").find('p').eq(0).show();
      $(".<?php echo $this->get_field_id('iconbox_font_size'); ?>").find('p').eq(1).show();
      $(".<?php echo $this->get_field_id('iconbox_font_size'); ?>").find('p').eq(2).show();
      var select_font_icons_type = $("#<?php echo $this->get_field_id('select_display_icon_type') ?> option:selected").val(); 
      switch(select_font_icons_type){
        case 'font_icons':
          $("#<?php echo $this->get_field_id('select_font_icon_type') ?>").parent().show();
          $("#<?php echo $this->get_field_id('font_icon_name') ?>").show();
          $(".<?php echo $this->get_field_id('iconbox_font_size'); ?>").find('p').eq(4).removeClass('one_fifth').addClass('one_fifth_last');
          break;
        case 'image_icons':
          $("#<?php echo $this->get_field_id('icon_url'); ?>").parent().show();
          $(".<?php echo $this->get_field_id('iconbox_font_size'); ?>").find('p').eq(0).hide();
          $(".<?php echo $this->get_field_id('iconbox_font_size'); ?>").find('p').eq(1).hide();
          $(".<?php echo $this->get_field_id('iconbox_font_size'); ?>").find('p').eq(2).hide();
          $(".<?php echo $this->get_field_id('iconbox_font_size'); ?> .one_fifth_last").removeClass('one_fifth_last').addClass('one_fifth');
           break;
        case 'letter_icons':
          $("#<?php echo $this->get_field_id('iconbox_text'); ?>").parent().show();
          $(".<?php echo $this->get_field_id('iconbox_font_size'); ?>").find('p').eq(4).removeClass('one_fifth').addClass('one_fifth_last');
          break;    
      }
    }).change(); 

//
    $("#<?php echo $this->get_field_id('icon_container_enable') ?>").change(function () {
      $(".icon_container_bg_section").hide();
      var aling_left = $('.img_radio_select input[value="left"]');
      var aling_right = $('.img_radio_select input[value="right"]');
      if( $("#<?php echo $this->get_field_id('icon_container_enable') ?>").is(":checked") ){
        $(".icon_container_bg_section").show();
      }
      else{
        $(".icon_container_bg_section").hide();
      }
      }).change();
 

     });
  })(jQuery);
    </script>

<div class="input-elements-wrapper"> 
  <p>
    <label for="<?php echo $this->get_field_id('select_display_icon_type') ?>">  <?php _e('Select Icon Type',
    $lavan_plugin_name) ?> </label>
    <select id="<?php echo $this->get_field_id('select_display_icon_type') ?>" class="iconbox_widget_select" name="<?php echo $this->get_field_name
      ('select_display_icon_type') ?>">
      <option value="font_icons" <?php selected('font_icons', $instance['select_display_icon_type']) ?>> <?php _e('Font Type Icons', $lavan_plugin_name) ?> </option>
      <option value="image_icons" <?php selected('image_icons', $instance['select_display_icon_type']) ?>> <?php _e('Image Icon', $lavan_plugin_name) ?> </option>
      <option value="letter_icons" <?php selected('letter_icons', $instance['select_display_icon_type']) ?>> <?php _e('Letter Icons', $lavan_plugin_name) ?> </option>
    </select>
  </p>
<?php select_font_icons($this->get_field_id('select_font_icon_type'), $this->get_field_name('select_font_icon_type'),
 $instance['select_font_icon_type']); ?>
<?php kaya_font_icons($this->get_field_id('font_icon_name'), $this->get_field_name('font_icon_name'), $instance['font_icon_name']); ?>
  <p>
    <?php $i = rand(1,100); ?>
    <img class="custom_media_image_<?php echo $i; ?>" src="<?php if(!empty($instance['icon_url'])){echo $instance['icon_url'];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
    <input type="text" class="widefat custom_media_url_<?php echo $i; ?>" name="<?php echo $this->get_field_name('icon_url'); ?>" id="<?php echo $this->get_field_id('icon_url'); ?>" value="<?php echo $instance['icon_url']; ?>">

    <input type="hidden" class="small-text custom_media_url_id_<?php echo $i; ?>" name="<?php echo $this->get_field_name('icon_url_id'); ?>" id="<?php echo $this->get_field_id('icon_url_id'); ?>" value="<?php echo $instance['icon_url_id']; 
    ?>">

    <input type="button" value="<?php _e( 'Upload Image', $lavan_plugin_name); ?>" class="button custom_media_upload_<?php echo $i; ?>" id="custom_media_upload_<?php echo $i; ?>"/>

    <script type="text/javascript">
      jQuery(document).ready( function(){
      jQuery('.custom_media_upload_<?php echo $i; ?>').click(function(e) {
      e.preventDefault();
      var custom_uploader = wp.media({
      title: 'Upload Icon',
      button: {
      text: 'Upload Icon'
      },
      multiple: false  // Set this to true to allow multiple files to be selected
      })
      .on('select', function() {
      var attachment = custom_uploader.state().get('selection').first().toJSON();
      jQuery('.custom_media_image_<?php echo $i; ?>').attr('src', attachment.url);
      jQuery('.custom_media_url_id_<?php echo $i; ?>').val(attachment.id);
      jQuery('.custom_media_url_<?php echo $i; ?>').val(attachment.url);
      })
      .open();
      });
      });
    </script>
  </p>
  <p class="clearfix">
    <label for="<?php echo $this->get_field_id('iconbox_text') ?>"> <?php _e('Icon Text',$lavan_plugin_name) ?> </label>
    <input type="text" class="small-text" id="<?php echo $this->get_field_id('iconbox_text') ?>" name="<?php echo $this->get_field_name('iconbox_text') ?>" value="<?php echo esc_attr($instance['iconbox_text']) ?>" />
    <small><?php _e('Ex: A',$lavan_plugin_name); ?></small>
  </p>
</div>
<div class="input-elements-wrapper <?php echo $this->get_field_id('iconbox_font_size') ?>">  
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('iconbox_font_size') ?>">  <?php _e('Icon Size',$lavan_plugin_name)?> 
    </label>
    <input type="text" class="small-text" id="<?php echo $this->get_field_id('iconbox_font_size') ?>" name="<?php echo $this->get_field_name('iconbox_font_size') ?>" value="<?php echo esc_attr($instance['iconbox_font_size']) ?>" />
    <small><?php _e('px'); ?></small>
  </p>
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('icon_color') ?>">  <?php _e('Icon Color',$lavan_plugin_name) ?>  </label>
    <input type="text" class="widefat iconbox_color_pickr" id="<?php echo $this->get_field_id('icon_color') ?>" name="<?php echo $this->get_field_name('icon_color') ?>" value="<?php echo esc_attr($instance['icon_color']) ?>" />
  </p>
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('iconbox_text_hover_color') ?>">  <?php _e('Icon Hover Color',
    $lavan_plugin_name) ?>  </label>
    <input type="text" class="widefat iconbox_color_pickr" id="<?php echo $this->get_field_id('iconbox_text_hover_color') ?>" name="<?php echo $this->get_field_name('iconbox_text_hover_color') ?>" value="<?php echo esc_attr($instance['iconbox_text_hover_color']) ?>" />
  </p>
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('iconbox_rotate') ?>">  <?php _e('Icon Rotate ',$lavan_plugin_name) ?> 
    </label>
    <input type="text" class="small-text" id="<?php echo $this->get_field_id('iconbox_rotate') ?>" name="<?php echo $this->get_field_name('iconbox_rotate') ?>" value="<?php echo esc_attr($instance['iconbox_rotate']) ?>" />
    <small>  <?php _e('deg',$lavan_plugin_name) ?>  </small> 
  </p>
  <p class="one_fifth_last">
    <label for="<?php echo $this->get_field_id('iconbox_icon_rotate_hover') ?>">  <?php _e('Icon Rotate On Hover ',
    $lavan_plugin_name) ?>  </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("iconbox_icon_rotate_hover"); ?>" name="<?php echo $this->get_field_name("iconbox_icon_rotate_hover"); ?>"<?php checked( (bool) $instance["iconbox_icon_rotate_hover"], true ); ?> />
  </p>
</div>
<div class="input-elements-wrapper">
  <p class="one_third">
    <label for="<?php echo $this->get_field_id('icon_container_enable') ?>">  <?php _e('Icon Container',$lavan_plugin_name) ?></label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("icon_container_enable"); ?>" name="<?php echo $this->get_field_name("icon_container_enable"); ?>"<?php checked( (bool) $instance["icon_container_enable"], true ); ?> />
  </p>
</div>
<div class="input-elements-wrapper icon_container_bg_section">
  <p class="one_fourth ">
    <label for="<?php echo $this->get_field_id('iconbox_container_size') ?>">  <?php _e('Icon Container Size',
    $lavan_plugin_name)?>  </label>
    <input type="text" class="small-text" id="<?php echo $this->get_field_id('iconbox_container_size') ?>" name="<?php echo $this->get_field_name('iconbox_container_size') ?>" value="<?php echo esc_attr($instance['iconbox_container_size']) ?>" />
    <small><?php _e('px'); ?></small><br> 
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('iconbox_bg_color') ?>">  <?php _e('Icon Container BG Color',
    $lavan_plugin_name) ?>  </label>
    <input type="text" class="widefat iconbox_color_pickr" id="<?php echo $this->get_field_id('iconbox_bg_color') ?>" name="<?php echo $this->get_field_name('iconbox_bg_color') ?>" value="<?php echo esc_attr($instance['iconbox_bg_color']) ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('iconbox_bg_hover_color') ?>">  <?php _e('Icon Container BG Hover Color ',
    $lavan_plugin_name) ?>  </label>
    <input type="text" class="widefat iconbox_color_pickr" id="<?php echo $this->get_field_id('iconbox_bg_hover_color') ?>" name="<?php echo $this->get_field_name('iconbox_bg_hover_color') ?>" value="<?php echo esc_attr($instance
    ['iconbox_bg_hover_color']) ?>" />
  </p>
  <p class="one_fourth_last  clearfix ">
    <label for="<?php echo $this->get_field_id('border_color') ?>">    <?php _e('Icon Container Border Color',
    $lavan_plugin_name) ?>  </label>
    <input type="text" class="widefat iconbox_color_pickr" id="<?php echo $this->get_field_id('border_color') ?>" name="<?php echo $this->get_field_name('border_color') ?>" value="<?php echo esc_attr($instance['border_color']) ?>" />
  </p>
</div>
<div class="input-elements-wrapper icon_container_bg_section"> 
  <p class="one_fourth ">
    <label for="<?php echo $this->get_field_id('border_hover_color') ?>">    <?php _e('Icon Container Border Hover Color',
    $lavan_plugin_name) ?>  </label>
    <input type="text" class="widefat iconbox_color_pickr" id="<?php echo $this->get_field_id('border_hover_color') ?>" name="<?php echo $this->get_field_name('border_hover_color') ?>" value="<?php echo esc_attr($instance['border_hover_color']) ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('border_radius') ?>">  <?php _e('Icon Container Border Radius',
    $lavan_plugin_name) ?>  </label>
    <input type="text" class="small-text" id="<?php echo $this->get_field_id('border_radius') ?>" name="<?php echo $this->get_field_name('border_radius') ?>" value="<?php echo esc_attr($instance['border_radius']) ?>" />
    <small>  <?php _e('px',$lavan_plugin_name) ?>  </small> 
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('enable_iconbox_scale') ?>">  <?php _e('Icon Background Scale',
    $lavan_plugin_name) ?>  </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("enable_iconbox_scale"); ?>" name="<?php echo 
    $this->get_field_name("enable_iconbox_scale"); ?>"<?php checked( (bool) $instance["enable_iconbox_scale"], true ); ?> />
  </p>
</div>
<div class="input-elements-wrapper">  
  <p class="one_fourth img_radio_select icon_alignment">
    <label for="<?php echo $this->get_field_id('iconbox_align') ?>">  <?php _e('Icon Position',$lavan_plugin_name)  ?> 
    </label>
    <label>
    <input type="radio" id="<?php echo $this->get_field_id( 'iconbox_align' ); ?>" name="<?php echo $this->get_field_name
    ( 'iconbox_align' ); ?>" value="center" <?php checked( $instance['iconbox_align'], 'center' ); ?>> 
    <img alt="Align Center" title="Align Center" src="<?php echo constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'images/align_center.png' ?>">
    </label>
    <label>
    <input type="radio" id="<?php echo $this->get_field_id( 'iconbox_align' ); ?>" name="<?php echo $this->get_field_name
    ( 'iconbox_align' ); ?>" value="left" <?php checked( $instance['iconbox_align'], 'left' ); ?>> <img alt="Align Left" title="Align Left" src="<?php echo constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'images/align_left.png' ?>">
    </label>
    <label> 
    <input type="radio" id="<?php echo $this->get_field_id( 'iconbox_align' ); ?>" name="<?php echo $this->get_field_name
    ( 'iconbox_align' ); ?>" value="right" <?php checked( $instance['iconbox_align'], 'right' ); ?>>  <img alt="Align Right" title="Align Right"  src="<?php echo constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'images/align_right.png' ?>">
    </label>
    <label> 
    <input type="radio" id="<?php echo $this->get_field_id( 'iconbox_align' ); ?>" name="<?php echo $this->get_field_name
    ( 'iconbox_align' ); ?>" value="none" <?php checked( $instance['iconbox_align'], 'none' ); ?>>  <img alt="Align Right" title="Align None"  src="<?php echo constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'images/align_none.png' ?>">
    </label>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('text_wrap') ?>">  <?php _e('Text Wrapping',$lavan_plugin_name) ?>  </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("text_wrap"); ?>" name="<?php echo $this->get_field_name("text_wrap"); ?>"<?php checked( (bool) $instance["text_wrap"], true ); ?> />
  </p>

  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('iconbox_link_disable') ?>">  <?php _e('Icon Link Disable',
    $lavan_plugin_name) ?>  </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("iconbox_link_disable"); ?>" name="
    <?php echo $this->get_field_name("iconbox_link_disable"); ?>"<?php checked( (bool) $instance["iconbox_link_disable"], true ); ?> />
  </p>
</div>
<div class="input-elements-wrapper fields_bottom_border">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('title') ?>">  <?php _e('Title',$lavan_plugin_name) ?>  </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo esc_attr($instance['title']) ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('title_font_size') ?>">  <?php _e('Title Font Size',$lavan_plugin_name) ?> 
    </label>
    <input type="text" class="small-text" id="<?php echo $this->get_field_id('title_font_size') ?>" name="<?php echo $this->get_field_name('title_font_size') ?>" value="<?php echo esc_attr($instance['title_font_size']) ?>" />
    <small>  <?php _e('px',$lavan_plugin_name) ?>  </small> 
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('title_letter_space') ?>">  <?php _e('Title Letter Space',$lavan_plugin_name) 
    ?></label>
    <input type="text" class="small-text" id="<?php echo $this->get_field_id('title_letter_space') ?>" name="<?php echo $this->get_field_name('title_letter_space') ?>" value="<?php echo esc_attr($instance['title_letter_space']) ?>" />
    <small>  <?php _e('px',$lavan_plugin_name) ?>  </small> 
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('title_font_style') ?>"> <?php _e('Title Font Style',$lavan_plugin_name) ?>
    </label>
    <select id="<?php echo $this->get_field_id('title_font_style') ?>" name="<?php echo $this->get_field_name
      ('title_font_style') ?>">
      <option value="normal" <?php selected('normal', $instance['title_font_style']) ?>> <?php _e('Normal', $lavan_plugin_name) ?>   </option>
      <option value="italic" <?php selected('italic', $instance['title_font_style']) ?>>  <?php _e('Italic',$lavan_plugin_name) ?></option>
    </select>
  </p>
</div>
<div class="input-elements-wrapper">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('title_font_weight') ?>"> <?php _e('Title Font Weight',$lavan_plugin_name) ?>
    </label>
    <select id="<?php echo $this->get_field_id('title_font_weight') ?>" name="<?php echo $this->get_field_name
      ('title_font_weight') ?>">
      <option value="normal" <?php selected('normal', $instance['title_font_weight']) ?>> <?php _e('Normal', 
      $lavan_plugin_name) ?>   </option>
      <option value="bold" <?php selected('bold', $instance['title_font_weight']) ?>>  <?php _e('Bold',$lavan_plugin_name) ?>
      </option>
    </select>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('title_color') ?>">  <?php _e('Title Color',$lavan_plugin_name) ?>  </label>
    <input type="text" class="widefat iconbox_color_pickr" id="<?php echo $this->get_field_id('title_color') ?>" name="<?php echo $this->get_field_name('title_color') ?>" value="<?php echo esc_attr($instance['title_color']) ?>" />
  </p>
</div>
<div class="input-elements-wrapper">  
  <p class="two_fourth">
    <label for="<?php echo $this->get_field_id('description') ?>">  <?php  _e('Description' ,$lavan_plugin_name); ?>  </label>
    <textarea type="text" class="widefat" name="<?php echo $this->get_field_name('description') ?>" id="<?php echo $this->get_field_id('description') ?>" ><?php echo esc_attr($instance['description']) ?></textarea>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('description_font_size') ?>">  <?php _e('Description Font Size',
    $lavan_plugin_name) ?>  </label>
    <input type="text" class="small-text" id="<?php echo $this->get_field_id('description_font_size') ?>" name="<?php echo 
    $this->get_field_name('description_font_size') ?>" value="<?php echo esc_attr($instance['description_font_size']) ?>" />
    <small>  <?php _e('px',$lavan_plugin_name) ?>  </small> 
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('description_letter_space') ?>">  <?php _e('Description Letter Space',
    $lavan_plugin_name) ?>  </label>
    <input type="text" class="small-text" id="<?php echo $this->get_field_id('description_letter_space') ?>" name="<?php echo $this->get_field_name('description_letter_space') ?>" value="<?php echo esc_attr($instance['description_letter_space']) ?>" />
    <small>  <?php _e('px',$lavan_plugin_name) ?>  </small> 
  </p>
</div>
<div class="input-elements-wrapper"> 
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('description_font_style') ?>"> <?php _e('Description Font Style',
    $lavan_plugin_name) ?></label>
    <select id="<?php echo $this->get_field_id('description_font_style') ?>" name="<?php echo $this->get_field_name
      ('description_font_style') ?>">
      <option value="normal" <?php selected('normal', $instance['description_font_style']) ?>> <?php _e('Normal', 
      $lavan_plugin_name) ?>   </option>
      <option value="italic" <?php selected('italic', $instance['description_font_style']) ?>>  <?php _e('Italic',
      $lavan_plugin_name) ?></option>
    </select>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('description_font_weight') ?>"> <?php _e('Description Font Weight',
    $lavan_plugin_name) ?></label>
    <select id="<?php echo $this->get_field_id('description_font_weight') ?>" name="<?php echo $this->get_field_name('description_font_weight') ?>">
    <option value="normal" <?php selected('normal', $instance['description_font_weight']) ?>> <?php _e('Normal', 
    $lavan_plugin_name) ?>   </option>
    <option value="bold" <?php selected('bold', $instance['description_font_weight']) ?>>  <?php _e('Bold',
    $lavan_plugin_name) ?></option>
    </select>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('description_color') ?>">  <?php _e('Description Color',$lavan_plugin_name) ?> 
    </label>
    <input type="text"  class="widefat iconbox_color_pickr" id="<?php echo $this->get_field_id('description_color') ?>" name="<?php echo $this->get_field_name('description_color') ?>" value="<?php echo esc_attr($instance['description_color']) ?>" />
  </p>
</div>
<div class="input-elements-wrapper fields_bottom_border">  
  <p class="two_fourth">
    <label for="<?php echo $this->get_field_id('readmore_text') ?>">  <?php _e('Readmore Button Text',$lavan_plugin_name) ?>  
    </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('readmore_text') ?>" name="<?php echo $this->get_field_name('readmore_text') ?>" value="<?php echo esc_attr($instance['readmore_text']) ?>" />
    <small>  <?php _e('<stong>Note: </strong>Keep it empty to not display the readmore button ',$lavan_plugin_name) ?></small>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('link') ?>">  <?php _e('Link',$lavan_plugin_name) ?>  </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('link') ?>" name="<?php echo $this->get_field_name
    ('link') ?>" value="<?php echo esc_attr($instance['link']) ?>" />
    <small>  <?php _e('Ex:http://www.google.com',$lavan_plugin_name) ?>  </small> 
  </p>
  <p class="one_fourth_last clearfix">
    <label for="<?php echo $this->get_field_id('new_window') ?>">  <?php _e('Open in new window',$lavan_plugin_name) ?> 
    </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("new_window"); ?>" name="<?php echo $this->get_field_name("new_window"); ?>"<?php checked( (bool) $instance["new_window"], true ); ?> />
  </p>
</div>
  <div class="input-elements-wrapper"> 
  <p>
    <label for="<?php echo $this->get_field_id('animation_names') ?>">  <?php _e('Select Animation Effect',
    $lavan_plugin_name) ?>  </label>
    <?php animation_effects($this->get_field_name('animation_names'), $instance['animation_names'] ); ?>
  </p>
  </div>
<?php
  }
}
 lavan_kaya_register_widgets('iconbox-widget', __FILE__);
?>