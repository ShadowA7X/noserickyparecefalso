<?php 
$kaya_options = get_option('kayapati');
  global $post_item_id;
  echo  kaya_post_item_id();
$Kaya_fluid_slider_auto_play=get_post_meta($post_item_id,'Kaya_fluid_slider_auto_play',true);
$Kaya_fluid_slider_limit=get_post_meta($post_item_id,'Kaya_fluid_slider_limit',true);
$fluid_slider_post_type=get_post_meta($post_item_id,'fluid_slider_post_type',true);
$Kaya_superslide_category=get_post_meta($post_item_id,'Kaya_superslide_category',false);
$fluid_portfolio_category=get_post_meta($post_item_id,'fluid_portfolio_category',false);
$fluid_portfolio_order=get_post_meta($post_item_id,'fluid_portfolio_order',true); ?>
  <script>
  (function($) {
    $(function() {
    	"use strict";
      var $slides = $('#slides');
      $slides.superslides({
       // hashchange: true
       animation : 'slide',
       play :<?php echo $Kaya_fluid_slider_auto_play; ?>,
      });
         Hammer($slides[0]).on("swiperight", function(e) {
        $slides.data('superslides').animate('prev');
      });

  });
  })(jQuery);
  </script>

<div id="slides">
	<div class="slides-container">
			<?php 	
			switch ($fluid_slider_post_type) {
				case 'slider_category':
					$category =  $Kaya_superslide_category;
					$post_types = 'slider';
					break;
				case 'portfolio_category':
					$category =  $fluid_portfolio_category;
					$post_types ='portfolio';
					break;
				default:
					$category =  $fluid_portfolio_category;
					$post_types ='portfolio';
					break;
			}

			//echo $fluid_portfolio_category.'aaaaaaa';
			if(empty($category)) {
				$loop = new WP_Query(array('post_type' => $post_types, 'taxonomy' => $fluid_slider_post_type,'term' => $category, 'posts_per_page' =>$Kaya_fluid_slider_limit,'order' => $fluid_portfolio_order )); 
			}else{ 
				$loop =new WP_Query( array('post_type' => $post_types, 'orderby' => '', 'posts_per_page' =>$Kaya_fluid_slider_limit,'order' => '' , 'tax_query' => array( array( 'taxonomy' => $fluid_slider_post_type, 'field' => 'slug', 'terms' => $category , 'operator' => 'IN'))));
			}
		if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
		$slider_link=get_post_meta(get_the_ID(),'customlink' ,true); 
		$slide_description=get_post_meta(get_the_ID(),'slide_description',true);
		$slide_text_color=get_post_meta($post->ID,'slide_text_color',true) ? get_post_meta($post->ID,'slide_text_color',true) : '#ffffff';
		$slider_target_link= get_post_meta($post->ID,'slider_target_link',true);
		$disable_slide_content = get_post_meta($post->ID,'disable_slide_content',true);
		
		if( $slider_target_link == '1' ){ $target_link_class='target=_blank';}else{ $target_link_class="_self"; }
		
		$img_url = wp_get_attachment_url( get_post_thumbnail_id() ); //get img URL
		?>
		<div>
		<?php if( $slider_link ): ?><a href="<?php echo $slider_link; ?>" target="<?php echo $target_link_class; ?>">
		<?php endif; 
		if( $img_url ){ ?>
			<img src="<?php echo $img_url;?>" alt="<?php echo the_title(); ?>"/>
		<?php }else{ ?>
			<img src="<?php echo get_template_directory_uri();?>/images/fluid_slider_default_img.jpg" alt="<?php echo the_title(); ?>"/>
		<?php }	?>
		<?php
		if( $disable_slide_content == "0" ){
		echo '<div class="slides_description container" >'; echo '<div class="slides_title_description" >'; ?>
						<h3 style="color:<?php echo $slide_text_color; ?>;"><?php echo the_title(); ?></h3>
						<span class="title_border"> </span>
						<p style="color:<?php echo $slide_text_color; ?>"><?php echo $slide_description; ?></p>
				<?php	echo '</div></div>';  }
				if( $slider_link ): ?> </a> <?php endif;
				?>
				</div>
			<?php  endwhile; endif; ?>
		</div> 
	<nav class="slides-navigation">
      <a href="#" class="next">&nbsp;</a>
      <a href="#" class="prev">&nbsp;</a>
    </nav>
	</div>	
			<?php wp_reset_query(); ?>
			<script>
function set_slider_height() {
	var slides_description = jQuery('.slides_description').height();
	jQuery('.slides_description').css({'top':'50%','margin-top':'-50px'});
	//alert( header_height );
}
(function($) {
  "use strict";
	$(function() {
  	set_slider_height();
    $(window).resize(function(){
	  set_slider_height();
	});
});
})(jQuery);
  </script>
		