<?php

  // Pannel Settings
     function kaya_row_container1($styles) {
	$styles['container1'] = __('Conatiner row Style-1', 'vantage');
	return $styles;
}
add_filter('siteorigin_panels_row_styles', 'kaya_row_container1');

function kaya_row_container2($styles) {
	$styles['container2'] = __('Conatiner row Style-2', 'vantage');
	return $styles;
}
add_filter('siteorigin_panels_row_styles', 'kaya_row_container2');
function kaya_row_container3($styles) {
	$styles['container3'] = __('Conatiner row Style-3', 'vantage');
	return $styles;
}
add_filter('siteorigin_panels_row_styles', 'kaya_row_container3');
function kaya_row_container4($styles) {
	$styles['container4'] = __('Conatiner row Style-4', 'vantage');
	return $styles;
}
add_filter('siteorigin_panels_row_styles', 'kaya_row_container4');
function kaya_row_container5($styles) {
	$styles['container5'] = __('Conatiner row Style-5', 'vantage');
	return $styles;
}
add_filter('siteorigin_panels_row_styles', 'kaya_row_container5');?>