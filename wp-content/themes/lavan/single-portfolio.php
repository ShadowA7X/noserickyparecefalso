<?php
get_header();
$kaya_options = get_option('kayapati');
$sidebar_layout=get_post_meta(get_the_id(),'kaya_pagesidebar',true);
$sidebar_layout=get_post_meta(get_the_id(),'kaya_pagesidebar',true); 
$relatedpost=get_post_meta(get_the_ID(),'relatedpost' ,true);
$disable_old_post_data=get_theme_mod('disable_old_post_data') ? get_theme_mod('disable_old_post_data') : '0';
$portfolio_project_skills_title=get_post_meta(get_the_ID(),'portfolio_project_skills_title' ,true);
switch( $sidebar_layout ){
	case 'leftsidebar':
		$sidebar_class="two_third_last";
		break;
	case 'rightsidebar':
		$sidebar_class="two_third";
		break;	
	case 'full':
		$sidebar_class="fullwidth";
		break;		
}
$aside_class=($sidebar_layout== "leftsidebar" ) ?  'one_third' : 'one_third_last';
$portfolio_skills_title= isset( $kaya_options['portfolio_skills_title'] ) ?  $kaya_options['portfolio_skills_title'] : ''; ?>
<!-- Start Middle Section  -->
<section id="mid_container_wrapper">
	<section id="mid_container" class="container"> 
	<?php
if( $disable_old_post_data == '0' )
{ // Portfolio old Data
	include 'portfolio_old_data.php';
}
else
{ ?>
	<div class="<?php echo $sidebar_class;?> portfolio_aside">
		
<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post();
	the_content();
	endwhile;
	endif;
	echo '</div>';
		/* Sidebar */
	if( $sidebar_layout != 'full' )
	{ ?>
		<aside class="<?php echo $aside_class;?> portfolio_aside">
		<?php	
		get_sidebar();
		echo '</aside>';
	}
}
?>
	<div class="clear"> </div>
	<?php	wp_reset_query();
	if($relatedpost=='1') {
		kaya_relatedpost($post->ID); 
	}
	$comment_status = get_post_meta($post->ID,'comment_status', false);
	if( $comment_status != "1") {
		comments_template( '', true );
	} 
		?>
			<!--End content Section -->
	<div class="clear"></div>
	<?php get_footer(); ?>