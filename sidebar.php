<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package My_Boutique_Theme
 */

$sticky = '';

if(get_theme_mod('rachel_stickysidebar_checkbox', true) == true ) {
	$sticky = 'sticky';
}

?>

<aside id="secondary" class="widget-area <?php echo $sticky ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->


</div><!-- #content -->	
