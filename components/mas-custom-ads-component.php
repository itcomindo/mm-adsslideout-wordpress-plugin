<?php
/**
 *
 * Custom ADS Component
 *
 * @package mas
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

/**
 * Get Custom ADS
 */
function mas_get_custom_ads() {
	$mas_show = carbon_get_theme_option( 'mas_show' );
	if ( 'random' === $mas_show ) {
		mas_random_ads();
	} else {
		mas_slide_ads();
	}
}
