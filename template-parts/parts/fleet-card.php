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
$book_url = $product->is_purchasable() && $product->is_in_stock()
	? $product->add_to_cart_url()
	: $product->get_permalink();
?>

<div class="fleet-card swiper-slide" data-product-url="<?php echo esc_url( $product->get_permalink() ); ?>" role="link" tabindex="0" aria-label="<?php echo esc_attr( sprintf( __( 'Open %s details', 'gts-theme' ), $product->get_name() ) ); ?>">
	<div class="fleet-card-media">
		<?php if ( $image_id ) : ?>
			<?php echo wp_get_attachment_image( $image_id, 'large', false, array( 'class' => 'fleet-card-image', 'loading' => 'lazy' ) ); ?>
		<?php else : ?>
			<?php echo wp_kses_post( wc_placeholder_img( 'large' ) ); ?>
		<?php endif; ?>
	</div>
	<div class="fleet-card-body">
		<h3 class="fleet-card-title"><?php echo esc_html( $product->get_name() ); ?></h3>
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
			<a class="btn btn-primary btn-sm fleet-card-action fleet-book-trigger" href="<?php echo esc_url( $book_url ); ?>" data-vehicle="<?php echo esc_attr( $product->get_name() ); ?>" data-product-id="<?php echo esc_attr( $product_id ); ?>">
				<?php echo esc_html__( 'Book a transfer', 'gts-theme' ); ?>
			</a>
			<a class="btn btn-secondary btn-sm fleet-card-action" href="<?php echo esc_url( $product->get_permalink() ); ?>">
				<?php echo esc_html__( 'Read more', 'gts-theme' ); ?>
			</a>
		</div>
	</div>
</div>
