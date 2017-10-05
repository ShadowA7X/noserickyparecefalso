(function($) {
  "use strict";
  $(function() {

  // On change
     $('.kaya-radio-img').click(function() {
    $('.kaya-radio-img-selected').removeClass('kaya-radio-img-selected');
    $(this).addClass('kaya-radio-img-selected').children('input[@type="radio"]').prop('checked', true);
   });

  //on change
	$('#customize-control-theme_layout_mode input').change(function(){
		$('#customize-control-select_fullscreen_background_type').show().removeClass('customize-control-options-remove');
		$('#customize-control-fullscreen').show().removeClass('customize-control-options-remove');
		$('#customize-control-fullscreen_bg_img_repeat').show().removeClass('customize-control-options-remove');
		$('#customize-control-boxed_layout_bg_attatchment').show().removeClass('customize-control-options-remove');
		$('#customize-control-layout_bg_color').show().removeClass('customize-control-options-remove');
		$('#customize-control-layout_margin_top').show().removeClass('customize-control-options-remove');
		$('#customize-control-layout_margin_bottom').show().removeClass('customize-control-options-remove');
		$('#customize-control-boxed_layout_shadow').show().removeClass('customize-control-options-remove');	
		fullscreen_bg_type()
	var select_val = $('#customize-control-theme_layout_mode input:checked').val();
	if( select_val == 'fluid' ){
		$('#customize-control-layout_margin_top').hide().addClass('customize-control-options-remove');
		$('#customize-control-layout_margin_bottom').hide().addClass('customize-control-options-remove');
		$('#customize-control-boxed_layout_shadow').hide().addClass('customize-control-options-remove');
		$('#customize-control-select_fullscreen_background_type').hide().addClass('customize-control-options-remove');
		$('#customize-control-fullscreen').hide().addClass('customize-control-options-remove');
		$('#customize-control-layout_bg_color').hide().addClass('customize-control-options-remove');
		$('#customize-control-fullscreen_bg_img_repeat').hide().addClass('customize-control-options-remove');
		$('#customize-control-boxed_layout_bg_attatchment').hide().addClass('customize-control-options-remove');						
			}
	}).change();
//fullscreen bg type
function fullscreen_bg_type(){
$('#customize-control-select_fullscreen_background_type select').change(function(){
  $('#customize-control-fullscreen').hide().addClass('customize-control-options-remove');
  $('#customize-control-fullscreen_bg_img_repeat').hide().addClass('customize-control-options-remove');
  $('#customize-control-boxed_layout_bg_attatchment').hide().addClass('customize-control-options-remove');
  $('#customize-control-layout_bg_color').hide().addClass('customize-control-options-remove');
  var fullscreen_type = $('#customize-control-select_fullscreen_background_type select option:selected').val();
  switch( fullscreen_type ){
    case 'bg_type_color':
		$('#customize-control-layout_bg_color').show().removeClass('customize-control-options-remove');
      break;
    case 'bg_type_image':
      $('#customize-control-fullscreen').show().removeClass('customize-control-options-remove');
      $('#customize-control-fullscreen_bg_img_repeat').show().removeClass('customize-control-options-remove');
      $('#customize-control-boxed_layout_bg_attatchment').show().removeClass('customize-control-options-remove');
      break;
    case 'default':
      break;    
  }
}).change();
}
// Header Image Upload 
$('#customize-control-select_header_background_type select').change(function(){
	$('#customize-control-bg_image').hide().addClass('customize-control-options-remove');
	$('#customize-control-header_img_repeat').hide().addClass('customize-control-options-remove');
	$('#customize-control-header_bg_color').hide().addClass('customize-control-options-remove');
	var header_bg_type = $('#customize-control-select_header_background_type select option:selected').val();
	switch( header_bg_type ){
		case 'bg_type_color':
			$('#customize-control-header_bg_color').show().removeClass('customize-control-options-remove');
			break;
		case 'bg_type_image':
			$('#customize-control-bg_image').show().removeClass('customize-control-options-remove');
			$('#customize-control-header_img_repeat').show().removeClass('customize-control-options-remove');
			break;
		case 'default':
			break;		
	}
}).change();
//footer type
$('#customize-control-select_footer_type select').change(function(){
	$('#customize-control-main_footer_disable').hide().addClass('customize-control-options-remove');
	$('#customize-control-select_footer_background_type').hide().addClass('customize-control-options-remove');
	$('#customize-control-main_footer_columns').hide().addClass('customize-control-options-remove');
	$('#customize-control-footer_bg').hide().addClass('customize-control-options-remove');
	$('#customize-control-footer_bg_repeat').hide().addClass('customize-control-options-remove');
	$('#customize-control-footer_bg_top_color').hide().addClass('customize-control-options-remove');
	$('#customize-control-footer_bg_color').hide().addClass('customize-control-options-remove');
	$('#customize-control-footer_title_color').hide().addClass('customize-control-options-remove');
	$('#customize-control-footer_text_color').hide().addClass('customize-control-options-remove');
	$('#customize-control-footer_link_color').hide().addClass('customize-control-options-remove');
	$('#customize-control-footer_link_hover_color').hide().addClass('customize-control-options-remove');
	$('#customize-control-footer_page_id').hide().addClass('customize-control-options-remove');
	$('#customize-control-page_footer_note').hide().addClass('customize-control-options-remove');
var footer_type = $('#customize-control-select_footer_type select option:selected').val();
switch( footer_type ){
	case 'main_footer':
		$('#customize-control-main_footer_disable').show().removeClass('customize-control-options-remove');
		$('#customize-control-main_footer_columns').show().removeClass('customize-control-options-remove');
		$('#customize-control-footer_bg').show().removeClass('customize-control-options-remove');
		$('#customize-control-footer_bg_repeat').show().removeClass('customize-control-options-remove');
		$('#customize-control-footer_bg_top_color').show().removeClass('customize-control-options-remove');
		$('#customize-control-footer_bg_color').show().removeClass('customize-control-options-remove');
		$('#customize-control-footer_title_color').show().removeClass('customize-control-options-remove');
		$('#customize-control-footer_text_color').show().removeClass('customize-control-options-remove');
		$('#customize-control-footer_link_color').show().removeClass('customize-control-options-remove');
		$('#customize-control-footer_link_hover_color').show().removeClass('customize-control-options-remove');
		main_footer_disable();
		break;
	case 'page_footer':	
		$('#customize-control-footer_page_id').show().removeClass('customize-control-options-remove');
		$('#customize-control-page_footer_note').show().removeClass('customize-control-options-remove');
		break;
	case 'default':
		break;	
}
}).change();
// Hide page footer
	function main_footer_disable(){
		$('#customize-control-main_footer_disable input').change(function(){
			$('#customize-control-main_footer_columns').show().removeClass('customize-control-options-remove');
			$('#customize-control-select_footer_background_type').show().removeClass('customize-control-options-remove');
			$('#customize-control-footer_bg').show().removeClass('customize-control-options-remove');
			$('#customize-control-footer_bg_repeat').show().removeClass('customize-control-options-remove');
			$('#customize-control-footer_bg_color').show().removeClass('customize-control-options-remove');
			$('#customize-control-footer_bg_top_color').show().removeClass('customize-control-options-remove');			
			$('#customize-control-footer_title_color').show().removeClass('customize-control-options-remove');
			$('#customize-control-footer_text_color').show().removeClass('customize-control-options-remove');
			$('#customize-control-footer_link_color').show().removeClass('customize-control-options-remove');
			$('#customize-control-footer_link_hover_color').show().removeClass('customize-control-options-remove');
	
			var main_footer_disable = $('#customize-control-main_footer_disable input').is(':checked');
			if( main_footer_disable ){				
				footer_bg_type();
				$('#customize-control-footer_bg').hide().addClass('customize-control-options-remove');
				$('#customize-control-footer_bg_repeat').hide().addClass('customize-control-options-remove');
				$('#customize-control-main_footer_bg_color').hide().addClass('customize-control-options-remove');
				$('#customize-control-main_footer_columns').hide().addClass('customize-control-options-remove');
				$('#customize-control-select_footer_background_type').hide().addClass('customize-control-options-remove');
				$('#customize-control-footer_bg').hide().addClass('customize-control-options-remove');
				$('#customize-control-footer_bg_repeat').hide().addClass('customize-control-options-remove');
				$('#customize-control-footer_bg_color').hide().addClass('customize-control-options-remove');
				$('#customize-control-footer_bg_top_color').hide().addClass('customize-control-options-remove');
				$('#customize-control-footer_title_color').hide().addClass('customize-control-options-remove');
				$('#customize-control-footer_text_color').hide().addClass('customize-control-options-remove');
				$('#customize-control-footer_link_color').hide().addClass('customize-control-options-remove');
				$('#customize-control-footer_link_hover_color').hide().addClass('customize-control-options-remove');

			}else{
				footer_bg_type();			
			}
		}).change();
	}
	// Footer Background select
	function footer_bg_type(){
		$('#customize-control-select_footer_background_type select').change(function(){
			$('#customize-control-footer_bg').hide().addClass('customize-control-options-remove');
			$('#customize-control-footer_bg_repeat').hide().addClass('customize-control-options-remove');
			$('#customize-control-footer_bg_color').hide().addClass('customize-control-options-remove');
			var footer_bg_type = $('#customize-control-select_footer_background_type select option:selected').val();
			switch( footer_bg_type ){
				case 'bg_type_color':
					$('#customize-control-footer_bg_color').show().removeClass('customize-control-options-remove');
					break;
				case 'bg_type_image':
					$('#customize-control-footer_bg').show().removeClass('customize-control-options-remove');
					$('#customize-control-footer_bg_repeat').show().removeClass('customize-control-options-remove');
					break;
				case 'default':
					break;		
			}
		}).change();
	}
// Logo Change
$('#customize-control-select_header_logo_type select').change(function(){
	$('#customize-control-upload_logo').hide().addClass('customize-control-options-remove');
	$('#customize-control-header_text_logo').hide().addClass('customize-control-options-remove');
	$('#customize-control-logo_text_font_color').hide().addClass('customize-control-options-remove');
	$('#customize-control-text_logo_size').hide().addClass('customize-control-options-remove');
	$('#customize-control-header_logo_font_style').hide().addClass('customize-control-options-remove');
	$('#customize-control-header_logo_font_weight').hide().addClass('customize-control-options-remove');
	$('#customize-control-header_text_logo_font_family').hide().addClass('customize-control-options-remove');
	$('#customize-control-logo_margin_top').show().removeClass('customize-control-options-remove');
	$('#customize-control-logo_margin_bottom').show().removeClass('customize-control-options-remove');
	$('#customize-control-header_text_logo_tagline').hide().addClass('customize-control-options-remove');
	$('#customize-control-logo_tag_line_sub_title').hide().addClass('customize-control-options-remove');
	$('#customize-control-logo_tagline_size').hide().addClass('customize-control-options-remove');
	$('#customize-control-logo_tagline_font_weight').hide().addClass('customize-control-options-remove');
	$('#customize-control-logo_tagline_font_style').hide().addClass('customize-control-options-remove');
	$('#customize-control-logo_tagline_letter_spacing').hide().addClass('customize-control-options-remove');
	$('#customize-control-text_logo_tagline_font_family').hide().addClass('customize-control-options-remove');
	$('#customize-control-logo_tagline_font_color').hide().addClass('customize-control-options-remove');
	var header_bg_type = $('#customize-control-select_header_logo_type select option:selected').val();
	switch( header_bg_type ){
		case 'image_logo':
			$('#customize-control-upload_logo').show().removeClass('customize-control-options-remove');
			break;
		case 'text_logo':
			$('#customize-control-header_text_logo').show().removeClass('customize-control-options-remove');
			$('#customize-control-logo_text_font_color').show().removeClass('customize-control-options-remove');
			$('#customize-control-text_logo_size').show().removeClass('customize-control-options-remove');
			$('#customize-control-header_logo_font_style').show().removeClass('customize-control-options-remove');
			$('#customize-control-header_logo_font_weight').show().removeClass('customize-control-options-remove');
			$('#customize-control-header_text_logo_font_family').show().removeClass('customize-control-options-remove');
			$('#customize-control-header_text_logo_tagline').show().removeClass('customize-control-options-remove');
			$('#customize-control-logo_tag_line_sub_title').show().removeClass('customize-control-options-remove');
			$('#customize-control-logo_tagline_size').show().removeClass('customize-control-options-remove');
			$('#customize-control-logo_tagline_font_weight').show().removeClass('customize-control-options-remove');
			$('#customize-control-logo_tagline_font_style').show().removeClass('customize-control-options-remove');
			$('#customize-control-logo_tagline_letter_spacing').show().removeClass('customize-control-options-remove');
			$('#customize-control-text_logo_tagline_font_family').show().removeClass('customize-control-options-remove');
			$('#customize-control-logo_tagline_font_color').show().removeClass('customize-control-options-remove');
			break;
		case 'none':
			$('#customize-control-logo_margin_top').hide().addClass('customize-control-options-remove');
			$('#customize-control-logo_margin_bottom').hide().addClass('customize-control-options-remove');	
		case 'default':
			break;		
	}
}).change();
//end
//page titlebar
$('#customize-control-select_page_title_background_type select').change(function(){
  $('#customize-control-page_title_bar').hide().addClass('customize-control-options-remove');
  $('#customize-control-page_title_bar_bg_repeat').hide().addClass('customize-control-options-remove');
  $('#customize-control-page_titlebar_title_color').hide().addClass('customize-control-options-remove');
  $('#customize-control-page_titlebar_bg_color').hide().addClass('customize-control-options-remove');
  var page_titlebar_bg_type = $('#customize-control-select_page_title_background_type select option:selected').val();
  switch( page_titlebar_bg_type ){
    case 'bg_type_color':
      $('#customize-control-page_titlebar_bg_color').show().removeClass('customize-control-options-remove');
      $('#customize-control-page_titlebar_title_color').show().removeClass('customize-control-options-remove');
       break;
    case 'bg_type_image':
      $('#customize-control-page_title_bar').show().removeClass('customize-control-options-remove');
      $('#customize-control-page_title_bar_bg_repeat').show().removeClass('customize-control-options-remove');
      $('#customize-control-page_titlebar_title_color').show().removeClass('customize-control-options-remove');
      break;
    case 'default':
      break;    
  }
}).change();
//end
// Portfolio Category
	$('#customize-control-pf_page_sidebar input').change(function(){
		$('#customize-control-pf_sidebar_id').show().removeClass('customize-control-options-remove');
		var sidebar_data = $('#customize-control-pf_page_sidebar input:checked' ).val();
		if( sidebar_data == 'fullwidth'	 ){
			$('#customize-control-pf_sidebar_id').hide().addClass('customize-control-options-remove');			
		}
	}).change();
//end
// Most footer bottom 
	$('#customize-control-select_most_footer_style select').change(function(){
		$('#customize-control-most_footer_left_section').hide().addClass('customize-control-options-remove');
		//$('#customize-control-footer_left_section_title').hide().addClass('customize-control-options-remove');
		$('#customize-control-footer_menu_left_note').hide().addClass('customize-control-options-remove');

		$('#customize-control-most_footer_right_section').hide().addClass('customize-control-options-remove');
		//$('#customize-control-footer_right_section_title').hide().addClass('customize-control-options-remove');
		$('#customize-control-footer_menu_right_note').hide().addClass('customize-control-options-remove');
		$('#customize-control-footer_left_section_title').show().removeClass('customize-control-options-remove');
		
		$('#customize-control-footer_right_section_title').show().removeClass('customize-control-options-remove');
		$('#customize-control-most_footer_bg_color').show().removeClass('customize-control-options-remove');
		$('#customize-control-most_footer_text_color').show().removeClass('customize-control-options-remove');
		$('#customize-control-most_footer_link_color').show().removeClass('customize-control-options-remove');
		$('#customize-control-most_footer_link_hover_color').show().removeClass('customize-control-options-remove');
		$('#customize-control-footer_left_right_color_title').show().removeClass('customize-control-options-remove');
		var most_footer_style = $('#customize-control-select_most_footer_style select option:selected').val();
		switch( most_footer_style ){
			case 'left_content_right_menu':
				$('#customize-control-most_footer_left_section').show().removeClass('customize-control-options-remove');
				$('#customize-control-footer_menu_right_note').show().removeClass('customize-control-options-remove');
				break;
			case 'left_menu_right_content':
				$('#customize-control-footer_menu_left_note').show().removeClass('customize-control-options-remove');
				$('#customize-control-most_footer_right_section').show().removeClass('customize-control-options-remove');
				break;
			case 'left_content_right_content':
				$('#customize-control-most_footer_left_section').show().removeClass('customize-control-options-remove');
				$('#customize-control-most_footer_right_section').show().removeClass('customize-control-options-remove');
				break;
			case 'center_content_center_menu':
				$('#customize-control-most_footer_left_section').show().removeClass('customize-control-options-remove');
				$('#customize-control-footer_menu_right_note').show().removeClass('customize-control-options-remove');
				break;
			case 'none':
				$('#customize-control-footer_left_section_title').hide().addClass('customize-control-options-remove');
				$('#customize-control-footer_right_section_title').hide().addClass('customize-control-options-remove');
				$('#customize-control-most_footer_bg_color').hide().addClass('customize-control-options-remove');
				$('#customize-control-most_footer_text_color').hide().addClass('customize-control-options-remove');
				$('#customize-control-most_footer_link_color').hide().addClass('customize-control-options-remove');
				$('#customize-control-most_footer_link_hover_color').hide().addClass('customize-control-options-remove');
				$('#customize-control-footer_left_right_color_title').hide().addClass('customize-control-options-remove');
				break;		
			case 'default':
				break;
		}
	}).change();




});
})(jQuery);


// JavaScript Document

jQuery(document).ready(function($) {
	
	$('.tut-customize-image-picker .tut-remove').click(function(e) {
		// functionality for remove image/logo button
		
		// remove the img tag
        $(this).siblings('.current-image').children('div').html('');
		
		// remove the hidden input filed
		// unless you call change() function wordpress will not acknowledge the change and the save button will remain deactive
		$(this).siblings('.current-image').children('input[type=hidden]').val('').change();
		
		// remove the remove button itself
		$(this).hide();
		
    });
	
    $('.tut-customize-image-picker #media-uploader').click(function(e) {
		
		var current_item = $(this);
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		
		
			var original_send_to_editor = window.send_to_editor;
			window.send_to_editor = function(html) {
				 var imgurl = jQuery('img',html).attr('src');
				 var name = _uploader.id;
				// console.log(name);
				 current_item.siblings('.current-image').children('div').html('<img src="'+imgurl+'">');
				 current_item.siblings('.current-image').children('input[type=hidden]').val(imgurl).change();
				 current_item.siblings('.tut-remove').show();
				 tb_remove();
	 			window.send_to_editor = original_send_to_editor;
			}
		
		return false;
    });
});