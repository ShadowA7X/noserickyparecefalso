( function( $ ) {
//alert('load');
//body
// Fonts
var subset = ['latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese'];
var font_weights = ['100', '100italic', '200', '200italic', '300', '300italic', '400', '400italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic'];
// Logo
wp.customize('header_text_logo_font_family', function(  value ){
	value.bind(function(to){
	if( '0' != to){
		var replacestring = to.split(' ').join('+');
		var google_logo_font ='http://fonts.googleapis.com/css?family='+replacestring;
		var logo_font_family = '.header_logo_section h1.logo a,  .header_logo_section h1.sticky_logo a, #right_header_section  h1.logo a, #left_header_section  h1.logo a{ font-family:'+ to +'!important}';
		if($(document).find('#google_logo_font').length) {
				$(document).find('#google_logo_font').remove();
			}
		if($(document).find('#logo_font_family').length) {
				$(document).find('#logo_font_family').remove();
			}	
		$(document).find('head').append($("<link id='google_logo_font' href='"+ google_logo_font +":"+font_weights+"&subset="+subset+"' rel='stylesheet' type='text/css'><style id='logo_font_family'>" + logo_font_family + "</style>"));
	}else{
		$(document).find('#logo_font_family').remove();
		$(document).find('#google_logo_font').remove();
		var logo_font_family = '.header_logo_section h1.logo a, .header_logo_section h1.sticky_logo a{ font-family:arial!important}';
		$(document).find('head').append($("<style>" + logo_font_family + "</style>"));
	}
	});
});
// Tag Line
// Logo
wp.customize('text_logo_tagline_font_family', function(  value ){
	value.bind(function(to){
	if( '0' != to){
		var replacestring = to.split(' ').join('+');
		var text_logo_tagline_font_family ='http://fonts.googleapis.com/css?family='+replacestring;
		var tagline_font_family = '.header_logo_section .logo_tag_line{ font-family:'+ to +'!important}';
		if($(document).find('#text_logo_tagline_font_family').length) {
				$(document).find('#text_logo_tagline_font_family').remove();
			}
		if($(document).find('#tagline_font_family').length) {
				$(document).find('#tagline_font_family').remove();
			}	
		$(document).find('head').append($("<link id='text_logo_tagline_font_family' href='"+ text_logo_tagline_font_family +":"+font_weights+"&subset="+subset+"' rel='stylesheet' type='text/css'><style id='tagline_font_family'>" + tagline_font_family + "</style>"));
	}else{
		$(document).find('#tagline_font_family').remove();
		$(document).find('#text_logo_tagline_font_family').remove();
		var tagline_font_family = '.header_logo_section .logo_tag_line, #right_header_section .logo_tag_line, #left_header_section .logo_tag_line{ font-family:arial!important}';
		$(document).find('head').append($("<style>" + tagline_font_family + "</style>"));
	}
	});
});

wp.customize('google_body_font', function(  value ){
	value.bind(function(to){
	if( '0' != to){
		var replacestring = to.split(' ').join('+');
		var google_body_font ='http://fonts.googleapis.com/css?family='+replacestring;
		var body_font_family = 'body ,p, a{ font-family:'+ to +'!important}';
		if($(document).find('#google_body_font').length) {
				$(document).find('#google_body_font').remove();
			}
		if($(document).find('#body_font_family').length) {
				$(document).find('#body_font_family').remove();
			}	
		$(document).find('head').append($("<link id='google_body_font' href='"+ google_body_font +":"+font_weights+"&subset="+subset+"' rel='stylesheet' type='text/css'><style id='body_font_family'>" + body_font_family + "</style>"));
	}else{
		$(document).find('#body_font_family').remove();
		$(document).find('#google_body_font').remove();
		var body_font_family = 'body ,p, a{ font-family:arial!important}';
		$(document).find('head').append($("<style>" + body_font_family + "</style>"));
	}
	});
});

wp.customize('google_heading_font', function(  value ){
	value.bind(function(to){
	if( '0' != to){	
		var replacestring = to.split(' ').join('+');
		var google_heading_font ='http://fonts.googleapis.com/css?family='+replacestring;
		var heading_font_family = 'h1,h2,h3,h4,h5,h6{ font-family:'+ to +'!important}';
		if($(document).find('#google_heading_font').length) {
				$(document).find('#google_heading_font').remove();
			}
		if($(document).find('#heading_font_family').length) {
				$(document).find('#heading_font_family').remove();
			}	
		$(document).find('head').append($("<link id='google_heading_font' href='"+ google_heading_font +":"+font_weights+"&subset="+subset+"' rel='stylesheet' type='text/css'><style id='heading_font_family'>" + heading_font_family + "</style>"));
	}else{
		$(document).find('#google_heading_font').remove();
		$(document).find('#heading_font_family').remove();
		var heading_font_family = 'h1,h2,h3,h4,h5,h6{ font-family:arial!important}';
		$(document).find('head').append($("<style" + heading_font_family + "</style>"));
	}	
	});
});

wp.customize('google_menu_font', function(  value ){
	value.bind(function(to){
	if( '0' != to){	
		var replacestring = to.split(' ').join('+');
		var google_menu_font ='http://fonts.googleapis.com/css?family='+replacestring;
		var menu_font_family = '.menu ul li a{ font-family:'+ to +'!important}';
		if($(document).find('#google_menu_font').length) {
				$(document).find('#google_menu_font').remove();
			}
		if($(document).find('#menu_font_family').length) {
				$(document).find('#menu_font_family').remove();
			}	
		$(document).find('head').append($("<link id='google_menu_font' href='"+ google_menu_font +":"+font_weights+"&subset="+subset+"' rel='stylesheet' type='text/css'><style id='menu_font_family'>" + menu_font_family + "</style>"));

	}else{
		$(document).find('#google_menu_font').remove();
		$(document).find('#menu_font_family').remove();
		var menu_font_family = '.menu ul li a{ font-family:arial!important}';
		$(document).find('head').append($("<style>" + menu_font_family + "</style>"));
	}	
});
});
} )( jQuery );