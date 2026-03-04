<?php
/**
 * Services Block — вариант для страницы Limousine Service (только 2 карточки + Show more)
 *
 * @package GTS
 */

$services = function_exists( 'gts_get_global_services_cards' ) ? gts_get_global_services_cards() : array();
$related_block = function_exists( 'gts_is_service_style_page' ) && gts_is_service_style_page() && function_exists( 'gts_get_page_service_block' )
	? gts_get_page_service_block( 'related_services' )
	: array();
$section_pill = 'Every journey, perfectly organized.';
$section_title = 'From executive roadshows to private celebrations —<br>GTS provides end-to-end transport solutions worldwide.';
if ( ! empty( $related_block ) ) {
	if ( ! empty( $related_block['pill_text'] ) ) {
		$section_pill = (string) $related_block['pill_text'];
	}
	if ( ! empty( $related_block['title'] ) ) {
		$section_title = (string) $related_block['title'];
	}
}
$initial_visible = 2;
$total_services  = count( $services );

if ( empty( $services ) ) {
	return;
}
?>

<section class="services-block services-block--limousine" id="services-block">
	<div class="services-container">
		<div class="services-pill">
			<span class="services-pill-text"><?php echo esc_html( $section_pill ); ?></span>
		</div>
		<h2 class="services-title">
			<?php echo wp_kses_post( $section_title ); ?>
		</h2>

		<div class="services-grid">
			<?php foreach ( $services as $index => $service ) : ?>
				<?php $hidden_class = $index >= $initial_visible ? ' services-card--hidden' : ''; ?>
				<div class="services-card services-card--clickable<?php echo esc_attr( $hidden_class ); ?>" data-url="<?php echo esc_url( $service['url'] ); ?>" role="link" tabindex="0" aria-label="<?php echo esc_attr( $service['title'] ); ?>">
					<div class="services-card-content">
						<h3 class="services-card-title"><?php echo esc_html( $service['title'] ); ?></h3>
						<p class="services-card-description"><?php echo esc_html( $service['description'] ); ?></p>
						<a href="<?php echo esc_url( $service['url'] ); ?>" class="services-card-link"><?php echo esc_html__( 'Read more', 'gts-theme' ); ?></a>
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
			<button type="button" class="services-show-more"><?php echo esc_html__( 'Show more services', 'gts-theme' ); ?></button>
		<?php endif; ?>
	</div>
</section>
