<?php
class Lavan_Imageboxes_Widget extends WP_Widget{
   function __construct(){
   global $lavan_plugin_name; 
     parent::__construct( 'kaya-image-boxes',
        __('Lavan-Image Box (PB)',$lavan_plugin_name),
       array('description' => __('Displays image box with title and description',$lavan_plugin_name)  )
      );
   }
   function widget( $args, $instance ){
   global $lavan_plugin_name; 
      $instance = wp_parse_args($instance,array(
        'title' => __('Enter Title Here',$lavan_plugin_name),
        'title_font_size' => '',
        'link' => '',
        'description' => __('Enter Description Here',$lavan_plugin_name),
        "image_uri" => '',
        'description_color' => '#757575',
        'title_color' => '#ffffff',
        'border_color' => '#6E6E6E',
        'imagebox_align' => '',
        'image_width' => '100',
        'image_height' => '100',
        'readmore_text' => __('Readmore', $lavan_plugin_name),
        'animation_names' => '',

        ));

        echo $args['before_widget'];

           echo "<div class='image-boxes wow ".$instance['animation_names']."'>";  ?>
        <div class="figure  align<?php echo $instance['imagebox_align']; ?>">
          <?php 
           $default_img_url = constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'images/portfolio_default_img.jpg';
              if( $instance['image_uri'] ){
                echo '<img src="'.kaya_image_resize( $instance['image_uri'], $instance['image_width'], $instance['image_height'], true ).'" class="" alt="'.$instance['title'].'"  />';
               }else{
                  if (is_multisite()){
                     $image_url = $default_img_url;
                  }else{                  
                    $image_url = kaya_image_resize( $default_img_url, $instance['image_width'],  $instance['image_height'], 't' );
                  }
                  echo '<img src="'.$image_url.'" class="" alt="'.$instance['title'].'"  />';
               } 
             ?>
</div>
<?php  echo '<div class="description" style="text-align:'.$instance['imagebox_align'].'">';

           if( $instance['title'] ): echo '<h3 style="color:'.$instance['title_color'].'; font-size:'.$instance['title_font_size'].'px">'; if( $instance['link'] ){ echo '<a style="color:'.$instance['title_color'].'" href="'.$instance['link'].'">'; }
                 echo $instance['title']; 
             if( $instance['link'] ){ echo '</a>'; } echo '</h3>'; endif;
            if( $instance['description'] ):  echo '<p style="color:'.$instance['description_color'].'">'.$instance['description'].'</p>'; endif;
           if( $instance['readmore_text'] ): echo '<a href="'.esc_url($instance['link']).'" class="readmore readmore-1">'.esc_attr($instance['readmore_text']).'</a>'; endif; 

           echo '</div>'; 

           echo "</div>";           

        echo $args['after_widget'];
    }

    function form( $instance ){
    global $lavan_plugin_name;  
      $instance = wp_parse_args($instance, array(        
        'title' => __('Enter Title Here',$lavan_plugin_name),
        'title_font_size' => '',
        'link' => '',
        'description' => __('Enter Description Here',$lavan_plugin_name),
        "image_uri" => '',
        'description_color' => '#757575',
        'title_color' => '#ffffff',
        'border_color' => '#6E6E6E',
        'imagebox_align' => '',
        'image_width' => '100',
        'image_height' => '100',
        'readmore_text' => __('Readmore', $lavan_plugin_name),
        'animation_names' => '',

        ));
        ?>
<script type="text/javascript">
(function($){
  "use strict";
$('.image_box_color_picker').each(function(){
$(this).wpColorPicker();  
});
})(jQuery);
</script>

<div class="input-elements-wrapper">        
  <p><?php $i = rand(1,100); ?>
    <img class="custom_media_image_<?php echo $i; ?>" src="<?php if(!empty($instance['image_uri'])){echo $instance
    ['image_uri'];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
    <input type="text" class="widefat custom_media_url_<?php echo $i; ?>" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $instance['image_uri']; ?>">
    <input type="button" value="<?php _e( 'Upload Image', $lavan_plugin_name ); ?>" class="button custom_media_upload_<?php echo $i; ?>" id="custom_media_upload_<?php echo $i; ?>"/>
    <script type="text/javascript">
      jQuery(document).ready( function(){
      jQuery('.custom_media_upload_<?php echo $i; ?>').click(function(e) {
      e.preventDefault();
      var custom_uploader = wp.media({
      title: 'Image Box Uploading',
      button: {
      text: 'Upload Image'
      },
      multiple: false  // Set this to true to allow multiple files to be selected
      })
      .on('select', function() {
      var attachment = custom_uploader.state().get('selection').first().toJSON();
      jQuery('.custom_media_image_<?php echo $i; ?>').attr('src', attachment.url);
      jQuery('.custom_media_url_<?php echo $i; ?>').val(attachment.url);
      })
      .open();
      });
      });
    </script>
  </p>
</div>
<div class="input-elements-wrapper">   
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('image_width') ?>">
    <?php _e('Image Width',$lavan_plugin_name)?>
    </label>
    <input type="text" class="small-text" id="<?php echo $this->get_field_id('image_width') ?>" value="<?php echo esc_attr($instance['image_width']) ?>" name="<?php echo $this->get_field_name('image_width') ?>" />
    <small><?php _e('px',$lavan_plugin_name); ?></small>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('image_height') ?>">
    <?php _e('Image Height',$lavan_plugin_name)?>
    </label>
    <input type="text" class="small-text" id="<?php echo $this->get_field_id('image_height') ?>" value="<?php echo esc_attr($instance['image_height']) ?>" name="<?php echo $this->get_field_name('image_height') ?>" />
    <small><?php _e('px',$lavan_plugin_name); ?></small>
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('imagebox_align') ?>">
    <?php _e('Image Position',$lavan_plugin_name)?>
    </label>
    <select id="<?php echo $this->get_field_id('imagebox_align') ?>" name="<?php echo $this->get_field_name
      ('imagebox_align') ?>">
      <option value="left" <?php selected('left', $instance['imagebox_align']) ?>>
      <?php _e('Position Left', $lavan_plugin_name) ?>
      </option>
      <option value="right" <?php selected('right', $instance['imagebox_align']) ?>>
      <?php _e('Position Right', $lavan_plugin_name) ?>
      </option>
      <option value="center" <?php selected('center', $instance['imagebox_align']) ?>>
      <?php _e('Position Center', $lavan_plugin_name) ?>
      </option>
    </select>
  </p>
</div>
<div class="input-elements-wrapper"> 
<p class="one_fourth">
  <lable for="<?php echo $this->get_field_id('title'); ?>">
  <?php _e('Title',$lavan_plugin_name); ?>
  </label>
  <input type="text" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']) ?>" name="<?php echo $this->get_field_name('title') ?>" />
</p>
<p class="one_fourth">
  <label for="<?php echo $this->get_field_id('title_color') ?>">
  <?php _e('Title Color',$lavan_plugin_name)?>
  </label>
  <input type="text" class="image_box_color_picker" id="<?php echo $this->get_field_id('title_color') ?>" value="<?php echo esc_attr($instance['title_color']) ?>" name="<?php echo $this->get_field_name('title_color') ?>" />
</p>
<p class="one_fourth">
    <label for="<?php echo $this->get_field_id('title_font_size') ?>">  <?php _e('Title Font Size',$lavan_plugin_name) ?> 
    </label>
    <input type="text" class="small-text" id="<?php echo $this->get_field_id('title_font_size') ?>" name="<?php echo $this->get_field_name('title_font_size') ?>" value="<?php echo esc_attr($instance['title_font_size']) ?>" />
    <small>  <?php _e('px',$lavan_plugin_name) ?>  </small> 
  </p>
</div>
<div class="input-elements-wrapper"> 
  <p class="two_third">
    <label for="<?php echo $this->get_field_id('description') ?>">
    <?php _e('Description',$lavan_plugin_name)?>
    </label>
    <textarea cols="10" class="widefat" id="<?php echo $this->get_field_id('description') ?>" value="<?php echo esc_attr($instance['description']) ?>" name="<?php echo $this->get_field_name('description') ?>" ><?php echo esc_attr($instance
     ['description']) ?>
    </textarea>
  </p>
  <p class="one_third_last">
    <label for="<?php echo $this->get_field_id('description_color') ?>">
    <?php _e('Description Color',$lavan_plugin_name)?>
    </label>
    <input type="text" class="image_box_color_picker" id="<?php echo $this->get_field_id('description_color') ?>" value=
    "<?php echo esc_attr($instance['description_color']) ?>" name="<?php echo $this->get_field_name('description_color') ?>" />
  </p>
</div>
<div class="input-elements-wrapper"> 
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('readmore_text') ?>"> <?php _e('Readmore Button Text',$lavan_plugin_name) ?></label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('readmore_text') ?>" name="<?php echo $this->get_field_name('readmore_text') ?>" value="<?php echo esc_attr($instance['readmore_text']) ?>" />
    <small>
    <?php _e('<stong>Note: </strong>Keep it empty to not display the readmore button ',$lavan_plugin_name) ?>
    </small> 
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('link') ?>"> <?php _e('Destination URL',$lavan_plugin_name) ?>    </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('link') ?>" value="<?php echo esc_attr($instance['link']) ?>" name="<?php echo $this->get_field_name('link') ?>" />
    <small> <?php _e('Ex:http://www.google.com',$lavan_plugin_name) ?></small>
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
 lavan_kaya_register_widgets('imageboxes-widget',__FILE__);
?>