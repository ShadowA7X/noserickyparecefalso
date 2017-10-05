<?php
// List style

 class Lavan_Custom_List_Box_Widget extends WP_Widget{
   public function __construct(){
   global $lavan_plugin_name; 
   parent::__construct(  'kaya-list-box',
      __('Lavan-List Box (PB)',$lavan_plugin_name),
      array( 'description' => __('add list items with custom icon',$lavan_plugin_name), 'class' => 'kaya_list_box_widget' )
    );
    }

    public function widget( $args , $instance ){
    global $lavan_plugin_name;  
        $instance = wp_parse_args($instance, array(
         
        'title' => '',
        'title_color' => '',
        'list_box' => '<ul>
                          <li>List Item - 1</li>
                          <li>List Item - 2 </li>
                          <li> List Items - 3</li>
                          </ul>',
        'text_align' => '',
        "image_size" => __("full", $lavan_plugin_name),
        "image_id" => "",
        "image_uri" => '',
        'animation_names' => '',

      )); 

        $rand = rand(1,100);
        if( $instance['image_uri'] ){  ?>
        <style>
          .custom_list_box-<?php echo $rand ?> ul li {
            background-image:url('<?php echo kaya_image_resize( $instance['image_uri'], 16, 16, true ); ?>');
            background-repeat:no-repeat;
             background-position: left 4px;
            background-repeat: no-repeat;
            list-style: none outside none;
            padding: 0 0 10px 28px !important; 
            margin-left: 0;
            }
        </style>
        <?php } else{ ?>
        <style type="text/css">
        .custom_list_box-<?php echo $rand ?> ul li {
            list-style: none outside none;
            padding: 0 0 10px 0px !important; 
           }
        </style>  
        <?php    } ?>
    <?php echo $args['before_widget'];
    echo '<div class="wow '.$instance['animation_names'].' ">';
               //echo '<div class= "cbp-so-section">';
             if( $instance['title'] ):
             if( $instance['text_align'] =='left'){ $plus_icon = 'right';}elseif( $instance['text_align'] =='right'){ $plus_icon = 'left';}else{ $plus_icon='right'; $plus_icon_left ="left"; }

echo '<div class="custom_title kaya_title_'.$instance['text_align'].'">';
echo  '<h3 style="text-align:'.$instance['text_align'].'; color:'.$instance['title_color'].'!important;">'.$instance
['title'].'</h3>';

if( $instance['text_align'] =='center'){ 

echo '<i class="fa fa-plus" style="float: '.$plus_icon_left.'; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;">
</i>';

}
echo '<i class="fa fa-plus" style="float: '.$plus_icon.'; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i>';
echo '</div>';
      ?>
<div class="clear"> </div>
<?php endif; 

echo '<div class="custom_list_box custom_list_box-'.$rand.'">';
 echo $instance['list_box'];
echo '</div></div>';

         echo $args['after_widget'];
    }

    public function form( $instance ){
    global $lavan_plugin_name;  
        $instance = wp_parse_args( $instance, array(

        'title' => '',
        'title_color' => '',
        'list_box' => '<ul>
                          <li>List Item - 1</li>
                          <li>List Item - 2 </li>
                          <li> List Items - 3</li>
                          </ul>',
        'text_align' => '',
        "image_size" => __("full", $lavan_plugin_name),
        "image_id" => "",
        "image_uri" => '',
        'animation_names' => '',

        ) );

        ?>
<script type="text/javascript">
(function($){
  "use strict";
  $('.list_box_color_picker').each(function(){
  $(this).wpColorPicker();
  });
})(jQuery);
</script>
        
<div class="input-elements-wrapper">        
  <p>
    <?php $i = rand(1,100); ?>
    <img class="custom_media_image_<?php echo $i; ?>" src="<?php if(!empty($instance['image_uri'])){echo $instance['image_uri'];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
    <input type="text" class="widefat custom_media_url_<?php echo $i; ?>" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $instance['image_uri']; ?>">
    <input type="button" value="<?php _e( 'Upload Icon', $lavan_plugin_name ); ?>" class="button custom_media_upload_<?php echo $i; ?>" id="custom_media_upload_<?php echo $i; ?>"/>
    <script type="text/javascript">
      jQuery(document).ready( function(){
      jQuery('.custom_media_upload_<?php echo $i; ?>').click(function(e) {
      e.preventDefault();
      var custom_uploader = wp.media({
      title: 'Image Uploading',
      button: {
      text: 'Upload List Image'
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
    <small>
    <?php _e('Note: Use 16x16 size icons only',$lavan_plugin_name); ?>
    </small>
  </p>
</div>
<div class="input-elements-wrapper">    
  <p class="one_fourth">
    <lable for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e('Title',$lavan_plugin_name); ?>
    </label>
    <input type="text" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo esc_attr($instance
    ['title']) ?>" name="<?php echo $this->get_field_name('title') ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('title_color'); ?>">
    <?php _e('Title Color',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id
    ('title_color') ?>" class="list_box_color_picker" value="<?php echo $instance['title_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('text_align') ?>">
    <?php _e('Title Position',$lavan_plugin_name)?>
    </label>
    <select id="<?php echo $this->get_field_id('text_align') ?>" name="<?php echo $this->get_field_name('text_align') ?>">
      <option value="left" <?php selected('left', $instance['text_align']) ?>>
      <?php _e(' Left', $lavan_plugin_name) ?>
      </option>
      <option value="right" <?php selected('right', $instance['text_align']) ?>>
      <?php _e(' Right', $lavan_plugin_name) ?>
      </option>
      <option value="center" <?php selected('center', $instance['text_align']) ?>>
      <?php _e(' Center', $lavan_plugin_name) ?>
      </option>
    </select>
  </p>
</div>
<div class="input-elements-wrapper">      
  <p>
    <label for="<?php echo $this->get_field_id('list_box') ?>">
    <?php _e('List Box',$lavan_plugin_name)?>
    </label>
    <textarea type="text" id="<?php echo $this->get_field_id('list_box') ?>" class="widefat" name="<?php echo $this->get_field_name('list_box') ?>" value = "<?php echo $instance['list_box'] ?>" > <?php echo $instance['list_box'] ?>
    </textarea>
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
<?php  }
 }
 lavan_kaya_register_widgets('custom-list-box-widget',__FILE__);
?>