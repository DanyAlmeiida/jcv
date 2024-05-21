<?php 

/*
* Require necessary customizer functionality.
*/
require_once( get_template_directory() . '/lib/customizer/customizer-featured-boxes.php' );


/**
* Shows featured boxes on top of homepage
*/
function rachel_featured_boxes() {

	$featuredBoxes = array(
		'box1' => 'Featured Box 1',
		'box2' => 'Featured Box 2',
		'box3' => 'Featured Box 3',
	);	

	$featured_image1 = get_theme_mod('rachel_featured_box1_image');
	$featured_image2 = get_theme_mod('rachel_featured_box2_image');
	$featured_image3 = get_theme_mod('rachel_featured_box3_image');
	$featured_title = get_theme_mod('rachel_featured_box_title');

	if(!empty($featured_image1) || !empty($featured_image2) || !empty($featured_image3)) { ?>

		<div class="featured-boxes">

			<?php 
			if(!empty($featured_title)) {
				echo '<h2>' . get_theme_mod('rachel_featured_box_title') . '</h2>';
			}
			?>

			<?php
			foreach($featuredBoxes as $key => $box) {

				$key_image = get_theme_mod('rachel_featured_' . $key . '_image');

				if(!empty($key_image)) {
					?>
					<div class="box" style="background-image: url(<?php echo get_theme_mod( 'rachel_featured_' . $key . '_image' ); ?>)">
						<a href="<?php echo esc_url(get_theme_mod('rachel_featured_' . $key . '_link'))?>"><h3 class="box-title"><?php echo get_theme_mod('rachel_featured_' . $key . '_title')?></h3></a>
					</div>
					<?php
				}

			} ?>
		</div>
		<?php
	}
}
