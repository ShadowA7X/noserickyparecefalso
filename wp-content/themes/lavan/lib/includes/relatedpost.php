<?php
function kaya_relatedpost($postid)
{	
$options=get_option('kayapati');
global $post;
$kaya_readmore_portfolio=$options['kaya_readmore_portfolio'] ? $options['kaya_readmore_portfolio'] : 'Read More';
$tags = wp_get_post_tags($postid);
if ($tags) {
$tag_ids = array();
foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

$args=array(
'tag__in' => $tag_ids,
'post_type' => 'portfolio',
'post__not_in' => array($postid),
'showposts'=>-1,  // Number of related posts that will be shown.
'ignore_sticky_posts'=>1
);  
$pf_related_post_scroll=get_theme_mod('pf_related_post_scroll') ? get_theme_mod('pf_related_post_scroll'):'true';
?>
<script type="text/javascript">
(function( $ ) {
       "use strict";
       $(function() {
	 $("#related_slider").owlCarousel({
                navigation : false,
                autoPlay : <?php echo $pf_related_post_scroll; ?>,
                stopOnHover : true,
                responsive: {
                  0:{
                      items:1,
                      },
                      480:{
                          items:1,
                      },
                      768:{
                          items:2,
                          loop : false,
                      },
                      1024:{
                          items:4,
                          loop : true,
                      },
                }, 
              });

	       });
    })(jQuery);
</script>
<?php
$my_query = new wp_query($args);
$kaya_related_projects_text=get_theme_mod('pf_related_post_title') ? get_theme_mod('pf_related_post_title'):'Related Projects';
$pf_related_images_height=get_theme_mod('pf_related_images_height') ? get_theme_mod('pf_related_images_height'):'500';
$related_posts_title_color =  get_theme_mod('related_posts_title_color') ? get_theme_mod('related_posts_title_color') :'#fff';
$related_posts_title_bg_color =  get_theme_mod('related_posts_title_bg_color') ? get_theme_mod('related_posts_title_bg_color') :'#FF0000';
echo '<div class="vspace"> </div>';
if( $my_query->have_posts() ) {
	 echo '<i class="fa fa-plus" style="float: left; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i><span class="custom_hr"> </span><i class="fa fa-plus" style="float: right; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i>';
 echo '<span class="custom_hr"> </span>';
	echo '<div class="vspace"> </div>';
		echo '<div id="relatedposts">';
		echo '<span class="relatedpost_title">';
	echo '<h3>'.$kaya_related_projects_text.'</h3>
	<i class="fa fa-plus" style="float: right; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i>
	</span>';

		echo '<div class="portfolio_extra"><div id="related_slider" class="">';
			while ($my_query->have_posts()) {
				$my_query->the_post();
				$imgurl=wp_get_attachment_url( get_post_thumbnail_id() );
						$pf_lightbox =  $imgurl ? $imgurl : get_template_directory_uri().'/images/defult_featured_img.png';
						$video_url= get_post_meta($post->ID,'video_url',true);
				        $lightbox_type = $video_url ? trim($video_url) : $pf_lightbox;
				        $class = $video_url ? 'link_to_video' : 'link_to_image';
				//if ( has_post_thumbnail() ) { 
				$terms = get_the_terms(get_the_ID(), 'portfolio_category');
				$terms_slug = array();
				$terms_name = array();
				if($terms ){
				foreach ($terms as $term) {
					$terms_slug[] = $term->slug;
					$terms_name[] = $term ->name;
				}
			}else{
				$terms_name[] = 'Uncategorized';
			}	
	      	         	 ?>
                  <div class="portfolio-container">
                  	<div class="portfolio_img_container">              
                  <?php  //$params = array('width' => '600' , 'height' => $pf_related_images_height, 'crop' => true);
                                    	
								if( !empty($imgurl) ){
									echo "<img src='".kaya_thumb($imgurl, '400', $pf_related_images_height, 't') ."' alt='' />"; 
								}else{
									//$default_img = get_template_directory_uri().'/images/portfolio_default_img.jpg';
           							// echo "<img src='".kaya_thumb($default_img, '400', $pf_related_images_height, 't') ."' alt='' />";
           							  echo '<img src="'.get_template_directory_uri().'/images/portfolio_default_img.jpg" style="width:400px;">';  
								}	  
					 //echo kaya_imageresize($post->ID,$params,'');   ?>
					 <?php if( get_theme_mod('relatedposts_lightbox_disable') != 'on' ): ?> 
						<a class="<?php echo $class; ?>" rel="prettyPhoto['gallery']" title="<?php the_title(); ?>" href="<?php echo $lightbox_type ?>">&nbsp;</a>
					<?php endif; ?>
					<?php if( get_theme_mod('related_post_link_disable') != 'on' ): ?> 
						<a class="link_to_post" target="" href="<?php the_permalink(); ?>">&nbsp; </a>
					<?php endif; ?>
			 </div>
             <?php if( get_theme_mod('disable_related_post') != 'on' ) : ?>   
			<div class="portfolio_item_text">
		      	<h4 style="background-color:<?php echo $related_posts_title_bg_color; ?>!important; color:<?php echo $related_posts_title_color; ?>!important; "><?php echo the_title(); ?></h4>
            </div>
         <?php endif; ?>
			</div>
		
			<?php 	//}
			}
		echo '</div>';
	echo '</div>';echo '</div>';
}
}
$backup='';
$post = $backup;
wp_reset_query();
}
?>