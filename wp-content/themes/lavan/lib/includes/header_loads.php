<?php
// juqery and css loads
add_action('wp_enqueue_scripts', 'kaya_jquery_scripts');
function kaya_jquery_scripts()
{
	$kaya_options = get_option('kayapati');
	wp_enqueue_script("jquery");
 	wp_enqueue_style('css_font_awesome', get_template_directory_uri() . '/css/font-awesome.css', false, '3.0', 'all');
	wp_localize_script( 'jquery', 'wppath', array('template_path' => get_template_directory_uri('template_directory')));
	wp_register_script( 'jquery_easing', KAYA_THEME_JS .'/jquery.easing.1.3.js',array(),'', true);	 // Easing	
	wp_register_script('jquery_bxslider', KAYA_THEME_JS .'/jquery.bxslider.js',array(),'', true);// Bx Slider js
	wp_register_style('css_bxslider', get_template_directory_uri() .'/css/widget_bxslider.css', false, '', 'all'); // Bx Slider css
	wp_enqueue_script("jquery_easing");
	wp_enqueue_script('jquery_bxslider');
	if( class_exists('woocommerce') ){
		wp_enqueue_style('css_woocommerce', get_template_directory_uri() .'/css/kaya_woocommerce.css', false, '', 'all'); // Woocommerce
	}
	// Load Slider Scripts and Styles
	//if(is_page()){
		// Suoer Slider
		wp_register_script('jquery.superslides', KAYA_THEME_JS .'/jquery.superslides.js',array(),'', true);
	    wp_register_script('jquery_hammer', KAYA_THEME_JS .'/hammer.min.js',array(),'', true);
	    wp_register_style('superslides', get_template_directory_uri().'/css/superslides.css',false, '', 'all');
	    //Sudo Slider
	    //wp_register_script('jquery_owlcarousel', KAYA_THEME_JS .'/owl.carousel.js',array(),'', true);
		wp_register_style('owl_carousel', get_template_directory_uri().'/css/owl.carousel.css',false, '', 'all');
		 wp_enqueue_script('cloud-zoom.1.0.2.min', KAYA_THEME_JS .'/cloud-zoom.1.0.2.min.js',array(),'', true);
		 wp_register_style('widgets-css', get_template_directory_uri().'/css/widgets.css',false, '', 'all');

	    wp_enqueue_script('jquery.superslides');
	    wp_enqueue_script('jquery_hammer');
	    wp_enqueue_script('jquery_owlcarousel');
	    wp_enqueue_style('owl_carousel');
	    wp_enqueue_style('superslides');
	     wp_enqueue_style('widgets-css');
	   
	//}
	wp_enqueue_script('jquery.prettyPhoto', KAYA_THEME_JS .'/jquery.prettyPhoto.js',array(),'', true); // for fancybox  script
	wp_enqueue_style('prettyPhoto', get_template_directory_uri() .'/css/prettyPhoto.css', false, '', 'all'); // for fancybox  css
	// Load Single Pages Scripts and Styles
	if(is_single()){ 
	// for BX slider
		wp_enqueue_script('jquery_bxslider');
		wp_enqueue_script("jquery_easing");
		wp_enqueue_script('jquery_fancybox_pack');
		wp_enqueue_style('css_bxslider');
		wp_enqueue_style('css_fancybox');
	}
	
		if (is_page_template('templates/template-contact.php') ){
			wp_register_script( 'jquery_contact', KAYA_THEME_JS .'/contact.js');
		wp_enqueue_script( 'jquery_contact');
	}	
	global $is_IE; // IE
    if( $is_IE ) {
		wp_enqueue_script('html5shim', '//html5shiv.googlecode.com/svn/trunk/html5.js', false, '1.1', true );
	}		
	// Isotop filter portfoloio
	wp_enqueue_script('jquery.isotope', KAYA_THEME_JS .'/jquery.isotope.min.js',array(),'', true);
  	wp_enqueue_style('css_Isotope', get_template_directory_uri().'/css/Isotope.css',false, '', 'all');
	wp_enqueue_script('jquery.fitvids', KAYA_THEME_JS .'/jquery.fitvids.js',array(),'', true);
	 //wp_register_script('jquery_fancybox_pack', KAYA_THEME_JS .'/fancybox/jquery.fancybox-1.3.4.pack.js',array(),'', true); // for fancybox  script
		wp_register_script( 'jquery_easing', KAYA_THEME_JS .'/jquery.easing.1.3.js',array(),'', true);	 // Easing	
		//wp_register_style('css_fancybox', KAYA_THEME_JS .'/fancybox/jquery.fancybox-1.3.4.css', false, '3.0', 'all'); // for fancybox  css

		wp_enqueue_script("jquery_easing");
		wp_enqueue_script('jquery_fancybox_pack');;
		wp_enqueue_style('css_fancybox');
	wp_enqueue_script("jquery_easing");
		wp_enqueue_script('jquery_fancybox_pack');
   //	wp_enqueue_script('jquery.nicescroll.min', KAYA_THEME_JS .'/jquery.nicescroll.min.js',array(),'3.5.4', true); // nice scroller
	wp_enqueue_script('jquery-custom', KAYA_THEME_JS .'/custom.js',array(),'', true);

}

//Styles
add_action('wp_enqueue_scripts', 'kaya_css_styles');

function kaya_css_styles() {
$kaya_options = get_option('kayapati');
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
}
	wp_enqueue_style( 'lavan-style', get_stylesheet_uri(), array() );
	//wp_enqueue_style('rtl', get_template_directory_uri() . '/rtl.css', true , '', 'all');
	wp_enqueue_style('css_portfolio', get_template_directory_uri() . '/css/portfolio.css',true, '3.0', 'all');
	wp_enqueue_style('css_slidemenu', get_template_directory_uri() . '/css/menu.css', true , '', 'all');
	wp_enqueue_style('css_skins', get_template_directory_uri().'/lib/includes/custom-skin.php', true, '', 'all');
	wp_register_style('css_responsive', get_template_directory_uri() . '/css/responsive.css', true, '3.0', 'all');
	//$responsive_mode=$kaya_options['Responsive_layout'] ? $kaya_options['Responsive_layout'] : '0';
	  $responsive_mode = get_theme_mod( 'responsive_layout_mode' ) ? get_theme_mod( 'responsive_layout_mode' ) : 'on';
 
if($responsive_mode == "on"){
	wp_enqueue_style('css_responsive');
	}
	// Google Font
	//--------------------------------------
	
    $google_bodyfont=get_theme_mod( 'google_body_font', '' ) ? get_theme_mod( 'google_body_font', '' ) : 'Open Sans';
	$google_menufont=get_theme_mod( 'google_menu_font', '' ) ? get_theme_mod( 'google_menu_font', '' ) : 'Offside';
	$google_generaltitlefont=get_theme_mod( 'google_heading_font', '' ) ? get_theme_mod( 'google_heading_font', '' ) : 'Gafata';

	$protocol = is_ssl() ? 'https' : 'http';
	if( $google_generaltitlefont ){
    	wp_enqueue_style( 'title_googlefonts', $protocol.'://fonts.googleapis.com/css?family='. urlencode( $google_generaltitlefont ).'&subset=latin,cyrillic-ext,greek-ext,greek,cyrillic');
	}
	if( $google_menufont ){
    	wp_enqueue_style( 'google_menufont', $protocol.'://fonts.googleapis.com/css?family='. urlencode( $google_menufont ).'&subset=latin,cyrillic-ext,greek-ext,greek,cyrillic');
	}
	if( $google_bodyfont ){
    	wp_enqueue_style( 'google_bodyfont', $protocol.'://fonts.googleapis.com/css?family='. urlencode( $google_bodyfont ).'&subset=latin,cyrillic-ext,greek-ext,greek,cyrillic');
	}


 /*	wp_register_style( 'lavan-ie', get_template_directory_uri() . '/css/ie9_down.css' );
    $GLOBALS['wp_styles']->add_data( 'lavan-ie', 'conditional', 'lt IE 9' );
    wp_enqueue_style( 'wpse45851-ie' );
    */
}

//Admin script
add_action('admin_enqueue_scripts', 'kaya_admin_scripts');

function kaya_admin_scripts()
{
	wp_enqueue_script('kaya_custommeta', KAYA_DIRECTORY.'/js/kaya_custommeta.js');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_style('admin_styles', get_template_directory_uri() .'/css/admin_styles.css', false, '', 'all'); // Bx Slider css

}
function theme_customizer_js(){
	wp_enqueue_script('jquery_theme-customizer', KAYA_THEME_JS .'/theme-customizer.js',array(),'', true);
	wp_enqueue_style('customizer_styles', get_template_directory_uri() . '/css/customizer_styles.css', false, '', 'all');
}
add_action( 'customize_controls_enqueue_scripts', 'theme_customizer_js',100 );

if( !function_exists('globel_customize_preview_js') ){
	function globel_customize_preview_js() {
		wp_enqueue_script( 'customizer', get_template_directory_uri() . '/js/customizer.js', array( 'jquery', 'customize-preview' ), '' , true );
	}
}
add_action( 'customize_preview_init', 'globel_customize_preview_js' );
?>