<?php
// Blog Widget

 class Lavan_Blog_News_Widget extends WP_Widget{
   public function __construct(){
   global $lavan_plugin_name; 
   parent::__construct(  'kaya-blog-news',
      __('Lavan - Recent News (PB)',$lavan_plugin_name),
      array( 'description' => __('Displays news items',$lavan_plugin_name), 'class' => 'kaya_blog_news_widget' )
    );
    }

    public function widget( $args , $instance ){
    global $lavan_plugin_name;  
        $instance = wp_parse_args($instance, array(
          
          'blog_news_limit' => '2',
          'news_widget_category' => '',
          'title' => '',
          'title_color' => '',
          'text_align' => __('left', $lavan_plugin_name),
          'blog_news_date_color' => '#DB0007',
          'blog_news_posts_title_color' => '#ffffff',
          'news_post_desc_color' => '#757575',
          'disable_pagination' => '',
          'animation_names'  => '',

             )); ?>
<?php //echo $args['before_widget'];

        //echo '<div class= "cbp-so-section">';
echo '<div class="wow '.$instance['animation_names'].' ">';
    if( $instance['title'] ):

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
<?php endif; 
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  
        $args = array('paged' => $paged, 'post_type' => 'post', 'orderby' => '', 'order' => 'DESC', 'posts_per_page' => $instance['blog_news_limit'], 'cat' =>  $instance['news_widget_category']);
     //  $args = array('paged' => $paged, 'post_type' => 'post', 'orderby' => 'date', 'posts_per_page' =>$instance['blog_news_limit'],'order' => 'DESC', 'category_name' => $instance['news_widget_category'] );

        query_posts($args); 
           if(have_posts() ) : while( have_posts() ) : the_post();
            echo '<div class="blog_news">';
            echo '<div class="news_info">';
            echo '<span class="news_date" style="color:'.$instance['blog_news_date_color'].'">';
            echo the_time( get_option( 'date_format' ) );
            echo '</span>';
            echo '<span class="news_title description" ><a href="'.get_permalink().'" style="color:'.$instance['blog_news_posts_title_color'].'">';
            echo the_title();
            echo '</a></span>';
            echo '</div>';
            echo '<p style="color:'.$instance['news_post_desc_color'].'">'.lavan_content(20).'</p>';
              echo '</div>';
              endwhile;
              endif;
                if( $instance['disable_pagination'] != 'on'){
                    echo kaya_pagination();    
                 }
                wp_reset_query();
               echo '<div class="clear">';?>
              <?php echo '</div>,</div>'; 
              // echo '</div>';

        // echo $args['after_widget'];

    }

    public function form( $instance ){
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

        $instance = wp_parse_args( $instance, array(

          'blog_news_limit' => '2',
          'news_widget_category' => implode(',', $blog_cat_id),
          'title' => '',
          'title_color' => '',
          'text_align' => __('left', $lavan_plugin_name),
          'blog_news_date_color' => '#DB0007',
          'blog_news_posts_title_color' => '#ffffff',
          'news_post_desc_color' => '#757575',
          'disable_pagination' => '',
          'animation_names'  => '',

        ) );

        ?>
        <script type="text/javascript">
        (function($){
          "use strict";
          $('.blog_news_color_picker').each(function(){
          $(this).wpColorPicker();  
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
    <input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="blog_news_color_picker" value="<?php echo $instance['title_color'] ?>" />
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
  <label for="<?php echo $this->get_field_id('news_widget_category') ?>"> <?php _e('Select News Category',$lavan_plugin_name) ?> </label>
  <input type="text" name="<?php echo $this->get_field_name('news_widget_category') ?>" id="<?php echo $this->get_field_id('news_widget_category') ?>" class="widefat" value="<?php echo $instance['news_widget_category'] ?>" />
  <em><strong style="color:green;"><?php _e('Available Categories and IDs : ',$lavan_plugin_name); ?> </strong> <?php echo implode(', ', $blog_cat_name); ?></em><br />
  <stong><?php _e('Note:',$lavan_plugin_name); ?></strong><?php _e('Separate IDs with commas only',$lavan_plugin_name); ?>
</p>
</div>
<div class="input-elements-wrapper"> 
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('blog_news_date_color') ?>">
    <?php _e('News Date Color',$lavan_plugin_name)?>
    </label>
    <input type="text" class="blog_news_color_picker" id="<?php echo $this->get_field_id('blog_news_date_color') ?>" value="<?php echo esc_attr($instance['blog_news_date_color']) ?>" name="<?php echo $this->get_field_name('blog_news_date_color') ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('blog_news_posts_title_color') ?>">
    <?php _e('News Posts Title Color',$lavan_plugin_name)?>
    </label>
    <input type="text" class="blog_news_color_picker" id="<?php echo $this->get_field_id('blog_news_posts_title_color') ?>" value="<?php echo esc_attr($instance['blog_news_posts_title_color']) ?>" name="<?php echo $this->get_field_name('blog_news_posts_title_color') ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('news_post_desc_color') ?>">
    <?php _e('News Posts Description Color',$lavan_plugin_name)?>
    </label>
    <input type="text" class="blog_news_color_picker" id="<?php echo $this->get_field_id('news_post_desc_color') ?>" value="<?php echo esc_attr($instance['news_post_desc_color']) ?>" name="<?php echo $this->get_field_name('news_post_desc_color') ?>" />
  </p>
</div>
<div class="input-elements-wrapper"> 
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('blog_news_limit') ?>">
    <?php _e('Display Number of News Items',$lavan_plugin_name)?>
    </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('blog_news_limit') ?>" value="<?php echo esc_attr($instance['blog_news_limit']) ?>" name="<?php echo $this->get_field_name('blog_news_limit') ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('disable_pagination') ?>">
    <?php _e('Disable Pagination',$lavan_plugin_name)?>
    </label>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_pagination"); ?>" name="<?php echo $this->get_field_name("disable_pagination"); ?>"<?php checked( (bool) $instance["disable_pagination"], true ); ?> />
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
 lavan_kaya_register_widgets('blog-news-widget',__FILE__);
?>