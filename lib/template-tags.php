<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package My_Boutique_Theme
 */

if ( ! function_exists( 'rachel_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function rachel_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'rachel' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		// $byline = sprintf(
		// 	/* translators: %s: post author. */
		// 	esc_html_x( 'by %s', 'post author', 'rachel' ),
		// 	'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		// );

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'rachel_entry_categories' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function rachel_entry_categories() {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'rachel' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( '%1$s', 'rachel' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
	}
endif;

if ( ! function_exists( 'rachel_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function rachel_entry_footer() {
		// Share functionality
		rachel_share_buttons();

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() && is_single() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'rachel' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged: %1$s', 'rachel' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'rachel' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'rachel' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'rachel_social_media' ) ) :
	/**
	 * Prints social media icons with links set in the customizer
	 */
	function rachel_social_media() {
		?>
		<div class="social-media-icons">

			<?php if(get_theme_mod('facebook_link')) : ?><a href="<?php echo esc_url( get_theme_mod('facebook_link') ); ?>" target="_blank"><i class="icon-facebook"></i></a><?php endif; ?>

			<?php if(get_theme_mod('instagram_link')) : ?><a href="<?php echo esc_url( get_theme_mod('instagram_link') ); ?>" target="_blank"><i class="icon-instagram"></i></a><?php endif; ?>

			<?php if(get_theme_mod('twitter_link')) : ?><a href="<?php echo esc_url( get_theme_mod('twitter_link') ); ?>" target="_blank"><i class="icon-twitter"></i></a><?php endif; ?>
				
			<?php if(get_theme_mod('pinterest_link')) : ?><a href="<?php echo esc_url( get_theme_mod('pinterest_link') ); ?>" target="_blank"><i class="icon-pinterest"></i></a><?php endif; ?>
				
			<?php if(get_theme_mod('bloglovin_link')) : ?><a href="<?php echo esc_url( get_theme_mod('bloglovin_link') ); ?>" target="_blank"><i class="icon-heart"></i></a><?php endif; ?>

			<?php if(get_theme_mod('youtube_link')) : ?><a href="<?php echo esc_url( get_theme_mod('youtube_link') ); ?>" target="_blank"><i class="icon-youtube"></i></a><?php endif; ?>

			<?php if(get_theme_mod('vimeo_link')) : ?><a href="<?php echo esc_url( get_theme_mod('vimeo_link') ); ?>" target="_blank"><i class="icon-vimeo"></i></a><?php endif; ?>

			<?php if(get_theme_mod('rss_link')) : ?><a href="<?php echo esc_url( get_theme_mod('rss_link') ); ?>" target="_blank"><i class="icon-rss"></i></a><?php endif; ?>

			<?php if(get_theme_mod('linkedin_link')) : ?><a href="<?php echo esc_url( get_theme_mod('linkedin_link') ); ?>" target="_blank"><i class="icon-linkedin"></i></a><?php endif; ?>

			<?php if(get_theme_mod('soundcloud_link')) : ?><a href="<?php echo esc_url( get_theme_mod('soundcloud_link') ); ?>" target="_blank"><i class="icon-soundcloud"></i></a><?php endif; ?>

			<?php if(get_theme_mod('dribble_link')) : ?><a href="<?php echo esc_url( get_theme_mod('dribble_link') ); ?>" target="_blank"><i class="icon-dribbble"></i></a><?php endif; ?>
				
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'rachel_related_posts_tags' ) ) :
	/**
	 * Shows related Posts by tags
	 */
	function rachel_related_posts_tags() {
	    global $post;
	    $orig_post = $post;
	    
	    $tags = wp_get_post_tags($post->ID);

	    $number_posts = get_theme_mod('rachel_related_number', 3);
	    
	    if ($tags) {
	    	$tag_ids = array();
	    	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
			
			$tags_args = array(
				'tag__in' => $tag_ids,
				'post__not_in' => array($post->ID),
				'posts_per_page' => $number_posts, // Number of related posts that will be shown.
				'ignore_sticky_posts' => 1
			);

			?>
			<div id="related-posts"><h3 class="related-title"><span><?php echo get_theme_mod('rachel_related_headline', 'Related Posts');?></span></h3>
				<div class="featured-row col-<?php echo $number_posts?>">
				    
				<?php
			    // Custom WP Query
			   	rachel_custom_query($tags_args, 'featured-small');
			    ?>

	    		</div>
		    </div>
		    <?php
	    	
	    }
	}
endif;

if ( ! function_exists( 'rachel_related_posts_categories' ) ) :
	/**
	 * Shows related Posts by categories
	 */
	function rachel_related_posts_categories() {
			global $post;
		    $orig_post = $post;
		    
		    $categories = get_the_category($post->ID);

		    $number_posts = get_theme_mod('rachel_related_number', 3);
		    
		    if ($categories) {
		    	$category_ids = array();
		    	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

		    	$related_args = array(
				    'category__in' => $category_ids,
				    'post__not_in' => array($post->ID),
				    'posts_per_page'=> $number_posts, // Number of related posts that will be shown
				    'ignore_sticky_posts'=> 1
			    );

		    	?>
				    <div id="related-posts"><h3 class="related-title"><span><?php echo get_theme_mod('rachel_related_headline', 'Related Posts');?></span></h3>
				    	<div class="featured-row col-<?php echo $number_posts?>">
				    <?php
			        // Custom WP Query
			        rachel_custom_query($related_args, 'featured-small');
			        ?>

	    				</div>
		    		</div>
		    	<?php
		    }
		}
endif;

if ( ! function_exists( 'rachel_share_buttons' ) ) :
	/**
	 * Shows social share buttons
	 */
	function rachel_share_buttons() {
		?>
		<div class="share social-media-widget">
			<h4><?php _e('Share this Post', 'rachel'); ?></h4>
			<a href="mailto:?subject=<?php the_title();?>&amp;body=<?php the_permalink() ?>" target="_blank" title="Send this article to a friend!"><i class="icon-envelope"></i></a>
			<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" title="Share on Facebook." target="_blank"><i class="icon-facebook"></i></a>
			<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo get_the_post_thumbnail_url() ?>" target="_blank"><i class="icon-pinterest"></i></a>
			<a href="https://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" title="Tweet this!"><i class="icon-twitter" target="_blank"></i></a>
		</div>
	<?php
	}
endif;



if ( ! function_exists( 'rachel_custom_query' ) ) :
	/**
	 * Simple custom WP Query Function
	 */
	function rachel_custom_query($args, $template) {
		// Define query args
		$my_args = $args;

		// Initialise new WP_query
	    $my_query = new wp_query( $my_args );
	    
	    // Go through all posts
	    if( $my_query->have_posts() ) :
		    while( $my_query->have_posts() ): $my_query->the_post();
		    	// Insert the specific content template
			    get_template_part( 'template-parts/content/content', $template );
			endwhile;
		else:
			echo 'No posts found.';
		endif;

		// Reset query
		wp_reset_query();
	}
endif;
