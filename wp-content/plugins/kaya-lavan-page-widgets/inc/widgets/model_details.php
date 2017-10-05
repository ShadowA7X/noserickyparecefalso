<?php
class Lavan_Model_Details_Widget extends WP_Widget{
public function __construct(){
global $lavan_plugin_name;  
parent::__construct(  'kaya-model-details',
           ucfirst($lavan_plugin_name).' '.__(' - Model Details',$lavan_plugin_name).'&nbsp;<a class="widget_video_tutorials" target="_blank" href="https://youtu.be/JjBSNNL8zBo">'.__('Watch this video', $lavan_plugin_name).'</a>',
  array( 'description' => __('Use this widget to add model details','lavan') ,'class' => 'kaya_model_details' ));
}
public function widget( $args , $instance ){
echo $args['before_widget'];
global $lavan_plugin_name, $post; 
  $instance = wp_parse_args($instance, array(
      'model_title_color' => '#FF5400',
      'model_description_color' => '#333333',
   ));
    echo '<div class="pf_model_info_wrapper"><dl>';
    $custom_pf_options = get_option('pf_custom_options');
      $prefix = 'pf_model_';
      for ($i=0; $i < count($custom_pf_options['pf_meta_label_name'])-1; $i++) { 
        if( ( !empty($custom_pf_options['pf_meta_label_name'][$i]) ) &&  ( $custom_pf_options['pf_meta_label_name'][$i] != 'Array') &&  ( $custom_pf_options['pf_meta_label_name'][$i] != '') &&  ( !is_array($custom_pf_options['pf_meta_label_name'][$i]) )){
        $options_data_id = $prefix.str_replace(array(' ', ',','-', '/', '___'), '_', trim(strtolower($custom_pf_options['pf_meta_label_name'][$i])));
        $meta_data = get_post_meta(get_the_ID(), $options_data_id , true);
        if( !empty( $meta_data) ){
          if( $custom_pf_options['pf_meta_label_name'][$i] == 'Height' ){
            $option_value = str_replace('.', "'", $meta_data);
          }else{
            $option_value = $meta_data;
          }
          echo '<dt style="color:'.$instance['model_title_color'].';">'.trim($custom_pf_options['pf_meta_label_name'][$i]).'</dt>';
          echo '<dd style="color:'.$instance['model_description_color'].';"> '.trim($option_value).'</dd>';
            }
          }
        }
    echo '</dl></div>';
 echo $args['after_widget']; ?>
<?php }

public function form( $instance ){
global $lavan_plugin_name;   
$instance = wp_parse_args( $instance, array(
  'model_title_color' => '#FF5400',
  'model_description_color' => '#333333',
) );
?>
<script type='text/javascript'>
  jQuery(document).ready(function($) {
  jQuery('.model_details_color_pickr').each(function(){
  jQuery(this).wpColorPicker();
  });    
  });
</script>   
<div class="input-elements-wrapper">  
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('model_title_color') ?>"><?php _e('Model Title Color','lavan')?>
    </label>
    <input type="text" class="model_details_color_pickr" id="<?php echo $this->get_field_id('model_title_color') ?>" name="<?php echo $this->get_field_name('model_title_color') ?>" value="<?php echo $instance['model_title_color']; ?>" />
  </p>
  <p class="one_fourth">
    <label for="<?php echo $this->get_field_id('model_description_color') ?>"><?php _e('Model Description Color','lavan')?></label>
    <input type="text" class="model_details_color_pickr" id="<?php echo $this->get_field_id('model_description_color') ?>" name="<?php echo $this->get_field_name('model_description_color') ?>" value="<?php echo $instance['model_description_color']; ?>" />
  </p>
</div>            
<?php  }
}
lavan_kaya_register_widgets('model-details-widget', __FILE__);
?>