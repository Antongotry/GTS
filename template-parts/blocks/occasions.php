<?php
/**
 * Occasions Block Template
 * "Perfect for Every Occasion" - limousine services grid
 *
 * @package GTS
 */

// Images and icons - upload to WordPress Media Library and update URLs
$site_url = get_site_url();
$image_airport_url = $site_url . '/wp-content/uploads/2026/01/airport-limousine.webp';
$image_events_url = $site_url . '/wp-content/uploads/2026/01/events-conference.webp';
$icon_executive_url = $site_url . '/wp-content/uploads/2026/01/icon-block-2-1.svg';
$icon_airport_url = $site_url . '/wp-content/uploads/2026/01/icon-airplane.svg';
$icon_multi_day_url = $site_url . '/wp-content/uploads/2026/01/icon-block-2-2.svg';
$icon_private_url = $site_url . '/wp-content/uploads/2026/01/icon-block-2-3.svg';
$icon_events_url = $site_url . '/wp-content/uploads/2026/01/icon-block-2-4.svg';
?>

<section class="occasions-block">
	<div class="occasions-container">
		<div class="occasions-heading">
			<div class="occasions-heading-pill">
				<span class="occasions-heading-text"><?php echo esc_html__( 'Full Service', 'gts-theme' ); ?></span>
			</div>
			<h2 class="occasions-title"><?php echo esc_html__( 'Perfect for Every Occasion', 'gts-theme' ); ?></h2>
		</div>

		<div class="occasions-grid">
			<!-- Row 1: Executive Travel (dark) -->
			<div class="occasions-card occasions-card--dark occasions-card--1">
				<div class="occasions-card-icon-wrapper occasions-card-icon-wrapper--dark">
					<img src="<?php echo esc_url( $icon_executive_url ); ?>" alt="" class="occasions-card-icon" loading="lazy" width="48" height="48">
				</div>
				<h3 class="occasions-card-title"><?php echo esc_html__( 'Executive Travel', 'gts-theme' ); ?></h3>
				<p class="occasions-card-description"><?php echo esc_html__( 'ensure a seamless experience for board members, CEOs, or international guests.', 'gts-theme' ); ?></p>
			</div>

			<!-- Row 1: Airport Limousine Service (white card + image) -->
			<div class="occasions-card occasions-card--split occasions-card--2">
				<div class="occasions-card-content occasions-card-content--light">
					<div class="occasions-card-icon-wrapper occasions-card-icon-wrapper--light">
						<img src="<?php echo esc_url( $icon_airport_url ); ?>" alt="" class="occasions-card-icon" loading="lazy" width="48" height="48">
					</div>
					<h3 class="occasions-card-title occasions-card-title--dark"><?php echo esc_html__( 'Airport Limousine Service', 'gts-theme' ); ?></h3>
					<p class="occasions-card-description occasions-card-description--dark"><?php echo esc_html__( 'punctual, monitored, and stress-free – from arrival gate to final destination.', 'gts-theme' ); ?></p>
				</div>
				<div class="occasions-card-image" style="background-image: url('<?php echo esc_url( $image_airport_url ); ?>');" role="img" aria-label="<?php esc_attr_e( 'Chauffeur with luggage at luxury car', 'gts-theme' ); ?>"></div>
			</div>

			<!-- Row 2: Multi-Day Itineraries (dark) -->
			<div class="occasions-card occasions-card--dark occasions-card--3">
				<div class="occasions-card-icon-wrapper occasions-card-icon-wrapper--dark">
					<img src="<?php echo esc_url( $icon_multi_day_url ); ?>" alt="" class="occasions-card-icon" loading="lazy" width="48" height="48">
				</div>
				<h3 class="occasions-card-title"><?php echo esc_html__( 'Multi-Day Itineraries', 'gts-theme' ); ?></h3>
				<p class="occasions-card-description"><?php echo esc_html__( 'extended or multi-city travel managed with real-time coordination and dedicated support.', 'gts-theme' ); ?></p>
			</div>

			<!-- Row 2: Private Occasions (dark) -->
			<div class="occasions-card occasions-card--dark occasions-card--4">
				<div class="occasions-card-icon-wrapper occasions-card-icon-wrapper--dark">
					<img src="<?php echo esc_url( $icon_private_url ); ?>" alt="" class="occasions-card-icon" loading="lazy" width="48" height="48">
				</div>
				<h3 class="occasions-card-title"><?php echo esc_html__( 'Private Occasions', 'gts-theme' ); ?></h3>
				<p class="occasions-card-description"><?php echo esc_html__( 'weddings, galas, proms, birthday and personal celebrations with impeccable service.', 'gts-theme' ); ?></p>
			</div>

			<!-- Row 3: Events & Conferences (image + white card) -->
			<div class="occasions-card occasions-card--split occasions-card--split-reverse occasions-card--5">
				<div class="occasions-card-image" style="background-image: url('<?php echo esc_url( $image_events_url ); ?>');" role="img" aria-label="<?php esc_attr_e( 'Conference audience', 'gts-theme' ); ?>"></div>
				<div class="occasions-card-content occasions-card-content--light">
					<div class="occasions-card-icon-wrapper occasions-card-icon-wrapper--light">
						<img src="<?php echo esc_url( $icon_events_url ); ?>" alt="" class="occasions-card-icon" loading="lazy" width="48" height="48">
					</div>
					<h3 class="occasions-card-title occasions-card-title--dark"><?php echo esc_html__( 'Events & Conferences', 'gts-theme' ); ?></h3>
					<p class="occasions-card-description occasions-card-description--dark"><?php echo esc_html__( 'coordinated logistics for delegations, summits, and VIP gatherings.', 'gts-theme' ); ?></p>
				</div>
			</div>

			<!-- Row 3: Concluding paragraph -->
			<div class="occasions-footer occasions-card--6">
				<p class="occasions-footer-text"><?php echo esc_html__( 'Whether it\'s a business meeting, an exclusive event, or a long-distance journey – GTS Limousine Service adapts to your agenda with flawless precision and discretion.', 'gts-theme' ); ?></p>
			</div>
		</div>
	</div>
</section>
