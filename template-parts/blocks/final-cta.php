<?php
/**
 * Final CTA Block Template
 *
 * @package GTS
 */

$background_image = get_site_url() . '/wp-content/uploads/2026/01/last-banner-home_result-scaled.webp';
?>

<section class="final-cta-block" style="background-image: url('<?php echo esc_url( $background_image ); ?>');">
	<div class="final-cta-container">
		<div class="final-cta-left">
			<h2 class="final-cta-title"><?php echo esc_html( 'Most transfer companies offer cars.' ); ?></h2>
			<p class="final-cta-description">
				<?php echo wp_kses_post( 'We offer <strong>peace of mind</strong> — through control,<br>consistency, and a truly global standard.' ); ?>
			</p>
			<a href="#" class="btn btn-primary final-cta-button">Book a transfer</a>
		</div>
		<div class="final-cta-right">
			<div class="final-cta-item">
				<div class="final-cta-item-header">
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/last-i-1.svg' ); ?>" alt="Precision logistics" class="final-cta-icon" width="26" height="26">
					<h3 class="final-cta-item-title">Precision logistics</h3>
				</div>
				<p class="final-cta-item-description">Every transfer is planned with accuracy — routes, timing, and coordination handled seamlessly, no matter the complexity.</p>
			</div>
			<div class="final-cta-item">
				<div class="final-cta-item-header">
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/last-i-2.svg' ); ?>" alt="Human-first service" class="final-cta-icon" width="26" height="26">
					<h3 class="final-cta-item-title">Human-first service</h3>
				</div>
				<p class="final-cta-item-description">Behind every booking is a personal coordinator who knows your preferences and ensures everything runs to plan.</p>
				<p class="final-cta-item-description final-cta-item-description-extra">Technology supports the process — people create the experience.</p>
			</div>
			<div class="final-cta-item">
				<div class="final-cta-item-header">
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/last-i-3.svg' ); ?>" alt="Consistency across the globe" class="final-cta-icon" width="26" height="26">
					<h3 class="final-cta-item-title">Consistency across the globe</h3>
				</div>
				<p class="final-cta-item-description">The same GTS standard in every destination — from major capitals to remote regions. One global system, one quality of service.</p>
			</div>
			<div class="final-cta-item">
				<div class="final-cta-item-header">
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/last-i-4.svg' ); ?>" alt="True premium fleet" class="final-cta-icon" width="26" height="26">
					<h3 class="final-cta-item-title">True premium fleet</h3>
				</div>
				<p class="final-cta-item-description">Business, premium and VIP-class vehicles, regularly renewed and immaculately maintained.</p>
			</div>
			<div class="final-cta-item">
				<div class="final-cta-item-header">
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/last-i-5.svg' ); ?>" alt="Tailored logistics" class="final-cta-icon" width="26" height="26">
					<h3 class="final-cta-item-title">Tailored logistics</h3>
				</div>
				<p class="final-cta-item-description">No templates — every trip is planned to match your timing, priorities and comfort preferences. From a single airport pickup to a week-long corporate tour.</p>
			</div>
		</div>
	</div>
</section>
