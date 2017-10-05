<?php
get_header();
$options=get_option('kayapati');
 ?>
<!-- Slider -->
<script type="text/javascript">
(function($) {
  "use strict";
$(window).load(function() {
		$('.bxslider_post_single').bxSlider({
			  minSlides: 1,
			  maxSlides: 1,
			  slideWidth: 1100,
			  adaptiveHeight: true,
			  slideMargin: 0,
			   onSliderLoad: function(){
					$(".bxslider_post_single").css("visibility", "visible");
		 }
			}); 
	});
})(jQuery);
</script>
<?php
//Blog Page Options Left / Right / Fullwidth
$blog_single_page_sidebar = get_theme_mod( 'blog_single_page_sidebar' ) ? get_theme_mod( 'blog_single_page_sidebar' ): 'two_third';
$blog_sidebar_position = ( $blog_single_page_sidebar == 'two_third' ) ? 'one_third_last'  : 'one_third';
$sidebar_border_class=( $blog_single_page_sidebar == 'two_third' ) ? 'right_sidebar' : 'left_sidebar';
	// Sub Header Section ?>
	<!--Start Middle Section  -->
<section id="mid_container_wrapper">
	<section id="mid_container" class="container"> 
		<section class="<?php echo $blog_single_page_sidebar; ?>" id="content_section">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php				
					// image resize setting
					$featuredImage=get_post_meta($post->ID,'featuredImage', true);
					// single post image enable/disable		
					$single_image=get_option('blog_bigger_image');	

					if(has_post_format('video')){ // Video
						 echo '<div class="single_img ">'; 
						$video = get_post_meta( get_the_ID(), 'post_video', true ); 
						echo $video;
						echo '</div>';
					}else if(has_post_format('gallery')){ // Gallery 
						 echo '<div class="single_img ">'; 
						$meta = get_post_meta($post->ID, 'post_gallery', false );
						$kaya_gallery_slider = get_post_meta($post->ID, 'kaya_gallery_slider', true );
						$gallery_slider = ( $kaya_gallery_slider == '1' ) ? 'bxslider_post_single' : 'blog-isotope-container isotope_gallery';
						$width = ( $kaya_gallery_slider == '1' ) ? '1100' : '397';
						global $wpdb, $post;
						//print_r($meta);
						if ( !is_array( $meta ) )
						$meta = ( array ) $meta;
						if ( !empty( $meta ) ) {
						$meta = implode( ',', $meta );
						$images = $wpdb->get_col( "
						SELECT ID FROM $wpdb->posts
						WHERE post_type = 'attachment'
						AND ID IN ( $meta )
						ORDER BY menu_order ASC
						" );
						if(count($images) > 1 ){
								echo '<ul class="'.$gallery_slider .' clearfix ">';
								foreach ( $images as $att ) {
									$src = wp_get_attachment_image_src( $att, '' );
									$src = $src[0];
								echo "<li>" ?>
						<?php $params = array('width' => $width, 'height' => '', 'crop' => true);?>
						<a data-gal='prettyPhoto[gallery]' href='<?php echo "{$src}"; ?>' class="" title="">
							<img src='<?php echo bfi_thumb( "{$src}", $params ); ?>' />
						</a>
							<?php echo '</li>';
							}
							echo '</ul>';
							} else{
									foreach ( $images as $att ) {
								$src = wp_get_attachment_image_src( $att, '' );
									$src = $src[0]; ?>
									<a data-gal='prettyPhoto[gallery]' href='<?php echo "{$src}"; ?>' class="" title="">
									<?php echo "<img src='{$src}' /> </a>";
						
								}
								
							} 
						}						
						echo '</div>'; 
					}else if(has_post_format('audio')){ // Audio
						$audio = get_post_meta( get_the_ID(), 'kaya_audio', true ); 
						echo $audio;
					}else if(has_post_format('quote')){ // Quote
						$source = get_post_meta(get_the_ID(), 'kaya_quote_desc', true); ?>
						 <div class="quote_format"><blockquote> <?php echo $source; ?> </blockquote></div>
					<?php }else if(has_post_format('link')){ // Link
						$pf_link = get_post_meta(get_the_ID(), 'kaya_link', true); ?>
						<h3><a title="Permalink to: <?php echo $pf_link; ?>" href="<?php echo $pf_link; ?>" target="_blank"> <?php the_title(); ?>  </a>
						</h3>
						<p> <?php echo $pf_link; ?> </p>
					<?php } else{		
					// Slider Attachment images
								 echo '<div class="single_img ">'; 
									//$params = array('width' => '1100', 'height' => '', 'crop' => false);
            				  if( has_post_thumbnail() ) {
			 				 //echo kaya_imageresize($post->ID,$params,'');		
						echo '</div>';
						}
					}
					?>
					<div class="content_box">
						<?php the_content(); ?> 
					</div>
					<div class="vspace"> </div>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'lavan' ), 'after' => '</div>' ) ); ?>
				</div>
					<!-- .entry-content -->
			<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
			<div id="entry-author-info"> <!-- Author Information -->
				<div id="author-avatar" class="alignleft"> <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'kaya_author_bio_avatar_size', 60 ) ); ?> </div>
				<!-- #author-avatar -->
					<div id="author-description" class="description">
						<h4><?php printf( esc_attr__( 'About %s', 'lavan' ), get_the_author() ); ?></h4>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div id="author-link"> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"> <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'lavan' ), get_the_author() ); ?> </a> </div>
					</div>
			</div>
			</div>
			<?php endif; ?>
			<!-- End Author information -->    
			<?php   // Comment Section
			$commentsection = get_post_meta( $post->ID, 'commentsection', true );	
			if( $commentsection != "on") {
				comments_template( '', true );
			} ?>
			<?php endwhile; // end of the loop. ?>
		</section>
        <?php // Sidebar Section
	if( $blog_single_page_sidebar != 'fullwidth' ) :	?>
		<article class="<?php echo $blog_sidebar_position. ' ' . $sidebar_border_class; ?>" >
			<?php get_sidebar();?>
		</article>
		<?php endif; ?>
		<div class="clear"></div>
		<?php get_footer(); ?>