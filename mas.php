<?php
/**
 *
 * Plugin Name: MM ADS Slideout
 * Description: A plugin to show ads as slide in position fixed bottom
 * Version: 1.0.0
 * Author: Budi Haryono
 * Author URI: https://budiharyono.id
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package fak
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

/**
 * Check CF Loaded
 */
function mas_call_carbon_fields() {
	if ( ! class_exists( '\Carbon_Fields\Carbon_Fields' ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
		\Carbon_Fields\Carbon_Fields::boot();
	} else {
		return;
	}
}

/**
 * MCS CF Loaded
 */
function mas_cf_loaded() {
	if ( ! function_exists( 'carbon_fields_boot_plugin' ) ) {
		mas_call_carbon_fields();
	} else {
		return;
	}
}
add_action( 'plugins_loaded', 'mas_cf_loaded' );


/**
 * Check if the current environment is development mode or on production
 * development mode is when the server is localhost
 * output: boolean
 */
function mas_is_devmode() {
	if ( isset( $_SERVER['REMOTE_ADDR'] ) && in_array( $_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1' ), true ) ) {
		return true;
	}
	return false;
}


/**
 * MasmonsThemeFunction
 *
 * @package MasmonsTheme
 * @author Budi Haryono <mail.budiharyono@gmail.com>
 * @since 019
 * @param array $html_tags_allowed Array of allowed HTML tags.
 */
function mas_kses( $html_tags_allowed = array() ) {
	if ( ! is_array( $html_tags_allowed ) ) {
		return array(); // Kembalikan array kosong jika input tidak valid.
	}
	$pass = array();

	// Definisikan atribut untuk SVG.
	$svg_args = array(
		'class'             => true,
		'aria-hidden'       => true,
		'aria-labelledby'   => true,
		'role'              => true,
		'xmlns'             => true,
		'width'             => true,
		'height'            => true,
		'viewBox'           => true,
		'version'           => true,
		'xmlns:xlink'       => true,
		'x'                 => true,
		'y'                 => true,
		'enable-background' => true,
		'xml:space'         => true,
		'metadata'          => true,
		'style'             => true,
		'viewbox'           => true,
		'path'              => true,
		'fill'              => true,
		'fill-rule'         => true,
		'clip-rule'         => true,
		'd'                 => true,
	);

	foreach ( $html_tags_allowed as $tag ) {
		$attributes = array(
			'class' => array(),
			'id'    => array(), // Tambahkan atribut id.
		);

		// Tambahkan atribut tambahan untuk tag spesifik.
		if ( 'img' === $tag ) {
			$attributes['src']    = array();
			$attributes['alt']    = array();
			$attributes['title']  = array();
			$attributes['width']  = array();
			$attributes['height'] = array();
		}

		if ( 'a' === $tag ) {
			$attributes['href']   = array();
			$attributes['target'] = array();
			$attributes['rel']    = array();
			$attributes['style']  = array();
			$attributes['class']  = array();
		}

		// Jika tag adalah SVG, gunakan atribut yang telah didefinisikan dalam $svg_args.
		if ( 'svg' === $tag ) {
			$attributes = $svg_args;
		}

		// iframe.
		if ( 'iframe' === $tag ) {
			$attributes['src']             = true;
			$attributes['width']           = true;
			$attributes['height']          = true;
			$attributes['frameborder']     = true;
			$attributes['allowfullscreen'] = true;
		}

		// Jika tag adalah div, tambahkan atribut data-xxxx dengan validasi nilai hex.
		if ( 'div' === $tag ) {
			$attributes = array_merge(
				$attributes,
				array(
					'/^data-[a-zA-Z0-9\-]*$/' => array(
						'pattern' => '/^#[a-fA-F0-9]{6}$/',
					),
				)
			);
		}

		$pass[ $tag ] = $attributes;
	}

	// Tambahkan elemen lain yang diperlukan untuk SVG.
	$pass['g']     = array( 'fill' => true );
	$pass['title'] = array( 'title' => true );
	$pass['path']  = array(
		'd'    => true,
		'fill' => true,
	);

	return $pass;
}





// Define plugin path.
define( 'MAS_PATH', plugin_dir_path( __FILE__ ) );

// Define plugin URL.
define( 'MAS_URL', plugin_dir_url( __FILE__ ) );


/**
 * Shortcut
 */
function mas_shortcut_to_options() {
	// Current User can manage options and logged in.
	if ( current_user_can( 'manage_options' ) && is_user_logged_in() ) {
		// Link to options page.
		$shortcut = '<a class="mas-shortcut" href="' . esc_url( admin_url( 'admin.php?page=crb_carbon_fields_container_mas_options.php' ) ) . '">' . esc_html__( 'Options Page', 'mas' ) . '</a>';
		// Output.
		return $shortcut;
	} else {
		return;
	}
}





// required files.
require_once MAS_PATH . 'assets/assets.php';
require_once MAS_PATH . 'components/components.php';
require_once MAS_PATH . 'mas-options.php';
