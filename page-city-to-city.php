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
				<h2 class="final-cta-title"><?php echo wp_kses_post( 'Most transfer companies offer cars.' ); ?></h2>
				<p class="final-cta-description">
					<?php echo wp_kses_post( 'We offer peace of mind through control, consistency, and a truly global standard.' ); ?>
				</p>
				<a href="<?php echo esc_url( home_url( '/book-a-transfer/' ) ); ?>" class="btn btn-primary final-cta-button">Book a transfer</a>
			</div>

			<div class="final-cta-right final-cta-right--desktop final-cta-right--service">
				<div class="final-cta-item">
					<div class="final-cta-item-header">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/last-i-1.svg' ); ?>" alt="Precision logistics" class="final-cta-icon" width="26" height="26" loading="lazy">
						<h3 class="final-cta-item-title">Precision logistics</h3>
					</div>
					<p class="final-cta-item-description">Every transfer is planned with accuracy: routes, timing, and coordination handled seamlessly.</p>
				</div>

				<div class="final-cta-item">
					<div class="final-cta-item-header">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/last-i-2.svg' ); ?>" alt="Human-first service" class="final-cta-icon" width="26" height="26" loading="lazy">
						<h3 class="final-cta-item-title">Human-first service</h3>
					</div>
					<p class="final-cta-item-description">Behind every booking is a personal coordinator who knows your preferences and requirements.</p>
				</div>

				<div class="final-cta-item">
					<div class="final-cta-item-header">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/last-i-3.svg' ); ?>" alt="Consistency across the globe" class="final-cta-icon" width="26" height="26" loading="lazy">
						<h3 class="final-cta-item-title">Consistency across the globe</h3>
					</div>
					<p class="final-cta-item-description">The same GTS standard in every destination with one service quality.</p>
				</div>

				<div class="final-cta-item">
					<div class="final-cta-item-header">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/last-i-4.svg' ); ?>" alt="True premium fleet" class="final-cta-icon" width="26" height="26" loading="lazy">
						<h3 class="final-cta-item-title">True premium fleet</h3>
					</div>
					<p class="final-cta-item-description">Business, premium, and VIP-class vehicles, regularly renewed and impeccably maintained.</p>
				</div>

				<div class="final-cta-item">
					<div class="final-cta-item-header">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/last-i-5.svg' ); ?>" alt="Tailored logistics" class="final-cta-icon" width="26" height="26" loading="lazy">
						<h3 class="final-cta-item-title">Tailored logistics</h3>
					</div>
					<p class="final-cta-item-description">No templates: each trip is planned around your schedule, priorities, and comfort.</p>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/blocks/booking-form-limousine-service' ); ?>

	<?php get_template_part( 'template-parts/blocks/why-us' ); ?>

	<?php get_template_part( 'template-parts/blocks/fleet-slider' ); ?>

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
