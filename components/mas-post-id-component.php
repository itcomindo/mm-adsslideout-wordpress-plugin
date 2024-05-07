<?php
/**
 *
 * Ads from Ads ID
 *
 * @package mas
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

/**
 * ADS from post ID
 */
function mas_get_post_id_ads() {
	$pass     = mas_kses( array( 'a', 'b', 'strong', 'span', 'div' ) );
	$mas_show = carbon_get_theme_option( 'mas_show' );
	if ( 'random' === $mas_show ) {
		echo wp_kses( mas_get_post_id_random_ads(), $pass );
	} else {
		echo '<div class="mas-item">Ads from Post ID Slide</div>';
	}
}


/**
 * Get Post ID Ads Random
 */
function mas_get_post_id_random_ads() {
	$mas_post_ids = carbon_get_theme_option( 'mas_post_ids' );
	$ids_array    = explode( ',', $mas_post_ids );
	$random_id    = array_rand( $ids_array );
	$ads_to_show  = array( $ids_array[ $random_id ] );

	$args = array(
		'post_type'      => 'post',
		'post__in'       => $ads_to_show,
		'posts_per_page' => 1,
	);

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$post_title      = get_the_title();
			$mas_excerpt     = mas_get_ads_excerpt();
			$mas_button_text = carbon_get_theme_option( 'mas_button_text' );
			?>
			<div class="mas-item mas-text">
				<h3 class="mas-head"><?php echo esc_html( $post_title ); ?></h3>
				<span class="mas-ads-content"><?php echo esc_html( $mas_excerpt ); ?></span>
				<a class="mas-btn-cta mas-btn" style="background-color: <?php echo esc_html( mas_beh()['button_bg_color'] ); ?>; color: <?php echo esc_html( mas_beh()['button_text_color'] ); ?>;" href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_html( $post_title ); ?>" rel="noopener nofollow"><?php echo esc_html( $mas_button_text ); ?></a>
			</div>
			<?php
		}
	}
	wp_reset_postdata();
}