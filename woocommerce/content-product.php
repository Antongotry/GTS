<?php
/**
 * Product card layout for fleet archive pages.
 *
 * @package GTS
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

if ( ! function_exists( 'gts_theme_fleet_attribute_value' ) ) {
	/**
	 * Read first non-empty value from product attributes/meta candidates.
	 *
	 * @param WC_Product $product Product object.
	 * @param array      $keys Candidate keys.
	 * @return string
	 */
	function gts_theme_fleet_attribute_value( $product, $keys ) {
		foreach ( $keys as $key ) {
			$value = $product->get_attribute( $key );
			if ( ! empty( $value ) ) {
				return (string) $value;
			}
		}

		foreach ( $keys as $key ) {
			$value = get_post_meta( $product->get_id(), $key, true );
			if ( ! empty( $value ) ) {
				return (string) $value;
			}
		}

		return '';
	}
}

$product_id     = $product->get_id();
$passengers     = trim( gts_theme_fleet_attribute_value( $product, array( 'pa_passenger', 'passenger', 'pa_passengers', 'passengers' ) ) );
$bags           = trim( gts_theme_fleet_attribute_value( $product, array( 'pa_bags', 'bags' ) ) );
$site_url       = get_site_url();
$passenger_icon = $site_url . '/wp-content/uploads/2026/02/passenger.svg';
$bags_icon      = $site_url . '/wp-content/uploads/2026/02/bags.svg';
$book_url       = home_url( '/book-a-transfer/' );

if ( '' !== $passengers && preg_match( '/^\d+$/', $passengers ) ) {
	$passengers .= ' passenger';
}

if ( '' !== $bags && preg_match( '/^\d+$/', $bags ) ) {
	$bags .= ' bags';
}
?>

<div class="fleet-card gts-fleet-card">
	<a class="gts-fleet-card__media-link" href="<?php the_permalink(); ?>">
		<div class="fleet-card-media">
			<?php if ( $product->get_image_id() ) : ?>
				<?php echo wp_get_attachment_image( $product->get_image_id(), 'large', false, array( 'class' => 'fleet-card-image', 'loading' => 'lazy' ) ); ?>
			<?php else : ?>
				<?php echo wp_kses_post( wc_placeholder_img( 'large', array( 'class' => 'fleet-card-image' ) ) ); ?>
			<?php endif; ?>
		</div>
	</a>

	<div class="fleet-card-body">
		<h2 class="fleet-card-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>

		<?php if ( '' !== $passengers || '' !== $bags ) : ?>
			<div class="fleet-card-meta">
				<?php if ( '' !== $passengers ) : ?>
					<span class="fleet-card-meta-item">
						<img src="<?php echo esc_url( $passenger_icon ); ?>" alt="" class="fleet-card-meta-icon" width="26" height="26" loading="lazy">
						<?php echo esc_html( $passengers ); ?>
					</span>
				<?php endif; ?>
				<?php if ( '' !== $bags ) : ?>
					<span class="fleet-card-meta-item">
						<img src="<?php echo esc_url( $bags_icon ); ?>" alt="" class="fleet-card-meta-icon" width="26" height="26" loading="lazy">
						<?php echo esc_html( $bags ); ?>
					</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="fleet-card-actions">
			<a class="btn btn-primary btn-sm fleet-card-action" href="<?php echo esc_url( add_query_arg( 'vehicle_id', $product_id, $book_url ) ); ?>">
				<?php esc_html_e( 'Book a transfer', 'gts-theme' ); ?>
			</a>
			<a class="btn btn-secondary btn-sm fleet-card-action" href="<?php the_permalink(); ?>">
				<?php esc_html_e( 'Read more', 'gts-theme' ); ?>
			</a>
		</div>
	</div>
</div>
