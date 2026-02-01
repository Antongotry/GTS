<?php
/**
 * Fleet Slider Block Template
 *
 * @package GTS
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$products = wc_get_products(
	array(
		'status'  => 'publish',
		'limit'   => 10,
		'orderby' => 'menu_order',
		'order'   => 'ASC',
	)
);

if ( empty( $products ) ) {
	return;
}
?>

<section class="fleet-slider-block">
	<div class="fleet-slider-container">
		<div class="fleet-slider-heading">
			<div class="why-us-heading-pill">
				<span class="why-us-heading-text"><?php echo esc_html__( 'Fleet & Chauffeurs', 'gts-theme' ); ?></span>
			</div>
			<div class="fleet-slider-line" aria-hidden="true"></div>
		</div>

		<div class="fleet-slider-title-row">
			<h2 class="fleet-slider-title">
				<?php echo esc_html__( 'Every detail matters – from the car you travel in to the person behind the wheel', 'gts-theme' ); ?>
			</h2>
			<p class="fleet-slider-lead">
				<?php echo esc_html__( 'That’s why every GTS limousine meets strict standards of comfort, safety, and presentation.', 'gts-theme' ); ?>
			</p>
		</div>
	</div>

	<div class="fleet-slider-wrapper">
		<div class="fleet-slider swiper">
			<div class="swiper-wrapper">
				<?php foreach ( $products as $product ) : ?>
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
		<?php echo gts_nav_arrows( 'fleet-slider-prev', 'fleet-slider-next', 'Previous vehicle', 'Next vehicle' ); ?>
	</div>

	<div class="fleet-booking-modal" aria-hidden="true">
		<div class="fleet-booking-overlay" data-modal-close></div>
		<div class="fleet-booking-dialog" role="dialog" aria-modal="true" aria-labelledby="fleet-booking-title">
			<button class="fleet-booking-close" type="button" aria-label="<?php echo esc_attr__( 'Close', 'gts-theme' ); ?>" data-modal-close>×</button>
			<div class="fleet-booking-content">
				<h3 class="fleet-booking-title" id="fleet-booking-title"><?php echo esc_html__( 'Book this vehicle', 'gts-theme' ); ?></h3>
				<p class="fleet-booking-subtitle">
					<?php echo esc_html__( 'We will confirm availability and get back to you shortly.', 'gts-theme' ); ?>
				</p>
				<form class="fleet-booking-form" id="fleet-booking-form">
					<input type="hidden" name="vehicle" id="fleet-vehicle-field" value="">
					<div class="fleet-form-row fleet-form-row--full">
						<label for="fleet-name"><?php echo esc_html__( 'Name', 'gts-theme' ); ?></label>
						<input type="text" id="fleet-name" name="name" placeholder="<?php echo esc_attr__( 'Your name', 'gts-theme' ); ?>" required>
					</div>
					<div class="fleet-form-row">
						<label for="fleet-phone"><?php echo esc_html__( 'Phone', 'gts-theme' ); ?></label>
						<input type="tel" id="fleet-phone" name="phone" placeholder="<?php echo esc_attr__( 'Phone number', 'gts-theme' ); ?>" required>
					</div>
					<div class="fleet-form-row">
						<label for="fleet-email"><?php echo esc_html__( 'Email', 'gts-theme' ); ?></label>
						<input type="email" id="fleet-email" name="email" placeholder="<?php echo esc_attr__( 'Email address', 'gts-theme' ); ?>" required>
					</div>
					<div class="fleet-form-row">
						<label for="fleet-passengers"><?php echo esc_html__( 'Number of passengers', 'gts-theme' ); ?></label>
						<input type="number" id="fleet-passengers" name="passengers" min="1" placeholder="<?php echo esc_attr__( 'Passengers', 'gts-theme' ); ?>">
					</div>
					<div class="fleet-form-row">
						<label for="fleet-pickup"><?php echo esc_html__( 'Pick-up time', 'gts-theme' ); ?></label>
						<input type="datetime-local" id="fleet-pickup" name="pickup_time">
					</div>
					<div class="fleet-form-row fleet-form-row--full">
						<label for="fleet-comment"><?php echo esc_html__( 'Comment', 'gts-theme' ); ?></label>
						<textarea id="fleet-comment" name="comment" rows="3" placeholder="<?php echo esc_attr__( 'Additional details', 'gts-theme' ); ?>"></textarea>
					</div>
					<button class="btn btn-primary fleet-form-submit" type="submit"><?php echo esc_html__( 'Send request', 'gts-theme' ); ?></button>
				</form>
			</div>
		</div>
	</div>

	<div class="fleet-success-modal" aria-hidden="true">
		<div class="fleet-booking-overlay" data-success-close></div>
		<div class="fleet-booking-dialog fleet-success-dialog" role="dialog" aria-modal="true" aria-labelledby="fleet-success-title">
			<button class="fleet-booking-close" type="button" aria-label="<?php echo esc_attr__( 'Close', 'gts-theme' ); ?>" data-success-close>×</button>
			<div class="fleet-success-content">
				<div class="fleet-success-icon">✓</div>
				<h3 class="fleet-booking-title" id="fleet-success-title"><?php echo esc_html__( 'Thank you!', 'gts-theme' ); ?></h3>
				<p class="fleet-booking-subtitle">
					<?php echo esc_html__( 'We have received your request and will contact you shortly.', 'gts-theme' ); ?>
				</p>
				<button class="btn btn-secondary fleet-success-button" type="button" data-success-close><?php echo esc_html__( 'Great', 'gts-theme' ); ?></button>
			</div>
		</div>
	</div>
</section>
