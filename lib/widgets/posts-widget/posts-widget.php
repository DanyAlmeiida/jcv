<?php
/**
 * myb Posts Widget
 *
 * This widget is responsible for showing either latest or popular posts, from a soecific category or all categories.
 *
 * @package   Posts_Widget
 * @author    MunichParis <contact@munichparis.com>
 * @license   GPL-2.0+
 * @copyright 2019 MunichParis.
 *
 */
 
// Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

class rachel_Posts_Widget extends WP_Widget {
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
    protected $widget_slug = 'myb-posts-widget';
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
		// Widget description
		parent::__construct(
			$this->get_widget_slug(),
			__( 'myb Posts Widget', 'rachel' ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'Show featured posts in different theme locations.', 'rachel' )
			)
		);
		// Register admin styles and scripts
		// add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		// add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
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
     * @return    Theme slug variable.
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
	   $title = ! empty( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
	   $number_posts = ! empty( $instance['number_posts'] ) ? $instance['number_posts'] : 4;
	   $number_columns = ! empty( $instance['number_columns'] ) ? $instance['number_columns'] : 1;
	   $type = ! empty( $instance['type'] ) ? $instance['type'] : 'recent';
	   $category = ! empty( $instance['category'] ) ? $instance['category'] : '';
	   $carousel = ! empty( $instance['carousel'] ) ? true : false;
	 
	   $before_widget = str_replace('class="', 'class="posts-widget', $args["before_widget"]);

	   ob_start();
	   echo $before_widget;

	   echo '<div class="widget-content small-width">';

	   if (!empty($title)) {
	   	echo $args['before_title'] . $title . $args['after_title'];
	   }

	   // Category Description
	   echo '<div class="category-description">' . category_description( $category ) . '</div>';

	   $cat_slug = get_cat_name( $category );
	   
	   
	   if($carousel == 1) {
	   		if($type == 'recent') {
	   	
		   		rachel_featured_row('featured-small', $number_posts, $cat_slug, $number_columns, true);

		  	} else if ($type == 'popular') {

		  		rachel_popular_carousel('featured-small', $number_posts, $cat_slug, $number_columns, true );

		  	} 
	   } else {
		   	if($type == 'recent') {
		   	
		   		rachel_featured_grid('featured-small', $number_posts, $cat_slug, $number_columns);

		  	} else if ($type == 'popular') {

		  		rachel_popular_grid('featured-small', $number_posts, $cat_slug, $number_columns );

		  	} 
	   }
	   

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
	   $instance['number_posts'] =  strip_tags($new_instance['number_posts']);
	   $instance['number_columns'] =  strip_tags($new_instance['number_columns']);
	   $instance['type'] =  strip_tags($new_instance['type']);
	   $instance['category'] = strip_tags($new_instance['category']);
	   $instance['carousel'] = $new_instance['carousel'];
	 
	   return $instance;

	}


	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {
	   $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'rachel' );

	   $number_posts = ! empty ( $instance['number_posts']) ? $instance['number_posts'] : 4;
	   $number_columns = ! empty ( $instance['number_columns']) ? $instance['number_columns'] : 1;
	   $type = ! empty ( $instance['type'] ) ? esc_attr($instance['type']): 'recent';
	   $category = ! empty( $instance['category'] ) ? esc_attr($instance['category']) : '';
	   $carousel = ! empty( $instance['carousel'] ) ? 1 : 0;
	  
	   ?>

	   <!-- Title -->
	   <p>
	      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'rachel' ); ?></label>
	      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	   </p>


	   <!-- Type of posts -->
	   <p>
			<label for="<?php echo $this->get_field_id( 'type' ) ?>">
				<?php _e( 'Which kind of posts would you like to show?', 'rachel' ); ?>
			</label>
			
			<select class="widefat" id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">

               <option value="recent" <?php selected( $type, 'recent');?>><?php _e( 'Recent Posts', 'rachel' ); ?></option>
               <option value="popular" <?php selected( $type, 'popular');?>><?php _e( 'Popular Posts', 'rachel' ); ?></option>

            </select>

		</p>

	   <!-- Category -->
		<p>

			<label for="<?php echo $this->get_field_id( 'type' ) ?>">
				<?php _e( 'Category', 'rachel' ); ?>
			</label>

		<?php 
	    $args = array(
	        'name'             => $this->get_field_name('category'),
	        'show_option_none' => __( 'All Categories', 'rachel' ),
	        'show_count'       => 0,
	        'orderby'          => 'name',
	        'echo'             => 0,
	        'selected'         => $category,
	        'class'            => 'widefat'
	    );
	    
	    echo wp_dropdown_categories($args);

        ?>

        <span><em>Hint: If you decide to show posts from a specific category you can now display the category description. Go to Posts > Categories and add a description to show it in the widget.</em></span>
    </p>

		<!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number_posts' ) ?>">
				<?php esc_html_e( 'Number of Posts to show', 'rachel' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'number_posts' ) ?>"
		       name="<?php echo $this->get_field_name( 'number_posts' ) ?>"
		       value="<?php echo $number_posts ?>"
		       type="number"
		       class="widefat"
		/>
		</p>

		<!-- Number of columns -->
		<p class="columns-input">
			<label for="<?php echo $this->get_field_id( 'number_columns' ) ?>">
				<?php esc_html_e( 'Number of Columns', 'rachel' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'number_columns' ) ?>"
		       name="<?php echo $this->get_field_name( 'number_columns' ) ?>"
		       value="<?php echo $number_columns ?>"
		       type="number"
		       class="widefat"
		       max="8"
		/>
		</p>

		<!-- Make it a carousel -->
		<hr/>
		<p class="carousel-option">
	        <input id="<?php echo $this->get_field_id('carousel'); ?>" name="<?php echo $this->get_field_name('carousel'); ?>" type="checkbox" <?php checked( $carousel, 1 ); ?> />
	        <label for="<?php echo $this->get_field_id('carousel'); ?>"><?php _e('Make this widget a carousel', 'rachel'); ?></label>
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
		// TODO be sure to change 'love-rachel-profile-widget' to the name of *your* plugin
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
function rachel_load_posts_widget() {
	register_widget( 'rachel_Posts_Widget' );
}

add_action( 'widgets_init', 'rachel_load_posts_widget' );


