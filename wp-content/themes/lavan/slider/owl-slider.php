<?php 
  global $post_item_id,$lavan_plugin_name;
  echo  kaya_post_item_id();
$auto_play = get_post_meta($post_item_id,'auto_play',true);
$slider_items = get_post_meta($post_item_id,'slider_items',true);
$slider_post_type = get_post_meta($post_item_id,'slider_post_type',true);	
$Kaya_portfolio_category=get_post_meta($post_item_id,'Kaya_portfolio_category',false);
$Kaya_slider_category=get_post_meta($post_item_id,'Kaya_slider_category',false);
$Kaya_slider_limit=get_post_meta($post_item_id,'Kaya_slider_limit',true);	
$Kaya_portfolio_slider_height=get_post_meta($post_item_id,'Kaya_portfolio_slider_height',true) ? get_post_meta($post_item_id,'Kaya_portfolio_slider_height',true) : '600';	
$disable_slide_title = get_post_meta($post_item_id,'disable_slide_title',true) ? get_post_meta($post_item_id, 'disable_slide_title',true) : '0';
$kaya_portfolio_order=get_post_meta($post_item_id,'kaya_portfolio_order',true);
$Kaya_slider_auto_play=get_post_meta($post_item_id,'Kaya_slider_auto_play',true);
//main slider settings
$navigation_bg_color = get_post_meta($post_item_id,'navigation_bg_color',true) ? get_post_meta($post_item_id,'navigation_bg_color',true) : '#000000';
$navigation_bg_hover_color = get_post_meta($post_item_id,'navigation_bg_hover_color',true) ? get_post_meta($post_item_id,'navigation_bg_hover_color',true) : '#db0007';
$disable_slide_arrow_navigation = get_post_meta($post_item_id,'disable_slide_arrow_navigation',true) ? get_post_meta($post_item_id,'disable_slide_arrow_navigation',true) : '0';
$disable_slide_dots_navigation = get_post_meta($post_item_id,'disable_slide_dots_navigation',true) ? get_post_meta($post_item_id,'disable_slide_dots_navigation',true) : '0';
?>
<style type="text/css">
#slider_wrapper .owl-controls .owl-next,#slider_wrapper .owl-controls .owl-prev{
          background-color: <?php echo $navigation_bg_color; ?>!important;
  }
#slider_wrapper .owl-controls .owl-next:hover,#slider_wrapper .owl-controls .owl-prev:hover{
          background-color: <?php echo $navigation_bg_hover_color; ?>!important;
  }
  <?php if($disable_slide_arrow_navigation =='0'){ ?>
#slider_wrapper .owl-controls .owl-nav{
	display: none!important;
}
	
<?php } 
if($disable_slide_dots_navigation =='0'){?>
	#slider_wrapper .owl-dots{
		display: none!important;
	}
	<?php } ?>
</style>

	<script>
	(function($) {
	"use strict";
	$(function() {
		var responsive2_column = ( ( <?php echo $slider_items ?> == '4' ) || ( <?php echo $slider_items ?> == '3' ) ) ? '2' : <?php echo $slider_items ?>;
		$("#kaya_main_slider").owlCarousel({
			items 					: <?php echo $slider_items ?>,
			itemsDesktop 			: [1199,<?php echo $slider_items ?>],
			//itemsDesktopSmall 		: [979,3],
			autoplay : <?php echo $Kaya_slider_auto_play; ?>,
			stopOnHover : true,
			autoplayHoverPause : true,
			nav : true,
			navText: [ '', '' ],
			loop : true,
			onInitialized: function() {     
                    $('#kaya_main_slider').css('display','block'); 
                    $('.slider_bg_loading_img').hide(); 
                  },
			 responsive: {
                  0:{
                      items:1,
                      },
                      480:{
                          items:1,
                      },
                      768:{
                          items:responsive2_column,
                          loop : false,
                      },
                      1024:{
                          items:<?php echo $slider_items ?>,
                          loop : true,
                      },
                }, 
		});
	});
	})(jQuery);
	</script>	
<?php 
switch ($slider_items) {
	case '5':
		$img_width = '380';
		break;
	case '4':
		$img_width = '480';
		break;
	case '3':
		$img_width = '635';
		break;
	case '2':
		$img_width = '800';
		break;
	case '1':
		$img_width = '1920';
		break;	
	default:
		$img_width = '480';
		break;
}	
switch ($slider_post_type) {
	case 'slider_category':
		$post_type = 'slider';
		$cat_taxonomy = $Kaya_slider_category;
		break;
	case 'portfolio_category':
		$post_type ='portfolio';
		$cat_taxonomy = $Kaya_portfolio_category;
		break;
	default:
		$post_type ='portfolio';
		$cat_taxonomy = $Kaya_portfolio_category;
		break;
}
echo '<span class="slider_bg_loading_img container" style="height:400px; background:url('.constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'images/bx_loader.GIF)"></span>';
?>
		<div id="slider_wrapper">
			<div id="kaya_main_slider" class="owl-carousel owl-theme">
			<?php 
			if(empty($cat_taxonomy)) {
			$loop = new WP_Query(array('post_type' => $post_type, 'taxonomy' => $slider_post_type,'term' => $cat_taxonomy, 'orderby' => '', 'posts_per_page' =>$Kaya_slider_limit, 'order' => $kaya_portfolio_order )); 
			}else{ 
			$loop =new WP_Query( array('post_type' => $post_type, 'orderby' => '', 'posts_per_page' =>$Kaya_slider_limit,'order' => $kaya_portfolio_order , 'tax_query' => array( array( 'taxonomy' => $slider_post_type, 'field' => 'slug', 'terms' => $cat_taxonomy , 'operator' => 'IN'))));
			}

		if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); 
		$slide_description=get_post_meta(get_the_ID(),'slide_description',true);	
 		$slide_text_color=get_post_meta($post->ID,'slide_text_color',true) ? get_post_meta($post->ID,'slide_text_color',true) : '#ffffff';
 		 $slider_link=get_post_meta(get_the_ID(),'customlink' ,true);
 		 $Porfolio_customlink=get_post_meta($post->ID,'Porfolio_customlink',true);
 		$pf_link_new_window=get_post_meta(get_the_ID(),'pf_link_new_window' ,true);
 		$slider_target_link=get_post_meta(get_the_ID(),'slider_target_link' ,true);
 		$owl_slider_custom_link = ( $slider_post_type == 'portfolio_category' ) ? $Porfolio_customlink : $slider_link;
     	$owl_slider_link = $owl_slider_custom_link ? $owl_slider_custom_link : get_the_permalink();
     	$owl_slider_target_link = ( $slider_post_type == 'portfolio_category' ) ? $pf_link_new_window : $slider_target_link;
     	$owl_slider_target = $owl_slider_target_link ? $owl_slider_target_link : '0';
		if( $owl_slider_target == '1' ){ $target_link_class='target=_blank';}else{ $target_link_class=""; }
			echo '<a href="'.$owl_slider_link.'" '.$target_link_class.' >';
			echo '<div class="slider_items">';
			$params = array('width' => $img_width, 'height' => $Kaya_portfolio_slider_height, 'crop' => true);
					$img_url = wp_get_attachment_url( get_post_thumbnail_id() ); //get img URL	?>

			<div class="owl_slider_img">
	 
			<?php
				echo kaya_imageresize($post->ID, $params,'');
   if($disable_slide_title != '1'){
				echo '	<h4>'.get_the_title().'</h4>';
				  }
				echo '</div>';
				?>
				</div>
			</a>
					<?php //} ?>
			<?php endwhile; endif; ?>
			<?php wp_reset_query(); ?>
				</div>
		</div>