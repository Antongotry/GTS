<?php

/**
 * Fleet Slider Block Template
 *
 * @package GTS
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$args = isset( $args ) && is_array( $args ) ? $args : array();
$fleet_block = array();
if ( function_exists( 'gts_is_service_style_page' ) && gts_is_service_style_page() && function_exists( 'gts_get_page_service_block' ) ) {
	$fleet_block = gts_get_page_service_block( 'fleet' );
}

if ( ! empty( $fleet_block ) ) {
	if ( ! empty( $fleet_block['title'] ) ) {
		$args['title'] = (string) $fleet_block['title'];
	}
	if ( ! empty( $fleet_block['subtitle'] ) ) {
		$args['lead'] = (string) $fleet_block['subtitle'];
		$args['hide_lead'] = false;
	}
	if ( ! empty( $fleet_block['pill_text'] ) ) {
		$args['pill_text'] = (string) $fleet_block['pill_text'];
	}
}

$current_service_slug = '';
if ( is_singular( 'service' ) ) {
	$current_service_slug = (string) get_post_field( 'post_name', get_the_ID() );
}

// Private Tours: keep a stable default copy, but let admin fields override it.
if ( 'private-tours' === $current_service_slug ) {
	if ( empty( $args['title'] ) ) {
		$args['title'] = 'Every detail matters on a private journey — from vehicle comfort to the chauffeur’s experience.';
	}
	if ( empty( $args['lead'] ) ) {
		$args['lead'] = 'Every GTS car meets high standards of safety, comfort, and presentation for a smooth, relaxed ride.';
	}
}

$selected_category_ids = array();
if ( ! empty( $fleet_block['vehicle_categories'] ) && is_array( $fleet_block['vehicle_categories'] ) ) {
	$selected_category_ids = array_values( array_filter( array_map( 'absint', $fleet_block['vehicle_categories'] ) ) );
}

$category_slugs = array();
if ( ! empty( $args['category_slugs'] ) && is_array( $args['category_slugs'] ) ) {
	$category_slugs = array_values(
		array_filter(
			array_map( 'sanitize_title', $args['category_slugs'] )
		)
	);
}

if ( ! empty( $selected_category_ids ) ) {
	$selected_terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
			'include'    => $selected_category_ids,
			'orderby'    => 'include',
		)
	);
	if ( ! is_wp_error( $selected_terms ) && ! empty( $selected_terms ) ) {
		$category_slugs = array();
		foreach ( $selected_terms as $selected_term ) {
			if ( ! empty( $selected_term->slug ) && 'uncategorized' !== $selected_term->slug ) {
				$category_slugs[] = (string) $selected_term->slug;
			}
		}
	}
}

// Backward compatibility: previously fleet block stored selected product IDs in "vehicles".
$legacy_vehicle_ids = array();
if ( ! empty( $fleet_block['vehicles'] ) && is_array( $fleet_block['vehicles'] ) ) {
	$legacy_vehicle_ids = array_values( array_filter( array_map( 'absint', $fleet_block['vehicles'] ) ) );
}

$fleet_items = array();
if ( empty( $selected_category_ids ) && empty( $category_slugs ) && ! empty( $legacy_vehicle_ids ) ) {
	$legacy_category_slugs = array();
	foreach ( $legacy_vehicle_ids as $legacy_vehicle_id ) {
		$legacy_terms = wc_get_product_terms(
			$legacy_vehicle_id,
			'product_cat',
			array(
				'orderby' => 'parent',
				'order'   => 'DESC',
			)
		);
		if ( empty( $legacy_terms ) || is_wp_error( $legacy_terms ) ) {
			continue;
		}

		$legacy_primary_term = null;
		foreach ( $legacy_terms as $legacy_term ) {
			if ( ! $legacy_term || empty( $legacy_term->slug ) ) {
				continue;
			}
			if ( 'uncategorized' === $legacy_term->slug ) {
				continue;
			}
			$legacy_primary_term = $legacy_term;
			break;
		}
		if ( ! $legacy_primary_term ) {
			$legacy_primary_term = $legacy_terms[0];
		}
		if ( empty( $legacy_primary_term->slug ) ) {
			continue;
		}

		$legacy_primary_slug = sanitize_title( (string) $legacy_primary_term->slug );
		if ( '' === $legacy_primary_slug || in_array( $legacy_primary_slug, $legacy_category_slugs, true ) ) {
			continue;
		}
		$legacy_category_slugs[] = $legacy_primary_slug;
	}

	if ( ! empty( $legacy_category_slugs ) ) {
		$category_slugs = $legacy_category_slugs;
	}
}

if ( empty( $category_slugs ) ) {
	$all_terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
			'orderby'    => 'name',
			'order'      => 'ASC',
		)
	);
	if ( ! is_wp_error( $all_terms ) && ! empty( $all_terms ) ) {
		foreach ( $all_terms as $all_term ) {
			if ( ! empty( $all_term->slug ) && 'uncategorized' !== $all_term->slug ) {
				$category_slugs[] = (string) $all_term->slug;
			}
		}
	}
}

foreach ( $category_slugs as $category_slug ) {
	$category_slug = sanitize_title( (string) $category_slug );
	if ( '' === $category_slug ) {
		continue;
	}

	$category_term = get_term_by( 'slug', $category_slug, 'product_cat' );
	if ( ! $category_term || is_wp_error( $category_term ) ) {
		continue;
	}

	$category_products = wc_get_products(
		array(
			'status'   => 'publish',
			'limit'    => 1,
			'orderby'  => 'menu_order',
			'order'    => 'ASC',
			'category' => array( $category_slug ),
		)
	);

	if ( empty( $category_products ) ) {
		continue;
	}

	$category_product = reset( $category_products );
	if ( ! is_a( $category_product, 'WC_Product' ) ) {
		continue;
	}

	$fleet_items[] = array(
		'product'       => $category_product,
		'category_term' => $category_term,
	);
}

if ( empty( $fleet_items ) ) {
	return;
}

$title = ! empty( $args['title'] ) ? $args['title'] : 'Every detail matters – from the car you travel in to the person behind the wheel';
$lead  = ! empty( $args['lead'] ) ? $args['lead'] : 'That’s why every GTS limousine meets strict standards of comfort, safety, and presentation.';
$hide_lead = ! empty( $args['hide_lead'] );
$section_mod = ! empty( $args['section_modifier'] ) ? sanitize_html_class( (string) $args['section_modifier'] ) : '';
$section_class = 'fleet-slider-block' . ( $section_mod ? ' ' . $section_mod : '' );
$pill_text = ! empty( $args['pill_text'] ) ? $args['pill_text'] : 'Fleet & Chauffeurs';
?>

<section class="<?php echo esc_attr( $section_class ); ?>">
	<div class="fleet-slider-grid">
		<div class="fleet-slider-container">
			<div class="why-us-heading">
				<div class="why-us-heading-pill">
					<span class="why-us-heading-text"><?php echo esc_html( $pill_text ); ?></span>
				</div>
				<div class="why-us-heading-line" aria-hidden="true"></div>
			</div>

			<div class="fleet-slider-title-row">
				<h2 class="fleet-slider-title">
					<?php echo wp_kses( $title, array( 'br' => array() ) ); ?>
				</h2>
				<?php if ( ! $hide_lead ) : ?>
					<p class="fleet-slider-lead">
						<?php echo wp_kses( $lead, array( 'br' => array() ) ); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>

		<div class="fleet-slider-wrapper">
			<div class="fleet-slider swiper">
				<div class="swiper-wrapper">
				<?php foreach ( $fleet_items as $fleet_item ) : ?>
					<?php
					get_template_part(
						'template-parts/parts/fleet-card',
						null,
						array(
							'product'       => $fleet_item['product'],
							'category_term' => isset( $fleet_item['category_term'] ) ? $fleet_item['category_term'] : null,
							'link_mode'     => 'category',
						)
					);
					?>
				<?php endforeach; ?>
			</div>
			</div>
			<?php echo gts_nav_arrows( 'fleet-slider-prev', 'fleet-slider-next', 'Previous vehicle', 'Next vehicle' ); ?>
		</div>

		<div class="fleet-slider-footer">
			<a class="fleet-slider-all-link" href="<?php echo esc_url( home_url( '/fleet/' ) ); ?>">
				<?php echo esc_html__( 'See all fleet', 'gts-theme' ); ?>
			</a>
		</div>
	</div>

	<?php /* Modals injected by JS on open, removed on close — not in initial DOM */ ?>
</section>
