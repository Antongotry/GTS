<?php
/**
 * Fleet Slider Card Template
 *
 * @package GTS
 */

$product = isset( $args['product'] ) ? $args['product'] : null;

if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
	return;
}

$product_id = $product->get_id();
$link_mode  = isset( $args['link_mode'] ) ? sanitize_key( (string) $args['link_mode'] ) : 'product';

if ( ! function_exists( 'gts_fleet_get_attribute' ) ) {
	function gts_fleet_get_attribute( $product, $keys ) {
		foreach ( $keys as $key ) {
			$value = $product->get_attribute( $key );
			if ( ! empty( $value ) ) {
				return $value;
			}
		}

		$attributes = $product->get_attributes();
		foreach ( $keys as $key ) {
			if ( isset( $attributes[ $key ] ) && $attributes[ $key ] instanceof WC_Product_Attribute ) {
				$options = $attributes[ $key ]->get_options();
				if ( ! empty( $options ) ) {
					return implode( ', ', $options );
				}
			}
		}

		return '';
	}
}

if ( ! function_exists( 'gts_fleet_get_primary_category_data' ) ) {
	function gts_fleet_get_primary_category_data( $product_id ) {
		$terms = wc_get_product_terms(
			$product_id,
			'product_cat',
			array(
				'orderby' => 'parent',
				'order'   => 'DESC',
			)
		);

		if ( empty( $terms ) || is_wp_error( $terms ) ) {
			return array(
				'name' => '',
				'slug' => '',
				'url'  => '',
			);
		}

		$primary = null;
		foreach ( $terms as $term ) {
			if ( ! $term || ! isset( $term->slug ) ) {
				continue;
			}
			if ( 'uncategorized' === $term->slug ) {
				continue;
			}
			$primary = $term;
			break;
		}

		if ( ! $primary ) {
			$primary = $terms[0];
		}

		$term_link = get_term_link( $primary, 'product_cat' );
		return array(
			'name' => isset( $primary->name ) ? (string) $primary->name : '',
			'slug' => isset( $primary->slug ) ? (string) $primary->slug : '',
			'url'  => ! is_wp_error( $term_link ) ? (string) $term_link : '',
		);
	}
}

$passengers = gts_fleet_get_attribute( $product, array( 'pa_passenger', 'passenger', 'pa_passengers', 'passengers' ) );
if ( empty( $passengers ) ) {
	$passengers = get_post_meta( $product_id, 'passengers', true );
}

$bags = gts_fleet_get_attribute( $product, array( 'pa_bags', 'bags' ) );
if ( empty( $bags ) ) {
	$bags = get_post_meta( $product_id, 'bags', true );
}

$passengers = is_string( $passengers ) ? trim( $passengers ) : '';
$bags       = is_string( $bags ) ? trim( $bags ) : '';

if ( $passengers !== '' ) {
	if ( preg_match( '/^\d+$/', $passengers ) ) {
		$passengers .= ' passenger';
	} elseif ( stripos( $passengers, 'passenger' ) === false ) {
		$passengers .= ' passenger';
	}
}
if ( $bags !== '' ) {
	if ( preg_match( '/^\d+$/', $bags ) ) {
		$bags .= ' bags';
	} elseif ( stripos( $bags, 'bag' ) === false ) {
		$bags .= ' bags';
	}
}

$image_id = $product->get_image_id();
$site_url = get_site_url();
$bags_icon_url = $site_url . '/wp-content/uploads/2026/02/bags.svg';
$passenger_icon_url = $site_url . '/wp-content/uploads/2026/02/passenger.svg';
$provided_category_term = isset( $args['category_term'] ) ? $args['category_term'] : null;
$category_data = array(
	'name' => '',
	'slug' => '',
	'url'  => '',
);
if ( $provided_category_term instanceof WP_Term && 'product_cat' === $provided_category_term->taxonomy ) {
	$provided_term_link = get_term_link( $provided_category_term, 'product_cat' );
	$category_data      = array(
		'name' => (string) $provided_category_term->name,
		'slug' => (string) $provided_category_term->slug,
		'url'  => ! is_wp_error( $provided_term_link ) ? (string) $provided_term_link : '',
	);
} else {
	$category_data = gts_fleet_get_primary_category_data( $product_id );
}
$is_category_mode = ( 'category' === $link_mode && ! empty( $category_data['url'] ) );

$card_url   = $is_category_mode ? $category_data['url'] : $product->get_permalink();
$card_title = $is_category_mode && ! empty( $category_data['name'] ) ? $category_data['name'] : $product->get_name();

$book_url = $is_category_mode
	? $card_url
	: ( $product->is_purchasable() && $product->is_in_stock()
		? $product->add_to_cart_url()
		: $product->get_permalink() );

$primary_btn_label = $is_category_mode
	? __( 'Choose category', 'gts-theme' )
	: __( 'Book a transfer', 'gts-theme' );

$primary_btn_class = 'btn btn-primary btn-sm fleet-card-action';
if ( ! $is_category_mode ) {
	$primary_btn_class .= ' fleet-book-trigger';
}
?>

<div class="fleet-card swiper-slide" data-product-url="<?php echo esc_url( $card_url ); ?>" role="link" tabindex="0" aria-label="<?php echo esc_attr( sprintf( __( 'Open %s details', 'gts-theme' ), $card_title ) ); ?>">
	<div class="fleet-card-media">
		<?php if ( $image_id ) : ?>
			<?php echo wp_get_attachment_image( $image_id, 'large', false, array( 'class' => 'fleet-card-image', 'loading' => 'lazy' ) ); ?>
		<?php else : ?>
			<?php echo wp_kses_post( wc_placeholder_img( 'large' ) ); ?>
		<?php endif; ?>
	</div>
	<div class="fleet-card-body">
		<h3 class="fleet-card-title"><?php echo esc_html( $card_title ); ?></h3>
		<?php if ( $passengers !== '' || $bags !== '' ) : ?>
			<div class="fleet-card-meta">
				<?php if ( $passengers !== '' ) : ?>
					<span class="fleet-card-meta-item">
						<img src="<?php echo esc_url( $passenger_icon_url ); ?>" alt="" class="fleet-card-meta-icon" width="26" height="26" loading="lazy">
						<?php echo esc_html( $passengers ); ?>
					</span>
				<?php endif; ?>
				<?php if ( $bags !== '' ) : ?>
					<span class="fleet-card-meta-item">
						<img src="<?php echo esc_url( $bags_icon_url ); ?>" alt="" class="fleet-card-meta-icon" width="26" height="26" loading="lazy">
						<?php echo esc_html( $bags ); ?>
					</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<div class="fleet-card-actions">
			<a class="<?php echo esc_attr( $primary_btn_class ); ?>" href="<?php echo esc_url( $book_url ); ?>" data-vehicle="<?php echo esc_attr( $card_title ); ?>" data-product-id="<?php echo esc_attr( $product_id ); ?>">
				<?php echo esc_html( $primary_btn_label ); ?>
			</a>
			<a class="btn btn-secondary btn-sm fleet-card-action" href="<?php echo esc_url( $card_url ); ?>">
				<?php echo esc_html__( 'Read more', 'gts-theme' ); ?>
			</a>
		</div>
	</div>
</div>
