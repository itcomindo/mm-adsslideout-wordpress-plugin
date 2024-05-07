<?php
/**
 *
 * MAS Slide ads
 *
 * @package mas
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );


/**
 *  MAS GET SLIDE ADS
 */
function mas_slide_ads() {
	$mas_ads = carbon_get_theme_option( 'mas_ads' );
	if ( $mas_ads ) {
		foreach ( $mas_ads as $ads ) {
			$mas_type                             = $ads['mas_type'];
			$head                                 = $ads['mas_head'];
			$button_text                          = $ads['mas_button_text'];
			$link                                 = $ads['mas_link'];
			$individual_style                     = $ads['mas_individual_style'];
			$mas_ads_individual_bg_color          = $ads['mas_ads_individual_bg_color'];
			$mas_ads_individual_text_color        = $ads['mas_ads_individual_text_color'];
			$mas_ads_individual_button_bg_color   = $ads['mas_ads_individual_button_bg_color'];
			$mas_ads_individual_button_text_color = $ads['mas_ads_individual_button_text_color'];
			if ( 'image' === $mas_type ) {
				$content = $ads['mas_image'];
				mas_image( $head, $content, $button_text, $link );
			} else {
				$content = $ads['mas_content'];
				mas_text( $head, $content, $button_text, $link, $individual_style, $mas_ads_individual_bg_color, $mas_ads_individual_text_color, $mas_ads_individual_button_bg_color, $mas_ads_individual_button_text_color );
			}
		}
	}
}
