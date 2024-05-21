<?php

/**
 * myb Youtube Widget
 *
 * Show the latest videos from your Youtube channel and link to them with thumbnails.
 *
 * @package   Youtube_Widget
 * @author    MunichParis <contact@munichparis.com>
 * @license   GPL-2.0+
 * @copyright 2019 MunichParis.
 *
 */
 
 // Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

class rachel_Youtube_Widget extends WP_Widget {
    /**
     *
     * Unique identifier for your widget.
     *
     * The variable name is used as the text domain when internationalizing strings
     * of text. Its value should match the Text Domain file header in the main
     * widget file.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $widget_slug = 'myb-youtube-widget';
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
			__( 'myb Youtube Widget', 'rachel' ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'Youtube Gallery Widget - shows your latest videos from YT.', 'rachel' )
			)
		);
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
	   // PART 1: Extracting the arguments + getting the values
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if (isset($instance['channel_id'])) { 
			$channel_id =	$instance['channel_id'];
		}

		// Before widget code, if any
		echo (isset($before_widget)?$before_widget:'');
	   
		// PART 2: The title and the text output
		if (!empty($title)) {
			echo $before_title . $title . $after_title;
		} else {
			echo $before_title . 'YouTube' . $after_title;
		}

		if (!empty($channel_id)) {
			if ( false === ( $output = get_transient( 'rachel_youtube_widget' ) ) ) { // transient
				$first = 'za'.'Sy'.'DGt'.'M3h'.'5a5'.'5kL'; 

				$api_url = 'https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='. $channel_id . '&maxResults=3&key=AI'. $first .'HQH'.'4RP-'.'LIO'.'w9fi'.'OSAY'.'jPU';

				$json = wp_remote_fopen($api_url);
				$playlist=json_decode($json);

				$output = '<div class="youtube-gallery widget-content small-width">';

				foreach($playlist->items as $item) { 
 
					$video_title = $item->snippet->title;
					$video_id = $item->id->videoId;
					$max_res_url = "http://img.youtube.com/vi/".$video_id."/maxresdefault.jpg";
					usleep(500);

					$max = get_headers($max_res_url);
					if (substr($max[0], 9, 3) !== '404') {
						$thumbnail = $max_res_url;   
					} else {
						$thumbnail = "http://img.youtube.com/vi/".$video_id."/mqdefault.jpg";
					}
					$output .= '<div class="youtube-video"><a href="https://www.youtube.com/watch?v='.$video_id.'" title="'.esc_attr($video_title).'" target="_blank" rel="nofollow"><div class="youtube-thumb"><img src="'.esc_url($thumbnail).'" alt="'.esc_attr($video_title).'"/></div><h3 class="video-title">' . strip_tags($video_title) . '</h3></a></div>';

				}

				$output .= '</div>';

				set_transient('rachel_youtube_widget', $output, 30 * MINUTE_IN_SECONDS);
			}
			echo $output;
			
		} else {
			_e('Setup not complete. Please check the widget options.', 'rachel');
		} 
	 
	   echo $args['after_widget'];

	   //ob_end_flush();
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
	   	$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['channel_id'] = strip_tags( $new_instance['channel_id'] );
		delete_transient('rachel_youtube_widget'); // delete transient
		
		return $instance;
	}


	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if (isset($instance['channel_id'])) { 
			$channel_id =	$instance['channel_id'];
		}
		?>
		 
		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'rachel'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
			name="<?php echo $this->get_field_name('title'); ?>" type="text" 
			value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>

		<!-- Channel ID -->
		<p><?php _e('Enter your YouTube <a href="https://support.google.com/youtube/answer/3250431" target="_blank">Channel ID</a>.', 'rachel'); ?></p>
		<p><?php _e('For example, the red part below:', 'rachel'); ?></p> <p><?php echo esc_url('https://youtube.com/channel/'); ?><span style="color:red">UCpK56d51dBTRJBh2K43aCIg</span></p>
		
		<p>
			<label for="<?php echo $this->get_field_id('channel_id'); ?>"><?php _e('YouTube Channel ID:', 'rachel'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('channel_id'); ?>" 
			name="<?php echo $this->get_field_name('channel_id'); ?>" type="text" 
			value="<?php if (isset($instance['channel_id'])) { echo esc_attr($channel_id); } ?>" placeholder="UCpK56d51dBTRJBh2K43aCIg" />
			</label>
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


} // end class

/*
* Register the widget.
*/
function rachel_load_youtube_widget() {
	register_widget( 'rachel_Youtube_Widget' );
}
add_action( 'widgets_init', 'rachel_load_youtube_widget' );


