<?php
// Toggle Tabs And Accordion
class Lavan_Toggle_Tabs_Accordion extends WP_Widget{
public function __construct(){
global $lavan_plugin_name;	
  parent::__construct(
    'toggle-tabs-accordion',
    ucfirst($lavan_plugin_name).' '.__(' - Tabs-Accordion (PB)',$lavan_plugin_name).'&nbsp;<a class="widget_video_tutorials" target="_blank" href="https://youtu.be/6zORppQOOhY">'.__('Watch this video', $lavan_plugin_name).'</a>', 
    array('description' => __('Add Toggle, tabs and Accordion widget',$lavan_plugin_name))
    );
}
public function widget($args, $instance){
global $lavan_plugin_name;	
  $instance = wp_parse_args($instance, array(
      'title' => '',
      'select_type' => '',
      'select_tabs_type' => __('horizontal', $lavan_plugin_name),
      'tabs_acordion_order' => '',
      'tabs_acordion_orderby' => '',
      'taba_accordion_cat' => '',
      'limit' => '',
      'tabs_bg_color' => '#ffffff',
      'tabs_content_bg_color' => '#eee',
      'tabs_content_color' => '#666',
      'tabs_title_color' => '#343434',
      'tabs_border_color' => '#f5f5f5',
      'tabs_content_link_color' => '#343434',
      'animation_names' => '',
    ));
  // Accordion Script
    $tabs_rand_class = rand(1,100);
    $toggle_rand_class = rand(1,100);
    ?>
    <style>
    .accordion > div a, .toggle_content .block a, .tabDetails a{
      color:<?php echo $instance['tabs_content_link_color'] ?>;
    }
    .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs .ui-tabs-active a, .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs .ui-tabs-active a{
      background-color: <?php echo $instance['tabs_content_bg_color'] ?>!important;
    }
    .tabs-<?php echo $tabs_rand_class; ?>.vertical_tabs .tabDetails p, .tabs-<?php echo $tabs_rand_class; ?>.horizontal_tabs .tabDetails  p{
      color: <?php echo $instance['tabs_content_color'] ?>!important;
    }
    .toggle-<?php echo $toggle_rand_class; ?> .toggle_container_wrapper p{
      color: <?php echo $instance['tabs_content_color'] ?>!important;
    }
    </style>
    <?php
  $accordion_rand = rand(1,100);
  $tabs_rand = rand(1,100);
      if( $instance['select_type'] == 'accordion' ){
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
          $( "#accordion<?php echo $accordion_rand; ?>" ).accordion({
            autoHeight: true,
            collapsible: false,
             heightStyle: "content"
          });

         });
    </script>
        <?php  } // Tabs Script ?>
    <?php    if( $instance['select_type'] == 'tabs' ){ ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
          $("#tabid-<?php echo $tabs_rand; ?>").tabs().addClass( "<?php echo $instance['select_tabs_type']; ?>_tabs" );
          //$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
         });
    </script>
    <?php
  } ?>
  <?php  // Switch case in tabs type and add classes
  echo $args['before_widget'];
  switch ($instance['select_type']) {
    case 'accordion':
      $ids='accordion'.$accordion_rand.'';
      $class = '';
      break;
    case 'tabs':
      $ids='tabid-'.$tabs_rand.'';
      $class = 'tabContaier tabs-'.$tabs_rand_class.'';
      break;
    case 'toggle':
      $ids='';
      $class = 'toggle-'.$toggle_rand_class.'';
      break;
    default:
      $ids='';
       $class = '';
      break;
  }
    
    echo '<div class="wow '.$instance['animation_names'].' '.$instance['select_type'].'_wrapper '.$instance['select_type'].' '.$class.' " id="'.$ids.'">';
    // Adding ul when tabs active 
    if ($instance['select_type'] == 'tabs') { echo '<ul class="tabContaier">'; }

 $array_val = ( !empty( $instance['taba_accordion_cat'] )) ? explode(',', $instance['taba_accordion_cat']) : '';
              if( $array_val ) {
                $loop = new WP_Query(array( 'post_type' => 'tabs',   'orderby' => $instance['tabs_acordion_orderby'], 'posts_per_page' =>$instance['limit'],'order' => $instance['tabs_acordion_order'],  'tax_query' => array('relation' => 'AND', array( 'taxonomy' => 'toggletabs_category',   'field' => 'id', 'terms' => $array_val  ) )));
                }else{
                   $loop = new WP_Query(array('post_type' => 'tabs' , 'taxonomy' => 'toggletabs_category', 'term' => $instance['taba_accordion_cat'], 'orderby' => $instance['tabs_acordion_orderby'], 'posts_per_page' =>$instance['limit'],'order' => $instance['tabs_acordion_order'] ));
                }

  if( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post(); 
    if( $instance['select_type'] == 'accordion' ){ // Accordion ?>
      <strong style="background-color:<?php echo $instance['tabs_bg_color']; ?>; color:<?php echo $instance['tabs_title_color']; ?>; border:1px solid <?php echo $instance['tabs_border_color'] ?>;"><?php echo the_title(); ?></strong>
      <div style="background-color:<?php echo $instance['tabs_content_bg_color']; ?>; color:<?php echo $instance['tabs_content_color']; ?>; border:1px solid <?php echo $instance['tabs_border_color'] ?>;"> <?php echo get_the_content(); ?> </div> 
    <?php } 
      elseif( $instance['select_type'] == 'toggle' ){ // Toggle ?>
        <div class="toggle_container_wrapper"><strong class="trigger" style="background-color:<?php echo $instance['tabs_bg_color']; ?>; color:<?php echo $instance['tabs_title_color']; ?>; border:1px solid <?php echo $instance['tabs_border_color'] ?>;" ><?php echo the_title(); ?></strong><div class="toggle_content"><div class="block" style="background-color:<?php echo $instance['tabs_content_bg_color']; ?>; color:<?php echo $instance['tabs_content_color']; ?>; border:1px solid <?php echo $instance['tabs_border_color'] ?>;"><?php echo the_content(); ?></div></div></div>

     <?php }
      elseif ($instance['select_type'] == 'tabs') { // Tabs
       $string = mb_strtolower( preg_replace("/[\s_]/", "-", get_the_title()));
        echo '<li><a style="background-color:'.$instance['tabs_bg_color'].'; color:'.$instance['tabs_title_color'].'!important; border:1px solid'.$instance['tabs_border_color'].';" href="#'.trim($string).'">'.get_the_title().'</a></li>';
      }

     ?>
  <?php endwhile;
  wp_reset_query();
  endif;
     if ($instance['select_type'] == 'tabs') { echo '</ul>'; // End Tabs UL
     if( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post(); // Tabs Content loop 
       $string = mb_strtolower( preg_replace("/[\s_]/", "-", get_the_title())); ?>
       <div id="<?php echo trim($string); ?>">
           <div class="tabDetails" style="background-color:<?php echo $instance['tabs_content_bg_color']; ?>; color:<?php echo $instance['tabs_content_color']; ?>; border:1px solid <?php echo $instance['tabs_border_color'] ?>;"><?php the_content(); ?></div>
      </div>
     <?php endwhile;
     wp_reset_query();
     endif; // End Tabs Loop
     }
  echo  '</div>';
  echo $args['after_widget'];
}
// Form
public function form($instance){
global $lavan_plugin_name;	
  $tabs_terms=  get_terms('toggletabs_category','');
        if( $tabs_terms ){
          foreach ($tabs_terms as $tabs_term) { 
            $tab_cat_ids[] = $tabs_term->term_id;
             $tab_cats_name[] = $tabs_term->name.' - '.$tabs_term->term_id;
          }
        }else{ $tab_cats_name[] = ''; $tab_cat_ids[] = ''; }
    $instance = wp_parse_args($instance, array(
      'title' => '',
      'select_type' => '',
      'select_tabs_type' => __('horizontal', $lavan_plugin_name),
      'tabs_acordion_order' => '',
      'tabs_acordion_orderby' => '',
      'taba_accordion_cat' => implode(',', $tab_cat_ids),
      'limit' => '',
      'tabs_bg_color' => '#ffffff',
      'tabs_content_bg_color' => '#eee',
      'tabs_content_color' => '#666',
      'tabs_title_color' => '#343434',
      'tabs_border_color' => '#f5f5f5',
      'tabs_content_link_color' => '#343434',
      'animation_names' => '',
    )); ?>
  <script type="text/javascript">
      (function($) {
      "use strict";
      $(function() {

      $("#<?php echo $this->get_field_id('select_type') ?>").change(function () {
      $("#<?php echo $this->get_field_id('select_tabs_type') ?>").parent().hide();
      var selectlayout = $("#<?php echo $this->get_field_id('select_type') ?> option:selected").val(); 
      switch(selectlayout)
        {
          case 'tabs':
           $("#<?php echo $this->get_field_id('select_tabs_type') ?>").parent().show();
          break;      
        }
      }).change();
      $('.toggle_tabs_color_picker').each(function(){
      $(this).wpColorPicker();	
      })
     });
  })(jQuery);
    </script>
<div class="input-elements-wrapper">    
	<p>
		<label for="<?php echo $this->get_field_id('select_type') ?>"><?php _e('Select Type',$lavan_plugin_name) ?></label>
		<select id="<?php echo $this->get_field_id('select_type') ?>" name="<?php echo $this->get_field_name('select_type') ?>">
			<option value="accordion" id="<?php echo $this->get_field_id('select_type') ?>" <?php selected( 'accordion',
			$instance['select_type'] ) ?> >
			<?php _e('Accordion', $lavan_plugin_name) ?></option>
			<option value="tabs" id="<?php echo $this->get_field_id('select_type') ?>" <?php selected( 'tabs',$instance
			['select_type'] ) ?> >
			<?php _e('Tabs', $lavan_plugin_name) ?></option>
			<option value="toggle" id="<?php echo $this->get_field_id('select_type') ?>" <?php selected( 'toggle',$instance
			['select_type'] ) ?> >
			<?php _e('Toggle ', $lavan_plugin_name) ?></option>
		</select>
	</p>
	<p> 
		<label for="<?php echo $this->get_field_id('select_tabs_type') ?>"><?php _e('Select Tabs Type',$lavan_plugin_name)
		 ?></label>
		<select id="<?php echo $this->get_field_id('select_tabs_type') ?>" name="<?php echo $this->get_field_name
		    ('select_tabs_type') ?>">
			<option value="horizontal" id="<?php echo $this->get_field_id('select_tabs_type') ?>" <?php selected( 'horizontal',$instance['select_tabs_type'] ) ?> >
			<?php _e('Horizontal Tabs', $lavan_plugin_name) ?></option>
			<option value="vertical" id="<?php echo $this->get_field_id('select_tabs_type') ?>" <?php selected( 'vertical',$instance['select_tabs_type'] ) ?> >
			<?php _e('Vertical Tabs', $lavan_plugin_name) ?></option>
		</select>
	</p>
</div>	
<div class="input-elements-wrapper"> 
	<p>
		<label for="<?php echo $this->get_field_id('taba_accordion_cat') ?>"> <?php _e('Enter Category IDs : ',
		$lavan_plugin_name) ?> </label>
		<input type="text" name="<?php echo $this->get_field_name('taba_accordion_cat') ?>" id="<?php echo $this->get_field_id
		('taba_accordion_cat') ?>" class="widefat" value="<?php echo $instance['taba_accordion_cat'] ?>" />
		<em><strong style="color:green;"><?php _e('Available Categories and IDs : ',$lavan_plugin_name); ?> </strong> <?php echo implode(', ', $tab_cats_name); ?></em><br />
		<stong><?php _e('Note:',$lavan_plugin_name); ?></strong><?php _e('Separate IDs with commas only',$lavan_plugin_name); ?>
	</p>
</div>
<div class="input-elements-wrapper"> 
	<p class="one_fourth">
		<label for="<?php echo $this->get_field_id('tabs_bg_color') ?>"><?php _e('Tabs Bg Color',$lavan_plugin_name); ?>
		</label>
		<input type="text" name="<?php echo $this->get_field_name('tabs_bg_color') ?>" id="<?php echo $this->get_field_id('tabs_bg_color') ?>"  class="toggle_tabs_color_picker" value="<?php echo $instance['tabs_bg_color'] ?>" />
	</p>
	<p class="one_fourth">
		<label for="<?php echo $this->get_field_id('tabs_title_color') ?>"><?php _e('Tabs Title Color',$lavan_plugin_name); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('tabs_title_color') ?>" id="<?php echo $this->get_field_id('tabs_title_color') ?>"  class="toggle_tabs_color_picker" value="<?php echo $instance['tabs_title_color'] ?>"
		 />
	</p>
	<p class="one_fourth">
		<label for="<?php echo $this->get_field_id('tabs_content_bg_color') ?>"><?php _e('Tabs Content BG Color',
		$lavan_plugin_name); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('tabs_content_bg_color') ?>" id="<?php echo $this->get_field_id('tabs_content_bg_color') ?>" class="toggle_tabs_color_picker" value="<?php echo $instance
		['tabs_content_bg_color'] ?>" />
	</p>
</div>
<div class="input-elements-wrapper"> 
	<p class="one_fourth">
		<label for="<?php echo $this->get_field_id('tabs_content_color') ?>"><?php _e('Tabs Content Color',
		$lavan_plugin_name); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('tabs_content_color') ?>" id="<?php echo $this->get_field_id('tabs_content_color') ?>" class="toggle_tabs_color_picker" value="<?php echo $instance
		['tabs_content_color'] ?>" />
	</p>
	<p class="one_fourth">
		<label for="<?php echo $this->get_field_id('tabs_content_link_color') ?>"><?php _e('Tabs Content Link Color',
		$lavan_plugin_name); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('tabs_content_link_color') ?>" id="<?php echo $this->get_field_id('tabs_content_link_color') ?>" class="toggle_tabs_color_picker" value="<?php echo $instance
		['tabs_content_link_color'] ?>" />
	</p>
	<p class="one_fourth">
		<label for="<?php echo $this->get_field_id('tabs_border_color') ?>"><?php _e('Tabs Border Color',$lavan_plugin_name); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('tabs_border_color') ?>" id="<?php echo $this->get_field_id('tabs_border_color') ?>" class="toggle_tabs_color_picker" value="<?php echo $instance
		['tabs_border_color'] ?>" />
	</p>
</div>
<div class="input-elements-wrapper"> 
	<p class="one_fourth">
		<label for="<?php echo $this->get_field_id('tabs_acordion_order') ?>"><?php _e('Order',$lavan_plugin_name)?></label>
		<select id="<?php echo $this->get_field_id('tabs_acordion_order') ?>" name="<?php echo $this->get_field_name
			('tabs_acordion_order') ?>">
			<option value="ASC" <?php selected('ASC', $instance['tabs_acordion_order']) ?>>
			<?php _e('Ascending', $lavan_plugin_name) ?></option>
			<option value="DESC" <?php selected('DESC', $instance['tabs_acordion_order']) ?>>
			<?php _e('Descending', $lavan_plugin_name) ?></option>
		</select>
	</p> 
	<p class="one_fourth">
		<label for="<?php echo $this->get_field_id('tabs_acordion_orderby') ?>"><?php _e('Orderby',$lavan_plugin_name)?>
		</label>
		<select id="<?php echo $this->get_field_id('tabs_acordion_orderby') ?>" name="<?php echo $this->get_field_name
			('tabs_acordion_orderby') ?>">
			<option value="date" <?php selected('date', $instance['tabs_acordion_orderby']) ?>>
			<?php _e('Date', $lavan_plugin_name) ?></option>
			<option value="menu_order" <?php selected('menu_order', $instance['tabs_acordion_orderby']) ?>>
			<?php _e('Menu Order', $lavan_plugin_name) ?></option>
			<option value="title" <?php selected('title', $instance['tabs_acordion_orderby']) ?>>
			<?php _e('Title', $lavan_plugin_name) ?></option>
			<option value="rand" <?php selected('rand', $instance['tabs_acordion_orderby']) ?>>
			<?php _e('Random', $lavan_plugin_name) ?></option>
			<option value="author" <?php selected('author', $instance['tabs_acordion_orderby']) ?>>
			<?php _e('Author', $lavan_plugin_name) ?></option>
		</select>
	</p>
	<p class="one_fourth">
		<label for="<?php echo $this->get_field_id('limit') ?>"><?php _e('Limit',$lavan_plugin_name); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('limit') ?>" id="<?php echo $this->get_field_id('limit') 
		?>"  value="<?php echo $instance['limit'] ?>" />
	</p>
</div>
<div class="input-elements-wrapper">
	<p>
	  <label for="<?php echo $this->get_field_id('animation_names') ?>">  <?php _e('Select Animation Effect',
	  $lavan_plugin_name) ?> 
	  </label>
	  <?php animation_effects($this->get_field_name('animation_names'), $instance['animation_names'] ); ?>
	</p> 
</div>		
<?php 
}
 }
 lavan_kaya_register_widgets('toggle-tabs-accordion',__FILE__);
?>