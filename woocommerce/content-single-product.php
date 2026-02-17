<?php
/**
 * Custom single product layout for Fleet vehicles.
 *
 * @package GTS
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! is_a( $product, 'WC_Product' ) ) {
	return;
}

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	return;
}

if ( ! function_exists( 'gts_fleet_get_attribute' ) ) {
	/**
	 * Get first non-empty product attribute by key list.
	 *
	 * @param WC_Product $product Product object.
	 * @param array      $keys Attribute keys.
	 * @return string
	 */
	function gts_fleet_get_attribute( $product, $keys ) {
		foreach ( $keys as $key ) {
			$value = $product->get_attribute( $key );
			if ( ! empty( $value ) ) {
				return $value;
			}
		}

		return '';
	}
}

$product_id = $product->get_id();
$image_ids  = array();

if ( $product->get_image_id() ) {
	$image_ids[] = $product->get_image_id();
}

$gallery_ids = $product->get_gallery_image_ids();
if ( ! empty( $gallery_ids ) ) {
	$image_ids = array_values( array_unique( array_merge( $image_ids, $gallery_ids ) ) );
}

$attributes = $product->get_attributes();
$spec_rows  = array();

foreach ( $attributes as $attribute ) {
	$label = wc_attribute_label( $attribute->get_name() );

	if ( $attribute->is_taxonomy() ) {
		$values = wc_get_product_terms(
			$product_id,
			$attribute->get_name(),
			array(
				'fields' => 'names',
			)
		);
	} else {
		$values = $attribute->get_options();
	}

	if ( empty( $values ) ) {
		continue;
	}

	$spec_rows[] = array(
		'label' => $label,
		'value' => implode( ', ', $values ),
	);
}

$passengers = gts_fleet_get_attribute( $product, array( 'pa_passenger', 'passenger', 'pa_passengers', 'passengers' ) );
if ( empty( $passengers ) ) {
	$passengers = get_post_meta( $product_id, 'passengers', true );
}

$bags = gts_fleet_get_attribute( $product, array( 'pa_bags', 'bags' ) );
if ( empty( $bags ) ) {
	$bags = get_post_meta( $product_id, 'bags', true );
}

if ( ! empty( $passengers ) ) {
	$spec_rows[] = array(
		'label' => __( 'Passengers', 'gts-theme' ),
		'value' => (string) $passengers,
	);
}

if ( ! empty( $bags ) ) {
	$spec_rows[] = array(
		'label' => __( 'Bags', 'gts-theme' ),
		'value' => (string) $bags,
	);
}

$product_terms = wc_get_product_terms(
	$product_id,
	'product_cat',
	array(
		'orderby' => 'parent',
		'order'   => 'DESC',
	)
);

$primary_term = ! empty( $product_terms ) ? $product_terms[0] : null;
$category_slug = ( $primary_term && ! is_wp_error( $primary_term ) ) ? $primary_term->slug : '';
$category_name = ( $primary_term && ! is_wp_error( $primary_term ) ) ? $primary_term->name : '';

$product_description = trim( wp_strip_all_tags( $product->get_short_description() ) );
if ( '' === $product_description ) {
	$product_description = trim( wp_strip_all_tags( $product->get_description() ) );
}
if ( '' === $product_description ) {
	$product_description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. '
		. 'Praesent commodo, sapien non facilisis viverra, neque velit ultrices lorem, '
		. 'at ullamcorper neque odio at turpis.';
}

$related_products = array();
if ( $category_slug ) {
	$related_products = wc_get_products(
		array(
			'status'   => 'publish',
			'limit'    => 12,
			'exclude'  => array( $product_id ),
			'category' => array( $category_slug ),
			'orderby'  => 'menu_order',
			'order'    => 'ASC',
		)
	);
}
?>

<article id="product-<?php the_ID(); ?>" <?php wc_product_class( 'single-fleet-product', $product ); ?>>
	<div class="single-fleet-product__container">
		<div class="single-fleet-product__breadcrumbs">
			<?php woocommerce_breadcrumb(); ?>
		</div>

		<div class="single-fleet-product__grid">
			<div class="single-fleet-product__gallery-wrap">
				<div class="single-fleet-product__gallery swiper js-single-fleet-gallery">
					<div class="swiper-wrapper">
						<?php if ( ! empty( $image_ids ) ) : ?>
							<?php foreach ( $image_ids as $image_id ) : ?>
								<div class="swiper-slide single-fleet-product__slide">
									<?php echo wp_get_attachment_image( $image_id, 'large', false, array( 'class' => 'single-fleet-product__image' ) ); ?>
								</div>
							<?php endforeach; ?>
						<?php else : ?>
							<div class="swiper-slide single-fleet-product__slide">
								<?php echo wp_kses_post( wc_placeholder_img( 'large', array( 'class' => 'single-fleet-product__image' ) ) ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<?php echo gts_nav_arrows( 'single-fleet-gallery-prev', 'single-fleet-gallery-next', 'Previous image', 'Next image' ); ?>
			</div>

			<div class="single-fleet-product__content">
				<h1 class="single-fleet-product__title"><?php echo esc_html( $product->get_name() ); ?></h1>

				<div class="single-fleet-product__description">
					<?php echo wp_kses_post( wpautop( $product_description ) ); ?>
				</div>

				<a class="btn btn-primary btn-full fleet-book-trigger single-fleet-product__consult" href="<?php echo esc_url( $product->get_permalink() ); ?>" data-vehicle="<?php echo esc_attr( $product->get_name() ); ?>" data-product-id="<?php echo esc_attr( $product_id ); ?>">
					<?php esc_html_e( 'Book a consultation', 'gts-theme' ); ?>
				</a>

				<div class="single-fleet-product__specs">
					<h2 class="single-fleet-product__specs-title"><?php esc_html_e( 'Specifications', 'gts-theme' ); ?></h2>

					<?php if ( ! empty( $spec_rows ) ) : ?>
						<?php foreach ( $spec_rows as $spec_row ) : ?>
							<div class="single-fleet-product__spec-row">
								<span class="single-fleet-product__spec-label"><?php echo esc_html( $spec_row['label'] ); ?></span>
								<span class="single-fleet-product__spec-value"><?php echo esc_html( $spec_row['value'] ); ?></span>
							</div>
						<?php endforeach; ?>
					<?php else : ?>
						<div class="single-fleet-product__spec-row">
							<span class="single-fleet-product__spec-label"><?php esc_html_e( 'Category', 'gts-theme' ); ?></span>
							<span class="single-fleet-product__spec-value"><?php echo esc_html( $category_name ? $category_name : __( 'Not specified', 'gts-theme' ) ); ?></span>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</article>

<?php if ( ! empty( $related_products ) ) : ?>
	<section class="single-fleet-related">
		<div class="single-fleet-related__container">
			<div class="why-us-heading">
				<div class="why-us-heading-pill">
					<span class="why-us-heading-text"><?php esc_html_e( 'Same Category', 'gts-theme' ); ?></span>
				</div>
				<div class="why-us-heading-line" aria-hidden="true"></div>
			</div>

			<div class="fleet-slider-wrapper">
				<div class="fleet-slider swiper">
					<div class="swiper-wrapper">
						<?php foreach ( $related_products as $related_product ) : ?>
							<?php
							get_template_part(
								'template-parts/parts/fleet-card',
								null,
								array(
									'product' => $related_product,
								)
							);
							?>
						<?php endforeach; ?>
					</div>
				</div>
				<?php echo gts_nav_arrows( 'fleet-slider-prev', 'fleet-slider-next', 'Previous vehicle', 'Next vehicle' ); ?>
			</div>
		</div>
	</section>
<?php endif; ?>
