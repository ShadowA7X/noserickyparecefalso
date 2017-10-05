<?php
get_header();
$portfolio_page_options = $pf_page_sidebar = get_theme_mod('pf_page_sidebar') ? get_theme_mod('pf_page_sidebar') : 'fullwidth';
$sidebar_class=( $portfolio_page_options == 'two_third' ) ? 'one_third_last' : 'one_third';
$sidebar_border_class=( $portfolio_page_options == 'two_third' ) ? 'right_sidebar' : 'left_sidebar';
$pf_img_height =  get_theme_mod('pf_images_height') ? get_theme_mod('pf_images_height') :'400';
$pf_thumbnail_columns =  get_theme_mod('pf_thumbnail_columns') ? get_theme_mod('pf_thumbnail_columns') :'4';
$pf_post_order =  get_theme_mod('pf_post_order') ? get_theme_mod('pf_post_order') :'DESC';
$pf_post_orderby =  get_theme_mod('pf_post_orderby') ? get_theme_mod('pf_post_orderby') :'date';
$height=($portfolio_page_options== "fullwidth" ) ?  '350' : '400';
$pf_posts_title_color =  get_theme_mod('pf_posts_title_color') ? get_theme_mod('pf_posts_title_color') :'#fff';
$pf_posts_title_bg_color =  get_theme_mod('pf_posts_title_bg_color') ? get_theme_mod('pf_posts_title_bg_color') :'#FF0000';
if( !empty($sidebars) ){
	$pf_sidebar_id = get_theme_mod('pf_sidebar_id') ? get_theme_mod('pf_sidebar_id') : 'sidebar-1';
}else{
	$pf_sidebar_id = 'sidebar-1';
}
?>
	<section id="mid_container_wrapper">
		<section id="mid_container" class="container"> 
			<section class="<?php echo $portfolio_page_options; ?>" id="content_section">
			 <?php	echo '<div class="Portfolio_gallery pf_taxonomy_gallery">';		
				echo '<ul class="isotope-container portfolio'.$pf_thumbnail_columns.' porfolio_items portfolio_extra clearfix">';
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
				 query_posts(array('posts_per_page' => -1, 'post_type' => array('portfolio', 'slider'), 'orderby'=> $pf_post_orderby, 'order'=>$pf_post_order, 'taxonomy'=>'portfolio_category', 'term'=>$term->slug));
					while (have_posts()) : the_post(); // loop start here
						$imgurl=wp_get_attachment_url( get_post_thumbnail_id() );
						$pf_lightbox =  $imgurl ? $imgurl : get_template_directory_uri().'/images/defult_featured_img.png';
						$video_url= get_post_meta($post->ID,'video_url',true);
				        $lightbox_type = $video_url ? trim($video_url) : $pf_lightbox;
				        $class = $video_url ? 'link_to_video' : 'link_to_image';
						$terms = get_the_terms(get_the_ID(), 'portfolio_category');
						$pf_link_new_window=get_post_meta(get_the_ID(),'pf_link_new_window' ,true);
						if($pf_link_new_window == '1') { $pf_target_link ="_blank"; }else{ $pf_target_link ='_self'; }
						$permalink = get_permalink();
						$Porfolio_customlink=get_post_meta($post->ID,'Porfolio_customlink',true);
						$pf_customlink = $Porfolio_customlink ? $Porfolio_customlink : $permalink;
					echo '<li class="isotope-item all">';   ?>
					<div class="portfolio-container">
                  	<div class="portfolio_img_container">
                 <?php  $params = array('width' => '600' , 'height' => $pf_img_height, 'crop' => true);?>
                  <?php if( get_theme_mod('Enable_Image_Link') == 'on' ): ?> 
						<a  href="<?php echo $pf_customlink; ?>">&nbsp; 
						<?php endif; ?>
					 <?php echo kaya_imageresize($post->ID,$params,'');   ?>	
                  <?php if( get_theme_mod('Enable_Image_Link') == 'on' ): ?> 
						<a  href="<?php echo $pf_customlink; ?>">&nbsp; 
						<?php endif; ?>
					 <?php //echo kaya_imageresize($post->ID,$params,'');   ?>
					 <?php if( get_theme_mod('Enable_Image_Link') == 'on' ): ?> 
					 </a>
					 <?php endif; ?>
					<?php if( get_theme_mod('pf_lightbox_disable') != 'on' ): ?> 
						<a class="<?php echo $class; ?>" rel="prettyPhoto['gallery']" title="<?php echo the_title();  ?>" href="<?php echo $lightbox_type ?>">&nbsp;</a>
					<?php endif; ?>
					<?php if( get_theme_mod('pf_post_link_disable') != 'on' ): ?> 
						<a class="link_to_post" target="<?php echo $pf_target_link; ?>" href="<?php echo $pf_customlink; ?>">&nbsp; </a>
					<?php endif; ?>
									
					<?php if( get_theme_mod('pf_enable_title') != 'on' )  {
						?>
					<span class="strip"> </span>
				 <?php } ?>
				</div>
                 <?php if( get_theme_mod('pf_enable_title') != 'on' ):  ?>

						<div class="portfolio_item_text">
							<?php if( get_theme_mod('pf_disable_title') != 'on' ):
							if( get_theme_mod('enable_post_title_link') == 'on' ):  ?>
						<a href="<?php echo $pf_customlink; ?>">
						<?php  endif; ?>
                 		<h4 style="background-color:<?php echo $pf_posts_title_bg_color; ?>!important; color:<?php echo $pf_posts_title_color; ?>!important;"><?php echo the_title(); ?></h4>
                 	<?php if( get_theme_mod('enable_post_title_link') == 'on' ):  ?>
						</a>
						<?php  endif; ?>
                 	
                 	<?php endif; ?>		
					  </div>
            		<?php endif; ?>
            	</div>
                </li>
				<?php	endwhile; // end here
				echo '</ul>';
			echo '</section>'; ?>
			</div>
		<?php
		wp_reset_query(); 
		if( $portfolio_page_options != 'fullwidth' ) :	?>
			<aside class="<?php echo $sidebar_class.' '.$sidebar_border_class; ?>" >
			<div id="sidebar">
				<?php dynamic_sidebar( $pf_sidebar_id ); ?>
			</div>
			</aside>
			<?php endif; ?>
		<?php echo kaya_pagination(); // Pagination ?>
	<?php get_footer(); ?>