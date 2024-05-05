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
			->set_help_text( '<span class="masred">Enable or disable MAS, please be aware to field mark with * with red color is required!! you can not save your ads before fields is filled.</span>' ),

			// #####################################################################
			// Global Options
			// #####################################################################

			Field::make( 'separator', 'globoptions', 'Global Options' )
			->set_classes( 'sepmas' ),

			// Select to disable Mas on below 768, 480.
			Field::make( 'select', 'mas_disable', 'Disable MAS on screen below' )
			->set_width( 33 )
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
			->set_width( 33 )
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
			->set_width( 33 )
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
			Field::make( 'select', 'mas_show', 'How to show your ads?' )
				->add_options(
					array(
						'random' => 'Random',
						'slide'  => 'Slide',
					)
				)
		->set_default_value( 'random' )
		->set_help_text( 'Select how to show ads, if random, it will show random one ads in every refresh, if slide it will show all ads as slide.' ),

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

			// #####################################################################
			// Global Styling
			// #####################################################################

			Field::make( 'separator', 'globalstyling', 'Global Styling' )
			->set_classes( 'sepmas' ),

			// Background color for ads.
			Field::make( 'color', 'mas_bg_color', 'Background Color' )
			->set_width( 33 )
			->set_default_value( '#000000' )
			->set_help_text( 'Set background color for ads' ),

			// Text color for ads.
			Field::make( 'color', 'mas_text_color', 'Text Color' )
			->set_width( 33 )
			->set_default_value( '#ffffff' )
			->set_help_text( 'Set text color for ads' ),

			// Button background color for ads.
			Field::make( 'color', 'mas_button_bg_color', 'Button Background Color' )
			->set_width( 33 )
			->set_default_value( '#ff0000' )
			->set_help_text( 'Set button background color for ads' ),

			// Button text color for ads.
			Field::make( 'color', 'mas_button_text_color', 'Button Text Color' )
			->set_width( 33 )
			->set_default_value( '#ffffff' )
			->set_help_text( 'Set button text color for ads' ),

			// Background color close button.
			Field::make( 'color', 'mas_close_bg_color', 'Close Button Background Color' )
			->set_width( 33 )
			->set_default_value( '#ff0000' )
			->set_help_text( 'Set background color for close button' ),

			// Text color close button.
			Field::make( 'color', 'mas_close_text_color', 'Close Button Text Color' )
			->set_width( 33 )
			->set_default_value( '#ffffff' )
			->set_help_text( 'Set text color for close button' ),

			// #####################################################################
			// Source ADS
			// #####################################################################

			Field::make( 'separator', 'massourcesep', 'Choose Source Ads' )
			->set_classes( 'sepmas' ),

			// Select to select source with option: post category, post tag, post type, or custom post type.
			Field::make( 'select', 'mas_source', 'Source Your Ads?' )
			->add_options(
				array(
					'post_ids'         => 'Post IDs',
					'custom'           => 'Custom',
					'post_category'    => 'Post Category',
					'post_tag'         => 'Post Tag',
					'custom_post_type' => 'Custom Post Type',
				)
			)
			->set_default_value( 'custom' )
			->set_help_text( 'Select source for ads, custom is custom ads, post category is ads from post category, post tag is ads from post tag, custom post type is ads from custom post type, post ids is ads from post ids' ),

			// #####################################################################
			// Your ADS
			// #####################################################################

			Field::make( 'separator', 'youradsssss', 'Set Your ADS' )
			->set_classes( 'sepmas' ),

			// Select post IDs if choose post_ids.
			Field::make( 'text', 'mas_post_ids', 'Post IDs' )
			->set_required( true )
			->set_help_text( 'Set post IDs, e.g 1,2,3' )
			->set_conditional_logic(
				array(
					array(
						'field'   => 'mas_source',
						'compare' => '=',
						'value'   => 'post_ids',
					),
				)
			),

			// Select post category ID if choose post_category.
			Field::make( 'text', 'mas_post_category', 'ID Post Category' )
			->set_required( true )
			->set_attribute( 'type', 'number' )
			->set_help_text( 'Set post category ID, e.g 1,2,3' )
			->set_conditional_logic(
				array(
					array(
						'field'   => 'mas_source',
						'compare' => '=',
						'value'   => 'post_category',
					),
				)
			),

			// Select post tag ID if choose post_tag.
			Field::make( 'text', 'mas_post_tag', 'ID Post Tag' )
			->set_required( true )
			->set_attribute( 'type', 'number' )
			->set_help_text( 'Set post tag ID, e.g 1,2,3' )
			->set_conditional_logic(
				array(
					array(
						'field'   => 'mas_source',
						'compare' => '=',
						'value'   => 'post_tag',
					),
				)
			),

			// custom_post_type name if choose custom_post_type.
			Field::make( 'text', 'mas_custom_post_type', 'Custom Post Type' )
			->set_required( true )
			->set_help_text( 'Set custom post type name e.g your custom post type name' )
			->set_conditional_logic(
				array(
					array(
						'field'   => 'mas_source',
						'compare' => '=',
						'value'   => 'custom_post_type',
					),
				)
			),

			// number of ads to show if selection is not custom.
			Field::make( 'text', 'mas_number', 'Number of Ads' )
			->set_required( true )
			->set_attribute( 'type', 'number' )
			->set_default_value( 5 )
			->set_help_text( 'Set number of ads to show' )
			->set_conditional_logic(
				array(
					array(
						'field'   => 'mas_source',
						'compare' => '!=',
						'value'   => 'custom',
					),
				)
			),

			// trim excerpt length for ads content if selection is not custom.
			Field::make( 'text', 'mas_excerpt_length', 'Excerpt Length' )
			->set_required( true )
			->set_attribute( 'type', 'number' )
			->set_default_value( 20 )
			->set_help_text( 'Set excerpt length for ads content' )
			->set_conditional_logic(
				array(
					array(
						'field'   => 'mas_source',
						'compare' => '!=',
						'value'   => 'custom',
					),
				)
			),

			// button text for ads if selection is not custom.
			Field::make( 'text', 'mas_button_text', 'Button Text' )
			->set_required( true )
			->set_default_value( 'Buy Now' )
			->set_help_text( 'Set button text for ads, e.g Buy Now' )
			->set_conditional_logic(
				array(
					array(
						'field'   => 'mas_source',
						'compare' => '!=',
						'value'   => 'custom',
					),
				)
			),

			// checkbox to include featured image if selection is not custom.
			Field::make( 'checkbox', 'mas_featured_image', 'Include Featured Image' )
			->set_option_value( 'yes' )
			->set_default_value( false )
			->set_help_text( 'Include or exclude featured image' )
			->set_conditional_logic(
				array(
					array(
						'field'   => 'mas_source',
						'compare' => '!=',
						'value'   => 'custom',
					),
				)
			),

			// Ads.
			Field::make( 'complex', 'mas_ads', 'Ads' )
			->set_layout( 'tabbed-horizontal' )
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
					Field::make( 'checkbox', 'mas_individual_style', 'Enable Ads Individual Ads for this ad' )
					->set_option_value( 'yes' )
					->set_default_value( false )
					->set_help_text( 'Enable or disable individual ads, if not check it will use parent style if check it will overwrite global style according styling options below' ),

					// background color for ads.
					Field::make( 'color', 'mas_ads_individual_bg_color', 'Background Color' )
					->set_width( 25 )
					->set_default_value( '#000000' )
					->set_help_text( 'Set background color for individual ads' ),

					// text color for ads.
					Field::make( 'color', 'mas_ads_individual_text_color', 'Text Color' )
					->set_width( 25 )
					->set_default_value( '#ffffff' )
					->set_help_text( 'Set text color for individual ads' ),

					// button background color for ads.
					Field::make( 'color', 'mas_ads_individual_button_bg_color', 'Button Background Color' )
					->set_width( 25 )
					->set_default_value( '#ff0000' )
					->set_help_text( 'Set button background color for individual ads' ),

					// button text color for ads.
					Field::make( 'color', 'mas_ads_individual_button_text_color', 'Button Text Color' )
					->set_width( 25 )
					->set_default_value( '#ffffff' )
					->set_help_text( 'Set button text color for individual ads' ),

				)
			)
			->set_help_text( 'Set ads' )
			->set_conditional_logic(
				array(
					array(
						'field'   => 'mas_source',
						'compare' => '=',
						'value'   => 'custom',
					),
				)
			)
			->set_layout( 'tabbed-horizontal' )
				->set_header_template(
					'
                <% if (mas_head) { %>
                    <%- mas_head %>
                <% } else { %>
                    Ads
                <% } %>
            '
				),

		)
	);
}
add_action( 'carbon_fields_register_fields', 'mas_options_fields' );
