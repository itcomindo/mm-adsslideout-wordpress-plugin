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
	<div id="mas-pr" class="mas-sleep" data-mas-disable-on="<?php echo esc_html( $mas_disable_on ); ?>" data-show-mas="<?php echo esc_html( mas_beh()['show_as'] ); ?>"   style="<?php echo esc_html( mas_beh()['position'] ) . ':4px'; ?>; z-index: <?php echo esc_html( mas_beh()['zindex'] ); ?>; background-color:<?php echo esc_html( mas_beh()['background'] ); ?>; color:<?php echo esc_html( mas_beh()['text_color'] ); ?>;" <?php echo esc_attr( mas_beh()['duration'] ); ?>>
		<?php
		// phpcs:ignore
		echo mas_beh()['close'];
		?>
		<div id="mas-wr">
			<?php
			$mas_show = carbon_get_theme_option( 'mas_show' );
			if ( 'random' === $mas_show ) {
				mas_random_ads();
			} else {
				mas_slide_ads();
			}
			?>
		</div>
	</div>
		<?php
	}
}

add_action( 'wp_body_open', 'mas_container', 10 );


/**
 * MAS GET RANDOM ADS
 */
function mas_random_ads() {
	$mas_ads = carbon_get_theme_option( 'mas_ads' );
	// Randomize the ads.
	shuffle( $mas_ads );
	// Get one ads from the array.
	$mas_ads = array_slice( $mas_ads, 0, 1 );
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

/**
 * MAS text
 *
 * @param string $head Head.
 * @param string $content Content.
 * @param string $button_text Button text.
 * @param string $link Link.
 * @param string $mas_individual_style Individual style.
 * @param string $mas_ads_individual_bg_color Background color.
 * @param string $mas_ads_individual_text_color Text color.
 * @param string $mas_ads_individual_button_bg_color Button background color.
 * @param string $mas_ads_individual_button_text_color Button text color.
 */
function mas_text( $head, $content, $button_text, $link, $mas_individual_style, $mas_ads_individual_bg_color, $mas_ads_individual_text_color, $mas_ads_individual_button_bg_color, $mas_ads_individual_button_text_color ) {
	$pass = mas_kses( array( 'a', 'b', 'strong', 'span', 'div' ) );
	if ( $mas_individual_style ) {
		$style = 'style="background-color: ' . $mas_ads_individual_bg_color . '; color: ' . $mas_ads_individual_text_color . ';"';
	} else {
		$style = '';
	}
	?>
	<div class="mas-item mas-text" 
	<?php
	//phpcs:ignore.
	echo $style;
	?>
	>
		<h3 class="mas-head"><?php echo esc_html( $head ); ?></h3>
		<span class="mas-ads-content"><?php echo wp_kses( $content, $pass ); ?></span>

		<?php
		if ( $mas_individual_style ) {
			?>
			<a class="mas-btn-cta" style="background-color: <?php echo esc_html( $mas_ads_individual_button_bg_color ); ?>; color: <?php echo esc_html( $mas_ads_individual_button_text_color ); ?>;" href="<?php echo esc_html( $link ); ?>" class="mas-btn" title="<?php echo esc_html( $head ); ?>" rel="noopener nofollow"><?php echo esc_html( $button_text ); ?></a>
			<?php
		} else {
			?>
			<a class="mas-btn-cta" style="background-color: <?php echo esc_html( mas_beh()['button_bg_color'] ); ?>; color: <?php echo esc_html( mas_beh()['button_text_color'] ); ?>;" href="<?php echo esc_html( $link ); ?>" class="mas-btn" title="<?php echo esc_html( $head ); ?>" rel="noopener nofollow"><?php echo esc_html( $button_text ); ?></a>
			<?php
		}
		?>


	</div>
	<?php
}




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

/**
 * MAS image
 *
 * @param string $head Head.
 * @param string $content Content.
 * @param string $button_text Button text.
 * @param string $link Link.
 */
function mas_image( $head, $content, $button_text, $link ) {
	?>
	<div class="mas-item mas-image">
		<a class="mas-img-link-wr" href="<?php echo esc_html( $link ); ?>" class="mas-btn" title="<?php echo esc_html( $head ); ?>" rel="noopener nofollow">
			<img class="mas-find-this" src="<?php echo esc_html( $content ); ?>" alt="<?php echo esc_html( $head ); ?>" alt="<?php echo esc_html( $head ); ?>">
		</a>
		<a class="mas-btn-cta" href="<?php echo esc_html( $link ); ?>" class="mas-btn" title="<?php echo esc_html( $head ); ?>" rel="noopener nofollow"><?php echo esc_html( $button_text ); ?></a>
	</div>
	<?php
}


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