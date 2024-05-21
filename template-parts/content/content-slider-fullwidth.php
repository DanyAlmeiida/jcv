<?php
/**
 * Template part for displaying the slider posts [fullwidth]
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */


$show_overlay = get_theme_mod('rachel_featured_overlay_checkbox', true);
?>

<article <?php post_class('slider-fullwidth'); ?>>
	<?php
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				?><div class="entry-thumbnail">
         		<?php the_post_thumbnail('featured-fullwidth'); ?>
         		</div>
         	<?php } 
         ?>

    <?php if($show_overlay) : ?>
	<header class="entry-header">
		<?php

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php rachel_entry_categories(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	
		<?php
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		?>

		<div class="post-date">
			<?php rachel_posted_on(); ?>
		</div>

	</header><!-- .entry-header -->
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
