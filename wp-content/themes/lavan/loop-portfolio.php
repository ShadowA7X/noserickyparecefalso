<?php
$list_images= get_post_meta($post->ID,'list_images',true);
$project_client_name= get_post_meta($post->ID,'project_client_name',true);
$project_link= get_post_meta($post->ID,'client_project_link',true);
$isotop_gal=( ($list_images=='isotope_gallery') || ($list_images=='grid_gallery') ) ? 'isotope-container' : '';
if($list_images=='slider'){  ?>
<script type="text/javascript">
(function($) {
  "use strict";
$(window).load(function() {
		$('.bxslider_post_single').bxSlider({
			  minSlides: 1,
			  maxSlides: 1,
			  adaptiveHeight: true,
			  slideMargin: 0,
			   onSliderLoad: function(){
					$(".bxslider_post_single").css("visibility", "visible");
		 }
			});
      });        
})(jQuery);
</script>
<?php $slider_class="bxslider_post_single";
} else{
	$slider_class='';
 } ?>
<?php // loop Start here 
	if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
			observePostViews($post->ID);
			//echo fetchPostViews(get_the_ID());
			$sidebar_layout=get_post_meta(get_the_id(),'kaya_pagesidebar',true); 
			$options=get_option('kayapati');
			$youtube_video= get_post_meta($post->ID,'youtube_video',true);
			$vimeo_video= get_post_meta($post->ID,'vimeo_video',true);
			$video_embed_code= get_post_meta($post->ID,'video_embed_code',true);
			$Featuredimage=get_post_meta(get_the_ID(),'Featuredimage' ,true);
			if(class_exists('RW_Meta_Box')){
				$images = rwmb_meta( 'portfolio_slide', 'type=image&size=full' );
			}else{
				$images = '';
			}
			$video_type = get_post_meta(get_the_ID(), 'video_type', true );
			$portfolio_project_skills=get_post_meta(get_the_ID(),'portfolio_project_skills' ,false);
			$portfolio_project_skills_title=get_post_meta(get_the_ID(),'portfolio_project_skills_title' ,true);
			$portfolio_skills_title= isset( $options['portfolio_skills_title']) ?  $options['portfolio_skills_title'] : '';
			$pf_featuread_image_disable=get_post_meta(get_the_ID(),'pf_featuread_image_disable' ,true);
			$title=get_the_title($post->ID);
			foreach($images as $val)
			{
			//echo $val;
			}
			$postid=$post->ID;
			echo '<div class="single_img '.$list_images.'">';
			if( isset( $val )!='' ){ 
					global $wpdb, $post;
					if ( !is_array( $images ) )
						$images = ( array ) $images;
						if ( !empty( $images ) ) {
						if(count($images) > 1 ){
								echo '<ul class="'.$slider_class.' '.$isotop_gal.' clearfix '.$list_images.'">';
							foreach ( $images as $image ){
								echo "<li class='isotope-item all  '>"; 
					 echo "<a href='{$image['url']}' title='{$image['title']}' data-gal='prettyPhoto[gallery]' >"; ?>
					<?php if($list_images=="isotope_gallery"){ ?>
					<?php $params = array('width' => '480', 'height' => '', 'crop' => false);
					echo "<img src='".bfi_thumb( "{$image['url']}", $params )."'  alt='{$image['title']}' />"; ?> 
					<?php } elseif($list_images=="grid_gallery"){ ?>
					<?php $params = array('width' => '480', 'height' => '500', 'crop' => false);
					echo "<img src='".bfi_thumb( "{$image['url']}", $params )."'  alt='{$image['title']}' />"; ?> 
					<?php }else { ?>
					<?php $params = array('width' => '', 'height' => '', 'crop' => false);
					echo "<img src='".bfi_thumb( "{$image['url']}", $params )."' alt='{$image['title']}' />"; ?> <?php }?>	</a>	</li>
							<?php	}
							echo '</ul>';
							}else{
								foreach ( $images as $image ) {
									$params = array('width' => '', 'height' => '', 'crop' => false);
									echo "<img src='".bfi_thumb( "{$image['url']}", $params )."' alt='{$image['title']}' />"; 
								}
							}
					} 
			} else {   }
		echo '</div>'; 
				if( $video_embed_code && $images ){
			echo '<br>';
		}
		if($video_embed_code!='')
		{		
			echo $video_embed_code;
		}
		
echo '</div>'; 
			echo '<div class="clear"></div>';    
			if($sidebar_layout == "full") { ?>
				<div class="fullwidth portfolio_fullwidth portfolio_aside">
						<?php the_content(); ?>
						<?php //kaya_portfolio_skills($portfolio_project_skills, $portfolio_project_skills_title ); ?>
				</div>
			<?php }
			else{ ?>
	
			<?php } 
			
			wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'lavan' ), 'after' => '</div>' ) ); 
			edit_post_link( __( 'Edit', 'lavan' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
		<!-- End Ps -->
		<?php  
		
	endwhile; // end of the loop. ?>