<?php
/**
 *
 * Mas Post Cat Component
 *
 * @package mas
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

/**
 * Get Post Category ADS
 */
function mas_get_post_cat_ads() {
	$mas_show = carbon_get_theme_option( 'mas_show' );
	if ( 'random' === $mas_show ) {
		mas_post_cat_id_random();
	} else {
		mas_post_cat_id_slide();
	}
}

/**
 * MAS GET RANDOM ADS For Post Category ADS
 */
function mas_post_cat_id_random() {
	$what_show = 'this is post cat random';
	echo esc_html( $what_show );
}


/**
 * MAS GET SLIDE ADS For Post Category ADS
 */
function mas_post_cat_id_slide() {
	$what_show = 'this is post cat slide';
	echo esc_html( $what_show );
}
