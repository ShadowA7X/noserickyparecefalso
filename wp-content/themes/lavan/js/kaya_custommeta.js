(function($) {
  "use strict";
	$(function() {
	// Rwmb Select Option hide if empty
	$('.rwmb-select').each(function(){
		 $(this).find('option:empty').remove();
	});
	// End	
	$("#video_type").change(function () {
	$("#youtube_video").parent().parent().hide();
	$("#vimeo_video").parent().parent().hide();
	var selectlayout = $("#video_type option:selected").val(); 
	$("#video_embed").parent().parent().hide();
	switch(selectlayout)
	{
		case 'vimeo':
			$("#vimeo_video").parent().parent().show();
		break;
		case 'youtube':
			$("#youtube_video").parent().parent().show();
		break;
		case 'videoembed':
			$("#video_embed").parent().parent().show();
		break;
		
	}
}).change();

//Meta Page Optons

$("#select_page_options").change(function() {
	var select_options = $("#select_page_options option:selected").val(); 
	$('.slider').hide();
	$('.kaya_custom_title').hide();
	$('.kaya_custom_title_description').hide();
	$('.kaya_title_color').hide();
	$(".transitionStyle").hide();
	$(".Kaya_Sliders").hide();
	$(".slider_height").hide();
	$(".bx_slider_width").hide();
	$(".Kaya_slider_autoplay").hide();
	$(".Kaya_slider_height").hide();
	$(".Kaya_slider_transitions").hide();
	$(".kaya_slidelink").hide();
	$(".kaya_slidecaption").hide();
	$(".page_video").hide();
	$(".Kaya_slider_top").hide();
	$(".bx_transitions").hide();
	$(".customslider_type").hide();
	$(".Single_Image_height").hide();
	$(".Single_Image_Upload").hide();
	$(".Single_Image_content").hide();
	$(".single_img_attachment").hide();
	$(".kaya_slide_caption").hide();
	$(".auto_play").hide();
	$(".page_video_text").hide();
	$(".Kaya_superslide_category").hide();
	$(".owl_slider_height").hide();
	$(".Single_slider_height").hide();
	$(".Single_Image_opacity").hide();
	$('.page_video_mute').hide();
	$(".Kaya_portfolio_slider_height").hide();
	$(".navigation_bg_color").hide();
	$(".navigation_bg_hover_color").hide();
	$(".disable_slide_arrow_navigation").hide();
	$(".disable_slide_dots_navigation").hide();
	$(".slider_items").hide();
	$(".Kaya_slider_category").hide();
	$(".slider_post_type").hide();
	$(".Kaya_portfolio_category").hide();
	$(".fluid_slider_post_type").hide();
	$(".fluid_portfolio_category").hide();
	$(".Kaya_slider_limit").hide();
	$(".disable_slide_title").hide();
	$(".Kaya_fluid_slider_limit").hide();
	$(".Kaya_bx_slider_limit").hide();
	$(".Kaya_slider_pause").hide();
	$(".Kaya_slider_easing").hide();
	$(".adaptive_height").hide();
	$(".fluid_portfolio_order").hide();
	$(".kaya_portfolio_order").hide();
	$(".Kaya_fluid_slider_auto_play").hide();
	$(".kaya_slider_order").hide();
	$(".Kaya_slider_auto_play").hide();
	$('.attachemnt_slider_note').hide();
	switch(select_options){
		case 'page_title_setion':
		$('.slider').hide();
			$('.kaya_custom_title').show();
			$('.kaya_custom_title_description').show();
			$('.page_bg_Image_Upload').show();
			$('.kaya_title_color').show();
			//$('#page_title_bg_color').parent().parent().show();
			//page_slider_options();
			break;

		case 'page_slider_setion' :
			$('.slider').show();
			page_slider_options();
			
			break;
		case 'video':
			$(".page_video").show();
			$(".page_video_text").show();
			$(".Single_slider_height").show();
			$('.page_video_mute').show();
			break;
		case 'singleimage':
			$(".Single_Image_height").show();
			$(".Single_Image_Upload").show();
			$(".Single_Image_content").show();
			$(".single_img_attachment").show();
			$(".Single_Image_opacity").show();
			break;			
	}	

}).change();

// Meta BOxes
function page_slider_options(){

	$("#slider").change(function () {	
	var selectlayout = $("#slider option:selected").val(); 
	$(".transitionStyle").hide();
	$(".Kaya_Sliders").hide();
	$(".slider_height").hide();
	$(".bx_slider_width").hide();
	$(".Kaya_slider_autoplay").hide();
	$(".Kaya_slider_height").hide();
	$(".Kaya_slider_transitions").hide();
	$(".kaya_slidelink").hide();
	$(".kaya_slidecaption").hide();
	$(".Kaya_slider_top").hide();
	$(".bx_transitions").hide();
	$(".customslider_type").hide();
	$(".kaya_slide_caption").hide();
	$(".auto_play").hide();
	$(".owl_slider_height").hide();
	$(".Single_slider_height").hide();
	$(".Kaya_portfolio_category").hide();
	$(".Kaya_portfolio_slider_height").hide();
	$(".navigation_bg_color").hide();
	$(".navigation_bg_hover_color").hide();
	$(".disable_slide_arrow_navigation").hide();
	$(".disable_slide_dots_navigation").hide();
	$(".slider_items").hide();
	$('.attachemnt_slider_note').hide();
	$(".Kaya_slider_category").hide();
	$(".slider_post_type").hide();
	$(".fluid_portfolio_category").hide();
	$(".Kaya_superslide_category").hide();
	$(".fluid_slider_post_type").hide();
	$(".Kaya_slider_limit").hide();
	$(".disable_slide_title").hide();
	$(".Kaya_fluid_slider_limit").hide();
	$(".Kaya_bx_slider_limit").hide();
	$(".Kaya_slider_pause").hide();
	$(".Kaya_slider_easing").hide();
	$(".adaptive_height").hide();
	$(".fluid_portfolio_order").hide();
	$(".kaya_portfolio_order").hide();
	$(".Kaya_fluid_slider_auto_play").hide();
	$(".kaya_slider_order").hide();
	$(".Kaya_slider_auto_play").hide();

	switch(selectlayout)
	{
	case 'superslider':
		$(".transitionStyle").show();
		$(".kaya_slide_caption").show();
		$(".auto_play").show();
		$(".Kaya_superslide_category").show();
		$(".owl_slider_height").show();
		$(".fluid_slider_post_type").show();
		$(".Kaya_fluid_slider_limit").show();
		$(".fluid_portfolio_order" ).show();
		$(".Kaya_fluid_slider_auto_play").show();
		fluid_slider_posttype();
		break;
	case 'bxslider':
		$(".Kaya_Sliders").show();
		$(".Kaya_slider_autoplay").show();
		$(".Kaya_slider_height").show();
		$(".Kaya_slider_transitions").show();
		$(".kaya_slidelink").show();
		$(".kaya_slidecaption").show();
		$(".Kaya_slider_top").show();
		$(".Kaya_bx_slider_limit").show();
		$(".Kaya_slider_pause").show();
		$(".Kaya_slider_easing").show();
		$(".adaptive_height").show();
		$(".kaya_slider_order").show();
		bx_slider_adaptive_height();

		break;
	case 'customslider':
		$(".customslider_type").show();
		break;
	case 'owlslider':
		$(".Kaya_portfolio_category").show();
		$(".Kaya_portfolio_slider_height").show();
		$(".navigation_bg_color").show();
		$(".navigation_bg_hover_color").show();
		$(".disable_slide_arrow_navigation").show();
		$(".disable_slide_dots_navigation").show();
		$(".slider_items").show();
		$(".slider_post_type").show();
		$(".Kaya_slider_limit").show();
		$(".disable_slide_title").show();
		$(".kaya_portfolio_order").show();
		$(".Kaya_slider_auto_play").show();
		$('.attachemnt_slider_note').show();
		page_slider_posttype();
		break;				
	
	}
}).change();

}
function page_slider_posttype(){
$("#slider_post_type").change(function () {	
	var selectlayout = $("#slider_post_type option:selected").val(); 
	$(".Kaya_slider_category").hide();
	$(".Kaya_portfolio_category").hide();

	switch(selectlayout)
	{
	case 'portfolio_category':
		$(".Kaya_portfolio_category").show();
		break;
	case 'slider_category':
		$(".Kaya_slider_category").show();
		break;
				
	
	}
}).change();
}
function fluid_slider_posttype(){
$("#fluid_slider_post_type").change(function () {	
	var selectlayout = $("#fluid_slider_post_type option:selected").val(); 
	$(".fluid_portfolio_category").hide();
	$(".Kaya_superslide_category").hide();

	switch(selectlayout)
	{
	case 'portfolio_category':
		$(".fluid_portfolio_category").show();
		break;
	case 'slider_category':
		$(".Kaya_superslide_category").show();
		break;
				
	
	}
}).change();
}
function bx_slider_adaptive_height(){
$("#adaptive_height").change(function () {	
	var selectlayout = $("#adaptive_height option:selected").val(); 
	$(".Kaya_slider_height").hide();
	switch(selectlayout)
	{
	case 'false':
		$(".Kaya_slider_height").show();
		break;
	case 'true':
		
		break;
				
	
	}
}).change();
}
$('input#attachemnt_slider_note').remove();
//page_slider_options();
    // Display only needed post meta boxes
    var Kaya_post_options = $('#post-formats-select input'),
        kaya_meta_link = $('#kaya_link_format'),
        kaya_pf_link = $('#post-format-link'),
        kaya_meta_gallery = $('#kaya_post_format_gallery'),
        kaya_pf_gallery = $('#post-format-gallery'),
        kaya_meta_video = $('#kaya_post_format_video'),
        kaya_pf_video = $('#post-format-video'),
        kaya_meta_audio = $('#kaya_audio_format'),
        kaya_pf_audio = $('#post-format-audio'),
        kaya_meta_quote = $('#kaya_quote_format_quote'),
        kaya_pf_quote = $('#post-format-quote');

    function kaya_hide_post_formates(){
        kaya_meta_link.css('display', 'none');
        kaya_meta_gallery.css('display', 'none');
        kaya_meta_video.css('display', 'none');
        kaya_meta_audio.css('display', 'none');
        kaya_meta_quote.css('display', 'none');
    }

    kaya_hide_post_formates();

    Kaya_post_options.on('change', function(){
        var that = $(this);
        kaya_hide_post_formates();
        if(that.val() === 'link'){
            kaya_meta_link.css('display', 'block');
        }else if(that.val() === 'gallery'){
            kaya_meta_gallery.css('display', 'block');
        }else if(that.val() === 'video'){
            kaya_meta_video.css('display', 'block');
        }else if(that.val() === 'audio'){
            kaya_meta_audio.css('display', 'block');
        }else if(that.val() === 'quote'){
            kaya_meta_quote.css('display', 'block');
        }
    });

    if(kaya_pf_link.is(':checked')) kaya_meta_link.css('display', 'block');
    if(kaya_pf_gallery.is(':checked')) kaya_meta_gallery.css('display', 'block');
    if(kaya_pf_video.is(':checked')) kaya_meta_video.css('display', 'block');
    if(kaya_pf_audio.is(':checked')) kaya_meta_audio.css('display', 'block');
    if(kaya_pf_quote.is(':checked')) kaya_meta_quote.css('display', 'block');
// hide Portfolio Post Information
$('#portfolio_slides').hide(); 
});
})(jQuery);