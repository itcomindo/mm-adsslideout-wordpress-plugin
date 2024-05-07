<?php
/**
 *
 * FAQ Container
 *
 * @package mas
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

/**
 *  Launch Mas with conditional
 */
function mas_conditional_launch() {
	$mas_disable_on = carbon_get_theme_option( 'mas_disable' );
	return $mas_disbable_on;
}

/**
 * MAS Container
 */
function mas_container() {
	if ( carbon_get_theme_option( 'mas_enable' ) ) {
		$mas_disable_on = carbon_get_theme_option( 'mas_disable' );
		?>
	<div id="mas-pr" class="mas-sleep" data-mas-delay="<?php echo esc_html( carbon_get_theme_option( 'mas_delay' ) ); ?>" data-mas-disable-on="<?php echo esc_html( $mas_disable_on ); ?>" data-show-mas="<?php echo esc_html( mas_beh()['show_as'] ); ?>"   style="<?php echo esc_html( mas_beh()['position'] ) . ':4px'; ?>; z-index: <?php echo esc_html( mas_beh()['zindex'] ); ?>; background-color:<?php echo esc_html( mas_beh()['background'] ); ?>; color:<?php echo esc_html( mas_beh()['text_color'] ); ?>;" <?php echo esc_attr( mas_beh()['duration'] ); ?>>
		<?php
		// phpcs:ignore
		echo mas_beh()['close'];
		// phpcs:ignore
		echo mas_shortcut_to_options();
		?>
		<div id="mas-wr">
			<?php
			$mas_source = carbon_get_theme_option( 'mas_source' );
			if ( 'post_category' === $mas_source ) {
				mas_get_post_cat_ads();
			} elseif ( 'custom' === $mas_source ) {
				mas_get_custom_ads();
			} elseif ( 'post_tag' === $mas_source ) {
				?>
				<div class="mas-item">Under Construction</div>
				<?php
			} elseif ( 'custom_post_type' === $mas_source ) {
				?>
				<div class="mas-item">Under Construction</div>
				<?php
			} elseif ( 'post_ids' === $mas_source ) {
				mas_get_post_id_ads();
			}
			?>
		</div>
	</div>
		<?php
	}
}

add_action( 'wp_body_open', 'mas_container', 10 );




/**
 * MAS Options
 */
function mas_beh() {
	if ( carbon_get_theme_option( 'mas_enable' ) ) {
		$mas_close_link       = carbon_get_theme_option( 'mas_close_link' );
		$mas_close_bg_color   = carbon_get_theme_option( 'mas_close_bg_color' );
		$mas_close_text_color = carbon_get_theme_option( 'mas_close_text_color' );
		if ( $mas_close_link ) {
			$mas_close_link_url = carbon_get_theme_option( 'mas_close_link_url' );
			$close_ads          = '<div id="mas-close" style="background-color:' . $mas_close_bg_color . '; color:' . $mas_close_text_color . ';"><a href="' . $mas_close_link_url . '" target="_blank" rel="noopener nofollow" title="external link">X</a></div>';
		} else {
			$close_ads = '<div id="mas-close" style="background-color:' . $mas_close_bg_color . '; color:' . $mas_close_text_color . ';">X</div>';
		}

		$mas_show = carbon_get_theme_option( 'mas_show' );
		if ( 'slide' === $mas_show ) {
			$duration = 'data-mas-duration=' . carbon_get_theme_option( 'mas_slide_duration' );
		} else {
			$duration = '';
		}

		$mas = array(
			'position'          => carbon_get_theme_option( 'mas_position' ),
			'zindex'            => carbon_get_theme_option( 'mas_zindex' ),
			'close'             => $close_ads,
			'show_as'           => carbon_get_theme_option( 'mas_show' ), // random or slide.
			'duration'          => $duration,
			'background'        => carbon_get_theme_option( 'mas_bg_color' ),
			'text_color'        => carbon_get_theme_option( 'mas_text_color' ),
			'button_bg_color'   => carbon_get_theme_option( 'mas_button_bg_color' ),
			'button_text_color' => carbon_get_theme_option( 'mas_button_text_color' ),
		);
		return $mas;
	}
}