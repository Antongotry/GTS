<?php
/**
 * Services Block Template
 *
 * @package GTS
 */

$services = function_exists( 'gts_get_global_services_cards' ) ? gts_get_global_services_cards() : array();
$initial_visible = 6;
$total_services  = count( $services );

if ( empty( $services ) ) {
	return;
}
?>

<section class="services-block" id="services-block">
	<div class="services-container">
		<div class="services-pill">
			<span class="services-pill-text"><?php echo esc_html( 'Every journey, perfectly organized.' ); ?></span>
		</div>
		<h2 class="services-title">
			<?php echo wp_kses_post( 'From executive roadshows to private celebrations —<br>GTS provides end-to-end transport solutions worldwide.' ); ?>
		</h2>

		<div class="services-grid">
			<?php foreach ( $services as $index => $service ) : ?>
				<?php $hidden_class = $index >= $initial_visible ? ' services-card--hidden' : ''; ?>
				<div class="services-card services-card--clickable<?php echo esc_attr( $hidden_class ); ?>" data-url="<?php echo esc_url( $service['url'] ); ?>" role="link" tabindex="0" aria-label="<?php echo esc_attr( $service['title'] ); ?>">
					<div class="services-card-content">
						<h3 class="services-card-title"><?php echo esc_html( $service['title'] ); ?></h3>
						<p class="services-card-description"><?php echo esc_html( $service['description'] ); ?></p>
						<a href="<?php echo esc_url( $service['url'] ); ?>" class="services-card-link">Read more</a>
					</div>
					<div class="services-card-image">
						<a href="<?php echo esc_url( $service['url'] ); ?>" aria-label="<?php echo esc_attr( $service['title'] ); ?>">
							<img src="<?php echo esc_url( $service['image'] ); ?>" alt="<?php echo esc_attr( $service['title'] ); ?>" class="services-image" loading="lazy" width="300" height="200">
						</a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ( $total_services > $initial_visible ) : ?>
			<button type="button" class="services-show-more">Show more services</button>
		<?php endif; ?>
	</div>
</section>
