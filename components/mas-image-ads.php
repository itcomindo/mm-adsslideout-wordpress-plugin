<?php
/**
 *
 * MAS Text Ads
 *
 * @package mas
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );


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