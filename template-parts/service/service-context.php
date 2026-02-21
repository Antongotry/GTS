<?php
/**
 * Service Block: Context Grid Section
 *
 * @package GTS
 */

$block = isset( $args['block'] ) && is_array( $args['block'] ) ? $args['block'] : array();

$site_url = get_site_url();
$pill_text = ! empty( $block['pill_text'] ) ? $block['pill_text'] : 'Full Service';
$title = ! empty( $block['title'] ) ? $block['title'] : 'Where accuracy, tone, and context truly matter.';

$top_image = ! empty( $block['top_image'] ) ? $block['top_image'] : $site_url . '/wp-content/uploads/2026/02/photo-l-1_result.webp';
$bottom_image = ! empty( $block['bottom_image'] ) ? $block['bottom_image'] : $site_url . '/wp-content/uploads/2026/02/photo-l-2_result.webp';

$icon_business = $site_url . '/wp-content/uploads/2026/02/icon-l-1.svg';
$icon_group = $site_url . '/wp-content/uploads/2026/02/icon-l-2.svg';
$icon_medical = $site_url . '/wp-content/uploads/2026/02/icon-l-3.svg';
$icon_legal = $site_url . '/wp-content/uploads/2026/02/icon-l-5.svg';
$icon_property = $site_url . '/wp-content/uploads/2026/02/icon-l-4.svg';
$icon_private = $site_url . '/wp-content/uploads/2026/02/icon-l-3.svg';
$icon_schedule = $site_url . '/wp-content/uploads/2026/02/icon-l-2.svg';
?>

<section class="service-context-block">
	<div class="service-context-container">
		<div class="service-context-heading">
			<div class="why-us-heading-pill">
				<span class="why-us-heading-text"><?php echo esc_html( $pill_text ); ?></span>
			</div>
			<h2 class="service-context-title"><?php echo esc_html( $title ); ?></h2>
		</div>

		<div class="service-context-grid">
			<div class="service-context-card service-context-card--dark service-context-card--1">
				<div class="service-context-icon-badge"><img src="<?php echo esc_url( $icon_business ); ?>" alt="" width="24" height="24" loading="lazy"></div>
				<p class="service-context-text">Business meetings and negotiations</p>
			</div>

			<div class="service-context-card service-context-card--image service-context-card--2" style="background-image: url('<?php echo esc_url( $top_image ); ?>');" role="img" aria-label="<?php esc_attr_e( 'Business audience', 'gts-theme' ); ?>"></div>

			<div class="service-context-card service-context-card--dark service-context-card--3">
				<div class="service-context-icon-badge"><img src="<?php echo esc_url( $icon_group ); ?>" alt="" width="24" height="24" loading="lazy"></div>
				<p class="service-context-text">Corporate travel and executive visits</p>
			</div>

			<div class="service-context-card service-context-card--light service-context-card--4">
				<div class="service-context-icon-badge service-context-icon-badge--light"><img src="<?php echo esc_url( $icon_medical ); ?>" alt="" width="24" height="24" loading="lazy"></div>
				<p class="service-context-text">Medical appointments and consultations</p>
			</div>

			<div class="service-context-card service-context-card--dark service-context-card--5">
				<div class="service-context-icon-badge"><img src="<?php echo esc_url( $icon_legal ); ?>" alt="" width="24" height="24" loading="lazy"></div>
				<p class="service-context-text">Legal, administrative, or official procedures</p>
			</div>

			<div class="service-context-card service-context-card--light service-context-card--6">
				<div class="service-context-icon-badge service-context-icon-badge--light"><img src="<?php echo esc_url( $icon_property ); ?>" alt="" width="24" height="24" loading="lazy"></div>
				<p class="service-context-text">Property viewings and real estate transactions</p>
			</div>

			<div class="service-context-card service-context-card--dark service-context-card--7">
				<div class="service-context-icon-badge"><img src="<?php echo esc_url( $icon_private ); ?>" alt="" width="24" height="24" loading="lazy"></div>
				<p class="service-context-text">Private travel, events, and high-level appointments</p>
			</div>

			<div class="service-context-card service-context-card--dark service-context-card--8">
				<div class="service-context-icon-badge"><img src="<?php echo esc_url( $icon_schedule ); ?>" alt="" width="24" height="24" loading="lazy"></div>
				<p class="service-context-text">Multi-day or multi-location travel programs</p>
			</div>

			<div class="service-context-card service-context-card--image service-context-card--9" style="background-image: url('<?php echo esc_url( $bottom_image ); ?>');" role="img" aria-label="<?php esc_attr_e( 'Business travellers', 'gts-theme' ); ?>"></div>
		</div>
	</div>
</section>
