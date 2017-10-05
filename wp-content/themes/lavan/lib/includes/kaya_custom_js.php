<?php
function kaya_custom_js(){
	$post_icon = ( get_theme_mod('pf_lightbox_disable') != 'on' ) ? "30%" : '50%'; ?>
    <?php $lightbox_icon = ( get_theme_mod('pf_post_link_disable') != 'on' ) ? "30%" : '50%'; ?>
<script type="text/javascript">
(function($) {
  "use strict";
	$(function() {	
/****************** Portfolio Isotope code **************/
if (jQuery().isotope){
var tempvar = "all";
$(window).load(function(){
$(function (){
	var isotopeContainer = $('.isotope-container'),
	isotopeFilter = $('#filter'),
	isotopeLink = isotopeFilter.find('a');
	isotopeContainer.isotope({
		itemSelector : '.isotope-item',
		filter : '.' +tempvar,
		masonry: {
                   columnWidth:    1,
                    isAnimated:     true,
                    isFitWidth:     true
                }
	});
	isotopeLink.click(function(){
		var selector = $(this).attr('data-category');
		isotopeContainer.isotope({
			filter : '.' + selector,
			itemSelector : '.isotope-item',
			//layoutMode : 'fitRows',
			animationEngine : 'best-available'
		});
		isotopeLink.removeClass('active');
		$(this).addClass('active');
		return false;
	});
});
		$("#filter ul li a").removeClass('active');
		$("#filter ul li."+tempvar+ " a").addClass('active');
});
}
	// Portfolio Hover
    $('.slider_items h4').css("opacity","0");
    $('.pf_taxonomy_gallery .porfolio_items li, #relatedposts .portfolio-container, #kaya_main_slider .owl-item').hover(
      function () {
			$(this).find('img').stop(true,true).fadeTo(500,0.6);
			$(this).find('.slider_items h4').animate({opacity:'1'}).css({"bottom":"-30px"}).stop(true,true).animate({"bottom":"0px",opacity:1},300);
			$(this).find('.lavan-portfolio-container img, img.pf_img').stop(true,true).fadeTo(500, 0.5);
			$(this).find('.link_to_image, .link_to_video').css({'left':'-100px','display':'block'}).stop().animate({'left':'<?php echo $lightbox_icon; ?>', opacity:1},600);
			$(this).find('.link_to_post').css({'right':'-50%','display':'block'}).stop().animate({'right':'<?php echo $post_icon; ?>',opacity:1},600);
      },
      function () {
			$(this).find('img').fadeTo(500,1);
			$(this).find('.slider_items h4').animate({opacity:'0'}).css({"bottom":"0px", "display":"block"}).stop(true,true).animate({"bottom":"-30px",opacity:0},300);
			$(this).find('.lavan-portfolio-container img, img.pf_img').stop(true,true).fadeTo(500, 1);
			$(this).find('.link_to_image, .link_to_video').css({'left':'100','display':'block'}).stop().animate({'left':'-<?php echo $lightbox_icon; ?>',opacity:0},600);
			$(this).find('.link_to_post').css({'right':'50%','display':'block'}).stop().animate({'right':'<?php echo $post_icon; ?>',opacity:0},600);
			});
      });
      })(jQuery);
</script>
<?php } 
add_action( 'wp_footer', 'kaya_custom_js', 100 );
?>