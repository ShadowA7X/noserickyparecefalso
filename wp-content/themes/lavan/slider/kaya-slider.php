<?php
// Slider Settings
if( !function_exists('kaya_image_slider') ) :
function kaya_image_slider(){
// Post Item Id 

  global $post_item_id;
  echo  kaya_post_item_id();
$kaya_options = get_option('kayapati');
 $slider=get_post_meta($post_item_id,'slider',true);
 if( $slider == 'none' || $slider == ''){ }
 		else {

			echo '<div id="main_slider">';	
			if($slider=="superslider"){
				get_template_part('slider/super','slider');
			}
			elseif($slider=="owlslider"){
				get_template_part('slider/owl','slider');
			}
			elseif($slider=="bxslider"){
				get_template_part('slider/bx','slider');
			}
			elseif($slider=="customslider"){
				get_template_part('slider/custom','slider');
			}
			
			else{ }
		echo '</div>';
	}
	//else{ ?>

<?php	//}
	wp_reset_query();
}
endif;
?>