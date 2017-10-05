<?php
//kaya Slider

 class Lavan_Slider_Widget extends WP_Widget{
   public function __construct(){
   global $lavan_plugin_name; 
   parent::__construct(  'kaya-slider',
      __('Lavan-Slider (PB)',$lavan_plugin_name),
      array( 'description' => __('Displays slider from Kaya slider category', $lavan_plugin_name) ,'class' => 'kaya_slider' )
    );
   }

  public function widget( $args , $instance ){
      echo $args['before_widget'];
      global $lavan_plugin_name; 
        $instance = wp_parse_args($instance, array(
              'slide_effect' => __('slide', $lavan_plugin_name),
              'slide_caption' => '',
              'slider_easing' => __('swing', $lavan_plugin_name),
              'slider_height' =>'450',
              'slider_cat' => '',
              'slide_link' => '',
              'slider_pause_time' => '4000',
              'adaptive_height' => __('false', $lavan_plugin_name),
              'slide_auto_play' => __('true', $lavan_plugin_name),
              'slider_width' => '1100',
              'animation_names' => '',
         ) );       

    $slide_random = rand(1,50);  ?>

<script type="text/javascript">  
  (function($) {
  "use strict";
  $(function() {
  $('.bxslider<?php echo $slide_random; ?>').bxSlider({
  useCSS: false,
  pause : <?php echo $instance['slider_pause_time'] ?>,
  easing : "<?php echo $instance['slider_easing'] ?>",
  speed: 1500,
  mode:"<?php echo $instance['slide_effect'] ?>",
  auto : <?php echo $instance['slide_auto_play']; ?>,
  adaptiveHeight : <?php echo $instance['adaptive_height']; ?>
  });
  });
  })(jQuery);
</script>
<?php
echo '<div class="wow '.$instance['animation_names'].'">'; ?>
<div id="bx_slider_wrapper">
  <ul class="bxslider<?php echo $slide_random; ?>"  class="slider_wrap">
    <?php
    $array_val = ( !empty( $instance['slider_cat'] )) ? explode(',',  $instance['slider_cat']) : '';
    if( $array_val ) {
    $loop = new WP_Query(array( 'post_type' => 'slider',  'orderby' => 'menu_order', 'posts_per_page' =>10,'order' => 'DESC',  'tax_query' => array('relation' => 'AND', array( 'taxonomy' => 'slider_category',   'field' => 'id', 'terms' => $array_val  ), )));
    }else{
    $loop = new WP_Query(array('post_type' => 'slider', 'taxonomy' => 'slider_category','term' => $instance['slider_cat'], 'orderby' => 'menu_order', 'posts_per_page' =>10,'order' => 'DESC'));
    }
    if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <li>
      <?php
      global $post;

      $slider_link=get_post_meta(get_the_ID(),'customlink' ,true);
      $slider_imglink= $slider_link ? $slider_link: get_permalink($post->ID);
      $slide_text_color=get_post_meta($post->ID,'slide_text_color',true) ? get_post_meta($post->ID,'slide_text_color',true) : '#ffffff';
      $slider_target_link= get_post_meta($post->ID,'slider_target_link',true);
      $slide_description= get_post_meta($post->ID,'slide_description',true);
      $slider_imglink= $slider_link ? $slider_link: get_permalink($post->ID);
      $disable_slide_content = get_post_meta($post->ID,'disable_slide_content',true);
      if( $slider_target_link == '1' ){ $target_link_class='target=_blank';}else{ $target_link_class=""; }
      if($slider_link){
      echo '<a href="'.$slider_imglink.'" '.$target_link_class.' >';
      }
      global $post;
      $slider_img_width =  $instance['slider_width'] ? $instance['slider_width'] : '1160';       
      $img_url = wp_get_attachment_url( get_post_thumbnail_id() ); //get img URL
      if( $img_url ):
      $height = ( $instance['adaptive_height'] == 'true' ) ? '' : $instance['slider_height'];
      echo '<img src="'.kaya_image_resize( $img_url, $slider_img_width, $height, true ).'" class="" alt="'.get_the_title().'"  />';
      else:
      //echo '<img src="'.get_template_directory_uri().'/images/fluid_slider_default_img.jpg" style="width:'.$slider_img_width.'px; height:'.$instance['slider_height'].'px;" alt="'.get_the_title().'" >';
      $height = ( $instance['adaptive_height'] == 'true' ) ? '' : $instance['slider_height'];
      $img_url = constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'images/portfolio_default_img.jpg';
                echo '<img src="'.kaya_image_resize( $img_url, $slider_img_width, $height, true ).'" 
                alt="'.get_the_title().'" height="'.$height.'" width="'.$slider_img_width.'" />';
      endif;
      echo '</a>';
      if($disable_slide_content == "0") { ?>
      <div class="caption">
       <h4 style="color:<?php echo $slide_text_color; ?>"><?php echo the_title(); ?></h4>
      </div>
      <?php } ?>
      <?php endwhile; // End the loop. Whew. ?>
    </li>
    <?php else :
    echo '<li><img src="'.get_template_directory_uri().'/images/fluid_slider_default_img.jpg" width="100%" height='.$height.'  alt="'.get_the_title().'" ></li>';
    endif; ?>
  </ul>
</div>
</div>
    <?php wp_reset_query(); ?>
    <div class="clear"></div>
    <?php     
    echo  $args['after_widget'];
       }

public function form( $instance ){
global $lavan_plugin_name;   
        $kaya_terms=  get_terms('slider_category','');
     if( $kaya_terms ){   
      foreach ($kaya_terms as $kaya_term) { 
        $kaya_cats_name[] = $kaya_term->name.'- '. $kaya_term->term_id;
        $kaya_cats_id[] = $kaya_term->term_id;
      } $slider_items = implode(',', $kaya_cats_id); }else{ $kaya_cats_name[] = '';  $slider_items = '';}
        $instance = wp_parse_args( $instance, array(

              'slide_effect' => __('slide', $lavan_plugin_name),
              'slide_caption' => '',
              'slider_easing' => __('swing', $lavan_plugin_name),
              'slider_height' =>'450',
              'slider_cat' => $slider_items,
              'slide_link' => '',
              'slider_pause_time' => '4000',
              'adaptive_height' => __('false',$lavan_plugin_name),
              'slide_auto_play' => __('true',$lavan_plugin_name),
              'slider_width' => '1100',
              'animation_names' => '',
        ) );
        ?>
<div class="input-elements-wrapper">        
  <p>
    <label for="<?php echo $this->get_field_id('slider_cat') ?>">   <?php _e('Enter Kaya Slider Category IDs : ',
    $lavan_plugin_name) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('slider_cat') ?>" id="<?php echo $this->get_field_id('slider_cat') ?>" class="widefat" value="<?php echo $instance['slider_cat'] ?>" />
    <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',$lavan_plugin_name); ?> </strong> <?php echo implode(', ', $kaya_cats_name); ?></em><br />
    <stong><?php _e('Note:',$lavan_plugin_name); ?></strong><?php _e('Separate IDs with commas only',$lavan_plugin_name); ?>
  </p>
</div>
<div class="input-elements-wrapper">  
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slider_width') ?>">
    <?php _e('Slider Width',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('slider_width') ?>" id="<?php echo $this->get_field_id('slider_width') ?>" class="small-text" value="<?php echo $instance['slider_width'] ?>" />
    <small><?php _e('px',$lavan_plugin_name); ?></small>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slider_height') ?>">
    <?php _e('Slider Height',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('slider_height') ?>" id="<?php echo $this->get_field_id
    ('slider_height') ?>" class="small-text" value="<?php echo $instance['slider_height'] ?>" />
    <small><?php _e('px',$lavan_plugin_name); ?></small><br/>
    <small>
    <?php _e('Ex: 400<br /> Note: It works only when auto height is false',$lavan_plugin_name); ?>
    </small>
  </p>
</div>  
<div class="input-elements-wrapper">     
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slide_effect') ?>">
    <?php _e('Slide Transition Effect',$lavan_plugin_name) ?>
    </label>
    <select id="<?php echo $this->get_field_id('slide_effect') ?>" name="<?php echo $this->get_field_name('slide_effect') 
      ?>">
      <option value="horizontal" <?php selected('show', $instance['slide_effect']) ?>>
      <?php _e('Horizontal', $lavan_plugin_name) ?>
      </option>
      <option value="vertical" <?php selected('vertical', $instance['slide_effect']) ?>>
      <?php _e('Vertical', $lavan_plugin_name) ?>
      </option>
      <option value="fade" <?php selected('fade', $instance['slide_effect']) ?>>
      <?php _e('Fade', $lavan_plugin_name) ?>
      </option>
    </select>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slider_easing') ?>">
    <?php _e('Slide Easing Effect',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('slider_easing') ?>" id="<?php echo $this->get_field_id('slider_easing') ?>" class="widefat" value="<?php echo $instance['slider_easing'] ?>" />
    <small>
    <?php _e("Enter easing effect Ex:linear, swing,easeOutElastic <br> for more transition effects  <a href='http://jqueryui.com/resources/demos/effect/easing.html' target='_blank'>  click here   </a>",$lavan_plugin_name); ?>
    </small> 
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slider_pause_time') ?>">
    <?php _e('Slide Pause Time',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('slider_pause_time') ?>" id="<?php echo $this->get_field_id('slider_pause_time') ?>" class="widefat" value="<?php echo $instance['slider_pause_time'] ?>" />
    <small>
    <?php _e('The amount of time (in ms) between each auto transition , Ex: 4000',$lavan_plugin_name); ?>
    </small>
  </p>
</div>
<div class="input-elements-wrapper">  
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('slide_auto_play') ?>">
    <?php _e('Auto Play',$lavan_plugin_name)?>
    </label>
    <select id="<?php echo $this->get_field_id('slide_auto_play') ?>" name="<?php echo $this->get_field_name
      ('slide_auto_play') ?>">
      <option value="true" <?php selected('true', $instance['slide_auto_play']) ?>>
      <?php _e('True', $lavan_plugin_name) ?>
      </option>
      <option value="false" <?php selected('false', $instance['slide_auto_play']) ?>>
      <?php _e('False', $lavan_plugin_name) ?>
      </option>
    </select>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('adaptive_height') ?>">
    <?php _e('Auto Height',$lavan_plugin_name)?>
    </label>
    <select id="<?php echo $this->get_field_id('adaptive_height') ?>" name="<?php echo $this->get_field_name
      ('adaptive_height') ?>">
      <option value="true" <?php selected('true', $instance['adaptive_height']) ?>>
      <?php _e('True', $lavan_plugin_name) ?>
      </option>
      <option value="false" <?php selected('false', $instance['adaptive_height']) ?>>
      <?php _e('False', $lavan_plugin_name)?>
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
 lavan_kaya_register_widgets('slider-widget',__FILE__);
?>