<?php
/**
 * Template Name: City-to-City
 * Template for displaying City-to-City service page
 *
 * @package GTS
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php get_template_part( 'template-parts/blocks/hero-city-to-city-service' ); ?>

	<section class="final-cta-block final-cta-block--service">
		<div class="final-cta-container final-cta-container--service">
			<div class="final-cta-left final-cta-left--service">
				<div class="why-us-heading-pill final-cta-service-pill">
					<span class="why-us-heading-text">Preferences</span>
				</div>
				<h2 class="final-cta-title"><?php echo wp_kses_post( 'A Better Way to Travel<br>Between Cities' ); ?></h2>
				<p class="final-cta-description">
					<?php echo wp_kses_post( 'Airports, trains, rentals — they all take time, coordination, and patience. GTS offers a more refined way to move between cities: effortless, private, and precisely managed.' ); ?>
				</p>
				<a href="<?php echo esc_url( home_url( '/book-a-transfer/' ) ); ?>" class="btn btn-primary final-cta-button">Book a transfer</a>
			</div>

			<div class="final-cta-right final-cta-right--desktop final-cta-right--service">
				<div class="final-cta-item">
					<div class="final-cta-item-header">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/02/city-icon-1.svg' ); ?>" alt="Time is your real luxury" class="final-cta-icon" width="26" height="26" loading="lazy">
						<h3 class="final-cta-item-title">Time is your real luxury</h3>
					</div>
					<p class="final-cta-item-description">Skip queues and transfers — travel door-to-door, without waiting or interruptions.</p>
				</div>

				<div class="final-cta-item">
					<div class="final-cta-item-header">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/02/city-icon-2.svg' ); ?>" alt="Confidence in every journey" class="final-cta-icon" width="26" height="26" loading="lazy">
						<h3 class="final-cta-item-title">Confidence in every journey</h3>
					</div>
					<p class="final-cta-item-description">No crowds, delays, or cancellations — just punctual, licensed chauffeurs and global coordination.</p>
				</div>

				<div class="final-cta-item">
					<div class="final-cta-item-header">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/02/city-icon-3.svg' ); ?>" alt="Your schedule, your rules" class="final-cta-icon" width="26" height="26" loading="lazy">
						<h3 class="final-cta-item-title">Your schedule, your rules</h3>
					</div>
					<p class="final-cta-item-description">Choose departure times and stops. Plans change? We adjust instantly, 24/7.</p>
				</div>

				<div class="final-cta-item">
					<div class="final-cta-item-header">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/02/city-icon-4.svg' ); ?>" alt="Transparent, all-inclusive pricing" class="final-cta-icon" width="26" height="26" loading="lazy">
						<h3 class="final-cta-item-title">Transparent, all-inclusive pricing</h3>
					</div>
					<p class="final-cta-item-description">Pay per car, not per seat. Taxes, tolls, and waiting time are always included.</p>
				</div>

				<div class="final-cta-item">
					<div class="final-cta-item-header">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/02/city-icon-5.svg' ); ?>" alt="Quiet comfort on every route" class="final-cta-icon" width="26" height="26" loading="lazy">
						<h3 class="final-cta-item-title">Quiet comfort on every route</h3>
					</div>
					<p class="final-cta-item-description">Relax in a premium car with a professional chauffeur, bottled water, and Wi-Fi on request.</p>
				</div>

				<div class="final-cta-item">
					<div class="final-cta-item-header">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/02/city-icon-6.svg' ); ?>" alt="Flexible routes" class="final-cta-icon" width="26" height="26" loading="lazy">
						<h3 class="final-cta-item-title">Flexible routes</h3>
					</div>
					<p class="final-cta-item-description">Stop for meetings, meals, or sightseeing anytime.</p>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/blocks/booking-form-limousine-service' ); ?>

	<?php get_template_part( 'template-parts/blocks/why-us' ); ?>

	<?php
	get_template_part(
		'template-parts/blocks/fleet-slider',
		null,
		array(
			'category_slugs' => array( 'sedan-suv' ),
		)
	);
	?>

	<?php get_template_part( 'template-parts/blocks/occasions' ); ?>

	<?php get_template_part( 'template-parts/blocks/how-it-works' ); ?>

	<div class="white-sections-wrapper">
		<?php get_template_part( 'template-parts/blocks/trusted-by' ); ?>
		<?php get_template_part( 'template-parts/blocks/faq' ); ?>
		<?php get_template_part( 'template-parts/blocks/custom-itinerary', 'limousine' ); ?>
		<?php get_template_part( 'template-parts/blocks/services', 'limousine' ); ?>
	</div>

</main><!-- #primary -->

<?php
get_footer();
