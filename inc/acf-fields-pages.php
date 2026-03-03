<?php
/**
 * ACF field definitions for regular pages (front page, city-to-city, limousine).
 *
 * @package GTS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function gts_register_page_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'    => 'group_gts_page_content_common',
			'title'  => 'GTS Page Content',
			'fields' => array(
				array(
					'key'   => 'field_gts_tab_hero',
					'label' => 'Hero',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_gts_page_hero_title',
					'label' => 'Hero Title',
					'name'  => 'gts_page_hero_title',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				array(
					'key'   => 'field_gts_page_hero_description',
					'label' => 'Hero Description',
					'name'  => 'gts_page_hero_description',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'           => 'field_gts_page_hero_cta_text',
					'label'         => 'Hero CTA Text',
					'name'          => 'gts_page_hero_cta_text',
					'type'          => 'text',
					'default_value' => 'Book a transfer',
				),
				array(
					'key'   => 'field_gts_page_hero_cta_link',
					'label' => 'Hero CTA Link',
					'name'  => 'gts_page_hero_cta_link',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_gts_tab_faq',
					'label' => 'FAQ',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_gts_page_faq_pill',
					'label'         => 'FAQ Pill Text',
					'name'          => 'gts_page_faq_pill',
					'type'          => 'text',
					'default_value' => 'FAQ',
				),
				array(
					'key'   => 'field_gts_page_faq_title',
					'label' => 'FAQ Title',
					'name'  => 'gts_page_faq_title',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				array(
					'key'          => 'field_gts_page_faq_items',
					'label'        => 'FAQ Items',
					'name'         => 'gts_page_faq_items',
					'type'         => 'repeater',
					'layout'       => 'block',
					'button_label' => 'Add FAQ item',
					'sub_fields'   => array(
						array(
							'key'   => 'field_gts_page_faq_item_question',
							'label' => 'Question',
							'name'  => 'question',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gts_page_faq_item_answer',
							'label' => 'Answer',
							'name'  => 'answer',
							'type'  => 'textarea',
							'rows'  => 4,
						),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-limousine-service.php',
					),
				),
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-city-to-city.php',
					),
				),
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
		)
	);

	acf_add_local_field_group(
		array(
			'key'    => 'group_gts_city_page_cta',
			'title'  => 'City-to-City CTA Section',
			'fields' => array(
				array(
					'key'           => 'field_gts_city_cta_pill',
					'label'         => 'Pill Text',
					'name'          => 'gts_city_cta_pill',
					'type'          => 'text',
					'default_value' => 'Preferences',
				),
				array(
					'key'   => 'field_gts_city_cta_title',
					'label' => 'Title',
					'name'  => 'gts_city_cta_title',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				array(
					'key'   => 'field_gts_city_cta_description',
					'label' => 'Description',
					'name'  => 'gts_city_cta_description',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'           => 'field_gts_city_cta_button_text',
					'label'         => 'Button Text',
					'name'          => 'gts_city_cta_button_text',
					'type'          => 'text',
					'default_value' => 'Book a transfer',
				),
				array(
					'key'   => 'field_gts_city_cta_button_link',
					'label' => 'Button Link',
					'name'  => 'gts_city_cta_button_link',
					'type'  => 'url',
				),
				array(
					'key'          => 'field_gts_city_cta_benefits',
					'label'        => 'Benefits',
					'name'         => 'gts_city_cta_benefits',
					'type'         => 'repeater',
					'layout'       => 'block',
					'button_label' => 'Add Benefit',
					'sub_fields'   => array(
						array(
							'key'           => 'field_gts_city_cta_benefit_icon',
							'label'         => 'Icon',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'url',
							'preview_size'  => 'thumbnail',
							'mime_types'    => 'svg,png,webp',
						),
						array(
							'key'   => 'field_gts_city_cta_benefit_title',
							'label' => 'Title',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gts_city_cta_benefit_text',
							'label' => 'Description',
							'name'  => 'text',
							'type'  => 'textarea',
							'rows'  => 3,
						),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-city-to-city.php',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'gts_register_page_acf_fields' );

