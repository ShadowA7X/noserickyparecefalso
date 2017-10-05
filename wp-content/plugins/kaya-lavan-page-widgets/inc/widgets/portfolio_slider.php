<?php
// Poirtfolio slider
class Lavan_Portfolio_slider_Widget extends WP_Widget{
    public function __construct(){
    global $lavan_plugin_name;  
    parent::__construct('lavan-portfolio-slider-widget',
      __('Lavan-Portfolio Slider (PB)',$lavan_plugin_name),
           array('description' => __('Displays portfolio items as draggable slider',$lavan_plugin_name), 'class' => 
            'portfolio_widget')
        );

    }
    public function widget( $args, $instance ) {
      echo $args['before_widget'];
      global $lavan_plugin_name;
      global $post;
      $instance=wp_parse_args($instance, array(
          'title' => __('Portfolio Slider Title',$lavan_plugin_name),
          'description' => __('Enter Title Description here',$lavan_plugin_name),
          'readmore_text' => __('Read More', $lavan_plugin_name),
          'text_align'   => __('center',$lavan_plugin_name),
          'title_color' => '#ffffff',
          'pf_img_height' => '400',
          'pf_slider_cat' => '',
          'portfolio_project_link' => '#',
          'portfolio_project_title' => '',
          'disable_title' => '',
          'hide_post_link_icon' => '',
          'hide_lightbox_icon' => '',
          'Popular_post_display' => '',
          'pf_display_orderby' => __('menu_order', $lavan_plugin_name),
          'pf_display_order' => __('ASC',$lavan_plugin_name),
          'portfolio_slide_items' => '4',
          'pf_auto_play' => 'true',
          'fluid_gallery_slider' => '',
          'post_title_bg_color' => '#DB0007',
          'post_title_color' => '#ffffff',
          'image_bg_hover_color' => '',
          'animation_names' => '',
      )); ?>
<style type="text/css">
  .owl_slider_img{
    background-color: <?php echo $instance['image_bg_hover_color']; ?>!important;
  }
  #kaya_portfolio_widget_slider{
    display:none;
  }
</style>
<?php
echo '<div class="wow '.$instance['animation_names'].'">';
   $kaya_options = get_option('kayapati');
   if( $instance['title'] ):
        if( $instance['text_align'] =='left'){ $plus_icon = 'right';}elseif( $instance['text_align'] =='right'){ $plus_icon = 'left';}else{ $plus_icon='right'; $plus_icon_left ="left"; }
          echo '<div class="portfolio_title custom_title kaya_title_'.$instance['text_align'].'">';
             echo  '<h3 style="text-align:'.$instance['text_align'].'; color:'.$instance['title_color'].'!important;">'.$instance['title'].'</h3>';
            if( $instance['text_align'] =='center'){ 
              echo '<i class="fa fa-plus" style="float: '.$plus_icon_left.'; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i>';
            }
            echo '<i class="fa fa-plus" style="float: '.$plus_icon.'; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i>';
          echo '</div>'; ?>
         <div class="clear"> </div>
    <?php endif;

    $rand = rand(1,100); ?>
    <?php if( $instance['fluid_gallery_slider'] == 'on' ){ ?>
        <script>
        (function( $ ) {
         "use strict";
         $(function() {
           function portfolio_gallery_fluid(){
           var $container_fluid = Math.ceil( (( ($(window).width() - 5)  - parseInt($('.container').css('width'))) / 2) );
           $('#fluid_layout .lavan_portfolio_gallery .kaya_portfolio_widget_sliders<?php echo $rand; ?>').css({'width':$(window).width(), 'margin-left' : -$container_fluid });
          }
           portfolio_gallery_fluid();
           $(window).resize(function(){
             portfolio_gallery_fluid();
          });   
        });
        })(jQuery);
      </script>
<?php } ?>
     <?php $post_icon = ( $instance['hide_lightbox_icon'] != 'on' ) ? "30%" : '50%'; ?>
        <?php $post_class = ( $instance['hide_lightbox_icon'] == 'on' ) ? "left" : 'right'; ?>
        <?php $lightbox_icon = ( $instance['hide_post_link_icon'] != 'on' ) ? "30%" : '50%'; ?>
    <script type="text/javascript">
        (function($) {
          "use strict";
               $(window).load(function() {
              var responsive2_column = ( ( <?php echo $instance['portfolio_slide_items'] ?> == '4' ) || ( <?php echo $instance['portfolio_slide_items'] ?> == '3' ) ) ? '2' : <?php echo $instance['portfolio_slide_items'] ?>;
              $(".kaya_portfolio_widget_sliders<?php echo $rand; ?>").owlCarousel({
                 navigation : false,
                 autoplay : <?php echo $instance['pf_auto_play']; ?>,
                 stopOnHover : true,
                 items : <?php echo $instance['portfolio_slide_items'] ?>,
                  onInitialized: function() {     
                    $('#kaya_portfolio_widget_slider').css('display','block'); 
                    $('.slider_bg_loading_img').hide(); 
                  },
                  responsive: {
                  0:{
                      items:1,
                      },
                      480:{
                          items:1,
                      },
                      768:{
                          items:responsive2_column,
                          loop : false,
                      },
                      1024:{
                          items:<?php echo $instance['portfolio_slide_items'] ?>,
                          loop : true,
                      },
                },     
              });
      // Hover Effects
     $('.owl_slider_img').hover(function(){
          $(this).find('img').fadeTo(500,0.6);
          $(this).find('.link_to_image, .link_to_video').css({'top':'0px','left':'<?php echo $lightbox_icon; ?>','display':'block'}).stop().animate({'top':'50%', opacity:1},600);
          $(this).find('.link_to_post').css({'top':'0px','right':'<?php echo $post_icon; ?>','display':'block'}).stop().animate({'top':'50%',opacity:1},600);
          //alert('test');
        },function(){
          $(this).find('img').fadeTo(500,1);
          $(this).find('.link_to_image, .link_to_video').css({'top':'0','display':'block'}).stop().animate({'top':'-50%',opacity:0},600);
          $(this).find('.link_to_post').css({'top':'0px','display':'block'}).stop().animate({'top':'-50%',opacity:0},600);
      }); 
         });

       })(jQuery);
    </script>
<?php
  switch ($instance['portfolio_slide_items']) {
  case '5':
    $img_width = '350';
  break;
  case '4':
    $img_width = ($instance['fluid_gallery_slider'] == 'on' ) ? '500' : '350';
  break;
  case '3':
    $img_width = ($instance['fluid_gallery_slider'] == 'on' ) ? '650' : '450';
  break;
  case '2':
    $img_width = ($instance['fluid_gallery_slider'] == 'on' ) ? '980' : '600';
  break;
  case '1':
    $img_width = ($instance['fluid_gallery_slider'] == 'on' ) ? '1920' : '1100';
  break;  
  default:
    $img_width = '400';
  break;
  }
 echo '<span class="slider_bg_loading_img" style="height:200px; background:url('.constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'images/bx_loader.gif)"></span>'; ?>
<div class="Portfolio_gallery lavan_portfolio_gallery">
  <div id="kaya_portfolio_widget_slider" class="kaya_portfolio_widget_sliders<?php echo $rand; ?>">
    <?php $array_val = ( !empty( $instance['pf_slider_cat'] )) ? explode(',',  $instance['pf_slider_cat']) : '';
    if( $instance["Popular_post_display"] == '1' || $instance["Popular_post_display"] == 'on' ){
    $args = array('post_type' => 'portfolio', 'showposts' => $instance['portfolio_limit'], 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'field' => 'id', 'order' => $instance['pf_display_order'], 'taxonomy' => 'portfolio_category');
    }else{
    if( $array_val ) {
    $loop = new WP_Query(array( 'post_type' => 'portfolio',  'orderby' => $instance['pf_display_orderby'], 'posts_per_page' =>-1,'order' => $instance['pf_display_order'],  'tax_query' => array('relation' => 'AND', array( 'taxonomy' => 'portfolio_category',   'field' => 'id', 'terms' => $array_val  )) ));
    }else{
    $loop = new WP_Query(array('post_type' => 'portfolio', 'taxonomy' => 'portfolio_category','term' => $instance['pf_slider_cat'], 'orderby' => $instance['pf_display_orderby'], 'posts_per_page' =>-1,'order' => $instance['pf_display_order']));
    }
    }
    if( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post() ?>
    <div class="lavan-portfolio-container">
      <?php 
        $title=get_the_title($post->Id);
        $img_url=wp_get_attachment_url( get_post_thumbnail_id() );
        $pf_link_new_window=get_post_meta(get_the_ID(),'pf_link_new_window' ,true);
        if($pf_link_new_window == '1') { $pf_target_link ="_blank"; }else{ $pf_target_link ='_self'; }
        $permalink = get_permalink();
        $Porfolio_customlink=get_post_meta($post->ID,'Porfolio_customlink',true);
        $pf_customlink = $Porfolio_customlink ? $Porfolio_customlink : $permalink; ?>
        <?php
        $lightbox_url =  get_template_directory_uri().'/images/slider_default_img.jpg';
        $featured_img = $img_url ? $img_url : $lightbox_url;
        $video_url= get_post_meta($post->ID,'video_url',true);
        $lightbox_type = $video_url ? trim($video_url) : $featured_img;
        $class = $video_url ? 'link_to_video' : 'link_to_image'; 
        $image_bg_color = $instance['image_bg_hover_color'] ? 'background-color:'.$instance['image_bg_hover_color'].';' : '';
        $default_img_url = constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'images/slider_default_img.jpg';
        ?>
      <a href="<?php echo $pf_customlink; ?>" target="<?php echo $pf_target_link; ?>" >
      <?php 
      $height = $instance['pf_img_height'] ? $instance['pf_img_height'] : '400';
      echo '<div class="owl_slider_img">';
      if( $img_url ):
      echo '<img src="'.kaya_image_resize( $img_url, $img_width , $height, true ).'" class=""  alt="'.$title.'"  />';
      else:
        if (is_multisite()){
                     $img_url = $default_img_url;
                  }else{                  
                    $img_url = kaya_image_resize( $default_img_url,$img_width , $height, true );
                  }
                  echo '<img src="'.$img_url.'" class=""  alt="'.$title.'"  />';
      endif;
      if( $instance['hide_lightbox_icon'] != '1' && $instance['hide_lightbox_icon'] != 'on' ): ?>
      <a class="<?php echo $class; ?> pf_images" rel="prettyPhoto['gallery']" title="<?php the_title();?>" 
      href="<?php echo $lightbox_type; ?>">&nbsp;</a>
        <?php endif; ?>
        <?php if(  $instance['hide_post_link_icon'] != 'on' ): ?>
      <a class="link_to_post" href="<?php echo $pf_customlink; ?>" target="<?php echo $pf_target_link; ?>">&nbsp; </a>
        <?php endif; ?>
      </a>
      <?php
      echo '</div>';
if( ($instance["disable_title"] != '1') && $instance["disable_title"] != 'on'):
 echo '<h4 style="color:'.$instance['post_title_color'].';background-color:'.$instance['post_title_bg_color'].'">'.get_the_title().'</h4>'; 
   endif; ?>
    </div>
    <?php endwhile; endif; ?>
  </div>
  <?php wp_reset_query(); ?>
</div>
</div>
   <?php
     echo $args['after_widget'];
    }
    public function form($instance){
    global $lavan_plugin_name;  
      $portfolio_terms=  get_terms('portfolio_category','');
          $portfolio_terms=  get_terms('portfolio_category','');
        if( $portfolio_terms ){
          foreach ($portfolio_terms as $portfolio_term) { 
            $pf_cat_ids[] = $portfolio_term->term_id;
             $pf_cats_name[] = $portfolio_term->name.' - '.$portfolio_term->term_id;
          }
        }else{ $pf_cats_name[] = ''; $pf_cat_ids[] =''; }
           $instance = wp_parse_args($instance, array(
          'title' => __('Portfolio Slider Title',$lavan_plugin_name),
          'description' => __('Enter Title Description here',$lavan_plugin_name),
          'readmore_text' => __('Read More', $lavan_plugin_name),
          'text_align'   => __('center', $lavan_plugin_name),
          'title_color' => '#ffffff',
          'pf_img_height' => '400',
          'pf_slider_cat' => implode(',', $pf_cat_ids),
          'portfolio_project_link' => '#',
          'portfolio_project_title' => '',
          'disable_title' => '',
          'hide_post_link_icon' => '',
          'hide_lightbox_icon' => '',
          'Popular_post_display' => '',
          'pf_display_orderby' => __('menu_order', $lavan_plugin_name),
          'pf_display_order' => __('ASC',$lavan_plugin_name),
          'portfolio_slide_items' => '4',
          'pf_auto_play' => 'true',
         'fluid_gallery_slider' => '',
         'post_title_bg_color' => '#DB0007',
          'post_title_color' => '#ffffff',
          'image_bg_hover_color' => '',
         'animation_names' => '',
           ));  ?>

<script type="text/javascript">
  (function($){
    "use srtict";
  $('.portfolio_slider_color_picker').each(function(){
  $(this).wpColorPicker()  
  });
  })(jQuery);
</script>

<div class="input-elements-wrapper">           
  <p class="one_fourth">
    <lable for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e('Title',$lavan_plugin_name); ?>
    </label>
    <input type="text" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']) ?>" name="<?php echo $this->get_field_name('title') ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('title_color'); ?>">
    <?php _e('Title Color',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="portfolio_slider_color_picker" value="<?php echo $instance['title_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('text_align') ?>">
    <?php _e('Title Position',$lavan_plugin_name)?>
    </label>
    <select id="<?php echo $this->get_field_id('text_align') ?>" name="<?php echo $this->get_field_name('text_align') ?>">
      <option value="left" <?php selected('left', $instance['text_align']) ?>>
      <?php _e('Title Left', $lavan_plugin_name) ?>
      </option>
      <option value="right" <?php selected('right', $instance['text_align']) ?>>
      <?php _e('Title Right', $lavan_plugin_name) ?>
      </option>
      <option value="center" <?php selected('center', $instance['text_align']) ?>>
      <?php _e('Title Center', $lavan_plugin_name) ?>
      </option>
    </select>
  </p>
</div>
<div class="input-elements-wrapper">   
<p>
  <label for="<?php echo $this->get_field_id('pf_slider_cat') ?>"> <?php _e('Enter Portfolio Category IDs : ',$lavan_plugin_name) ?> </label>
 <input type="text" name="<?php echo $this->get_field_name('pf_slider_cat') ?>" id="<?php echo $this->get_field_id('pf_slider_cat') ?>" class="widefat" value="<?php echo $instance['pf_slider_cat'] ?>" />
  <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',$lavan_plugin_name); ?> </strong><?php echo implode(', ', $pf_cats_name); ?></em><br />
   <stong><?php _e('Note:',$lavan_plugin_name); ?></strong><?php _e('Separate IDs with commas only',$lavan_plugin_name); ?>
</p>
</div>
<div class="input-elements-wrapper"> 
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('pf_img_height'); ?>">
    <?php _e('Image Height',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('pf_img_height') ?>" id="<?php echo $this->get_field_id('pf_img_height') ?>" class="small-text" value="<?php echo $instance['pf_img_height'] ?>" />
    <small><?php _e('px',$lavan_plugin_name); ?></small>
  </p>  
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('portfolio_slide_items') ?>">
    <?php _e('Portfolio Slide Items',$lavan_plugin_name); ?>
    </label>
    <select id="<?php echo $this->get_field_id('portfolio_slide_items') ?>" name="<?php echo $this->get_field_name
      ('portfolio_slide_items') ?>">
      <option value="1" <?php selected('1', $instance['portfolio_slide_items']) ?>>
      <?php _e('1 Item', $lavan_plugin_name) ?>
      </option>
      <option value="2" <?php selected('2', $instance['portfolio_slide_items']) ?>>
      <?php _e('2 Items', $lavan_plugin_name) ?>
      </option>
      <option value="3" <?php selected('3', $instance['portfolio_slide_items']) ?>>
      <?php _e('3 Items', $lavan_plugin_name) ?>
      </option>
      <option value="4" <?php selected('4', $instance['portfolio_slide_items']) ?>>
      <?php _e('4 Items', $lavan_plugin_name) ?>
      </option>
      <option value="5" <?php selected('5', $instance['portfolio_slide_items']) ?>>
      <?php _e('5 Items', $lavan_plugin_name) ?>
      </option>
    </select>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('pf_auto_play') ?>">
    <?php _e('Auto Play',$lavan_plugin_name)?>
    </label>
    <select id="<?php echo $this->get_field_id('pf_auto_play') ?>" name="<?php echo $this->get_field_name('pf_auto_play') ?>">
    <option value="true" <?php selected('true', $instance['pf_auto_play']) ?>>
    <?php _e('True', $lavan_plugin_name) ?>
    </option>
    <option value="false" <?php selected('false', $instance['pf_auto_play']) ?>>
    <?php _e('False', $lavan_plugin_name) ?>
    </option>
    </select>
  </p>
</div>
<div class="input-elements-wrapper"> 
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('pf_display_order') ?>">
    <?php _e('Order',$lavan_plugin_name)?>
    </label>
    <select id="<?php echo $this->get_field_id('pf_display_order') ?>" name="<?php echo $this->get_field_name('pf_display_order') ?>">
      <option value="ASC" <?php selected('ASC', $instance['pf_display_order']) ?>>
      <?php _e('Ascending', $lavan_plugin_name) ?>
      </option>
      <option value="DESC" <?php selected('DESC', $instance['pf_display_order']) ?>>
      <?php _e('Descending', $lavan_plugin_name) ?>
      </option>
    </select>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('pf_display_orderby') ?>">
    <?php _e('Orderby',$lavan_plugin_name)?>
    </label>
    <select id="<?php echo $this->get_field_id('pf_display_orderby') ?>" name="<?php echo $this->get_field_name('pf_display_orderby') ?>">
      <option value="date" <?php selected('date', $instance['pf_display_orderby']) ?>>
      <?php _e('Date', $lavan_plugin_name) ?>
      </option>
      <option value="menu_order" <?php selected('menu_order', $instance['pf_display_orderby']) ?>>
      <?php _e('Menu Order', $lavan_plugin_name) ?>
      </option>
      <option value="title" <?php selected('title', $instance['pf_display_orderby']) ?>>
      <?php _e('Title', $lavan_plugin_name) ?>
      </option>
      <option value="rand" <?php selected('rand', $instance['pf_display_orderby']) ?>>
      <?php _e('Random', $lavan_plugin_name) ?>
      </option>
      <option value="author" <?php selected('author', $instance['pf_display_orderby']) ?>>
      <?php _e('Author', $lavan_plugin_name) ?>
      </option>
    </select>
  </p>
</div>
<div class="input-elements-wrapper">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('post_title_bg_color'); ?>"><?php _e('Post Title BG Color',$lavan_plugin_name) ?></label>
    <input type="text" name="<?php echo $this->get_field_name('post_title_bg_color') ?>" id="<?php echo $this->get_field_id
    ('post_title_bg_color') ?>" class="portfolio_slider_color_picker" value="<?php echo $instance['post_title_bg_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('post_title_color'); ?>"><?php _e('Post Title Color',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('post_title_color') ?>" id="<?php echo $this->get_field_id
    ('post_title_color') ?>" class="portfolio_slider_color_picker" value="<?php echo $instance['post_title_color'] ?>" />
  </p>
    <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('image_bg_hover_color'); ?>"> <?php _e('Image Hover BG Opacity Color',
    $lavan_plugin_name) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('image_bg_hover_color') ?>" id="<?php echo $this->get_field_id
    ('image_bg_hover_color') ?>" class="portfolio_slider_color_picker" value="<?php echo $instance['image_bg_hover_color'] ?>"
     />
  </p>
</div>
<div class="input-elements-wrapper"> 
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('fluid_gallery_slider') ?>">
    <?php _e('Fullwidth Slider',$lavan_plugin_name)?>
    </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("fluid_gallery_slider"); ?>" name="<?php echo $this->get_field_name("fluid_gallery_slider"); ?>"<?php checked( (bool) $instance["fluid_gallery_slider"], true ); ?> />
  </p>
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('disable_title') ?>">
    <?php _e('Disable Title',$lavan_plugin_name)?>
    </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_title"); ?>" name="<?php echo $this->get_field_name("disable_title"); ?>"<?php checked( (bool) $instance["disable_title"], true ); ?> />
  </p>
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('hide_lightbox_icon') ?>"><?php _e('Disable Lightbox icon',$lavan_plugin_name)?></label>&nbsp;
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("hide_lightbox_icon"); ?>" name="<?php echo $this->get_field_name("hide_lightbox_icon"); ?>"<?php checked( (bool) $instance["hide_lightbox_icon"], true ); ?> />
    </p>
  <p class="one_fifth">
  <label for="<?php echo $this->get_field_id('hide_post_link_icon') ?>"><?php _e('Disable Post Link icon',$lavan_plugin_name)?></label>&nbsp;
  <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("hide_post_link_icon"); ?>" name="<?php echo $this->get_field_name("hide_post_link_icon"); ?>"<?php checked( (bool) $instance["hide_post_link_icon"], true ); ?> />
  </p>
  <p class="one_fifth_last">
    <label for="<?php echo $this->get_field_id('Popular_post_display') ?>">
    <?php _e('Popular Posts',$lavan_plugin_name)?>
    </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("Popular_post_display"); ?>" name="<?php echo $this->get_field_name("Popular_post_display"); ?>"<?php checked( (bool) $instance["Popular_post_display"], true ); ?> />
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
 lavan_kaya_register_widgets('portfolio_slider-widget',__FILE__);
?>