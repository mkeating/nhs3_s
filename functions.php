<?php
/**
 * nhs3_s functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package nhs3_s
 */


function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}

if ( ! function_exists( 'nhs3_s_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nhs3_s_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on nhs3_s, use a find and replace
	 * to change 'nhs3_s' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'nhs3_s', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'nhs3_s' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'nhs3_s_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'nhs3_s_setup' );
	
	
	//Custom Navigation

	if( ! function_exists('nhs3_s_setup') ):
		function nhs3_s_setup() {
			register_nav_menu( 'primary', __( 'Primary navigation', 'nhs3_nav') );
		} endif;

	require_once('wp_bootstrap_navwalker.php');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nhs3_s_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nhs3_s_content_width', 640 );
}
add_action( 'after_setup_theme', 'nhs3_s_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nhs3_s_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'nhs3_s' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'nhs3_s_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nhs3_s_scripts() {

	wp_enqueue_script( 'nhs3_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'nhs3_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'jquery' );

	//Adding Bootstrap
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css');
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ) );
	
	//Adding fonts
	#wp_enqueue_style( 'nhs-fonts', 'https://fonts.googleapis.com/css?family=Raleway|Merriweather' );
	wp_enqueue_style( 'nhs-fonts', 'http://fonts.googleapis.com/css?family=Josefin+Sans&subset=latin,latin-ext' );
	

	
	//Font-Awesome glyphs
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

	//Main theme styles
	wp_enqueue_style( 'nhs3_s-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nhs3_s_scripts' );

/**
 * ADD CUSTOM POST TYPE: landing page sections; these will be full-screen sequential sections on the front page
 **/

function landing_section() {

	$labels = array(
		'name'			=> _x( 'Landing Sections', 'post type general name'),
		'singular_name'	=> _x( 'Landing Section', 'post type singular name'),

		);

	$args = array(
		'labels'				=> $labels,
		'description'			=> 'Content blocks for single landing page',
		'public'				=> false,
		'has_archive'			=> false,
		'publicly_queriable'	=> true,
		'has_archive'			=> false,
		'rewrite'				=> false,
		'show_ui' 				=> true,
		'menu_position'			=> 5,
		'register_meta_box_cb' 	=> 'add_landing_metaboxes',
		'supports' => array('title', 'editor', 'page-attributes', 'order'),
    	'hierarchical' => false
		);

	register_post_type('landing_section', $args);
}

add_action('init', 'landing_section');

function add_landing_metaboxes() {

	add_meta_box('landing_bg_img_wide', 'Landing Section Background Image for Wide Screens', 'landing_bg_img_wide', 'landing_section', 'normal', 'default' );
	add_meta_box('landing_bg_img_portrait', 'Landing Section Background Image', 'landing_bg_img_portrait', 'landing_section', 'normal', 'default' );
	add_meta_box('landing_bg', 'Landing Section Background Color', 'landing_bg', 'landing_section', 'normal', 'default' );
	add_meta_box('landing_nxt_btn_text', 'Next Button Text', 'landing_nxt_btn_text', 'landing_section', 'normal', 'default' );
	add_meta_box('landing_nxt_btn_target', 'Next Button Target', 'landing_nxt_btn', 'landing_section', 'normal', 'default' );
	
}


//display metabox
function landing_bg() {
	global $post;

	echo '<input type="hidden" name="landingmeta_noncename" id="landingmeta_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	$background = get_post_meta($post->ID, '_background', true);

	echo '<input type="text" name="_background" value="' . $background . '" class="widefat" />';
}


//widescreen backgorund
function landing_bg_img_wide() {
	global $post;

	echo '<input type="hidden" name="landingmeta_noncename" id="landingmeta_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	$background_img_wide = get_post_meta($post->ID, '_background_img_wide', true);

	echo '<input type="text" name="_background_img" value="' . $background_img . '" class="widefat" />';
}

//portrait background
function landing_bg_img_portrait() {
	global $post;

	echo '<input type="hidden" name="landingmeta_noncename" id="landingmeta_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	$background_img_portrait = get_post_meta($post->ID, '_background_img_portrait', true);

	echo '<input type="text" name="_background_img" value="' . $background_img_portrait . '" class="widefat" />';
}


function landing_nxt_btn() {
	global $post;

	echo '<input type="hidden" name="landingmeta_noncename" id="landingmeta_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	$nxt_btn_target = get_post_meta($post->ID, '_nxt_btn_target', true);

	echo '<input type="text" name="_nxt_btn_target" value="' . $nxt_btn_target . '" class="widefat" />';
}

function landing_nxt_btn_text() {
	global $post;

	echo '<input type="hidden" name="landingmeta_noncename" id="landingmeta_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	$nxt_btn_text = get_post_meta($post->ID, '_nxt_btn_text', true);

	echo '<input type="text" name="_nxt_btn_text" value="' . $nxt_btn_text . '" class="widefat" />';
}

//save metabox data
function save_landing_meta($post_id = false, $post = false) {

	//verify source
	if ( !wp_verify_nonce( $_POST['landingmeta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}

	//check user auth
	if ( !current_user_can('edit_post', $post->ID))
		return $post->ID;

	$landing_meta['_background'] = $_POST['_background'];
	$landing_meta['_background_img_wide'] = $_POST['_background_img_wide'];
	$landing_meta['_background_img_portrait'] = $_POST['_background_img_portrait'];
	$landing_meta['_nxt_btn_target'] = $_POST['_nxt_btn_target'];
	$landing_meta['_nxt_btn_text'] = $_POST['_nxt_btn_text'];

	foreach( $landing_meta as $key => $value) {
		if( $post->post_type == 'revision') return; //dont store custom data twice
		$value = implode(',', (array)$value); //if $value is an array, make it a CSV
		if(get_post_meta($post->ID, $key, FALSE)){//if the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); //delete if blank
	}

	//make sure slugs/ids update on title changes

	$new_slug = sanitize_title( $post->post_title );
	if ( $post->post_name != $new_slug ){
		wp_update_post(
			array (
				'ID'			=> $post->ID,
				'post_name'		=> $new_slug,
				)
			);
	}		
}

add_action('save_post', 'save_landing_meta', 1, 2);
add_action('edit_post', 'save_landing_meta', 1, 2);
add_action('publish_post', 'save_landing_meta', 1, 2);
add_action('edit_page_form', 'save_landing_meta', 1, 2);


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/*
		ADD CUSTOM HEADER FIELDS
		
	
*/
function header_text_customizer( $wp_customize ) {
    
	//add logo

	$wp_customize->add_section(
		'header_section_four',
		array(
            'title' => 'Site Logo',
            'description' => 'Your Brand Logo',
            'priority' => 35,
        )
	);

	$wp_customize->add_setting('site_logo');

	$wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize,'site_logo',array(
		 'label'      => __('Site Logo', 'nhs3_s'),
		 'section'    => 'header_section_four',
		 'settings'   => 'site_logo',
		 )
		)
	);

	
	//responsive background image
	$wp_customize->add_section(
		'header_section_five',
		array(
            'title' => 'Responsive Header Background',
            'description' => 'Images for responsive header',
            'priority' => 35,
        )
	);

	$wp_customize->add_setting('bg_large');

	$wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize,'bg_large',array(
		 'label'      => __('Large Background', 'nhs3_s'),
		 'section'    => 'header_section_five',
		 'settings'   => 'bg_large',
		 )
		)
	);

	$wp_customize->add_setting('bg_med');

	$wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize,'bg_med',array(
		 'label'      => __('Medium Background', 'nhs3_s'),
		 'section'    => 'header_section_five',
		 'settings'   => 'bg_med',
		 )
		)
	);

	$wp_customize->add_setting('bg_small');

	$wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize,'bg_small',array(
		 'label'      => __('Small Background', 'nhs3_s'),
		 'section'    => 'header_section_five',
		 'settings'   => 'bg_small',
		 )
		)
	);


    //CTA button options
    $wp_customize->add_section(
        'header_section_one',
        array(
            'title' => 'Header Call to Action Button',
            'description' => 'Call to Action button',
            'priority' => 35,
        )
    );

    $wp_customize->add_setting(
    	'button_textbox',
    	array(
    	    'default' => 'Learn More!',
    	)
	);

	$wp_customize->add_control(
   		'button_textbox',
   	 	array(
   	   	  'label' => 'Text for Call to Action button',
   	   	  'section' => 'header_section_one',
   	   	  'type' => 'text',
   	 	)
	);

	

		//Social
		$wp_customize->add_section(
	        'header_section_two',
	        array(
	            'title' => 'Header Social Media',
	            'description' => 'Link to your social accounts',
	            'priority' => 35,
	        )
	    );

			//Facebook
		    $wp_customize->add_setting(
		    	'facebook_textbox',
		    	array(
		    	    'default' => '',
		    	)
			);

			$wp_customize->add_control(
		   		'facebook_textbox',
		   	 	array(
		   	   	  'label' => 'Your Facebook Page',
		   	   	  'section' => 'header_section_two',
		   	   	  'type' => 'text',
		   	 	)
			);

			//Twitter
			$wp_customize->add_setting(
		    	'twitter_textbox',
		    	array(
		    	    'default' => '',
		    	)
			);

			$wp_customize->add_control(
		   		'twitter_textbox',
		   	 	array(
		   	   	  'label' => 'Your Twitter Page',
		   	   	  'section' => 'header_section_two',
		   	   	  'type' => 'text',
		   	 	)
			);


			//Instagram
			$wp_customize->add_setting(
		    	'instagram_textbox',
		    	array(
		    	    'default' => '',
		    	)
			);

			$wp_customize->add_control(
		   		'instagram_textbox',
		   	 	array(
		   	   	  'label' => 'Your Instagram Page',
		   	   	  'section' => 'header_section_two',
		   	   	  'type' => 'text',
		   	 	)
			);

			//LinkedIn
			$wp_customize->add_setting(
		    	'linkedin_textbox',
		    	array(
		    	    'default' => '',
		    	)
			);

			$wp_customize->add_control(
		   		'linkedin_textbox',
		   	 	array(
		   	   	  'label' => 'Your LinkedIn Page',
		   	   	  'section' => 'header_section_two',
		   	   	  'type' => 'text',
		   	 	)
			);

		//Secondary button options

			
	    $wp_customize->add_section(
	        'header_section_three',
	        array(
	            'title' => 'Header Secondary Button',
	            'description' => 'Secondary button',
	            'priority' => 35,
	        )
	    );

	    //Button Text
	    $wp_customize->add_setting(
	    	'sec_button_textbox',
	    	array(
	    	    'default' => 'Login',
	    	)
		);

		$wp_customize->add_control(
	   		'sec_button_textbox',
	   	 	array(
	   	   	  'label' => 'Text for Secondary button',
	   	   	  'section' => 'header_section_three',
	   	   	  'type' => 'text',
	   	 	)
		);

		//Button Target
	    $wp_customize->add_setting(
	    	'sec_button_target',
	    	array(
	    	    'default' => '/login',
	    	)
		);

		$wp_customize->add_control(
	   		'sec_button_target',
	   	 	array(
	   	   	  'label' => 'Target for Secondary button',
	   	   	  'section' => 'header_section_three',
	   	   	  'type' => 'text',
	   	 	)
		);

		//Button Label
	    $wp_customize->add_setting(
	    	'sec_button_label',
	    	array(
	    	    'default' => '',
	    	)
		);

		$wp_customize->add_control(
	   		'sec_button_label',
	   	 	array(
	   	   	  'label' => 'Label for Secondary button',
	   	   	  'section' => 'header_section_three',
	   	   	  'type' => 'text',
	   	 	)
		);



}
add_action( 'customize_register', 'header_text_customizer' );

add_filter('show_admin_bar', '__return_false');



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

