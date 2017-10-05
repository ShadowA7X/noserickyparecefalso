<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = '';

$meta_boxes = array();

/* ----------------------------------------------------- 

$revolutionslider = array();
$revolutionslider[0] = 'Select Slider Type';

if(class_exists('RevSlider')){
    $slider = new RevSlider();
	$arrSliders = $slider->getArrSliders();
	foreach($arrSliders as $revSlider) { 
		$revolutionslider[$revSlider->getAlias()] = $revSlider->getTitle();
	}
}
*/ 
$kayaslider_array =get_terms('slider_category','hide_empty=1');

	$kaya_slider = array();
		foreach ($kayaslider_array as $sliders) {
		$kaya_slider[$sliders->slug] = $sliders->name;
		$sliders_ids[] = $sliders->slug;
		}
			//array_unshift($kaya_slider,'All');

$kayaportfolio_array =get_terms('portfolio_category','hide_empty=0');

	$kaya_portfolio_cat = array();
		foreach ($kayaportfolio_array as $pf_cat) {
		$kaya_portfolio_cat[$pf_cat->slug] = $pf_cat->name;
		$pf_cat_ids[] = $pf_cat->slug;
		}
			//array_unshift($kaya_portfolio_cat,'All');
/* ----------------------------------------------------- */
// Page Settings
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'pagesettings',
	'title' => __('Sub header section which displays below menu bar','lavan'),
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> 'Select Subheader Style',
			'id'		=> $prefix . "select_page_options",
			'class'		=> $prefix . "select_page_options",
			'type'		=> 'select',
			'options'	=> array(
				'page_title_setion'		=> __('Page Titlebar','lavan'),
				"page_slider_setion"	=> __("Header Slider",'lavan'),
				"singleimage" 	=> __("Parallax Header Image",'lavan'),
				'none' => __('None','lavan'),			
			),
			'multiple'	=> false,
			'std'		=> 'page_title_setion',
			'desc'		=> ''
		),

		array(
			'type' => 'text',
			'name' => '&nbsp;',
			'id' => 'attachemnt_slider_note', 
			'desc' => __('<b>Note : </b>Before creating \' Header Slider \' ', 'petsvets').' '. '<a target="_blank" href="https://youtu.be/6ofTk3az5Ao">'.__(' Watch this video ','petsvets').'</a>'.__(' to know how to \' Create Slider \' ', 'petsvets'),
			'class'  => 'attachemnt_slider_note'
		),

		array(
				'name'		=> __('Custom Page Title','lavan'),
				'id'		=> $prefix . "kaya_custom_title",
				'type'		=> 'text',
				'std'		=> 'Enter page custom title',
				'std'		=> '',
				'class'		=> $prefix . "kaya_custom_title",
		),
		array(
				'name'		=> __('Page Title Description','lavan'),
				'id'		=> $prefix . "kaya_custom_title_description",
				'type'		=> 'textarea',
				'std'		=> 'Enter page title description',
				'std'		=> '',
				'cols' => 20,
				'rows' => 1,
				'class' => $prefix . "kaya_custom_title_description",
		),
		
/*	array(
			'name'		=> 'Page Title Bar',
			'id'		=> $prefix . "PageSubheader",
			'type'		=> 'select',
			'options'	=> array(
				'show'  		=> 'Show',
				"hide" 	=> "Hide"
								
			),
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> ''
		), */

		array(
			'name'		=> __('Select Header Slider Type','lavan'),
			'id'		=> $prefix . "slider",
			'type'		=> 'select',
			'options'	=> array(
				"owlslider"	=> __("Draggable Slider",'lavan'),
				"customslider"	=> __("Slider Plugin Shortcode",'lavan'),
												
			),
			'multiple'	=> false,
			'std'		=> 'owlslider',
			'desc'		=> '',
			'class'		=> $prefix . "slider",
		),
// super Slider
		array(
			'name'		=> __('Slider Post Type','lavan'),
			'id'		=> $prefix . "fluid_slider_post_type",
			'type'		=> 'select',
			'options'	=> array (
						"slider_category" => __('Kaya Slider','lavan'),
						'portfolio_category' =>__('Portfolio','lavan'),
						),
			'std'		=> '',
			'class'		=> $prefix . "fluid_slider_post_type",
		),
		array(
			'name'		=> __('Select Kaya Slider Category','lavan'),
			'id'		=> $prefix . "Kaya_superslide_category",
			'type'		=> 'checkbox_list',
			'options'	=> $kaya_slider,
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> 'Kaya Slider categories are displayed here',
			'class'		=> $prefix . "Kaya_superslide_category",
		),

		array(
			'name'		=> __('Select Portfolio Category','lavan'),
			'id'		=> $prefix . "fluid_portfolio_category",
			'type'		=> 'checkbox_list',
			'options'	=> $kaya_portfolio_cat,
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> '',
			'class'		=> $prefix . "fluid_portfolio_category",
		),
		array(
			'name'		=> __('Auto Play','lavan'),
			'id'		=> $prefix . "Kaya_fluid_slider_auto_play",
			'type'		=> 'select',
			'options'	=> array(
				'3000'  => __('True','lavan'),
				"0" 	=> __("False",'lavan'),	
			),
			'multiple'	=> false,
			'std'		=> '3000',
			'desc'		=> '',
			'class'		=> $prefix . "Kaya_fluid_slider_auto_play",
		),
		array(
			'name'		=> __('Slider Items Order','lavan'),
			'id'		=> $prefix . "fluid_portfolio_order",
			'type'		=> 'select',
			'options'	=> array(
				'DESC'  	=> __('Decending Order','lavan'),
				"ASC" 	=> __("Ascending Order",'lavan'),
			),
			'multiple'	=> false,
			'std'		=> 'DESC',
			'desc'		=> '',
			'class'		=> $prefix . "fluid_portfolio_order",
		),
		array(
			'name'	=> __('Slider Items Limit','lavan'),
			'desc'	=> '',
			'id'	=> "Kaya_fluid_slider_limit",
			'type'	=> 'text',
			'std' => '10',
			'class'	=> "Kaya_fluid_slider_limit",
		),

//owl Slider
		array(
			'name'		=> __('Slider Post Type','lavan'),
			'id'		=> $prefix . "slider_post_type",
			'type'		=> 'select',
			'options'	=> array (
						"slider_category" => __('Kaya Slider','lavan'),
						'portfolio_category' => __('Portfolio','lavan'),
						),
			'std'		=> 'slider_category',
			'class'		=> $prefix . "slider_post_type",
		),
		array(
			'name'		=> __('Select Portfolio Category','lavan'),
			'id'		=> $prefix . "Kaya_portfolio_category",
			'type'		=> 'checkbox_list',
			'options'	=> $kaya_portfolio_cat,
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'class'		=> $prefix . "Kaya_portfolio_category",
			'desc'		=> ''
		),

		array(
			'name'		=> __('Select Kaya Slider Category','lavan'),
			'id'		=> $prefix . "Kaya_slider_category",
			'type'		=> 'checkbox_list',
			'options'	=> $kaya_slider,
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'class'		=> $prefix . "Kaya_slider_category",
			'desc'		=> 'Select Category'
		),
		array(
			'name'		=> __('Auto Play','lavan'),
			'id'		=> $prefix . "Kaya_slider_auto_play",
			'type'		=> 'select',
			'options'	=> array(
				'true'  	=> __('True','lavan'),
				"false" 	=> __("False",'lavan'),	
			),
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'class'		=> $prefix . "Kaya_slider_auto_play",
			'desc'		=> ''
		),
		array(
			'name'		=> __('Slider Items Order','lavan'),
			'id'		=> $prefix . "kaya_portfolio_order",
			'type'		=> 'select',
			'options'	=> array(
				'DESC'  	=> __('Decending Order','lavan'),
				"ASC" 	=> __("Ascending Order",'lavan'),
			),
			'multiple'	=> false,
			'class'		=> $prefix . "kaya_portfolio_order",
			'std'		=> 'DESC',
			'desc'		=> ''
		),
		array(
			'name'		=> __('Select Slide Items','lavan'),
			'id'		=> $prefix . "slider_items",
			'class'		=> $prefix . "slider_items",
			'type'		=> 'select',
			'options'	=> array(
				'1'  	=> __('1 Item','lavan'),
				"2" 	=> __("2 Items",'lavan'),
				'3'  	=> __('3 Items','lavan'),
				"4" 	=> __("4 Items",'lavan'),
				'5'  	=> __('5 Items','lavan'),
			),
			'multiple'	=> false,
			'std'		=> '3',
			'desc'		=> ''
		),

		array(
			'name'	=> __('Slider Items Limit','lavan'),
			'desc'	=> '',
			'id'	=> "Kaya_slider_limit",
			'class'	=> "Kaya_slider_limit",
			'type'	=> 'text',
			'std' => '10'
		),
		array(
			'name'	=> __('Slider Height','lavan'),
			'desc'	=> '',
			'id'	=> "Kaya_portfolio_slider_height",
			'class'	=> "Kaya_portfolio_slider_height",
			'type'	=> 'text',
			'std' => '600'
		),
		array(
			'name' => __('Navigation Background Color','lavan'),
			'desc' => '',
			'id' => $prefix . 'navigation_bg_color',
			'class' => $prefix . 'navigation_bg_color',
			'class'     => 'navigation_bg_color',
			'type' => 'color',
			'std' => '#000000'
		),
		array(
			'name' => __('Navigation Background Hover Color','lavan'),
			'desc' => '',
			'id' => $prefix . 'navigation_bg_hover_color',
			'class' => $prefix . 'navigation_bg_hover_color',
			'class'     => 'navigation_bg_hover_color',
			'type' => 'color',
			'std' => '#db0007'
		),
		array(
			'name'		=> __('Enable Slide Arrow Navigation','lavan'),
			'id'		=> $prefix . "disable_slide_arrow_navigation",
			'class'		=> $prefix . "disable_slide_arrow_navigation",
			'type'		=> 'checkbox',
			'multiple'	=> false,
			'std'		=> '',
			'desc'		=> '',
		),
		array(
			'name'		=> __('Enable Slide Dots Navigation','lavan'),
			'id'		=> $prefix . "disable_slide_dots_navigation",
			'class'		=> $prefix . "disable_slide_dots_navigation",
			'type'		=> 'checkbox',
			'multiple'	=> false,
			'std'		=> '',
			'desc'		=> '',
		),
		array(
			'name'		=> __('Disable Slide title','lavan'),
			'id'		=> $prefix . "disable_slide_title",
			'class'		=> $prefix . "disable_slide_title",
			'type'		=> 'checkbox',
			'multiple'	=> false,
			'std'		=> '',
			'desc'		=> '',
		),
// Kaya Slider Options		
		array(
			'name'		=> __('Select Kaya Slider Category','lavan'),
			'id'		=> $prefix . "Kaya_Sliders",
			'class'		=> $prefix . "Kaya_Sliders",
			'type'		=> 'checkbox_list',
			'options'	=> $kaya_slider,
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> ''
		),

	array(
			'name'		=> __('Auto Play','lavan'),
			'id'		=> $prefix . "Kaya_slider_autoplay",
			'type'		=> 'select',
			'class'		=> $prefix . "Kaya_slider_autoplay",
			'options'	=> array(
				'true'  => __('True','lavan'),
				"false" => __("False",'lavan'),	
			),
			'std'		=> 'true',
			'desc'		=> ''
		),
		array(
			'name'		=> __('Slide Transition','lavan'),
			'id'		=> $prefix . "Kaya_slider_transitions",
			'class'		=> $prefix . "Kaya_slider_transitions",
			'type'		=> 'select',
			'options'	=> array(
				'horizontal'  	=> __('Horizontal','lavan'),
				"vertical" 	=> __("Vertical",'lavan'),
				"fade" 	=> __("Fade",'lavan'),	
			),
			'std'		=> 'horizontal',
			'desc'		=> ''
		),
		array(
			'name'		=> __('Slide Easing Effect','lavan'),
			'id'		=> $prefix . "Kaya_slider_easing",
			'class'		=> $prefix . "Kaya_slider_easing",
			'type'		=> 'text',
			'std'		=>'swing',
			'desc'		=> "Enter easing effect Ex:linear, swing,easeOutElastic <br> for more transition effects  <a href='http://jqueryui.com/resources/demos/effect/easing.html' target='_blank'>  click here   </a>"
		),
		array(
			'name'		=> __('Slide Pause Time','lavan'),
			'id'		=> $prefix . "Kaya_slider_pause",
			'class'		=> $prefix . "Kaya_slider_pause",
			'type'		=> 'text',
			'std'		=>'4000',
			'desc'		=> "The amount of time (in ms) between each auto transition <br> Ex: 4000"
		),
		array(
			'name'		=> __(' Auto Height','lavan'),
			'id'		=> $prefix . "adaptive_height",
			'type'		=> 'select',
			'class'		=> $prefix . "adaptive_height",
			'options'	=> array(
				'true'  	=> __('True','lavan'),
				"false" 	=> __("False",'lavan'),
				),
			'multiple'	=> false,
			'std'		=> 'true',
			'desc'		=> ''
		),		

	array(
			'name'		=> __('Slider Height (px)<br><small>Ex:400-600</small>','lavan'),
			'id'		=> $prefix . "Kaya_slider_height",
			'class'		=> $prefix . "Kaya_slider_height",
			'type'		=> 'text',
			'std'		=> '600',
			'desc'		=> '',
		),
			array(
			'name'		=> __('Slider Items Order','lavan'),
			'id'		=> $prefix . "kaya_slider_order",
			'type'		=> 'select',
			'class'		=> $prefix . "kaya_slider_order",
			'options'	=> array(
				'DESC'  	=> __('Decending Order','lavan'),
				"ASC" 	=> __("Ascending Order",'lavan'),
			),
			'multiple'	=> false,
			'std'		=> 'DESC',
			'desc'		=> ''
		),
			array(
			'name'	=> __('Slider Items Limit','lavan'),
			'desc'	=> '',
			'id'	=> "Kaya_bx_slider_limit",
			'class'	=> "Kaya_bx_slider_limit",
			'type'	=> 'text',
			'std' => '10'
		),
	/*	array(
			'name'		=> 'Slide Caption',
			'id'		=> $prefix . "kaya_slidecaption",
			'type'		=> 'select',
			'options'	=> array(
				'show'  => 'Show',
				"hide" 	=> "Hide",	
			),
			'multiple'	=> false,
			'std'		=> array( 'title' ),
			'desc'		=> ''
		), */
// Video		
	array(
			'name'		=> __('Slider Shortcode','lavan'),
			'id'		=> $prefix . 'customslider_type',
			'class'	=>  $prefix . 'customslider_type',
			'type'		=> 'text',
			'desc' => 'Ex: [customslider shortcode_name]'
			),
// Single Image Upload
	array(
			'name'	=> __('Parallax Bg Image','lavan'),
			'desc'	=> 'Select image and click "Insert into page".',
			'id'	=> "Single_Image_Upload",
			'class'	=>  $prefix . 'Single_Image_Upload',
			'type'	=> 'image_advanced',
		),
		array(
			'name' => __( 'Background Position ', 'lavan' ),
			'id' => $prefix."single_img_attachment",
			'class' => $prefix."single_img_attachment",
			'type' => 'radio',
			'options' => array(
			'fixed' => __( 'Fixed', 'lavan' ),
			'scroll' => __( 'Scroll', 'lavan' ),
			),
			'std' => 'fixed'
		),	
		array(
			'name'	=> __('Image Height ( px )<br><small>Ex:400-600</small>','lavan'),
			'desc'	=> '<strong>Note:</strong> By default Screen height is displayed',
			'id'	=> "Single_Image_height",
			'class' => $prefix."Single_Image_height",
			'type'	=> 'text',
			'std' => '300'
		),
	array(
			'name'	=> __('Image Overlay Text ','lavan'),
			'desc'	=> 'Enter content like below html format <br />&lt;h2 style="color:#ffffff;font-size:3.5em;"&gt;Welcome To lavan &lt;/h2&gt; <br />
&lt;p  style="color:#ffffff;font-size:1.3em;"&gt;This is lavan Parallax Image Title description &lt;/p&gt;',

		'id'	=> "Single_Image_content",
		'class'	=> "Single_Image_content",
		'type'	=> 'textarea',
		'std' => ''
		),		
// Video		
	/* array(
			'name'		=> 'You Tube Video ID',
			'id'		=> $prefix . 'page_video',
			'type'		=> 'text',
			'desc' => 'Ex: iU8iA7jfrIg<br /> <img src="'.get_template_directory_uri().'/images/video_id.jpg"><br />
						<strong>Note : </strong> It works  youtube video id only'
			),
	array(
			'name' => __( 'Audio', 'lavan' ),
			'id' => $prefix."page_video_mute",
			'type' => 'radio',
			'options' => array(
			'false' => __( 'True', 'lavan' ),
			'true' => __( 'False', 'lavan' ),
			),
			'std' => 'true'
		),			
		array(
			'name'	=> 'Video Height ( px )<br><small>Ex:400-600</small>',
			'desc'	=> '<strong>Note:</strong> By default Screen height is displayed',
			'id'	=> "Single_slider_height",
			'type'	=> 'text',
			'std' => ''
		),
	array(
			'name'		=> 'Video Overlay Text',
			'id'		=> $prefix . 'page_video_text',
			'type'		=> 'textarea',
			'desc' => 'Enter content like below html format <br />&lt;h2 style="color:#ffffff;font-size:3.5em;"&gt;Welcome To lavan &lt;/h2&gt; <br />&lt;p  style="color:#ffffff;font-size:1.3em;"&gt;This is lavan Parallax Image Title description &lt;/p&gt;<br>&lt;a class=&quot;readmore readmore-1&quot; href=&quot;#&quot;&gt;Read More&lt;/a&gt;'
			),	
*/
	)
);


/* ----------------------------------------------------- */
// Portfolio page Layout Options
/* ----------------------------------------------------- 
$meta_boxes[] = array(
	'id' => 'my-page-layout',
	'title' => 'Portfolio Image Align Options',
	'pages' => array( 'portfolio' ),
	'context' => 'side',
	'priority' => 'high',
		'fields' => array(
		array(
			'name' => '',
			'desc' => '',
			'id' => $prefix . 'kaya_pagesidebar',
			'type' => 'select',
			'std'	=> '',
			'options' => array( "rightsidebar" => "Images Align Left", "leftsidebar" => "Images Align Right", "full" => "Images Align Center")
		),
	)

);
*/
/* ----------------------------------------------------- */
// POrtfolio Info Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'portfolio_info',
	'title' => __('Portfolio General Options','lavan'),
	'pages' => array( 'portfolio' ),
	'context' => 'normal',
		'fields' => array(
		array(
			'name' => __('Custom Portfolio Item Title','lavan'),
			'desc' => '',
			'id' => $prefix . 'kaya_custom_title',
			'type' => 'text',
			
		),

		array(
			'name' => __('Portfolio Item External link to','lavan'),
			'desc' => 'Ex: http://www.google.com',
			'id' => $prefix . 'Porfolio_customlink',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name'		=> __('Open In New Window','lavan'),
			'id'		=> $prefix . 'pf_link_new_window',
			'clone'		=> false,
			'type'		=> 'checkbox',
			'desc'		=> ''
		),
		array(
			'name'		=> __('Related Posts','lavan'),
			'id'		=> $prefix . 'relatedpost',
			'clone'		=> false,
			'type'		=> 'checkbox',
			'desc'		=> 'Display Related posts at the bottom of this post in Portfolio single page  <br /><strong>Note:</strong> <em>Related post displays based on tags</em>'
		),
		
	)
);
/* -----------------------------------------------------
// Light box video url
-----------------------------------------------------  */
$meta_boxes[] = array(
	'id'		=> 'lightbox_video_url',
	'title'		=> __('Light Box Video Url','lavan'),
	'pages'		=> array( 'portfolio' ),
	'context' => 'side',
	'priority' => 'low',
	'fields'	=> array(
		array(
			'name'		=> '',
			'id'		=> $prefix . 'video_url',
			'type'		=> 'text',
			'desc' => 'http://www.youtube.com/watch?v=SZEflIVnhH8 <br> Note: It support only for youtube & vimeo videos'
			),
		
		)
);
/* ----------------------------------------------------- */
// Project Slides Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'portfolio_sidebar',
	'title'		=> __('Template','spa'),
	'pages'		=> array( 'portfolio' ),
	'context' => 'side',
	'priority' => 'default',
	'fields'	=> array(
	array(
			'name' => '',
			'desc' => '',
			'id' => $prefix . 'kaya_pagesidebar',
			'type' => 'select',
			'std'	=> '',
			'options' => array(  "full" => __('Fullwidth','spa'), "rightsidebar" => __('Right Sidebar','spa'), "leftsidebar" => __('Left Sidebar','spa'))
		),
	
		
		)
	);

/* ----------------------------------------------------- */
// Project Video Metabox
/* ----------------------------------------------------- 
$meta_boxes[] = array(
	'id'		=> 'portfolio_video',
	'title'		=> 'Portfolio Video',
	'pages'		=> array( 'portfolio' ),
	'context' => 'normal',

	'fields'	=> array(
	array(
			'name'		=> 'Video Type',
			'id'		=> $prefix . 'video_type',
			'type'		=> 'select',
			'options'	=> array(
					'none' => 'None',
					'vimeo'	=> 'Vimeo',
					'youtube'	=> 'Youtube',
					'videoembed'	=> 'Video Embed Code'					
				),
				'multiple'	=> false,
				'desc' =>  'It overwrites portfolio project images'
			),
		array(
			'name'		=> 'Video ID',
			'id'		=> $prefix . 'youtube_video',
			'type'		=> 'text',
			'desc' => 'Paste the video ID Ex:iU8iA7jfrIg<br /><br /><img src="'.get_template_directory_uri().'/images/video_id.jpg">'
			),
		array(
			'name'		=> 'Video ID',
			'id'		=> $prefix . 'vimeo_video',
			'type'		=> 'text',
			'desc' => 'Paste the video ID Ex:76357146<br /><br /><img src="'.get_template_directory_uri().'/images/vimeo_id.jpg">'
			),
		array(
			'name'		=> 'Video Embed Code',
			'id'		=> $prefix . 'video_embed',
			'type'		=> 'textarea',
			'desc' => 'Paste the video iframe embed code Ex: <br /> &lt;iframe src=&quot;http://www.metacafe.com/embed/yt-iU8iA7jfrIg/&quot; width=&quot;440&quot; height=&quot;248&quot; allowFullScreen frameborder=0&gt;&lt;/iframe&gt;'
			),
	
		
		)
	);
*/
	/* ----------------------------------------------------- */
// Project Slides Metabox
/* ----------------------------------------------------- 
$meta_boxes[] = array(
	'id'		=> 'portfolio_pj_skills',
	'title'		=> 'Model Infromation',
	'pages'		=> array( 'portfolio' ),
	'context' => 'normal',

	'fields'	=> array(
			array(
			'name'	=> 'Title',
			'desc'	=> 'Add Project skills title Ex: Skills Used',
			'id'	=> $prefix . 'portfolio_project_skills_title',
			'type'	=> 'text',
			'std' => '',
		),	
		array(
			'name'	=> 'Model Information',
			'desc'	=> 'Add Project skills separate with commas<br />Ex:Size ... 8, Height ... 5.8, Hair ... Blonde, Eye ... Green, Bust ...  32, Waist ...  23',
			'id'	=> $prefix . 'portfolio_project_skills',
			'type'	=> 'textarea',
			'std' => '',
		),
		
		)
);
*/
/* ----------------------------------------------------- */
// Post Info Metabox
/* ----------------------------------------------------- 
$meta_boxes[] = array(
	'id' => 'kaya_featured_info',
	'title' => 'Featured Image options',
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(
		array(
			'name' 	=> 	'Featured Image',
			'id' 	=> 	$prefix . 'featuredImage',
			'type'	=> 	'checkbox',
			'desc' 	=> 	'Check this box to enable " Featured Image" in blog single page',
			'std' 	=> 	''	
		),
		
	)
); */
/* ----------------------------------------------------- */
// Video Format
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'kaya_post_format_video',
	'title' => __('Video','lavan'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(

		array(
			'name' 	=> 	__('Add Iframe Video','lavan'),
			'id' 	=> 	$prefix . 'post_video',
			'type'	=> 	'textarea',
			'desc' 	=> 	'&lt;iframe src=&quot;http://www.metacafe.com/embed/yt-iU8iA7jfrIg/&quot; allowFullScreen frameborder=0&gt;&lt;/iframe&gt;',
			'std' 	=> 	''	
		),	
		
	)
);

$meta_boxes[] = array(
	'id' => 'kaya_title_image_streatch',
	'title' => __('Blog Post Image Settings','lavan'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(

	/* Image Streached */
		array(
			'name' 	=> 	__('Disable Featured Image Stretch','lavan'),
			'id' 	=> 	$prefix .'kaya_image_streatch',
			'type'	=> 	'checkbox',
			'desc' 	=> 	'',
			'std' 	=> 	''	
		),		
		
	)
);
/* ----------------------------------------------------- */
// Gallery
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'kaya_post_format_gallery',
	'title'		=> __('Gallery Format','lavan'),
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> __('Post Format Gallery','lavan'),
			'desc'	=> 'These images are displayed in Post single page, Upload up to 50 project images for a slideshow. <br /><br /><strong>Note:</strong> Use <strong>Set featured image</strong> options for thumbnail image',
			'id'	=> $prefix . 'post_gallery',
			'type'	=> 'image_advanced',
			'max_file_uploads' => 50,
		),
		array(
			'name' 	=> 	__('Gallery Slider','lavan'),
			'id' 	=> 	$prefix . 'kaya_gallery_slider',
			'type'	=> 	'checkbox',
			'desc' 	=> 	'',
			'std' 	=> 	''	
		),
		)
);
/* ----------------------------------------------------- */
// Quote Format
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'kaya_quote_format_quote',
	'title' => __('Quote Format','lavan'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(
		
		array(
			'name' 	=> 	__('Quote','lavan'),
			'id' 	=> 	$prefix . 'kaya_quote_desc',
			'type'	=> 	'textarea',
			'desc' 	=> 	'',
			'std' 	=> 	''	
		),
	)
);
/* ----------------------------------------------------- */
// Audio Format
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'kaya_audio_format',
	'title' => __('Audio Format','lavan'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(
		
		array(
			'name' 	=> 	__('Audio Embed','lavan'),
			'id' 	=> 	$prefix . 'kaya_audio',
			'type'	=> 	'textarea',
			'desc' 	=> 	'',
			'std' 	=> 	''	
		),	
		
	)
);
/* ----------------------------------------------------- */
// Link Format
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'kaya_link_format',
	'title' => __('Link Format','lavan'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(
		
		array(
			'name' 	=> 	__('Link','lavan'),
			'id' 	=> 	$prefix . 'kaya_link',
			'type'	=> 	'textarea',
			'desc' 	=> 	'',
			'std' 	=> 	''	
		),	
		
	)
);

/* ----------------------------------------------------- */
// Slider
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'slider-customlink',
	'title'		=> __('Slider Settings','lavan'),
	'pages'		=> array( 'slider' ),
	'context' => 'normal',
	'fields'	=> array(

	array(
			'name' => __('Disable Slide Title/Description','lavan'),
			'desc' => '',
			'id' => $prefix . 'disable_slide_content',
			'type' => 'checkbox',
			'std' => ''
		),
	array(
			'name' => __('Slide link','lavan'),
			'desc' => 'Ex: http://www.google.com',
			'id' => $prefix . 'customlink',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Open In New Window','lavan'),
			'desc' => '',
			'id' => $prefix . 'slider_target_link',
			'type' => 'checkbox',
			'std' => ''
		),


		)
	);

/* ----------------------------------------------------- */
// Slider
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'testimonial-settngs',
	'title'		=> __('Testimonial Settings','lavan'),
	'pages'		=> array( 'testimonial' ),
	'context' => 'normal',
	'fields'	=> array(
	array(
			'name' => __('Description','lavan'),
			'desc' => '',
			'id' => $prefix . 'testimonial_description',
			'type' => 'textarea',
			'std' => ''
		),
		
		array(
			'name' => __('Designation','lavan'),
			'desc' => '',
			'id' => $prefix . 't_client_designation',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Link','lavan'),
			'desc' => '',
			'id' => $prefix . 't_client_link',
			'type' => 'text',
			'std' => ''
		),
		)
	);
/* ----------------------------------------------------- */
// Project Slides Metabox
/* ----------------------------------------------------- 
$meta_boxes[] = array(
	'id'		=> 'slider_single_slides',
	'title'		=> 'Slider Single Page Options',
	'pages'		=> array( 'slider' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> 'Slider Single Page Images',
			'desc'	=> 'Upload up to 50  images for a slideshow. <br /><br /><strong>Note:</strong> Use <strong>Set featured image</strong> options for thumbnail image',
			'id'	=> $prefix . 'kaya_slider_slide',
			'type'	=> 'thickbox_image',
			'max_file_uploads' => 50,
		),

		)
	);
*/
// Slider page Layout Options
/* ----------------------------------------------------- 
$meta_boxes[] = array(
	'id' => 'my-slider-layout',
	'title' => 'Slider Image Align Options',
	'pages' => array( 'slider' ),
	'context' => 'side',
	'priority' => 'high',
		'fields' => array(
		array(
			'name' => '',
			'desc' => '',
			'id' => $prefix . 'kaya_pagesidebar',
			'type' => 'select',
			'std'	=> '',
			'options' => array( "rightsidebar" => "Images Align Left", "leftsidebar" => "Images Align Right", "full" => "Images Align Center")
		),
	)

);*/


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function kaya_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'kaya_register_meta_boxes' );
/* ----------------------------------------------------- */
// Model Details Information
/* ----------------------------------------------------- */
add_filter( 'rwmb_meta_boxes', 'portfolio_register_meta_boxes' );
function portfolio_register_meta_boxes( $meta_boxes ){
	global $pf_slug_name;
	$meta_boxes[] = array(
		'id' => 'portfolio_model_options',
		'title' => ucfirst($pf_slug_name).' '.__('Details','lavan'),
		'pages' => array( 'portfolio' ),
		'priority' => 'high',
		'context' => 'normal',
			'fields' => array(

		)
	);
 return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'pf_edit_meta_boxes', 20 );
function pf_edit_meta_boxes( $meta_boxes )
{
    foreach ( $meta_boxes as $k => $meta_box )
    {
        if ( isset( $meta_box['id'] ) && 'portfolio_model_options' == $meta_box['id'] )
        {
        	$options = get_option('pf_custom_options');
            if( !empty($options['pf_meta_field_name']) ){
            	$prefix = 'pf_model_';
	            $count=count($options['pf_meta_field_name']);
				for ($i=0; $i < ( count($options['pf_meta_field_name'])-1); $i++){
					 if( ( !empty($options['pf_meta_label_name'][$i]) ) &&  ( $options['pf_meta_label_name'][$i] != 'Array') &&  ( $options['pf_meta_label_name'][$i] != '') &&  ( !is_array($options['pf_meta_label_name'][$i]) )){	
					$id = str_replace(array(' ', ',','-', '/', '___'), '_', trim(strtolower($options['pf_meta_label_name'][$i])));
					if( $options['pf_meta_field_name'][$i] == 'select' ){
						$type="select";
						$select_data = explode('|',trim($options['pf_meta_field_options'][$i]));
						$array = array_filter(array_combine($select_data, $select_data));
					}elseif( $options['pf_meta_field_name'][$i] == 'checkbox' ){
						$type="checkbox_list";
						$array = explode('|',trim($options['pf_meta_field_options'][$i]));
					}else{
						$type= $options['pf_meta_field_name'][$i];
						$array = '';
					}					
	                $meta_boxes[$k]['fields'][] = array(
		                'name' => $options['pf_meta_label_name'][$i],
		                'id'   => $prefix.$id,
		                'type' => $type,
		                'options' => $array,
	            	);
	            }
		        }        
	        }else{
	        	
	        } 
        }
    }
    // Return edited meta boxes
    return $meta_boxes;
}