<?php
/*
* Add custom options to all registered widgets
*/
function rachel_in_widget_form($t,$return,$instance) {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'width' => false) );

    if ( !isset($instance['color']) )
        $instance['color'] = null;
    ?>
    <div class="widget-options" style="background-color: #f7f7f5; padding: 1.5em; margin-bottom: 1em;">
	    <p>
	        <input id="<?php echo $t->get_field_id('width'); ?>" name="<?php echo $t->get_field_name('width'); ?>" type="checkbox" <?php checked(isset($instance['width']) ? $instance['width'] : 0); ?> />
	        <label for="<?php echo $t->get_field_id('width'); ?>"><?php _e('Add a background color to the widget', 'rachel'); ?></label>
	    </p>
	   
	</div>
    
    <?php
    $retrun = null;

    return array($t,$return,$instance);
}

function rachel_in_widget_form_update($instance, $new_instance, $old_instance) {
    $instance['width'] = isset($new_instance['width']);
    $instance['color'] = strip_tags($new_instance['color']);
    return $instance;
}

function rachel_dynamic_sidebar_params($params) {
    global $wp_registered_widgets;
    $widget_id = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];
    if (isset($widget_opt[$widget_num]['width'])){
    	if($widget_opt[$widget_num]['width']) {
            $class = ' fullwidth ';

            $params[0]['before_widget'] = preg_replace('/class="/', 'class=" ' . $class . ' ',  $params[0]['before_widget'], 1);
        } else {
        	$params[0]['before_widget'] = preg_replace('/class="/', 'class=" ',  $params[0]['before_widget'], 1);
        }
    }
    return $params;
}


//Add input fields(priority 5, 3 parameters)
add_action('in_widget_form', 'rachel_in_widget_form',5,3);
//Callback function for options update (priorität 5, 3 parameters)
add_filter('widget_update_callback', 'rachel_in_widget_form_update',5,3);
//add class names (default priority, one parameter)
add_filter('dynamic_sidebar_params', 'rachel_dynamic_sidebar_params');