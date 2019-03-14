<?php
/*
 * Adds the required CSS to the front end.
 */
add_action( 'wp_enqueue_scripts', 'genesischild_css' );
/**
* Checks the settings for the images and background colors for each image
* If any of these value are set the appropriate CSS is output
*
* @since 1.0
*/
function genesischild_css() {
wp_enqueue_style( 'genesischild', get_stylesheet_directory_uri() . '/style.css' );
 //If your theme does not have it's name defined, don't use the $handle variable just use the actual id of the themes CSS, such as in this example 'genesischild' add it further below - wp_add_inline_style( $handle, $css );
 $handle = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';
 // Add in the correct amount of images into the array
 $opts = apply_filters( 'genesischild_images', array( '1', '2', '3', '4', '5','6', '7', '8', '9', '10', '11', '12' ) );
 $settings = array();
 foreach( $opts as $opt ){
 $settings[$opt]['image'] = preg_replace( '/^https?:/', '', get_option( $opt .'-genesischild-image', sprintf( '%s/images/bg-%s.jpg', get_stylesheet_directory_uri(), $opt ) ) );
 }
 $css = '';
 foreach ( $settings as $section => $value ) {
 $background = $value['image'] ? sprintf( 'background-image: url(%s);', $value['image'] ) : '';
 // Remove the conditional surrounding the code below if the images are appearing on pages other than the front page
 if( is_front_page() ) {
 $css .= ( ! empty( $section ) && ! empty( $background ) ) ? sprintf( '.featured-background-%s { %s }', $section, $background ) : '';
 }
 }
 if ( $css ){
 wp_add_inline_style( $handle, $css ); //so here instead of $handle use your themes CSS ID - which in this case is genesischild
 }
}

