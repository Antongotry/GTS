<?php
/**
 * Template Name: Terms Page
 * Template Post Type: page
 *
 * @package GTS
 */

get_header();
?>

<main id="primary" class="site-main site-main--default-page">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header>

			<div class="entry-content">
				<?php if ( trim( wp_strip_all_tags( get_the_content() ) ) !== '' ) : ?>
					<?php the_content(); ?>
				<?php else : ?>
					<p><strong>Last updated:</strong> <?php echo esc_html( gmdate( 'F j, Y' ) ); ?></p>

					<h2>1. Scope of Services</h2>
					<p>GTS provides premium transfer and mobility services. All bookings are subject to route availability, operational limitations, and confirmation by our team.</p>

					<h2>2. Booking and Confirmation</h2>
					<p>A booking request is not final until it is confirmed by GTS. We may contact you to clarify route details, passenger data, and service conditions before confirmation.</p>

					<h2>3. Pricing and Changes</h2>
					<p>Displayed prices are indicative unless explicitly confirmed in writing. Final pricing may vary due to route updates, waiting time, special requests, night tariff, or force majeure factors.</p>

					<h2>4. Cancellations and No-Show</h2>
					<p>Cancellation terms depend on service type and notice period. In case of late cancellation or no-show, cancellation fees may apply according to confirmed booking conditions.</p>

					<h2>5. Passenger Responsibilities</h2>
					<p>Passengers must provide accurate pickup details, contact information, and luggage/passenger counts. GTS is not responsible for delays caused by incorrect information from the client.</p>

					<h2>6. Liability</h2>
					<p>GTS is liable only within limits established by applicable law and confirmed service conditions. We are not liable for indirect losses, missed connections, or delays caused by third parties.</p>

					<h2>7. Privacy and Data</h2>
					<p>Personal data is processed solely for booking, service fulfillment, and client communication. For full details, please review our Privacy Policy.</p>

					<h2>8. Contact</h2>
					<p>For terms clarifications, contact us via the Contacts page or official support channels listed on the website.</p>
				<?php endif; ?>
			</div>
		</article>
	<?php endwhile; ?>
</main>

<?php
get_footer();
