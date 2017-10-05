<?php
ob_start();
class Pf_Custom_Options{
    var $pf_slug_name;
    function __construct(){
        add_action( 'admin_init' , array( $this, 'pf_options_register_init' ) );
        add_action( 'admin_menu' , array( $this, 'pf_add_options_page' ) );
        $this->pf_slug_name = get_theme_mod('pf_slug_name') ? get_theme_mod('pf_slug_name') :'Model';
    }
    function pf_options_register_init(){
       register_setting( 'pf_meta_custom_options', 'pf_custom_options',  array( $this,'pf_custom_options_validate') );
       register_setting( 'pf_custom_search_name', 'pf_search_name',  array( $this,'pf_search_name_validate') );
    }
    function pf_add_options_page() {
        global $pf_model_name;
        add_menu_page('Options', ucfirst('lavan').' Options', 'manage_options', 'kaya_theme_options', array(&$this, 'import_xml_content'), '', 62);        
        add_submenu_page('kaya_theme_options', 'Model Custom Fields', ucfirst($this->pf_slug_name) .' Custom Fields', 'manage_options', 'pf_custom_options_page',  array( $this,'pf_custom_options_sttings'));
        add_submenu_page('kaya_theme_options', __('Import', 'lavan'), __('Import', 'lavan'), 'edit_theme_options', 'pf_import', array( $this,'pf_import_option_page'));
        remove_submenu_page( 'kaya_theme_options', 'kaya_theme_options' );
        add_submenu_page('kaya_theme_options', __('Export', 'lavan'), __('Export', 'lavan'), 'edit_theme_options', 'pf-export', array( $this,'pf_export_option_page'));
    }
   function pf_export_option_page() {  ?>
        <?php // Export Options
         if (!isset($_POST['export'])) {
        ?>
            <div class="wrap">
                <div id="icon-tools" class="icon32"><br /></div>
                <h2><?php echo ucfirst($this->pf_slug_name).' '; _e('Options Data Export','lavan'); ?> </h2>
                <p><?php _e('When you click <tt>Backup all options</tt> button, system will generate a JSON file for you to save on your computer.</p>
                <p>This backup file contains all configution and setting options on our website. Note that it do <b>NOT</b> contain posts, pages, or any relevant data, just your all options.','lavan'); ?></p>
                <p> <?php _e('After exporting, you can either use the backup file to restore your settings on this site again or another WordPress site.','lavan'); ?> </p>
                <form method='post'>
                    <p class="submit">
                        <?php wp_nonce_field('pf-export'); ?>
                        <input type='submit' name='export' value='<?php _e("Dowload Options Settings", 'lavan'); ?>' class="button button-primary"/>
                    </p>
                </form>
            </div>
            <?php
        }
        elseif (check_admin_referer('pf-export')) {
             $blogname = str_replace(" ", "", get_option('blogname'));
            $date = date("m-d-Y");
            $json_name = $blogname."-".$date; // Namming the filename will be generated.
             //$options = get_option('pf_custom_options'); // Get all options data, return array 
              $options = array('pf_custom_options' => get_option('pf_custom_options'));     
             foreach ($options as $key => $value) {
                $value = maybe_unserialize($value);
                $need_options[$key] = $value;
            }
            $json_file = json_encode($need_options); // Encode data into json data
            ob_clean();
            echo $json_file;
            header("Content-Type: text/json; charset=" . get_option( 'blog_charset'));
            header("Content-Disposition: attachment; filename=$json_name.json");
            exit();
        }
    }
    function pf_custom_options_sttings(){
        ?>
        <!-- Options Create -->
        <div class="wrap custom_meta_options_group">
            <h2><?php echo ucfirst($this->pf_slug_name).' '; _e(' Custom Meta Field Options','lavan'); ?> </h2>
            <style type="text/css">
                .options_fields{
                     margin-top: 30px;
                }
                .options_fields textarea {
                    vertical-align: middle;
                    height: 3em;            
                }
                .options_fields span {
                    margin-right: 30px;
                    float: left;
                    overflow: hidden;
                }
                .options_fields strong {
                     padding-right: 6px;
                     display: block;
                }
                .options_fields ul li {
                    padding: 20px 30px;
                    margin:0px!important;
                    border-bottom: 1px solid rgba(204,204,204,.3);
                    overflow: hidden;
                }
                .options_fields ul, .fields_add_options{
                    border: 1px solid #e5e5e5;
                    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04);
                    box-shadow: 0 1px 1px rgba(0,0,0,.04);
                }
                select#Pf_option_field_type{
                    width: 172px;
                }
                .fields_add_options{
                    background:#f9f9f9;
                    padding: 20px 30px;
                    margin-bottom: 30px!important;
                    overflow: hidden;
                }
                .options_fields ul li:nth-child(even){
                    background:#f9f9f9;
                }
                .options_fields ul li:nth-child(odd){
                    background:#f5f5f5;
                }
                .options_fields input:not(.button-primary), .options_fields select, .options_fields textarea{
                    margin: 1px;
                    padding: 3px 5px;
                    box-shadow: 0 0!important;
                    border: 1px solid #DADADA!important;
                }
                .custom_meta_options_group a.delete, #create_option{
                    position: relative;
                    left: -20px;
                    height: 100%;
                    overflow: hidden;
                    display: inline-block;
                }
                .custom_meta_options_group a.add_icon{
                    top:20px;
                }
                .custom_meta_options_group a.delete img, #create_option img{
                    height: 30px;
                    width: 30px;
                    margin-top: -3px;
                }
            </style>
             <script>
                jQuery(function() {
                    jQuery( "#pf_options_sortable" ).sortable();
                });
            </script>
            <?php $model_options_data = '';
            ?>
            <form method="post" action="options.php">
                <?php settings_fields('pf_meta_custom_options');
                $options = get_option('pf_custom_options'); 
                $some_text = isset( $options['search_name'] ) ? $options['search_name'] : 'Search';
               
               $model_options_data .= '<script type="text/javascript">';
               $model_options_data .= 'var $ = jQuery;
                    $(document).ready(function(){
                        $(".options_fields").on("click", ".delete", function(){
                            $(this).parent().remove();
                        });
                        $("#create_option").click(function(){
                            var label_val = $("#Pf_option_label_name").val();
                            if( label_val == "" ){
                                alert("Please Enter Field Name");
                                return;
                            }                             
                            $(".options_fields ul").append("<li><span><input type=\'text\' name=\'pf_custom_options[pf_meta_label_name][]\' value=\'"+$("#Pf_option_label_name").val()+"\' /></span><span><input readonly type=\'text\'  name=\'pf_custom_options[pf_meta_field_name][]\' value=\'"+$("#Pf_option_field_type").val()+"\' /></span><span><textarea cols=\'50\' rows=\'3\' name=\'pf_custom_options[pf_meta_field_options][]\' class=\'pf_meta_field_options\'>"+$("#pf_meta_field_options").val()+" </textarea></span> <span><input type=\'text\'  name=\'pf_custom_options[pf_option_display_search][]\' value=\'"+$("#pf_option_display_search").val()+"\' /></span> <a href=\'#\' class=\'delete\'><img src=\''.get_template_directory_uri().'/images/delete.png\' /></a> </li>");
                             alert($("#Pf_option_label_name").val() + " Option Field Created"); 
                            $("#Pf_option_label_name").val("");
                            $("#pf_meta_field_options").text("");
                            $("html, body").animate({scrollTop:$(document).height()}, 1000);
                            });
                            $("#Pf_option_field_type1").change(function(){
                           $(".pf_meta_field_options").hide().addClass("test");
                            var option_value = $("#Pf_option_field_type option:selected").val();
                            switch(option_value){
                                case "select":
                                    $(".pf_meta_field_options").show().removeClass("test");
                                    break;
                                case "default":
                                    break;     
                            }
                        }).change();

                         
                    })';
           $model_options_data .= '</script>';
           $model_options_data .= '<div class="options_fields">';
           $model_options_data .= '<p class="fields_add_options"><span><strong>'.__('Label Name ','lavan').'</strong><input type="text" id="Pf_option_label_name" placeholder="'.__('Name of the field', 'lavan').'" /></span>';
           $model_options_data .= '<span><strong>'.__('Label Field Type ', 'lavan').'</strong><select id="Pf_option_field_type" class="Pf_option_field_type"><option value="text">'.__('Text Field', 'lavan').'</option> <option value="select">Select Box</option><option value="textarea">Text Area</option></select></span>';
           $model_options_data .= '<span><strong>'.__('Use this box only when you need select box','lavan').'</strong><textarea  placeholder="'.__('Options1 | Options2 | Options3 | Options4', 'lavan').'" type="text" cols="50" rows="3" class="pf_meta_field_options" id="pf_meta_field_options" /></textarea></span>';
            $model_options_data .= '<span><strong>'.__('Display On Search ', 'lavan').'</strong><select id="pf_option_display_search" class="pf_option_display_search"><option value="true">True</option> <option value="false">False</option></select></span>';
           $model_options_data .= ' <a href="#" class="add_icon" id="create_option"><img src="'.get_template_directory_uri().'/images/addicon.png" /></a></p>';
           $model_options_data .= '<ul id="pf_options_sortable">';
            $count=count($options['pf_meta_label_name']);
            for ($i=0; $i < ($count-1); $i++) {
                // echo '<pre>'.print_r($options['pf_meta_label_name'][$i]).'</pre>';
                if( ( !empty($options['pf_meta_label_name'][$i]) ) &&  ( $options['pf_meta_label_name'][$i] != 'Array') &&  ( $options['pf_meta_label_name'][$i] != '') &&  ( !is_array($options['pf_meta_label_name'][$i]) )){
                   $model_options_data .= '<li class="ui-state-default"><span><input type="text" name="pf_custom_options[pf_meta_label_name][]" value="'.trim($options['pf_meta_label_name'][$i]).'" /></span>';
                   $model_options_data .='<span><input readonly type="text" name="pf_custom_options[pf_meta_field_name][]" value="'.trim($options['pf_meta_field_name'][$i]).'" /></span>';
                    if( !empty($options['pf_meta_field_options'][$i]) ){
                       $model_options_data .='<span><textarea cols="50" rows="3" name="pf_custom_options[pf_meta_field_options][]" >'.trim($options['pf_meta_field_options'][$i]).' </textarea></span>';
                    }else{
                       $model_options_data .='<span><textarea readonly cols="50" rows="3" name="pf_custom_options[pf_meta_field_options][]" ></textarea></span>';
                    }
                   $model_options_data .='<span><input type="text" name="pf_custom_options[pf_option_display_search][]" value="'.trim($options['pf_option_display_search'][$i]).'" /></span>';
                   $model_options_data .=' <a href="#" class="delete"><img src="'.get_template_directory_uri().'/images/delete.png" /></a></li>';
                }  
            }
           $model_options_data .= '</ul>';
           $model_options_data .= '</div>';

            echo $model_options_data;   ?>
                <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes','lavan') ?>" />
                </p>
            </form>
        </div>
        <?php   
    }
    function pf_custom_options_validate($input) {
        $input['pf_meta_field_name'][] = $input['pf_meta_field_name'];
        $input['pf_meta_label_name'][] = $input['pf_meta_label_name'];
        $input['pf_meta_field_options'][] = $input['pf_meta_field_options'];
        return $input;
    }
    function pf_import_option_page(){
    ?>
    <div class="wrap">
        <div id="icon-tools" class="icon32"><br /></div>
       <h2><?php echo ucfirst($this->pf_slug_name).' '; _e('Options Data Import','lavan'); ?> </h2>
        <?php

            if (isset($_FILES['pf_import']) && check_admin_referer('pf-import')) {
                if ($_FILES['pf_import']['error'] > 0) {
                    wp_die("Please Choose Upload json format file");
                }
                else {
                    $encode_options = file_get_contents($_FILES['pf_import']['tmp_name']);
                    $options = json_decode($encode_options, true);
                    print_r($options);
                    $file_name = $_FILES['pf_import']['name']; // Get the name of file
                    $file_ext = strtolower(end(explode(".", $file_name))); // Get extension of file
                    $file_size = $_FILES['pf_import']['size']; // Get size of file
                    if (($file_ext == "json") && ($file_size < 500000)) {
                        $encode_options = file_get_contents($_FILES['pf_import']['tmp_name']);
                        $options = json_decode($encode_options, true);
                        foreach ($options as $key => $value) {
                            update_option($key, $value);
                        }                        
                        echo "<div class='updated'><p>".__('All options are restored successfully','lavan')."</p></div>";
                    }
                    else {
                        echo "<div class='error'><p>".__('Invalid file or file size too big.','lavan')."</p></div>";
                    }
                }
            }
        ?>
        <p><?php _e('Click Browse button and choose a json file that you backup before.','lavan'); ?> </p>
        <p><?php _e('Press Upload File and Import, WordPress do the rest for you.','lavan'); ?></p>
        <form method='post' enctype='multipart/form-data'>
            <p class="submit">
                <?php wp_nonce_field('pf-import'); ?>
                <input type='file' name='pf_import' class="button primary-button"  />
                <input type='submit' name='submit' value='<?php _e("Upload File and Import", 'lavan') ?>' class="button button-primary"/>
            </p>
        </form>
    </div>
    <?php
}
}
$pf_meta_options = new Pf_Custom_Options;
?>