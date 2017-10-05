<?php
/*  
    Plugin Name: Kaya lavan Page Widgets
    Plugin URI: http://themeforest.net/user/kayapati/portfolio
    Description: The easy way to create page layouts using Widgets in Pages or post with the help of Widget based page builder like   "SiteOrigin" Page Builder, always note these works better in pages only, 
                 not rcomended for sidebars. 
    Author: Ram
    Author URI: http://themeforest.net/user/kayapati/portfolio
    Version: 2.0
*/ 
//Register Widgets
global $lavan_plugin_name;
$lavan_plugin_name = 'lavan'; 
define( strtoupper($lavan_plugin_name).'_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( strtoupper($lavan_plugin_name).'_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );  
if( !function_exists('lavan_kaya_register_widgets') ){
  function lavan_kaya_register_widgets($widget_name, $widget_path, $class = false){
        global $kaya_register_widgets, $kaya_widgets_class, $lavan_plugin_name;
        $kaya_register_widgets[$widget_name] = realpath( $widget_path );
        $widget_class_names = explode('-', ucfirst($widget_name));
        $widget_class_names = array_map('ucfirst', $widget_class_names);
        $widget_class_name = implode('_',  $widget_class_names);
        if ( empty( $class ) ) {
          $class = 'Lavan_' . str_replace( ' ', '', ucwords( str_replace('-', ' ', $widget_class_name) ) ) . '';
        }
        $kaya_widgets_class[] = $class;
  }
}
if( !function_exists('lavan_kaya_widgets_initilize') ){
  function lavan_kaya_widgets_initilize(){
        global $kaya_widgets_class;
        foreach ($kaya_widgets_class as $widget_class) {
          register_widget($widget_class);
        }
      }
  add_action('widgets_init', 'lavan_kaya_widgets_initilize');
}
if( !function_exists('global_kaya_builder_init') ){
  function lavan_kaya_builder_init( $widgets ) {
        global $kaya_widgets_class;
        foreach ($kaya_widgets_class as $widget_class) {
          $widgets[$widget_class]['groups'] = array( 'panels' );
        }        
        return $widgets;
      }
  add_filter( 'siteorigin_panels_widgets', 'lavan_kaya_builder_init');
}

 //Widgets Includes 
 foreach ( glob( plugin_dir_path( __FILE__ )."/inc/widgets/*.php" ) as $widget_file )
        include_once $widget_file; 

 // Limit Content
function lavan_content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).' ';
    } else {
    $content = implode(" ",$content);
    }   
    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('get_the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}
if( !function_exists('kaya_explode_data') ){
  function kaya_explode_data($explode_string){
     $explode_string = nl2br($explode_string);
     $explode_string = str_replace('<br />', ",", $explode_string);
     return $explode_string;
  }
}

function kaya_lavan_widgets_styles()

{
  wp_register_style('css_lavan_page_widgets', plugins_url('css/page_widgets.css', __FILE__));
  wp_register_style('css_widget_bxslider', plugins_url('css/widget_bxslider.css', __FILE__));
  wp_register_style('css_owl.carousel', plugins_url('css/owl.carousel.css', __FILE__));
  wp_enqueue_style('css_lavan_page_widgets');
  wp_enqueue_style('css_widget_bxslider');
  wp_enqueue_style('css_font-awesome');
  wp_enqueue_style('css_owl.carousel');
  wp_enqueue_script('jquery_bxslider');
  wp_enqueue_style('css_bxslider');
  wp_enqueue_script('jquery-ui-accordion');
  wp_enqueue_script('jquery-ui-tabs');
   wp_enqueue_style('css_widgets_animation', plugins_url('css/animate.min.css', __FILE__));  
}

function kaya_lavan_widgets_scripts(){

    wp_register_script('widget_jquery_bxslider', plugins_url('js/jquery.bxslider.js', __FILE__),array( 'jquery' ),'', true);
    wp_register_script('js_owl.carousel', plugins_url('js/owl.carousel.js', __FILE__),array( 'jquery' ),'1.29', true);
    wp_register_script('js_jquery.videoBG', plugins_url('js/jquery.videoBG.js', __FILE__),array( 'jquery' ),'0.2', true);
    wp_register_script('lavan_js_scripts', plugins_url('js/scripts.js', __FILE__),array( 'jquery' ),'', true);  
    wp_enqueue_script('lavan_js_widget_contact', plugins_url('js/widget_contact.js', __FILE__),array( 'jquery' ),'', true);
    wp_localize_script( 'jquery', 'cpath', array('plugin_dir' => plugins_url('',__FILE__)));     
    wp_enqueue_script('widget_jquery_bxslider');
    wp_enqueue_script('js_owl.carousel');
    wp_enqueue_script('js_jquery.videoBG');
    wp_enqueue_script('lavan_js_scripts');
    wp_enqueue_script('jquery_wow.min', plugins_url('js/wow.min.js', __FILE__),array( 'jquery' ),'', true);

}
add_theme_support('post-thumbnails');
//include( plugin_dir_path( __FILE__ ) . 'aq_resizer.php');
include_once plugin_dir_path( __FILE__ ).'/inc/mr-image-resize.php';
include_once plugin_dir_path( __FILE__ ).'/inc/functions.php';
include_once plugin_dir_path( __FILE__ ).'/inc/animation_names.php';
include_once plugin_dir_path( __FILE__ ).'/inc/media_image_attachments.php';
include_once plugin_dir_path( __FILE__ ).'/inc/icon_box_icons.php';
//add_action('init', 'kaya_image_crop');
add_action('wp_enqueue_scripts', 'kaya_lavan_widgets_styles'); // styles files
add_action('wp_enqueue_scripts', 'kaya_lavan_widgets_scripts'); //script files
 //admin styles
 function kaya_lavan_admin_styles(){
  wp_enqueue_media();
  wp_enqueue_script('wp-color-picker');
  wp_enqueue_style('admin_widgets', plugins_url('css/admin_widgets.css', __FILE__));
  wp_enqueue_style('genericons', plugins_url('icons/genericons/style.css', __FILE__));
  wp_enqueue_style('fontawesome', plugins_url('icons/fontawesome/style.css', __FILE__));
  wp_enqueue_style('elegantline', plugins_url('icons/elegantline/style.css', __FILE__));
  wp_enqueue_style('icomoon', plugins_url('icons/icomoon/style.css', __FILE__));
 }
 add_action('admin_enqueue_scripts','kaya_lavan_admin_styles');

// Language 
class Lavan_Language_Translation{
  public function __construct(){
     add_action('plugins_loaded', array(&$this,'lavan_plugin_textdomain'));
  }
    public  function lavan_plugin_textdomain() {
    global $lavan_plugin_name;  
      $locale = apply_filters( 'plugin_locale', get_locale(), $lavan_plugin_name );
      load_textdomain( $lavan_plugin_name, trailingslashit( WP_LANG_DIR ) . $lavan_plugin_name . '/' . $lavan_plugin_name . '-' . $locale . '.mo' );
      load_plugin_textdomain( $lavan_plugin_name, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
        }
}
$language_file = new Lavan_Language_Translation();

?>
