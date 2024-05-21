<?php
/**
 * A class to create a dropdown for all categories in your wordpress site
 */
add_action( 'customize_register', 'rachel_customize_classes_register' );

function rachel_customize_classes_register($wp_customize) {
 class Category_Dropdown_Custom_Control extends WP_Customize_Control {
    private $cats = false;
    public function __construct($manager, $id, $args = array(), $options = array()) {
        $this->cats = get_categories($options);
        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
       {
            if(!empty($this->cats))
            {
                ?>
                    <label>
                      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                      <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                      <select <?php $this->link(); ?>>
                          <option value="0">All Categories</option>
                           <?php
                                foreach ( $this->cats as $cat )
                                {
                                    printf('<option value="%s" %s>%s</option>', $cat->term_id, selected($this->value(), $cat->term_id, false), $cat->name);
                                }
                           ?>
                      </select>
                    </label>
                <?php
            }
       }
 }
}

/**
 * Select sanitization callback example.
 *
 * - Sanitization: select
 * - Control: select, radio
 * 
 * Sanitization callback for 'select' and 'radio' type controls. This callback sanitizes `$input`
 * as a slug, and then validates `$input` against the choices defined for the control.
 * 
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function rachel_sanitize_select( $input, $setting ){
         
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);
 
    //get the list of possible select options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
    
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
             
}

/**
 * Checkbox sanitization callback example.
 * 
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function rachel_sanitize_checkbox( $checked ) {
  // Boolean check.
  return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Number sanitization callback example.
 *
 * - Sanitization: number_absint
 * - Control: number
 * 
 * Sanitization callback for 'number' type text inputs. This callback sanitizes `$number`
 * as an absolute integer (whole number, zero or greater).
 * 
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int Sanitized number; otherwise, the setting default.
 */
function rachel_sanitize_number_absint( $number, $setting ) {
  // Ensure $number is an absolute integer (whole number, zero or greater).
  $number = absint( $number );
  
  // If the input is an absolute integer, return it; otherwise, return the default
  return ( $number ? $number : $setting->default );
}


/**
 * Image sanitization callback example.
 *
 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
 * send back the filename, otherwise, return the setting default.
 *
 * - Sanitization: image file extension
 * - Control: text, WP_Customize_Image_Control
 * 
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @param string               $image   Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 */
function rachel_sanitize_image( $image, $setting ) {
  /*
   * Array of valid image file types.
   *
   * The array includes image mime types that are included in wp_get_mime_types()
   */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
  // Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
  // If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}


/**
 * HEX Color sanitization callback example.
 *
 * - Sanitization: hex_color
 * - Control: text, WP_Customize_Color_Control
 * 
 * Note: sanitize_hex_color_no_hash() can also be used here, depending on whether
 * or not the hash prefix should be stored/retrieved with the hex color value.
 * 
 * @see sanitize_hex_color() https://developer.wordpress.org/reference/functions/sanitize_hex_color/
 * @link sanitize_hex_color_no_hash() https://developer.wordpress.org/reference/functions/sanitize_hex_color_no_hash/
 *
 * @param string               $hex_color HEX color to sanitize.
 * @param WP_Customize_Setting $setting   Setting instance.
 * @return string The sanitized hex color if not null; otherwise, the setting default.
 */
function rachel_sanitize_hex_color( $hex_color, $setting ) {
  // Sanitize $input as a hex value without the hash prefix.
  $hex_color = sanitize_hex_color( $hex_color );
  
  // If $input is a valid hex value, return it; otherwise, return the default.
  return ( ! is_null( $hex_color ) ? $hex_color : $setting->default );
}


/*
* Remove sections from the Customizer
*/
function mytheme_customize_register( $wp_customize ) {
  //All our sections, settings, and controls will be added here

  // $wp_customize->remove_section( 'title_tagline');
  $wp_customize->remove_section( 'colors');
  // $wp_customize->remove_section( 'header_image');
  $wp_customize->remove_section( 'background_image');
  // $wp_customize->remove_panel( 'nav_menus');
  // $wp_customize->remove_section( 'static_front_page');
  // $wp_customize->remove_section( 'custom_css');

}
add_action( 'customize_register', 'mytheme_customize_register',50 );


if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
/**
 * Class to create a custom slider layout control
 */
class Slider_Picker_Custom_Control extends WP_Customize_Control {
      /**
       * Render the content on the theme customizer page
       */
      public function render_content() {

            $finalImageDirectory = get_template_directory_uri() . '/lib/customizer/img/';

            ?>
                <label>
                  <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                  <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                  <ul class="radio-image-control">
                    <li>
                      <input type="radio" name="_customize-radio-<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[slider_fullwidth]" value="slider_fullwidth" <?php $this->link(); ?>/>
                      <label for="<?php echo $this->id; ?>[slider_fullwidth]"><img src="<?php echo $finalImageDirectory; ?>slider-1-col-fullwidth.png" alt="Full Width Slider" /></label>
                      <p>Fullwidth (Slider)</p>
                    </li>
                    <li>
                      <input type="radio" name="_customize-radio-<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[slider_contentwidth]" value="slider_contentwidth" <?php $this->link(); ?>/>
                      <label for="<?php echo $this->id; ?>[slider_contentwidth]"><img src="<?php echo $finalImageDirectory; ?>slider-1-col.png" alt="Content Width Slider"  /></label>
                      <p>Content-Width (Slider)</p>
                    </li>
                    <li>
                      <input type="radio" name="_customize-radio-<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[slider_centered_3]" value="slider_centered" <?php $this->link(); ?>/>
                      <label for="<?php echo $this->id; ?>[slider_centered_3]"><img src="<?php echo $finalImageDirectory; ?>slider-3-col.png" alt="Centered Full Width Slider/Carousel" /></label>
                      <p>Centered Carousel (Slider)</p>
                    </li>
                    <li>
                      <input type="radio" name="_customize-radio-<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[slider_overlay]" value="slider_overlay" <?php $this->link(); ?>/>
                      <label for="<?php echo $this->id; ?>[slider_overlay]"><img src="<?php echo $finalImageDirectory; ?>slider-1-col-overlay.png" alt="Slider with Overlay" /></label>
                      <p>With Overlay (Slider)</p>
                    </li>
                    <li>
                      <input type="radio" name="_customize-radio-<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[slider_left_featured]" value="slider_left_featured" <?php $this->link(); ?>/>
                      <label for="<?php echo $this->id; ?>[slider_left_featured]"><img src="<?php echo $finalImageDirectory; ?>slider-left-featured.png" alt="Vertically aligned posts" /></label>
                      <p>Slider + Widget Area</p>
                    </li>
                    <li>
                      <input type="radio" name="_customize-radio-<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[no_featured_section]" value="no_featured_section" <?php $this->link(); ?>/>
                      <label for="<?php echo $this->id; ?>[no_featured_section]"><img src="<?php echo $finalImageDirectory; ?>no-section.png" alt="No featured section" /></label>
                      <p>No Featured Section</p>
                    </li>
                  </ul>
                </label>
            <?php
       }
}


/**
 * Class to create a custom post layout control
 */
class Layout_Picker_Custom_Control extends WP_Customize_Control {
      /**
       * Render the content on the theme customizer page
       */
      public function render_content() {

            $finalImageDirectory = get_template_directory_uri() . '/lib/customizer/img/';

            ?>
                <label>
                  <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                  <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                  <ul class="radio-image-control">
                    <li>
                      <input type="radio" name="_customize-radio-<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[normal]" value="normal" <?php $this->link(); ?>/>
                      <label for="<?php echo $this->id; ?>[normal]"><img src="<?php echo $finalImageDirectory; ?>post-layout-normal.png" alt="Normal Posts" /></label>
                      <p>Normal Blog</p>
                    </li>
                    <li>
                      <input type="radio" name="_customize-radio-<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[featured_magazine]" value="featured_magazine" <?php $this->link(); ?>/>
                      <label for="<?php echo $this->id; ?>[featured_magazine]"><img src="<?php echo $finalImageDirectory; ?>post-layout-featured-magazine.png" alt="Featured Magazine"  /></label>
                      <p>Fetaured Magazine (2 Columns)</p>
                    </li>
                    <li>
                      <input type="radio" name="_customize-radio-<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[magazine]" value="magazine" <?php $this->link(); ?>/>
                      <label for="<?php echo $this->id; ?>[magazine]"><img src="<?php echo $finalImageDirectory; ?>post-layout-magazine.png" alt="Magazine, 2 Columns" /></label>
                      <p>Magazine (2 Columns)</p>
                    </li>
                    <li>
                      <input type="radio" name="_customize-radio-<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[side_magazine]" value="side_magazine" <?php $this->link(); ?>/>
                      <label for="<?php echo $this->id; ?>[side_magazine]"><img src="<?php echo $finalImageDirectory; ?>post-layout-side-magazine.png" alt="Side Magazine" /></label>
                      <p>Side Magazine</p>
                    </li>
                    <li>
                      <input type="radio" name="_customize-radio-<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[alternating]" value="alternating" <?php $this->link(); ?>/>
                      <label for="<?php echo $this->id; ?>[alternating]"><img src="<?php echo $finalImageDirectory; ?>post-layout-alternating.png" alt="Alternating Posts" /></label>
                      <p>Alternating Posts</p>
                    </li>
                    <li>
                      <input type="radio" name="_customize-radio-<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[complex_magazine]" value="complex_magazine" <?php $this->link(); ?>/>
                      <label for="<?php echo $this->id; ?>[complex_magazine]"><img src="<?php echo $finalImageDirectory; ?>post-layout-complex-magazine.png" alt="Complex Magazine" /></label>
                      <p>Complex Magazine (2 Columns)</p>
                    </li>
                  </ul>
                </label>
            <?php
       }
}

/**
 * Class to create a custom post layout control
 */
class GoogleFonts_Picker_Custom_Control extends WP_Customize_Control {
    private $fonts = false;
    public function __construct($manager, $id, $args = array(), $options = array()) {
        $this->fonts = array(
          'open-sans' => 'Open Sans',
          'oswald' => 'Oswald',
          'amiri' => 'Amiri',
          'playfair-display' => 'Playfair Display',
          'montserrat' => 'Montserrat',
          'raleway' => 'Raleway',
          'droid-sans' => 'Droid Sans',
          'lato' => 'Lato',
          'arvo' => 'Arvo',
          'lora' => 'Lora',
          'source-sans-pro' => 'Source Sans Pro',
          'merriweather' => 'Merriweather',
          'oxygen' => 'Oxygen',
          'pt-serif' => 'PT Serif',
          'pt-sans' => 'PT Sans',
          'pt-sans-narrow' => 'PT Sans Narrow',
          'cabin' => 'Cabin',
          'fjalla-one' => 'Fjalla One',
          'francois-one' => 'Francois One',
          'josefin-sans' => 'Josefin Sans',
          'libre-baskerville' => 'Libre Baskerville',
          'arimo' => 'Arimo',
          'ubuntu' => 'Ubuntu',
          'bitter' => 'Bitter',
          'droid-serif' => 'Droid Serif',
          'roboto' => 'Roboto',
          'open-sans-condensed' => 'Open Sans Condensed',
          'roboto-condensed' => 'Roboto Condensed',
          'roboto-slab' => 'Roboto Slab',
          'rokkitt' => 'Rokkitt',
        );
        parent::__construct( $manager, $id, $args );
    }

      /**
       * Render the content on the theme customizer page
       */
      public function render_content() {
        if(!empty($this->fonts))
            {
                ?>
                    <label>
                      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                      <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                      <select <?php $this->link(); ?>>
                           <?php
                                foreach ( $this->fonts as $key => $name )
                                {
                                    printf('<option value="%s" %s>%s</option>', $key, selected($this->value(), $key, false), $name);
                                }
                           ?>
                      </select>
                    </label>
                <?php
            }
            
       }
}


if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
/**
 * Class to create a custom footer layout control
 */
class Footer_Picker_Custom_Control extends WP_Customize_Control {
      /**
       * Render the content on the theme customizer page
       */
      public function render_content() {

            $finalImageDirectory = get_template_directory_uri() . '/lib/customizer/img/';

            ?>
                <label>
                  <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                  <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                  <ul class="radio-image-control footer-layout-control">
                    <li>
                      <input type="radio" name="_customize-radio-<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[footer_1]" value="footer_1" <?php $this->link(); ?>/>
                      <label for="<?php echo $this->id; ?>[footer_1]"><img src="<?php echo $finalImageDirectory; ?>footer-layout-1.png" alt="Footer with Widget Areas" /></label>
                      <p>Footer with Logo and Widget Areas</p>
                    </li>
                    <li>
                      <input type="radio" name="_customize-radio-<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[footer_2]" value="footer_2" <?php $this->link(); ?>/>
                      <label for="<?php echo $this->id; ?>[footer_2]"><img src="<?php echo $finalImageDirectory; ?>footer-layout-2.png" alt="Simple Footer"  /></label>
                      <p>Simple Footer with Menu</p>
                    </li>
                    <li>
                      <input type="radio" name="_customize-radio-<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[footer_3]" value="footer_3" <?php $this->link(); ?>/>
                      <label for="<?php echo $this->id; ?>[footer_3]"><img src="<?php echo $finalImageDirectory; ?>footer-layout-3.png" alt="Footer with Logo and Menu" /></label>
                      <p>Footer with Logo and Menu</p>
                    </li>
                  </ul>
                </label>
            <?php
       }
}



/*
* This one is not needed for now
*/
// function rachel_upload_google_fonts($fontname) {
//   // 1. Get the font zip from the API
//   $url = "https://google-webfonts-helper.herokuapp.com/api/fonts/" . $fontname . "?download=zip&subsets=latin&formats=woff,eot,svg,ttf&variants=regular";

//   $response = wp_remote_get( $url );

//   $fontZip = wp_remote_retrieve_body($response);

//   $fontPath = get_template_directory() . '/assets/fonts/' . $fontname . '.zip';
//   $fontPathRes = get_template_directory() . '/assets/fonts/' . $fontname;

//   if(!file_exists($fontPathRes)) {
//     $zip = file_get_contents($url);
//     file_put_contents($fontPath, $zip);
//   }

//   $zip = new ZipArchive;
//   $res = $zip->open($fontPath);

//   if ($res === TRUE) {
//     // extract it to the path we determined above
//     $zip->extractTo($fontPathRes);
//     $zip->close();

//     // Delete the original zip
//     unlink($fontPath);

//   }

// }


// function rachel_google_fonts_ajax() {

//   $fontname = (isset($_POST['font']) ? sanitize_text_field($_POST['font']) : 'open-sans');

//   rachel_upload_google_fonts($fontname);

//   die();

// }
// add_action( 'wp_ajax_nopriv_rachel_google_fonts_ajax', 'rachel_google_fonts_ajax' );
// add_action( 'wp_ajax_rachel_google_fonts_ajax', 'rachel_google_fonts_ajax' );


/**
 * A class to create a title customizer setting for better distinction between settings/controls 
 */
add_action( 'customize_register', 'rachel_customize_title_class_register' );

function rachel_customize_title_class_register($wp_customize) {
 class Settings_Title_Custom_Control extends WP_Customize_Control {
    /**
    * Define the control type
    */
    public $type = 'my-settings-title';

    public function __construct($manager, $id, $args = array(), $options = array()) {
        //$this->title = 'Your Title';
        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
       {
            //if(!empty($this->title))
            //{
                ?>
                    <label>
                      <span class="customize-control-title my-settings-title"><?php echo esc_html( $this->label ); ?></span>
                    </label>
                <?php
            //}
       }
 }
}