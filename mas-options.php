<?php
/**
 *
 * Fak Options
 *
 * @package fak
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 *  Load Options Fields
 */
function mas_options_fields() {
	Container::make( 'theme_options', 'MAS Options' )
	->add_fields(
		array(
			// Checkbox Enable mas.
			Field::make( 'checkbox', 'mas_enable', 'Enable MAS' )
			->set_option_value( 'yes' )
			->set_default_value( true )
			->set_help_text( 'Enable or disable MAS' ),

			// Select to disable Mas on below 768, 480.
			Field::make( 'select', 'mas_disable', 'Disable MAS on screen below' )
			->add_options(
				array(
					'none' => 'Alwyas Show',
					'769'  => 'Hide on screen below 769px',
					'493'  => 'Hide on screen below 493px',
				)
			)
			->set_default_value( 'none' )
			->set_help_text( 'Select to disable MAS on below screen width 769, 493' ),

			// Select position left or right.
			Field::make( 'select', 'mas_position', 'Position' )
			->add_options(
				array(
					'left'  => 'Left',
					'right' => 'Right',
				)
			)
			->set_default_value( 'left' )
			->set_help_text( 'Select position for MAS' ),

			// Z-index for MAS.
			Field::make( 'text', 'mas_zindex', 'Z-index' )
			->set_attribute( 'type', 'number' )
			->set_default_value( '9999' )
			->set_help_text( 'Set z-index for MAS, you can increase or decrease the value according another elements on your site.' ),

			// Enable link in close ads.
			Field::make( 'checkbox', 'mas_close_link', 'Enable Link in Close Button' )
			->set_option_value( 'yes' )
			->set_default_value( false )
			->set_help_text( 'Enable or disable link in close button' ),

			// Link in close button.
			Field::make( 'text', 'mas_close_link_url', 'Close Button Link' )
			->set_default_value( 'https://budiharyono.id' )
			->set_help_text( 'Set link for close button' )
			->set_conditional_logic(
				array(
					array(
						'field'   => 'mas_close_link',
						'compare' => '=',
						'value'   => true,
					),
				)
			),

			// How to show ads, random one ads in every refresh or show all ads as slide.
			Field::make( 'select', 'mas_show', 'Show' )
			->add_options(
				array(
					'random' => 'Random',
					'slide'  => 'Slide',
				)
			)
			->set_default_value( 'random' )
			->set_help_text( 'Select how to show ads, if random, it will show random one ads in every refresh, if all, it will show all ads as slide.' ),

			// Slide duration if show all ads as slide.
			Field::make( 'text', 'mas_slide_duration', 'Slide Duration' )
			->set_attribute( 'type', 'number' )
			->set_default_value( 5000 )
			->set_help_text( 'Set slide duration in milisecond, e.g 5000 for 5 seconds' )
			->set_conditional_logic(
				array(
					array(
						'field'   => 'mas_show',
						'compare' => '=',
						'value'   => 'slide',
					),
				)
			),

			// Background color for ads.
			Field::make( 'color', 'mas_bg_color', 'Background Color' )
			->set_default_value( '#000000' )
			->set_help_text( 'Set background color for ads' ),

			// Text color for ads.
			Field::make( 'color', 'mas_text_color', 'Text Color' )
			->set_default_value( '#ffffff' )
			->set_help_text( 'Set text color for ads' ),

			// Button background color for ads.
			Field::make( 'color', 'mas_button_bg_color', 'Button Background Color' )
			->set_default_value( '#ff0000' )
			->set_help_text( 'Set button background color for ads' ),

			// Button text color for ads.
			Field::make( 'color', 'mas_button_text_color', 'Button Text Color' )
			->set_default_value( '#ffffff' )
			->set_help_text( 'Set button text color for ads' ),

			// Background color close button.
			Field::make( 'color', 'mas_close_bg_color', 'Close Button Background Color' )
			->set_default_value( '#ff0000' )
			->set_help_text( 'Set background color for close button' ),

			// Text color close button.
			Field::make( 'color', 'mas_close_text_color', 'Close Button Text Color' )
			->set_default_value( '#ffffff' )
			->set_help_text( 'Set text color for close button' ),

			// Ads.
			Field::make( 'complex', 'mas_ads', 'Ads' )
			->add_fields(
				array(

					// Image or text.
					Field::make( 'select', 'mas_type', 'Type' )
					->add_options(
						array(
							'image' => 'Image',
							'text'  => 'Text',
						)
					)
					->set_default_value( 'text' )
					->set_help_text( 'Select type for ads' ),

					// Head for ads.
					Field::make( 'text', 'mas_head', 'Head' )
					->set_required( true )
					->set_default_value( 'Promo' )
					->set_help_text( 'Set head for ads, e.g "Promo"' ),

					// Content for ads.
					Field::make( 'textarea', 'mas_content', 'Content' )
					->set_required( true )
					->set_default_value( 'Promo Discount iPhone Pro Max hanya 10Jt asli bukan penipuan' )
					->set_help_text( 'Set content for ads, e.g "Promo Discount iPhone Pro Max hanya 10Jt asli bukan penipuan"' )
					->set_conditional_logic(
						array(
							array(
								'field'   => 'mas_type',
								'compare' => '=',
								'value'   => 'text',
							),
						)
					),

					Field::make( 'image', 'mas_image', 'Image' )
					->set_required( true )
					->set_value_type( 'url' )
					->set_help_text( 'Upload image for ads, recomended size is 250x250px' )
					->set_conditional_logic(
						array(
							array(
								'field'   => 'mas_type',
								'compare' => '=',
								'value'   => 'image',
							),
						)
					),

					// Link for ads.
					Field::make( 'text', 'mas_link', 'Link' )
					->set_required( true )
					->set_help_text( 'Set link for ads' ),

					// Button text for ads.
					Field::make( 'text', 'mas_button_text', 'Button Text' )
					->set_required( true )
					->set_default_value( 'Buy Now' )
					->set_help_text( 'Set button text for ads, e.g Buy Now' ),

					// checkbox to enable individual ads.
					Field::make( 'checkbox', 'mas_individual_style', 'Enable Ads Individual Ads' )
					->set_option_value( 'yes' )
					->set_default_value( false )
					->set_help_text( 'Enable or disable individual ads, if not check it will use parent style' ),

					// background color for ads.
					Field::make( 'color', 'mas_ads_individual_bg_color', 'Background Color' )
					->set_default_value( '#000000' )
					->set_help_text( 'Set background color for individual ads' ),

					// text color for ads.
					Field::make( 'color', 'mas_ads_individual_text_color', 'Text Color' )
					->set_default_value( '#ffffff' )
					->set_help_text( 'Set text color for individual ads' ),

					// button background color for ads.
					Field::make( 'color', 'mas_ads_individual_button_bg_color', 'Button Background Color' )
					->set_default_value( '#ff0000' )
					->set_help_text( 'Set button background color for individual ads' ),

					// button text color for ads.
					Field::make( 'color', 'mas_ads_individual_button_text_color', 'Button Text Color' )
					->set_default_value( '#ffffff' )
					->set_help_text( 'Set button text color for individual ads' ),

				)
			),

		)
	);
}
add_action( 'carbon_fields_register_fields', 'mas_options_fields' );
