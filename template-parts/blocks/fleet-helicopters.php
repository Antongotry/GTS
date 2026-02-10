<?php
/**
 * Fleet: Helicopters intro block.
 *
 * @package GTS
 */

$base = get_site_url() . '/wp-content/uploads/2026/02/';
?>

<section class="fleet-heli">
	<div class="fleet-heli__container">
		<h2 class="fleet-heli__title"><?php echo wp_kses_post( 'Helicopter transfers for time-critical<br>routes, remote locations, and<br>seamless air-to-ground transitions.' ); ?></h2>

		<div class="fleet-heli__list" role="list">
			<div class="fleet-heli__item" role="listitem">
				<img class="fleet-heli__icon" src="<?php echo esc_url( $base . 'helicopter-1.svg' ); ?>" alt="" width="26" height="26">
				<p class="fleet-heli__text"><?php esc_html_e( 'Helicopter transfers for time-critical routes, remote locations, and seamless air-to-ground transitions.', 'gts-theme' ); ?></p>
			</div>

			<div class="fleet-heli__item" role="listitem">
				<img class="fleet-heli__icon" src="<?php echo esc_url( $base . 'helicopter-2.svg' ); ?>" alt="" width="26" height="26">
				<p class="fleet-heli__text"><?php esc_html_e( 'Event and VIP transfers', 'gts-theme' ); ?></p>
			</div>

			<div class="fleet-heli__item" role="listitem">
				<img class="fleet-heli__icon" src="<?php echo esc_url( $base . 'helicopter-3.svg' ); ?>" alt="" width="26" height="26">
				<p class="fleet-heli__text"><?php esc_html_e( 'Integrated with ground transport and scheduling', 'gts-theme' ); ?></p>
			</div>
		</div>
	</div>
</section>
