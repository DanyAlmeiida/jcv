<?php
/**
 * myboutique Admin Menu Functionality
 *
 * @package myboutique
 */


if ( !class_exists('rachel_Custom_Nav')) {
    class rachel_Custom_Nav {
        public function add_nav_menu_meta_boxes() {
        	add_meta_box(
        		'rachel_menu_items',
        		__('Vida Menu Items', 'rachel'),
        		array( $this, 'nav_menu_link'),
        		'nav-menus',
        		'side',
        		'low'
        	);
        }
        
        public function nav_menu_link() {
        	$search_icon = "<i class='icon-search-bold search-icon'></i>";
        	$newsletter_icon = "<i class='icon-envelope'></i>";

        	?>
        	<div id="posttype-wl-login" class="posttypediv">
        		<div id="tabs-panel-wishlist-login" class="tabs-panel tabs-panel-active">
        			<ul id ="wishlist-login-checklist" class="categorychecklist form-no-clear">
        				<li>
        					<label class="menu-item-title">
        						<input type="checkbox" class="menu-item-checkbox" name="menu-item[11][menu-item-object-id]" value="3"><?php echo $newsletter_icon . 'Newsletter Popup'; ?>
        					</label>
        					<label class="menu-item-title">
        						<input type="checkbox" class="menu-item-checkbox" name="menu-item[33][menu-item-object-id]" value="3"><?php echo $search_icon . 'Search'; ?>
        					</label>
        					<input type="hidden" class="menu-item-type" name="menu-item[11][menu-item-type]" value="custom">
        					<input type="hidden" class="menu-item-title" name="menu-item[11][menu-item-title]" value="<?php echo $newsletter_icon ?>">
        					<input type="hidden" class="menu-item-url" name="menu-item[11][menu-item-url]" value="#">
        					<input type="hidden" class="menu-item-classes" name="menu-item[11][menu-item-classes]" value="newsletter-popup mbt-item">

        					<input type="hidden" class="menu-item-type" name="menu-item[33][menu-item-type]" value="custom">
        					<input type="hidden" class="menu-item-title" name="menu-item[33][menu-item-title]" value="<?php echo $search_icon ?>">
        					<input type="hidden" class="menu-item-url" name="menu-item[33][menu-item-url]" value="">
        					<input type="hidden" class="menu-item-classes" name="menu-item[33][menu-item-classes]" value="mbt-item">
        				</li>
        			</ul>
        		</div>
        		<p class="button-controls">
        			<span class="list-controls">
        				<a href="/wordpress/wp-admin/nav-menus.php?page-tab=all&amp;selectall=1#posttype-page" class="select-all">Select All</a>
        			</span>
        			<span class="add-to-menu">
        				<input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-post-type-menu-item" id="submit-posttype-wl-login">
        				<span class="spinner"></span>
        			</span>
        		</p>
        	</div>
        <?php }
    }
}
$custom_nav = new rachel_Custom_Nav;
// add_action('admin_init', array($custom_nav, 'add_nav_menu_meta_boxes'));



/**
 * Add menu meta box
 *
 * @param object $object The meta box object
 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
 */
function rachel_custom_add_menu_meta_box( $object ) {
	add_meta_box( 'love-rachel-custom-menu-metabox', __( 'Social Media Icons', 'rachel' ), 'rachel_custom_menu_meta_box', 'nav-menus', 'side', 'default' );
	return $object;
}
add_filter( 'nav_menu_meta_box_object', 'rachel_custom_add_menu_meta_box', 10, 1);
/**
 * Displays a metabox for authors menu item.
 *
 * @global int|string $nav_menu_selected_id (id, name or slug) of the currently-selected menu
 *
 * @link https://core.trac.wordpress.org/browser/tags/4.5/src/wp-admin/includes/nav-menu.php
 * @link https://core.trac.wordpress.org/browser/tags/4.5/src/wp-admin/includes/class-walker-nav-menu-edit.php
 * @link https://core.trac.wordpress.org/browser/tags/4.5/src/wp-admin/includes/class-walker-nav-menu-checklist.php
 */
function rachel_custom_menu_meta_box(){
	global $nav_menu_selected_id;
	$walker = new Walker_Nav_Menu_Checklist();
	
	$current_tab = 'all';
	//$authors = get_users( array( 'orderby' => 'nicename', 'order' => 'ASC', 'who' => 'authors' ) );
	//$admins = array();
	// if ( isset( $_REQUEST['authorarchive-tab'] ) && 'admins' == $_REQUEST['authorarchive-tab'] ) {
	// 	$current_tab = 'admins';
	// }elseif ( isset( $_REQUEST['authorarchive-tab'] ) && 'all' == $_REQUEST['authorarchive-tab'] ) {
	// 	$current_tab = 'all';
	// }

	$icons = array(
		(object) array( 
			'url' => get_theme_mod('instagram_link', 'https://instagram.com'),
			'title' => "<i class='icon-instagram'></i>",
			'menu_title' => 'Instagram'
		),
		(object) array(
			'url' => get_theme_mod('facebook_link', 'https://facebook.com'),
			'title' => "<i class='icon-facebook'></i>",
			'menu_title' => 'Facebook'
		), 
		(object) array(
			'url' => get_theme_mod('twitter_link', 'https://twitter.com'),
			'title' => "<i class='icon-twitter'></i>",
			'menu_title' => 'Twitter'
		), 
		(object) array(
			'url' => get_theme_mod('bloglovin_link', 'https://bloglovin.com'),
			'title' => "<i class='icon-heart'></i>",
			'menu_title' => 'Bloglovin'
		), 
		(object) array(
			'url' => get_theme_mod('pinterest_link', 'https://pinterest.com'),
			'title' => "<i class='icon-pinterest'></i>",
			'menu_title' => 'Pinterest'
		), 
		(object) array(
			'url' => get_theme_mod('youtube_link', 'https://youtube.com'),
			'title' => "<i class='icon-youtube'></i>",
			'menu_title' => 'Youtube'
		), 
		(object) array(
			'url' => get_theme_mod('snapchat_link', 'https://snapchat.com'),
			'title' => "<i class='icon-snapchat'></i>",
			'menu_title' => 'Snapchat'
		), 
		(object) array(
			'url' => get_theme_mod('vimeo_link', 'https://vimeo.com'),
			'title' => "<i class='icon-vimeo'></i>",
			'menu_title' => 'Vimeo'
		), 
		(object) array(
			'url' => get_theme_mod('dribbble_link', 'https://dribbble.com'),
			'title' => "<i class='icon-dribbble'></i>",
			'menu_title' => 'Dribbble'
		), 
		(object) array(
			'url' => get_theme_mod('rss_link', 'https://rss.com'),
			'title' => "<i class='icon-rss'></i>",
			'menu_title' => 'RSS'
		), 
		(object) array(
			'url' => get_theme_mod('linkedin_link', 'https://linkedin.com'),
			'title' => "<i class='icon-linkedin'></i>",
			'menu_title' => 'Linkedin'
		), 
		(object) array(
			'url' => get_theme_mod('soundcloud_link', 'https://soundcloud.com'),
			'title' => "<i class='icon-soundcloud'></i>",
			'menu_title' => 'Soundcloud'
		), 
	);

	$id = 1;

	/* set values to required item properties */
	foreach ( $icons as $icon ) {
		$icon->classes = "social-item social-media-menu";
		$icon->type = 'custom';
		$icon->object_id = $id;
		$icon->object = 'custom';
		$icon->attr_title = $icon->title;
		$icon->db_id = $id;
		$icon->menu_item_parent = '';
		$icon->target = '';
		$icon->xfn = '';

		$id++;
	}

	$removed_args = array( 'action', 'customlink-tab', 'edit-menu-item', 'menu-item', 'page-tab', '_wpnonce' );
	?>
	<div id="authorarchive" class="categorydiv">
		
		<div id="tabs-panel-authorarchive-all" class="tabs-panel tabs-panel-view-all <?php echo ( 'all' == $current_tab ? 'tabs-panel-active' : 'tabs-panel-inactive' ); ?>">
			<ul id="authorarchive-checklist-all" class="categorychecklist form-no-clear">
			<?php
				//echo walk_nav_menu_tree( array_map('wp_setup_nav_menu_item', $icons), 0, (object) array( 'walker' => $walker) );

				foreach( $icons as $icon ) {
					?>
					<li>
        				<label class="menu-item-title">
        					<input type="checkbox" class="menu-item-checkbox" name="menu-item[<?php echo $icon->db_id ?>][menu-item-object-id]" value="3"><?php echo $icon->title . $icon->menu_title; ?>
        				</label>

        				<input type="hidden" class="menu-item-type" name="menu-item[<?php echo $icon->db_id ?>][menu-item-type]" value="custom">
        				<input type="hidden" class="menu-item-title" name="menu-item[<?php echo $icon->db_id ?>][menu-item-title]" value="<?php echo $icon->title ?>">
        				<input type="hidden" class="menu-item-url" name="menu-item[<?php echo $icon->db_id ?>][menu-item-url]" value="<?php echo $icon->url ?>">
        				<input type="hidden" class="menu-item-classes" name="menu-item[<?php echo $icon->db_id ?>][menu-item-classes]" value="<?php echo $icon->classes ?>">
        			</li>
					<?php
				}
			?>
			</ul>
		</div><!-- /.tabs-panel -->

		<p class="button-controls wp-clearfix">
			<span class="list-controls">
				<a href="<?php echo esc_url( add_query_arg( array( 'authorarchive-tab' => 'all', 'selectall' => 1, ), remove_query_arg( $removed_args ) )); ?>#authorarchive" class="select-all"><?php _e('Select All', 'rachel'); ?></a>
			</span>
			<span class="add-to-menu">
				<input type="submit"<?php wp_nav_menu_disabled_check( $nav_menu_selected_id ); ?> class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e('Add to Menu', 'rachel'); ?>" name="add-authorarchive-menu-item" id="submit-authorarchive" />
				<span class="spinner"></span>
			</span>
		</p>

	</div><!-- /.categorydiv -->
<?php
}