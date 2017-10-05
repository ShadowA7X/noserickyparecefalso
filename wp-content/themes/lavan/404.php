<?php get_header();  ?>
	<!--  <div class="sub_header_wrapper"> Sub Header Section
		<div class="sub_header container">
			<h2> <?php //_e( 'Error 404 - Not Found', 'lavan' ); ?> </h2>
		</div>
	</div>End Sub Header Section -->
<!--Start Middle Section  -->
	<section id="mid_container_wrapper">
		<section id="mid_container" class="container"> 
	        <!-- End Page Titles -->
			<div class="one_half">
				<?php _e( ' <h3>Archives by Subject:</h3>', 'lavan' ); ?>
				<ol>
					<?php wp_list_categories('&title_li='); ?>
				</ol>
			</div>
			<div class="one_half_last">
				<?php _e( ' <h3>Archives by Month::</h3>', 'lavan' ); ?>
				<ol>
					<?php wp_get_archives('type=monthly'); 
					next_posts_link() 
					?>
				</ol>
			</div>
    <!-- Footer  -->
<?php get_footer(); ?>