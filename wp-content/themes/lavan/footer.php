</section> <!-- end middle content section -->
</section> <!-- end middle Container wrapper section -->
	<div class="clear"> </div>
	<!-- end middle section -->
	<?php  get_template_part('lib/includes/footer_general'); // General Footer ?>
	<div class="clear"></div> 
	<!--  Scrollto Top  -->
	<a href="#" class="scroll_top "><i class = "fa fa-arrow-up"> </i></a>
	<!--  Google Analytic  -->
	<?php  
	$kaya_google_analytics=get_theme_mod('google_tracking_code');
		if ($kaya_google_analytics) { 	
			echo stripslashes($kaya_google_analytics); 					
		} else { ?>
	<?php } ?>
	<!--  end Google Analytics  -->
	</section> <!-- Main Layout Section End -->
	<?php wp_footer(); ?>
</body>
</html>