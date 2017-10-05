<?php require_once( '../../../../../wp-load.php' );

Header("Content-type: text/css");
 $kaya_options = get_option('kayapati');
// Default Body Image ?>
<?php if($kaya_options['boxed_layout']!='') {  ?>
	body{
	background-attachment: fixed;
    background-image: url("../../images/boxed_layout_bg.png");
    background-position: center top;
    background-repeat: repeat;
	}
<?php } ?>

<?php // Side toggle color settings 
$kaya_sidebar_toggle_bg_color=$kaya_options['kaya_sidebar_toggle_bg_color']?$kaya_options['kaya_sidebar_toggle_bg_color']:"#333";
$kaya_sidebar_toggle_title_color=$kaya_options['kaya_sidebar_toggle_title_color']?$kaya_options['kaya_sidebar_toggle_title_color']:"#fff";
$kaya_sidebar_toggle_text_color=$kaya_options['kaya_sidebar_toggle_text_color']?$kaya_options['kaya_sidebar_toggle_text_color']:"#fff";
$kaya_sidebar_toggle_link_color=$kaya_options['kaya_sidebar_toggle_link_color']?$kaya_options['kaya_sidebar_toggle_link_color']:"#fff";
$kaya_sidebar_toggle_linkhover_color=$kaya_options['kaya_sidebar_toggle_linkhover_color']?$kaya_options['kaya_sidebar_toggle_linkhover_color']:"#fff";
?>
.cbp-spmenu h1, .cbp-spmenu h2, .cbp-spmenu h3,.cbp-spmenu h4, .cbp-spmenu h5, .cbp-spmenu h6 { 
	color:<?php echo $kaya_sidebar_toggle_title_color; ?>!important;
}
.cbp-spmenu p, .cbp-spmenu, ul.slide-panel-list li { 
	color:<?php echo $kaya_sidebar_toggle_text_color; ?>!important; 
}
.cbp-spmenu a { 
	color:<?php echo $kaya_sidebar_toggle_link_color; ?>!important; 
}
.cbp-spmenu a:hover { 
	color:<?php echo $kaya_sidebar_toggle_linkhover_color; ?>!important; 
}
.cbp-spmenu{
	background:<?php echo $kaya_sidebar_toggle_bg_color; ?>!important; 
}