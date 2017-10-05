<?php
// Blog Widget
 class Lavan_Blog_Widget extends WP_Widget{
   public function __construct(){
   global $lavan_plugin_name; 	
   parent::__construct(  'kaya-lavan-blog',
         ucfirst($lavan_plugin_name).' '.__(' - Blog',$lavan_plugin_name).'&nbsp;<a class="widget_video_tutorials" target="_blank" href="https://youtu.be/VSOGpGqQ32M">'.__('Watch this video', $lavan_plugin_name).'</a>',
      array( 'description' => __('Use this widget to create blog page',$lavan_plugin_name) ,'class' => 'kaya_blog' )
    );
    }
    public function widget( $args , $instance ){
     //echo $args['before_widget'];
    global $lavan_plugin_name;	
        $instance = wp_parse_args($instance, array(
            'content_limit' => '30',
            'post_limit' => '10',
            'blog_category' => '',
            'title_color' => '#333333',
            'content_color' => '#aaaaaa',
            'posts_link_color' => '#DB0007',
            'posts_link_hover_color' => '#333',
            'disable_pagination' => '',
            'disable_readmore_button' => '',
            'blog_posts_order_by' => '',
            'blog_posts_order' => '',
            'readmore_button_text' => __('Read More', $lavan_plugin_name),
            'animation_names'  => '',
            'disable_shareicons' => '',
         ) ); ?>
        <style type="text/css">
          #mid_container .blog_post_wrapper .meta_desc a, #mid_container  .meta_desc .blog_post h4 a{
            color: <?php echo $instance['posts_link_color']; ?>
          }
          #mid_container .blog_post_wrapper .meta_desc a:hover{
            color: <?php echo $instance['posts_link_hover_color']; ?>
          }
          #mid_container .blog_post_wrapper p,  #content_wrapper .blog_post_wrapper{
            color: <?php echo $instance['content_color']; ?>
          }           
        </style>

        <?php echo '<div class="blog_post_wrapper wow '.$instance['animation_names'].'">';
        global $post;
          $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $args = array(
               'cat' =>  $instance['blog_category'],
               'post_type' => 'post',
               'posts_per_page' => $instance['post_limit'],
               'paged' => $page,
                'orderby' => $instance['blog_posts_order_by'], 
                'order' => $instance['blog_posts_order'], 
               );
      query_posts($args);
      if(have_posts() ) : while( have_posts() ) : the_post(); 
      $class="two_third_last";
      ?>
        <article <?php post_class('standard-blog'); ?> >


     <div class="blog_post_info"> 
    <div class="blog_date">
         <h3><?php echo the_time( get_option( 'date_format' ) ); ?></h3>
    </div>
<div class="blog_post description">
<h4>
<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', $lavan_plugin_name ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
<?php the_title(); ?>
</a>
</h4>
<span class="meta_desc">
<span class="author"><?php _e('By ',$lavan_plugin_name) ?>  <?php the_author_posts_link(); ?></span> - 
<span class="category"><?php the_category(', '); ?></span> - 
<span class="comments"><?php comments_popup_link(__('Leave a comment',$lavan_plugin_name ), __( '1', 
$lavan_plugin_name ), __( '%', $lavan_plugin_name ) ); ?></span> 
<?php echo '</span>'; ?>
</div>
</div>
<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
echo '<div class="blog_img">';
echo '<a href="'.get_permalink().'">';
if( (get_post_meta( $post->ID, 'kaya_image_streatch', true )) == "0") {
$params = array('width' => '1100', 'height' => '450', 'crop' => true);
}else{
$params = array('width' => '', 'height' => '', 'crop' => true);
}
$img_url=wp_get_attachment_url( get_post_thumbnail_id() );
echo kaya_imageresize($img_url,$params,'');
echo '</a>'; 
	if($instance['disable_shareicons'] !="on") { ?>	
	<div class="blog_post_share">
	<span class="post_share">Share
	<i class="fa fa-hand-o-down"> </i> </span>
	<div class="social_sharing_list">
		<ul>
			<li>
			<a href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php the_title(); ?>&amp;p[summary]=<?php the_excerpt(); ?>&amp;p[url]=<?php the_permalink(); ?>&amp;p[images][0]=http://demo.kayapati.com/lavan/wp-content/uploads/sites/17/2014/01/img_011.jpg" onclick="window.open(this.href, 'mywin',
			'left=20,top=20,width=500,height=350,toolbar=1,resizable=1'); return false;" ><i class="fa fa-facebook "> </i>Facebook</a>
			</li>
			<li>
			<a href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_excerpt();  ?> - <?php the_permalink(); ?>" onclick="window.open(this.href, 'mywin',
			'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" ><i class="fa fa-twitter "> </i>Twitter</a>
			</li>
			<li>
			<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>?desc=<?php the_title(); ?>" onclick="javascript:window.open(this.href,
			'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus"> </i> Google+</a>
			</li>
			<li>
			<a rel="nofollow" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(the_title('','', false)) ?>&amp;source=<?php bloginfo('pingback_url'); ?>&amp;ary=<?php the_excerpt(); ?>" title="LinkedIn"><i class="fa fa-linkedin"> </i> Linkedin</a>
			</li>
		</ul>
	</div>
	</div>
<?php } ?>
</div>
      <?php }   ?>
      <?php if( $instance['disable_readmore_button'] != 'on') : ?>
      <?php if(has_excerpt () ) : ?>
     <?php  the_excerpt(); ?>
 <?php else: ?>
        <p><?php echo trim( strip_tags( lavan_content($instance['content_limit']) ) ); ?></p>
    <?php endif; ?>
        <?php endif; ?>

            <?php if( $instance['disable_readmore_button'] == 'on') : ?>
        <?php echo the_content(); ?>
        <?php endif; ?>

        <?php if( $instance['disable_readmore_button'] != 'on') : ?>
        <a href="<?php echo the_permalink(); ?>" class="readmore blog_read_more"><?php echo $instance['readmore_button_text'] ?></a>
        <?php endif; ?>
   
   <?php  //} ?><!-- If No Featured Image -->
   <div class="clear"> </div>
   <!--<a class="readmore readmore-1" href="<?php the_permalink(); ?>"><?php echo $kaya_readmore_blog; ?></a>
     #post-## -->
  </article>
      <?php endwhile; endif; 
      if( $instance['disable_pagination'] != 'on' ){
         echo kaya_pagination(); 
      }
       wp_reset_query(); ?>

    </div>
    <div class="clear"></div>
    <?php  //echo $args['after_widget']; 
   ?>
    <?php }
public function form( $instance ){
global $lavan_plugin_name;	
   $blog_categories = get_categories('hide_empty=0');
    if( $blog_categories ){
        foreach ($blog_categories as $category) {
               $blog_cat_name[] = $category->name .' - '.$category->cat_ID;
               $blog_cat_id[] = $category->cat_ID;
      } } else{   
          $blog_cat_id[] = '';
          $blog_cat_name[] = '';
      }
    $instance = wp_parse_args( $instance, array(
        'content_limit' => '30',
        'post_limit' => '10',
        'blog_category' => implode(',',$blog_cat_id),
        'title_color' => '#333333',
        'content_color' => '#aaaaaa',
        'posts_link_color' => '#DB0007',
        'posts_link_hover_color' => '#333',
        'disable_pagination' => '',
        'disable_readmore_button' => '',
        'blog_posts_order_by' => '',
        'blog_posts_order' => '',
        'readmore_button_text' => __('Read More', $lavan_plugin_name),
        'animation_names'  => '',
        'disable_shareicons' => '',

             ) );  ?>
<script type="text/javascript">
(function($){
"use strict";
$('.blog_color_picker').each(function(){
$(this).wpColorPicker();	
});	
})(jQuery);
</script>
<div class="input-elements-wrapper">     
	<p>
		<label for="<?php echo $this->get_field_id('blog_category') ?>">
		<?php _e('Enter Blog Category IDs : ',$lavan_plugin_name) ?>
		</label>
		<input type="text" name="<?php echo $this->get_field_name('blog_category') ?>" id="<?php echo $this->get_field_id
		('blog_category') ?>" class="widefat" value="<?php echo $instance['blog_category'] ?>" />
		<em><strong style="color:green;"><?php _e('Available Categories and IDs : ',$lavan_plugin_name); ?> </strong> 
		<?php echo implode(', ', $blog_cat_name); ?></em><br />
		<stong><?php _e('Note:',$lavan_plugin_name); ?></strong><?php _e('Separate IDs with commas only',$lavan_plugin_name); ?>
	</p>
</div>
<div class="input-elements-wrapper">
	<p class="one_fourth">
		<label for="<?php echo $this->get_field_id('blog_posts_order') ?>"><?php _e('Order',$lavan_plugin_name)?></label>
		<select id="<?php echo $this->get_field_id('blog_posts_order') ?>" name="<?php echo $this->get_field_name
			('blog_posts_order') ?>">
			<option value="DESC" <?php selected('DESC', $instance['blog_posts_order']) ?>>
			<?php _e('Descending', $lavan_plugin_name) ?></option> 
			<option value="ASC" <?php selected('ASC', $instance['blog_posts_order']) ?>>
			<?php _e('Ascending', $lavan_plugin_name) ?></option>
		</select>
	</p>  	
	<p class="one_fourth">
		<label for="<?php echo $this->get_field_id('blog_posts_order_by') ?>"><?php _e('Orderby',$lavan_plugin_name)?>
		</label>
		<select id="<?php echo $this->get_field_id('blog_posts_order_by') ?>" name="<?php echo $this->get_field_name
			('blog_posts_order_by') ?>">
			<option value="date" <?php selected('date', $instance['blog_posts_order_by']) ?>>
			<?php _e('Date', $lavan_plugin_name) ?></option>
			<option value="menu_order" <?php selected('menu_order', $instance['blog_posts_order_by']) ?>>
			<?php _e('Menu Order', $lavan_plugin_name) ?></option>
			<option value="title" <?php selected('title', $instance['blog_posts_order_by']) ?>>
			<?php _e('Title', $lavan_plugin_name) ?></option>
			<option value="rand" <?php selected('rand', $instance['blog_posts_order_by']) ?>>
			<?php _e('Random', $lavan_plugin_name) ?></option>
			<option value="author" <?php selected('author', $instance['blog_posts_order_by']) ?>>
			<?php _e('Author', $lavan_plugin_name) ?></option>
		</select>
	</p>
</div>
<div class="input-elements-wrapper">
	<p class="one_fourth">
		<label for="<?php echo $this->get_field_id('content_color') ?>"><?php _e('Posts Content Color',
		$lavan_plugin_name)?></label>
		<input type="text" class="blog_color_picker" id="<?php echo $this->get_field_id('content_color') ?>" name="<?php echo $this->get_field_name('content_color') ?>" value="<?php echo $instance['content_color']; ?>" />
	</p>
	<p class="one_fourth">
		<label for="<?php echo $this->get_field_id('posts_link_color') ?>"><?php _e('Posts Link Color',
		$lavan_plugin_name)?></label>
		<input type="text" class="blog_color_picker" id="<?php echo $this->get_field_id('posts_link_color') ?>" name="<?php echo $this->get_field_name('posts_link_color') ?>" value="<?php echo $instance['posts_link_color']; ?>" />
	</p>
	<p class="one_fourth">
		<label for="<?php echo $this->get_field_id('posts_link_hover_color') ?>"><?php _e('Posts Link Hover Color',
		$lavan_plugin_name)?></label>
		<input type="text" class="blog_color_picker" id="<?php echo $this->get_field_id('posts_link_hover_color') ?>" 
		name="<?php echo $this->get_field_name('posts_link_hover_color') ?>" value="<?php echo $instance
		['posts_link_hover_color']; ?>" />
	</p>	
	<p class="one_fourth_last">
		<label for="<?php echo $this->get_field_id('content_limit') ?>"><?php _e('Post Content Limit',$lavan_plugin_name)?>
		</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('content_limit') ?>" name="<?php echo $this->get_field_name('content_limit') ?>" value="<?php echo $instance['content_limit']; ?>" />
	</p>
</div>
<div class="input-elements-wrapper">	
	<p class="one_fifth">
		<label for="<?php echo $this->get_field_id('readmore_button_text') ?>"><?php _e('Readmore Button Text',
		$lavan_plugin_name)?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('readmore_button_text') ?>" name="<?php echo $this->get_field_name('readmore_button_text') ?>" value="<?php echo $instance['readmore_button_text']; ?>" />
	</p>
	<p class="one_fifth">
		<label for="<?php echo $this->get_field_id('post_limit') ?>"><?php _e('Display Posts Per Page',
		$lavan_plugin_name)?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('post_limit') ?>" name="<?php echo $this->get_field_name('post_limit') ?>" value="<?php echo $instance['post_limit']; ?>" />
	</p>
	<p class="one_fifth">
		<label for="<?php echo $this->get_field_id('disable_pagination') ?>"> <?php _e('Disable Pagination',
		$lavan_plugin_name) ?> </label>
		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_pagination"); ?>" name="<?php echo $this->get_field_name("disable_pagination"); ?>"<?php checked( (bool) $instance["disable_pagination"], true ); ?> />
	</p>
	<p class="one_fifth">
	<label for="<?php echo $this->get_field_id('disable_readmore_button') ?>">
	<?php _e('Disable Readmore Button', $lavan_plugin_name)?>
	</label>
	<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_readmore_button"); ?>" name="<?php echo $this->get_field_name("disable_readmore_button"); ?>"<?php checked( (bool) $instance["disable_readmore_button"], true ); ?> />
	</p>

	 <p class="one_fifth_last">
	<label for="<?php echo $this->get_field_id('disable_shareicons') ?>">
	<?php _e('Disable Share Icons', $lavan_plugin_name)?>
	</label>
	<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_shareicons"); ?>" name="<?php echo $this->get_field_name("disable_shareicons"); ?>"<?php checked( (bool) $instance["disable_shareicons"], true ); ?> />
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
 lavan_kaya_register_widgets('blog-widget',__FILE__);
?>