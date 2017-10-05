<?php
include_once('customize_settings.php');
include_once('customizer_controlls.php');
// Layout Mode
function kaya_layout_mode( $wp_customize ){
	$wp_customize->add_section(
		'theme-layout-mode',
		array(
			'title' => __('Theme Layout Options','lavan'),
			'priority' => 0,
			'capability' => 'edit_theme_options',
			'description' => '<a target="_blank" href="https://youtu.be/a-M1o15-wk0">'. __( ' Watch this Video ', 'lavan' ).'</a>'.__(' to know how to configure layout settings', 'lavan'),
			)
		);
	$wp_customize->add_setting( 'theme_layout_mode',
		array( 
			'default' => 'fluid'
		));
	$wp_customize->add_control( 'theme_layout_mode',
		array(
		'label' => __('layout Mode','lavan'),
		'section' => 'theme-layout-mode',
		'priority' => 1,
		'type' => 'radio',
		'choices' => array(
			'fluid' => __('Fluid','lavan'),
			'boxed' => __('Boxed','lavan'),	
			)
		)
		);
	$wp_customize->add_setting( 'select_fullscreen_background_type',  array(
        'default' => 'bg_type_color',
        'transport' => '',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('select_fullscreen_background_type', array(
        'type' => 'select',
        'label' => __('Select Background Type','spa'),
        'section' => 'theme-layout-mode',
        'choices' => array(
           'bg_type_color' => __('Background Color','spa'),
           'bg_type_image' => __('Background Image','spa'),
          ),
    'priority' => 2,
    ));
	$wp_customize->add_setting('fullscreen[bg_img]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'fullscreen', array(
        'label'    => __('Upload Background Image', 'spa'),
        'section'  => 'theme-layout-mode',
        'settings' => 'fullscreen[bg_img]',
		'priority' => 3
    )));
  $wp_customize->add_setting( 'fullscreen_bg_img_repeat',
    array( 
      'default' => 'repeat'
    ));
  $wp_customize->add_control( 'fullscreen_bg_img_repeat',
    array(
    'label' => __('Background Repeat','spa'),
    'section' => 'theme-layout-mode',
    'priority' => 4,
    'type' => 'radio',
    'choices' => array(
      'repeat' => __('Repeat','spa'),
      'no-repeat' => __('No Repeat','spa'),
      'cover' => __('Fit Screen','spa')
      )));
   $wp_customize->add_setting('boxed_layout_bg_attatchment',
  array(
    'deafult' => 'fixed',
    'transport' => '',
    'sanitize_callback' => 'radio_buttons_sanitize',
    ));
  $wp_customize->add_control('boxed_layout_bg_attatchment',
  array(
    'label' => 'Background Attachment',
    'capability' => 'edit_theme_options', 
    'section' => 'theme-layout-mode',
    'priority' => 5,
    'type' => 'radio',
    'choices' => array(
      'scroll' => 'Scroll',
      'fixed' =>'Fixed',
      )
    ));
	$wp_customize->add_setting( 'layout_bg_color',array( 
			'default' => '',

		));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'layout_bg_color',
		array(			
			'label' => __('Box Layout Background Color', 'lavan'),
			'section' => 'theme-layout-mode',
			'priority' => 6,
			'type' => 'color',
	)));

	$wp_customize->add_setting( 'layout_margin_top',
		array( 
			'default' => '0',
			'sanitize_callback' => 'check_number'
		));
	$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'layout_margin_top', array(
		'label' => __('Boxed Layout Margin Top (px)','lavan'),
		'section' => 'theme-layout-mode',
		'priority' => 7,
    'choices'  => array(
      'min'  => 0,
      'max'  => 100,
      'step' => 1
    ),
		)
		));
	$wp_customize->add_setting( 'layout_margin_bottom',
		array( 
			'default' => '0',
			'sanitize_callback' => 'check_number'
		));
	$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'layout_margin_bottom', array(
		'label' => __('Boxed Layout Margin Bottom (px)','lavan'),
		'section' => 'theme-layout-mode',
		'priority' => 8,
    'choices'  => array(
      'min'  => 0,
      'max'  => 100,
      'step' => 1
    ),
		)
		));
$wp_customize->add_setting('boxed_layout_shadow',array(
        'default' => '0',
        'sanitize_callback' => 'check_number'
      ));
  $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'boxed_layout_shadow', array(
    'label'   => __('Boxed Layout Shadow','spa'),
    'section' => 'theme-layout-mode',
    'settings'    => 'boxed_layout_shadow',
    'priority'    =>9,
    'choices'  => array(
      'min'  => 0,
      'max'  => 100,
      'step' => 1
    ),
  )));
	$wp_customize->add_setting( 'responsive_layout_mode',
		array( 
			'default' => 'on'
		));
	$wp_customize->add_control( 'responsive_layout_mode',
		array(
		'label' => __('Responsive Mode','lavan'),
		'section' => 'theme-layout-mode',
		'priority' => 10,
		'type' => 'radio',
		'choices' => array(
			'on' => __('On','lavan'),
			'off' => __('Off','lavan'),	
			)
		)
		);
	}
add_action('customize_register','kaya_layout_mode');
//layout mode End

//header section
function header_section( $wp_customize ) {
	$wp_customize->add_panel( 'header_section_panel', array(
      'priority'       => 1,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Header Section', 'lavan' ),
      'description'    => '',
  ) );

  $wp_customize->add_section(
	// ID
	'header-section',
	// Arguments array
	array(
		'title' => __( 'Header Section', 'lavan' ),
		'priority'       => 1,
		'capability' => 'edit_theme_options',
		'panel'   => 'header_section_panel',
    'description' => '<a target="_blank" href="https://youtu.be/6fEamrgVXGA">'. __( ' Watch this Video ', 'lavan' ).'</a>'.__(' to know how to configure Header section', 'lavan'),
	)
);
  $colors = array();
 $wp_customize->add_setting( 'header_top_border_color',
    array( 
      'default' => '#DB0007'
    ));
  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize, 'header_top_border_color',
    array(
      'label' => __('Header Top Border Color','lavan'),
      'section' => 'header-section',
      'priority' => 0,
      'type' => 'color',
    )));  
$wp_customize->add_setting( 'select_header_background_type',  array(
        'default' => 'bg_type_image',
        'transport' => '',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('select_header_background_type', array(
        'type' => 'select',
        'label' => __('Select Background Type','lavan'),
        'section' => 'header-section',
        'choices' => array(
        	 'bg_type_color' => __('Background Color','lavan'),
        	 'bg_type_image' => __('Background Image','lavan'),
        	),
		'priority' => 1,
    ));
  $url=get_template_directory_uri();
  //$url=get_template_directory_uri();
  $wp_customize->add_setting('upload_header[bg_image]', array(
  		'default'           => $url.'/images/header_bgimg.jpg',
        //'default'           => $src.'/',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'bg_image', array(
        'label'    => __('Header BG Image', 'lavan'),
        'section'  => 'header-section',
        'settings' => 'upload_header[bg_image]',
		'priority' => 2
    )));
    $wp_customize->add_setting('header_img_repeat',
	array(
		'deafult' => 'repeat',
		));
$wp_customize->add_control('header_img_repeat',
	array(
		'label' => __('Background Repeat','lavan'),
		'capability' => 'edit_theme_options', 
		'section' => 'header-section',
		'priority' => 3,
		'type' => 'radio',
		'choices' => array(
			'no-repeat' => __('No Repeat','lavan'),
			'repeat' => __('Repeat','lavan'),
			'cover' => __('Cover','lavan'),
			)
		));
$colors[] = array(
	'slug'=>'header_bg_color',
	'default' => '',
	'label' => __('Header Background Color', 'lavan'),
	'priority' => 4
	);
foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'header-section',
			'priority' => $color['priority'],
			'settings' => $color['slug'])

		)
	);
}
}
add_action( 'customize_register', 'header_section' );
//end header section

function logo_section( $wp_customize ){
      $wp_customize->add_section(
  // ID
  'logo-section',
    array(
    'title' => __( 'Header Logo Settings', 'lavan' ),
    'priority'       => 1,
    'capability' => 'edit_theme_options',
    'panel' => 'header_section_panel',
    'description' => '<a target="_blank" href="https://youtu.be/towzIkeF00I">'. __( ' Watch this Video ', 'lavan' ).'</a>'.__(' to know how to configure Logo settings', 'lavan'),
  )
);
$wp_customize->add_setting( 'select_header_logo_type',  array(
        'default' => 'image_logo',
        'transport' => '',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('select_header_logo_type', array(
        'type' => 'select',
        'label' => __('Select Header Logo Type','petsvets'),
        'section' => 'logo-section',
        'choices' => array(
        	 'image_logo' => __('Image Logo','petsvets'),
        	 'text_logo' => __('Text Logo','petsvets'),
        	),
		'priority' => 60,
    ));	
	
  $url=get_template_directory_uri();
  $wp_customize->add_setting('kaya_logo[upload_logo]', array(
        'default'           => $url.'/images/logo.png',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'upload_sanitize_id',
        'type'           => 'option',

    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'upload_logo', array(
        'label'    => __('Upload Logo Image', 'lavan'),
        'section'  => 'logo-section',
        'settings' => 'kaya_logo[upload_logo]',
    'priority' => 70
    )));

    //
    $wp_customize->add_setting( 'header_text_logo', array(
		'default'        => '',
		'sanitize_callback' => 'text_filed_sanitize',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'header_text_logo', array(
		'label'   => __('Text Logo','petsvets'),
		'section' => 'logo-section',
		'type'    => 'text',
		'priority' => 100,

	) );
	$wp_customize->add_setting( 'text_logo_size', array(
        'default'        => '36',
       // 'transport' => 'postMessage',
        'sanitize_callback' => 'check_number',
    ) );
	$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'text_logo_size', array(
			 'label'   => __('Logo Font Size','petsvets'),
        	'section' => 'logo-section',
			'settings'    => 'text_logo_size',
			'priority'    => 110,
			'choices'  => array(
				'min'  => 24,
				'max'  => 150,
				'step' => 1
			),
	)));
	$wp_customize->add_setting( 'header_logo_font_weight',  array(
        'default' => 'normal',
       //'transport' => 'postMessage',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('header_logo_font_weight', array(
        'type' => 'select',
        'label' => __('Text Logo Font Weight','petsvets'),
        'section' => 'logo-section',
        'choices' => array(
        	 'normal' => __('Normal','petsvets'),
        	 'bold' => __('Bold','petsvets'),
        	),
		'priority' => 120,
    ));	
    $wp_customize->add_setting( 'header_logo_font_style',  array(
        'default' => 'normal',
        //'transport' => 'postMessage',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('header_logo_font_style', array(
        'type' => 'select',
        'label' => __('Text Logo Font Style','petsvets'),
        'section' => 'logo-section',
        'choices' => array(
        	 'normal' => __('Normal','petsvets'),
        	 'italic' => __('Italic','petsvets'),
        	),
		'priority' => 130,
    ));	
	
	$wp_customize->add_setting( 'header_text_logo_font_family',
    array( 'default' => '2',
    	//'transport' => 'postMessage',
    	'sanitize_callback' => 'text_filed_sanitize'
    ));
 	$wp_customize->add_control( new Kaya_Customize_google_fonts_Control( $wp_customize, 'header_text_logo_font_family', array(
		 'label'   => __('Select Logo Font Family','petsvets'),
		'section' => 'logo-section',
		'settings'    => 'header_text_logo_font_family',
		'priority'    => 140,
	)));

    $colors[] = array(
		'slug'=>'logo_text_font_color',
		'default' => '#ffffff',
		'label' => __('Text Logo Font Color', 'petsvets'),
		'priority' => 141
	);
	$wp_customize->add_setting( 'logo_tag_line_sub_title', array(
  		'sanitize_callback' => 'text_filed_sanitize',
  	) );
    $wp_customize->add_control( new Kaya_Customize_Subtitle_control( $wp_customize, 'logo_tag_line_sub_title', array(
       'label'    => __( 'Logo Tagline Section', 'petsvets' ),
      'section'  => 'logo-section',
      'priority' => 150
    )));
	// Logo tag line
	 $wp_customize->add_setting( 'header_text_logo_tagline', array(
		'default'        => '',
		'sanitize_callback' => 'text_filed_sanitize',
		'transport' => 'refresh'
	));
	$wp_customize->add_control( 'header_text_logo_tagline', array(
		'label'   => __('Logo Tag Line','petsvets'),
		'section' => 'logo-section',
		'type'    => 'text',
		'priority' => 160,

	));
	$wp_customize->add_setting( 'logo_tagline_size', array(
        'default'        => '12',
       // 'transport' => 'postMessage',
        'sanitize_callback' => 'check_number',
    ) );
	$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'logo_tagline_size', array(
			 'label'   => __('Logo Tag Line Font Size','petsvets'),
        	'section' => 'logo-section',
			'settings'    => 'logo_tagline_size',
			'priority'    => 170,
			'choices'  => array(
				'min'  => 10,
				'max'  => 150,
				'step' => 1
			),
	)));
	$wp_customize->add_setting( 'logo_tagline_font_weight',  array(
        'default' => 'normal',
        //'transport' => 'postMessage',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('logo_tagline_font_weight', array(
        'type' => 'select',
        'label' => __('Logo Tag Line Font Weight','petsvets'),
        'section' => 'logo-section',
        'choices' => array(
        	 'normal' => __('Normal','petsvets'),
        	 'bold' => __('Bold','petsvets'),
        	),
		'priority' => 180,
    ));	
    $wp_customize->add_setting( 'logo_tagline_font_style',  array(
        'default' => 'normal',
       // 'transport' => 'postMessage',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('logo_tagline_font_style', array(
        'type' => 'select',
        'label' => __('Logo Tag Line Font Style','petsvets'),
        'section' => 'logo-section',
        'choices' => array(
        	 'normal' => __('Normal','petsvets'),
        	 'italic' => __('Italic','petsvets'),
        	),
		'priority' => 190,
    ));	
    $wp_customize->add_setting( 'logo_tagline_letter_spacing', array(
        'default'        => '0',
       // 'transport' => 'postMessage',
        'sanitize_callback' => 'check_number',
    ) );
	$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'logo_tagline_letter_spacing', array(
			 'label'   => __('Logo Tag Line Font Letter Spacing','petsvets'),
        	'section' => 'logo-section',
			'settings'    => 'logo_tagline_letter_spacing',
			'priority'    => 191,
			'choices'  => array(
				'min'  => 0,
				'max'  => 20,
				'step' => 1
			),
	)));
   	$wp_customize->add_setting( 'text_logo_tagline_font_family',
    array( 'default' => '',
    	//'transport' => 'postMessage',
    	'sanitize_callback' => 'text_filed_sanitize'
    ));
 	$wp_customize->add_control( new Kaya_Customize_google_fonts_Control( $wp_customize, 'text_logo_tagline_font_family', array(
		 'label'   => __('Select Tag Line Font Family','petsvets'),
		'section' => 'logo-section',
		'settings'    => 'text_logo_tagline_font_family',
		'priority'    => 200,
	)));

	$colors[] = array(
		'slug'=>'logo_tagline_font_color',
		'default' => '#ffffff',
		'label' => __('Logo Tag Line Color', 'petsvets'),
		'priority' => 210
	);
	 // lOGO BG Color
 $wp_customize->add_setting( 'logo_margin_top', array(
        'default'        => '',
        'sanitize_callback' => 'check_number',
    ) );
 
    $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'logo_margin_top', array(
        'label'   => __('Logo Margin Top (px)','lavan'),
        'section' => 'logo-section',
        'priority' =>211,
        'choices'  => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1
			),
    ) ));
	// End
	foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			//'type' => 'option',
			'capability' =>	'edit_theme_options',
			//'transport' => 'postMessage',
			'sanitize_callback' => 'color_filed_sanitize',
		)
	);

	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'logo-section',
			'priority' => $color['priority'],
			'settings' => $color['slug'])

		)
	);
}
}
add_action( 'customize_register', 'logo_section' );
//end logo section

//header right section
function header_right_section( $wp_customize ){
      $wp_customize->add_section(
  // ID
  'header-right-section',
    array(
    'title' => __( 'Header Right Section', 'lavan' ),
    'priority'       => 1,
    'capability' => 'edit_theme_options',
    'panel' => 'header_section_panel',
    'description' => '<a target="_blank" href="https://youtu.be/CqfnK2q85ro">'. __( ' Watch this Video ', 'lavan' ).'</a>'.__(' to know how to configure Header Right section', 'lavan'),
  )
);

 $wp_customize->add_setting('header_right_contact_info',array(
  		'default' => '<h3 style="text-align:right; ">Call Us: +1 800 559 6580</h3>',
  		'sanitize_callback' => 'text_filed_sanitize',
  	));
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'header_right_contact_info', array(
      'label'    => __( 'Contact Information', 'lavan' ),
      'section'  => 'header-right-section',
      'settings' => 'header_right_contact_info',
      'priority' => 7,
      'type' => 'text-area',
      ))  );
$src=get_template_directory_uri() . '/images/social_icons';
	$wp_customize->add_setting('social_icon1[upload_social_icon1]', array(
	    'default'           => $src.'/facebook.png',
	    'capability'        => 'edit_theme_options',
	    'sanitize_callback' => 'upload_sanitize_id',
	    'type'           => 'option',
	    'transport' => ''
	));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'upload_social_icon1', array(
        'label'    => __('Upload Social Icon1', 'lavan'),
        'section'  => 'header-right-section',
        'settings' => 'social_icon1[upload_social_icon1]',
		'priority' => 8
    )));
    $wp_customize->add_setting(
    'right_social_icon_link1',
    array(
        'default' => '',
    ));
  $wp_customize->add_control(
    'right_social_icon_link1',
    array(
        'label' => __('Social Icon1 Link','lavan'),
         'section'  => 'header-right-section',
        'type' => 'text',
        'priority' => 9,
    ));
 $wp_customize->add_setting(  'icon_image_link');
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'icon_image_link', array(
      'label'    => 'http://www.socialmedia.com/userid',
      'section'  => 'header-right-section',
      'settings' => 'icon_image_link',
      'priority' => 10,
    )));
$src=get_template_directory_uri() . '/images/social_icons';
	$wp_customize->add_setting('social_icon2[upload_social_icon2]', array(
	    'default'           => $src.'/twitter.png',
	    'capability'        => 'edit_theme_options',
	    'sanitize_callback' => 'upload_sanitize_id',
	    'type'           => 'option',
	    'transport' => ''
	));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'upload_social_icon2', array(
        'label'    => __('Upload Social Icon2', 'lavan'),
        'section'  => 'header-right-section',
        'settings' => 'social_icon2[upload_social_icon2]',
		'priority' => 12
    )));
    $wp_customize->add_setting(
    'right_social_icon_link2',
    array(
        'default' => '',
    ));
  $wp_customize->add_control(
    'right_social_icon_link2',
    array(
        'label' => __('Social Icon2 Link','lavan'),
         'section'  => 'header-right-section',
        'type' => 'text',
        'priority' => 13,
    ));
 $wp_customize->add_setting(  'icon_image_link2');
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'icon_image_link2', array(
      'label'    => 'http://www.socialmedia.com/userid',
      'section'  => 'header-right-section',
      'settings' => 'icon_image_link2',
      'priority' => 14,
    )));
$src=get_template_directory_uri() . '/images/social_icons';
	$wp_customize->add_setting('social_icon3[upload_social_icon3]', array(
	    'default'           => $src.'/pinrest.png',
	    'capability'        => 'edit_theme_options',
	    'sanitize_callback' => 'upload_sanitize_id',
	    'type'           => 'option',
	    'transport' => ''
	));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'upload_social_icon3', array(
        'label'    => __('Upload Social Icon3', 'lavan'),
        'section'  => 'header-right-section',
        'settings' => 'social_icon3[upload_social_icon3]',
		'priority' => 16
    )));    
  $wp_customize->add_setting(
    'right_social_icon_link3',
    array(
        'default' => '',
    ));
  $wp_customize->add_control(
    'right_social_icon_link3',
    array(
        'label' => __('Social Icon3 Link','lavan'),
         'section'  => 'header-right-section',
        'type' => 'text',
        'priority' => 17,
    ));
 $wp_customize->add_setting(  'icon_image_link3');
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'icon_image_link3', array(
      'label'    => 'http://www.socialmedia.com/userid',
      'section'  => 'header-right-section',
      'settings' => 'icon_image_link3',
      'priority' => 18,
    )));
    $src=get_template_directory_uri() . '/images/social_icons';
	$wp_customize->add_setting('social_icon4[upload_social_icon4]', array(
	    'default'           => $src.'/forest.png',
	    'capability'        => 'edit_theme_options',
	    'sanitize_callback' => 'upload_sanitize_id',
	    'type'           => 'option',
	    'transport' => ''
	));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'upload_social_icon4', array(
        'label'    => __('Upload Social Icon4', 'lavan'),
        'section'  => 'header-right-section',
        'settings' => 'social_icon4[upload_social_icon4]',
		'priority' => 20
    )));    
  $wp_customize->add_setting(
    'right_social_icon_link4',
    array(
        'default' => '',
    ));
  $wp_customize->add_control(
    'right_social_icon_link4',
    array(
        'label' => __('Social Icon4 Link','lavan'),
         'section'  => 'header-right-section',
        'type' => 'text',
        'priority' => 21,
    ));
 $wp_customize->add_setting(  'icon_image_link4');
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'icon_image_link4', array(
      'label'    => 'http://www.socialmedia.com/userid',
      'section'  => 'header-right-section',
      'settings' => 'icon_image_link4',
      'priority' => 22,
    )));
    $src=get_template_directory_uri() . '/images/social_icons';
	$wp_customize->add_setting('social_icon5[upload_social_icon5]', array(
	    'default'           => $src.'/stumbleupon.png',
	    'capability'        => 'edit_theme_options',
	    'sanitize_callback' => 'upload_sanitize_id',
	    'type'           => 'option',
	    'transport' => ''
	));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'upload_social_icon5', array(
        'label'    => __('Upload Social Icon5', 'lavan'),
        'section'  => 'header-right-section',
        'settings' => 'social_icon5[upload_social_icon5]',
		'priority' => 24
    )));    
  $wp_customize->add_setting(
    'right_social_icon_link5',
    array(
        'default' => '',
    ));
  $wp_customize->add_control(
    'right_social_icon_link5',
    array(
        'label' => __('Social Icon5 Link','lavan'),
         'section'  => 'header-right-section',
        'type' => 'text',
        'priority' => 25,
    ));
 $wp_customize->add_setting(  'icon_image_link5');
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'icon_image_link5', array(
      'label'    => 'http://www.socialmedia.com/userid',
      'section'  => 'header-right-section',
      'settings' => 'icon_image_link5',
      'priority' => 26,
    )));
	 $colors[] = array(
		'slug'=>'header_right_headings_color',
		'default' => '#ffffff',
		'label' => __('Header  Text Color', 'lavan'),
		'priority' => 28
	);

	$colors[] = array(
		'slug'=>'header_right_link_color',
		'default' => '#ffffff',
		'label' => __('Header Links Color ', 'lavan'),
		'priority' => 29
	);
	$colors[] = array(
		'slug'=>'header_right_link_hover',
		'default' => '#666666',
		'label' => __('Header Links Hover Color', 'lavan'),
		'priority' => 30
	);
 	  $url=get_template_directory_uri();
	  /*$wp_customize->add_setting('search[icon_upload]', array(
        'default'           => $url.'/images/search.png',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'icon_upload', array(
        'label'    => __('Upload Search Box Icon', 'lavan'),
        'section'  => 'header-right-section',
        'settings' => 'search[icon_upload]',
		'priority' => 14
    )));
       $wp_customize->add_setting('disable_pf_singlepage_buttons', array(
      'default' => ''
    ));
  $wp_customize->add_control('disable_pf_singlepage_buttons',array(
    'label' => __('Disable Portfolio Single Page Navigation Buttons','lavan'),
    'type' => 'checkbox',
    'section' => 'pf_page_section',
    'priority' =>3
  ));
     */
   $wp_customize->add_setting( 'disable_search_box', array(
		'default'        => 0,
 ));

	$wp_customize->add_control('disable_search_box', array(
		'label'    => __( 'Disable Search Box','lavan' ),
		'section'  => 'header-right-section',
		'type'     => 'checkbox',
		'priority' =>31
	));	
 $wp_customize->add_setting( 'disable_woocommerce_text', array(
		'default'        => 0,
 ));

	$wp_customize->add_control('disable_woocommerce_text', array(
		'label'    => __( 'Disable Woocommerce Links','lavan' ),
		'section'  => 'header-right-section',
		'type'     => 'checkbox',
		'priority' =>32
	));

    foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'header-right-section',
			'priority' => $color['priority'],
			'settings' => $color['slug'])

		)
	);
}

}
add_action( 'customize_register', 'header_right_section' );
//end

// Menu Section
function menu_section( $wp_customize ) {
		$wp_customize->add_section(
	// ID
	'menu-section',
	// Arguments array
	array(
		'title' => __( 'Menu Section', 'lavan' ),
		'priority'       => 2,
		'capability' => 'edit_theme_options',
		'panel'   => 'header_section_panel',
    'description' => '<a target="_blank" href="https://youtu.be/R7H2tJG9Kwo">'. __( ' Watch this Video ', 'lavan' ).'</a>'.__(' to know how to configure Menu section', 'lavan'),
	)
);
   // Menu  Color
     $colors[] = array(
	'slug'=>'menu_bar_bg_color',
	'default' => '#db0007',
	'label' => __('Menubar Gradient BG Color', 'lavan'),
	'priority' => 30,
);
    $colors[] = array(
	'slug'=>'menu_background_color',
	'default' => '#DB0007',
	'label' => __('Menu Background Color', 'lavan'),
	'priority' =>40,
);
    $colors[] = array(
	'slug'=>'menu_link_color',
	'priority' => 50,
	'default' => '#fff',
	'label' => __('Menu Links Color', 'lavan'),
	
);
    $colors[] = array(
	'slug'=>'menu_link_hover_bg_color',
	'default' => '#ffffff',
	'label' => __('Menu Links Hover BG color', 'lavan'),
	'priority' => 60
	);
    $colors[] = array(
	'slug'=>'menu_link_hover_color',
	'default' => '#db0007',
	'label' => __('Menu Links Hover Color', 'lavan'),
	'priority' => 70
);
     $colors[] = array(
	'slug'=>'menu_bg_active_color',
	'default' => '#db0007',
	'label' => __('Menu Active BG Color', 'lavan'),
	'priority' => 80
);	
    $colors[] = array(
	'slug'=>'menu_link_active_color',
	'priority' => 90,
	'default' => '#fff',
	'label' => __('Menu Active BG Links Color', 'lavan'),
	
);    
$wp_customize->add_setting( 'sub_menu_title_info' );
  $wp_customize->add_control(new Kaya_Customize_Subtitle_control( $wp_customize, 'sub_menu_title_info', array(
        'label'    => __( 'Child Menu Color Settings', 'lavan' ),
        'section'  => 'menu-section',
        'settings' => 'sub_menu_title_info',
        'priority' => 95
    )));
// Sub  Menu
    $colors[] = array(
	'slug'=>'sub_menu_bg_color',
	'default' => '',
	'label' => __('Child Menu BG Color', 'lavan'),
	'priority' => 100
);
    $colors[] = array(
	'slug'=>'sub_menu_bottom_border_color',
	'default' => '#f0f0f0',
	'label' => __('Child Menu Bottom Border Color', 'lavan'),
	'priority' => 110
);
    $colors[] = array(
	'slug'=>'sub_menu_link_color',
	'default' => '',
	'label' => __('Child Menu Links Color', 'lavan'),
	'priority' => 120
);
    
    $colors[] = array(
	'slug'=>'sub_menu_link_hover_bg_color',
	'default' => '#f0f0f0',
	'label' => __('Child Menu Links Hover BG Color', 'lavan'),
	'priority' => 130
);

    $colors[] = array(
	'slug'=>'sub_menu_link_hover_color',
	'default' => '',
	'label' => __('Child Menu Links Hover Color', 'lavan'),
	'priority' => 140
); 

	$wp_customize->add_setting(
    'menu_margin_top',
    array(
        'default' => '',
    )
);
    foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'menu-section',
			'settings' => $color['slug'],
			'priority' => $color['priority'])

		)
	);
}


}
add_action( 'customize_register', 'menu_section'); // End
//end menu section
function mobile_menu_text( $wp_customize ) {
    $wp_customize->add_section(
  // ID
  'mobile_menu_text',
  // Arguments array
  array(
    'title' => __( 'Mobile Menu Go to Text', 'lavan' ),
    'priority'       => 3,
    'capability' => 'edit_theme_options',
    'panel'=>'header_section_panel',
    
  )
);  
  $wp_customize->add_setting( 'mobile_menu_text', array(
      'default' => 'Go to...'
    ));
  $wp_customize->add_control('mobile_menu_text',array(
      'label'    => __( 'Mobile Menu Go to Text', 'lavan' ),
      'type' => 'text',
      'section'  => 'mobile_menu_text',
      'settings' => 'mobile_menu_text',
      'priority' => 4,
  )); 
}
add_action( 'customize_register', 'mobile_menu_text' );

// Page Title color Settings
function page_color_section( $wp_customize ) {
$wp_customize->add_panel( 'page_color_section_panel', array(
      'priority'       => 2,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Page Color Settings', 'lavan' ),

  ) );

		$wp_customize->add_section(
	// ID
	'page-color-section',
	// Arguments array
	array(
		'title' => __( 'Page Title Bar Color Section', 'lavan' ),
		'priority'       => 1,
		'capability' => 'edit_theme_options',
		'panel'  => 'page_color_section_panel',
      'description' => '<a target="_blank" href="https://youtu.be/YgSVz5kS_EM">'. __( ' Watch this Video ', 'lavan' ).'</a>'.__(' to know how to configure Page Title Bar Color settings', 'lavan'),
	)
);
$wp_customize->add_setting( 'select_page_title_background_type',  array(
        'default' => 'bg_type_image',
        'transport' => '',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('select_page_title_background_type', array(
        'type' => 'select',
        'label' => __('Select Background Type','petsvets'),
        'section' => 'page-color-section',
        'choices' => array(
			'bg_type_image' => __('Background Image','petsvets'),
			'bg_type_color' => __('Background Color','petsvets'),
        	),
		'priority' => 2,
    ));	
    $url=get_template_directory_uri().'/images/';	
    $wp_customize->add_setting('page_title_bar[bg_img]',array(
    	'default' =>  $url.'top-opc.png',
    	'capability' => 'edit_theme_options',
    	'type' => 'option'
    	));
     $wp_customize->add_control(
    	new WP_Customize_Image_Control($wp_customize,'page_title_bar',array(
    		'label' =>  __('Upload Transparent BG Image','spa'),
    		'section' => 'page-color-section',
    		'settings' => 'page_title_bar[bg_img]',
    		'priority' => 3,
    	 	)));

    $wp_customize->add_setting('page_title_bar_bg_repeat',
	array(
		'deafult' => 'repeat',
		));
	$wp_customize->add_control('page_title_bar_bg_repeat',
	array(
		'label' => __('Background Repeat','spa'),
		'capability' => 'edit_theme_options', 
		'section' => 'page-color-section',
		'priority' => 4,
		'type' => 'radio',
		'choices' => array(
			'no-repeat' => __('No Repeat','spa'),
			'repeat' => __('Repeat','spa'),
      'cover' => __('Fit Screen','spa')
			)
		));			
    // Page title bar title Color
	    $colors[] = array(
	'slug'=>'page_titlebar_bg_color',
	'default' => '#000000',
	'label' => __('Page Title bar Background Color', 'lavan'),
	'priority' =>5,
);
$wp_customize->add_setting( 'page_title_section', array(
  		'sanitize_callback' => 'text_filed_sanitize',
  	) );
    $wp_customize->add_control( new Kaya_Customize_Subtitle_control( $wp_customize, 'page_title_section', array(
       'label'    => __( 'Page Title Bar Section', 'petsvets' ),
        'section' => 'page-color-section',
      'priority' => 6
    )));	    
    $colors[] = array(
	'slug'=>'page_titlebar_title_color',
	'default' => '#ffffff',
	'label' => __('Title Color', 'lavan'),
	'priority' => 7,
);
 $wp_customize->add_setting( 'page_title_font_size', array(
        'default'        => '36',
        //'transport' => 'postMessage',
    	'sanitize_callback'    => 'check_number',
    ) );
    $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'page_title_font_size', array(
			 'label'   => __('Title Font Size (px)','petsvets'),
        	'section' => 'page-color-section',
			'settings'    => 'page_title_font_size',
			'priority'    => 8,
			'choices'  => array(
				'min'  => 12,
				'max'  => 100,
				'step' => 1
			),
		)));

     $wp_customize->add_setting( 'page_title_font_weight',  array(
        'default' => 'normal',
        //'transport' => 'postMessage',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('page_title_font_weight', array(
        'type' => 'select',
        'label' => __('Title Font Weight','petsvets'),
        'section' => 'page-color-section',
        'choices' => array(
        	 'normal' => 'Normal',
        	 'bold' => 'Bold',
        	),
		'priority' => 9,
    ));
    $wp_customize->add_setting( 'page_title_font_style',  array(
        'default' => 'normal',
       // 'transport' => 'postMessage',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('page_title_font_style', array(
        'type' => 'select',
        'label' => __('Title Font Style','petsvets'),
        'section' => 'page-color-section',
        'choices' => array(
        	 'normal' => __('Normal','petsvets'),
        	 'italic' => __('Italic','petsvets'),
        	),
		'priority' =>10,
    ));
 	$wp_customize->add_setting( 'page_titlebar_font_family',
    array( 'default' => '2',
    	//'transport' => 'postMessage',
    	'sanitize_callback' => 'text_filed_sanitize'
    ));
 	$wp_customize->add_control( new Kaya_Customize_google_fonts_Control( $wp_customize, 'page_titlebar_font_family', array(
		 'label'   => __('Select Title Font Family','petsvets'),
		'section' => 'page-color-section',
		'settings'    => 'page_titlebar_font_family',
		'priority'    => 11,
	)));     
  $wp_customize->add_setting( 'page_title_description_section', array(
  		'sanitize_callback' => 'text_filed_sanitize',
  	) );
    $wp_customize->add_control( new Kaya_Customize_Subtitle_control( $wp_customize, 'page_title_description_section', array(
       'label'    => __( 'Page Title Bar Description Section', 'petsvets' ),
        'section' => 'page-color-section',
      'priority' => 12
    )));
	/*$wp_customize->add_setting( 'title_description_color',	array( 
		'default' => '#fff',
		//'transport' => 'postMessage',
		'sanitize_callback' => 'color_filed_sanitize',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control(
			$wp_customize, 'title_description_color',
		array(
			'label' => __('Description Color','petsvets'),
			'section' => 'page-color-section',
			'priority' => 13

		)));*/
    $colors[] = array(
	'slug'=>'title_description_color',
	'default' => '#ffffff',
	'label' => __('Description Color', 'lavan'),
	'priority' => 13,
);
	$wp_customize->add_setting( 'page_description_font_size', array(
        'default'   => 16,
        //'transport' => 'postMessage',
    	'sanitize_callback'    => 'check_number',
    ) );
    $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'page_description_font_size', array(
			 'label'   => __('Description Font Size (px)','petsvets'),
        	'section' => 'page-color-section',
			'settings'    => 'page_description_font_size',
			'priority'    => 14,
			'choices'  => array(
				'min'  => 10,
				'max'  => 100,
				'step' => 1
			),
		)));
    $wp_customize->add_setting( 'page_description_font_weight',  array(
        'default' => 'normal',
       // 'transport' => 'postMessage',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('page_description_font_weight', array(
        'type' => 'select',
        'label' => __('Font Weight','petsvets'),
        'section' => 'page-color-section',
        'choices' => array(
        	 'normal' => 'Normal',
        	 'bold' => 'Bold',
        	),
		'priority' => 15,
    ));
      $wp_customize->add_setting( 'page_description_font_style',  array(
        'default' => 'normal',
        //'transport' => 'postMessage',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('page_description_font_style', array(
        'type' => 'select',
        'label' => __('Font Style','petsvets'),
        'section' => 'page-color-section',
        'choices' => array(
        	 'normal' => 'Normal',
        	 'italic' => 'Italic',
        	),
		'priority' => 16,
    )); 
    $wp_customize->add_setting( 'page_titlebar_dec_font_family',
    array( 'default' => '2',
    	//'transport' => 'postMessage',
    	'sanitize_callback' => 'text_filed_sanitize'
    ));
 	$wp_customize->add_control( new Kaya_Customize_google_fonts_Control( $wp_customize, 'page_titlebar_dec_font_family', array(
		 'label'   => __('Select Description Font Family','petsvets'),
		'section' => 'page-color-section',
		'settings'    => 'page_titlebar_dec_font_family',
		'priority'    => 17,
	)));   
    foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'page-color-section',
			'priority' => $color['priority'],
			'settings' => $color['slug'])

		)
	);
}


}
add_action( 'customize_register', 'page_color_section' );
//end page titlebar section

//page middle section
function page_middle_section( $wp_customize ){
      $wp_customize->add_section(
  // ID
  'page-middle-section',
    array(
    'title' => __( 'Page Middle Content Color Section', 'lavan' ),
    'priority'       => 1,
    'capability' => 'edit_theme_options',
    'panel' => 'page_color_section_panel',
    //'description' => __( '', 'lavan' )
  )
);    
    $colors[] = array(
	'slug'=>'page_bg_color',
	'default' => '#1d1d1d',
	'label' => __('Background Color', 'lavan'),
	'priority' => 4
);

    $colors[] = array(
	'slug'=>'page_titles_color',
	'default' => '#ffffff',
	'label' => __('Title Color', 'lavan'),
	'priority' => 5
);
        $colors[] = array(
	'slug'=>'page_description_color',
	'default' => '#aaaaaa',
	'label' => __('Content Color', 'lavan'),
	'priority' => 6
);
    $colors[] = array(
	'slug'=>'page_link_color',
	'default' => '#555555',
	'label' => __('Link Color', 'lavan'),
	'priority' => 7
);
 $colors[] = array(
	'slug'=>'page_link_hover_color',
	'default' => '#dd3333',
	'label' => __('Link Hover Color', 'lavan'),
	'priority' => 8
);
     foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'page-middle-section',
			'priority' => $color['priority'],
			'settings' => $color['slug'])

		)
	);
}
}
add_action( 'customize_register', 'page_middle_section' );
//end page middle content section

//page sidebar section
function page_sidebar_section( $wp_customize ) {
	$wp_customize->add_section(
	'page-sidebar-section',
	// Arguments array
	array(
	      'title'    => __( 'Page Sidebar Color Settings', 'lavan' ),
	      'section'  => 'page-sidebar-section',
	      'priority' => 3,
	      'capability' => 'edit_theme_options',
          'panel' => 'page_color_section_panel',
		//'description' => __( '', 'lavan' )
	)
); 

$colors[] = array(
		'label' => __('Sidebar Title Color','lavan'),
		'default' => '#ffffff',
		'priority' => 5	,
		'slug' => 'sidebar_title_color',
		'capability' => 'edit_theme_options'
		);
	$colors[] = array(
			'label' => __('Sidebar Content Color','lavan'),
			'slug' => 'sidebar_content_color',
			'priority' => 6,
			'default' => '#787878',
			'capability' => 'edit_theme_options'
		);
	$colors[] = array(
			'label' => __('Sidebar Link Color','lavan'),
			'slug' => 'sidebar_link_color',
			'priority' => 7,
			'capability' => 'edit_theme_options',
			'default' => '#aaaaaa'
		);
	$colors[] = array(
			'label' => __('Sidebar Link Hover Color','lavan'),
			'slug' => 'sidebar_link_hover_color',
			'default' => '#dd3333',
			'priority' => 8,
			'capability' => 'edit_theme_options'
		); 
    foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'page-sidebar-section',
			'priority' => $color['priority'],
			'settings' => $color['slug'])

		)
	);
}
}
add_action( 'customize_register', 'page_sidebar_section' );
//page sidebar section end 

/* Portfolio Thumbnail Color Settings */
function portfolio_thumbnail_color($wp_customize){
	$wp_customize->add_panel( 'portfolio_thumbnail_panel', array(
      'priority'       => 3,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Portfolio Section', 'lavan' ),
      'description'    => '',
  ) );
	$wp_customize->add_section('pf_section', array(
			'title' => __('Portfolio Section','lavan'),
			'priority' => 0,
			'capability' => 'edit_theme_options',
			'panel'  => 'portfolio_thumbnail_panel'
		));

  $wp_customize->add_setting('pf_slug_name', array(
      'default' => 'portfolio'
    ));
  $wp_customize->add_control('pf_slug_name',array(
    'label' => __('Portfolio Slug Name','lavan'),
    'type' => 'text',
    'section' => 'pf_section',
    'priority' => 1
  ));
$wp_customize->add_setting( 'pf_slug_note' );
  	$wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'pf_slug_note', array(
      'html_tags' => true,
      'label'    => __( '<strong class="customizer_note">Note: </strong> Please make sure that the permalinks to be updated by navigating to "Settings > Permalinks" select post and save changes to avoid 404 error page. for more information.', 'lavan' ).'<a target="_blank" href="https://youtu.be/mw2gaY1Hzes">'.__(' Watch this Video ', 'lavan').'</a>',
      'section'  => 'pf_section',
      'settings' => 'pf_slug_note',
      'priority' => 2
    ))
  );
   $wp_customize->add_setting('disable_pf_singlepage_buttons', array(
      'default' => ''
    ));
  $wp_customize->add_control('disable_pf_singlepage_buttons',array(
    'label' => __('Disable Portfolio Single Page Navigation Buttons','lavan'),
    'type' => 'checkbox',
    'section' => 'pf_section',
    'priority' =>3
  ));
}
add_action('customize_register','portfolio_thumbnail_color');
//end
//related posts
 function related_posts_section( $wp_customize ) {
	$wp_customize->add_section(
	'related_post_section',
	// Arguments array
	array(
	      'title'    => __( 'Related Posts Section', 'lavan' ),
	      'section'  => 'page-sidebar-section',
	      'priority' => 1,
	      'capability' => 'edit_theme_options',
          'panel' => 'portfolio_thumbnail_panel',
    'description' => __('<span class="customizer_note">Note:</span> To know how to configure Related posts Section','lavan').'<a target="_blank" href="https://youtu.be/nIaORr2hVdQ">'.__(' Watch this Video ', 'lavan').'</a>',
	)
);  
	$wp_customize->add_setting('pf_related_post_title', array(
			'default' => 'Related Post'
		));
	$wp_customize->add_control('pf_related_post_title',array(
		'label' => __('Change Related Post Title','lavan'),
		'type' => 'text',
		'section' => 'related_post_section',
		'priority' => 3
	));
  $wp_customize->add_setting('pf_related_images_height', array(
      'default' => '500',
      'sanitize_callback' => 'check_number'
    ));
  $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'pf_related_images_height', array(
    'label' => __('Related Post Thumbnail Height (px)','lavan'),
    'section' => 'related_post_section',
    'priority' => 4,
    		'choices'  => array(
			'min'  => 200,
			'max'  => 1000,
			'step' => 1
		),
  )));
  $wp_customize->add_setting( 'related_posts_sub_title' );
  $wp_customize->add_control(
      new Kaya_Customize_Subtitle_control( $wp_customize, 'related_posts_sub_title', array(
        'label'    => __( 'Posts Title Settings', 'lavan' ),
        'section'  => 'related_post_section',
        'settings' => 'related_posts_sub_title',
        'priority' => 17
    )));
    $wp_customize->add_setting('disable_related_post', array(
      'default' => ''
    ));
  $wp_customize->add_control('disable_related_post',array(
    'label' => __('Disable Posts Title','lavan'),
    'type' => 'checkbox',
    'section' => 'related_post_section',
    'priority' => 19
  ));
  $wp_customize->add_setting( 'related_posts_title_bg_color',
    array( 
      'default' => '#ff0000'
    ));
  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize, 'related_posts_title_bg_color',
    array(
      'label' => __('Title Background Color','lavan'),
      'section' => 'related_post_section',
      'priority' => 20,
      'type' => 'color',
    )));  
  $wp_customize->add_setting( 'related_posts_title_color',
    array( 
      'default' => '#ffffff'
    ));
  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize, 'related_posts_title_color',
    array(
      'label' => __('Title Color','lavan'),
      'section' => 'related_post_section',
      'priority' => 21,
      'type' => 'color',
    ))); 
   $wp_customize->add_setting('relatedposts_lightbox_disable', array(
      'default' => ''
    ));
  $wp_customize->add_control('relatedposts_lightbox_disable',array(
    'label' => __('Disable Lightbox Icon','lavan'),
    'type' => 'checkbox',
    'section' => 'related_post_section',
    'priority' => 22
  ));
     $wp_customize->add_setting('related_post_link_disable', array(
      'default' => ''
    ));
  $wp_customize->add_control('related_post_link_disable',array(
    'label' => __(' Disable Post Link Icon ','lavan'),
    'type' => 'checkbox',
    'section' => 'related_post_section',
    'priority' => 23
  ));
  }
add_action('customize_register','related_posts_section');
  //end
  //portfolio category
   function portfolio_catefory_section( $wp_customize ) {
	$wp_customize->add_section(
	'pf_page_section',
	// Arguments array
	array(
	      'title'    => __( 'Portfolio Category Section', 'lavan' ),
	      'section'  => 'page-sidebar-section',
	      'priority' => 3,
	      'capability' => 'edit_theme_options',
          'panel' => 'portfolio_thumbnail_panel',
		//'description' => __( '', 'lavan' )
	)
); 
  $wp_customize->add_setting( 'pf_category_menu_note' );
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'pf_category_menu_note', array(
      'html_tags' => true,
    'label' => __('<span class="customizer_note">Note:</span> Use this section when you use "Portfolio Categories" in menu bar. for more information','lavan').'<a target="_blank" href="https://youtu.be/OCPIMxEm9hw">'.__(' Watch this Video ', 'lavan').'</a>',
      'section'  => 'pf_page_section',
      'settings' => 'pf_slug_note',
      'priority' => 6
    ))
  );
    $wp_customize->add_setting('pf_page_sidebar', array(
      'default' => 'fullwidth'
    ));
    	$wp_customize->add_control('pf_page_sidebar',array(
		'label' => __('Category Page Layout','lavan'),
		'type' => 'radio',
		'section' => 'pf_page_section',
		'choices' => array(
			'fullwidth' => __('No Sidebar','lavan'),
			'two_third' => __('Right','lavan'),
			'two_third_last' => __('Left','lavan')
			),
		'priority' => 7
	));
   $wp_customize->add_setting( 'pf_sidebar_id', array(
    	'sanitize_callback' => 'text_filed_sanitize',
    	'default' => '',
    ));
    $wp_customize->add_control( new Kaya_Customize_Sidebar_Control( $wp_customize, 'pf_sidebar_id', array(
      'label'    => __( 'Select Sidebar', 'petsvets' ),
      'section'  => 'pf_page_section',
      'settings' => 'pf_sidebar_id',
      'priority' => 8,
    ))); 	
    $wp_customize->add_setting(
    'pf_thumbnail_columns',
    array(
        'default' => '4',
    )
);
    $wp_customize->add_control(
    'pf_thumbnail_columns',
    array(
        'type' => 'select',
        'label' => __('Select Columns','lavan'),
        'section' => 'pf_page_section',
        'choices' => array(
        	 '4' => __('4 Columns','lavan'),
        	 '3' => __('3 Columns','lavan'),
        	'2' => __('2 Columns','lavan'),
        	),
		'priority' => 9,
    )
);
    // Portfolio Order
  $wp_customize->add_setting('pf_post_order',
    array(
        'default' => 'DESC',
    ));
    $wp_customize->add_control(
    'pf_post_order',
    array(
        'type' => 'select',
        'label' => __('Order','lavan'),
        'section' => 'pf_page_section',
        'choices' => array(
           'DESC' => __('Descending Order','lavan'),
           'ASC' => __('Ascending Order','lavan'),
          ),        
    'priority' => 10,
    )
);
  $wp_customize->add_setting('pf_post_orderby',
    array(
        'default' => 'title',
    ));
    $wp_customize->add_control(
    'pf_post_orderby',
    array(
        'type' => 'select',
        'label' => __('Order By','lavan'),
        'section' => 'pf_page_section',
        'choices' => array(
           'date' => __('Date','lavan'),
           'menu_order' => __('Menu Order','lavan'),
           'title' => __('Title','lavan'),
           'random' => __('Random','lavan'),
          ),
    'priority' => 11,
    )
);
  $wp_customize->add_setting('pf_images_height', array(
			'default' => '400',
			'sanitize_callback' => 'check_number'
		));
	$wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'pf_images_height', array(
		'label' => __('Thumbnail Height (px)','lavan'),
		'type' => 'text',
		'section' => 'pf_page_section',
		'priority' => 12,
		'choices'  => array(
			'min'  => 400,
			'max'  => 1000,
			'step' => 1
		),
	)));  
   $wp_customize->add_setting('pf_lightbox_disable', array(
      'default' => ''
    ));
  $wp_customize->add_control('pf_lightbox_disable',array(
    'label' => __('Disable Lightbox Icon','lavan'),
    'type' => 'checkbox',
    'section' => 'pf_page_section',
    'priority' => 13
  ));
     $wp_customize->add_setting('pf_post_link_disable', array(
      'default' => ''
    ));
  $wp_customize->add_control('pf_post_link_disable',array(
    'label' => __('	Disable Post Link Icon ','lavan'),
    'type' => 'checkbox',
    'section' => 'pf_page_section',
    'priority' => 14
  ));

$wp_customize->add_setting('enable_prettyphoto_socialicons', array(
      'default' => '',
      'sanitize_callback' => 'checkbox_field_sanitize',
    ));
  $wp_customize->add_control('enable_prettyphoto_socialicons',array(
    'label' => __('Enable Pretty Photo Social Icons','lavan'),
    'type' => 'checkbox',
    'section' => 'pf_page_section',
    'priority' => 15
  ));
      $wp_customize->add_setting('disable_prettyphoto_thumbnails', array(
      'default' => '',
      'sanitize_callback' => 'checkbox_field_sanitize',
    ));
  $wp_customize->add_control('disable_prettyphoto_thumbnails',array(
    'label' => __('Disable Pretty Photo Thumbnails','lavan'),
    'type' => 'checkbox',
    'section' => 'pf_page_section',
    'priority' => 16
  ));
   $wp_customize->add_setting('disable_prettyphoto_post_title', array(
      'default' => '',
      'sanitize_callback' => 'checkbox_field_sanitize',
    ));
  $wp_customize->add_control('disable_prettyphoto_post_title',array(
    'label' => __('Enable Pretty Photo Title','lavan'),
    'type' => 'checkbox',
    'section' => 'pf_page_section',
    'priority' => 17
  ));
  $wp_customize->add_setting( 'pf_posts_sub_title' );
  $wp_customize->add_control(
      new Kaya_Customize_Subtitle_control( $wp_customize, 'pf_posts_sub_title', array(
        'label'    => __( 'Posts Title Settings', 'lavan' ),
        'section'  => 'pf_page_section',
        'settings' => 'pf_posts_sub_title',
        'priority' => 18
    )));
   $wp_customize->add_setting('enable_post_title_link', array(
      'default' => ''
    ));
  $wp_customize->add_control('enable_post_title_link',array(
    'label' => __('Enable Post Title Link','lavan'),
    'type' => 'checkbox',
    'section' => 'pf_page_section',
    'priority' => 19
  ));
    $wp_customize->add_setting('pf_disable_title', array(
      'default' => ''
    ));
  $wp_customize->add_control('pf_disable_title',array(
    'label' => __('Disable Posts Title','lavan'),
    'type' => 'checkbox',
    'section' => 'pf_page_section',
    'priority' => 19
  ));
  $wp_customize->add_setting( 'pf_posts_title_bg_color',
    array( 
      'default' => '#ff0000'
    ));
  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize, 'pf_posts_title_bg_color',
    array(
      'label' => __('Title Background Color','lavan'),
      'section' => 'pf_page_section',
      'priority' => 20,
      'type' => 'color',
    )));  
  $wp_customize->add_setting( 'pf_posts_title_color',
    array( 
      'default' => '#ffffff'
    ));
  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize, 'pf_posts_title_color',
    array(
      'label' => __('Title Color','lavan'),
      'section' => 'pf_page_section',
      'priority' => 21,
      'type' => 'color',
    )));  
}
add_action('customize_register','portfolio_catefory_section');
/*-----------------------------------------------------------------------------------*/ 
// Blog Single Page
/*-----------------------------------------------------------------------------------*/ 
function blog_single_page_section( $wp_customize ){
  $wp_customize->add_section('blog_page_section',array(
      'title' => __('Blog Page Section','lavan'),
      'priority' => 4,
    ));
    $wp_customize->add_setting('kaya_readmore_blog', 
    array(
        'default' => '',
    ));
$wp_customize->add_control(
    'kaya_readmore_blog',
    array(
        'label' => __('Readmore Button Text', 'lavan' ),
        'section' => 'blog_page_section',
        'type' => 'text',
        'priority' => 0,    
    ));
 	$wp_customize->add_setting( 'kaya_readmore_blog_note', array(
    	'sanitize_callback' => 'text_filed_sanitize',
    	) );
    $wp_customize->add_control( new Kaya_Customize_Description_Control( $wp_customize, 'kaya_readmore_blog_note', array(
	      'html_tags' => true,	
	      'label'    => __( '<span class="customizer_note">Note: </span> Above Field works only blog category, archives and tag pages', 'lavan' ),
	      'section'  => 'blog_page_section',
	      'settings' => 'kaya_readmore_blog_note',
	      'priority' => 1
    	))
  	);
  $wp_customize->add_setting('blog_single_page_sidebar', array(
      'default' => 'two_third'
    ));
  $wp_customize->add_control('blog_single_page_sidebar',array(
    'label' => __('Blog Single Page Sidebar','lavan'),
    'type' => 'radio',
    'section' => 'blog_page_section',
    'choices' => array(
      'fullwidth' => __('No Sidebar','lavan'),
      'two_third' => __('Right','lavan'),
      'two_third_last' => __('Left','lavan')
      ),
    'priority' => 2
  ));

}
add_action('customize_register','blog_single_page_section');
//end blog
/*-----------------------------------------------------------------------------------*/

// Footer Section 
function footer_section( $wp_customize ) {
	$wp_customize->add_panel( 'footer_section_panel', array(
      'priority'       => 5,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Footer Section', 'lavan' ),
      'description'    => '',
  ) );
		$wp_customize->add_section(
	// ID
	'footer-section',
	// Arguments array
	array(
		'title' => __( 'Footer Section', 'lavan' ),
		'priority'       => 12,
		'capability' => 'edit_theme_options',
		'panel' =>'footer_section_panel',
		//'description' => __( '', 'lavan' )
	)
);
$wp_customize->add_setting( 'select_footer_type',  array(
        'default' => 'page_footer',
        'transport' => '',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('select_footer_type', array(
        'type' => 'select',
        'label' => __('Select Footer Type','lavan'),
        'section' => 'footer-section',
        'choices' => array(
        	 'main_footer' => __('Main Footer','lavan'),
        	 'page_footer' => __('Page Footer','lavan'),
        	),
		'priority' => 1,
    ));
	
  $wp_customize->add_setting( 'main_footer_disable' );
	$wp_customize->add_control( 'main_footer_disable', array(
	      'label'    => __( 'Main Footer Settings', 'lavan' ),
	      'section'  => 'footer-section',
	      'settings' => 'main_footer_disable',
	      'type' => 'checkbox',
	      'priority' => 4
    ));
   $wp_customize->add_setting( 'main_footer_disable' );
	$wp_customize->add_control( 'main_footer_disable', array(
	      'label'    => __( 'Disable Main Footer', 'lavan' ),
	      'section'  => 'footer-section',
	      'settings' => 'main_footer_disable',
	      'type' => 'checkbox',
	      'priority' => 5
    ));

     $wp_customize->add_setting('main_footer_columns',
	array(
		'deafult' => 'twothird',
		));
     $src = get_template_directory_uri() . '/images/footer_columns/';
$wp_customize->add_control(
new Kaya_Customize_Images_Radio_Control(
$wp_customize,'main_footer_columns',
	array(
		'label' => __('Display Columns','lavan'),
		'section' => 'footer-section',
		'priority' => 6,
			'type' => 'img_radio', // Image radio replacement
			'choices' => array(
				'1' => array( 'label' => __( 'Col-1', 'lavan' ),'img_src' => $src . 'fc1.png' ),
				'2' => array( 'label' => __( 'Col-2', 'lavan' ),'img_src' => $src . 'fc2.png' ),
				'3' => array( 'label' => __( 'Col-1', 'lavan' ),'img_src' => $src . 'fc3.png' ),
				'4' => array( 'label' => __( 'Col-2', 'lavan' ),'img_src' => $src . 'fc4.png' ),
				'5' => array( 'label' => __( 'Col-1', 'lavan' ),'img_src' => $src . 'fc5.png' ),
				'twothird' => array( 'label' => __( 'Col-2', 'lavan' ),'img_src' => $src . 'two_third_one_third.png' ),
				'onethird' => array( 'label' => __( 'Col-1', 'lavan' ),'img_src' => $src . 'one_third_two_third.png' ),
				'threefourth' => array( 'label' => __( 'Col-2', 'lavan' ),'img_src' => $src . 'three_fourth_one_fourth.png' ),
				'onefourth' => array( 'label' => __( 'Col-1', 'lavan' ),'img_src' => $src . 'one_fourth_three_fourth.png' ),
				'halffourth' => array( 'label' => __( 'Col-2', 'lavan' ),'img_src' => $src . 'two_fourth_fourth_fourth.png' ),
				'twofourth' => array( 'label' => __( 'Col-1', 'lavan' ),'img_src' => $src . 'fourth_fourth_two_fourth.png' ),
				'fifth_fifth' => array( 'label' => __( 'Col-2', 'lavan' ),'img_src' => $src . 'fifth_fifth_three_fifth.png' ),
				'three_fifth' => array( 'label' => __( 'Col-1', 'lavan' ),'img_src' => $src . 'three_fifth_fifth_fifth.png' ),
				'fifth_fifth_fifth' => array( 'label' => __( 'Col-2', 'lavan' ),'img_src' => $src . 'fifth_fifth_fifth_two_fifth.png' ),
				'two_fifth' => array( 'label' => __( 'Col-1', 'lavan' ),'img_src' => $src . 'two_fifth_fifth_fifth_fifth.png' ),
			),	
		)));
	// Footer background type
	$wp_customize->add_setting( 'select_footer_background_type',  array(
        'default' => 'bg_type_color',
        'transport' => '',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('select_footer_background_type', array(
        'type' => 'select',
        'label' => __('Select Background Type','petsvets'),
        'section' => 'footer-section',
        'choices' => array(
			'bg_type_image' => __('Background Image','petsvets'),
			'bg_type_color' => __('Background Color','petsvets'),
        	),
		'priority' => 7,
    ));	
       $wp_customize->add_setting('footer_bg[bg_img]',array(
    	'default' => '',
    	'capability' => 'edit_theme_options',
    	'sanitize_callback' => 'upload_sanitize_id',
    	//'transport' => 'postMessage',
    	));
    $wp_customize->add_control(	new WP_Customize_Image_Control($wp_customize,'footer_bg',array(
    		'label' =>  __('Upload Background Image','petsvets'),
    		'section' => 'footer-section',
    		'settings' => 'footer_bg[bg_img]',
    		'priority' => 8
    	 	)));

    $wp_customize->add_setting('footer_bg_repeat',
	array(
		'deafult' => 'repeat',
		//'transport' => 'postMessage',
		'sanitize_callback' => 'radio_buttons_sanitize',
		));
	$wp_customize->add_control('footer_bg_repeat',
	array(
		'label' => __('Background Repeat', 'petsvets'),
		'capability' => 'edit_theme_options', 
		'section' => 'footer-section',
		'priority' => 9,
		'type' => 'radio',
		'choices' => array(
			'no-repeat' => __('No Repeat','petsvets'),
			'repeat' => __('Repeat', 'petsvets'),
			'cover'	=> __('Cover','petsvets'),
			)
		));
   // Footer BG Color
    $colors[] = array(
	'slug'=>'footer_bg_color',
	'default' => '#DB0007',
	'label' => __('Footer Background Color', 'lavan'),
	'priority' => 10
);
     $colors[] = array(
	'slug'=>'footer_bg_top_color',
	'default' => '#DB0007',
	'label' => __('Footer Top Background Color', 'lavan'),
	'priority' => 11
);
    $colors[] = array(
	'slug'=>'footer_title_color',
	'default' => '#ffffff',
	'label' => __('Titles Color', 'lavan'),
	'priority' => 12
);
    $colors[] = array(
	'slug'=>'footer_text_color',
	'default' => '#FFACAF',
	'label' => __('Content Color', 'lavan'),
	'priority' => 13
);
    $colors[] = array(
	'slug'=>'footer_link_color',
	'default' => '#ffffff',
	'label' => __('Hyper Link Color', 'lavan'),
	'priority' => 14
);
    $colors[] = array(
	'slug'=>'footer_link_hover_color',
	'default' => '#FFACAF',
	'label' => __('Hyper Link Hover Color', 'lavan'),
	'priority' => 15
);
 foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option',
			'capability' =>
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array('label' => $color['label'],
			'section' => 'footer-section',
			'priority' => $color['priority'],
			'settings' => $color['slug'])

		)
	);
}
 $wp_customize->add_setting( 'page_footer_note', array(
    	'sanitize_callback' => 'text_filed_sanitize',
    ));
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'page_footer_note', array(
      	 'html_tags' => true,
		'label'    => __( '<span class="customizer_note">Note:</span> Before creating \' Page Footer \'','lavan').'<a target="_blank" href="https://youtu.be/8umh_RSQ3kU">'.__(' Watch this Video ', 'lavan').'</a>',
      'section'  => 'footer-section',
      'settings' => 'page_footer_note',
      'priority' =>15
    )));
	$wp_customize->add_setting( 'footer_page_id', array(
    	'sanitize_callback' => 'text_filed_sanitize',
    	'default' => '',
    	) );
    $wp_customize->add_control(  new Kaya_Customize_Page_Control( 
      $wp_customize, 'footer_page_id', array(
      'label'    => __( 'Select Page Footer', 'lavan' ),
      'section'  => 'footer-section',
      'settings' => 'footer_page_id',
      'priority' => 14,

    )));

}
add_action( 'customize_register', 'footer_section' );
//end main footer
//page based footer
function page_content_footer( $wp_customize ){
		$wp_customize->add_section('footer_page_section',array(
			'title' => __('Page Based Footer','lavan'),
			'priority' => 13,
			'panel' => 'footer_section_panel'
		));
	$wp_customize->add_setting( 'footer_page_id', array(
    	'sanitize_callback' => 'text_filed_sanitize',
    	'default' => '',
    	) );
    $wp_customize->add_control(  new Kaya_Customize_Page_Control( 
      $wp_customize, 'footer_page_id', array(
      'label'    => __( 'Select Page Footer', 'lavan' ),
      'section'  => 'footer_page_section',
      'settings' => 'footer_page_id',
      'priority' => 1,
    )));
}

//add_action('customize_register','page_content_footer');
//end page footer
//footer bottom
function most_footer_bottom_section($wp_customize){
$wp_customize->add_section(
'bottom-footer' ,    
 array(
	      'title'    => __( 'Most Footer Bottom Settings', 'lavan' ),
	      'section'  => 'bottom-footer',
	      'settings' => 'most_footer_bottom_sub_title',
	      'priority' => 14,
	      'panel'    => 'footer_section_panel',
	      'description' =>  '<a target="_blank" href="https://youtu.be/fTzt8853BEU">'.__( ' Watch this Video ', 'petsvets' ) .'</a>'.__(' to know how to configure Most Footer Bottom settings', 'petvets'),
    )
 );
   /*$wp_customize->add_setting( 'most_footer_disable' );
	$wp_customize->add_control( 'most_footer_disable', array(
	      'label'    => __( 'Disable Most Footer Bottom', 'lavan' ),
	      'section'  => 'bottom-footer',
	      'settings' => 'most_footer_disable',
	      'type' => 'checkbox',
	      'priority' => 15
    ));

  $wp_customize->add_setting( 'most_footer_left_section' );
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'most_footer_left_section', array(
      'label'    => __( 'Left Section', 'lavan' ),
      'section'  => 'bottom-footer',
      'settings' => 'most_footer_left_section',
      'priority' => 16,
      'type' => 'text-area',
      ))  );
    $wp_customize->add_setting( 'most_footer_right_section' );
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'most_footer_right_section', array(
      'label'    => __( 'Right Section', 'lavan' ),
      'section'  => 'bottom-footer',
      'settings' => 'most_footer_right_section',
      'priority' => 17,
      'type' => 'text-area',
      ))  );*/
$wp_customize->add_setting( 'select_most_footer_style',  array(
        'default' => 'left_content_right_menu',
        'transport' => '',
        'sanitize_callback' => 'radio_buttons_sanitize'
    ));
    $wp_customize->add_control('select_most_footer_style', array(
        'type' => 'select',
        'label' => __('Select Most Footer Style','petsvets'),
        'section' => 'bottom-footer',
        'choices' => array(
        	'left_content_right_menu' => __('Left Content & Right Menu','petsvets'),
			'left_menu_right_content' => __('Left Menu & Right Content','petsvets'),
			'left_content_right_content' => __('Left & Right Content','petsvets'),
			'center_content_center_menu' => __('Content & Menu Center','petsvets'),
			'none'   => __('None', 'petsvets'),
        	),
		'priority' => 20,
    ));
    $wp_customize->add_setting( 'footer_left_section_title', array(
		'sanitize_callback' => 'text_filed_sanitize',
	) );
	$wp_customize->add_control(new Kaya_Customize_Subtitle_control( $wp_customize, 'footer_left_section_title', array(
		'label'    => __( 'Left Section', 'petsvets' ),
		'section'  => 'bottom-footer',
		'settings' => 'footer_left_section_title',
		'priority' => 40
    )));
    $wp_customize->add_setting( 'most_footer_left_section', array(
		'deafult' => __('Copy rights kayapati.com','petsvets'),
		//'transport' => 'postMessage',
		'sanitize_callback' => 'text_filed_sanitize',
    ));
    $wp_customize->add_control(new Kaya_Customize_Textarea_Control( $wp_customize, 'most_footer_left_section', array(
      'label'    => __( 'Left Section', 'petsvets' ),
      'section'  => 'bottom-footer',
      'settings' => 'most_footer_left_section',
      'priority' => 60,
      'type' => 'text-area',
    )) );
    $wp_customize->add_setting( 'footer_menu_left_note', array(
        'sanitize_callback' => 'text_filed_sanitize'
    ));
  	$wp_customize->add_control( new Kaya_Customize_Description_Control( $wp_customize, 'footer_menu_left_note', array(
  		'html_tags' => true,
		'label'    => __( '<span class="customizer_note">Note:</span> Display menu links in left section goto \' Appearance > Menus \' ', 'petsvets' ).'<a target="_balnk" href="'.admin_url( 'nav-menus.php', 'http' ).'">'.__('Create Footer Menu ', 'petsvets').' </a>'.__(' & Select Theme locations as a \' Footer Navigation \'', 'petsvets'),
		 'section'  => 'bottom-footer',
		'settings' => 'footer_menu_left_note',
		'priority' => 70
    )));
    $wp_customize->add_setting( 'footer_right_section_title', array(
		'sanitize_callback' => 'text_filed_sanitize',
	) );
	$wp_customize->add_control(new Kaya_Customize_Subtitle_control( $wp_customize, 'footer_right_section_title', array(
		'label'    => __( 'Right Section', 'petsvets' ),
		'section'  => 'bottom-footer',
		'settings' => 'footer_right_section_title',
		'priority' => 80
    )));
    $wp_customize->add_setting( 'most_footer_right_section', array(
		'default' => '',
		//'transport' => 'postMessage',
		'sanitize_callback' => 'text_filed_sanitize',
    ));
   	$wp_customize->add_control(new Kaya_Customize_Textarea_Control( $wp_customize, 'most_footer_right_section', array(
      'label'    => __( 'Right Section', 'petsvets' ),
      'section'  => 'bottom-footer',
      'settings' => 'most_footer_right_section',
      'priority' => 90,
      'type' => 'text-area',
     )) );
   	$wp_customize->add_setting( 'footer_menu_right_note', array(
        'sanitize_callback' => 'text_filed_sanitize'
    ));
  	$wp_customize->add_control( new Kaya_Customize_Description_Control( $wp_customize, 'footer_menu_right_note', array(
  		'html_tags' => true,
		'label'    => __( '<span class="customizer_note">Note:</span> Display menu links in right section goto \' Appearance > Menus \' ', 'petsvets' ).'<a target="_balnk" href="'.admin_url( 'nav-menus.php', 'http' ).'">'.__('Create Footer Menu ', 'petsvets').' </a>'.__(' & Select Theme locations as a \' Footer Navigation \'', 'petsvets'),
		 'section'  => 'bottom-footer',
		'settings' => 'footer_menu_right_note',
		'priority' => 95
    )));
   	$wp_customize->add_setting( 'footer_left_right_color_title', array(
		'sanitize_callback' => 'text_filed_sanitize',
	) );
    $wp_customize->add_control(new Kaya_Customize_Subtitle_control( $wp_customize, 'footer_left_right_color_title', array(
		'label'    => __( 'Menu & Content Color Settings', 'petsvets' ),
		'section'  => 'bottom-footer',
		'settings' => 'footer_left_right_color_title',
		'priority' => 100
    )));
    $colors[] = array(
		'slug'=>'most_footer_bg_color',
		'default' => '#171717',
		'label' => __('Background Color', 'petsvets'),
		'priority' => 110
	);
    $colors[] = array(
		'slug'=>'most_footer_text_color',
		'default' => '#757575',
		'label' => __('Content Color', 'petsvets'),
		'priority' => 120
	);
    $colors[] = array(
		'slug'=>'most_footer_link_color',
		'default' => '#ffffff',
		'label' => __('Hyper Link Color', 'petsvets'),
		'priority' => 130
	);
    $colors[] = array(
		'slug'=>'most_footer_link_hover_color',
		'default' => '#ffffff',
		'label' => __('Hyper Link Hover Color', 'petsvets'),
		'priority' => 140
	);
    foreach( $colors as $color ) {
		$wp_customize->add_setting(	$color['slug'], array(
			'default' => $color['default'],
			//'transport' => 'postMessage',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'color_filed_sanitize',
		));
		// CONTROLS
		$wp_customize->add_control(new WP_Customize_Color_Control(	$wp_customize,	$color['slug'],	array(
			'label' => $color['label'],
			'section' => 'bottom-footer',
			'priority' => $color['priority'],
			'settings' => $color['slug'])
		));
	}
}
add_action( 'customize_register', 'most_footer_bottom_section' );
//footer end
// Typography
function typography( $wp_customize ){
	$wp_customize->add_panel( 'typography_panel_section', array(
	    'priority'       => 140,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	  	'title' => __( 'Typography Section', 'lavan' ),
	) );

	$wp_customize->add_section(
	// ID
	'typography_section',
	// Arguments array
	array(
		'title' => __( 'Google Font Family', 'lavan' ),
		'priority'       => '10',
		'capability' => 'edit_theme_options',
		'panel' => 'typography_panel_section',
		'description' => __( 'Search Google Fonts', 'lavan' )."<a href='http://www.google.com/fonts' target='_blank' > here </a>"
	)
);	
$wp_customize->add_setting( 'google_body_font',
    array( 'default' => 'Open Sans',
    	'transport' => 'postMessage',
    	'sanitize_callback' => 'text_filed_sanitize'
    ));
$wp_customize->add_control( new Kaya_Customize_google_fonts_Control( $wp_customize, 'google_body_font', array(
		'label'   => __('Select font for Body','lavan'),
		'section' => 'typography_section',
		'settings'    => 'google_body_font',
		'priority'    => 0,
	)));
 $wp_customize->add_setting( 'google_heading_font',
    array( 'default' => 'Gafata',
    	'transport' => 'postMessage',
    	'sanitize_callback' => 'text_filed_sanitize'
    ));
 $wp_customize->add_control( new Kaya_Customize_google_fonts_Control( $wp_customize, 'google_heading_font', array(
		 'label'   => __('Select font for Headings','lavan'),
		'section' => 'typography_section',
		'settings'    => 'google_heading_font',
		'priority'    =>1,
		)));

$wp_customize->add_setting( 'google_menu_font',
    array( 'default' => 'Offside',
    	'transport' => 'postMessage',
    	'sanitize_callback' => 'text_filed_sanitize'
    ));
$wp_customize->add_control( new Kaya_Customize_google_fonts_Control( $wp_customize, 'google_menu_font', array(
		 'label'   => __('Select font for Top Menu','lavan'),
		'section' => 'typography_section',
		'settings'    => 'google_menu_font',
		'priority'    => 2,
))); 

}
add_action( 'customize_register', 'typography' );
//end google font 

//font sizes
function font_sizes($wp_customize){
	$wp_customize->add_section(
    'font-size-section',
     array(
			'title' => __('Font Section','lavan'),
			'priority' => '20',
			'capability' => 'edit_theme_options',
            'panel' => 'typography_panel_section',

		));
// Body Font Size
$wp_customize->add_setting('body_font_size',
    array( 'default' => '15',
    	'transport' => '',
    	'sanitize_callback' => 'check_number'
    ));

 $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'body_font_size', array(
		 'label'   => __('Body Font Size','lavan'),
		 'type' => 'select',
		'section' => 'font-size-section',
		'settings'    => 'body_font_size',
		'priority'    => 3,
		'choices'  => array(
			'min'  => 10,
			'max'  => 30,
			'step' => 1
		),
		)));
$wp_customize->add_setting('menu_font_size',
    array( 'default' => '15',
    	'transport' => '',
    	'sanitize_callback' => 'check_number'
    ));

 $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'menu_font_size', array(
		 'label'   => __('Menu Font Size','lavan'),
		 'type' => 'select',
		'section' => 'font-size-section',
		'settings'    => 'menu_font_size',
		'priority'    => 4,
		'choices'  => array(
			'min'  => 10,
			'max'  => 30,
			'step' => 1
		),
		)));
$wp_customize->add_setting('h1_title_fontsize',
    array( 'default' => '30',
    	'transport' => '',
    	'sanitize_callback' => 'check_number'
    ));

 $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h1_title_fontsize', array(
		 'label'   => __('Font size for heading - H1','lavan'),
		 'type' => 'select',
		'section' => 'font-size-section',
		'settings'    => 'h1_title_fontsize',
		'priority'    => 5,
		'choices'  => array(
			'min'  => 10,
			'max'  => 80,
			'step' => 1
		),
		)));
$wp_customize->add_setting('h2_title_fontsize',
    array( 'default' => '24',
    	'transport' => '',
    	'sanitize_callback' => 'check_number'
    ));

 $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h2_title_fontsize', array(
		 'label'   => __('Font size for heading - H2','lavan'),
		 'type' => 'select',
		'section' => 'font-size-section',
		'settings'    => 'h2_title_fontsize',
		'priority'    => 6,
		'choices'  => array(
			'min'  => 10,
			'max'  => 80,
			'step' => 1
		),
		)));
 $wp_customize->add_setting('h3_title_fontsize',
    array( 'default' => '20',
    	'transport' => '',
    	'sanitize_callback' => 'check_number'
    ));

 $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h3_title_fontsize', array(
		 'label'   => __('Font size for heading - H3','lavan'),
		 'type' => 'select',
		'section' => 'font-size-section',
		'settings'    => 'h3_title_fontsize',
		'priority'    => 7,
		'choices'  => array(
			'min'  => 10,
			'max'  => 80,
			'step' => 1
		),
		)));
  $wp_customize->add_setting('h4_title_fontsize',
    array( 'default' => '18',
    	'transport' => '',
    	'sanitize_callback' => 'check_number'
    ));

 $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h4_title_fontsize', array(
		 'label'   => __('Font size for heading - H4','lavan'),
		 'type' => 'select',
		'section' => 'font-size-section',
		'settings'    => 'h4_title_fontsize',
		'priority'    => 8,
		'choices'  => array(
			'min'  => 10,
			'max'  => 80,
			'step' => 1
		),
		)));
   $wp_customize->add_setting('h5_title_fontsize',
    array( 'default' => '16',
    	'transport' => '',
    	'sanitize_callback' => 'check_number'
    ));

 $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h5_title_fontsize', array(
		 'label'   => __('Font size for heading - H5','lavan'),
		 'type' => 'select',
		'section' => 'font-size-section',
		'settings'    => 'h5_title_fontsize',
		'priority'    => 9,
		'choices'  => array(
			'min'  => 10,
			'max'  => 80,
			'step' => 1
		),
		)));
 $wp_customize->add_setting('h6_title_fontsize',
    array( 'default' => '14',
    	'transport' => '',
    	'sanitize_callback' => 'check_number'
    ));

 $wp_customize->add_control( new Kaya_Customize_Sliderui_Control( $wp_customize, 'h6_title_fontsize', array(
		 'label'   => __('Font size for heading - H6','lavan'),
		 'type' => 'select',
		'section' => 'font-size-section',
		'settings'    => 'h6_title_fontsize',
		'priority'    => 10,
		'choices'  => array(
			'min'  => 10,
			'max'  => 80,
			'step' => 1
		),
		)));
//end font section
}
add_action( 'customize_register', 'font_sizes' );
//end typography 

// Global Section
function global_section( $wp_customize ) {
	$wp_customize->add_panel( 'global_section_panel', array(
      'priority'       => 8,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Global Settings', 'lavan' ),
      'description'    => '',
  ) );
		$wp_customize->add_section(
	// ID
	'global-section',
	// Arguments array
	array(
		'title' => __( 'General Settings', 'lavan' ),
		'priority'       => 1,
		'capability' => 'edit_theme_options',
		'panel'     => 'global_section_panel'
 		//'description' => __( '', 'lavan' )
	));
	$wp_customize->add_setting('favicon[favi_img]',array(
    	'default' => '',
    	 'capability'   => 'edit_theme_options',
        'type'       => 'option',
    	));
    $wp_customize->add_control(
    	new WP_Customize_Image_Control($wp_customize,'favicon',array(
    		'label' => __('Upload Favicon Image','lavan'),
    		//'default' =>  
    		'section' => 'global-section',
    		'settings' => 'favicon[favi_img]',
    		'priority' => 2,
    	 	)));
    $wp_customize->add_setting('google_tracking_code', 
    array(
        'default' => '',
    ));
$wp_customize->add_control(
    'google_tracking_code',
    array(
        'label' => __('Google Analytics Code', 'lavan' ),
        'section' => 'global-section',
        'type' => 'text',
        'priority' => 3,    
    ));
   	  $wp_customize->add_setting( 'google_tracking_code_link' );
    $wp_customize->add_control(
    new Kaya_Customize_Description_Control( 
      $wp_customize, 'google_tracking_code_link', array(
   		'html_tags' => true,       	
      'label'    =>  __( '<span class="customizer_note">Ex:</span> ', 'lavan' ) .' UA-XXXXX-X'.  '<a target="_blank" href="https://support.google.com/analytics/answer/1032385?hl=en">  CLICK HERE</a>',
      'section'  => 'global-section',
      'settings' => 'google_tracking_code_link',
      'priority' => 4
    ))
  );

  $wp_customize->add_setting( 'kaya_custom_css' );
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'kaya_custom_css', array(
      'label'    => __( 'Custom CSS', 'lavan' ),
      'section'  => 'global-section',
      'settings' => 'kaya_custom_css',
      'priority' => 5,
      'type' => 'text-area',
      ))  );

  $wp_customize->add_setting( 'kaya_custom_jquery' );
  $wp_customize->add_control(
    new Kaya_Customize_Textarea_Control( $wp_customize, 'kaya_custom_jquery', array(
      'label'    => __( 'Custom JQUERY', 'lavan' ),
      'section'  => 'global-section',
      'settings' => 'kaya_custom_jquery',
      'priority' =>6,
      'type' => 'text-area',
      ))  );
  $wp_customize->add_setting('jquery_sample_info',array(
  		'sanitize_callback' => 'text_filed_sanitize',
  	));
  $wp_customize->add_control(
  	new Kaya_Customize_Description_Control( $wp_customize, 'jquery_sample_info',array(
   		'html_tags' => true, 		
  		'label' => __( "<span class='customizer_note'>Ex: </span> alert('hai');", 'lavan' ),
  		'section' => 'global-section',
  		'settings' => 'jquery_sample_info',
  		'priority' => 7,

  		))
  	);
  $wp_customize->add_setting( 'disable_old_post_data' );
  $wp_customize->add_control( 'disable_old_post_data', array(
        'label'    => __( 'Disable Portfolio Old Data', 'lavan' ),
        'section'  => 'global-section',
        'settings' => 'disable_old_post_data',
        'type' => 'checkbox',
        'priority' => 7,
    ));

	}
add_action( 'customize_register', 'global_section' );

//accent colors
function skincolors( $wp_customize ) {
		$wp_customize->add_section(
	// ID
	'Custom_color_section',
	// Arguments array
	array(
		'title' => __( 'Accent Colors', 'lavan' ),
		'priority'       => 2,
		'capability' => 'edit_theme_options',
		'panel'     => 'global_section_panel',
		//'description' => __( '', 'lavan' )
	)
);
	$colors = array();
$colors[] = array(
	'slug'=>'accent_bg_color',
	'default' => '#DB0007',
	 'transport'   => 'refresh',
	 'priority'       => 0,
	'label' => __('Accent BG Color', 'lavan')
);

$colors[] = array(
	'slug'=>'accent_text_color',
	'default' => '#ffffff',
	 'transport'   => 'refresh',
	 'priority'       => 1,
	'label' => __('Text Color for Accent BG Color', 'lavan')
);
$wp_customize->add_setting( 'accent_color_note', array(
    	'sanitize_callback' => 'text_filed_sanitize',
    	) );
    $wp_customize->add_control( new Kaya_Customize_Description_Control( $wp_customize, 'accent_color_note', array(
   		'html_tags' => true,   	
	      'label'    => __( '<span class="customizer_note">Note: </span> Color applies for highlighted title colors, blog and portfolio and blog next / preview button bg colors, custom_title i, related post background color, readmore button background color and etc.', 'lavan' ),
	      'section'  => 'Custom_color_section',
	      'settings' => 'accent_color_note',
	      'priority' => 2
    	))
  	);	
foreach( $colors as $color ) {
	// SETTINGS
	$wp_customize->add_setting(
		$color['slug'], array(
			'default' => $color['default'],
			'type' => 'option', 
			'capability' => 
			'edit_theme_options'
		)
	);
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'], 
			array('label' => $color['label'], 
			'section' => 'Custom_color_section',
			'settings' => $color['slug'])
		)
	);
}
	
}
add_action( 'customize_register', 'skincolors' );
// End accent color settings


// Woo Commerce Page
/*-----------------------------------------------------------------------------------*/ 
function woocommerce_page_section( $wp_customize ){
      $wp_customize->add_panel( 'woocommerce_page_section_panel', array(
      'priority'       => 160,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Woocommerce Page Section', 'lavan' ),
      'description'    => '',
  ) );
	// Blog Page Categories
	$wp_customize->add_section(
		'woocommerce_page_section',
		array(
			'title' => __('Woocommerce Page Section','lavan'),
			'priority' => 0,
			'panel'   => 'woocommerce_page_section_panel',
		));
	$wp_customize->add_setting('shop_page_sidebar', array(
			'default' => 'fullwidth'
		));
	$wp_customize->add_control('shop_page_sidebar',array(
		'label' => __('Shop Page Sidebar','lavan'),
		'type' => 'radio',
		'section' => 'woocommerce_page_section',
		'choices' => array(
			'fullwidth' => __('No Sidebar','lavan'),
			'two_third' => __('Right','lavan'),
			'two_third_last' => __('Left','lavan')
			),
		'priority' => 1
	));
		$wp_customize->add_setting('product_tag_page_sidebar', array(
			'default' => 'fullwidth'
		));
	$wp_customize->add_control('product_tag_page_sidebar',array(
		'label' => __('Product Categories / Tags  Page Sidebar','lavan'),
		'type' => 'radio',
		'section' => 'woocommerce_page_section',
		'choices' => array(
			'fullwidth' => __('No Sidebar','lavan'),
			'two_third' => __('Right','lavan'),
			'two_third_last' => __('Left','lavan')
			),
		'priority' => 2
	));
	$wp_customize->add_setting('shop_single_page_sidebar', array(
			'default' => 'two_third'
		));
	$wp_customize->add_control('shop_single_page_sidebar',array(
		'label' => __('Shop Single Page Sidebar','lavan'),
		'type' => 'radio',
		'section' => 'woocommerce_page_section',
		'choices' => array(
			'fullwidth' => __('No Sidebar','lavan'),
			'two_third' => __('Right','lavan'),
			'two_third_last' => __('Left','lavan')
			),
		'priority' => 3
	));
}
add_action( 'customize_register', 'woocommerce_page_section' );
//end woocommerce

  /* Buttons Colors */
function primary_button_section( $wp_customize ){
      $wp_customize->add_section(
  // ID
  'primary-button-section',
    array(
    'title' => __( 'Primary Buttons Color Section', 'lavan' ),
    'priority'       => 1,
    'capability' => 'edit_theme_options',
    'panel' => 'woocommerce_page_section_panel',
    //'description' => __( '', 'lavan' )
  )
); 

$wp_customize->add_setting( 'woo-buttons-note_description' );
$wp_customize->add_control(
new Kaya_Customize_Description_Control( 
  $wp_customize, 'woo-buttons-note_description', array(
    'html_tags' => true,
  'label'    => __( '<span class="customizer_note">Note: </span> Color applies for Add to cart, Update Cart , mini cart items and  Apply Coupon buttons', 'lavan' ),
  'section'  => 'primary-button-section',
  'settings' => 'pf_category_menu_note',
  'priority' => 3,
)));
 $color = array();   
$colors[] = array(
  'slug'=>'primary_buttons_bg_color',
  'default' => '#434a54',
   'transport'   => 'refresh',
   'priority' => 4,
  'label' => __('Primary  Buttons BG Color', 'lavan')
);
$colors[] = array(
  'slug'=>'primary_buttons_text_color',
  'default' => '#ffffff',
   'transport'   => 'refresh',
  'label' => __('Primary  Buttons Text Color', 'lavan'),
  'priority' => 5,
);
$colors[] = array(
  'slug'=>'primary_buttons_bg_hover_color',
  'default' => '#db0007',
   'transport'   => 'refresh',
   'priority' => 6,
  'label' => __('Primary  Buttons BG Hover Color', 'lavan')
);
$colors[] = array(
  'slug'=>'primary_buttons_text_hover_color',
  'default' => '#ffffff',
   'transport'   => 'refresh',
   'priority' => 7,
  'label' => __('Primary  Buttons Text Hover Color', 'lavan')
);
foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option', 
      'capability' => 
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'], 
      array('label' => $color['label'], 
      'section' => 'primary-button-section',
      'priority' => $color['priority'],
      'settings' => $color['slug'])
    )
  );
}
}
add_action('customize_register','primary_button_section');
//end primary buttons

// Secondary Buttons */
function secondary_button_section( $wp_customize ){
      $wp_customize->add_section(
  // ID
  'secondary-button-section',
    array(
    'title' => __( 'Secondary Buttons Color Section', 'lavan' ),
    'priority'       => 2,
    'capability' => 'edit_theme_options',
    'panel' => 'woocommerce_page_section_panel',
    //'description' => __( '', 'lavan' )
  )
);
$wp_customize->add_setting( 'woo-secondary-buttons-note_description' );
$wp_customize->add_control(
new Kaya_Customize_Description_Control( 
  $wp_customize, 'woo-secondary-buttons-note_description', array(
       'html_tags' => true,
  'label'    => __( '<span class="customizer_note">Note: </span> Color applies for Tabs active color, tab hover color, quantity(plus, minus), view Cart, proceed to checkout and place order buttons', 'lavan' ),
  'section'  => 'secondary-button-section',
  'settings' => 'pf_category_menu_note',
  'priority' => 0,
)));
 $color = array();   
$colors[] = array(
  'slug'=>'secondary_buttons_bg_color',
  'default' => '#db0007',
   'transport'   => 'refresh',
   'priority' => 10,
  'label' => __('Secondary Buttons BG Color', 'lavan')
);
$colors[] = array(
  'slug'=>'secondary_buttons_text_color',
  'default' => '#ffffff',
   'transport'   => 'refresh',
  'label' => __('Secondary Buttons Text Color', 'lavan'),
  'priority' => 11
);
$colors[] = array(
  'slug'=>'secondary_buttons_bg_hover_color',
  'default' => '#434a54',
   'transport'   => 'refresh',
   'priority' => 12,
  'label' => __('Secondary Buttons BG Hover Color', 'lavan')
);
$colors[] = array(
  'slug'=>'secondary_buttons_text_hover_color',
  'default' => '#ffffff',
   'transport'   => 'refresh',
   'priority' => 13,
  'label' => __('Secondary Buttons Text Hover Color', 'lavan')
);
// Price tag Hover Color 
  $colors[] = array(
  'slug'=>'woo_elments_colors',
  'default' => '#db0007',
   'transport'   => 'refresh',
   'priority' => 14,
  'label' => __('Elements color', 'lavan')
);
    foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option', 
      'capability' => 
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'], 
      array('label' => $color['label'], 
      'section' => 'secondary-button-section',
      'priority' => $color['priority'],
      'settings' => $color['slug'])
    )
  );
}
}
add_action('customize_register','secondary_button_section');
//end secondary buttons

// Alert Boxes */
function alert_boxes_section( $wp_customize ){
      $wp_customize->add_section(
  // ID
  'alert-boxes-section',
    array(
    'title' => __( 'Alert Boxes Section', 'lavan' ),
    'priority'       => 3,
    'capability' => 'edit_theme_options',
    'panel' => 'woocommerce_page_section_panel',
    //'description' => __( '', 'lavan' )
  )
);

$colors[] = array(
  'slug'=>'success_msg_bg_color',
  'default' => '#dff0d8',
   'transport'   => 'refresh',
   'priority' => 17,
  'label' => __('Success Alert Box BG Color', 'lavan')
);
$colors[] = array(
  'slug'=>'success_msg_text_color',
  'default' => '#468847',
   'transport'   => 'refresh',
   'priority' => 18,
  'label' => __('Success Alert Box Text Color', 'lavan')
);

$colors[] = array(
  'slug'=>'notification_msg_bg_color',
  'default' => '#b8deff',
   'transport'   => 'refresh',
   'priority' => 19,
  'label' => __('Notification Alert Box BG Color', 'lavan')
);
$colors[] = array(
  'slug'=>'notification_msg_text_color',
  'default' => '#333',
   'transport'   => 'refresh',
   'priority' => 20,
  'label' => __('Notification Alert Box Text Color', 'lavan')
);

$colors[] = array(
  'slug'=>'warning_msg_bg_color',
  'default' => '#f2dede',
   'transport'   => 'refresh',
   'priority' => 21,
  'label' => __('Warning Alert Box BG Color', 'lavan')
); 
$colors[] = array(
  'slug'=>'warning_msg_text_color',
  'default' => '#a94442',
   'transport'   => 'refresh',
   'priority' => 22,
  'label' => __('Warning Alert Box Text Color', 'lavan')
);  
foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option', 
      'capability' => 
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'], 
      array('label' => $color['label'], 
      'section' => 'alert-boxes-section',
      'priority' => $color['priority'],
      'settings' => $color['slug'])
    )
  );
}
}
add_action('customize_register','alert_boxes_section');
//end woocommerce
	?>