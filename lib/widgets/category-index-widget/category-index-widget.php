<?php
/**
 * myb Category Index Widget
 *
 * This widget is responsible for showing selected categories and the latest posts from them, loading in an ajax style.
 *
 * @package   Category_Index_Widget
 * @author    MunichParis <contact@munichparis.com>
 * @license   GPL-2.0+
 * @copyright 2019 MunichParis.
 *
 */
 
// Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

class Rachel_Category_Index_Widget extends WP_Widget {
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
    protected $widget_slug = 'myb-category-index-widget';
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
			__( 'myb Catgory Index Widget', 'rachel' ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'Show the latest posts from selected categories.', 'rachel' )
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
	   $number_columns = ! empty( $instance['number_columns'] ) ? $instance['number_columns'] : 4;
	   $type = ! empty( $instance['type'] ) ? $instance['type'] : 'recent';
	   $categories = ! empty( $instance['categories'] ) ? $instance['categories'] : [];
	   $masonry = ! empty( $instance['masonry'] ) ? true : false;
	 
	   $before_widget = str_replace('class="', 'class="posts-widget', $args["before_widget"]);

		   ob_start();
		   echo $before_widget;

		   $masonry_class = $masonry ? 'masonry-container' : '';

		   echo '<div class="widget-content small-width ' . $masonry_class . '">';

		if (!empty($title)) {
		   	echo $args['before_title'] . $title . $args['after_title'];
		}
	   
	   	// Call ajax_categories function
	   	// Call ajax_categories function
	   	if($categories != []) {
	   		if($masonry) {
	   			rachel_ajax_categories('masonry', $number_posts, $number_columns, $categories);
	   		} else {
	   			rachel_ajax_categories('featured-small-landscape', $number_posts, $number_columns, $categories);
	   		}
	   	} else {
	   		echo '<em>' . __('Widget setup not complete. Please add categories to show posts.', 'rachel') . '</em>';
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
	   $instance['categories'] = $new_instance['categories'];
	   $instance['masonry'] = $new_instance['masonry'];
	 
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
	   $number_columns = ! empty ( $instance['number_columns']) ? $instance['number_columns'] : 4;
	   $type = ! empty ( $instance['type'] ) ? esc_attr($instance['type']): 'recent';
	   $categories = ! empty( $instance['categories'] ) ? $instance['categories'] : [];
	   $masonry = ! empty( $instance['masonry'] ) ? 1 : 0;
	  
	   ?>

	   <!-- Title -->
	   <p>
	      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'rachel' ); ?></label>
	      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	   </p>

	   <!-- Category -->
		<p>

			<label for="cat-index-<?php echo $this->id ?>">
				<?php _e( 'Please select the categories from the drop down below that you would like to include in the widget.', 'rachel' ) ?>
				<br/>
				<?php _e( 'After selecting, you can drag them around to choose the order of the category buttons in the widget.', 'rachel' ) ?>
				<br/><br/>
				<?php _e( 'Categories', 'rachel' ); ?>
			</label>

		<?php 
	    $args = array(
	        'name'             => 'cat-index',
	        'show_option_none' => __( "'All Categories'", "love-rachel" ),
	        'show_count'       => 0,
	        'orderby'          => 'name',
	        'echo'             => 0,
	        'class'            => 'widefat cat-index',
	        'id'			   => 'cat-index-' . $this->id
	    );
	    
	    echo wp_dropdown_categories($args); ?>
	    	
	    <ul class="category-selection sortable">

	    <?php if(!empty($categories)) : ?>
	        <?php foreach($categories as $cat) :
	        ?>
	        <li>
	        	<?php if($cat == -1) : ?>
	        		<span class="selected-cat"><span class="cat-name"><?php _e("'All Categories'", "love-rachel"); ?></span><span class="remove dashicons dashicons-no-alt"></span></span>
	        	<?php else : ?>
	        		<span class="selected-cat"><span class="cat-name"><?php echo get_cat_name($cat) ?></span><span class="remove dashicons dashicons-no-alt"></span></span>
	        	<?php endif; ?>
	            <input type="hidden" name="<?php echo $this->get_field_name( 'categories' ) ?>[]" value="<?php echo $cat ?>">
	        </li>

	        <?php endforeach; ?>
	    <?php else: ?>
	    	<li class="no-selection"><em>No categories selected.</em></li>
	    <?php endif;
	    ?> 
		</ul>
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
		<p>
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

		<!-- Masonry Layout -->
		<hr/>
		<p>
	        <input id="<?php echo $this->get_field_id('masonry'); ?>" name="<?php echo $this->get_field_name('masonry'); ?>" type="checkbox" <?php checked( $masonry, 1 ); ?> />
	        <label for="<?php echo $this->get_field_id('masonry'); ?>"><?php _e('Enable Masonry Grid Layout', 'rachel'); ?></label>
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
		wp_enqueue_style( $this->get_widget_slug().'-admin-styles', get_template_directory_uri() . '/lib/widgets/category-index-widget/css/admin.css' );
	} // end register_admin_styles



	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {
		wp_enqueue_script( $this->get_widget_slug().'-admin-script', get_template_directory_uri() . '/lib/widgets/category-index-widget/js/admin.js', array('jquery') );

		// wp_localize_script( $this->get_widget_slug().'-admin-script', 'widget', array('name' => 'widget-myb-category-index-widget[' . substr($this->id, strrpos($this->id, '-') + 1) . '][categories]', 'id' => $this->id) );
	} // end register_admin_scripts


} // end class

/*
* Register the widget.
*/
function rachel_load_ci_widget() {
	register_widget( 'Rachel_Category_Index_Widget' );
}

add_action( 'widgets_init', 'Rachel_load_ci_widget' );


