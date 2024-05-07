<?php
/**
 *
 * MAS Text Ads
 *
 * @package mas
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );



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
			<a class="mas-btn-cta mas-btn" style="background-color: <?php echo esc_html( $mas_ads_individual_button_bg_color ); ?>; color: <?php echo esc_html( $mas_ads_individual_button_text_color ); ?>;" href="<?php echo esc_html( $link ); ?>" title="<?php echo esc_html( $head ); ?>" rel="noopener nofollow"><?php echo esc_html( $button_text ); ?></a>
			<?php
		} else {
			?>
			<a class="mas-btn-cta mas-btn" style="background-color: <?php echo esc_html( mas_beh()['button_bg_color'] ); ?>; color: <?php echo esc_html( mas_beh()['button_text_color'] ); ?>;" href="<?php echo esc_html( $link ); ?>"  title="<?php echo esc_html( $head ); ?>" rel="noopener nofollow"><?php echo esc_html( $button_text ); ?></a>
			<?php
		}
		?>


	</div>
	<?php
}