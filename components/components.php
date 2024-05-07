<?php
/**
 *
 * Components
 *
 * @package fak
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );



require_once MAS_PATH . 'components/mas-container-component.php';
require_once MAS_PATH . 'components/mas-post-cat-component.php';
require_once MAS_PATH . 'components/mas-custom-ads-component.php';
require_once MAS_PATH . 'components/mas-random-ads.php';
require_once MAS_PATH . 'components/mas-text-ads.php';
require_once MAS_PATH . 'components/mas-image-ads.php';
require_once MAS_PATH . 'components/mas-slide-ads.php';


/**
 * MAS GET Query
 *
 * @return object
 */
function mas_get_ads_query() {
	$mas_enable = carbon_get_theme_option( 'mas_enable' );
	if ( $mas_enable ) {
		$mas_number = carbon_get_theme_option( 'mas_number' );
		$mas_source = carbon_get_theme_option( 'mas_source' );
		if ( 'post_category' === $mas_source ) {
			$cat_ids = carbon_get_theme_option( 'mas_post_category' );
			$arg     = array(
				'post_type'      => 'post',
				'posts_per_page' => $mas_number,
				'cat'            => $cat_ids,
			);
		} elseif ( 'post_tag' === $mas_source ) {
			$tag_ids = carbon_get_theme_option( 'mas_post_tag' );
			$arg     = array(
				'post_type'      => 'post',
				'posts_per_page' => $mas_number,
				'tag_id'         => $tag_ids,
			);
		} elseif ( 'custom_post_type' === $mas_source ) {
			$cpt_ids = carbon_get_theme_option( 'mas_custom_post_type' );
			$arg     = array(
				'post_type'      => $cpt_ids,
				'posts_per_page' => $mas_number,
			);
		} elseif ( 'post_ids' === $mas_source ) {
			$post_ids = carbon_get_theme_option( 'mas_post_ids' );
			$arg      = array(
				'post_type'      => 'post',
				'posts_per_page' => $mas_number,
				'post__in'       => $post_ids,
			);
		}
		$mas_query = new WP_Query( $arg );
		return $mas_query;
	}
}
