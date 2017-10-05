<?php
/**
 * The template for displaying Search Results pages.
 *
 */
get_header();
	echo '<section class="sub_header_wrapper" >'; ?>
	<div class="sub_header container">
				<h2><?php printf( __( 'Search Results for: %s', 'lavan' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
		</div>
	</div>
</section> <!-- end header section -->

<!-- Start Middle Section -->
	<section id="mid_container_wrapper">	
		<section id="mid_container" class="container">
			<?php
if( $_REQUEST['advance_search'] == 'advance_search' ){
$args = array(
	'post_type'  => 'portfolio',
	'posts_per_page' => -1,
	'meta_query' => array(
		// 'relation' => 'OR',
	),
);
$options = get_option('pf_custom_options');
$prefix = 'pf_model_';
for ($i=0; $i < count($options['pf_meta_label_name'])-1; $i++) { 
	if( ( !empty($options['pf_meta_label_name'][$i]) ) &&  ( $options['pf_meta_label_name'][$i] != 'Array') &&  ( $options['pf_meta_label_name'][$i] != '') &&  ( !is_array($options['pf_meta_label_name'][$i]) )){
	$options_data_id = str_replace(array(' ', ',','-', '/', '___'), '_', trim(strtolower($options['pf_meta_label_name'][$i])));
	$request_data_id = str_replace(array(' ', ',','-', '/', '---'), '-', trim(strtolower($options['pf_meta_label_name'][$i])));
	if( $options['pf_meta_field_name'][$i] == 'text' ){
		if( $options['pf_option_display_search'][$i] == 'true' ){
		if( ( $options['pf_meta_label_name'][$i] == 'Name' ) ){
			if( $_REQUEST['s'] !='' ){
				$args['meta_query'][] = array(
			        'key' => $prefix.$options_data_id,
			        'value' => $_REQUEST['s'],
			        'compare' => 'LIKE',
			    );
			}
		}else{
			if( $_REQUEST[$request_data_id] !='' ){
			 $args['meta_query'][] = array(
		        'key' => $prefix.$options_data_id,
		        'value' => $_REQUEST[$request_data_id],
		        'compare' => 'LIKE',
	    	);
		}
		}
	}
	}
	//echo $prefix.$options_data_id;
	if( $options['pf_meta_field_name'][$i] == 'select' ){
		if( $options['pf_option_display_search'][$i] == 'true' ){
		if( ( $options['pf_meta_label_name'][$i] == 'Height' ) || ( $options['pf_meta_label_name'][$i] == 'Chest / Bust' ) || ( $options['pf_meta_label_name'][$i] == 'Waist' ) || ( $options['pf_meta_label_name'][$i] == 'Age' ) || ( $options['pf_meta_label_name'][$i] == 'Hips' ) || ( $options['pf_meta_label_name'][$i] == 'Dress Size' )){
			if( ($_REQUEST[$request_data_id.'-from'] !='' ) && ( $_REQUEST[$request_data_id.'-to'] !='' ) ){
				$args['meta_query'][] = array(
					'key'     => $prefix.$options_data_id,
					'value'   => array( $_REQUEST[$request_data_id.'-from'], $_REQUEST[$request_data_id.'-to'] ),
					'type'    => 'numeric',
					'compare' => 'BETWEEN',
				);
			}		
		}else{	
		if( ($_REQUEST[$request_data_id] !='' ) ){
			//echo $prefix.$options_data_id;
				if( $_REQUEST[$request_data_id] == 'Male'  ){
					$args['meta_query'][] = array(
					'key'     => $prefix.$options_data_id,
					'value' =>  str_replace('+', ' ', $_REQUEST[$request_data_id]),
				);
				}else{
					$args['meta_query'][] = array(
					'key'     => $prefix.$options_data_id,
					'value' =>  str_replace('+', ' ', $_REQUEST[$request_data_id]),
					'compare' => 'LIKE',
				);
				}				
			}
	}
	}
	}
}
}				
$query = new WP_Query( $args );
 ?>
<?php $pf_img_height =  get_theme_mod('pf_images_height') ? get_theme_mod('pf_images_height') :'400'; 
 $pf_thumbnail_columns =  get_theme_mod('pf_thumbnail_columns') ? get_theme_mod('pf_thumbnail_columns') :'4'; ?>
 <?php  if ( $query->have_posts() ) : ?>
 <div class="search_post Portfolio_gallery pf_taxonomy_gallery">	 	
 	<?php echo '<ul class="isotope-container portfolio3 porfolio_items portfolio_extra clearfix">';
					while ( $query->have_posts() ) : $query->the_post(); 
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
							<?php if( get_theme_mod('pf_disable_title') != 'on' ):  ?>
                 		<h4 style=""><?php echo the_title(); ?></h4>
                 	<?php endif; ?>		
					  </div>
            		<?php endif; ?>
            	</div>
                </li>
				<?php	endwhile; // end here
		?>
		</ul>
	</div>
		<?php 
	 else : ?>
		<h1><?php _e( 'Nothing Found', 'lavan'); ?></h1>
		<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'lavan'); ?></p>
	<?php endif; ?>


<?php }else{
} ?>
    <!--Start Footer Section -->
<?php get_footer(); ?>