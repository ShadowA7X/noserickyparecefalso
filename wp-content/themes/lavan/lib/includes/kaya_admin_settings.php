<?php
/**
 * Custom admin login header link
 */
add_action('wp_logout','kaya_admin_logout_redirect_url');
function kaya_admin_logout_redirect_url(){
  wp_redirect( home_url() );
  exit();
}
if ( is_super_admin() ) { }else{
if( !function_exists('kaya_user_login_failed') ){
    add_action( 'wp_login_failed', 'kaya_user_login_failed' ); // hook failed login
    function kaya_user_login_failed( $user ) {
            // check what page the login attempt is coming from
        $referrer = $_SERVER['HTTP_REFERER'];
            // check that were not on the default login page
        if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') && $user!=null ) {
            // make sure we don’t already have a failed login attempt
        if ( !strstr($referrer, '?login=failed' )) {
            // Redirect to the login page and append a querystring of login failed
        wp_redirect( $referrer . '?login=failed');
        }else {
            wp_redirect( $referrer );
        }
        exit;
        }
    }
}    
//Add New Fields To User Registration Form
if( !function_exists('kaya_admin_user_register_form') ){
    add_action( 'register_form', 'kaya_admin_user_register_form' );
    function kaya_admin_user_register_form() {
        $first_name = ( ! empty( $_POST['first_name'] ) ) ? trim( $_POST['first_name'] ) : ''; 
        $kaya_phone_num = ( ! empty( $_POST['kaya_phone_num'] ) ) ? trim( $_POST['kaya_phone_num'] ) : '';  ?>
            <p>
                <label for="first_name"><?php _e( 'First Name', 'julia') ?><br />
                <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr( wp_unslash( $first_name ) ); ?>" size="25" /></label>
            </p>
            <p>
                <label for="kaya_phone_num"><?php _e( 'Phone Number', 'julia') ?><br />
                <input type="text" name="kaya_phone_num" id="kaya_phone_num" class="input" value="<?php echo esc_attr( wp_unslash( $kaya_phone_num ) ); ?>" size="25" /></label>
            </p>
            <?php
    }
}
if( !function_exists('kaya_user_registration_form_errors') ){
    add_filter( 'registration_errors', 'kaya_user_registration_form_errors', 10, 3 );
    function kaya_user_registration_form_errors( $errors, $sanitized_user_login, $user_email ) {        
            if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
                $errors->add( 'first_name_error', __( '<strong>ERROR</strong>: You must include a first name.', 'julia') );
            }
            if ( empty( $_POST['kaya_phone_num'] ) || ! empty( $_POST['kaya_phone_num'] ) && trim( $_POST['kaya_phone_num'] ) == '' ) {
                $errors->add( 'kaya_phone_num_error', __( '<strong>ERROR</strong>: You must include your Phone number.', 'julia') );
            }
            return $errors;
    }
}
if( !function_exists('kaya_update_user_register_fields') ){
    add_action( 'user_register', 'kaya_update_user_register_fields' );
    function kaya_update_user_register_fields( $user_id ) {
        if ( ! empty( $_POST['first_name'] ) ) {
            update_user_meta( $user_id, 'first_name', trim( $_POST['first_name'] ) );
        }
        if ( ! empty( $_POST['kaya_phone_num'] ) ) {
            update_user_meta( $user_id, 'kaya_phone_num', trim( $_POST['kaya_phone_num'] ) );
        }
    }
}
// Adding User Role
if( !function_exists('kaya_add_user_role') ){
    function kaya_add_user_role(){
        add_role('user', 'User', array(
        'read' => true, // True allows that capability, False specifically removes it.
        'edit_posts' => true,
        'delete_posts' => false,
        'edit_published_posts' => true,
        'upload_files' => true //last in array needs no comma!
    ));
    }
    kaya_add_user_role(); // Creation New User Role
}

//User Restriction
if( !function_exists('kaya_restrict_user') ){
    function kaya_restrict_user() {
        if( current_user_can( 'user' ) ):
            remove_menu_page( 'edit.php?post_type=team' );
            remove_menu_page( 'edit.php?post_type=slider' );    
            remove_menu_page( 'edit.php?post_type=testimonial' );
             remove_menu_page( 'edit.php?post_type=tabs' );
            remove_menu_page( 'index.php' );                  //Dashboard
            remove_menu_page( 'edit.php' );                   //Posts
            remove_menu_page( 'upload.php' );                 //Media
            remove_menu_page( 'edit.php?post_type=page' );    //Pages
            remove_menu_page( 'edit-comments.php' );          //Comments
            remove_menu_page( 'themes.php' );                 //Appearance
            remove_menu_page( 'plugins.php' );                //Plugins
            remove_menu_page( 'users.php' );                  //Users
            remove_menu_page( 'tools.php' );                  //Tools
            remove_menu_page( 'options-general.php' );        //Settings  
        endif;
    }
    add_action( 'admin_menu', 'kaya_restrict_user' );
}
if( current_user_can( 'user' ) ){
    function remove_screen_options(){
        return false;
    }
    add_filter('screen_options_show_screen', 'remove_screen_options');
    //hide cpt top bar fields
    function kaya_hide_post_content(){
        echo '<style type="text/css">h1 a.page-title-action, .tablenav, .subsubsub, .search-box, #your-profile .form-table:first-child,  #wp-admin-bar-site-name-default > li#wp-admin-bar-view-store, li#wp-admin-bar-my-sites{ display:none!important; }</style>';
    }
    add_action('admin_head','kaya_hide_post_content');
    // HIde Personal Information
    function hide_personal_options() { ?>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery("#your-profile .form-table:first, #your-profile h3:first").remove();
            });
        </script>
    <?php }
    add_action( 'personal_options', 'hide_personal_options');
    // Admin Logout Url
    function get_current_logout( $logout_url ){
        if ( is_admin() ) {
            $logout_url = add_query_arg('redirect_to', home_url(), $logout_url);
        }
        return $logout_url;
    }
    add_filter('logout_url', 'get_current_logout');
    // Plugin Name: Remove Admin Help Tabs 
    add_filter( 'contextual_help', 'kaya_remove_help_tab', 999, 3 );
      function kaya_remove_help_tab($old_help, $screen_id, $screen){
        $screen->remove_help_tabs();
        return $old_help;
    }
}

function count_user_posts_by_status($post_status = 'publish',$user_id = 15){
   global $publish_post, $pending_post, $current_user_posts, $wpdb;
    $count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(ID) FROM $wpdb->posts WHERE post_status = %s AND post_author = %d", $post_status, $user_id ));
    return ($count) ? $count : 0;
}
$user_id = get_current_user_id();
/* Hide Admin bar */
function remove_admin_bar_links() {
    global $wp_admin_bar, $current_user;    
    if( current_user_can( 'user' ) ){
        $wp_admin_bar->remove_menu('wp-logo');  
        $wp_admin_bar->remove_menu('updates');
        $wp_admin_bar->remove_menu('comments'); 
        $wp_admin_bar->remove_menu('new-content');
        $wp_admin_bar->remove_menu('w3tc');       
    }
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
add_action('after_setup_theme', 'kaya_remove_admin_bar');
function kaya_remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
      show_admin_bar(false);
    }
}
/* Add User Extra fields */
$kaya_user_profile_fields =  array( 
    array( 'kaya_phone_num', __('Phone Number', 'julia'), false ),
    array( 'kaya_facebook', __('Facebook Username', 'julia'), false ),
    array( 'kaya_twitter', __('Twitter Username', 'julia'), false ),
    array( 'kaya_googleplus', __('Google+ ID', 'julia'), false ),
    array( 'kaya_linkedin', __('Linked In ID', 'julia'), false ),
    array( 'kaya_pinterest', __('Pinterest Username', 'julia'), false ),
);
add_filter( 'user_contactmethods', 'kaya_add_new_contact_info_fields' );
add_action( 'register_form', 'kaya_extra_form_fields' );
add_action( 'user_register', 'kaya_upadate_custom_fields', 100 );
function kaya_add_new_contact_info_fields( $user_contactmethods ) {
    global $kaya_user_profile_fields;    
    foreach( $kaya_user_profile_fields as $field ) {
        if ( !isset( $contactmethods[ $field[0] ] ) )
            $user_contactmethods[ $field[0] ] = $field[1];
    }
    // Returns the contact methods
    return $user_contactmethods;
}
/**
 * Show custom fields on registration page
 */
function kaya_extra_form_fields() {
        // Get fields
    global $kaya_user_profile_fields;
    foreach( $kaya_user_profile_fields as $field ) {
        if( $field[2] == true ) { 
        if( isset( $_POST[ $field[0] ] ) ) { $field_value = $_POST[ $field[0] ]; } else { $field_value = ''; }
        ?>
        <p>
            <label for="<?php echo $field[0]; ?>"><?php echo $field[1]; ?><br />
            <input type="text" name="<?php echo $field[0]; ?>" id="<?php echo $field[0]; ?>" class="input" value="<?php echo $field_value; ?>" size="20" /></label>
            </label>
        </p>
        <?php
        } // endif
    } // end foreach
}
function kaya_upadate_custom_fields( $user_id, $password = '', $meta = array() )  {
    // Get fields
    global $kaya_user_profile_fields;    
    $userdata    = array();
    $userdata['ID'] = $user_id;    
    // Save each field
    foreach( $kaya_user_profile_fields as $field ) {
        if( $field[2] == true ) { 
            $userdata[ $field[0] ] = $_POST[ $field[0] ];
        } // endif
    } // end foreach

    $new_user_id = wp_update_user( $userdata );
}
}
?>