<?php
			$options = get_option('kayapati');
//echo $options['multi_text'];
// custom sidebar widgets create funtions
if ( function_exists('register_sidebar') )
{	
	$dynamic_widgets =isset( $options['custom_sidebar'] ) ? $options['custom_sidebar'] :'';
	// print_r($sidebar_widgets);
	  if(is_array($dynamic_widgets)){
		  if($dynamic_widgets) {
				foreach ($dynamic_widgets as $page_name)
		{	 
				if($page_name != "") {
				register_sidebar(array(
				'name' =>$page_name,
				'id'            => 'sidebar-'.strtolower(preg_replace('/\s+/', '-', $page_name)),
				'description' => esc_html('A widget area used as sidebar for "'.$page_name.'" Section'),		

			'before_widget' => '<div id="%1$s" class="widget_container %2$s">',
			'after_widget' => '</div>',		
			'before_title' => '<span class="widget_title"><h3>',
			'after_title' => '</h3><i class="fa fa-plus" style="float: right; color: rgb(255, 0, 0); font-size: 8px; margin-top: -20px;"></i></span>',
		
				));
		} }
	}
	}
}

// Home Sidebar
if ( function_exists('register_sidebar') )
		register_sidebar(
		array(
			'name'=>'Sidebar',
			'id'            => 'sidebar-1',
			'description' => esc_html__('A widget area, used as a sidebar for Homepage', 'lavan'),			
				'before_widget' => '<div id="%1$s" class="widget_container %2$s">',
			'after_widget' => '</div>',		
			'before_title' => '<span class="widget_title"><h3>',
			'after_title' => '</h3><i class="fa fa-plus" style="float: right; color: rgb(255, 0, 0); font-size: 8px; margin-top: -20px;"></i></span>',
		));
		
// Home Sidebar
		
// Bottom Footer Section 1st Widget Area
if ( function_exists('register_sidebar') )
	register_sidebar(
	array(
		'name'=>'Footer Column 1',
		'id'            => 'footer_column_1',
		'description' => esc_html__('A widget area, used as the 1st column in the Footer Section.', 'lavan'),
		'before_widget' => '<div id="%1$s" class="widget_container %2$s">',
		'after_widget' => '</div> ',
		'before_title' => '<span class="widget_title"><h3>',
			'after_title' => '</h3><i class="fa fa-plus" style="float: right; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i></span>',
	));
	
// Bottom Footer Section 2nd Widget Area
if ( function_exists('register_sidebar') )
		register_sidebar(
		array(
			'name'=>'Footer Column 2',
			'id'            => 'footer_column_2',
			'description' => esc_html__('A widget area, used as the 2nd column in the Footer Section.', 'lavan'),
			'before_widget' => '<div id="%1$s" class="widget_container %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<span class="widget_title"><h3>',
			'after_title' => '</h3><i class="fa fa-plus" style="float: right; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i></span>',
		));
		
// Bottom Footer Section 3rd Widget Area
	if ( function_exists('register_sidebar') )
		register_sidebar(
		array(
			'name'=>'Footer Column 3',
			'id'            => 'footer_column_3',
			'description' => esc_html__('A widget area, used as the 3rd column in the Footer Section.', 'lavan'),
			'before_widget' => '<div id="%1$s" class="widget_container %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<span class="widget_title"><h3>',
			'after_title' => '</h3><i class="fa fa-plus" style="float: right; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i></span>',
		));
		
// Bottom Footer Section 4th Widget Area
if ( function_exists('register_sidebar') )
		register_sidebar(
		array(
			'name'=>'Footer Column 4',
			'id'            => 'footer_column_4',
			'description' => esc_html__('A widget area, used as the Fourth column in the Footer Section.', 'lavan'),
			'before_widget' => '<div id="%1$s" class="widget_container %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<span class="widget_title"><h3>',
			'after_title' => '</h3><i class="fa fa-plus" style="float: right; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i></span>',
		));

// Bottom Footer Section 5th Widget Area
	if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Footer Column 5',
		'id'            => 'footer_column_5',
		'description' => esc_html__('A widget area, used as the Fifth column in the Footer Section.', 'lavan'),
		'before_widget' => '<div id="%1$s" class="widget_container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<span class="widget_title"><h3>',
			'after_title' => '</h3><i class="fa fa-plus" style="float: right; color: rgb(255, 0, 0); font-size: 8px; margin-top: -5px;"></i></span>',
		));
		
?>