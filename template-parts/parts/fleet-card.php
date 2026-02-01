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

$passengers = $product->get_attribute( 'pa_passengers' );
if ( empty( $passengers ) ) {
	$passengers = $product->get_attribute( 'passengers' );
}
if ( empty( $passengers ) ) {
	$passengers = get_post_meta( $product_id, 'passengers', true );
}

$bags = $product->get_attribute( 'pa_bags' );
if ( empty( $bags ) ) {
	$bags = $product->get_attribute( 'bags' );
}
if ( empty( $bags ) ) {
	$bags = get_post_meta( $product_id, 'bags', true );
}

$passengers = is_string( $passengers ) ? trim( $passengers ) : '';
$bags       = is_string( $bags ) ? trim( $bags ) : '';

if ( $passengers !== '' && preg_match( '/^\d+$/', $passengers ) ) {
	$passengers .= ' passenger';
}
if ( $bags !== '' && preg_match( '/^\d+$/', $bags ) ) {
	$bags .= ' bags';
}

$image_id = $product->get_image_id();
$book_url = $product->is_purchasable() && $product->is_in_stock()
	? $product->add_to_cart_url()
	: $product->get_permalink();
?>

<div class="fleet-card swiper-slide">
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
						<svg class="fleet-card-meta-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
							<path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4zm0 2c-4.42 0-8 2.24-8 5v1h16v-1c0-2.76-3.58-5-8-5z" />
						</svg>
						<?php echo esc_html( $passengers ); ?>
					</span>
				<?php endif; ?>
				<?php if ( $bags !== '' ) : ?>
					<span class="fleet-card-meta-item">
						<svg class="fleet-card-meta-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
							<path d="M7 6V4a3 3 0 0 1 6 0v2h2a2 2 0 0 1 2 2v9a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V8a2 2 0 0 1 2-2zm2 0h4V4a2 2 0 0 0-4 0v2zm-1 4a1 1 0 0 0-1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0-1-1zm8 0a1 1 0 0 0-1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0-1-1z" />
						</svg>
						<?php echo esc_html( $bags ); ?>
					</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<div class="fleet-card-actions">
			<a class="btn btn-primary btn-sm fleet-card-action" href="<?php echo esc_url( $book_url ); ?>">
				<?php echo esc_html__( 'Book a transfer', 'gts-theme' ); ?>
			</a>
			<a class="btn btn-secondary btn-sm fleet-card-action" href="<?php echo esc_url( $product->get_permalink() ); ?>">
				<?php echo esc_html__( 'Read more', 'gts-theme' ); ?>
			</a>
		</div>
	</div>
</div>
