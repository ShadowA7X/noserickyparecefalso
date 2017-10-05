<?php
//portfolio
 class Lavan_Portfolio_Widget extends WP_Widget{
    public function __construct(){
    global $lavan_plugin_name;  
        parent::__construct('kaya-portfolio-widget',
           ucfirst($lavan_plugin_name).' '.__(' - Portfolio',$lavan_plugin_name).'&nbsp;<a class="widget_video_tutorials" target="_blank" href="https://www.youtube.com/watch?v=DyVS0G1hTm0&feature=youtu.be">'.__('Watch this video', $lavan_plugin_name).'</a>',
            array('description' => __('Displays all portfolio items in grid style',$lavan_plugin_name), 'class' => 'portfolio_widget')
        );
    }
  public function widget( $args, $instance ) {
      global $post;
      global $lavan_plugin_name; 
      $instance=wp_parse_args($instance, array(

         'title' => __('Portfolio Title',$lavan_plugin_name),
          'heading_styles' => '3',
          'description' => '',
          'columns' => '4',
          'readmore_text' => __('Read More',$lavan_plugin_name),
          'text_align'   => __('left',$lavan_plugin_name),
          'title_color' => '#333333',
          'desc_color' => '#787878',
          'pf_img_width' => '400',
          'pf_img_height' => '400',
          'portfolio_limit' => '',
          'kaya_portfolio_filter' => __('false',$lavan_plugin_name),
          'portfolio_widget_category' => '',
          'disable_title' => '',
          'Popular_post_display' => '',
          'pf_display_orderby' => __('Date', $lavan_plugin_name),
          'pf_display_order' => __('DESC', $lavan_plugin_name),
          'fluid_pf_gallery' => '',
          'hide_post_link_icon' => '',
          'hide_lightbox_icon' => '',
          'enable_image_link'    => '',
          'hide_post_title' => '',
          'post_title_bg_color' => '#DB0007',
          'post_title_color' => '#ffffff',
          'draggable_title_hover_hover_color' => '#ffffff',
          'filter_tab_bg_color' => '#333',
          'filter_tab_text_color' => '#ffffff',
          'filter_tab_active_bg_color' => '#ff6c00',
          'filter_tab_active_text_color' => '#ffffff',
           'disable_pagination' => '',
           'image_bg_hover_color' => '',
           'animation_names' => '',

      )); ?>
        <?php $post_icon = ( $instance['hide_lightbox_icon'] != 'on' ) ? "30%" : '50%'; ?>
        <?php $post_class = ( $instance['hide_lightbox_icon'] == 'on' ) ? "left" : 'right'; ?>
        <?php $lightbox_icon = ( $instance['hide_post_link_icon'] != 'on' ) ? "30%" : '50%'; ?>
        <?php  switch( $instance['columns'] ){
         case 5:
            //$width = "480";
            $width = $instance['pf_img_width'] ? $instance['pf_img_width'] : '480';
            $height = $instance['pf_img_height'] ? $instance['pf_img_height'] : '400';
            break;
        case 4:
            //$width = "500";
            $width = $instance['pf_img_width'] ? $instance['pf_img_width'] : '480';
            $height = $instance['pf_img_height'] ? $instance['pf_img_height'] : '480';
            break;
        case 3:
            $width =  ( $instance['fluid_pf_gallery'] == '1' ) ? '650' : '500';
            $width = $instance['pf_img_width'] ? $instance['pf_img_width'] : '500';
            $height = $instance['pf_img_height'] ? $instance['pf_img_height'] : '400';
            break;
         case 2:
              $width =  ( $instance['fluid_pf_gallery'] == '1' ) ? '920' : '800';
              $width = $instance['pf_img_width'] ? $instance['pf_img_width'] : '800';
              $height = $instance['pf_img_height'] ? $instance['pf_img_height'] : '400';

      } 
      $rand = rand(1,100);
      if( $instance['fluid_pf_gallery'] == 'on'){
       $rand = rand(1,100);
        $fluid_gallery = 'id=portfolio_fluid'.$rand;
        $fluid_gallery_width = 'portfolio_fluid';
      ?>
    <script>
      (function( $ ) {
       "use strict";
       $(function() {
         function portfolio_gallery_fluid(){
           var $content_width= $('#fluid_layout #portfolio_fluid<?php echo $rand; ?>').width($(window).width());
           var $container_fluid = Math.ceil( (( ($(window).width() - 5)  - parseInt($('.container').css('width'))) / 2) );
           $('#fluid_layout #portfolio_fluid<?php echo $rand; ?>').css({
             'margin-left' : -$container_fluid,
             //width : $content_width+'25'
             });
        }
         portfolio_gallery_fluid();
         $(window).resize(function(){
           portfolio_gallery_fluid();
        });   
      });
      })(jQuery);
      </script>
    <?php  }else{
      $fluid_gallery = '';
      $fluid_gallery_width = '';
    }
    ?>
    <script type="text/javascript">
      (function($) {
        "use strict";
        $(function() {
            // Hover Effects
        $('.portfolio_gallery-<?php echo $rand ?> li').hover(function(){
          $(this).find('img').fadeTo(500,0.6);
          $(this).find('.link_to_image, .link_to_video').css({'left':'-100px','display':'block'}).stop().animate({'left':'<?php echo $lightbox_icon; ?>', opacity:1},600);
          $(this).find('.link_to_post').css({'right':'-50%','display':'block'}).stop().animate({'right':'<?php echo $post_icon; ?>',opacity:1},600);
          //alert('test');
        },function(){
          $(this).find('img').fadeTo(500,1);
          $(this).find('.link_to_image, .link_to_video').css({'left':'100','display':'block'}).stop().animate({'left':'-<?php echo $lightbox_icon; ?>',opacity:0},600);
          $(this).find('.link_to_post').css({'right':'50%','display':'block'}).stop().animate({'right':'<?php echo $post_icon; ?>',opacity:0},600);
       }); 

         });

      })(jQuery);
     </script>
     <style type="text/css">
    .portfolio_gallery-<?php echo $rand ?> .portfolio-container h4{
          background-color: <?php echo $instance['post_title_bg_color']; ?>!important;
          color: <?php echo $instance['post_title_color']; ?>!important;
          overflow: hidden;
      }
      .portfolio-container-<?php echo $rand ?> .portfolio_item_text h4{
          background-color: <?php echo $instance['post_title_bg_color']; ?>!important;
          color: <?php echo $instance['post_title_color']; ?>!important;
      }
           .filter-<?php echo $rand; ?> a:hover, .filter-<?php echo $rand; ?> .active{
        background-color: <?php echo $instance['filter_tab_active_bg_color']; ?>!important;
        color: <?php echo $instance['filter_tab_active_text_color']; ?>!important;
      }
       .portfolio_img_container{
          background-color: <?php echo $instance['image_bg_hover_color']; ?>!important;
                }
     </style>
   <?php
   echo '<div class="wow '.$instance['animation_names'].' ">'; 
        // $title = apply_filters('widget_title' ,$title);
    $array_val = ( !empty( $instance['portfolio_widget_category'] )) ? explode(',',  $instance['portfolio_widget_category']) : '';
            if( $instance['title'] ):
             if( $instance['text_align'] =='left'){ $plus_icon = 'right';}elseif( $instance['text_align'] =='right'){ $plus_icon = 'left';}else{ $plus_icon='right'; $plus_icon_left ="left"; }
              echo '<div class="portfolio_title custom_title kaya_title_'.$instance['text_align'].'">';
                  echo  '<h3 style="text-align:'.$instance['text_align'].'; color:'.$instance['title_color'].'!important;">'.$instance['title'].'</h3>';
                  if( $instance['text_align'] =='center'){ 
                    echo '<i class="fa fa-plus" style="float: '.$plus_icon_left.'; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i>';
                  }
                   echo '<i class="fa fa-plus" style="float: '.$plus_icon.'; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i>';
               echo '</div>';  ?>
            <div class="clear"> </div>
        <?php endif; 
            //echo $instance['portfolio_widget_category'];

        if ($instance['kaya_portfolio_filter'] == 'true'){ // open filter settings
            echo '<div class="filter_portfolio">';
              echo '<div class="filter filter-'.$rand.'" id="filter">';
                echo '<ul style="text-align:'.$instance['text_align'].';">';
                  echo '<li class="all" ><a class="" href="#" style="color:'.$instance['filter_tab_text_color'].'; background:'.$instance['filter_tab_bg_color'].';" data-category="all">'.__( 'All', $lavan_plugin_name ).'</a></li>';
                  $category = trim( $instance['portfolio_widget_category']);
                  if( $category ){
                    $pf_categories = @explode(',', $category);
                     for($i=0;$i<count($pf_categories);$i++){
                      $terms[] = get_term_by('id', $pf_categories[$i], 'portfolio_category');
                    } } else {
                      $terms = get_terms('portfolio_category');
                    }
                    foreach($terms as $term) {
                    echo '<li  class="cat-'.$term->term_id .'" >';
                    echo '<a href="" style="color:'.$instance['filter_tab_text_color'].'; background:'.$instance['filter_tab_bg_color'].';" data-category="cat-' . $term->term_id . '">' . $term->name . ' </a></li>';
                    }
                    //print_r($terms);
                echo '</ul>';
             echo '</div>';
           echo '</div>'; 
      } // end filter
  ?>
    <div class="Portfolio_gallery interia_portfolio_gallery portfolio_gallery-<?php echo $rand ?> <?php echo $fluid_gallery_width; ?>" <?php echo $fluid_gallery; ?>>
      <ul  class="isotope-container portfolio<?php echo $instance['columns'] ?> porfolio_items portfolio_extra clearfix">
         <?php  // Loop start 
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;    
         if( $instance["Popular_post_display"] == '1' || $instance["Popular_post_display"] == 'on' ){
          $args = array('post_type' => 'portfolio', 'showposts' => $instance['portfolio_limit'], 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'field' => 'id', 'order' => $instance['pf_display_order'], 'taxonomy' => 'portfolio_category');
        }else{
         if( $array_val ) {
           $args = array( 'paged' => $paged, 'post_type' => 'portfolio',  'orderby' => $instance['pf_display_orderby'], 'posts_per_page' =>$instance['portfolio_limit'],'order' => $instance['pf_display_order'],  'tax_query' => array('relation' => 'AND', array( 'taxonomy' => 'portfolio_category',   'field' => 'id', 'terms' => $array_val  ), ));
          }else{
             $args = array('paged' => $paged, 'post_type' => 'portfolio', 'taxonomy' => 'portfolio_category','term' => $instance['portfolio_widget_category'], 'orderby' => $instance['pf_display_orderby'], 'posts_per_page' =>$instance['portfolio_limit'],'order' => $instance['pf_display_order']);
          }
        }
      query_posts($args);
      if( have_posts() ) : while( have_posts() ) : the_post();
      $terms = get_the_terms(get_the_ID(), 'portfolio_category');
      $pf_link_new_window=get_post_meta(get_the_ID(),'pf_link_new_window' ,true);
            if($pf_link_new_window == '1') { $pf_target_link ="_blank"; }else{ $pf_target_link ='_self'; }
            $permalink = get_permalink();
            $Porfolio_customlink=get_post_meta($post->ID,'Porfolio_customlink',true);
            $pf_customlink = $Porfolio_customlink ? $Porfolio_customlink : $permalink;
        $terms_id = array();
        $terms_name = array();
        if($terms ){
        foreach ($terms as $term) {
          $terms_id[] = 'cat-'.$term->term_id;
          $terms_name[] = $term ->name;
        }
      }else{
        $terms_name[] = 'Uncategorized';
      }
        echo '<li class="isotope-item all '.implode(' ', $terms_id).'">';   ?>
        <div class="portfolio-container">
          <?php if( $instance['enable_image_link'] == 'on' ): ?>
            <a href="<?php echo $pf_customlink; ?>" target="<?php echo $pf_target_link; ?>">
          <?php endif; ?>
            <div class="portfolio_img_container">
            <?php if( $instance['hide_post_title'] == 'on' ): ?>
            <?php endif; ?>   
          <?php $img_url = wp_get_attachment_url( get_post_thumbnail_id() );
           $lightbox_url =  get_template_directory_uri().'/images/portfolio_default_img.jpg';
         $featured_img = $img_url ? $img_url : $lightbox_url;
          $video_url= get_post_meta($post->ID,'video_url',true);
           $lightbox_type = $video_url ? trim($video_url) : $featured_img;
           $class = $video_url ? 'link_to_video' : 'link_to_image';
           $default_img_url = constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'images/portfolio_default_img.jpg';
            if( $img_url ) {
              echo '<img src="'.kaya_image_resize( $img_url, $width, $height, true ).'" alt="'.get_the_title().'" />';
              }else{
                if (is_multisite()){
                     $img_url = $default_img_url;
                  }else{                  
                    $img_url = kaya_image_resize( $default_img_url,$width, $height, true );
                  }
                  echo '<img src="'.$img_url.'" alt="'.get_the_title().'" />';
              } ?>
          <?php if( $instance['hide_lightbox_icon'] != '1' && $instance['hide_lightbox_icon'] != 'on' ): ?>
                  <a class="<?php echo $class; ?> pf_images" rel="prettyPhoto['gallery']" title="<?php the_title();?>" href="<?php echo $lightbox_type; ?>">&nbsp;</a>
          <?php endif; ?>
          <?php if( $instance['hide_post_link_icon'] != '1' && $instance['hide_post_link_icon'] != 'on' ): ?>
                  <a class="link_to_post" href="<?php echo $pf_customlink; ?>" target="<?php echo $pf_target_link; ?>">&nbsp; </a>
          <?php endif; ?>
                 </div>
      </a>
        <?php if( $instance['hide_post_title'] != 'on' ): ?>
          <div class="portfolio_item_text" >
             <?php if( $instance['enable_image_link'] == 'on' ): ?>
            <a href="<?php echo $pf_customlink; ?>" target="<?php echo $pf_target_link; ?>">
          <?php endif; ?>
            <?php echo '<h4 style="color:'.$instance['post_title_color'].';">'.get_the_title().'</h4>'; ?>
           <?php if( $instance['enable_image_link'] == 'on' ): ?>
            </a>
          <?php endif; ?>
           </div> 
            <?php endif; ?>


         </div>   
       </li>
       <?php endwhile; endif; ?>
    </ul>
      <?php 
      if( $instance['disable_pagination'] != 'on'){
        echo kaya_pagination();
      } ?>
      <?php wp_reset_query(); ?>
    </div>
  </div>
    <?php  
  }

   
    public function form($instance){
    global $lavan_plugin_name;   
        $portfolio_terms=  get_terms('portfolio_category','');
        if( $portfolio_terms ){
          foreach ($portfolio_terms as $portfolio_term) { 
            $pf_cat_ids[] = $portfolio_term->term_id;
             $pf_cats_name[] = $portfolio_term->name.' - '.$portfolio_term->term_id;
          }
        }else{ $pf_cats_name[] = '';  $pf_cat_ids[]=''; }
         $instance = wp_parse_args($instance, array(
          'title' => __('Portfolio Title',$lavan_plugin_name),
          'heading_styles' => '3',
          'description' => '',
          'columns' => '4',
          'readmore_text' => __('Read More',$lavan_plugin_name),
          'text_align'   => __('left', $lavan_plugin_name),
          'title_color' => '#333333',
          'desc_color' => '#787878',
          'pf_img_width' => '400',
          'pf_img_height' => '400',
          'portfolio_limit' => '',
          'kaya_portfolio_filter' => __('false',$lavan_plugin_name),
          'portfolio_widget_category' => implode(',', $pf_cat_ids),
          'disable_title' => '',
          'Popular_post_display' => '',
          'pf_display_orderby' => __('Date', $lavan_plugin_name),
          'pf_display_order' => __('DESC', $lavan_plugin_name),
          'fluid_pf_gallery' => '',
          'hide_post_link_icon' => '',
          'hide_lightbox_icon' => '',
          'enable_image_link'    => '',
          'hide_post_title' => '',
          'post_title_bg_color' => '#DB0007',
          'post_title_color' => '#ffffff',
          'filter_tab_bg_color' => '#333',
          'filter_tab_text_color' => '#ffffff',
          'filter_tab_active_bg_color' => '#ff6c00',
          'filter_tab_active_text_color' => '#ffffff',
           'disable_pagination' => '',
           'image_bg_hover_color' => '',
           'animation_names' => '',
      )); ?>
<script type="text/javascript">
  (function($) {
  "use strict";
  $(function() { // Portfolio Filter Tabs Hide & Show
  $("#<?php echo $this->get_field_id('kaya_portfolio_filter') ?>").change(function () {       
    $(".<?php echo $this->get_field_id('kaya_portfolio_filter'); ?> .hide_filter_tabs").hide();       
    var selectlayout = $("#<?php echo $this->get_field_id('kaya_portfolio_filter') ?> option:selected").val(); 
    switch(selectlayout)
    {
      case 'true':
        $(".<?php echo $this->get_field_id('kaya_portfolio_filter'); ?> .hide_filter_tabs").show();
      break;      
    }
  }).change();
     $('.portfolio_color_picker').each(function(){  // Color Picker
    $(this).wpColorPicker();
    });
  });
  })(jQuery);
</script>
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
    ('title_color') ?>" class="portfolio_color_picker" value="<?php echo $instance['title_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('heading_styles') ?>">
    <?php _e('Title Heading Style',$lavan_plugin_name)?>
    </label>
    <select id="<?php echo $this->get_field_id('text_align') ?>" name="<?php echo $this->get_field_name('heading_styles') ?>">
      <option value="1" <?php selected('1', $instance['heading_styles']) ?>>
      <?php _e('Heading Style H1 ',$lavan_plugin_name); ?>
      </option>
      <option value="2" <?php selected('2', $instance['heading_styles']) ?>>
      <?php _e('Heading Style H2 ', $lavan_plugin_name) ?>
      </option>
      <option value="3" <?php selected('3', $instance['heading_styles']) ?>>
      <?php _e('Heading Style H3 ',$lavan_plugin_name )  ?>
      </option>
    </select>
  </p>
</div>
<div class="input-elements-wrapper">  
  <p class="two_third">
  <label for="<?php echo $this->get_field_id('description'); ?>">
  <?php _e('Description',$lavan_plugin_name) ?>
  </label>
  <textarea name="<?php echo $this->get_field_name('description') ?>" id="<?php echo $this->get_field_id('description') ?>" class="widefat" value="<?php echo esc_attr( $instance['description']) ?>" ><?php echo esc_attr( $instance['description'] ) ?></textarea>
  </p>
  <p class="one_third_last">
  <label for="<?php echo $this->get_field_id('desc_color'); ?>">
  <?php _e('Description Color',$lavan_plugin_name) ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('desc_color') ?>" id="<?php echo $this->get_field_id('desc_color') ?>" class="portfolio_color_picker" value="<?php echo $instance['desc_color'] ?>" />
  </p>
</div>
<div class="input-elements-wrapper"> 
  <p>
    <label for="<?php echo $this->get_field_id('portfolio_widget_category') ?>"> <?php _e('Enter Portfolio Category IDs : ',$lavan_plugin_name) ?> </label>
    <input type="text" name="<?php echo $this->get_field_name('portfolio_widget_category') ?>" id="<?php echo $this->get_field_id('portfolio_widget_category') ?>" class="widefat" value="<?php echo $instance['portfolio_widget_category'] ?>" />
    <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',$lavan_plugin_name); ?> </strong> <?php echo implode(', ', $pf_cats_name); ?></em><br />
    <stong><?php _e('Note:',$lavan_plugin_name); ?></strong><?php _e('Separate IDs with commas only',$lavan_plugin_name); ?>
  </p>
</div>  
<div class="input-elements-wrapper <?php echo $this->get_field_id('kaya_portfolio_filter') ?>">  
  <p class="one_fifth">
  <label for="<?php echo $this->get_field_id('kaya_portfolio_filter') ?>">
  <?php _e('Portfolio Filter Tabs',$lavan_plugin_name)?>
  </label>
  <select id="<?php echo $this->get_field_id('kaya_portfolio_filter') ?>" name="<?php echo $this->get_field_name('kaya_portfolio_filter') ?>">
  <option value="false" <?php selected('false', $instance['kaya_portfolio_filter']) ?>>
  <?php _e('False', $lavan_plugin_name) ?>
  </option>
  <option value="true" <?php selected('true', $instance['kaya_portfolio_filter']) ?>>
  <?php _e('True', $lavan_plugin_name) ?>
  </option>
  </select>
  </p>
  <p class="one_fifth hide_filter_tabs">
    <label for="<?php echo $this->get_field_id('filter_tab_bg_color'); ?>"><?php _e('Filter Tab BG Color',$lavan_plugin_name) ?></label>
    <input type="text" name="<?php echo $this->get_field_name('filter_tab_bg_color') ?>" id="<?php echo $this->get_field_id('filter_tab_bg_color') ?>" class="portfolio_color_picker" value="<?php echo $instance['filter_tab_bg_color'] ?>" />
  </p>
  <p class="one_fifth hide_filter_tabs">
    <label for="<?php echo $this->get_field_id('filter_tab_text_color'); ?>"><?php _e('Filter Tab Text Color',
    $lavan_plugin_name) ?></label>
    <input type="text" name="<?php echo $this->get_field_name('filter_tab_text_color') ?>" id="<?php echo $this->get_field_id('filter_tab_text_color') ?>" class="portfolio_color_picker" value="<?php echo $instance['filter_tab_text_color'] ?>" />
  </p>
  <p class="one_fifth hide_filter_tabs">
    <label for="<?php echo $this->get_field_id('filter_tab_active_bg_color'); ?>"><?php _e('Filter Tab Acive BG Color',
    $lavan_plugin_name) ?></label>
    <input type="text" name="<?php echo $this->get_field_name('filter_tab_active_bg_color') ?>" id="<?php echo $this->get_field_id('filter_tab_active_bg_color') ?>" class="portfolio_color_picker" value="<?php echo $instance['filter_tab_active_bg_color'] ?>" />
  </p>
  <p class="one_fifth_last hide_filter_tabs">
    <label for="<?php echo $this->get_field_id('filter_tab_active_text_color'); ?>"><?php _e('Filter Tab Active Text Color',
    $lavan_plugin_name) ?></label>
    <input type="text" name="<?php echo $this->get_field_name('filter_tab_active_text_color') ?>" id="<?php echo $this->get_field_id('filter_tab_active_text_color') ?>" class="portfolio_color_picker" value="<?php echo $instance['filter_tab_active_text_color'] ?>" />
  </p>
</div>
<div class="input-elements-wrapper"> 
  <p>
    <label for="<?php echo $this->get_field_id('text_align') ?>">
    <?php _e('Title / Filters Tabs Position',$lavan_plugin_name)?>
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
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('pf_img_width') ?>">
    <?php _e('Image Width',$lavan_plugin_name)?>
    </label>
    <input type="text" class="small-text" id="<?php echo $this->get_field_id('pf_img_width') ?>" value="<?php echo esc_attr($instance['pf_img_width']) ?>" name="<?php echo $this->get_field_name('pf_img_width') ?>" />
    <small><?php _e('px',$lavan_plugin_name); ?></small>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('pf_img_height') ?>">
    <?php _e('Image Height',$lavan_plugin_name)?>
    </label>
    <input type="text" class="small-text" id="<?php echo $this->get_field_id('pf_img_height') ?>" value="<?php echo esc_attr($instance['pf_img_height']) ?>" name="<?php echo $this->get_field_name('pf_img_height') ?>" />
    <small><?php _e('px',$lavan_plugin_name); ?></small>
  </p>   
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('columns') ?>">
    <?php _e('Select Columns',$lavan_plugin_name)?>
    </label>
    <select id="<?php echo $this->get_field_id('columns') ?>" name="<?php echo $this->get_field_name('columns') ?>">
      <option value="5" <?php selected('5', $instance['columns']) ?>>
      <?php _e('Column5', $lavan_plugin_name) ?>
      </option>
      <option value="4" <?php selected('4', $instance['columns']) ?>>
      <?php _e('Column4', $lavan_plugin_name) ?>
      </option>
      <option value="3" <?php selected('3', $instance['columns']) ?>>
      <?php _e('Column3', $lavan_plugin_name)  ?>
      </option>
      <option value="2" <?php selected('2', $instance['columns']) ?>>
      <?php _e('Column2', $lavan_plugin_name) ?>
      </option>
    </select>
  </p>
</div>  
<div class="input-elements-wrapper">
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('pf_display_order') ?>">
    <?php _e('Order',$lavan_plugin_name)?>
    </label>
    <select id="<?php echo $this->get_field_id('pf_display_order') ?>" name="<?php echo $this->get_field_name
      ('pf_display_order') ?>">
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
    <select id="<?php echo $this->get_field_id('pf_display_orderby') ?>" name="<?php echo $this->get_field_name
      ('pf_display_orderby') ?>">
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
    ('post_title_bg_color') ?>" class="portfolio_color_picker" value="<?php echo $instance['post_title_bg_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('post_title_color'); ?>"><?php _e('Post Title Color',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('post_title_color') ?>" id="<?php echo $this->get_field_id
    ('post_title_color') ?>" class="portfolio_color_picker" value="<?php echo $instance['post_title_color'] ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('image_bg_hover_color'); ?>"> <?php _e('Image Hover BG Opacity Color',
    $lavan_plugin_name) ?>  </label>
    <input type="text" name="<?php echo $this->get_field_name('image_bg_hover_color') ?>" id="<?php echo $this->get_field_id
    ('image_bg_hover_color') ?>" class="portfolio_color_picker" value="<?php echo $instance['image_bg_hover_color'] ?>"
     />
  </p>
</div>
<div class="input-elements-wrapper">  
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('hide_lightbox_icon') ?>"><?php _e('Disable Lightbox icon',$lavan_plugin_name)?></label>&nbsp;
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("hide_lightbox_icon"); ?>" name="<?php echo 
    $this->get_field_name("hide_lightbox_icon"); ?>"<?php checked( (bool) $instance["hide_lightbox_icon"], true ); ?> />
  </p>
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('hide_post_link_icon') ?>"><?php _e('Disable Post Link icon',
    $lavan_plugin_name)?></label>&nbsp;
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("hide_post_link_icon"); ?>" name="<?php echo $this->get_field_name("hide_post_link_icon"); ?>"<?php checked( (bool) $instance["hide_post_link_icon"], true ); ?> />
  </p>
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('enable_image_link') ?>"><?php _e('Enable Image Link',$lavan_plugin_name)?>
    </label>&nbsp;
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("enable_image_link"); ?>" name="<?php echo 
    $this->get_field_name("enable_image_link"); ?>"<?php checked( (bool) $instance["enable_image_link"], true ); ?> />
  </p>
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('hide_post_title') ?>"><?php _e('Disable Post Title',$lavan_plugin_name)?>
    </label>&nbsp;
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("hide_post_title"); ?>" name="<?php echo 
    $this->get_field_name("hide_post_title"); ?>"<?php checked( (bool) $instance["hide_post_title"], true ); ?> />
  </p>
  <p class="one_fifth_last">
    <label for="<?php echo $this->get_field_id('disable_pagination') ?>">
    <?php _e('Disable Pagination',$lavan_plugin_name)?>
    </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_pagination"); ?>" name="<?php echo 
    $this->get_field_name("disable_pagination"); ?>"<?php checked( (bool) $instance["disable_pagination"], true ); ?> />
  </p>
</div>
<div class="input-elements-wrapper">  
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('fluid_pf_gallery') ?>">
      <?php _e('Full Width Portfolio Gallery ',$lavan_plugin_name)?></label>&nbsp;
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("fluid_pf_gallery"); ?>" name="<?php echo 
      $this->get_field_name("fluid_pf_gallery"); ?>"<?php checked( (bool) $instance["fluid_pf_gallery"], true ); ?> /><br/>
      <small><?php _e('Note: It works only in fluid layout mode',$lavan_plugin_name)?></small>
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('Popular_post_display') ?>">
    <?php _e('Popular Posts',$lavan_plugin_name)?></label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("Popular_post_display"); ?>" name=
    "<?php echo $this->get_field_name("Popular_post_display"); ?>"<?php checked( (bool) $instance["Popular_post_display"], true ); ?> />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('portfolio_limit') ?>">
    <?php _e('Display Number of Images',$lavan_plugin_name)?>
    </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('portfolio_limit') ?>" value="<?php echo esc_attr($instance['portfolio_limit']) ?>" name="<?php echo $this->get_field_name('portfolio_limit') ?>" />
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
 lavan_kaya_register_widgets('portfolio-widget',__FILE__);
?>