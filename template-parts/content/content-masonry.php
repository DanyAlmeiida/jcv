<?php
/**
 * Template part for displaying featrued small posts [Masonry] 
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */

?>

<article <?php post_class(); ?>>
	<?php
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				?><div class="entry-thumbnail">
         		<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('featured-scaled'); ?></a>
         		</div>
         	<?php } 
         ?>
	<header class="entry-header">
		<?php

			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php rachel_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>

	</header><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->
