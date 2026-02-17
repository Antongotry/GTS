<?php
/**
 * Fleet: Ground Fleet layout (left category column + right slider with 2 cards view).
 *
 * @package GTS
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

// Category-to-section mapping for Ground Fleet.
$sections = array(
	array(
		'key'         => 'sedan',
		'slug'        => 'sedan-suv',
		'title'       => 'Sedan & SUV',
		'description' => 'For executive travel, airport transfers, and city mobility.',
	),
	array(
		'key'         => 'limousine',
		'slug'        => 'limousine',
		'title'       => 'Limousine',
		'description' => 'For premium rides, VIP occasions, and luxury comfort.',
	),
	array(
		'key'         => 'sprinter',
		'slug'        => 'sprinter-bus',
		'title'       => 'Sprinter & Bus',
		'description' => 'For group transportation, events, and multi-passenger routes.',
	),
);

foreach ( $sections as &$section ) {
	$section['products'] = wc_get_products(
		array(
			'status'   => 'publish',
			'limit'    => 20,
			'orderby'  => 'menu_order',
			'order'    => 'ASC',
			'category' => array( $section['slug'] ),
		)
	);

	$term = get_term_by( 'slug', $section['slug'], 'product_cat' );
	if ( $term && ! is_wp_error( $term ) ) {
		$term_link = get_term_link( $term, 'product_cat' );
		$section['view_url'] = ! is_wp_error( $term_link ) ? $term_link : '#';
	} else {
		$section['view_url'] = '#';
	}
}
unset( $section );
?>

<section class="fleet-ground">
	<div class="fleet-ground__container">
		<?php foreach ( $sections as $section ) : ?>
			<?php if ( empty( $section['products'] ) ) : ?>
				<?php continue; ?>
			<?php endif; ?>

			<div class="fleet-ground-row">
				<div class="fleet-ground-row__left">
					<h2 class="fleet-ground-row__title"><?php echo esc_html( $section['title'] ); ?></h2>
					<p class="fleet-ground-row__desc"><?php echo esc_html( $section['description'] ); ?></p>
					<a class="fleet-ground-row__view" href="<?php echo esc_url( $section['view_url'] ); ?>"><?php esc_html_e( 'View all', 'gts-theme' ); ?></a>
				</div>

				<div class="fleet-ground-row__right">
					<div class="fleet-ground__slider-wrap">
						<div class="fleet-cat-slider swiper">
							<div class="swiper-wrapper">
								<?php foreach ( $section['products'] as $product ) : ?>
									<?php
									get_template_part(
										'template-parts/parts/fleet-card',
										null,
										array(
											'product' => $product,
										)
									);
									?>
								<?php endforeach; ?>
							</div>
						</div>

						<?php echo gts_nav_arrows( 'fleet-cat-prev', 'fleet-cat-next', 'Previous vehicles', 'Next vehicles' ); ?>
					</div>
				</div>
			</div>

		<?php endforeach; ?>
	</div>
</section>
