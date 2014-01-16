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



add_action( 'init', 'create_post_type' ); 
function create_post_type() { 
    /* set up our Project custom post type */
    register_post_type( 
        'project', 
        array( 
            'labels' => array( 
                'name' => __( 'Projects' ),
                'singular_name' => __( 'Project' ),
                'add_new_item' => __( 'Add Project ' ),
                'edit_item' => __( 'Edit Project' ),
                'new_item' => __( 'New Project' ),
                'view_item' => __( 'View Project' ),
                'search_items' => __( 'Search Projects' ),
                'not_fount' => __( 'No Projects found' ),
            ),
            'public' => true,
            'has_archive' => true,
            'description' => "Projects that may have associated reports",
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'excerpt',
                'custom-fields',
                'revisions'
            ),
            'taxonomies' => array( 'category', 'tag' ),
        )
    ); 
}

/*
 * Use Google viewer to render first page of pdf as image
 */
function pdf_thumbnail( $pdf_url, $alt="[report]", $class="" ){
    $width=160;
    return "<img class=\"$class\" src=\"http://docs.google.com/viewer?url=$pdf_url&a=bi&pagenumber=1&w=$width\" alt=\"$alt\" />";
}

/*
 * Wrap a pfd preview in a link to the original doc
 */
function pdf_link( $pdf_url, $title="", $class="" ){
    return "<a href=\"$pdf_url\" title=\"$title\">" .  
        pdf_thumbnail( $pdf_url, $title, $class ) . "</a>";
}

/*
 * Custom short-code for pdf link with preview
 */
function embed_pdf_with_thumbnail( $atts, $content = null ){
    // TODO: first if $content is relative url, prepend site base url?
    return (is_null($content)) ? "" : pdf_link( $content );
}
add_shortcode('pdf', 'embed_pdf_with_thumbnail');

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
add_action('after_setup_theme', 'web2feel_setup');

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since web2feel 1.0
 */
function web2feel_widgets_init() {
    register_sidebar(
        array(
            'name' => __('Sidebar', 'web2feel'),
            'id' => 'sidebar-1',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        )
    );
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


/* Credits */

function selfURL() {
$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] :
$_SERVER['PHP_SELF'];
$uri = parse_url($uri,PHP_URL_PATH);
$protocol = $_SERVER['HTTPS'] ? 'https' : 'http';
$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
return $protocol."://".$_SERVER['SERVER_NAME'].$port.$uri;
}
