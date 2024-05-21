<?php

/**
 * myb Thumbnails Widget
 *
 * Shows a row of three thumbnail boxes with customizable images, titles and links. Perfect to link to categories, pages, social media channels or external sites.
 *
 * @package   Thumbnails_Widget
 * @author    MunichParis <contact@munichparis.com>
 * @license   GPL-2.0+
 * @copyright 2019 MunichParis.
 *
 */
 
 // Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

class rachel_Thumbnails_Widget extends WP_Widget {
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
    protected $widget_slug = 'rachel';
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
		
		parent::__construct(
			$this->get_widget_slug(),
			__( 'myb Thumbnails Widget', 'rachel' ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'Show three thumbnail images with links to categories, pages or external sites.', 'rachel' )
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

		// No image variable
		$no_image = get_template_directory_uri() . '/lib/widgets/thumbnails-widget/no-image.PNG';

	   // Our variables from the widget settings
	   $title = ! empty( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
	   
	   $image1 = ! empty( $instance['image-1'] ) ? $instance['image-1'] : $no_image;
	   $button_text1 = ! empty( $instance['button_text-1'] ) ? $instance['button_text-1'] : '';
	   $button_link1 = ! empty( $instance['button_link-1'] ) ? $instance['button_link-1'] : '';
	   $image2 = ! empty( $instance['image-2'] ) ? $instance['image-2'] : $no_image;
	   $button_text2 = ! empty( $instance['button_text-2'] ) ? $instance['button_text-2'] : '';
	   $button_link2 = ! empty( $instance['button_link-2'] ) ? $instance['button_link-2'] : '';
	   $image3 = ! empty( $instance['image-3'] ) ? $instance['image-3'] : $no_image;
	   $button_text3 = ! empty( $instance['button_text-3'] ) ? $instance['button_text-3'] : '';
	   $button_link3 = ! empty( $instance['button_link-3'] ) ? $instance['button_link-3'] : '';
	   $image4 = ! empty( $instance['image-4'] ) ? $instance['image-4'] : $no_image;
	   $button_text4 = ! empty( $instance['button_text-4'] ) ? $instance['button_text-4'] : '';
	   $button_link4 = ! empty( $instance['button_link-4'] ) ? $instance['button_link-4'] : '';
	 
	   $before_widget = str_replace('class="', 'class="posts-widget', $args["before_widget"]);

	   $cols = 3;

	   if($image1 != $no_image && $image2 != $no_image && $image3 != $no_image && $image4 != $no_image) {
	   		$cols = 4;
	   } else if($image3 == $no_image && $image4 == $no_image) {
	   		$cols = 2;
	   } else {
	   		$cols = 1;
	   }
 
	   ob_start();
	   echo $before_widget;

	   echo '<div class="widget-content small-width">';

	   if (!empty($title)) {
	   	echo $args['before_title'] . $title . $args['after_title'];
	   }
	   
	   ?>

	   <div class="thumbnails-row cols-<?php echo $cols ?>">
	   		<?php if($image1 != $no_image): ?>
	   		<div class="thumbnail" style="background-image: url(<?php echo $image1 ?>)">
	   			<a href="<?php echo esc_url($button_link1) ?>">
		   			<?php if($button_text1 != '') : ?>
		   			<span><?php echo $button_text1 ?></span>
		   			<?php endif; ?>
	   			</a>
	   		</div>
	   		<?php endif; ?>

	   		<?php if($image2 != $no_image): ?>
	   		<div class="thumbnail" style="background-image: url(<?php echo $image2 ?>)">
	   			<a href="<?php echo esc_url($button_link2) ?>">
		   			<?php if($button_text2 != '') : ?>
		   			<span><?php echo $button_text2 ?></span>
		   			<?php endif; ?>
	   			</a>
	   		</div>
	   		<?php endif; ?>

	   		<?php if($image3 != $no_image): ?>
	   		<div class="thumbnail" style="background-image: url(<?php echo $image3 ?>)">
	   			<a href="<?php echo esc_url($button_link3) ?>">
		   			<?php if($button_text3 != '') : ?>
		   			<span><?php echo $button_text3 ?></span>
		   			<?php endif; ?>
	   			</a>
	   		</div>
	   		<?php endif; ?>

	   		<?php if($image4 != $no_image): ?>
	   		<div class="thumbnail" style="background-image: url(<?php echo $image4 ?>)">
	   			<a href="<?php echo esc_url($button_link4) ?>">
		   			<?php if($button_text4 != '') : ?>
		   			<span><?php echo $button_text4 ?></span>
		   			<?php endif; ?>
	   			</a>
	   		</div>
	   		<?php endif; ?>
	   </div>

	   <?php

	   echo '</div>';

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
	   
	   $instance['image-1'] = ( ! empty( $new_instance['image-1'] ) ) ? $new_instance['image-1'] : '';
	   $instance['button_text-1'] =  strip_tags($new_instance['button_text-1']);
	   $instance['button_link-1'] = strip_tags($new_instance['button_link-1']);

	   $instance['image-2'] = ( ! empty( $new_instance['image-2'] ) ) ? $new_instance['image-2'] : '';
	   $instance['button_text-2'] =  strip_tags($new_instance['button_text-2']);
	   $instance['button_link-2'] = strip_tags($new_instance['button_link-2']);

	   $instance['image-3'] = ( ! empty( $new_instance['image-3'] ) ) ? $new_instance['image-3'] : '';
	   $instance['button_text-3'] =  strip_tags($new_instance['button_text-3']);
	   $instance['button_link-3'] = strip_tags($new_instance['button_link-3']);

	   $instance['image-4'] = ( ! empty( $new_instance['image-4'] ) ) ? $new_instance['image-4'] : '';
	   $instance['button_text-4'] =  strip_tags($new_instance['button_text-4']);
	   $instance['button_link-4'] = strip_tags($new_instance['button_link-4']);

	   // Save instance of TinyMCE editor
	   $rand1 = ( ! empty( $new_instance['the_random_number1'] ) ) ? (int) $new_instance['the_random_number1'] : 0;

	   $instance['the_random_number1'] = $rand1;
	   $instance[ 'wp_editor_' . $rand1 ] = $new_instance[ 'wp_editor_' . $rand1 ];
	 
	   return $instance;

	}


	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {
	   $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'rachel' );

	   $image1 = ! empty( $instance['image-1'] ) ? $instance['image-1'] : get_template_directory_uri() . '/lib/widgets/thumbnails-widget/no-image.PNG';
	   $image2 = ! empty( $instance['image-2'] ) ? $instance['image-2'] : get_template_directory_uri() . '/lib/widgets/thumbnails-widget/no-image.PNG';
	   $image3 = ! empty( $instance['image-3'] ) ? $instance['image-3'] : get_template_directory_uri() . '/lib/widgets/thumbnails-widget/no-image.PNG';
	   $image4 = ! empty( $instance['image-4'] ) ? $instance['image-4'] : get_template_directory_uri() . '/lib/widgets/thumbnails-widget/no-image.PNG';

	   $button_link1 = ! empty ( $instance['button_link-1'] ) ? esc_url($instance['button_link-1']): '';
	   $button_text1 = ! empty( $instance['button_text-1'] ) ? esc_attr($instance['button_text-1']) : '';

	   $button_link2 = ! empty ( $instance['button_link-2'] ) ? esc_url($instance['button_link-2']): '';
	   $button_text2 = ! empty( $instance['button_text-2'] ) ? esc_attr($instance['button_text-2']) : '';

	   $button_link3 = ! empty ( $instance['button_link-3'] ) ? esc_url($instance['button_link-3']): '';
	   $button_text3 = ! empty( $instance['button_text-3'] ) ? esc_attr($instance['button_text-3']) : '';

	   $button_link4 = ! empty ( $instance['button_link-4'] ) ? esc_url($instance['button_link-4']): '';
	   $button_text4 = ! empty( $instance['button_text-4'] ) ? esc_attr($instance['button_text-4']) : '';

	   $rand1 = ! empty( $instance['the_random_number1'] ) ? (int) $instance['the_random_number1'] : 0;
	   $editor_content1 = ! empty( $instance[ 'wp_editor_' . $rand1 ] ) ? $instance[ 'wp_editor_' . $rand1 ] : 'Hello World';
	  
	   ?>

	   <!-- Title -->
	   <p>
	      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'rachel' ); ?></label>
	      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	   </p>

	   <hr/>

	   	<div class="toggle-content">
		   	<h3>Thumbnail 1</h3>
		   	<span class="dashicons dashicons-arrow-down"></span>
		</div>
	   <div class="toggle thumbnail-1">
	   	
		  <!-- Image 1 -->
		   <p>
		      <label for="<?php echo $this->get_field_id( 'image-1' ); ?>"><?php _e( 'Image 1:', 'rachel' ); ?></label>
		      <!-- -->
		      <img src="<?php echo esc_url( $image1 ); ?>" class="preview">
		      <input class="widefat selection" id="<?php echo $this->get_field_id( 'image-1' ); ?>" name="<?php echo $this->get_field_name( 'image-1' ); ?>" type="text" value="<?php echo $image1 ?>" />
		      <button class="upload_image button button-primary">Upload Image</button>
		   </p>

		   <!-- Button Text 1 -->
		   <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'button_text-1' ) ); ?>">
					<?php esc_html_e( 'Button 1 Text:', 'rachel' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id( 'button_text-1' ) ?>"
			       name="<?php echo $this->get_field_name( 'button_text-1' ) ?>"
			       value="<?php echo $button_text1 ?>"
			       type="text"
			       class="widefat"
			/>
			</p>

			<!-- Button Link 1 -->
			<p>
				<label for="<?php echo $this->get_field_id( 'button_link-1' ) ?>">
					<?php esc_html_e( 'Button 1 Link:', 'rachel' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id( 'button_link-1' ) ?>"
			       name="<?php echo $this->get_field_name( 'button_link-1' ) ?>"
			       value="<?php echo $button_link1 ?>"
			       type="text"
			       class="widefat"
			/>
			</p>

	   </div>


		<hr/>

		<div class="toggle-content">
		   	<h3>Thumbnail 2</h3>
		   	<span class="dashicons dashicons-arrow-down"></span>
		</div>
	   <div class="toggle thumbnail-2">


			<!-- Image 2 -->
		   <p>
		      <label for="<?php echo $this->get_field_id( 'image-2' ); ?>"><?php _e( 'Image 2:', 'rachel' ); ?></label>
		      <!-- -->
		      <img src="<?php echo esc_url( $image2 ); ?>" class="preview">
		      <input class="widefat selection" id="<?php echo $this->get_field_id( 'image-2' ); ?>" name="<?php echo $this->get_field_name( 'image-2' ); ?>" type="text" value="<?php echo $image2 ?>" />
		      <button class="upload_image button button-primary">Upload Image</button>
		   </p>

		   <!-- Button Text 2 -->
		   <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'button_text-2' ) ); ?>">
					<?php esc_html_e( 'Button 2 Text:', 'rachel' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id( 'button_text-2' ) ?>"
			       name="<?php echo $this->get_field_name( 'button_text-2' ) ?>"
			       value="<?php echo $button_text2 ?>"
			       type="text"
			       class="widefat"
			/>
			</p>

			<!-- Button Link 2 -->
			<p>
				<label for="<?php echo $this->get_field_id( 'button_link-2' ) ?>">
					<?php esc_html_e( 'Button 2 Link:', 'rachel' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id( 'button_link-2' ) ?>"
			       name="<?php echo $this->get_field_name( 'button_link-2' ) ?>"
			       value="<?php echo $button_link2 ?>"
			       type="text"
			       class="widefat"
			/>
			</p>
		</div>

		<hr/>

		<div class="toggle-content">
		   	<h3>Thumbnail 3</h3>
		   	<span class="dashicons dashicons-arrow-down"></span>
		</div>

	   <div class="toggle thumbnail-3">

			<!-- Image 3 -->
		   <p>
		      <label for="<?php echo $this->get_field_id( 'image-3' ); ?>"><?php _e( 'Image 3:', 'rachel' ); ?></label>
		      <!-- -->
		      <img src="<?php echo esc_url( $image3 ); ?>" class="preview">
		      <input class="widefat selection" id="<?php echo $this->get_field_id( 'image-3' ); ?>" name="<?php echo $this->get_field_name( 'image-3' ); ?>" type="text" value="<?php echo $image3 ?>" />
		      <button class="upload_image button button-primary">Upload Image</button>
		   </p>

		   <!-- Button Text 3 -->
		   <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'button_text-3' ) ); ?>">
					<?php esc_html_e( 'Button 3 Text:', 'rachel' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id( 'button_text-3' ) ?>"
			       name="<?php echo $this->get_field_name( 'button_text-3' ) ?>"
			       value="<?php echo $button_text3 ?>"
			       type="text"
			       class="widefat"
			/>
			</p>

			<!-- Button Link 3 -->
			<p>
				<label for="<?php echo $this->get_field_id( 'button_link-3' ) ?>">
					<?php esc_html_e( 'Button 3 Link:', 'rachel' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id( 'button_link-3' ) ?>"
			       name="<?php echo $this->get_field_name( 'button_link-3' ) ?>"
			       value="<?php echo $button_link3 ?>"
			       type="text"
			       class="widefat"
			/>
			</p>
		</div>

		<hr/>

		<div class="toggle-content">
		   	<h3>Thumbnail 4</h3>
		   	<span class="dashicons dashicons-arrow-down"></span>
		</div>
	   <div class="toggle thumbnail-4">


			<!-- Image 4 -->
		   <p>
		      <label for="<?php echo $this->get_field_id( 'image-4' ); ?>"><?php _e( 'Image 4:', 'rachel' ); ?></label>
		      <!-- -->
		      <img src="<?php echo esc_url( $image4 ); ?>" class="preview">
		      <input class="widefat selection" id="<?php echo $this->get_field_id( 'image-4' ); ?>" name="<?php echo $this->get_field_name( 'image-4' ); ?>" type="text" value="<?php echo $image4 ?>" />
		      <button class="upload_image button button-primary">Upload Image</button>
		   </p>

		   <!-- Button Text 4 -->
		   <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'button_text-4' ) ); ?>">
					<?php esc_html_e( 'Button 4 Text:', 'rachel' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id( 'button_text-4' ) ?>"
			       name="<?php echo $this->get_field_name( 'button_text-4' ) ?>"
			       value="<?php echo $button_text4 ?>"
			       type="text"
			       class="widefat"
			/>
			</p>

			<!-- Button Link 4 -->
			<p>
				<label for="<?php echo $this->get_field_id( 'button_link-4' ) ?>">
					<?php esc_html_e( 'Button 4 Link:', 'rachel' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id( 'button_link-4' ) ?>"
			       name="<?php echo $this->get_field_name( 'button_link-4' ) ?>"
			       value="<?php echo $button_link4 ?>"
			       type="text"
			       class="widefat"
			/>
			</p>
		</div>

	   <?php
	}

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/
	/**
	 * Loads the Widget's text domain for localization and translation.
	 */
	public function rachel() {
		// TODO be sure to change 'love-rachel-thumbnails-widget' to the name of *your* plugin
		load_plugin_textdomain( $this->get_widget_slug(), false, dirname( plugin_basename( __FILE__ ) ) . 'lang/' );
	} // end widget_textdomain


	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_admin_styles() {
		wp_enqueue_style( $this->get_widget_slug().'-admin-styles', get_template_directory_uri() . '/lib/widgets/thumbnails-widget/css/admin.css' );
	} // end register_admin_styles



	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {
		wp_enqueue_script( $this->get_widget_slug().'-admin-script', get_template_directory_uri() . '/lib/widgets/thumbnails-widget/js/admin.js', array('jquery') );
	} // end register_admin_scripts


} // end class

/*
* Register the widget.
*/
function rachel_load_thumbnails_widget() {
	register_widget( 'rachel_Thumbnails_Widget' );
}
add_action( 'widgets_init', 'rachel_load_thumbnails_widget' );


