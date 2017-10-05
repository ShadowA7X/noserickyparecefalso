<?php
// Recent Blog post
 class Lavan_Recent_Blog_Widget extends WP_Widget{
    public function __construct(){
    global $lavan_plugin_name;  
        parent::__construct('kaya-recent-blog-post-widget',
            __('Lavan-Recent Blog Posts(PB)',$lavan_plugin_name),
            array('description' => __('Displays Recent blog items',$lavan_plugin_name), 'class' => 'recent_blog_post_widget')
        );
    }

  public function widget( $args, $instance ) {
      //echo $args['before_widget'];
      global $lavan_plugin_name;
      global $post;
      $instance=wp_parse_args($instance, array(
         'title' => __('Recent From Blog',$lavan_plugin_name),
         'description' => '',
         'columns' => '4',
         'readmore_text' => __('Read More',$lavan_plugin_name),
          'text_align'   => __('left',$lavan_plugin_name),
         'title_color' => '#343434',
         'desc_color' => '#666666',
         'limit' => '2',
         'recent_blog_post' => '',
        'recent_blog_title_color' => '#343434',
        'recent_blog_desc_color' => '#757575',
        'recent_blog_date_color' => '#DB0007',
        'disable_description' => '',
        'disable_date' => '',
         'post_content_limit' => '8',
         'disable_comment' => '',
         'recent_blog_comment_color' => '#DB0007',
         'disable_pagination' => '',
         'animation_names'  => '',

      ));

         ?>
<div class="recent_blog_post wow <?php echo $instance['animation_names']; ?>">
  <?php   if( $instance['title'] ):

          if( $instance['text_align'] =='left'){ $plus_icon = 'right';}elseif( $instance['text_align'] =='right'){ $plus_icon = 'left';}else{ $plus_icon='right'; $plus_icon_left ="left"; }

          echo '<div class="portfolio_title custom_title kaya_title_'.$instance['text_align'].'">';
        echo  '<h3 style="text-align:'.$instance['text_align'].'; color:'.$instance['title_color'].'!important;">'.$instance['title'].'</h3>';
        if( $instance['text_align'] =='center'){ 
        echo '<i class="fa fa-plus" style="float: '.$plus_icon_left.'; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i>';

              }
         echo '<i class="fa fa-plus" style="float: '.$plus_icon.'; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i>';
       echo '</div>';
      ?>
  <div class="clear"> </div>
  <?php endif; ?>
  <ul>
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  
        $args = array('paged' => $paged, 'post_type' => 'post', 'orderby' => '', 'order' => 'DESC', 'posts_per_page' => $instance['limit'], 'cat' =>  $instance['recent_blog_post']);
        query_posts($args); 
           if(have_posts() ) : while( have_posts() ) : the_post();
        ?>
    <li>
      <?php  
        $comment_rand = rand(1,20); ?>
        <style>
          .comment_color-<?php echo $comment_rand; ?> a{
            color:<?php echo $instance['recent_blog_comment_color']; ?>!important;
          }
        </style>
      <?php

        $img_url = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
      <a href="<?php echo the_permalink(); ?>" >
      <?php if( $img_url ){
           echo '<img src="'.kaya_image_resize( $img_url, 60, 60, true ).'" class="alignleft" alt="'.$instance['title'].'" />';  
        } 
        else{
          echo '<img src="'.get_template_directory_uri().'/images/recent_blog_default_img.jpg" class="alignleft">';
        } 
        echo '</a>';
        ?>
      <div class="description">
        <h5 style="color:<?php echo $instance['recent_blog_title_color']; ?>">
          <?php the_title(); ?>
        </h5>
        <?php if( $instance['disable_date'] != '1' && $instance['disable_date'] != 'on') : ?>
        <span style="color:<?php echo $instance['recent_blog_date_color']; ?>"><?php echo the_time( get_option( 'date_format' ) ); ?> </span><br />
        <?php endif; ?>
        <?php if( $instance['disable_description'] != '1' && $instance['disable_description'] != 'on') : ?>
        <span style="color:<?php echo $instance['recent_blog_desc_color']; ?>">
        <?php  echo strip_tags(lavan_content($instance['post_content_limit'])); ?>
        </span><br />
        <?php endif; ?>
        <?php if( $instance['disable_comment'] != '1' && $instance['disable_comment'] != 'on') : ?>
            <span  class="comment_color-<?php echo $comment_rand; ?>"><?php comments_popup_link(__('0 Comments',
            $lavan_plugin_name ), __( '1 Comment', $lavan_plugin_name ), __( '% Comments', $lavan_plugin_name ) ); ?></span>
        <?php endif; ?>
      </div>
    </li>
    <?php endwhile; endif; ?>
  </ul>

  <?php //wp_reset_query(); 
  if( $instance['disable_pagination'] != 'on'){
          echo kaya_pagination();    
       }
 ?>
</div>
  <?php   ?>
<?php
    wp_reset_query();
    }

    public function form($instance){
    global $lavan_plugin_name;  
         $blog_categories = get_categories('hide_empty=0');
    if( $blog_categories ){
        foreach ($blog_categories as $category) {
               $blog_cat_name[] = $category->name.'-'.$category->cat_ID;
                $blog_cat_id[] = $category->cat_ID;  
      } } else{   
          $blog_cat_id[] = '';
          $blog_cat_name[] ='';
      }
        $instance = wp_parse_args($instance, array(
           'title' => __('Recent From Blog',$lavan_plugin_name),
           'description' => '',
           'columns'  => '4',
            'readmore_text' => __('Read More',$lavan_plugin_name),
            'text_align'   => __('left',$lavan_plugin_name),
            'title_color' => '#343434',
            'desc_color' => '#666666',
            'limit' => '2',
            'recent_blog_post' => implode(',', $blog_cat_id),
            'recent_blog_title_color' => '#343434',
            'recent_blog_desc_color' => '#757575',
            'recent_blog_date_color' => '#DB0007',
            'disable_description' => '',
            'disable_date' => '',
            'post_content_limit' => '8',
            'disable_comment' => '',
            'recent_blog_comment_color' => '#DB0007 ',
            'hide_post_link_icon' => '',
           'hide_lightbox_icon' => '',
           'disable_pagination' => '',
           'animation_names'  => '',

       ) ); ?>
<script type="text/javascript">
  (function($){
    "use strict";
  $('.recent_blog_post_color_picker').each(function(){
  $(this).wpColorPicker();  
  });
  })(jQuery);
</script>       
<div class="input-elements-wrapper">       
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e('Title',$lavan_plugin_name); ?>
    </label>
    <input type="text" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']) ?>" name="<?php echo $this->get_field_name('title') ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('title_color'); ?>">
    <?php _e('Title Color',$lavan_plugin_name) ?>
    </label>
    <input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="recent_blog_post_color_picker" value="<?php echo $instance['title_color'] ?>" />
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
  <label for="<?php echo $this->get_field_id('recent_blog_post') ?>">
  <?php _e('Select Blog Category IDs',$lavan_plugin_name) ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('recent_blog_post') ?>" id="<?php echo $this->get_field_id('recent_blog_post') ?>" class="widefat" value="<?php echo $instance['recent_blog_post'] ?>" />
  <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',$lavan_plugin_name); ?> </strong> <?php echo implode(', ', $blog_cat_name); ?></em><br />
  <stong><?php _e('Note:',$lavan_plugin_name); ?></strong><?php _e('Separate IDs with commas only',$lavan_plugin_name); ?>
  </p>
</div>
<div class="input-elements-wrapper">     
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('post_content_limit') ?>">
    <?php _e('Posts Content Limit',$lavan_plugin_name)?>
    </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('post_content_limit') ?>" value="<?php echo esc_attr($instance['post_content_limit']) ?>" name="<?php echo $this->get_field_name('post_content_limit') ?>" />
  </p>
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('recent_blog_title_color') ?>">
    <?php _e('Posts Title Color',$lavan_plugin_name)?>
    </label>
    <input type="text" class="recent_blog_post_color_picker" id="<?php echo $this->get_field_id('recent_blog_title_color') ?>" value="<?php echo esc_attr($instance['recent_blog_title_color']) ?>" name="<?php echo $this->get_field_name('recent_blog_title_color') ?>" />
  </p>
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('recent_blog_date_color') ?>">
    <?php _e('Posts Date Color',$lavan_plugin_name)?>
    </label>
    <input type="text" class="recent_blog_post_color_picker" id="<?php echo $this->get_field_id('recent_blog_date_color') ?>" value="<?php echo esc_attr($instance['recent_blog_date_color']) ?>" name="<?php echo $this->get_field_name('recent_blog_date_color') ?>"
    />
  </p>
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('recent_blog_desc_color') ?>">
    <?php _e('Posts Description Color',$lavan_plugin_name)?>
    </label>
    <input type="text" class="recent_blog_post_color_picker" id="<?php echo $this->get_field_id('recent_blog_desc_color') ?>" value="<?php echo esc_attr($instance['recent_blog_desc_color']) ?>" name="<?php echo $this->get_field_name('recent_blog_desc_color') ?>"
    />
  </p>
  <p class="one_fifth_last">
  <label for="<?php echo $this->get_field_id('recent_blog_comment_color') ?>">
  <?php _e('Posts Comment Color',$lavan_plugin_name)?>
  </label>
  <input type="text" class="recent_blog_post_color_picker" id="<?php echo $this->get_field_id('recent_blog_comment_color') ?>" value="<?php echo esc_attr($instance['recent_blog_comment_color']) ?>" name="<?php echo $this->get_field_name('recent_blog_comment_color') ?>" />
  </p>
</div> 
<div class="input-elements-wrapper"> 
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('limit') ?>">
    <?php _e('Display Number of Posts',$lavan_plugin_name)?>
    </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('limit') ?>" value="<?php echo esc_attr($instance['limit']) ?>" name="<?php echo $this->get_field_name('limit') ?>" />
  </p>
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('disable_pagination') ?>">
    <?php _e('Disable Pagination',$lavan_plugin_name)?>
    </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_pagination"); ?>" name="<?php echo $this->get_field_name("disable_pagination"); ?>"<?php checked( (bool) $instance["disable_pagination"], true ); ?> />
  </p>
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('disable_date') ?>">
    <?php _e('Disable Date',$lavan_plugin_name)?>
    </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_date"); ?>" name="<?php echo $this->get_field_name("disable_date"); ?>"<?php checked( (bool) $instance["disable_date"], true ); ?> />
  </p>
  <p class="one_fifth">
    <label for="<?php echo $this->get_field_id('disable_description') ?>">
    <?php _e('Disable Description',$lavan_plugin_name)?>
    </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_description"); ?>" name="<?php echo $this->get_field_name("disable_description"); ?>"<?php checked( (bool) $instance["disable_description"], true ); ?> />
  </p>
  <p class="one_fifth_last">
    <label for="<?php echo $this->get_field_id('disable_comment') ?>">
    <?php _e('Disable Comment',$lavan_plugin_name)?>
    </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_comment"); ?>" name="<?php echo 
    $this->get_field_name("disable_comment"); ?>"<?php checked( (bool) $instance["disable_comment"], true ); ?> />
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
 lavan_kaya_register_widgets('recent-blog-widget',__FILE__);
?>