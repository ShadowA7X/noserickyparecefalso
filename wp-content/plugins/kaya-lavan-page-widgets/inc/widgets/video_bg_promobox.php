<?php
// Promobox widget
 class Lavan_Promobox_Widget extends WP_Widget{
  public function __construct(){
  global $lavan_plugin_name;  
   parent::__construct(  'kaya-promobox',
      ucfirst($lavan_plugin_name).' '.__(' - Video BG Promobox (PB)',$lavan_plugin_name).'&nbsp;<a class="widget_video_tutorials" target="_blank" href="https://youtu.be/CblUg2D5r_M">'.__('Watch this video', $lavan_plugin_name).'</a>',   
      array( 'description' => __('Displays Promobox with image & video as a background', $lavan_plugin_name) ,'class' => 'kaya_title' )
    );
   }

       public function widget( $args , $instance ){
        echo $args['before_widget'];
        global $lavan_plugin_name;
        $instance = wp_parse_args($instance, array( 
            'kaya_promobox_desc' => '',
            'promobox_text_color' => '#333333',
            'promobox_readmore' => '',
            'promobox_readmore_link' => '',
            'promobox_video_height' => '400',
            'promobox_video_display' => __('hide',$lavan_plugin_name),
            'promobox_video_mp4' => '',
            'promobox_video_ogv' => '',
            'promobox_video_webm' => '',
            'promobox_video_jpg' => '',
            'promobox_bg_color' => '#f9f9f9',
            'readmore_text_color' => '#333333',
            'readmore_bg_color' => '#323232',
            'animation_names' => '',

          )); 

        $height = ceil( $instance['promobox_video_height'] - 80 );

        $video_bg = 'promobox-video'; 

         $video_rand = rand(1,100); ?>
<style type="text/css">
        .promobox_content h2, .promobox_content h3, .promobox_content h4,.promobox_content h5,.promobox_content h6{
          color:<?php echo $instance['promobox_text_color']; ?>!important;
          margin:0;
        }
        .promobox_video_bg{
          height: <?php echo $height; ?>px;
          position: relative;
         } 
         .widget_kaya-promobox {
          background-color:<?php echo $instance['promobox_bg_color'] ?>;
         }  
         .promobox_content a.readmore:hover{
          background-color:<?php echo $instance['readmore_text_color'] ?>!important;
          color:<?php echo $instance['readmore_bg_color'] ?>!important;
         }
         .widget_kaya-promobox{
            height:<?php echo $instance['promobox_video_height']; ?>px!important;
         }
         .promobox_video{
          height: 100%!important;
         }
    <?php if( $instance['promobox_bg_color'] ): ?>
          .videoBG {         
            opacity: .4!important;         
        }
         <?php endif; ?>

      </style>
<script type="text/javascript">

  jQuery("document").ready(function(){

  jQuery('.widget_kaya-promobox').parent().parent().addClass('promobox_video_bg').css({"height":"<?php echo $instance['promobox_video_height']; ?>px",'position':'relative'});

  jQuery('.promobox_wrapper<?php echo $video_rand ; ?>').videoBG({

  mp4:"<?php echo $instance['promobox_video_mp4']; ?>",

  ogv:"<?php echo $instance['promobox_video_ogv']; ?>",

  webm:"<?php echo $instance['promobox_video_webm']; ?>",

  poster:"<?php echo $instance['promobox_video_jpg']; ?>",

  scale:true,

  zIndex:0

  }); 

  });

</script>
<div class="promobox_wrapper  promobox_wrapper<?php echo $video_rand ; ?> wow <?php echo $instance['animation_names']; ?>" data-height="400">
  <div class="promobox_content container" > <?php echo  $instance['kaya_promobox_desc']; ?>
    <?php if( $instance['promobox_readmore'] ): ?>
    <a href="<?php echo $instance['promobox_readmore_link'] ?>" class="readmore" style="color:<?php echo $instance['readmore_text_color']; ?>; background-color:<?php echo $instance['readmore_bg_color']; ?>;"><?php echo $instance['promobox_readmore'] ?></a>
    <?php endif; ?>
  </div>
</div>
<?php    
echo $args['after_widget'];
      }

  public function form( $instance ){
  global $lavan_plugin_name;  
        $video_rand = rand(1,100);
        $instance = wp_parse_args( $instance, array(

            'kaya_promobox_desc' => '<h4>Dynamic Development</h4>

                                    <h2>CHANGE YOUR FUTURE BE SUCESSFULL!</h2>

                                    <h3>Websites Which Bring Business for You</h3>',
            'promobox_text_color' => '#333333',
            'promobox_readmore' => '',
            'promobox_readmore_link' => '',
            'promobox_video_height' => '400',
            'promobox_video_display' => __('hide',$lavan_plugin_name),
            'promobox_video_mp4' => '',
            'promobox_video_ogv' => '',
            'promobox_video_webm' => '',
            'promobox_video_jpg' => '',
            'promobox_bg_color' => '#f9f9f9',
            'readmore_text_color' => '#ffffff',
            'readmore_bg_color' => '#323232',
            'animation_names' => '',

            ));
            ?>
<script type="text/javascript">
  (function($){
    "use strict";
  $('.video_bg_color_picker').each(function(){
  $(this).wpColorPicker();  
  });  
  })(jQuery);
</script>

<div class="input-elements-wrapper">            
  <p>
    <label for="<?php echo $this->get_field_id('kaya_promobox_desc'); ?>">
    <?php _e('Promobox Content',$lavan_plugin_name) ?>
    </label>
    <textarea type="text" name="<?php echo $this->get_field_name('kaya_promobox_desc') ?>" id="<?php echo $this->get_field_id
    ('kaya_promobox_desc') ?>" class="widefat" value="<?php echo $instance['kaya_promobox_desc'] ?>" ><?php echo $instance
    ['kaya_promobox_desc'] ?></textarea>
  </p>
</div>
<div class="input-elements-wrapper">  
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('promobox_text_color'); ?>">
    <?php _e('Promobox Content Color',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('promobox_text_color') ?>" id="<?php echo $this->get_field_id
    ('promobox_text_color') ?>" class="video_bg_color_picker" value="<?php echo $instance['promobox_text_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('promobox_bg_color'); ?>">
    <?php _e('Promobox Background Color',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('promobox_bg_color') ?>" id="<?php echo $this->get_field_id
    ('promobox_bg_color') ?>" class="video_bg_color_picker" value="<?php echo $instance['promobox_bg_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('promobox_video_height'); ?>">
    <?php _e('Video Height',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('promobox_video_height') ?>" id="<?php echo $this->get_field_id
    ('promobox_video_height') ?>" class="small-text" value="<?php echo $instance['promobox_video_height'] ?>" />
    <small><?php _e('px',$lavan_plugin_name); ?></small>
  </p>
</div>
<div class="input-elements-wrapper">  
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('promobox_readmore'); ?>">
    <?php _e('Readmore Button Text',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('promobox_readmore') ?>" id="<?php echo $this->get_field_id
    ('promobox_readmore') ?>" class="widefat" value="<?php echo $instance['promobox_readmore'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('promobox_readmore_link'); ?>">
    <?php _e('Readmore Button Link',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('promobox_readmore_link') ?>" id="<?php echo $this->get_field_id('promobox_readmore_link') ?>" class="widefat" value="<?php echo $instance['promobox_readmore_link'] ?>" 
    />
    <small>
    <?php _e('Ex: http://www.google.com',$lavan_plugin_name); ?>
    </small>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('readmore_bg_color'); ?>">
    <?php _e('Readmore Button Background Color',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('readmore_bg_color') ?>" id="<?php echo $this->get_field_id
    ('readmore_bg_color') ?>" class="video_bg_color_picker" value="<?php echo $instance['readmore_bg_color'] ?>" />
  </p>
  <p class="one_fourth_last">
    <label for="<?php echo $this->get_field_id('readmore_text_color'); ?>">
    <?php _e('Readmore Button Text Color',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('readmore_text_color') ?>" id="<?php echo $this->get_field_id
    ('readmore_text_color') ?>" class="video_bg_color_picker" value="<?php echo $instance['readmore_text_color'] ?>" />
  </p>
</div>
<div class="input-elements-wrapper">
<p>
  <!-- Video -->
  <label for="<?php echo $this->get_field_id('promobox_video_mp4'); ?>">
  <?php _e('MP4 Video Url',$lavan_plugin_name) ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('promobox_video_mp4') ?>" id="<?php echo $this->get_field_id
  ('promobox_video_mp4') ?>" class="widefat promo_video_bg<?php echo $this->get_field_id('promobox_video_mp4'); ?>" value="<?php echo $instance['promobox_video_mp4'] ?>" />
  <small>
  <?php _e('Ex: http://clips.vorwaerts-gmbh.de/big_buck_bunny.mp4',$lavan_plugin_name); ?>
  </small> 
</p>
</div>
<div class="input-elements-wrapper">
<p>
  <!-- Video -->
  <label for="<?php echo $this->get_field_id('promobox_video_ogv'); ?>">
  <?php _e('ogv Video Url',$lavan_plugin_name) ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('promobox_video_ogv') ?>" id="<?php echo $this->get_field_id('promobox_video_ogv') ?>" class="widefat promo_video_bg<?php echo $this->get_field_id('promobox_video_mp4'); ?>" value="<?php echo $instance['promobox_video_ogv'] ?>" />
  <small>
  <?php _e('Ex: http://clips.vorwaerts-gmbh.de/big_buck_bunny.ogv',$lavan_plugin_name); ?>
  </small> 
</p>
</div>
<div class="input-elements-wrapper">
<p>
  <!-- Video -->
  <label for="<?php echo $this->get_field_id('promobox_video_webm'); ?>">
  <?php _e('webm Video Url',$lavan_plugin_name) ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('promobox_video_webm') ?>" id="<?php echo $this->get_field_id('promobox_video_webm') ?>" class="widefat promo_video_bg<?php echo $this->get_field_id('promobox_video_mp4'); ?>" value="<?php echo $instance['promobox_video_webm'] ?>" />
  <small>
  <?php _e('Ex: http://clips.vorwaerts-gmbh.de/big_buck_bunny.webm',$lavan_plugin_name); ?>
  </small> 
</p>
</div>
<div class="input-elements-wrapper">
<p>
  <!-- Video -->
  <label for="<?php echo $this->get_field_id('promobox_video_jpg'); ?>">
  <?php _e('jpg Image Url',$lavan_plugin_name) ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('promobox_video_jpg') ?>" id="<?php echo $this->get_field_id('promobox_video_jpg') ?>" class="widefat promo_video_bg<?php echo $this->get_field_id('promobox_video_jpg'); ?>" value="<?php echo $instance['promobox_video_jpg'] ?>" />
  <small>
  <?php _e('Ex: http://v4e.thewikies.com/images/big-buck-bunny_poster.jpg',$lavan_plugin_name); ?>
  </small> 
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
 lavan_kaya_register_widgets('promobox-widget',__FILE__);
?>