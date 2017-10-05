<?php
 /**
 *  Contact Form
 */
 class Lavan_Contact_Form extends WP_Widget{
  public function __construct(){
  global $lavan_plugin_name;	
   parent::__construct( 'lavan-contact-form', 
      __('Lavan-Contact Form', $lavan_plugin_name),
      array(  'description' => __('Display contact form',$lavan_plugin_name), 'class' => 'contact_form'   ));
   }
   public function widget( $args , $instance ){
    global $lavan_plugin_name;
    wp_enqueue_script('js_widget_contact', constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'js/widget_contact.js',array( 'jquery' ),'', true);
    $instance = wp_parse_args($instance , array(
      'button_text' => __('SUBMIT',$lavan_plugin_name),
      'button_text_color' =>'#ffffff',
      'button_bg_hover_color' => '',
      'button_text_hover_color' => '',
      'button_text_font_size' =>'',
      'button_text_letter_spacing' =>'',
      'button_bg_color' =>'#db0007',
      'email_id' => 'yourdomain@gmail.com',
      'animation_names' => '',
      'input_fields_border_color' => '#333333',
      'input_fields_error_border_color' => '#db0007',
      'input_fields_color' => '#8b8b8b',
      'name_label_name' => 'Your Name',
      'email_label_name' => 'Email',
      'subject_label_name' => 'Subject',
      'message_label_name' => 'Message',
      'success_message_text' => __("We've received your Email. We'll be in touch with you as soon as possible!", $lavan_plugin_name),
  ));
  echo $args['before_widget']; 
  $rand = rand(1,100);
  $success_message = $instance['success_message_text'] ? $instance['success_message_text'] : __("We've received your Email. We'll be in touch with you as soon as possible!",$lavan_plugin_name);
    $contact_form_animation = ( trim( $instance['animation_names'] ) )  ? 'wow '. $instance['animation_names'] : '';  ?>
    <?php $css ='#contact-form.contact-form-'.$rand .' input, #contact-form.contact-form-'.$rand .' textarea{ border-color:'.$instance['input_fields_border_color'].'; color:'.$instance['input_fields_color'].'; } #contact-form.contact-form-'.$rand .' i{color:'.$instance['input_fields_color'].'!important; }';
          $css .='#contact-form.contact-form-'.$rand .' .vaidate_error{ border-color:'.$instance['input_fields_error_border_color'].'!important; }';
          $css .='#contact-form.contact-form-'.$rand .' input.button{ background:'.$instance['button_bg_color'].'!important; color:'.$instance['button_text_color'].'!important; }';
          $css .='#contact-form.contact-form-'.$rand .' input.button:hover{ background:'.$instance['button_bg_hover_color'].'!important; color:'.$instance['button_text_hover_color'].'!important; }';
          $css .='#contact-form.contact-form-'.$rand .' input.button:hover{ background:'.$instance['button_bg_hover_color'].'!important; color:'.$instance['button_text_hover_color'].'!important; }';
           $css .='#contact-form.contact-form-'.$rand .' ::-webkit-input-placeholder {  color: '.$instance['input_fields_color'].'!important; }';
          $css .='#contact-form.contact-form-'.$rand .' ::-moz-placeholder{    color: '.$instance['input_fields_color'].'!important; }';
    echo '<style>'.$css.'</style>'; ?>
    <form method="post" action="sendEmail.php" name="contact-form" id="contact-form" class="contact-form-<?php echo $rand; ?>">
        <div id="main" class="<?php echo $contact_form_animation; ?>">
          <div id="contact_response" >    </div>
         <input type="hidden" name="success_message_text" id="success_message_text" value="<?php echo $success_message; ?>" />
          <input type="hidden" name="siteemail" id="siteemail" value="<?php echo $instance['email_id']; ?>" />
          <p class="fullwidth">
              <input type="text" name="name" id="name" size="23"  placeholder="<?php echo $instance['name_label_name']; ?>" />
              <i class="fa fa-user"></i>
          </p>
          <p class="fullwidth">
              <input type="text" name="email" placeholder="<?php echo $instance['email_label_name']; ?>" id="email" size="23" />
              <i class="fa fa-envelope"></i>
          </p>
          <p class="fullwidth">
              <input type="text" name="subject" placeholder="<?php echo $instance['subject_label_name']; ?>" id="subject" size="23" />
              <i class="fa fa-comments"></i>
          </p>
          <p class="fullwidth">
              <textarea name="message" id="message" placeholder="<?php echo $instance['message_label_name']; ?>" cols="30" rows="4"></textarea>
          </p>
          <p class="fullwidth contact_button_wrapper" style="padding-bottom:0;" data-hover-bg="<?php echo $instance['button_bg_hover_color'] ?>" data-hover-link="<?php echo $instance['button_text_hover_color'] ?>">
              <input  class="button" type="submit" name="contact_submit" id="contact_submit" style="background-color:<?php echo $instance['button_bg_color'] ?>; color:<?php echo $instance['button_text_color'] ?>;  font-size:<?php echo $instance['button_text_font_size']?>px; letter-spacing:<?php echo $instance['button_text_letter_spacing'] ?>px; font-weight:bold; border:0px" value="<?php echo $instance['button_text'] ?> " /> 
              <?php echo '<img src="'.constant(strtoupper($lavan_plugin_name).'_PLUGIN_URL').'images/form_loader.gif" alt="Contact Form Loader" class="contact_loader">';
              ?>
          </p>
        </div>
    </form>
  <?php echo $args['after_widget']; 
  }
public function form( $instance ){
  global $lavan_plugin_name;
  $instance = wp_parse_args($instance , array(
    'button_text' => __('SUBMIT',$lavan_plugin_name),
    'button_bg_color' =>'#db0007',
    'button_text_color' =>'#ffffff',
    'button_bg_hover_color' => '',
    'button_text_hover_color' => '',
    'button_text_font_size' =>'',
    'button_text_letter_spacing' =>'',
    'email_id' => 'yourdomain@gmail.com',
    'animation_names' => '',
    'input_fields_border_color' => '#333333',
    'input_fields_error_border_color' => '#db0007',
    'input_fields_color' => '#8b8b8b',
    'name_label_name' => 'Your Name',
    'email_label_name' => 'Email',
    'subject_label_name' => 'Subject',
    'message_label_name' => 'Message',
   'success_message_text' => __("We've received your Email. We'll be in touch with you as soon as possible!", $lavan_plugin_name),
    ));
    ?>
  <script type='text/javascript'>
  jQuery(document).ready(function($) {
    jQuery('.contact_color_pickr').each(function(){
      jQuery(this).wpColorPicker();
    }); 
  });
  </script>
  <div class="input-elements-wrapper"> 
    <p class="one_half">
      <label for="<?php echo $this->get_field_id('email_id'); ?>"> <?php _e('Email Id',$lavan_plugin_name) ?> </label>
      <input type="text" name="<?php echo $this->get_field_name('email_id') ?>" id="<?php echo $this->get_field_id('email_id') ?>" class="widefat" value="<?php echo esc_attr($instance['email_id']) ?>" />
    </p>
     <p class="one_fourth">
      <label for="<?php echo $this->get_field_id('input_fields_border_color') ?>"><?php _e('Form Input Fields Border Color',$lavan_plugin_name); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('input_fields_border_color') ?>" id="<?php echo $this->get_field_id('input_fields_border_color') ?>" class="contact_color_pickr" value="<?php echo esc_attr($instance['input_fields_border_color']) ?>" />
    </p>
     <p class="one_fourth_last">
      <label for="<?php echo $this->get_field_id('input_fields_color') ?>"><?php _e('Form Input Fields Text Color',$lavan_plugin_name); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('input_fields_color') ?>" id="<?php echo $this->get_field_id('input_fields_color') ?>" class="contact_color_pickr" value="<?php echo esc_attr($instance['input_fields_color']) ?>" />
    </p>
    </div>
  <div class="input-elements-wrapper">
    <p class="one_fourth">
      <label for="<?php echo $this->get_field_id('name_label_name') ?>"><?php _e('Name Label Name',$lavan_plugin_name); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('name_label_name') ?>" id="<?php echo $this->get_field_id('name_label_name') ?>" class="widefat" value="<?php echo esc_attr($instance['name_label_name']) ?>" />
    </p>
    <p class="one_fourth">
      <label for="<?php echo $this->get_field_id('email_label_name') ?>"><?php _e('Email Label Name',$lavan_plugin_name); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('email_label_name') ?>" id="<?php echo $this->get_field_id('email_label_name') ?>" class="widefat" value="<?php echo esc_attr($instance['email_label_name']) ?>" />
    </p>
     <p class="one_fourth">
      <label for="<?php echo $this->get_field_id('subject_label_name') ?>"><?php _e('Subject Label Name',$lavan_plugin_name); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('subject_label_name') ?>" id="<?php echo $this->get_field_id('subject_label_name') ?>" class="widefat" value="<?php echo esc_attr($instance['subject_label_name']) ?>" />
    </p>
     <p class="one_fourth_last">
      <label for="<?php echo $this->get_field_id('message_label_name') ?>"><?php _e('Message Label Name',$lavan_plugin_name); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('message_label_name') ?>" id="<?php echo $this->get_field_id('message_label_name') ?>" class="widefat" value="<?php echo esc_attr($instance['message_label_name']) ?>" />
    </p>
  </div>  
  <div class="input-elements-wrapper"> 
    <p class="one_fourth">
      <label for="<?php echo $this->get_field_id('button_text'); ?>"> <?php _e('Submit Button Text',$lavan_plugin_name) ?> </label>
      <input type="text" name="<?php echo $this->get_field_name('button_text') ?>" id="<?php echo $this->get_field_id('button_text') ?>" class="widefat" value="<?php echo $instance['button_text'] ?>" />
    </p>
    <p class="one_fourth">
      <label for="<?php echo $this->get_field_id('button_text_color') ?>"><?php _e('Button Text Color',$lavan_plugin_name); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('button_text_color') ?>" id="<?php echo $this->get_field_id('button_text_color') ?>" class="contact_color_pickr" value="<?php echo $instance['button_text_color'] ?>" />
    </p>
    <p class="one_fourth_last">
      <label for="<?php echo $this->get_field_id('button_bg_color') ?>"><?php _e('Button Bg  Color',$lavan_plugin_name); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('button_bg_color') ?>" id="<?php echo $this->get_field_id('button_bg_color') ?>" class="contact_color_pickr" value="<?php echo $instance['button_bg_color'] ?>" />
    </p>
    <p class="one_fourth">
      <label for="<?php echo $this->get_field_id('button_text_hover_color') ?>"><?php _e('Button Text Hover Color',$lavan_plugin_name); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('button_text_hover_color') ?>" id="<?php echo $this->get_field_id('button_text_hover_color') ?>" class="contact_color_pickr" value="<?php echo esc_attr($instance['button_text_hover_color']) ?>" />
    </p>
    
  </div>
  <div class="input-elements-wrapper">
    <p class="one_fourth">
      <label for="<?php echo $this->get_field_id('button_bg_hover_color') ?>"><?php _e('Button Bg Hover Color',$lavan_plugin_name); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('button_bg_hover_color') ?>" id="<?php echo $this->get_field_id('button_bg_hover_color') ?>" class="contact_color_pickr" value="<?php echo esc_attr($instance['button_bg_hover_color']) ?>" />
    </p>
    <p class="one_fourth">
      <label for="<?php echo $this->get_field_id('button_text_font_size') ?>">  <?php _e('Button Font Size',$lavan_plugin_name) ?>  </label>
      <input type="text" class="small-text" id="<?php echo $this->get_field_id('button_text_font_size') ?>" name="<?php echo $this->get_field_name('button_text_font_size') ?>" value="<?php echo esc_attr($instance['button_text_font_size']) ?>" />
      <small>  <?php _e('px',$lavan_plugin_name) ?> </small> 
    </p>
    <p class="one_fourth">
      <label for="<?php echo $this->get_field_id('button_text_letter_spacing') ?>">  <?php _e('Button Text Letter Spacing',$lavan_plugin_name) ?>  </label>
      <input type="text" class="small-text" id="<?php echo $this->get_field_id('button_text_letter_spacing') ?>" name="<?php echo $this->get_field_name('button_text_letter_spacing') ?>" value="<?php echo esc_attr($instance['button_text_letter_spacing']) ?>" />
      <small>  <?php _e('px',$lavan_plugin_name) ?>  </small> 
    </p>
  </div>
  <div class="input-elements-wrapper">
   <p class="one_fourth">
      <label for="<?php echo $this->get_field_id('input_fields_error_border_color') ?>"><?php _e('Form Input Error Fields  Border Color',$lavan_plugin_name); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('input_fields_error_border_color') ?>" id="<?php echo $this->get_field_id('input_fields_error_border_color') ?>" class="contact_color_pickr" value="<?php echo esc_attr($instance['input_fields_error_border_color']) ?>" />
    </p>
  </div>
  <div class="input-elements-wrapper">
   <p class="fullwidth">
      <label for="<?php echo $this->get_field_id('success_message_text') ?>"><?php _e('Form Success Message Text',$lavan_plugin_name); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('success_message_text') ?>" id="<?php echo $this->get_field_id('success_message_text') ?>" class="widefat" value="<?php echo esc_attr($instance['success_message_text']) ?>" />
    </p>
  </div>
    <p>
      <label for="<?php echo $this->get_field_id('animation_names') ?>">  <?php _e('Select Animation Effect',$lavan_plugin_name) ?>  </label>
      <?php animation_effects($this->get_field_name('animation_names'), $instance['animation_names'] ); ?>
    <p>
<?php 
}
}
  lavan_kaya_register_widgets('contact-form',__FILE__);
?>