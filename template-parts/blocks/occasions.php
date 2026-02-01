<?php
/**
 * Occasions Block Template
 * "Perfect for Every Occasion" - uses same structure and styles as why-us
 *
 * @package GTS
 */

$site_url = get_site_url();
$image_airport_url = $site_url . '/wp-content/uploads/2026/01/airport-limousine.webp';
$image_events_url = $site_url . '/wp-content/uploads/2026/01/events-conference.webp';
$icon_executive_url = $site_url . '/wp-content/uploads/2026/01/icon-block-2-1.svg';
$icon_airport_url = $site_url . '/wp-content/uploads/2026/01/icon-airplane.svg';
$icon_multi_day_url = $site_url . '/wp-content/uploads/2026/01/icon-block-2-2.svg';
$icon_private_url = $site_url . '/wp-content/uploads/2026/01/icon-block-2-3.svg';
$icon_events_url = $site_url . '/wp-content/uploads/2026/01/icon-block-2-4.svg';
?>

<section class="why-us-block occasions-block">
	<div class="why-us-container">
		<div class="why-us-heading">
			<div class="why-us-heading-pill">
				<span class="why-us-heading-text"><?php echo esc_html__( 'Full Service', 'gts-theme' ); ?></span>
			</div>
			<div class="occasions-title-wrapper">
				<h2 class="occasions-title"><?php echo esc_html__( 'Perfect for Every Occasion', 'gts-theme' ); ?></h2>
			</div>
		</div>
		<div class="why-us-grid">
			<!-- Item 1: Executive Travel (spans 2 cols, row 1) - no icon, like why-us item 1 -->
			<div class="why-us-item why-us-item-1">
				<h3 class="why-us-item-title"><?php echo esc_html__( 'Executive Travel', 'gts-theme' ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( 'ensure a seamless experience for board members,<br>CEOs, or international guests.' ); ?></p>
			</div>

			<!-- Item 2: Airport Limousine Service (with image bg) - no icon, like why-us item 1/6 -->
			<div class="why-us-item why-us-item-2" style="background-image: url('<?php echo esc_url( $image_airport_url ); ?>');">
				<h3 class="why-us-item-title"><?php echo esc_html__( 'Airport Limousine Service', 'gts-theme' ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( 'punctual, monitored, and stress-free – from arrival gate<br>to final destination.' ); ?></p>
			</div>

			<!-- Item 3: Multi-Day Itineraries -->
			<div class="why-us-item why-us-item-3">
				<div class="why-us-item-icon-wrapper">
					<img src="<?php echo esc_url( $icon_multi_day_url ); ?>" alt="" class="why-us-item-icon" loading="lazy" width="48" height="48">
				</div>
				<h3 class="why-us-item-title"><?php echo esc_html__( 'Multi-Day Itineraries', 'gts-theme' ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( 'extended or multi-city travel managed with real-time<br>coordination and dedicated support.' ); ?></p>
			</div>

			<!-- Item 4: Private Occasions -->
			<div class="why-us-item why-us-item-4">
				<div class="why-us-item-icon-wrapper">
					<img src="<?php echo esc_url( $icon_private_url ); ?>" alt="" class="why-us-item-icon" loading="lazy" width="48" height="48">
				</div>
				<h3 class="why-us-item-title"><?php echo esc_html__( 'Private Occasions', 'gts-theme' ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( 'weddings, galas, proms, birthday and personal<br>celebrations with impeccable service.' ); ?></p>
			</div>

			<!-- Item 5: Events & Conferences (with image bg) - no icon, like why-us item 1/6 -->
			<div class="why-us-item why-us-item-5" style="background-image: url('<?php echo esc_url( $image_events_url ); ?>');">
				<h3 class="why-us-item-title"><?php echo esc_html__( 'Events & Conferences', 'gts-theme' ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( 'coordinated logistics for delegations, summits,<br>and VIP gatherings.' ); ?></p>
			</div>

			<!-- Item 6: Footer text (spans 2 cols, row 2) -->
			<div class="why-us-item why-us-item-6 occasions-footer-item">
				<p class="why-us-item-description occasions-footer-text"><?php echo esc_html__( 'Whether it\'s a business meeting, an exclusive event, or a long-distance journey – GTS Limousine Service adapts to your agenda with flawless precision and discretion.', 'gts-theme' ); ?></p>
			</div>
		</div>
	</div>
</section>
