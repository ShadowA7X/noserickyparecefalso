<?php
add_action('customize_register', 'globel_customize_register');
function globel_customize_register($wp_customize) {
    $wp_customize->remove_section( 'title_tagline' );
    $wp_customize->remove_section( 'nav' );
    $wp_customize->remove_section( 'static_front_page' );
	//$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'colors' );
	//$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'sidebar-widgets-footer_column_1' );
	$wp_customize->remove_section( 'sidebar-widgets-footer_column_2' );
	$wp_customize->remove_section( 'sidebar-widgets-footer_column_3' );
	$wp_customize->remove_section( 'sidebar-widgets-footer_column_4' );
	$wp_customize->remove_section( 'sidebar-widgets-footer_column_5' );
	$wp_customize->remove_section( 'sidebar-widgets-sidebar-1' );
	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_panel( 'widgets' );
	$wp_customize->get_section('background_image')->priority =2;
	$wp_customize->get_section('background_image')->title = __( 'Background Image', KAYA_THEME_NAME );
	$wp_customize->get_section('background_image')->panel = 'theme_layout_panel';
	}
// Sanitize Functions number validation	
function check_number( $input ) {
    $input = (int) $input; // Force the value into integer type.
    return ( 0 < $input ) ? $input : '0';
}
function opacity_number_validate( $input ){
		return $input;
}	
function text_filed_sanitize( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function color_filed_sanitize( $input ) {
    return $input;
}
function checkbox_field_sanitize( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return 0;
    }
}

function upload_sanitize_id( $input ) {
        return $input;
}

function radio_buttons_sanitize( $input, $setting ) {
    global $wp_customize;
     $control = $wp_customize->get_control( $setting->id );
     if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function kaya_customize_register( $wp_customize ){
// border customizer controll
class Kaya_Customize_Divider_Controll extends WP_Customize_Control{
	public $type = 'divider';
	public function render_content(){
		echo '<div class="customize_divider"> </div>';
	}
}
// Register Our Custom Controlls
class Kaya_Customize_Sliderui_Control extends WP_Customize_Control {
	public $type = 'slider';
	public function enqueue() {
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-slider' );
	wp_enqueue_style("jquery-ui");
	}
	public function render_content() { ?>
		<label>
			<span class="customize-control-title">	<?php echo esc_html( $this->label ); ?>	</span>
			<input type="text" class="kaya-slider" id="input_<?php echo $this->id; ?>" disabled value="<?php echo $this->value(); ?>" <?php $this->link(); ?>/>
		</label>
		<div id="slider_<?php echo $this->id; ?>" class="custom_slider"></div>
		<script>
			jQuery(document).ready(function($) {
				$( '[id="slider_<?php echo $this->id; ?>"]' ).slider({
					value : <?php echo $this->value() ?  $this->value() : '0'; ?>,
					min   : <?php echo $this->choices['min']; ?>,
					max   : <?php echo $this->choices['max']; ?>,
					step  : <?php echo $this->choices['step']; ?>,
					slide : function( event, ui ) { $( '[id="input_<?php echo $this->id; ?>"]' ).val(ui.value).keyup(); }
				});
				$( '[id="input_<?php echo $this->id; ?>"]' ).val( $( '[id="slider_<?php echo $this->id; ?>"]' ).slider( "value" ) );
			});
		</script>
	<?php
	}
}
class Kaya_Customize_Imageupload_Control extends WP_Customize_Control {
		public $type = 'customize_upload';
		public function render_content(){
			$image = '';
			$value = $this->value();
			
			if(!empty($value)) {
				if(ctype_digit($value) || is_int($value)) {
					$image = wp_get_attachment_image_src($value, "full");
					$image = $image[0];
				} else {
					$image = $this->value();
				}				
			}
			
	        ?>
	        <label>
	        	<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
	        	<div class="customize_img_upload">
					<div class="customizer_media_image">
						<img src="<?php echo $image ?>">
					</div>
					<input type="hidden">
					<div class="buttons">
						<a href="#" class='upload_media_image button'><?php _e('Upload Image',KAYA_THEME_NAME) ?></a>
						<a href="#" class='remove_media_image button'><?php _e('Remove',KAYA_THEME_NAME) ?></a>
					</div> 
				</div>
	        </label>	        
	        <?php
	    }
	}
class Kaya_Customize_Subtitle_control extends WP_Customize_control{
	public $type = 'sub-title';
	public function render_content(){
		echo '<h4 class="customizer_sub_section">'.esc_html($this->label).'</h4>';
	}
}
class Kaya_Customize_Textarea_Control extends WP_Customize_control{
	public $type = 'text-area';
	public function render_content(){ ?>
		<label class="customize-control-title"> <?php echo esc_html( $this->label ); ?></label>
		<textarea rows="6" width="100%" <?php $this->link(); ?> ><?php echo esc_textarea( $this->value() ); ?></textarea>
	<?php }
}
class Kaya_Customize_Description_Control extends WP_Customize_Control{
	public $type = 'description';
	public function render_content(){
		echo '<span class="title_description">'.esc_html( $this->label ).'</span>';
	}
}

class Kaya_Customize_Multiselect_Control extends WP_Customize_Control
{
public $type = 'multi-select';
public function render_content()
{ ?>
	<label class="customize-control-title"><?php echo esc_html($this->label); ?></label>
	<select <?php $this->link(); ?> multiple="multiple" style="">
		<?php 

			foreach ( $this->choices as $value => $label ) {
				$selected = ( in_array($value, $this->value()) ) ? selected(1,1,false) : '';
				echo '<option value="'.esc_attr( $value ).'" '.$selected.'>'.$label.'</option>';	
			}

		?>
	</select>	
<?php }
}
class Kaya_Customize_Images_Radio_Control extends WP_Customize_Control {
	public $type = 'img_radio';
	public function render_content() {
		if ( empty( $this->choices ) )
		return;
		$name = 'customize-image-radios-' . $this->id;	 ?>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php foreach ( $this->choices as $value => $label ) { ?>
			<?php $selected = ( $this->value() == $value ) ? 'kaya-radio-img-selected' : ''; ?>
			<label for="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>" class="kaya-radio-img <?php echo $selected; ?>">
				<input id="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>" class="img_radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
				<img src="<?php echo $label['img_src']; ?>" alt="<?php echo $label['label']; ?>" title="<?php echo $label['label']; ?>" />
			</label>
			<?php
		} // end foreach
	}	
}
/**
* Pages Controll  
*/
class Kaya_Customize_Page_Control extends WP_Customize_Control
{
	private $pages = false;
	public $type = 'page';
    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->pages = get_pages($options);
        parent::__construct( $manager, $id, $args );
    }
	public function render_content()
    {
        if(!empty($this->pages))
        {
            ?>
                <label class="customize-control-title"><?php echo esc_html( $this->label ); ?></label>
                    <select <?php $this->link(); ?> name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
                    <option value=""><?php _e('Select Page Footer',KAYA_THEME_NAME) ?></option>
                    <?php
                        foreach ( $this->pages as $page )
                        {
                            echo '<option value='.$page->ID.'>'.$page->post_title.'</option>';
                        }
                    ?>
                    </select>                
            <?php
        }
    }
}
// Google Fonts Seclect
class Kaya_Customize_google_fonts_Control extends WP_Customize_Control
{
	public $type = 'googlefonts';
	public function render_content(){ ?>
		<label class="customize-control-title"><?php echo esc_html($this->label); ?></label>
		<?php $list_fonts       = array();
		$list_font_weights 		= array();
		$webfonts_array    		= file( get_template_directory_uri().'/lib/includes/customizer/fonts.json');
		$webfonts          		= implode( '', $webfonts_array );
		$list_fonts_decode 		= json_decode( $webfonts, true );
		$list_fonts['default'] 	= 'Theme Default';
		foreach ( $list_fonts_decode['items'] as $key => $value ) {
			$item_family                     = $list_fonts_decode['items'][$key]['family'];
			$list_fonts[$item_family]        = $item_family; 
			$list_font_weights[$item_family] = $list_fonts_decode['items'][$key]['variants'];
		} ?>
		<select <?php $this->link(); ?> style="">
			<?php
			$defaylt_fonts = array ('0' => __('Select Font',KAYA_THEME_NAME),
			'Arial,Helvetica,sans-serif' => 'Arial, Helvetica, sans-serif',
			"'Arial Black', adget,sans-serif" => "'Arial Black', Gadget, sans-serif",
			"'Bookman Old Style',serif" => "'Bookman Old Style', serif",
			"'Comic Sans MS',cursive" => "'Comic Sans MS', cursive",
			"Courier,monospace" => "Courier, monospace",
			"Garamond,serif" => "Garamond, serif",
			"Georgia,serif" => "Georgia, serif",
			"Impact,Charcoal, sans-serif" => "Impact, Charcoal, sans-serif",
			"'Lucida Console',Monaco,monospace" => "'Lucida Console', Monaco, monospace",
			"'Lucida Sans Unicode','Lucida Grande', sans-serif" => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
			"'MS Sans Serif',Geneva,sans-serif" => "'MS Sans Serif', Geneva, sans-serif",
			"'MS Serif','New York',sans-serif" => "'MS Serif', 'New York', sans-serif",
			"'Palatino Linotype','Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
			"Tahoma,Geneva,sans-serif" => "Tahoma, Geneva, sans-serif",
			"'Times New Roman',Times, serif" => "'Times New Roman', Times, serif",
			"'Trebuchet MS',Helvetica, sans-serif" => "'Trebuchet MS', Helvetica, sans-serif",
			"Verdana, Geneva,sans-serif" => "Verdana, Geneva, sans-serif");

			$array = array('System Fonts' => $defaylt_fonts, 'Google Fonts' => $list_fonts);
			foreach ($array as $key => $val){	   
				echo '<optgroup label="'.$key.'">';
				    foreach ($val as $k => $v){
					    echo '<option value="'.$k.'">'.$v.'</option>';
					}
			    echo '</optgroup>';
			}
			?>
		</select>	
	<?php }
	}
}
add_action('customize_register','kaya_customize_register');

function globel_font_family(){
	$header_text_logo_font_family = get_theme_mod('header_text_logo_font_family') ? get_theme_mod('header_text_logo_font_family') : 'Libre Baskerville';
	$google_bodyfont=get_theme_mod( 'google_body_font' ) ? get_theme_mod( 'google_body_font' ) : 'Open Sans';
	$google_menufont=get_theme_mod( 'google_menu_font') ? get_theme_mod( 'google_menu_font') : 'Offside';
	$google_generaltitlefont=get_theme_mod( 'google_heading_font' ) ? get_theme_mod( 'google_heading_font') : 'Gafata';
	$text_logo_tagline_font_family=get_theme_mod( 'text_logo_tagline_font_family' ) ? get_theme_mod( 'text_logo_tagline_font_family') : 'Arial,Helvetica,sans-serif';
	$customizer_font_names = array($header_text_logo_font_family, $google_bodyfont, $google_menufont, $google_generaltitlefont, $text_logo_tagline_font_family );
	$defaylt_fonts = array ('0','Arial,Helvetica,sans-serif',"'Arial Black', gadget,sans-serif" , "'Bookman Old Style',serif" ,"'Comic Sans MS',cursive" ,"Courier,monospace" ,"Garamond,serif" ,"Georgia,serif" ,"Impact,Charcoal, sans-serif" ,"'Lucida Console',Monaco,monospace" ,"'Lucida Sans Unicode','Lucida Grande', sans-serif" ,	"'MS Sans Serif',Geneva,sans-serif" ,"'MS Serif','New York',sans-serif" ,"'Palatino Linotype','Book Antiqua', Palatino, serif" ,"Tahoma,Geneva,sans-serif" ,"'Times New Roman',Times, serif" ,"'Trebuchet MS',Helvetica, sans-serif" ,"Verdana, Geneva,sans-serif");

	foreach ($customizer_font_names as $font_name) {
		if(in_array($font_name, $defaylt_fonts)) {	}
		else{
			$protocol = is_ssl() ? 'https' : 'http';
			if( $font_name ){
			wp_enqueue_style( 'font-family-'.str_replace(' ', '-', $font_name ), $protocol.'://fonts.googleapis.com/css?family='. urlencode( $font_name ).':300,400,700&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese' );
			}
		}
	}		
}
add_action('wp_enqueue_scripts','globel_font_family');