<?php
/**
 * Template part for displaying posts [side-magazine & alternating]
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php 
		if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				?><div class="entry-thumbnail">
         		<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('featured-scaled'); ?></a>
         		</div>
         	<?php } ?>
		
	<div class="entry-body">

		<header class="entry-header">
			<?php
			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php rachel_entry_categories(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>

			<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	         	?>
		</header><!-- .entry-header -->

		<div class="entry-content entry-snippet">
			<?php
			the_excerpt( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s<span class="meta-nav">&rarr;</span>', 'rachel' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				// Read More Link
				if(get_theme_mod('rachel_readmore_checkbox', true) == true) {
					echo ' <a href="' . get_permalink( $post->ID ) . '" class="readmore" title="Read More"><button class="btn read-more">' . get_theme_mod('rachel_readmore_text', 'Read more') . '</button></a>';
				}

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rachel' ),
					'after'  => '</div>',
				) );

			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php rachel_entry_footer(); ?>
		</footer>

	</div>	
</article><!-- #post-<?php the_ID(); ?> -->
