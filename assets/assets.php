<?php
/**
 *
 * Assets
 *
 * @package fak
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

/**
 * Load Assets CSS and JS
 */
function mas_assets() {

	// Load animate.css library from CDN.
	wp_enqueue_style( 'mas-animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), '4.1.1', 'all' );

	$mas_enable = carbon_get_theme_option( 'mas_enable' );
	$mas_show   = carbon_get_theme_option( 'mas_show' );
	if ( 'slide' === $mas_show && $mas_enable ) {
		$mas_ads       = carbon_get_theme_option( 'mas_ads' );
		$mas_ads_count = count( $mas_ads );
		if ( $mas_ads_count > 1 ) {

			// Load slick css.
			wp_enqueue_style( 'mas-slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css', array(), '1.9.0', 'all' );

			// Load slick js.
			wp_enqueue_script( 'mas-slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array(), '1.9.0', true );

		}
	}

	$suffix = mas_is_devmode() ? '' : '.min';

	wp_enqueue_style( 'mas-css', MAS_URL . 'assets/css/mas' . $suffix . '.css', array(), '1.0.0', 'all' );
	wp_enqueue_script( 'mass-js', MAS_URL . 'assets/js/mas-js' . $suffix . '.js', array( 'jquery' ), '1.0.0', true );
}

/**
 *  Custom CSS
 */
function mas_custom_css() {
	$mas_enable = carbon_get_theme_option( 'mas_enable' );
	if ( $mas_enable ) {
		$mas_custom_css = carbon_get_theme_option( 'mas_custom_css' );
		if ( $mas_custom_css ) {
			echo '<style>' . esc_html( $mas_custom_css ) . '</style>';
		}
	}
}


/**
 * Load Admin Style and Scripts
 */
function mas_admin_assets() {
	$suffix = mas_is_devmode() ? '' : '.min';
	wp_enqueue_style( 'mas-admin-css', MAS_URL . 'assets/css/mas-admin' . $suffix . '.css', array(), '1.0.0', 'all' );
}

/**
 * Load Style and Scripts
 */
function mas_load_necessary_style_and_scripts() {
	$mas_enable = carbon_get_theme_option( 'mas_enable' );
	if ( $mas_enable ) {
		add_action( 'wp_enqueue_scripts', 'mas_assets' );
		add_action( 'wp_head', 'mas_custom_css' );
		add_action( 'admin_enqueue_scripts', 'mas_admin_assets' );
	}
}
add_action( 'init', 'mas_load_necessary_style_and_scripts' );
