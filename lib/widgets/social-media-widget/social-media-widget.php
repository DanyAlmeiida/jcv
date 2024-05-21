<?php

/**
 * myb Profile Widget
 *
 * Add a neat 'About me' profile section to the sidebar and tell your readers something about yourself. 
 *
 * @package   Profile_Widget
 * @author    MunichParis <contact@munichparis.com>
 * @license   GPL-2.0+
 * @copyright 2019 MunichParis.
 *
 */
 
 // Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

class rachel_Social_Media_Widget extends WP_Widget {
    /**
     *
     * Unique identifier for your widget.
     *
     *
     * The variable name is used as the text domain when internationalizing strings
     * of text. Its value should match the Text Domain file header in the main
     * widget file.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $widget_slug = 'myb-social-media-widget';
	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {
		// load plugin text domain
		add_action( 'init', array( $this, 'rachel' ) );		
		// TODO: update description
		parent::__construct(
			$this->get_widget_slug(),
			__( 'myb Social Media Widget', 'rachel' ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'This widget displays social media icons.', 'rachel' )
			)
		);
		// Register admin styles and scripts
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
		// Refreshing the widget's cached output with each new post
		add_action( 'save_post',    array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	} // end constructor


    /**
     * Return the widget slug.
     *
     * @since    1.0.0
     *
     * @return    Plugin slug variable.
     */
    public function get_widget_slug() {
        return $this->widget_slug;
    }


	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/
	/**
	 * Outputs the content of the widget.
	 *
	 * @param array args  The array of form elements
	 * @param array instance The current instance of the widget
	 */
	public function widget( $args, $instance ) {
	   // Our variables from the widget settings
	   $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Default title', 'rachel' ) : $instance['title'] );
	   $image = ! empty( $instance['image'] ) ? $instance['image'] : '';
	   $description = ! empty( $instance['description'] ) ? $instance['description'] : '';
	   $button_text = ! empty( $instance['button_text'] ) ? $instance['button_text'] : '';
	   $button_link = ! empty( $instance['button_link'] ) ? $instance['button_link'] : '';
	 
	   $before_widget = str_replace('class="', 'class="social-media-widget ', $args["before_widget"]);

	   ob_start();
	   echo $before_widget;
	   
	   ?>

	   <?php 
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>

	   <div class="widget-content">
	 
		   <?php rachel_social_media(); ?>

		</div>
	 
	   <?php
	   echo $args['after_widget'];

	   ob_end_flush();
	}
	
	
	public function flush_widget_cache() {
    	wp_cache_delete( $this->get_widget_slug(), 'widget' );
	}


	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param array new_instance The new instance of values to be generated via the update.
	 * @param array old_instance The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {
	   // $instance = array();
	   $instance = $old_instance;

	   $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

	   return $instance;

	}


	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {
	   $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'rachel' );
	  

	   ?>

	   <p><em>Please set the links to your social media channels in the Customizer to show icons in this widget.</em></p>

	   <!-- Title -->
	   <p>
	      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'rachel' ); ?></label>
	      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	   </p>


	   <?php
	}

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/
	/**
	 * Loads the Widget's text domain for localization and translation.
	 */
	public function rachel() {
		load_plugin_textdomain( 'rachel', false, dirname( plugin_basename( __FILE__ ) ) . 'lang/' );
	} // end widget_textdomain


	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_admin_styles() {
		wp_enqueue_style( $this->get_widget_slug().'-admin-styles', get_template_directory_uri() . '/lib/widgets/profile-widget/css/admin.css' );
	} // end register_admin_styles



	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {
		wp_enqueue_script( $this->get_widget_slug().'-admin-script', get_template_directory_uri() . '/lib/widgets/profile-widget/js/admin.js', array('jquery') );
	} // end register_admin_scripts


} // end class


/*
* Register the widget.
*/
function rachel_load_sm_widget() {
	register_widget( 'rachel_Social_Media_Widget' );
}
add_action( 'widgets_init', 'rachel_load_sm_widget' );


