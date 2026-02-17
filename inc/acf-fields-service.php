<?php

/**
 * ACF Field Definitions for Service Post Type
 *
 * Register ACF Pro Flexible Content fields for service pages.
 * Requires ACF Pro plugin to be active.
 *
 * @package GTS
 */

if (! defined('ABSPATH')) {
	exit;
}

/**
 * Register ACF field groups for Services
 */
function gts_register_service_acf_fields()
{
	if (! function_exists('acf_add_local_field_group')) {
		return;
	}

	// Hero Features Repeater Sub-fields
	$hero_features_subfields = array(
		array(
			'key'           => 'field_service_hero_feature_icon',
			'label'         => 'Icon',
			'name'          => 'icon',
			'type'          => 'image',
			'return_format' => 'url',
			'preview_size'  => 'thumbnail',
			'mime_types'    => 'svg,png,webp',
		),
		array(
			'key'   => 'field_service_hero_feature_text',
			'label' => 'Text',
			'name'  => 'text',
			'type'  => 'text',
		),
	);

	// Service Intro Cards Repeater Sub-fields
	$service_intro_items_subfields = array(
		array(
			'key'           => 'field_service_intro_item_icon',
			'label'         => 'Icon',
			'name'          => 'icon',
			'type'          => 'image',
			'return_format' => 'url',
			'preview_size'  => 'thumbnail',
			'mime_types'    => 'svg,png,webp',
		),
		array(
			'key'   => 'field_service_intro_item_title',
			'label' => 'Title',
			'name'  => 'title',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_service_intro_item_description',
			'label' => 'Description',
			'name'  => 'description',
			'type'  => 'textarea',
			'rows'  => 3,
		),
	);

	// Why Us Cards Repeater Sub-fields
	$why_us_cards_subfields = array(
		array(
			'key'           => 'field_service_whyus_card_type',
			'label'         => 'Card Type',
			'name'          => 'card_type',
			'type'          => 'select',
			'choices'       => array(
				'icon'  => 'Icon Card',
				'image' => 'Image Card',
			),
			'default_value' => 'icon',
		),
		array(
			'key'               => 'field_service_whyus_card_image',
			'label'             => 'Background Image',
			'name'              => 'image',
			'type'              => 'image',
			'return_format'     => 'url',
			'preview_size'      => 'medium',
			'conditional_logic' => array(
				array(
					array(
						'field'    => 'field_service_whyus_card_type',
						'operator' => '==',
						'value'    => 'image',
					),
				),
			),
		),
		array(
			'key'               => 'field_service_whyus_card_icon',
			'label'             => 'Icon',
			'name'              => 'icon',
			'type'              => 'image',
			'return_format'     => 'url',
			'preview_size'      => 'thumbnail',
			'mime_types'        => 'svg,png,webp',
			'conditional_logic' => array(
				array(
					array(
						'field'    => 'field_service_whyus_card_type',
						'operator' => '==',
						'value'    => 'icon',
					),
				),
			),
		),
		array(
			'key'   => 'field_service_whyus_card_title',
			'label' => 'Title',
			'name'  => 'title',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_service_whyus_card_description',
			'label' => 'Description',
			'name'  => 'description',
			'type'  => 'textarea',
			'rows'  => 3,
		),
	);

	// Occasions Cards Repeater Sub-fields
	$occasions_cards_subfields = array(
		array(
			'key'           => 'field_service_occasions_card_type',
			'label'         => 'Card Type',
			'name'          => 'card_type',
			'type'          => 'select',
			'choices'       => array(
				'icon'  => 'Icon Card',
				'image' => 'Image Only',
			),
			'default_value' => 'icon',
		),
		array(
			'key'               => 'field_service_occasions_card_image',
			'label'             => 'Image',
			'name'              => 'image',
			'type'              => 'image',
			'return_format'     => 'url',
			'preview_size'      => 'medium',
			'conditional_logic' => array(
				array(
					array(
						'field'    => 'field_service_occasions_card_type',
						'operator' => '==',
						'value'    => 'image',
					),
				),
			),
		),
		array(
			'key'               => 'field_service_occasions_card_icon',
			'label'             => 'Icon',
			'name'              => 'icon',
			'type'              => 'image',
			'return_format'     => 'url',
			'mime_types'        => 'svg,png,webp',
			'conditional_logic' => array(
				array(
					array(
						'field'    => 'field_service_occasions_card_type',
						'operator' => '==',
						'value'    => 'icon',
					),
				),
			),
		),
		array(
			'key'               => 'field_service_occasions_card_title',
			'label'             => 'Title',
			'name'              => 'title',
			'type'              => 'text',
			'conditional_logic' => array(
				array(
					array(
						'field'    => 'field_service_occasions_card_type',
						'operator' => '==',
						'value'    => 'icon',
					),
				),
			),
		),
		array(
			'key'               => 'field_service_occasions_card_description',
			'label'             => 'Description',
			'name'              => 'description',
			'type'              => 'textarea',
			'rows'              => 2,
			'conditional_logic' => array(
				array(
					array(
						'field'    => 'field_service_occasions_card_type',
						'operator' => '==',
						'value'    => 'icon',
					),
				),
			),
		),
	);

	// How It Works Steps Repeater Sub-fields
	$steps_subfields = array(
		array(
			'key'   => 'field_service_step_number',
			'label' => 'Step Number',
			'name'  => 'number',
			'type'  => 'text',
		),
		array(
			'key'           => 'field_service_step_icon',
			'label'         => 'Icon',
			'name'          => 'icon',
			'type'          => 'image',
			'return_format' => 'url',
			'mime_types'    => 'svg,png,webp',
		),
		array(
			'key'   => 'field_service_step_title',
			'label' => 'Title',
			'name'  => 'title',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_service_step_description',
			'label' => 'Description',
			'name'  => 'description',
			'type'  => 'textarea',
			'rows'  => 2,
		),
	);

	// Testimonials Repeater Sub-fields
	$testimonials_subfields = array(
		array(
			'key'   => 'field_service_testimonial_text',
			'label' => 'Review Text',
			'name'  => 'text',
			'type'  => 'textarea',
			'rows'  => 4,
		),
		array(
			'key'   => 'field_service_testimonial_name',
			'label' => 'Author Name',
			'name'  => 'author_name',
			'type'  => 'text',
		),
		array(
			'key'           => 'field_service_testimonial_avatar',
			'label'         => 'Author Avatar',
			'name'          => 'author_avatar',
			'type'          => 'image',
			'return_format' => 'url',
			'preview_size'  => 'thumbnail',
		),
		array(
			'key'           => 'field_service_testimonial_rating',
			'label'         => 'Rating (1-5 stars)',
			'name'          => 'rating',
			'type'          => 'number',
			'min'           => 1,
			'max'           => 5,
			'default_value' => 5,
		),
	);

	// FAQ Repeater Sub-fields
	$faq_subfields = array(
		array(
			'key'   => 'field_service_faq_question',
			'label' => 'Question',
			'name'  => 'question',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_service_faq_answer',
			'label' => 'Answer',
			'name'  => 'answer',
			'type'  => 'textarea',
			'rows'  => 3,
		),
	);

	// Related Services Repeater Sub-fields
	$related_services_subfields = array(
		array(
			'key'   => 'field_service_related_title',
			'label' => 'Title',
			'name'  => 'title',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_service_related_description',
			'label' => 'Description',
			'name'  => 'description',
			'type'  => 'textarea',
			'rows'  => 2,
		),
		array(
			'key'           => 'field_service_related_image',
			'label'         => 'Image',
			'name'          => 'image',
			'type'          => 'image',
			'return_format' => 'url',
			'preview_size'  => 'medium',
		),
		array(
			'key'   => 'field_service_related_link',
			'label' => 'Link URL',
			'name'  => 'link',
			'type'  => 'url',
		),
	);

	// Define all Flexible Content Layouts
	$layouts = array(
		// Layout 1: Hero Section
		'layout_hero'         => array(
			'key'        => 'layout_service_hero',
			'name'       => 'hero',
			'label'      => 'Hero Section',
			'display'    => 'block',
			'sub_fields' => array(
				array(
					'key'           => 'field_service_hero_enabled',
					'label'         => 'Enable Block',
					'name'          => 'enabled',
					'type'          => 'true_false',
					'default_value' => 1,
					'ui'            => 1,
				),
				array(
					'key'   => 'field_service_hero_title',
					'label' => 'Title',
					'name'  => 'title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_service_hero_subtitle',
					'label' => 'Subtitle',
					'name'  => 'subtitle',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				array(
					'key'           => 'field_service_hero_bg_mobile',
					'label'         => 'Background Mobile (375px)',
					'name'          => 'background_mobile',
					'type'          => 'image',
					'return_format' => 'url',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'           => 'field_service_hero_bg_tablet',
					'label'         => 'Background Tablet (1024px)',
					'name'          => 'background_tablet',
					'type'          => 'image',
					'return_format' => 'url',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'           => 'field_service_hero_bg_desktop',
					'label'         => 'Background Desktop (1920px)',
					'name'          => 'background_desktop',
					'type'          => 'image',
					'return_format' => 'url',
					'preview_size'  => 'medium',
				),
				array(
					'key'           => 'field_service_hero_cta_text',
					'label'         => 'CTA Button Text',
					'name'          => 'cta_text',
					'type'          => 'text',
					'default_value' => 'Book a transfer',
				),
				array(
					'key'   => 'field_service_hero_cta_link',
					'label' => 'CTA Button Link',
					'name'  => 'cta_link',
					'type'  => 'url',
				),
				array(
					'key'        => 'field_service_hero_features',
					'label'      => 'Features (3 items)',
					'name'       => 'features',
					'type'       => 'repeater',
					'min'        => 0,
					'max'        => 3,
					'layout'     => 'table',
					'sub_fields' => $hero_features_subfields,
				),
				array(
					'key'   => 'field_service_hero_stats_number',
					'label' => 'Stats Number',
					'name'  => 'stats_number',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_service_hero_stats_label',
					'label' => 'Stats Label',
					'name'  => 'stats_label',
					'type'  => 'text',
				),
			),
		),
		// Layout 2: Service Intro Section (under Hero)
		'layout_service_intro' => array(
			'key'        => 'layout_service_intro',
			'name'       => 'service_intro',
			'label'      => 'Service Intro Section',
			'display'    => 'block',
			'sub_fields' => array(
				array(
					'key'           => 'field_service_intro_enabled',
					'label'         => 'Enable Block',
					'name'          => 'enabled',
					'type'          => 'true_false',
					'default_value' => 1,
					'ui'            => 1,
				),
				array(
					'key'   => 'field_service_intro_title',
					'label' => 'Title',
					'name'  => 'title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_service_intro_description',
					'label' => 'Description',
					'name'  => 'description',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				array(
					'key'           => 'field_service_intro_button_text',
					'label'         => 'Button Text',
					'name'          => 'button_text',
					'type'          => 'text',
					'default_value' => 'Book a transfer',
				),
				array(
					'key'   => 'field_service_intro_button_link',
					'label' => 'Button Link',
					'name'  => 'button_link',
					'type'  => 'url',
				),
				array(
					'key'        => 'field_service_intro_items',
					'label'      => 'Intro Cards',
					'name'       => 'items',
					'type'       => 'repeater',
					'min'        => 0,
					'max'        => 6,
					'layout'     => 'block',
					'sub_fields' => $service_intro_items_subfields,
				),
			),
		),
		// Layout 3: Booking Form (Desktop + Mobile)
		'layout_booking_form' => array(
			'key'        => 'layout_service_booking_form',
			'name'       => 'booking_form',
			'label'      => 'Booking Form',
			'display'    => 'block',
			'sub_fields' => array(
				// Desktop Form Section
				array(
					'key'           => 'field_service_booking_desktop_enabled',
					'label'         => 'Enable Desktop Form',
					'name'          => 'desktop_enabled',
					'type'          => 'true_false',
					'default_value' => 1,
					'ui'            => 1,
					'wrapper'       => array('class' => 'acf-desktop-section'),
				),
				array(
					'key'           => 'field_service_booking_desktop_submit_text',
					'label'         => 'Desktop: Submit Button Text',
					'name'          => 'desktop_submit_text',
					'type'          => 'text',
					'default_value' => 'Get My Quote',
				),
				array(
					'key'           => 'field_service_booking_desktop_checkbox1',
					'label'         => 'Desktop: Checkbox 1 Text',
					'name'          => 'desktop_checkbox1_text',
					'type'          => 'text',
					'default_value' => 'Book a Jet',
				),
				array(
					'key'           => 'field_service_booking_desktop_checkbox2',
					'label'         => 'Desktop: Checkbox 2 Text',
					'name'          => 'desktop_checkbox2_text',
					'type'          => 'text',
					'default_value' => 'Book a Helicopter',
				),
				array(
					'key'           => 'field_service_booking_desktop_stats_number',
					'label'         => 'Desktop: Stats Number',
					'name'          => 'desktop_stats_number',
					'type'          => 'text',
					'default_value' => '100+',
				),
				array(
					'key'           => 'field_service_booking_desktop_stats_label',
					'label'         => 'Desktop: Stats Label',
					'name'          => 'desktop_stats_label',
					'type'          => 'text',
					'default_value' => 'countries',
				),
				// Mobile Form Section
				array(
					'key'           => 'field_service_booking_mobile_enabled',
					'label'         => 'Enable Mobile Form',
					'name'          => 'mobile_enabled',
					'type'          => 'true_false',
					'default_value' => 1,
					'ui'            => 1,
					'wrapper'       => array('class' => 'acf-mobile-section'),
				),
				array(
					'key'           => 'field_service_booking_mobile_submit_text',
					'label'         => 'Mobile: Submit Button Text',
					'name'          => 'mobile_submit_text',
					'type'          => 'text',
					'default_value' => 'Get My Quote',
				),
				array(
					'key'           => 'field_service_booking_mobile_checkbox1',
					'label'         => 'Mobile: Checkbox 1 Text',
					'name'          => 'mobile_checkbox1_text',
					'type'          => 'text',
					'default_value' => 'Book a Jet',
				),
				array(
					'key'           => 'field_service_booking_mobile_checkbox2',
					'label'         => 'Mobile: Checkbox 2 Text',
					'name'          => 'mobile_checkbox2_text',
					'type'          => 'text',
					'default_value' => 'Book a Helicopter',
				),
				array(
					'key'           => 'field_service_booking_mobile_stats_number',
					'label'         => 'Mobile: Stats Number',
					'name'          => 'mobile_stats_number',
					'type'          => 'text',
					'default_value' => '100+',
				),
				array(
					'key'           => 'field_service_booking_mobile_stats_label',
					'label'         => 'Mobile: Stats Label',
					'name'          => 'mobile_stats_label',
					'type'          => 'text',
					'default_value' => 'countries',
				),
			),
		),

		// Layout 4: Why Us Section
		'layout_why_us'       => array(
			'key'        => 'layout_service_why_us',
			'name'       => 'why_us',
			'label'      => 'Why Us Section',
			'display'    => 'block',
			'sub_fields' => array(
				array(
					'key'           => 'field_service_whyus_enabled',
					'label'         => 'Enable Block',
					'name'          => 'enabled',
					'type'          => 'true_false',
					'default_value' => 1,
					'ui'            => 1,
				),
				array(
					'key'           => 'field_service_whyus_pill',
					'label'         => 'Section Label',
					'name'          => 'pill_text',
					'type'          => 'text',
					'default_value' => 'Why us?',
				),
				array(
					'key'        => 'field_service_whyus_cards',
					'label'      => 'Benefit Cards (6 items)',
					'name'       => 'cards',
					'type'       => 'repeater',
					'min'        => 0,
					'max'        => 6,
					'layout'     => 'block',
					'sub_fields' => $why_us_cards_subfields,
				),
			),
		),

		// Layout 5: Fleet Slider
		'layout_fleet'        => array(
			'key'        => 'layout_service_fleet',
			'name'       => 'fleet',
			'label'      => 'Fleet/Vehicles Slider',
			'display'    => 'block',
			'sub_fields' => array(
				array(
					'key'           => 'field_service_fleet_enabled',
					'label'         => 'Enable Block',
					'name'          => 'enabled',
					'type'          => 'true_false',
					'default_value' => 1,
					'ui'            => 1,
				),
				array(
					'key'           => 'field_service_fleet_pill',
					'label'         => 'Section Label',
					'name'          => 'pill_text',
					'type'          => 'text',
					'default_value' => 'Fleet & Chauffeurs',
				),
				array(
					'key'   => 'field_service_fleet_title',
					'label' => 'Title',
					'name'  => 'title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_service_fleet_subtitle',
					'label' => 'Subtitle',
					'name'  => 'subtitle',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				array(
					'key'           => 'field_service_fleet_vehicles',
					'label'         => 'Select Vehicles',
					'name'          => 'vehicles',
					'type'          => 'relationship',
					'post_type'     => array('product'),
					'filters'       => array('search'),
					'return_format' => 'id',
					'min'           => 0,
					'max'           => 20,
					'instructions'  => 'Select which vehicles to display. Leave empty to show all.',
				),
			),
		),

		// Layout 6: Occasions Section
		'layout_occasions'    => array(
			'key'        => 'layout_service_occasions',
			'name'       => 'occasions',
			'label'      => 'Occasions Section',
			'display'    => 'block',
			'sub_fields' => array(
				array(
					'key'           => 'field_service_occasions_enabled',
					'label'         => 'Enable Block',
					'name'          => 'enabled',
					'type'          => 'true_false',
					'default_value' => 1,
					'ui'            => 1,
				),
				array(
					'key'           => 'field_service_occasions_pill',
					'label'         => 'Section Label',
					'name'          => 'pill_text',
					'type'          => 'text',
					'default_value' => 'Full Service',
				),
				array(
					'key'   => 'field_service_occasions_title',
					'label' => 'Title',
					'name'  => 'title',
					'type'  => 'text',
				),
				array(
					'key'        => 'field_service_occasions_cards',
					'label'      => 'Occasion Cards',
					'name'       => 'cards',
					'type'       => 'repeater',
					'min'        => 0,
					'max'        => 10,
					'layout'     => 'block',
					'sub_fields' => $occasions_cards_subfields,
				),
				array(
					'key'   => 'field_service_occasions_footer',
					'label' => 'Footer Text',
					'name'  => 'footer_text',
					'type'  => 'textarea',
					'rows'  => 2,
				),
			),
		),

		// Layout 7: How It Works
		'layout_how_it_works' => array(
			'key'        => 'layout_service_how_it_works',
			'name'       => 'how_it_works',
			'label'      => 'How It Works Section',
			'display'    => 'block',
			'sub_fields' => array(
				array(
					'key'           => 'field_service_hiw_enabled',
					'label'         => 'Enable Block',
					'name'          => 'enabled',
					'type'          => 'true_false',
					'default_value' => 1,
					'ui'            => 1,
				),
				array(
					'key'           => 'field_service_hiw_pill',
					'label'         => 'Section Label',
					'name'          => 'pill_text',
					'type'          => 'text',
					'default_value' => 'How it works',
				),
				array(
					'key'   => 'field_service_hiw_title',
					'label' => 'Title',
					'name'  => 'title',
					'type'  => 'text',
				),
				array(
					'key'           => 'field_service_hiw_background',
					'label'         => 'Background Image',
					'name'          => 'background',
					'type'          => 'image',
					'return_format' => 'url',
					'preview_size'  => 'medium',
				),
				array(
					'key'        => 'field_service_hiw_steps',
					'label'      => 'Steps (4 items)',
					'name'       => 'steps',
					'type'       => 'repeater',
					'min'        => 0,
					'max'        => 4,
					'layout'     => 'block',
					'sub_fields' => $steps_subfields,
				),
			),
		),

		// Layout 8: Testimonials
		'layout_testimonials' => array(
			'key'        => 'layout_service_testimonials',
			'name'       => 'testimonials',
			'label'      => 'Testimonials Section',
			'display'    => 'block',
			'sub_fields' => array(
				array(
					'key'           => 'field_service_testimonials_enabled',
					'label'         => 'Enable Block',
					'name'          => 'enabled',
					'type'          => 'true_false',
					'default_value' => 1,
					'ui'            => 1,
				),
				array(
					'key'           => 'field_service_testimonials_pill',
					'label'         => 'Section Label',
					'name'          => 'pill_text',
					'type'          => 'text',
					'default_value' => 'Trusted by clients worldwide',
				),
				array(
					'key'   => 'field_service_testimonials_title',
					'label' => 'Title',
					'name'  => 'title',
					'type'  => 'text',
				),
				array(
					'key'        => 'field_service_testimonials_items',
					'label'      => 'Testimonials',
					'name'       => 'testimonials',
					'type'       => 'repeater',
					'min'        => 0,
					'max'        => 10,
					'layout'     => 'block',
					'sub_fields' => $testimonials_subfields,
				),
			),
		),

		// Layout 9: FAQ
		'layout_faq'          => array(
			'key'        => 'layout_service_faq',
			'name'       => 'faq',
			'label'      => 'FAQ Section',
			'display'    => 'block',
			'sub_fields' => array(
				array(
					'key'           => 'field_service_faq_enabled',
					'label'         => 'Enable Block',
					'name'          => 'enabled',
					'type'          => 'true_false',
					'default_value' => 1,
					'ui'            => 1,
				),
				array(
					'key'           => 'field_service_faq_pill',
					'label'         => 'Section Label',
					'name'          => 'pill_text',
					'type'          => 'text',
					'default_value' => 'FAQ',
				),
				array(
					'key'   => 'field_service_faq_title',
					'label' => 'Title',
					'name'  => 'title',
					'type'  => 'text',
				),
				array(
					'key'        => 'field_service_faq_items',
					'label'      => 'FAQ Items',
					'name'       => 'items',
					'type'       => 'repeater',
					'min'        => 0,
					'max'        => 20,
					'layout'     => 'block',
					'sub_fields' => $faq_subfields,
				),
			),
		),

		// Layout 10: CTA Section
		'layout_cta'          => array(
			'key'        => 'layout_service_cta',
			'name'       => 'cta',
			'label'      => 'CTA Section',
			'display'    => 'block',
			'sub_fields' => array(
				array(
					'key'           => 'field_service_cta_enabled',
					'label'         => 'Enable Block',
					'name'          => 'enabled',
					'type'          => 'true_false',
					'default_value' => 1,
					'ui'            => 1,
				),
				array(
					'key'   => 'field_service_cta_title',
					'label' => 'Title',
					'name'  => 'title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_service_cta_description',
					'label' => 'Description',
					'name'  => 'description',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				array(
					'key'   => 'field_service_cta_button_text',
					'label' => 'Button Text',
					'name'  => 'button_text',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_service_cta_button_link',
					'label' => 'Button Link',
					'name'  => 'button_link',
					'type'  => 'url',
				),
				array(
					'key'           => 'field_service_cta_show_contact',
					'label'         => 'Show Contact Icons',
					'name'          => 'show_contact_icons',
					'type'          => 'true_false',
					'default_value' => 1,
					'ui'            => 1,
				),
			),
		),

		// Layout 11: Related Services
		'layout_related'      => array(
			'key'        => 'layout_service_related',
			'name'       => 'related_services',
			'label'      => 'Related Services Section',
			'display'    => 'block',
			'sub_fields' => array(
				array(
					'key'           => 'field_service_related_enabled',
					'label'         => 'Enable Block',
					'name'          => 'enabled',
					'type'          => 'true_false',
					'default_value' => 1,
					'ui'            => 1,
				),
				array(
					'key'   => 'field_service_related_pill',
					'label' => 'Section Label',
					'name'  => 'pill_text',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_service_related_title',
					'label' => 'Title',
					'name'  => 'title',
					'type'  => 'text',
				),
				array(
					'key'        => 'field_service_related_items',
					'label'      => 'Service Cards',
					'name'       => 'services',
					'type'       => 'repeater',
					'min'        => 0,
					'max'        => 6,
					'layout'     => 'block',
					'sub_fields' => $related_services_subfields,
				),
			),
		),
	);

	// Register the main field group
	acf_add_local_field_group(
		array(
			'key'                   => 'group_service_blocks',
			'title'                 => 'Service Page Blocks',
			'fields'                => array(
				array(
					'key'          => 'field_service_blocks',
					'label'        => 'Page Blocks',
					'name'         => 'service_blocks',
					'type'         => 'flexible_content',
					'instructions' => 'Add, remove, and reorder blocks for this service page. Each block has an "Enable" toggle to show/hide it.',
					'layouts'      => $layouts,
					'button_label' => 'Add Block',
					'min'          => 0,
					'max'          => 0,
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'service',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => array('the_content'),
			'active'                => true,
		)
	);
}
add_action('acf/init', 'gts_register_service_acf_fields');
