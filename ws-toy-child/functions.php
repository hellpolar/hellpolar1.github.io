<?php
/**
 * Genesis WS Baby Toy.
 *
 * This file adds functions to the Genesis WS Baby Toy Theme.
 *
 * @package Genesis WS Baby Toy
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'genesis-sample', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'genesis-sample' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

/* Support WooCommerce */
function woocommerce_setup_genesis() {
  woocommerce_content();
}
add_theme_support( 'woocommerce' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'WS Electaxy' );
define( 'CHILD_THEME_URL', 'http://www.wooskins.com/' );
define( 'CHILD_THEME_VERSION', '1.0' );

//* Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );

	wp_enqueue_style( 'genesis-sample-fontss', 'http://fonts.googleapis.com/css?family=Poppins', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'genesis-sample-custom', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0.0', true );
	$output = array(
		'mainMenu' => __( 'Menu', 'genesis-sample' ),
		'subMenu'  => __( 'Menu', 'genesis-sample' ),
	);
	wp_localize_script( 'genesis-sample-responsive-menu', 'genesisSampleL10n', $output );

}

//* Add HTML5 markup structure 
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
/*add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );
*/
//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 4 );

//* Add Image Sizes
add_image_size( 'featured-image', 720, 400, TRUE );

//* Rename primary and secondary navigation menus
add_theme_support( 'genesis-menus' , array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

//* Modify size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {

	return 90;

}

//* Modify size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}
//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );

//* Do NOT include the opening php tag shown above. Copy the code shown below.
//* Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'sp_custom_footer' );
function sp_custom_footer() {
    ?>
    <div class="ws-footer">
        <p class="ws-footer-left"><a href="https://wooskins.com/free-woocommerce-wordpress-themes/" target="_blank" title="Free WooCommerce Wordpress themes">Free WooCommerce Wordpress themes</a>  by <a href="https://wooskins.com" target="_blank" title="Free WooCommerce themes">Wooskins</a>
        </p>
    </div>
    <?php
}

/* Widget use Genesis Hook */
//* Genesis top header
//* Genesis top left menu
add_action( 'genesis_before_header', 'include_before_header_widgets' );

register_sidebar(array(
    'name' => 'Top left menu',
    'id' => 'top-left-menu',
    'description' => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>'
));

//* Genesis top right menu
register_sidebar(array(
    'name' => 'Top right menu',
    'id' => 'top-right-menu',
    'description' => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>'
));
function include_before_header_widgets() {
	?>
    <div class="before-header">
	<div class="wrap">
		<?php if ( is_active_sidebar( 'top-left-menu' ) ) : ?>
			<div class="top-left-menu">
				<?php dynamic_sidebar( 'top-left-menu' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'top-right-menu' ) ) : ?>
			<div class="top-right-menu">
				<?php dynamic_sidebar( 'top-right-menu' ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php
}

//* Genesis Right Menu
add_action( 'genesis_site_description', 'include_right_menu_widgets' );
register_sidebar(array(
    'name' => 'Right menu',
    'id' => 'right-menu',
    'description' => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>'
));
function include_right_menu_widgets() {
    ?>
    <div class="right-menu">
        <div class="wrap">
            <?php if ( is_active_sidebar( 'right-menu' ) ) : ?>
                    <?php dynamic_sidebar( 'right-menu' ); ?>
            <?php endif; ?>
        </div>
    </div>
<?php
}


//* Genesis after header
add_action( 'body_class', 'my_custom_class');
function my_custom_class( $classes ) {
    if (in_array('home', $classes)) {

        add_action( 'genesis_after_header', 'include_after_header_widgets' );
        function include_after_header_widgets() {
            require(CHILD_DIR.'/inc/after-header.php');
        }

    }
    return $classes;
}

register_sidebar(array(
    'name' => 'Body: Slider',
    'id' => 'after-header-1',
    'description' => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>'
));

register_sidebar(array(
    'name' => 'Body: Intro',
    'id' => 'after-header-2',
    'description' => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>'
));


register_sidebar(array(
    'name' => 'Body: Product',
    'id' => 'after-header-6',
    'description' => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>'
));

register_sidebar(array(
    'name' => 'Body: Client',
    'id' => 'after-header-10',
    'description' => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>'
));


register_sidebar(array(
    'name' => 'Body: Product 2',
    'id' => 'after-header-7',
    'description' => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>'
));


register_sidebar(array(
    'name' => 'Body: Parallax',
    'id' => 'after-header-11',
    'description' => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>'
));


register_sidebar(array(
    'name' => 'Body: Contact',
    'id' => 'after-header-8',
    'description' => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>'
));

// Apply Full Width Content layout to Posts page, Single Posts and Archives.
add_action( 'get_header', 'sk_set_full_layout' );
function sk_set_full_layout() {
    if ( !is_home() ) {
        unregister_sidebar( 'before-content' );
    }
}

add_action( 'get_header', 'sk_set_full_layout_1' );
function sk_set_full_layout_1() {
    if ( !is_home() ) {
        unregister_sidebar( 'after-header' );
    }
}

add_action( 'get_header', 'sk_set_full_layout_2' );
function sk_set_full_layout_2() {
    if ( !is_home() ) {
        unregister_sidebar( 'after-right-header' );
    }
}

//* Create blue, green, orange and red color style options
add_theme_support( 'genesis-style-selector', array(
    'theme-blue'    => __( 'Blue', 'themename' ),
    'theme-green'   => __( 'Green', 'themename' ),
    'theme-orange'  => __( 'Orange', 'themename' ),
    'theme-red' => __( 'Red', 'themename' )
) );

//* Modify the length of post excerpts
add_filter( 'excerpt_length', 'sp_excerpt_length' );
function sp_excerpt_length( $length ) {
    return 70; // pull first 50 words
}

add_filter('jpeg_quality', 'jpeg_quality_callback');
function jpeg_quality_callback($arg) {
   return (int)100;
}


//* font-awesome

function wmpudev_enqueue_icon_stylesheet() {
	wp_register_style( 'fontawesome', 'http:////maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'fontawesome');
}
add_action( 'wp_enqueue_scripts', 'wmpudev_enqueue_icon_stylesheet' );

//Display 24 products on archive pages
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 20 );






