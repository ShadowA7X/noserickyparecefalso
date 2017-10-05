<?php
// global variables
global $more;
$more='0';
$kaya_options = get_option('kayapati');
$kaya_readmore_blog= get_theme_mod('kaya_readmore_blog') ? get_theme_mod('kaya_readmore_blog') : __('Read More', 'lavan');

 while ( have_posts() ) : the_post();
 ?>
  <!-- Start While Loop here -->
  <article <?php post_class('standard-blog'); ?> >
   <div class="blog_post_info"> 
    <div class="blog_date">
         <h3><?php echo get_the_date('d/m ')?></h3>
    </div>
    <div class="blog_post description">
      <h4>
        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'lavan' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
        <?php the_title(); ?>
        </a>
      </h4>
      <span class="meta_desc">
        <span class="author"><?php _e('By ','lavan') ?>  <?php the_author_posts_link(); ?></span> - 
        <span class="category"><?php the_category(', '); ?></span> - 
        <span class="comments"><?php comments_popup_link(__('Leave a comment','lavan' ), __( '1', 'lavan' ), __( '%', 'lavan' ) ); ?></span> 
        <?php echo '</span>'; ?>
    </div>
  </div>
  <?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
      echo '<div class="blog_img  ">';
        echo '<a href="'.get_permalink().'">';
        if( (get_post_meta( $post->ID, 'kaya_image_streatch', true )) == "0") {
         $params = array('width' => '1100', 'height' => '450', 'crop' => true);
        }else{
           $params = array('width' => '', 'height' => '', 'crop' => true);
        }
          $img_url=wp_get_attachment_url( get_post_thumbnail_id() );
          echo kaya_imageresize($img_url,$params,'');
        echo '</a>'; ?>
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
            '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus"> </i> Google+</a></li>
            <li>
              <a rel="nofollow" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(the_title('','', false)) ?>&amp;source=<?php bloginfo('pingback_url'); ?>&amp;ary=<?php the_excerpt(); ?>" title="LinkedIn"><i class="fa fa-linkedin"> </i> Linkedin</a>
            </li>
          </ul>
       </div>
        </div>
        </div>
      <?php }   ?>
   <?php  echo the_content($kaya_readmore_blog,''); 
   
    //} ?><!-- If No Featured Image -->
   <div class="clear"> </div>
   <!--<a class="readmore readmore-1" href="<?php the_permalink(); ?>"><?php echo $kaya_readmore_blog; ?></a>
     #post-## -->
  </article>
  <?php  // Comment Section
  $commentsection = get_post_meta( $post->ID, 'commentsection', true );
  if( $commentsection != "on") {
    comments_template( '', true );
  } ?>
  <?php endwhile; // End the loop. While. ?>
  <?php /* Display navigation to next/previous pages when applicable */ ?>
  <?php echo kaya_pagination(); ?>
