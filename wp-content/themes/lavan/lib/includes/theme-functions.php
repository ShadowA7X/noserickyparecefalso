<?php
/* These are functions specific to the included option settings and this theme */
/*-----------------------------------------------------------------------------------*/
/* Theme Header Output - wp_head() */
/*-----------------------------------------------------------------------------------*/

/* Add Body Classes for Layout

/*-----------------------------------------------------------------------------------*/
// This used to be done through an additional stylesheet call, but it seemed like
// a lot of extra files for something so simple. Adds a body class to indicate sidebar position.

add_filter('body_class','kaya_body_class');
function kaya_body_class($classes) {

  $shortname =  get_option('kaya_shortname');

  $layout = get_option($shortname .'_layout');

  if ($layout == '') {

    $layout = 'layout-2cr cbp-spmenu-push';

  }

  $classes[] = $layout;

  return $classes;

}


/*-----------------------------------------------------------------------------------*/

/* Add Favicon

/*-----------------------------------------------------------------------------------*/
function favicon() {
  $favicon = get_option('favicon'); 
    if ($favicon['favi_img']) {
    echo '<link rel="shortcut icon" href="'.  $favicon['favi_img']  .'"/>'."\n";
  }
}
add_action('wp_head', 'favicon');
/*-----------------------------------------------------------------------------------*/

/* Custom CSS

/*-----------------------------------------------------------------------------------*/
if( !function_exists('custom_css') ){
    function custom_css() {
    $kaya_custom_css = get_theme_mod('kaya_custom_css') ? get_theme_mod('kaya_custom_css') : '';
    if($kaya_custom_css)
        {
          echo '<style>';
          echo $kaya_custom_css;
          echo '</style>';
        }
    }
}

add_action('wp_head', 'custom_css');
/*-----------------------------------------------------------------------------------*/

/* Custom JS

/*-----------------------------------------------------------------------------------*/
if( !function_exists('custom_js') ){
  function custom_js() {
    $kaya_custom_js = get_theme_mod('kaya_custom_jquery') ? get_theme_mod('kaya_custom_jquery') : '';
    if($kaya_custom_js)
    { 
      echo '<script>';
      echo $kaya_custom_js; 
      echo '</script>';
    }
  }
}
add_action('wp_head', 'custom_js');
/*-----------------------------------------------------------------------------------*/

/* Show analytics code in footer */

/*-----------------------------------------------------------------------------------*/

function childtheme_analytics(){

  $shortname =  get_option('kaya_shortname');

  $output = get_option($shortname . '_google_analytics');

  if ( $output <> "" ) 

    echo stripslashes($output) . "\n";

}

add_action('wp_footer','childtheme_analytics');


function kaya_subheader_data(){
  global $post_item_id, $post;
  echo  kaya_post_item_id();

    if( class_exists('woocommerce') ){
        if( is_shop() ){
          $select_page_options=get_post_meta( woocommerce_get_page_id( 'shop' ),'select_page_options',true);
        }else{ if( get_post() ) { $select_page_options=get_post_meta(get_the_ID(),'select_page_options',true); } else{ $select_page_options = ''; } }
    }elseif( is_page()){
         $select_page_options=get_post_meta($post->ID,'select_page_options',true);
    }else{
        $select_page_options = '';
    }
// Select Page Sub header Options
  if( $select_page_options == 'page_slider_setion'){
     kaya_image_slider(); 
  }
  elseif($select_page_options=="singleimage"){
     get_template_part('slider/single','image');
  }
  elseif($select_page_options=="video"){
    get_template_part('slider/video','slider');
  }
  elseif($select_page_options == 'page_title_setion'){
     kaya_custom_pagetitle($post_item_id); 
  }
  else{
    if( is_single() || is_tax() || is_archive() || is_404() ){
         kaya_custom_pagetitle($post_item_id); 
    }else{
      if( is_page() ){
        //echo '<div class="vspace">&nbsp;</div>';
      }
    }

  }

// Page Title
}
add_action('kaya_subheader_data','kaya_subheader_data');

// Social Icons

function kaya_social_icons(){
$search=get_option('search');
$src=get_template_directory_uri() . '/images/social_icons';

$socialmedia_icon1_img_src = get_option('social_icon1');
$socialmediaicon1 = $socialmedia_icon1_img_src['upload_social_icon1'] ? str_replace('&nbsp;', '', $socialmedia_icon1_img_src['upload_social_icon1'])    : $src.'/facebook.png';
$right_social_icon_link1=get_theme_mod('right_social_icon_link1') ? get_theme_mod('right_social_icon_link1'): '';

$socialmedia_icon2_img_src = get_option('social_icon2');
$socialmediaicon2 = $socialmedia_icon2_img_src['upload_social_icon2'] ? str_replace('&nbsp;', '',$socialmedia_icon2_img_src['upload_social_icon2'])   : $src.'/twitter.png';
 $right_social_icon_link2=get_theme_mod('right_social_icon_link2') ? get_theme_mod('right_social_icon_link2'): '';

$socialmedia_icon3_img_src = get_option('social_icon3');
$socialmediaicon3 = $socialmedia_icon3_img_src['upload_social_icon3'] ? str_replace('&nbsp;', '', $socialmedia_icon3_img_src['upload_social_icon3'])  : $src.'/pinrest.png';
$right_social_icon_link3=get_theme_mod('right_social_icon_link3') ? get_theme_mod('right_social_icon_link3'): '';

$socialmedia_icon4_img_src = get_option('social_icon4');
$socialmediaicon4 = $socialmedia_icon4_img_src['upload_social_icon4'] ? str_replace('&nbsp;', '', $socialmedia_icon4_img_src['upload_social_icon4'])    : $src.'/forest.png';
$right_social_icon_link4=get_theme_mod('right_social_icon_link4') ? get_theme_mod('right_social_icon_link4'): '';

$socialmedia_icon5_img_src = get_option('social_icon5');
$socialmediaicon5 = $socialmedia_icon5_img_src['upload_social_icon5'] ? str_replace('&nbsp;', '', $socialmedia_icon5_img_src['upload_social_icon5'] )   : $src.'/stumbleupon.png';
$right_social_icon_link5=get_theme_mod('right_social_icon_link5') ? get_theme_mod('right_social_icon_link5'): '';
 
if(!empty($socialmediaicon1 ) || (!empty($socialmediaicon2)) || (!empty($socialmediaicon3)) || (!empty($socialmediaicon4)) || (!empty($socialmediaicon5))){

    echo '<div class="header_social_icons">';  
if( trim($socialmediaicon1) ){
          echo '<a href="'.$right_social_icon_link1.'" target="_blank"><img class="icon1" src="'.$socialmediaicon1.'" class="header_social_icons" /></a>';
         }
 //end
if( trim($socialmediaicon2) ){
         echo '<a href="'.$right_social_icon_link2.'" target="_blank"><img  class="icon2" src="'.$socialmediaicon2.'" class="header_social_icons"/></a>';
    }    
//end
if( trim($socialmediaicon3) ){
         echo '<a href="'.$right_social_icon_link3.'" target="_blank"><img class="icon3" src="'.$socialmediaicon3.'" class="header_social_icons"/></a>';
         } 
//end
if( trim($socialmediaicon4) ){
         echo '<a href="'.$right_social_icon_link4.'" target="_blank"><img class="icon4" src="'.$socialmediaicon4.'" class="header_social_icons"/></a>';
        }
 //end
if( trim($socialmediaicon5) ){
         echo '<a href="'.$right_social_icon_link5.'" target="_blank"><img class="icon5" src="'.$socialmediaicon5.'" class="header_social_icons"/></a>';
        }
      echo '</div>';
}
//end
//if($header_right_social_icons){  ?>
<div class="header_social_icons">
<?php // Socail Icons
$defaut_search = get_template_directory_uri().'/images/search.png';
//$header_search_icon = $search['icon_upload'] ? $search['icon_upload'] : $defaut_search; 
 ?>
 <?php $disable_search_box = get_theme_mod('disable_search_box') ? get_theme_mod('disable_search_box') : '0'; 
    if( $disable_search_box == '0' ): ?>
    <a href="#"  class="search-toggle"><i class="fa fa-search"> </i>
    <div id="search-container" class="search-box-wrapper hide"> </a>
        <div class="search-box">
          <?php get_search_form(); ?>
        </div>

    </div>  
    <?php endif; ?>
<?php  //echo do_shortcode($header_right_social_icons);  ?>
</div>

<?php  }
/* Theme customization */
function kaya_custom_colors(){
  // Logo Section
   global $post;
   // Layout Options
$fullscreen = get_option('fullscreen');
$select_fullscreen_background_type = get_theme_mod('select_fullscreen_background_type') ? get_theme_mod('select_fullscreen_background_type') : 'bg_type_color' ;  
$fullscreen_bg_img_repeat = get_theme_mod('fullscreen_bg_img_repeat') ? get_theme_mod('fullscreen_bg_img_repeat') : 'repeat' ; 
$boxed_layout_bg_attatchment = get_theme_mod('boxed_layout_bg_attatchment') ? get_theme_mod('boxed_layout_bg_attatchment') : 'fixed' ; 
$layout_bg_color = get_theme_mod('layout_bg_color') ? get_theme_mod('layout_bg_color') : '';
$layout_margin_top = get_theme_mod( 'layout_margin_top','' );
$layout_margin_bottom = get_theme_mod( 'layout_margin_bottom' );
 // $boxed_layout_shadow = get_theme_mod( 'boxed_layout_shadow' ) ? get_theme_mod( 'boxed_layout_shadow' ) : '0';
$boxed_layout_shadow = get_theme_mod( 'boxed_layout_shadow' );
$responsive_layout_mode = get_option( 'responsive_layout_mode' );

$logo_margin_top = get_theme_mod( 'logo_margin_top', '' );
$upload_header = get_option('upload_header');
$header_img_repeat = get_theme_mod('header_img_repeat') ? get_theme_mod('header_img_repeat') : 'repeat' ;
// Header Section
$header_top_border_color = get_theme_mod('header_top_border_color') ? get_theme_mod('header_top_border_color') :'#DB0007';
$select_header_background_type = get_theme_mod('select_header_background_type') ? get_theme_mod('select_header_background_type') : 'bg_type_image' ;
$header_bg_color = get_option('header_bg_color') ? get_option('header_bg_color') : '#' ;
// Header Right Section
$header_right_headings_color = get_option('header_right_headings_color') ? get_option('header_right_headings_color') : '#ffffff';  
$header_right_link_color = get_option('header_right_link_color') ? get_option('header_right_link_color') : '#ffffff';
$header_right_link_hover = get_option('header_right_link_hover') ? get_option('header_right_link_hover') : '#666666';  
// Menu  Section
$menu_bg_active_color = get_option('menu_bg_active_color') ? get_option('menu_bg_active_color') : '#740000' ;
$menu_bar_bg_color = get_option('menu_bar_bg_color') ? get_option('menu_bar_bg_color') : '#db0007' ;
$menu_link_active_color = get_option('menu_link_active_color') ? get_option('menu_link_active_color') : '#fff' ;

$menu_background_color = get_option('menu_background_color') ? get_option('menu_background_color') : '#DB0007' ;
$menu_link_color = get_option('menu_link_color') ? get_option('menu_link_color') : '#fff' ;
$menu_link_hover_color = get_option('menu_link_hover_color') ? get_option('menu_link_hover_color') : '#db0007';
$menu_link_hover_bg_color = get_option('menu_link_hover_bg_color') ? get_option('menu_link_hover_bg_color') : '#ffffff';
$sub_menu_link_color = get_option('sub_menu_link_color') ? get_option('sub_menu_link_color') : '';
$sub_menu_link_hover_color = get_option('sub_menu_link_hover_color') ? get_option('sub_menu_link_hover_color') : '#F54325';
$sub_menu_bg_color = get_option('sub_menu_bg_color') ? get_option('sub_menu_bg_color') : '#';
$sub_menu_link_hover_bg_color = get_option('sub_menu_link_hover_bg_color') ? get_option('sub_menu_link_hover_bg_color') : '#e4e4e4';
$sub_menu_bottom_border_color = get_option('sub_menu_bottom_border_color') ? get_option('sub_menu_bottom_border_color') : '#e4e4e4';
//Page color settings
   $page_title_bar = get_option('page_title_bar');
   $select_page_title_background_type = get_theme_mod('select_page_title_background_type') ? get_theme_mod('select_page_title_background_type') : 'bg_type_color' ;
    $page_title_bar_bg_repeat = get_theme_mod('page_title_bar_bg_repeat') ? get_theme_mod('page_title_bar_bg_repeat') : 'repeat' ;
//Page title bar color settings
$page_titlebar_bg_color = get_option('page_titlebar_bg_color') ? get_option('page_titlebar_bg_color') : '#000000';  
$page_titlebar_title_color = get_option('page_titlebar_title_color') ? get_option('page_titlebar_title_color') : '#ffffff';
$page_title_font_size = get_theme_mod('page_title_font_size') ? get_theme_mod('page_title_font_size') : '36';
$page_title_font_weight = get_theme_mod('page_title_font_weight') ? get_theme_mod('page_title_font_weight') : 'normal';
$page_title_font_style = get_theme_mod('page_title_font_style') ? get_theme_mod('page_title_font_style') : 'normal';
$page_titlebar_font_family = get_theme_mod('page_titlebar_font_family') ? get_theme_mod('page_titlebar_font_family') : 'Roboto, Arial,Helvetica,sans-serif';
//page titlebar description settings
$title_description_color = get_option('title_description_color') ? get_option('title_description_color') : '#ffffff';
$page_description_font_size = get_theme_mod('page_description_font_size') ? get_theme_mod('page_description_font_size') : '16';
$page_description_font_weight = get_theme_mod('page_description_font_weight') ? get_theme_mod('page_description_font_weight') : 'normal';
$page_description_font_style = get_theme_mod('page_description_font_style') ? get_theme_mod('page_description_font_style') : 'normal';
$page_titlebar_dec_font_family = get_theme_mod('page_titlebar_dec_font_family') ? get_theme_mod('page_titlebar_dec_font_family') : 'Roboto, Arial,Helvetica,sans-serif';
$page_title_bg = get_option('page_title_bg');    
//end
$page_bg_color = get_option('page_bg_color') ? get_option('page_bg_color') : '#000000';
$page_titles_color = get_option('page_titles_color') ? get_option('page_titles_color') : '#ffffff';
$page_description_color = get_option('page_description_color') ? get_option('page_description_color') : '#aaaaaa';
$page_link_color = get_option('page_link_color') ? get_option('page_link_color') : '#555555';
$page_link_hover_color = get_option('page_link_hover_color') ? get_option('page_link_hover_color') : '#dd3333';
$page_bg_color_opacity = get_theme_mod('page_bg_color_opacity') ? get_theme_mod('page_bg_color_opacity') : '1';

//Sidebar color settings
$sidebar_bg_color = get_option('sidebar_bg_color') ? get_option('sidebar_bg_color') : '';
$sidebar_title_color = get_option('sidebar_title_color') ? get_option('sidebar_title_color') : '#ffffff';
$sidebar_link_color = get_option('sidebar_link_color') ? get_option('sidebar_link_color') : '#aaaaaa';
$sidebar_link_hover_color = get_option('sidebar_link_hover_color') ? get_option('sidebar_link_hover_color') : '#dd3333';
$sidebar_content_color = get_option('sidebar_content_color') ? get_option('sidebar_content_color') : '#787878';
// Accent Color Section
$accent_bg_color = get_option('accent_bg_color') ? get_option('accent_bg_color') : '#DB0007';
$accent_text_color = get_option('accent_text_color') ? get_option('accent_text_color') : '#ffffff';
/* Footer Section */
    $footer_bg_repeat =  get_theme_mod('footer_bg_repeat') ? get_theme_mod('footer_bg_repeat') : 'repeat';
    $select_footer_background_type =  get_theme_mod('select_footer_background_type') ? get_theme_mod('select_footer_background_type') : 'bg_type_color';
    $footer_bg =  get_theme_mod('footer_bg') ? get_theme_mod('footer_bg') : '';

$footer_bg_top_color = get_option('footer_bg_top_color') ? get_option('footer_bg_top_color') : '#DB0007';
$footer_bg_color = get_option('footer_bg_color') ? get_option('footer_bg_color') : '#DB0007';
$footer_title_color = get_option('footer_title_color') ? get_option('footer_title_color') : '#FFFFFF';
$footer_text_color = get_option('footer_text_color') ? get_option('footer_text_color') : '#FFACAF';
$footer_link_color = get_option('footer_link_color') ? get_option('footer_link_color') : '#ffffff';
$footer_link_hover_color = get_option('footer_link_hover_color') ? get_option('footer_link_hover_color') : '#FFACAF';
//end
// Most Footer
    $select_most_footer_style=get_theme_mod('select_most_footer_style') ? get_theme_mod('select_most_footer_style') : 'left_content_right_menu';
    $most_footer_bg_color = get_theme_mod('most_footer_bg_color') ? get_theme_mod('most_footer_bg_color') : '#171717';
    $most_footer_text_color = get_theme_mod('most_footer_text_color') ? get_theme_mod('most_footer_text_color') : '#787878';
    $most_footer_link_color = get_theme_mod('most_footer_link_color') ? get_theme_mod('most_footer_link_color') : '#ffffff';
    $most_footer_link_hover_color = get_theme_mod('most_footer_link_hover_color') ? get_theme_mod('most_footer_link_hover_color') : '#ffffff';
/* Font Family */
$header_text_logo_font_family = get_theme_mod('header_text_logo_font_family') ? get_theme_mod('header_text_logo_font_family') : 'Libre Baskerville, Audiowide, Arial,Helvetica,sans-serif';
$text_logo_tagline_font_family = get_theme_mod('text_logo_tagline_font_family') ? get_theme_mod('text_logo_tagline_font_family') : 'Roboto, Arial,Helvetica,sans-serif';
$google_body_font=get_theme_mod( 'google_body_font' ) ? get_theme_mod( 'google_body_font') : 'Open Sans';
$google_bodyfont= ( $google_body_font == '0' ) ? 'Open Sans' : $google_body_font;
$google_menu_font=get_theme_mod( 'google_menu_font' ) ? get_theme_mod( 'google_menu_font' ) : 'Offside';
$google_menufont= ( $google_menu_font == '0' ) ? 'Offside' : $google_menu_font;
$google_general_titlefont=get_theme_mod( 'google_heading_font') ? get_theme_mod( 'google_heading_font' ) : 'Gafata';
$google_generaltitlefont= ( $google_general_titlefont == '0' ) ? 'Gafata' : $google_general_titlefont;
/* Title Font sizes H1 */
$h1_title_font_size=get_theme_mod( 'h1_title_fontsize', '' ) ? get_theme_mod( 'h1_title_fontsize', '' ) : '30'; // H1
$h2_title_font_size=get_theme_mod( 'h2_title_fontsize', '' ) ? get_theme_mod( 'h2_title_fontsize', '' ) : '27'; // H2
$h3_title_font_size=get_theme_mod( 'h3_title_fontsize', '' ) ? get_theme_mod( 'h3_title_fontsize', '' ) : '19'; // H3
$h4_title_font_size=get_theme_mod( 'h4_title_fontsize', '' ) ? get_theme_mod( 'h4_title_fontsize', '' ) : '18'; // H4
$h5_title_font_size=get_theme_mod( 'h5_title_fontsize', '' ) ? get_theme_mod( 'h5_title_fontsize', '' ) : '16'; // H5
$h6_title_font_size=get_theme_mod( 'h6_title_fontsize', '' ) ? get_theme_mod( 'h6_title_fontsize', '' ) : '12'; // H6
$body_font_size=get_theme_mod( 'body_font_size', '' ) ? get_theme_mod( 'body_font_size', '' ) : '13'; // Body Font Size
$menu_font_size=get_theme_mod( 'menu_font_size', '' ) ? get_theme_mod( 'menu_font_size', '' ) : '14'; // Body Font Size
/* Woocommerce Color Section */
$menu_bar_cart_icon = get_theme_mod('menu_bar_cart_icon') ? get_theme_mod('menu_bar_cart_icon') : '0';
$primary_buttons_bg_color = get_option('primary_buttons_bg_color') ? get_option('primary_buttons_bg_color') : '#434a54';
$primary_buttons_text_color = get_option('primary_buttons_text_color') ? get_option('primary_buttons_text_color') : '#ffffff';
$primary_buttons_bg_hover_color = get_option('primary_buttons_bg_hover_color') ? get_option('primary_buttons_bg_hover_color') : '#db0007';
$primary_buttons_text_hover_color = get_option('primary_buttons_text_hover_color') ? get_option('primary_buttons_text_hover_color') : '#ffffff';

$secondary_buttons_bg_color = get_option('secondary_buttons_bg_color') ? get_option('secondary_buttons_bg_color') : '#db0007';
$secondary_buttons_text_color = get_option('secondary_buttons_text_color') ? get_option('secondary_buttons_text_color') : '#ffffff';
$secondary_buttons_bg_hover_color = get_option('secondary_buttons_bg_hover_color') ? get_option('secondary_buttons_bg_hover_color') : '#434a54';
$secondary_buttons_text_hover_color = get_option('secondary_buttons_text_hover_color') ? get_option('secondary_buttons_text_hover_color') : '#ffffff';
$woo_elments_colors = get_option('woo_elments_colors') ? get_option('woo_elments_colors') : '#db0007';
$success_msg_bg_color = get_option('success_msg_bg_color') ? get_option('success_msg_bg_color') : '#dff0d8';
$success_msg_text_color = get_option('success_msg_text_color') ? get_option('success_msg_text_color') : '#468847';
$notification_msg_bg_color = get_option('notification_msg_bg_color') ? get_option('notification_msg_bg_color') : '#b8deff';
$notification_msg_text_color = get_option('notification_msg_text_color') ? get_option('notification_msg_text_color') : '#333';
$warning_msg_bg_color = get_option('warning_msg_bg_color') ? get_option('warning_msg_bg_color') : '#f2dede';
$warning_msg_text_color = get_option('warning_msg_text_color') ? get_option('warning_msg_text_color') : '#a94442';
//end
//prtttyphoto
$enable_prettyphoto_socialicons = get_theme_mod('enable_prettyphoto_socialicons') ? get_theme_mod('enable_prettyphoto_socialicons') : '0';
$disable_prettyphoto_thumbnails = get_theme_mod('disable_prettyphoto_thumbnails') ? get_theme_mod('disable_prettyphoto_thumbnails') : '0';
$disable_prettyphoto_post_title = get_theme_mod('disable_prettyphoto_post_title') ? get_theme_mod('disable_prettyphoto_post_title') : '0';
/* Menu TOp */
$menu_margin_top =get_theme_mod( 'menu_margin_top', '' ) ? get_theme_mod( 'menu_margin_top', '' ) : ''; // H6
   $css = '';

    /* body Font family */
        /*  Menu Font Family */
    $lineheight_body = round((1.8 * $body_font_size));
    $lineheight_h1 = round((1.4 * $h1_title_font_size));
    $lineheight_h2 = round((1.4 * $h2_title_font_size));
     $lineheight_h3 = round((1.4 * $h3_title_font_size));
     $lineheight_h4 = round((1.4 * $h4_title_font_size)); 
     $lineheight_h5 = round((1.4 * $h5_title_font_size));
     $lineheight_h6 = round((1.4 * $h6_title_font_size));


//BOX LAYOUT TYPE
$fullscreen_bg_img = $fullscreen['bg_img'] ? $fullscreen['bg_img'] : '';

 if( $select_fullscreen_background_type == 'bg_type_color'){
        $css .= 'body{
          background :'.$layout_bg_color.'!important;
      }';
     }else{
     if( $fullscreen_bg_img){
      $bg_size_cover = ( $fullscreen_bg_img_repeat == 'cover' ) ? 'cover' : 'inherit';
     $css .= 'body{
           background:url('.$fullscreen_bg_img.')!important;
           background-repeat:'.$fullscreen_bg_img_repeat.'!important;
           background-size : '.$bg_size_cover.'!important;
           background-attachment : '.$boxed_layout_bg_attatchment.'!important;
    }';
  }
}
$css .= '
      #box_layout{
          margin-top : '.$layout_margin_top.'px!important;
          margin-bottom : '.$layout_margin_bottom.'px!important;
      }';
    $css .= '#box_layout{
            box-shadow: 0 0 '.$boxed_layout_shadow.'px rgba(0, 0, 0, 0.5)!important;

        }'; 

   $css .= '.menu ul li a{
        font-family:'.$google_menufont.'!important;
        font-size:'.$menu_font_size.'px;
        line-height: 100%;
    }
    nav{
      margin-top: '.$menu_margin_top.'px;
    }
    body, p{
        font-family:'.$google_bodyfont.'!important;
        line-height:'.$lineheight_body.'px;
        font-size:'.$body_font_size.'px;
    }
    p{
        padding-bottom:'.$lineheight_body.'px;
    }
    /* Heading Font Family */
     h1, h2, h3, h4, h5, h6{
        font-family:'.$google_generaltitlefont.'!important;
        font-weight: 500;
    }
    /* Logo Font Family */
    .header_left_section .logo{
        font-family:'.$header_text_logo_font_family.'!important;
    }
    .header_left_section .logo_tag_line{
        font-family:'.$text_logo_tagline_font_family.'!important;
    }
    /* Font Sizes */
    h1{
      font-size:'.$h1_title_font_size.'px;
     line-height:'.$lineheight_h1.'px;
    }
    h2{
     font-size:'.$h2_title_font_size.'px;
      line-height:'.$lineheight_h2.'px;
    }
    h3{
      font-size:'.$h3_title_font_size.'px;
      line-height:'.$lineheight_h3.'px;
    }
    h4{
      font-size:'.$h4_title_font_size.'px;
      line-height:'.$lineheight_h4.'px;
    }
    h5{
     font-size:'.$h5_title_font_size .'px;
      line-height:'. $lineheight_h5 .'px;
    }
    h6{
      font-size:'.$h6_title_font_size.'px;
      line-height:'.$lineheight_h6.'px;
    }';
   /* Header Section */

     $css .= '#header_wrapper{
        border-top:3px solid '.$header_top_border_color.'!important;
      }';
/* Header Section */
$header_default_image = esc_attr( get_template_directory_uri().'/images/header_bgimg.jpg' );

//$header_default_image = get_template_directory_uri().'images/header_bgimg.jpg';
$upload_header = $upload_header['bg_image'] ? $upload_header['bg_image'] : $header_default_image;
  if( $select_header_background_type == 'bg_type_color'){
     $css .= '#header_wrapper{    
       background: '.$header_bg_color.'!important;
        border-top:3px solid '.$header_top_border_color.'!important;
      }';
     }else{ 
             if( $upload_header ){ 
              $bg_image_repeat= ( $header_img_repeat == 'cover' ) ? 'no-repeat' : $header_img_repeat;
            $bg_size = ( $header_img_repeat == "cover" ) ? 'cover' : 'inherit';
            $css .='#header_wrapper {
            background:url('.$upload_header.')!important;
            background-repeat:'.$bg_image_repeat.'!important;
            background-size:'.$bg_size.'!important; 
             border-top:3px solid '.$header_top_border_color.'!important;
            }';
            }
        }

/*$bg_size = ( $header_img_repeat == "no-repeat" ) ? 'cover' : 'inherit';
     $css .= ' #header_wrapper{
        background-color:'.$header_bg_color.'!important;
       background:url('.$upload_header['bg_image'].');
       background-repeat:'.$header_img_repeat.'!important;
       background-size:'.$bg_size.';
        }';*/
      // Header Right Section 
      $css .= '.header_right_section h1, .header_right_section h2,.header_right_section h3, .header_right_section h4, .header_right_section h5,
      .header_right_section h6, .header_right_section p, .header_right_section{
           color:'.$header_right_headings_color.';
      }
      .header_right_section a{
           color:'.$header_right_link_color.';
      }
      .header_right_section a:hover{
           color:'.$header_right_link_hover.';
      }';  
        /* Accent Color Settings */
      $css .= '.post_description, #crumbs li:last-child, .team_name, .meta-nav-prev, .meta-nav-next, .blog_single_img .bx-prev:hover, .blog_single_img .bx-next:hover, .blog_single_img .isotope_gallery li, #main_slider .prevBtn, 
     #main_slider .nextBtn, .tagcloud a:hover , #sidebar .widget_calendar table caption, .cal-blog, .pagination .current, .pagination span a.current, ul.page-numbers .current,  .bx-wrapper .bx-controls-direction a:hover, .single_img .isotope_gallery li, #relatedposts .portfolio_img_container img:hover, a.social-icons:hover, .slides-pagination a.current, #relatedposts .portfolio_item_text h4, .slider_items h4, post_share, .hint:after, [data-hint]:after, #relatedposts .portfolio-container:hover, .portfolio_gallery li:hover, .slides-navigation a:hover{
       background-color:'.$accent_bg_color.'!important;
     }';
     $css .= '.bx-pager div a:after{
          background:'.$accent_bg_color.'!important;
     }';

    $css .= '.nav_wrap{
        background: -moz-linear-gradient(top,  '.$menu_bar_bg_color.' 0%, rgba(76, 76, 76, 0.21) 58%, rgba(76, 76, 76, 0) 100%); /* FF3.6+ */
      background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$menu_bar_bg_color.'), color-stop(58%,rgba(76, 76, 76, 0) 100%), color-stop(100%,rgba(76, 76, 76, 0))); /* Chrome,Safari4+ */
      background: -webkit-linear-gradient(top, '.$menu_bar_bg_color.' 0%,rgba(76, 76, 76, 0.21) 58%,rgba(76, 76, 76, 0) 100%); /* Chrome10+,Safari5.1+ */
      background: -o-linear-gradient(top,  '.$menu_bar_bg_color.' 0%,rgba(76, 76, 76, 0.21) 58%,rgba(76, 76, 76, 0) 100%); /* Opera 11.10+ */
      background: -ms-linear-gradient(top,  '.$menu_bar_bg_color.' 0%,rgba(76, 76, 76, 0.21) 58%,rgba(76, 76, 76, 0) 100%); /* IE10+ */
      background: linear-gradient(to bottom,  '.$menu_bar_bg_color.' 0%,rgba(76, 76, 76, 0.21) 58%,rgba(76, 76, 76, 0) 100%); /* W3C */
      
      background: linear-gradient(to bottom, '.$menu_bar_bg_color.' 0%, rgba(76, 76, 76, 0.21) 58%, rgba(76, 76, 76, 0) 100%) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;

       }';
     $css .= '.hint--top:before {
        border-top-color:'.$accent_bg_color.';
      }';
    $css .= '.testimonial_wrapper strong span, .video_inner_text h2 span,.video_inner_text p span, .single_img_parallex_inner_text span, #entry-author-info h4 , .custom_title i, .widget_title i, .page_sidebar:before{
      color:'.$accent_bg_color.'!important;
    }';

    $css .= '.vaidate_error{
      border:1px solid '.$accent_bg_color.'!important;
    }';
    /* Accent background text color */
    $css .= '.tagcloud a:hover, #sidebar .widget_calendar table caption, #sidebar .widget_calendar table td a, #sidebar .widget_calendar table td a:visited, .pagination .current, .pagination span a.current, ul.page-numbers .current, a.social-icons:hover, .slider_items h4, .portfolio-container h4, .post_share{
       color:'.$accent_text_color.'!important;
     }
     #mid_container_wrapper a.readmore, input#submit, #contact-form #contact_submit, #contact-form #reset{
        background-color:'.$accent_bg_color.';
        color:'.$accent_text_color.';
        border:o!important;
     }
    #mid_container_wrapper a.readmore:hover, input#submit:hover, #contact-form #contact_submit:hover, #contact-form #reset:hover{
        background-color:'.$accent_text_color.';
        color:'.$accent_bg_color.';
     }
      .page-numbers > li a:hover, ul.page-numbers .current, .page-numbers > li a:visited{
        background:'.$accent_bg_color.'!important;
        color:'.$accent_text_color.'!important;
     }
     .logo{
      margin-top:'.$logo_margin_top.'px!important;
    }';

    /* Page title bar color settings 
      .sub_header_wrapper{
       background-color:'.$page_titlebar_bg_color.';
    }';

   $page_titlebar_bg_color = $page_titlebar_bg_color ? '0.2' : '1'; 
    if( $page_title_bg['upload_bg'] ){
   
     $css .= '.page_title_bg{
      background-image:url('.$page_title_bg['upload_bg'].');
      opacity: '.$page_titlebar_bg_color.'!important;
    }';
 }*/
//end
     // Page Title bar Section 
$pagetitlebar_default_image = esc_attr( get_template_directory_uri().'/images/top-opc.png' );
$page_title_bar = $page_title_bar['bg_img'] ? $page_title_bar['bg_img'] : $pagetitlebar_default_image;

 if( $select_page_title_background_type == 'bg_type_color'){
        $css .= '.sub_header_wrapper {
          background :'.$page_titlebar_bg_color.'!important;
      }';
     }else{
     if( $page_title_bar){
      $bg_size_cover = ( $page_title_bar_bg_repeat == 'cover' ) ? 'cover' : 'inherit';
     $css .= '.sub_header_wrapper{
           background:url('.$page_title_bar.')!important;
           background-repeat:'.$page_title_bar_bg_repeat.'!important;
           background-size : '.$bg_size_cover.'!important;
    }';
  }
}


 $css .= ' .sub_header_wrapper h2{
        color:'.$page_titlebar_title_color.';
        font-size:'.$page_title_font_size.'px;
        line-height:'.ceil($page_title_font_size * 1.1 ).'px;
        font-weight:'.$page_title_font_weight.';
        font-style:'.$page_title_font_style.';
        font-family:'.$page_titlebar_font_family.'!important;
      }
      .sub_header_wrapper p{
        color:'.$title_description_color.'!important;
        font-size:'.$page_description_font_size.'px;
        line-height:'.ceil($page_description_font_size * 1.1 ).'px;
        font-weight:'.$page_description_font_weight.';
        font-style:'.$page_description_font_style.';
        font-family:'.$page_titlebar_dec_font_family.'!important;
      }
    /* Menu Section */
      .nav_wrap .menu ul{
      background-color:'.$menu_background_color.'!important;
    }
    .menu > ul:before, .menu > ul:after {
      border-color: rgba(0, 0, 0, 0) '.$menu_background_color.';
    }
    .menu > ul > li > a{
      color:'.$menu_link_color.'!important;
    }
    .menu > li.current-menu-item > a,  .menu > ul  > li:hover > a
    {
    color:'.$menu_link_hover_color.'!important;
      background-color:'.$menu_link_hover_bg_color.'!important;
    }

    .menu > li.current_page_item > a{
        background-color:'.$menu_bg_active_color.'!important;
        color:'.$menu_link_active_color.'!important;
    }

    ul.menu > li > ul:after {
      border-bottom: 8px solid '.$menu_link_hover_bg_color.'!important;
    }
    .menu ul ul li a, .menu ul ul {
      background-color:'.$sub_menu_bg_color.'!important;
    }
    .menu ul ul li a{
      color:'.$sub_menu_link_color.'!important;
    }
    .menu ul ul li a:hover{
      color:'.$sub_menu_link_hover_color.'!important;
      background-color: '.$sub_menu_link_hover_bg_color.'!important;
    }
    .menu .current_page_ancestor > a, .menu .current-menu-ancestor > a, .menu .current-menu-item > a{
      color:'.$sub_menu_link_hover_color.';
    }
    .menu ul ul li{
      border-bottom:  1px solid '.$sub_menu_bottom_border_color.'!important; 
    }';   
      /*Page color settings */
    $css .= '#mid_container_wrapper{
       background-color:'.$page_bg_color.'!important;
    }
    #mid_container_wrapper h1,
    #mid_container_wrapper h2,
    #mid_container_wrapper h3,
    #mid_container_wrapper h4,
    #mid_container_wrapper h5,
    #mid_container_wrapper h6,
    #mid_container_wrapper h1 a,
    #mid_container_wrapper h2 a,
    #mid_container_wrapper h3 a,
    #mid_container_wrapper h4 a,
    #mid_container_wrapper h5 a,
    #mid_container_wrapper h6 a{
      color: '.$page_titles_color.';
    }

     #mid_container_wrapper p, #mid_container_wrapper{
       color: '.$page_description_color.';
    }
    #mid_container_wrapper a{
       color: '.$page_link_color.';
    }
    #mid_container_wrapper a:hover{
       color: '.$page_link_hover_color.';
    }';
    /* Sidebar */
    $css .= '#sidebar h3{
      color:'.$sidebar_title_color.';
    }
     #sidebar p, #sidebar{
      color: '.$sidebar_content_color.';
    }
    #sidebar a{
      color: '.$sidebar_link_color.';
    }
     #sidebar a:hover{
      color:'.$sidebar_link_hover_color.';
    }
    #mid_container_wrapper .blog_post h4 a{
      color: '.$page_titles_color.';
    }';

//prettyphoto social icons
if( $enable_prettyphoto_socialicons == '0' ){ 

$css .= '.pp_social{
            display: none!important;
        }';
}else{
   $css .= '.pp_social{
            display: block!important;
        }'; 
}
    //prettyphoto thumbnails
if( $disable_prettyphoto_thumbnails == '0' ){ 

$css .= '.pp_gallery{
            display: block!important;
        }';
}else{
   $css .= '.pp_gallery{
            display: none!important;
        }'; 
}
    //prettyphoto post title
if( $disable_prettyphoto_post_title == '0' ){ 
$css .= '.pp_description{
            display: none!important;
        }';
}else{
   $css .= '.pp_description{
            display: block!important;
        }'; 
}

/* Footer Section 
  if( $footerbg['footer'] ){ 
    $footerbg_size = ( $footerbg_repeat == 'no-repeat' ) ? 'cover' : 'inherit';
     $css .= 'footer{
        background: url('.$footerbg['footer'].');
        background-attachment: fixed!important;
        background-position: center;
        background-repeat:'.$footerbg_repeat.'!important;
        background-size:'.$footerbg_size.'!important;
      } ';
  }*/
     $footer_bg_size = ( $footer_bg_repeat == 'cover' ) ? 'background-size:cover; background-repeat:no-repeat' : 'background-repeat:'.$footer_bg_repeat.';'; 
    if( $select_footer_background_type == 'bg_type_image' ){
        if( !empty($footer_bg['bg_img']) ){
            $css .='footer{
                    background:url('.$footer_bg['bg_img'].');
                    '.$footer_bg_size.';
            }';
        }
     }else{
        $css .='footer{
            background:'.$footer_bg_color.';
        }'; 
     }

  $css .= 'footer #top_border{
        background: -moz-linear-gradient(top,  '.$footer_bg_top_color.' 0%, rgba(76, 76, 76, 0.21) 7%, rgba(76, 76, 76, 0) 100%); /* FF3.6+ */
      background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$footer_bg_top_color.'), color-stop(7%,rgba(76, 76, 76, 0) 100%), color-stop(100%,rgba(76, 76, 76, 0))); /* Chrome,Safari4+ */
      background: -webkit-linear-gradient(top, '.$footer_bg_top_color.' 0%,rgba(76, 76, 76, 0.21) 7%,rgba(76, 76, 76, 0) 100%); /* Chrome10+,Safari5.1+ */
      background: -o-linear-gradient(top,  '.$footer_bg_top_color.' 0%,rgba(76, 76, 76, 0.21) 7%,rgba(76, 76, 76, 0) 100%); /* Opera 11.10+ */
      background: -ms-linear-gradient(top,  '.$footer_bg_top_color.' 0%,rgba(76, 76, 76, 0.21) 7%,rgba(76, 76, 76, 0) 100%); /* IE10+ */
      background: linear-gradient(to bottom,  '.$footer_bg_top_color.' 0%,rgba(76, 76, 76, 0.21) 7%,rgba(76, 76, 76, 0) 100%); /* W3C */
      
      background: linear-gradient(to bottom, '.$footer_bg_top_color.' 0%, rgba(76, 76, 76, 0.21) 7%, rgba(76, 76, 76, 0) 100%) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;

       }';
    $css .= 'footer h3{
        color:'.$footer_title_color.'!important;
    }
    footer p, footer{
        color:'.$footer_text_color.'!important;
    }
    footer a{
        color:'.$footer_link_color.'!important;
    }
    footer a:hover, footer a:active, #menu-footer > li.current-menu-item > a{
        color:'.$footer_link_hover_color.'!important;
    }';
        // Most Footer
    $css .= '#footer_bottom{
            background:'.$most_footer_bg_color.';
        }
        #footer_bottom p, #footer_bottom, #footer_bottom span{
            color:'.$most_footer_text_color.';
        }
        #footer_bottom a, #footer_bottom ul li a{
            color:'.$most_footer_link_color.'!important;
        }
        #footer_bottom a:hover, #footer_bottom a:active, #menu-footer > li.current-menu-item > a{
            color:'.$most_footer_link_hover_color.'!important;
        }';
    if( $select_most_footer_style == 'none' ){
        $css .='#footer_bottom{
            display:none;
        }';
    }
    /* Woocommerce Color Section */
    if( $menu_bar_cart_icon == 1 ){
        $css .= '.menu_shop_cart_icon{
            display:none!important;
        }';
    }else{
        $css .= '.menu_shop_cart_icon{
            display:inline-block!important;
        }';
    }
     $css .= '.primary-button, #mid_container input#submit.primary-button, p.buttons .button.wc-forward, .product-cart-button .primary-button{
        background:'.$primary_buttons_bg_color.'!important;
        color:'.$primary_buttons_text_color.'!important;
     }
     .primary-button:hover, #mid_container input#submit.primary-button:hover, p.buttons .button.wc-forward:hover{
        background:'.$primary_buttons_bg_hover_color.'!important;
        color:'.$primary_buttons_text_hover_color.'!important;
     }
     .seconadry-button, #place_order, .single-product-tabs .active, .single-product-tabs li:hover, .woocommerce .quantity .minus, .woocommerce .quantity .plus, .woocommerce-page .quantity .minus, .woocommerce-page .quantity .plus{
        background:'.$secondary_buttons_bg_color.'!important;
        color:'.$secondary_buttons_text_color.'!important;
     }
     .woocommerce-tabs li.active:after , .woocommerce-tabs .single-product-tabs li:hover:after{
       border-color: '.$secondary_buttons_bg_color.' transparent transparent !important;
     }
     .seconadry-button:hover, #place_order:hover, .woocommerce .quantity .minus:hover, .woocommerce .quantity .plus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce-page .quantity .plus:hover{
        background:'.$secondary_buttons_bg_hover_color.'!important;
        color:'.$secondary_buttons_text_hover_color.'!important;
     }
     .woocommerce a.wc-forward:after, .woocommerce-page a.wc-forward:after{
          color:'.$secondary_buttons_text_color.'!important;
     }
     .woocommerce a.wc-forward:hover:after, .woocommerce-page a.wc-forward:hover:after{
          color:'.$secondary_buttons_text_hover_color.'!important;
     }
 
    .product-remove a.remove:hover {
       border-color: '.$woo_elments_colors.'!important;
    }
    .product-remove a.remove:hover, .star-rating, #mid_container_wrapper .comment-form-rating .stars a:hover, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .upsells-product-slider  ins span.amount, .related-product-slider .shop-products span .amount , .woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins, .upsells-product-slider .price{
           color:'.$woo_elments_colors.'!important;
    }
    .woocommerce span.onsale, .woocommerce-page span.onsale{
         background-color:'.$woo_elments_colors.'!important;
    }
    .cart-sussess-message {
      background-color:'.$success_msg_bg_color.';
      color:'.$success_msg_text_color.';
    }
    .woocommerce-cart-info {
      background-color:'.$notification_msg_bg_color.';
      color: '.$notification_msg_text_color.';
    }
    .woocommerce-cart-info a{
          color: '.$notification_msg_text_color.'!important;
    }
    .woocommerce-cart-error {
      background-color: '.$warning_msg_bg_color.';
      color: '.$warning_msg_text_color.';
    }';
/*
if(is_search() || $select_page_options == 'page_title_setion' ){ 
   $css .= '#header_wrapper {
      position: relative!important;
  }
  #header_title_bar_container{
    float: none!important;
  }';
} */
  $css = preg_replace( '/\s+/', ' ', $css ); 
  $output = "<!-- Customizer Style -->\n<style type=\"text/css\">\n" . $css . "\n</style>";
  echo $output;
}
add_action('wp_head','kaya_custom_colors');

function theme_customizer_css() { 
  $css ='';
     $css .=' .customize-control-radio label {
          float: left;
          margin-right: 10px;
      }
      h4.customizer_sub_section{
          background-color: #EEEEEE;
          margin-bottom: 0 !important;
          margin-left: -30px;
          margin-right: -30px;
          margin-top: 15px !important;
          padding: 5px 30px;
          border: 1px solid #e5e5e5;
      }
      .title_description {
        display: block;
        line-height: 23px;
        margin: 0 0 10px;
        padding: 0;
      }

      .img_radio {
          display: none !important;
      }
      .kaya-radio-img {
          display: inline-block;
          margin: 0 3px 3px 0;
          border: 2px solid #fff;
      }
      .kaya-radio-img:hover{
        border: 2px solid #2EA2CC;
      }
      .kaya-radio-img-selected {
    border: 2px solid #2EA2CC;
}';
$css = preg_replace( '/\s+/', ' ', $css );
 $output = "<!-- Theme  Customizer admin Style -->\n<style type=\"text/css\">\n" . $css . "\n</style>";
  echo $output;
}
add_action( 'customize_controls_print_styles', 'theme_customizer_css' );
function tgm_plugin_admin_style(){ ?>
  <style type="text/css">
    #setting-error-tgmpa p strong{
      font-weight: normal!important;
    }
        .so-panels-dialog-wrapper span.widget-name a {
        position: relative!important;
        width: inherit!important;
        display: inline-block!important;
        border-bottom: 0!important;
        border-left: 0px!important;
        background:none!important;
        height:20px;
        box-shadow:none!important;
    }
    .title h4 a.widget_video_tutorials, .siteorigin-panels-builder .so-rows-container .so-row-container .so-cells .cell .widgets-container .so-widget:hover .title h4 a.widget_video_tutorials, .widget-type-wrapper a.widget_video_tutorials, .so-section ul li a.widget_video_tutorials{
        display:none!important;
    }
  </style>
<?php }
add_action('admin_head','tgm_plugin_admin_style'); ?>
