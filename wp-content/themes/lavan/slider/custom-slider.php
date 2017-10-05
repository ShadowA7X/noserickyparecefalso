<div id="Custom_Slider_wrapper">
	<?php 
	global $post, $post_item_id;
  echo  kaya_post_item_id();
		$customslider_type=get_post_meta($post_item_id,'customslider_type',true);
		echo do_shortcode($customslider_type); ?>
</div>