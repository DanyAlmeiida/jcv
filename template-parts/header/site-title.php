<header id="masthead" class="site-header">
			<div class="site-branding">
			<?php
				$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
				if( has_header_image() ) :
			?>
				<<?php echo $heading_tag; ?> class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php the_header_image_tag(); ?>
					</a>
				</<?php echo $heading_tag; ?>>
				<!-- Site Description -->
				<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( ($description || is_customize_preview()) && get_theme_mod('rachel_description_header_image_checkbox', TRUE) ) : ?>
						<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			<?php else : ?>
				<<?php echo $heading_tag; ?> class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</<?php echo $heading_tag; ?>>
				<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php endif; 
			endif; ?>

			</div><!-- .site-branding -->

		</header><!-- #masthead -->