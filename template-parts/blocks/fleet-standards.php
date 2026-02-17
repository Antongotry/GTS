<?php
/**
 * Fleet standards block (below bottom CTA).
 *
 * @package GTS
 */

$base = get_site_url() . '/wp-content/uploads/2026/02/';
?>

<section class="fleet-standards">
	<div class="fleet-standards__container">
		<div class="fleet-standards__top">
			<h2 class="fleet-standards__title"><?php echo wp_kses_post( 'Standards Across All<br>Fleet Categories' ); ?></h2>
			<p class="fleet-standards__lead"><?php esc_html_e( 'Every vehicle and aircraft is selected according to strict standards of safety, comfort, presentation, and operational reliability.', 'gts-theme' ); ?></p>
		</div>

		<div class="fleet-standards__grid">
			<article class="fleet-standards-card fleet-standards-card--dark">
				<div class="fleet-standards-card__icon-wrap">
					<img src="<?php echo esc_url( $base . 'fleet-icon-1.svg' ); ?>" alt="" class="fleet-standards-card__icon" width="20" height="20" loading="lazy">
				</div>
				<p class="fleet-standards-card__text"><?php esc_html_e( 'Professional operators and certified partners', 'gts-theme' ); ?></p>
			</article>

			<div class="fleet-standards-card fleet-standards-card--image" style="background-image: url('<?php echo esc_url( $base . 'fleet-photo_result.webp' ); ?>');" role="img" aria-label="<?php esc_attr_e( 'Ground transport service', 'gts-theme' ); ?>"></div>

			<article class="fleet-standards-card fleet-standards-card--dark">
				<div class="fleet-standards-card__icon-wrap">
					<img src="<?php echo esc_url( $base . 'fleet-icon-2.svg' ); ?>" alt="" class="fleet-standards-card__icon" width="20" height="20" loading="lazy">
				</div>
				<p class="fleet-standards-card__text"><?php esc_html_e( 'Compliance with local and international regulations', 'gts-theme' ); ?></p>
			</article>

			<article class="fleet-standards-card fleet-standards-card--light">
				<div class="fleet-standards-card__icon-wrap fleet-standards-card__icon-wrap--light">
					<img src="<?php echo esc_url( $base . 'fleet-icon-3.svg' ); ?>" alt="" class="fleet-standards-card__icon" width="20" height="20" loading="lazy">
				</div>
				<p class="fleet-standards-card__text fleet-standards-card__text--dark"><?php esc_html_e( 'Maintained to premium standards', 'gts-theme' ); ?></p>
			</article>

			<article class="fleet-standards-card fleet-standards-card--dark">
				<div class="fleet-standards-card__icon-wrap">
					<img src="<?php echo esc_url( $base . 'fleet-icon-4.svg' ); ?>" alt="" class="fleet-standards-card__icon" width="20" height="20" loading="lazy">
				</div>
				<p class="fleet-standards-card__text"><?php esc_html_e( 'Suitable for corporate, event, and private use', 'gts-theme' ); ?></p>
			</article>
		</div>
	</div>
</section>
