<?php
/**
 * How It Works Block Template
 *
 * @package GTS
 */

$background_url = get_site_url() . '/wp-content/uploads/2026/01/home-3-block-banner_result-scaled.webp';
$step_icon_1 = get_site_url() . '/wp-content/uploads/2026/01/block-3-icon-1.svg';
$step_icon_2 = get_site_url() . '/wp-content/uploads/2026/01/block-3-icon-2.svg';
$step_icon_3 = get_site_url() . '/wp-content/uploads/2026/01/block-3-icon-3.svg';
$step_icon_4 = get_site_url() . '/wp-content/uploads/2026/01/block-3-icon-4.svg';
$is_city_to_city = is_page_template( 'page-city-to-city.php' ) || is_page( 'city-to-city' );
$hiw_block = function_exists( 'gts_is_service_style_page' ) && gts_is_service_style_page() && function_exists( 'gts_get_page_service_block' )
	? gts_get_page_service_block( 'how_it_works' )
	: array();
$how_it_works_title = $is_city_to_city
	? 'Booking with GTS is<br>straightforward — one clear<br>process from request to ride,<br>backed by 24/7 support.'
	: 'We handle the details —<br>you enjoy the moments';
$section_pill = 'How it works';

$steps = array(
	array(
		'number' => '01',
		'icon' => $step_icon_1,
		'title' => 'Book the way<br>you prefer',
		'description' => 'Reserve instantly on our website or send a<br>request directly to our support team.',
	),
	array(
		'number' => '02',
		'icon' => $step_icon_2,
		'title' => 'Receive confirmation',
		'description' => 'All details arrive by email — your itinerary, photo of the<br>car, driver info and contacts.',
	),
	array(
		'number' => '03',
		'icon' => $step_icon_3,
		'title' => 'Meet your driver',
		'description' => 'A professional chauffeur arrives on time, helps<br>with luggage and ensures comfort.',
	),
	array(
		'number' => '04',
		'icon' => $step_icon_4,
		'title' => 'Travel with<br>confidence',
		'description' => 'Transparent pricing, insured rides and real<br>24/7 assistance worldwide.',
	),
);

if ( ! empty( $hiw_block ) ) {
	if ( ! empty( $hiw_block['background'] ) ) {
		$background_url = (string) $hiw_block['background'];
	}
	if ( ! empty( $hiw_block['pill_text'] ) ) {
		$section_pill = (string) $hiw_block['pill_text'];
	}
	if ( ! empty( $hiw_block['title'] ) ) {
		$how_it_works_title = (string) $hiw_block['title'];
	}
	if ( ! empty( $hiw_block['steps'] ) && is_array( $hiw_block['steps'] ) ) {
		$custom_steps = array_values(
			array_filter(
				array_map(
					static function ( $step ) {
						if ( ! is_array( $step ) ) {
							return null;
						}
						return array(
							'number'      => ! empty( $step['number'] ) ? (string) $step['number'] : '',
							'icon'        => ! empty( $step['icon'] ) ? (string) $step['icon'] : '',
							'title'       => ! empty( $step['title'] ) ? (string) $step['title'] : '',
							'description' => ! empty( $step['description'] ) ? (string) $step['description'] : '',
						);
					},
					$hiw_block['steps']
				)
			)
		);
		if ( ! empty( $custom_steps ) ) {
			$steps = $custom_steps;
		}
	}
}
?>

<section class="how-it-works-block" style="--gts-bg-image: url('<?php echo esc_url( $background_url ); ?>');">
	<div class="how-it-works-container">
		<div class="how-it-works-left">
			<div class="how-it-works-pill">
				<span class="how-it-works-pill-text"><?php echo esc_html( $section_pill ); ?></span>
			</div>
			<div class="how-it-works-title">
				<?php echo wp_kses_post( $how_it_works_title ); ?>
			</div>
		</div>
		<div class="how-it-works-right">
			<div class="how-it-works-steps">
				<?php foreach ( $steps as $step ) : ?>
					<div class="how-it-works-step">
						<div class="how-it-works-step-header">
							<div class="how-it-works-step-title"><?php echo wp_kses_post( $step['title'] ); ?></div>
							<div class="how-it-works-step-badge">
								<span class="how-it-works-step-number"><?php echo esc_html( $step['number'] ); ?></span>
								<span class="how-it-works-step-icon">
									<img src="<?php echo esc_url( $step['icon'] ); ?>" alt="" aria-hidden="true" loading="lazy" width="24" height="24">
								</span>
							</div>
						</div>
						<p class="how-it-works-step-description"><?php echo wp_kses_post( $step['description'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
