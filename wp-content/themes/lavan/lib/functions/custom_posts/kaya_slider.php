<?php
if(!function_exists('kaya_home_slider')){
	function kaya_home_slider() {

		$labels = array(
		'name'				=> __('Kaya Slider','lavan'),
		'singular_name'		=> __('Kaya Slider','lavan'),
		'add_new'			=> __('Add New Post', 'lavan'),
		'add_new_item'		=> __('Add New Post','lavan'),
		'edit_item'			=> __('Edit Post','lavan'),
		'new_item'			=> __('New Slider Post Item','lavan'),
		'view_item'			=> __('View slider Item','lavan'),
		'search_items'		=> __('Search Slider Items','lavan'),
		'not_found'			=> __('Nothing found','lavan'),
		'not_found_in_trash'=> __('Nothing found in Trash','lavan'),
		'parent_item_colon'	=> ''
	);
	

$args = array(
		'labels'			=> $labels,
		'public'			=> true,
		'exclude_from_search'=> false,
		'show_ui'			=> true,
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'rewrite'			=> array( 'with_front' => false ),
		'query_var'			=> false,	
	'menu_icon' => get_stylesheet_directory_uri() . '/lib/images/kaya_slider.png',		
		'supports'			=> array('title', '', '', 'thumbnail', '', 'page-attributes')
	); 
	register_post_type( 'slider' , $args );
	register_taxonomy_for_object_type('post_tag', 'slider');
}
register_taxonomy("slider_category", 'slider', array(
	'hierarchical'		=> true,
	'label'				=> 'Slider Categories',
	'singular_label'	=> 'Slider Categories',
	'show_ui'			=> true,
	'query_var'			=> true,
	'rewrite'			=> false,
	)
);

add_action('init', 'kaya_home_slider');
/*  
function my_taxonomies_slider() {
  $labels = array(
    'name'              => __( 'Slider Categories', 'lavan' ),
    'singular_name'     => __( 'Slider Categories', 'lavan' ),
    'search_items'      => __( 'Search Slider Categories' , 'lavan' ),
    'all_items'         => __( 'All Slider Categories' , 'lavan' ),
    'parent_item'       => __( 'Parent Slider Category' , 'lavan' ),
    'parent_item_colon' => __( 'Parent Slider Category:', 'lavan' ),
    'edit_item'         => __( 'Edit Slider Category', 'lavan' ),
    'update_item'       => __( 'Update Slider Category' , 'lavan' ),
    'add_new_item'      => __( 'Add New Slider Category' , 'lavan' ),
    'new_item_name'     => __( 'New Slider Category' , 'lavan' ),
    'menu_name'         => __( 'Slider Categories' , 'lavan' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'slider_category', 'slider', $args );
}
add_action( 'init', 'my_taxonomies_slider', 0 );
    */
function slider_columns($columns) {
	$columns['slider_category'] = __('Category','atp_admin');
    $columns['thumbnail'] =  __('Post Image','atp_admin');

    return $columns;
}

function kaya_manage_slider_columns($name) {
    global $post;global $wp_query;
    switch ($name) {
	 case 'slider_category':
               $terms = get_the_terms($post->ID, 'slider_category');

        //If the terms array contains items... (dupe of core)
        if ( !empty($terms) ) {
            //Loop through terms
            foreach ( $terms as $term ){
                //Add tax name & link to an array
                $post_terms[] = esc_html(sanitize_term_field('name', $term->name, $term->term_id, '', 'edit'));
            }
            //Spit out the array as CSV
            echo implode( ', ', $post_terms );
        } else {
            //Text to show if no terms attached for post & tax
            echo '<em>No terms</em>';
        }
				break;
        case 'thumbnail':
   				//echo the_post_thumbnail(array(100,100));
				break;
       
    }
}
add_action('manage_posts_custom_column', 'kaya_manage_slider_columns', 10, 2);
add_filter('manage_edit-slider_columns', 'slider_columns');
function slide_title_text( $slide_title ){
$screen = get_current_screen();
if ( 'slider' == $screen->post_type ) {
$slide_title = 'Enter slide title here';
}
return $slide_title;
}
add_filter( 'enter_title_here', 'slide_title_text' );
/* Slide Featured image */
add_action('do_meta_boxes', 'kaya_slider_post_thumbnail');  
function kaya_slider_post_thumbnail()  
{  
    remove_meta_box( 'postimagediv', 'slider', 'normal' );  
    add_meta_box('postimagediv', __('Add Slide Image - Size 1920x1080 (px) ','lavan'), 'post_thumbnail_meta_box', 'slider', 'normal', 'low');  
} 
}
?>
