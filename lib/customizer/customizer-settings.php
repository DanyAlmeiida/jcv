<?php
/**
 * myboutique Theme Customizer
 *
 * @package myboutique
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function rachel_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'rachel_customize_register' );


/**
* Register Theme Options Panel.
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function rachel_customizer_panel_register( $wp_customize ) {
$parent_theme = wp_get_theme(get_template());
$parent_theme_name = $parent_theme->get( 'Name' );

$wp_customize->add_panel( 'rachel_theme_options_panel', array(
        'priority'       => 2,
        'capability'     => 'edit_theme_options',
        'title'          => $parent_theme_name . __(' Options', 'rachel'),
        'description'    => __('Options for myboutique Theme.', 'rachel'),
    ) );
}
add_action( 'customize_register', 'rachel_customizer_panel_register' );


/**
* Register Customizer Sections.
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function rachel_customizer_sections_register( $wp_customize ) {

// Homepage
$wp_customize->add_section( 'rachel_homepage_section', array(
        'priority'       => 2,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'rachel_theme_options_panel',
        'title'          => __('Blog', 'rachel'),
    ) );

// Single Article
$wp_customize->add_section( 'rachel_article_section', array(
        'priority'       => 4,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'rachel_theme_options_panel',
        'title'          => __('Articles & Pages', 'rachel'),
    ) );

// Theme Colors
$wp_customize->add_section( 'rachel_color_section', array(
        'priority'       => 3,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'rachel_theme_options_panel',
        'title'          => __('Colors', 'rachel'),
        'description'  => __('<em>MBT Tip</em>: Are you unsure which colors to pick? Get inspired by our theme demos or download the exact color files directly from here.', 'rachel')
    ) );

// Theme Fonts
$wp_customize->add_section( 'rachel_fonts_section', array(
        'priority'       => 4,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'rachel_theme_options_panel',
        'title'          => __('Fonts', 'rachel'),
    ) );

// General
$wp_customize->add_section( 'rachel_general_section', array(
        'priority'       => 1,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'rachel_theme_options_panel',
        'title'          => __('General Options', 'rachel'),
    ) );

// Footer Settings
$wp_customize->add_section( 'rachel_footer_nav_section', array(
	    'title'          => esc_attr__( 'Footer', 'rachel' ),
	    'description'    => __( 'Set layout, styles and description for the footer. To edit the logo, please add a custom logo in the <a href="">Site Identity</a> customizer section.', 'rachel' ),
	    'panel'          => 'rachel_theme_options_panel',
	    'priority'       => 20,
	) );

}
add_action( 'customize_register', 'rachel_customizer_sections_register' );


/**
* Add Customizer Functions for Color Scheme
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function rachel_color_customize_register( $wp_customize ) {
    // Secondary Color
    $wp_customize->add_setting( 'base_color', array(
      'default'   => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'base_color', array(
      'section' => 'rachel_color_section',
      'label'   => esc_html__( 'Base Color', 'rachel' ),
      'description' => esc_html__( 'Defines the base aesthetic of the theme. Choose a pastel color for a feminine look or a darker shade for a cool, more sophisticated color scheme.', 'rachel' )
    ) ) );

    // Accent Color
    $wp_customize->add_setting( 'accent_color', array(
      'default'   => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
      'section' => 'rachel_color_section',
      'label'   => esc_html__( 'Accent Color', 'rachel' ),
      'description' => esc_html__( 'Is used for links, hover states, sometimes buttons and special titles. Give your design a popping look with a complimentary color (as opposed to the base color) or stay in the same family for a more harmonic color scheme.', 'rachel' )
    ) ) );

 //     // Title Font Color
 //    $wp_customize->add_setting( 'title_font_color', array(
 //      'default'   => '',
 //      'transport' => 'refresh',
 //      'sanitize_callback' => 'sanitize_hex_color',
 //    ) );

 //    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'title_font_color', array(
 //      'section' => 'rachel_color_section',
 //      'label'   => esc_html__( 'Title Font Color', 'rachel' ),
 //      'description' => esc_html__( 'Post Title, Page Title, Widget Title, etc.', 'rachel' )
 //    ) ) );

 //    // Body Font Color
 //    $wp_customize->add_setting( 'body_font_color', array(
 //      'default'   => '',
 //      'transport' => 'refresh',
 //      'sanitize_callback' => 'sanitize_hex_color',
 //    ) );

 //    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_font_color', array(
 //      'section' => 'rachel_color_section',
 //      'label'   => esc_html__( 'Body Font Color', 'rachel' ),
 //      'description' => esc_html__( 'Post Body Text, Page Text, Widget Text', 'rachel' )
 //    ) ) );

 //    // Button Background Color
 //    $wp_customize->add_setting( 'button_bg_color', array(
 //      'default'   => '',
 //      'transport' => 'refresh',
 //      'sanitize_callback' => 'sanitize_hex_color',
 //    ) );

 //    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'button_bg_color', array(
 //      'section' => 'rachel_color_section',
 //      'label'   => esc_html__( 'Button Background Color', 'rachel' )
 //    ) ) );

 //    // Button Font Color
 //    $wp_customize->add_setting( 'button_font_color', array(
 //      'default'   => '',
 //      'transport' => 'refresh',
 //      'sanitize_callback' => 'sanitize_hex_color',
 //    ) );

 //    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'button_font_color', array(
 //      'section' => 'rachel_color_section',
 //      'label'   => esc_html__( 'Button Font Color', 'rachel' ),
 //    ) ) );

 //     // Color Picker for Footer Bg Color
	// $wp_customize->add_setting('footer_bg_color', array(
 //        'default' => '#0c0c0c',
 //        'sanitize_callback' => 'rachel_sanitize_hex_color'
 //        )
 //    );
	// // Color Control
	// $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'footer_bg_color', array(
	// 	'label' => __( 'Footer Background Color', 'rachel' ), 
 //        'section' => 'rachel_color_section',
 //        'type' => 'color',
 //    ) ) );

 //     // Color Picker for Footer Bg Color
	// $wp_customize->add_setting('footer_font_color', array(
 //        'default' => '#ffffff',
 //        'sanitize_callback' => 'rachel_sanitize_hex_color'
 //        )
 //    );
	// // Color Control
	// $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'footer_font_color', array(
	// 	'label' => __( 'Footer Font Color', 'rachel' ), 
 //        'section' => 'rachel_color_section',
 //        'type' => 'color',
 //    ) ) );

 //    // Color Picker for Primary Navbar Bg Color
	// $wp_customize->add_setting('primary_navbar_bg_color', array(
 //        'default' => '#0c0c0c',
 //        'sanitize_callback' => 'rachel_sanitize_hex_color'
 //        )
 //    );
	// // Color Control
	// $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'primary_navbar_bg_color', array(
	// 	'label' => __( 'Primary (Top) Navbar Background Color', 'rachel' ), 
 //        'section' => 'rachel_color_section',
 //        'type' => 'color',
 //    ) ) );

 //     // Color Picker for Primary Navbar Color
	// $wp_customize->add_setting('primary_navbar_font_color', array(
 //        'default' => '#ffffff',
 //        'sanitize_callback' => 'rachel_sanitize_hex_color'
 //        )
 //    );
	// // Color Control
	// $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'primary_navbar_font_color', array(
	// 	'label' => __( 'Secondary (Top) Navbar Font Color', 'rachel' ), 
 //        'section' => 'rachel_color_section',
 //        'type' => 'color',
 //    ) ) );


 //   // Color Picker for Secondary Navbar Bg Color
 //  $wp_customize->add_setting('secondary_navbar_bg_color', array(
 //        'default' => '#0c0c0c',
 //        'sanitize_callback' => 'rachel_sanitize_hex_color'
 //        )
 //    );
 //  // Color Control
 //  $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'secondary_navbar_bg_color', array(
 //    'label' => __( 'Secondary (below header) Navbar Background Color', 'rachel' ), 
 //        'section' => 'rachel_color_section',
 //        'type' => 'color',
 //    ) ) );

 //     // Color Picker for Secondary Navbar Color
 //  $wp_customize->add_setting('secondary_navbar_font_color', array(
 //        'default' => '#ffffff',
 //        'sanitize_callback' => 'rachel_sanitize_hex_color'
 //        )
 //    );
 //  // Color Control
 //  $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'secondary_navbar_font_color', array(
 //    'label' => __( 'Secondary (below header) Navbar Font Color', 'rachel' ), 
 //        'section' => 'rachel_color_section',
 //        'type' => 'color',
 //    ) ) );


 //    // Color Picker for Slider Overlay Bg Color
	// $wp_customize->add_setting('overlay_bg_color', array(
 //        'default' => '#0c0c0c',
 //        'sanitize_callback' => 'rachel_sanitize_hex_color'
 //        )
 //    );

	// // Color Control
	// $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'overlay_bg_color', array(
	// 	'label' => __( 'Slider Overlay Background Color', 'rachel' ), 
 //        'section' => 'rachel_color_section',
 //        'type' => 'color',
 //    ) ) );

 //     // Color Picker for Slider Overlay Font Color
	// $wp_customize->add_setting('overlay_font_color', array(
 //        'default' => '#ffffff',
 //        'sanitize_callback' => 'rachel_sanitize_hex_color'
 //        )
 //    );
	// // Color Control
	// $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'overlay_font_color', array(
	// 	'label' => __( 'Slider Overlay Font Color', 'rachel' ), 
 //        'section' => 'rachel_color_section',
 //        'type' => 'color',
 //    ) ) );
}
add_action( 'customize_register', 'rachel_color_customize_register' );



/**
* Add Customizer Functions for Social Media Icons
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function rachel_social_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'rachel_social_media' , array(
	    'title'      => __( 'Social Media', 'rachel' ),
	    'priority'   => 70,
	    'panel'		 => 'rachel_theme_options_panel',
	    'description' => __( 'Please add the links to your social media channels here. The URLs need to have a http:// or https:// in front, so it is best to simply copy the URL from the browser address tab. <br/> <a href="#">Find more information in our documentation</a>.', 'rachel' )
	) );

	$wp_customize->add_setting( 'facebook_link' , array(
	    'default'     => 'Your Facebook link here',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'instagram_link' , array(
	    'default'     => 'Your Instagram link here',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'twitter_link' , array(
	    'default'     => 'Your Twitter link here',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'bloglovin_link' , array(
	    'default'     => 'Your Bloglovin link here',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   $wp_customize->add_setting( 'pinterest_link' , array(
    	'default'     => 'Your Pinterest link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );

 //    $wp_customize->add_setting( 'google_link' , array(
 //    	'default'     => 'Your Google+ link here',
 //    	'transport'   => 'refresh',
 //    	'sanitize_callback' => 'sanitize_text_field'
	// ) );

	$wp_customize->add_setting( 'youtube_link' , array(
    	'default'     => 'Your Youtube link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'snapchat_link' , array(
    	'default'     => 'Your Snapchat link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'vimeo_link' , array(
    	'default'     => 'Your Vimeo link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'dribble_link' , array(
    	'default'     => 'Your Dribble link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'linkedin_link' , array(
    	'default'     => 'Your Linkedin link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'soundcloud_link' , array(
    	'default'     => 'Your Soundcloud link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'rss_link' , array(
    	'default'     => 'Your RSS feed link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );


   //* Add Customizer Controls
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook_link', array(
		'label'        => __( 'Facebook Link', 'rachel' ),
		'section'    => 'rachel_social_media',
		'settings'   => 'facebook_link',
	) ) );

      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'instagram_link', array(
		'label'        => __( 'Instagram Link', 'rachel' ),
		'section'    => 'rachel_social_media',
		'settings'   => 'instagram_link',
	) ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_link', array(
		'label'        => __( 'Twitter Link', 'rachel' ),
		'section'    => 'rachel_social_media',
		'settings'   => 'twitter_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloglovin_link', array(
		'label'        => __( 'Bloglovin URL', 'rachel' ),
		'section'    => 'rachel_social_media',
		'settings'   => 'bloglovin_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pinterest_link', array(
		'label'        => __( 'Pinterest Link', 'rachel' ),
		'section'    => 'rachel_social_media',
		'settings'   => 'pinterest_link',
	) ) );

 //   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google_link', array(
	// 	'label'        => __( 'Google+ Link', 'rachel' ),
	// 	'section'    => 'rachel_social_media',
	// 	'settings'   => 'google_link',
	// ) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'youtube_link', array(
		'label'        => __( 'Youtube Link', 'rachel' ),
		'section'    => 'rachel_social_media',
		'settings'   => 'youtube_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'snapchat_link', array(
		'label'        => __( 'Snapchat Link', 'rachel' ),
		'section'    => 'rachel_social_media',
		'settings'   => 'snapchat_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vimeo_link', array(
		'label'        => __( 'Vimeo Link', 'rachel' ),
		'section'    => 'rachel_social_media',
		'settings'   => 'vimeo_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'dribble_link', array(
		'label'        => __( 'Dribble Link', 'rachel' ),
		'section'    => 'rachel_social_media',
		'settings'   => 'dribble_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rss_link', array(
		'label'        => __( 'RSS Link', 'rachel' ),
		'section'    => 'rachel_social_media',
		'settings'   => 'rss_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'linkedin_link', array(
		'label'        => __( 'Linkedin Link', 'rachel' ),
		'section'    => 'rachel_social_media',
		'settings'   => 'linkedin_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'soundcloud_link', array(
		'label'        => __( 'Soundcloud Link', 'rachel' ),
		'section'    => 'rachel_social_media',
		'settings'   => 'soundcloud_link',
	) ) );
}
add_action( 'customize_register', 'rachel_social_customize_register' );



/**
* Add Customizer Functions for Related Posts
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function rachel_related_posts_customize_register( $wp_customize ) {

	//* Add Customizer Setting: Article Blog Layout Setting Title
	$wp_customize->add_setting( 'rachel_articleblog_setting_title' , array(
	    'default'     => '0',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Article Blog Layout Setting Title
   	$wp_customize->add_control(new Settings_Title_Custom_Control($wp_customize, 'rachel_articleblog_setting_title',
		array(
			'settings'		=> 'rachel_articleblog_setting_title',
			'section'		=> 'rachel_article_section',
			'label'			=> __( 'Article/Page Layout', 'rachel' ),
		)
	));


   	// Show/Hide Sidebar & Featured Image Checkboxes
	$wp_customize->add_setting( 'rachel_articlesidebar_checkbox' , array(
	    'default'     => TRUE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'rachel_sanitize_checkbox'
	) );
   	$wp_customize->add_control( 'rachel_articlesidebar_checkbox',
		array(
			'settings'		=> 'rachel_articlesidebar_checkbox',
			'section'		=> 'rachel_article_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Show Sidebar on Blog Articles', 'rachel' ),
		)
	);

	$wp_customize->add_setting( 'rachel_pagesidebar_checkbox' , array(
	    'default'     => TRUE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'rachel_sanitize_checkbox'
	) );
   	$wp_customize->add_control( 'rachel_pagesidebar_checkbox',
		array(
			'settings'		=> 'rachel_pagesidebar_checkbox',
			'section'		=> 'rachel_article_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Show Sidebar on Static Pages', 'rachel' ),
		)
	);

	$wp_customize->add_setting( 'rachel_articlefeatimage_checkbox' , array(
	    'default'     => TRUE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'rachel_sanitize_checkbox'
	) );
   	$wp_customize->add_control( 'rachel_articlefeatimage_checkbox',
		array(
			'settings'		=> 'rachel_articlefeatimage_checkbox',
			'section'		=> 'rachel_article_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Show Featured Image above Articles', 'rachel' ),
		)
	);


	//* Add Customizer Setting: Related Posts Setting Title
	$wp_customize->add_setting( 'rachel_related_setting_title' , array(
	    'default'     => '0',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Related Posts Setting Title
   	$wp_customize->add_control(new Settings_Title_Custom_Control($wp_customize, 'rachel_related_setting_title',
		array(
			'settings'		=> 'rachel_related_setting_title',
			'section'		=> 'rachel_article_section',
			'label'			=> __( 'Related Posts Settings', 'rachel' ),
		)
	));

	//* Add Customizer Setting: Checkbox Related Posts
	$wp_customize->add_setting( 'rachel_related_checkbox' , array(
	    'default'     => TRUE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'rachel_sanitize_checkbox'
	) );

   //* Add Customizer Control: Checkbox Related Posts
   $wp_customize->add_control( 'rachel_related_checkbox',
		array(
			'settings'		=> 'rachel_related_checkbox',
			'section'		=> 'rachel_article_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Show Related Posts', 'rachel' ),
		)
	);

	//* Add Customizer Setting: Headline Related Posts
	$wp_customize->add_setting( 'rachel_related_headline' , array(
	    'default'     => 'Related Posts',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Headline Related Posts
   $wp_customize->add_control( 'rachel_related_headline',
		array(
			'settings'		=> 'rachel_related_headline',
			'section'		=> 'rachel_article_section',
			'type'			=> 'text',
			'label'			=> __( 'Related Posts - Headline', 'rachel' ),
			'description'	=> __( 'Set the headline for the related posts section, e.g. "You may also like".', 'rachel' )
		)
	);

	//* Add Customizer Setting: Number Related Posts
	$wp_customize->add_setting( 'rachel_related_number' , array(
	    'default'     => '3',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'rachel_sanitize_number_absint'
	) );

   //* Add Customizer Control: Number Related Posts
   $wp_customize->add_control( 'rachel_related_number',
		array(
			'settings'		=> 'rachel_related_number',
			'section'		=> 'rachel_article_section',
			'type'			=> 'number',
			'label'			=> __( 'Number of Related Posts', 'rachel' ),
			'description'	=> __( 'Set the number of related posts to display below each article.', 'rachel' ),
			'input_attrs' => array(
	            'min' => 1,
	            'max' => 10,
	            'step' => 1,
            ),
		)
	);


   //* Add Customizer Setting: Category or Tags for Related Posts
	$wp_customize->add_setting( 'rachel_related_type' , array(
	    'default'     => 'categories',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'rachel_sanitize_select'
	) );

   //* Add Customizer Control: Category or Tags for Related Posts Radioboxes Control
   	$wp_customize->add_control('rachel_related_type',
		array(
			'settings'		=> 'rachel_related_type',
			'section'		=> 'rachel_article_section',
			'type'			=> 'radio',
			'label'			=> __( 'Related Posts Type', 'rachel' ),
			'description'	=> __( 'Please select if Related Posts should be shown based on tags or categories.', 'rachel' ),
			'choices'		=> array(
				'categories' => __( 'Categories', 'rachel' ),
				'tags' => __( 'Tags', 'rachel' )
			)
		)
	);


	// Show/Hide Description with Header Image
	$wp_customize->add_setting( 'rachel_description_header_image_checkbox' , array(
	    'default'     => TRUE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'rachel_sanitize_checkbox'
	) );
   	$wp_customize->add_control( 'rachel_description_header_image_checkbox',
		array(
			'settings'		=> 'rachel_description_header_image_checkbox',
			'section'		=> 'header_image',
			'type'			=> 'checkbox',
			'label'			=> __( 'Show Description below the Header Image', 'rachel' ),
		)
	);

}
add_action( 'customize_register', 'rachel_related_posts_customize_register' );




/**
* Add Sticky Sidebar Customizer Settings
*/
function rachel_sidebar_customize_register( $wp_customize ) {

	//* Add Customizer Setting: General Layout Setting Title
	$wp_customize->add_setting( 'rachel_generallayout_setting_title' , array(
	    'default'     => '0',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: General Layout Setting Title
   	$wp_customize->add_control(new Settings_Title_Custom_Control($wp_customize, 'rachel_generallayout_setting_title',
		array(
			'settings'		=> 'rachel_generallayout_setting_title',
			'section'		=> 'rachel_general_section',
			'label'			=> __( 'General Layout', 'rachel' ),
		)
	));


   	/*
   	* The General Sidebar control is not used in this theme
   	*/
	// //* Add Customizer Setting: Sidebar on Homepage + Single
	// $wp_customize->add_setting( 'rachel_show_sidebar' , array(
	//     'default'     => 'fullwidth',
	//     'transport'   => 'refresh',
	//     'sanitize_callback' => 'rachel_sanitize_select'
	// ) );

 //   //* Add Customizer Control: Sidebar on Homepage + Single Radioboxes Control
 //   	$wp_customize->add_control('rachel_show_sidebar',
	// 	array(
	// 		'settings'		=> 'rachel_show_sidebar',
	// 		'section'		=> 'rachel_general_section',
	// 		'type'			=> 'radio',
	// 		'label'			=> __( 'Show Sidebar', 'rachel' ),
	// 		'description'	=> __( 'Please select if you want to show a sidebar next to your posts. This is a global setting and affects all kinds of pages. To fine-grain this setting and show the sidebar only on specific pages, go to the particular sections (e.g. "Homepage" or "Articles & Pages").', 'rachel' ),
	// 		'choices'		=> array(
	// 			'sidebar' => __( 'Show Sidebar', 'rachel' ),
	// 			'fullwidth' => __( 'Full-Width Posts', 'rachel' )
	// 		)
	// 	)
	// );

	$wp_customize->add_setting( 'rachel_stickysidebar_checkbox' , array(
	    'default'     => TRUE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'rachel_sanitize_checkbox'
	) );

   //* Add Customizer Control: Checkbox Sticky Sidebar
   $wp_customize->add_control( 'rachel_stickysidebar_checkbox',
		array(
			'settings'		=> 'rachel_stickysidebar_checkbox',
			'section'		=> 'rachel_general_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Make the sidebar stick to the top when scrolling', 'rachel' ),
		)
	);


	//* Add Customizer Setting: General Layout Setting Title
	$wp_customize->add_setting( 'rachel_mainnav_setting_title' , array(
	    'default'     => '0',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: General Layout Setting Title
   	$wp_customize->add_control(new Settings_Title_Custom_Control($wp_customize, 'rachel_mainnav_setting_title',
		array(
			'settings'		=> 'rachel_mainnav_setting_title',
			'section'		=> 'rachel_general_section',
			'label'			=> __( 'Main Navigation', 'rachel' ),
		)
	));


   	// Main navigation stick to top checkbox
   	$wp_customize->add_setting( 'rachel_stickynav_checkbox' , array(
	    'default'     => FALSE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'rachel_sanitize_checkbox'
	) );

   //* Add Customizer Control: Checkbox Sticky Navbar
   $wp_customize->add_control( 'rachel_stickynav_checkbox',
		array(
			'settings'		=> 'rachel_stickynav_checkbox',
			'section'		=> 'rachel_general_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Make the Navigation Bar of the theme stick to the top when scrolling', 'rachel' ),
		)
	);

	

}
add_action( 'customize_register', 'rachel_sidebar_customize_register' );



/**
* Add Sticky Sidebar Customizer Settings
*/
function rachel_slider_customize_register( $wp_customize ) {
	
	/*
   	* The Featured Section control is not used in this theme
   	*/
	// //* Add Customizer Setting: Carousel Section Setting Title
	// $wp_customize->add_setting( 'rachel_toparea_setting_title' , array(
	//     'default'     => '0',
	//     'transport'   => 'refresh',
	//     'sanitize_callback' => 'sanitize_text_field'
	// ) );

 //   //* Add Customizer Control: Carousel Section Setting Title
 //   	$wp_customize->add_control(new Settings_Title_Custom_Control($wp_customize, 'rachel_toparea_setting_title',
	// 	array(
	// 		'settings'		=> 'rachel_toparea_setting_title',
	// 		'section'		=> 'rachel_homepage_section',
	// 		'label'			=> __( 'Top (Slider) Area', 'rachel' ),
	// 	)
	// ));

   	
	// //* Add Customizer Setting: Slider/Top Section Layout
	// $wp_customize->add_setting( 'rachel_featured_layout' , array(
	//     'default'     => 'slider_fullwidth',
	//     'transport'   => 'refresh',
	//     'sanitize_callback' => 'sanitize_text_field'
	// ) );

 //   //* Add Customizer Control: Slider/Top Section Layout
 //   	$wp_customize->add_control(new Slider_Picker_Custom_Control( $wp_customize, 'rachel_featured_layout',
	// 	array(
	// 		'settings'		=> 'rachel_featured_layout',
	// 		'section'		=> 'rachel_homepage_section',
	// 		'type'			=> 'radio',
	// 		'label'			=> __( 'Featured Section Layout', 'rachel' ),
	// 		'description'	=> __( 'Please select the Layout of the top featured section', 'rachel' ),
	// 		// 'choices'		=> array(
	// 		// 	'latest' => __( 'Latest Posts', 'rachel' ),
	// 		// 	'featured' => __( 'Featured Posts (posts that have the category "featured")', 'rachel' )
	// 		// )
	// 	)
	// ));


	// //* Add Customizer Setting: Checkbox Featured Section Overlay
	// $wp_customize->add_setting( 'rachel_featured_overlay_checkbox' , array(
	//     'default'     => TRUE,
	//     'transport'   => 'refresh',
	//     'sanitize_callback'	=> 'rachel_sanitize_checkbox'
	// ) );

 //   //* Add Customizer Control: Checkbox Featured Section Overlay
 //   $wp_customize->add_control( 'rachel_featured_overlay_checkbox',
	// 	array(
	// 		'section'		=> 'rachel_homepage_section',
	// 		'type'			=> 'checkbox',
	// 		'label'			=> __( 'Show Overlay (Post Title, Categories, etc.)', 'rachel' ),
	// 	)
	// );

 //   //* Add Customizer Setting: Checkbox Featured Section Autoplay
	// $wp_customize->add_setting( 'rachel_featured_autoplay_checkbox' , array(
	//     'default'     => FALSE,
	//     'transport'   => 'refresh',
	//     'sanitize_callback'	=> 'rachel_sanitize_checkbox'
	// ) );

 //   //* Add Customizer Control: Checkbox Featured Section Autoplay
 //   $wp_customize->add_control( 'rachel_featured_autoplay_checkbox',
	// 	array(
	// 		'section'		=> 'rachel_homepage_section',
	// 		'type'			=> 'checkbox',
	// 		'label'			=> __( 'Enable Autoplay', 'rachel' ),
	// 	)
	// );

 //   //* Add Customizer Setting: Checkbox Featured Section Show Dots
	// $wp_customize->add_setting( 'rachel_featured_showdots_checkbox' , array(
	//     'default'     => TRUE,
	//     'transport'   => 'refresh',
	//     'sanitize_callback'	=> 'rachel_sanitize_checkbox'
	// ) );

 //   //* Add Customizer Control: Checkbox Featured Section Show Dots
 //   $wp_customize->add_control( 'rachel_featured_showdots_checkbox',
	// 	array(
	// 		'section'		=> 'rachel_homepage_section',
	// 		'type'			=> 'checkbox',
	// 		'label'			=> __( 'Show Dots', 'rachel' ),
	// 	)
	// );

 //   //* Add Customizer Setting: Checkbox Featured Section Show Arrows
	// $wp_customize->add_setting( 'rachel_featured_showarrows_checkbox' , array(
	//     'default'     => TRUE,
	//     'transport'   => 'refresh',
	//     'sanitize_callback'	=> 'rachel_sanitize_checkbox'
	// ) );

 //   //* Add Customizer Control: Checkbox Featured Section Show Arrows
 //   $wp_customize->add_control( 'rachel_featured_showarrows_checkbox',
	// 	array(
	// 		'section'		=> 'rachel_homepage_section',
	// 		'type'			=> 'checkbox',
	// 		'label'			=> __( 'Show Arrows', 'rachel' ),
	// 	)
	// );

 //   //* Add Customizer Setting: Homepage Slider Fade or Slide
	// $wp_customize->add_setting( 'rachel_featured_fadeslide_radio' , array(
	//     'default'     => 'slide',
	//     'transport'   => 'refresh',
	//     'sanitize_callback' => 'rachel_sanitize_select'
	// ) );

 //   //* Add Customizer Control: Homepage Slider Fade or Slide
 //   	$wp_customize->add_control('rachel_featured_fadeslide_radio',
	// 	array(
	// 		'settings'		=> 'rachel_featured_fadeslide_radio',
	// 		'section'		=> 'rachel_homepage_section',
	// 		'type'			=> 'radio',
	// 		'label'			=> __( 'Slider Mode', 'rachel' ),
	// 		'description'	=> __('Please note that the fading mode does not work with the centered slider.', 'rachel'),
	// 		'choices'		=> array(
	// 			'slide' => __( 'Slide', 'rachel' ),
	// 			'fade' => __( 'Fade', 'rachel' )
	// 		)
	// 	)
	// );


	// //* Add Customizer Setting: Category Dropdown for Featured Section
	// $wp_customize->add_setting( 'rachel_featured_category' , array(
	//     'default'     => '0',
	//     'transport'   => 'refresh',
	//     'sanitize_callback' => 'rachel_sanitize_number_absint'
	// ) );

 //   //* Add Customizer Control: Category Dropdown for Featured Section
 //   	$wp_customize->add_control(new Category_Dropdown_Custom_Control($wp_customize, 'rachel_featured_category',
	// 	array(
	// 		'settings'		=> 'rachel_featured_category',
	// 		'section'		=> 'rachel_homepage_section',
	// 		'type'			=> 'select',
	// 		'label'			=> __( 'Select the Featured Posts Category', 'rachel' ),
	// 		'description'	=> __( 'Hint: Choose "All Categories" for the most recent posts and create an extra "featured" category to choose exact posts.', 'rachel' ),
	// 		// 'choices'		=> array(
	// 		// 	'latest' => __( 'Recent Posts', 'rachel' ),
	// 		// 	'category' => __( 'Category Posts', 'rachel' )
	// 		// )
	// 	)
	// ));

	// //* Add Customizer Setting: Number Top Slider Posts
	// $wp_customize->add_setting( 'rachel_featured_number' , array(
	//     'default'     => 4,
	//     'transport'   => 'refresh',
	//     'sanitize_callback' => 'rachel_sanitize_number_absint'
	// ) );

 //   //* Add Customizer Control: Number Top Slider Posts
 //   $wp_customize->add_control( 'rachel_featured_number',
	// 	array(
	// 		'settings'		=> 'rachel_featured_number',
	// 		'section'		=> 'rachel_homepage_section',
	// 		'type'			=> 'number',
	// 		'label'			=> __( 'Number of Posts', 'rachel' ),
	// 		'description'	=> __( 'Set the number of featured posts in the Top Slider. Choose 1 for a static featured post.', 'rachel' ),
	// 		'input_attrs' => array(
	//             'min' => 1,
	//             'step' => 1,
 //            ),
	// 	)
	// );


	//* Add Customizer Setting: Homepage Blog Layout Setting Title
	$wp_customize->add_setting( 'rachel_homeblog_setting_title' , array(
	    'default'     => '0',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Homepage Blog Layout Setting Title
   	$wp_customize->add_control(new Settings_Title_Custom_Control($wp_customize, 'rachel_homeblog_setting_title',
		array(
			'settings'		=> 'rachel_homeblog_setting_title',
			'section'		=> 'rachel_homepage_section',
			'label'			=> __( 'Blog Page', 'rachel' ),
		)
	));


	//* Add Customizer Setting: Homepage Post Layout Picker
	$wp_customize->add_setting( 'rachel_posts_layout' , array(
	    'default'     => 'normal',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Homepage Post Layout Picker
   	$wp_customize->add_control(new Layout_Picker_Custom_Control( $wp_customize, 'rachel_posts_layout',
		array(
			'settings'		=> 'rachel_posts_layout',
			'section'		=> 'rachel_homepage_section',
			'type'			=> 'radio',
			'label'			=> __( 'Blog Page Layout', 'rachel' ),
			'description'	=> __( 'Please select the layout of the blog post loop on the blog page.', 'rachel' ),
			// 'choices'		=> array(
			// 	'latest' => __( 'Latest Posts', 'rachel' ),
			// 	'featured' => __( 'Featured Posts (posts that have the category "featured")', 'rachel' )
			// )
		)
	));


	//* Add Customizer Setting: Sidebar on Blog Page
	$wp_customize->add_setting( 'rachel_show_sidebar_blog' , array(
	    'default'     => 'sidebar',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'rachel_sanitize_select'
	) );

   //* Add Customizer Control: Sidebar on Blog Page Radioboxes Control
   	$wp_customize->add_control('rachel_show_sidebar_blog',
		array(
			'settings'		=> 'rachel_show_sidebar_blog',
			'section'		=> 'rachel_homepage_section',
			'type'			=> 'radio',
			'label'			=> __( 'Show Sidebar', 'rachel' ),
			'description'	=> __( 'Please select if you want to show a sidebar on the blog page. To fine-grain this setting and show the sidebar only on specific pages, go to the particular sections ("Articles & Pages").', 'rachel' ),
			'choices'		=> array(
				'sidebar' => __( 'Show Sidebar', 'rachel' ),
				'fullwidth' => __( 'Full-Width Posts', 'rachel' )
			)
		)
	);


}
add_action( 'customize_register', 'rachel_slider_customize_register' );


/**
* Add Read More Functionality
*/
function rachel_readmore_customize_register( $wp_customize ) {

   //* Add Customizer Setting: Read More Button Text
	$wp_customize->add_setting( 'rachel_readmore_text' , array(
	    'default'     => 'Read More',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Read More Button Text
   $wp_customize->add_control( 'rachel_readmore_text',
		array(
			'settings'		=> 'rachel_readmore_text',
			'section'		=> 'rachel_homepage_section',
			'type'			=> 'text',
			'label'			=> __( 'Read More Button Text', 'rachel' ),
			'description'	=> __( 'Set the text to display on the read more button, e.g. "Continue Reading" or simply "Read More". Leave blank to not show the button at all.', 'rachel' )
		)
	);


   //* Add Customizer Setting: Number Related Posts
	$wp_customize->add_setting( 'rachel_excerpt_length' , array(
	    'default'     => '20',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'rachel_sanitize_number_absint'
	) );

   //* Add Customizer Control: Number Related Posts
   $wp_customize->add_control( 'rachel_excerpt_length',
		array(
			'settings'		=> 'rachel_excerpt_length',
			'section'		=> 'rachel_homepage_section',
			'type'			=> 'number',
			'label'			=> __( 'Length of Post Excerpts', 'rachel' ),
			'description'	=> __( 'Set the length of the automatic post excerpts (in words).', 'rachel' ),
			'input_attrs' => array(
	            'min' => 0,
	            'step' => 1,
            ),
		)
	);

}
add_action( 'customize_register', 'rachel_readmore_customize_register' );



/**
* (Google) Fonts Functionality

function rachel_googlefonts_customize_register( $wp_customize ) {

   //* Add Customizer Setting: Title Google Font 
	$wp_customize->add_setting( 'title_font', array(
	    'default'     => 'open-sans',
	    'transport'   => 'refresh'
	) );

   //* Add Customizer Control: Title Google Font 
   $wp_customize->add_control( new GoogleFonts_Picker_Custom_Control( $wp_customize, 'title_font',
		array(
			'section'		=> 'rachel_fonts_section',
			'label'			=> __( 'Title Font', 'rachel' ),
		)
	));

   //* Add Customizer Setting: Body Google Font
	$wp_customize->add_setting( 'body_font', array(
	    'default'     => 'lora',
	    'transport'   => 'refresh'
	) );

   //* Add Customizer Control: Body Google Font
   $wp_customize->add_control( new GoogleFonts_Picker_Custom_Control( $wp_customize, 'body_font',
		array(
			'section'		=> 'rachel_fonts_section',
			'label'			=> __( 'Body Font', 'rachel' ),
		)
	));

   //* Add Customizer Setting: Menu Google Font
	$wp_customize->add_setting( 'menu_font', array(
	    'default'     => 'montserrat',
	    'transport'   => 'refresh'
	) );

   //* Add Customizer Control: Menu Google Font
   $wp_customize->add_control( new GoogleFonts_Picker_Custom_Control( $wp_customize, 'menu_font',
		array(
			'section'		=> 'rachel_fonts_section',
			'label'			=> __( 'Menu & Button Font', 'rachel' ),
		)
	));

}
add_action( 'customize_register', 'rachel_googlefonts_customize_register' );
*/



/*
* Add support for the custom footer logo and more settings
*/
function rachel_footer_customize_register( $wp_customize ) {

	//* Add Customizer Setting: Footer Logo Upload
	// $wp_customize->add_setting( 'rachel_footer_logo' , array(
	//     'default'     => 0,
	//     'transport'   => 'refresh',
	//     'sanitize_callback'	=> 'rachel_sanitize_image'
	// ) );

	// // Add Customizer control: Footer Logo Upload
 //    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rachel_footer_logo', array(
 //       	'label'    => __( 'Upload a logo for the footer', 'rachel' ),
 //        'section'  => 'rachel_footer_nav_section',
 //        'settings' => 'rachel_footer_logo',
 //    ) ) );


	//* Add Customizer Setting: Footer Layout
	$wp_customize->add_setting( 'rachel_footer_layout' , array(
	    'default'     => 'footer_1',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Footer Layout
   	$wp_customize->add_control(new Footer_Picker_Custom_Control( $wp_customize, 'rachel_footer_layout',
		array(
			'settings'		=> 'rachel_footer_layout',
			'section'		=> 'rachel_footer_nav_section',
			'type'			=> 'radio',
			'label'			=> __( 'Footer Layout', 'rachel' ),
			'description'	=> __( 'Please select the Layout of the Footer section', 'rachel' ),
			'choices'		=> array(
				'footer_1' => __( 'Footer 1', 'rachel' ),
				'footer_2' => __( 'Footer 2', 'rachel' ),
				'footer_3' => __( 'Footer 3', 'rachel' )
			)
		)
	));


	// Footer Credit/Copyright Text
    $wp_customize->add_setting( 'rachel_footer_description' , array(
	    'default'     => '',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Controls
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rachel_footer_description', array(
		'label'        => __( 'Footer site description', 'rachel' ),
		'description'	=> __( 'The theme will automatically fetch your blog description if this field is empty.', 'rachel' ),
		'type' => 'textarea',
		'section'    => 'rachel_footer_nav_section',
		'settings'   => 'rachel_footer_description',
	) ) );


   // Footer Copyright Notice
    $wp_customize->add_setting( 'rachel_footer_copyright_notice' , array(
	    'default'     => '',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Controls
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rachel_footer_copyright_notice', array(
		'label'        => __( 'Footer Copyright', 'mp' ),
		'description'	=> __( 'Add a copyright notice here.', 'tint' ),
		'type' => 'textarea',
		'section'    => 'rachel_footer_nav_section',
		'settings'   => 'rachel_footer_copyright_notice',
	) ) );
}
add_action( 'customize_register', 'rachel_footer_customize_register' );
