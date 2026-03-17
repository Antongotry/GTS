<?php
/**
 * Why Us Block Template
 *
 * @package GTS
 */

// Get image and icon URLs from WordPress media library
$image_1_url = get_site_url() . '/wp-content/uploads/2026/01/home-2-block-1-_result.webp';
$icon_2_url = get_site_url() . '/wp-content/uploads/2026/01/icon-block-2-1.svg';
$icon_3_url = get_site_url() . '/wp-content/uploads/2026/01/icon-block-2-2.svg';
$icon_4_url = get_site_url() . '/wp-content/uploads/2026/01/icon-block-2-3.svg';
$icon_5_url = get_site_url() . '/wp-content/uploads/2026/01/icon-block-2-4.svg';
$image_6_url = get_site_url() . '/wp-content/uploads/2026/01/home-2-block-2_result.webp';
$is_city_to_city = is_page_template( 'page-city-to-city.php' ) || is_page( 'city-to-city' );
$why_us_block = function_exists( 'gts_is_service_style_page' ) && gts_is_service_style_page() && function_exists( 'gts_get_page_service_block' )
	? gts_get_page_service_block( 'why_us' )
	: array();

$item_5_title = $is_city_to_city ? 'Effortless booking' : '24/7 Human Support';
$item_5_description = $is_city_to_city
	? 'Book directly on the website or through your personal manager — 24/7 via messenger, email or phone.'
	: 'Book directly on the website or through<br>your personal manager — 24/7 via<br>messenger, email or phone.';
$item_6_title = $is_city_to_city ? 'Guaranteed punctuality' : 'Seamless coordination';
$item_6_description = $is_city_to_city
	? 'Our chauffeurs track flights and traffic in real time to ensure every pickup happens precisely on schedule.'
	: 'We work directly with your planner or venue to<br>synchronise every detail — from arrivals to final<br>departures.';
$intro_title = 'GTS Limousine Service was created for those who expect every moment to reflect precision and class.';
$intro_text = 'Every journey is coordinated by professionals who understand that timing, presentation, and reliability are not extras — they are essentials.';
$show_intro = ! is_front_page();
$section_pill = 'Why us?';

$cards = array(
	array(
		'card_type'    => 'image',
		'image'        => $image_1_url,
		'icon'         => '',
		'title'        => 'Available worldwide',
		'description'  => 'Consistent excellence in executive<br>and luxury transfers — wherever<br>your journey takes you.',
	),
	array(
		'card_type'    => 'icon',
		'image'        => '',
		'icon'         => $icon_2_url,
		'title'        => 'World-class fleet',
		'description'  => 'Late-model business, premium and<br>VIP vehicles, perfectly maintained for<br>comfort, style and safety.',
	),
	array(
		'card_type'    => 'icon',
		'image'        => '',
		'icon'         => $icon_3_url,
		'title'        => 'Qualified chauffeurs',
		'description'  => 'Licensed, experienced and discreet<br>professionals trained to meet the<br>highest service standards.',
	),
	array(
		'card_type'    => 'icon',
		'image'        => '',
		'icon'         => $icon_4_url,
		'title'        => 'Security & discretion',
		'description'  => 'Strict safety protocols, discreet<br>coordination, and confidential service for<br>corporate & VIP clients.',
	),
	array(
		'card_type'    => 'icon',
		'image'        => '',
		'icon'         => $icon_5_url,
		'title'        => $item_5_title,
		'description'  => $item_5_description,
	),
	array(
		'card_type'    => 'image',
		'image'        => $image_6_url,
		'icon'         => '',
		'title'        => $item_6_title,
		'description'  => $item_6_description,
	),
);

if ( ! empty( $why_us_block ) ) {
	if ( ! empty( $why_us_block['pill_text'] ) ) {
		$section_pill = (string) $why_us_block['pill_text'];
	}
	if ( ! empty( $why_us_block['intro_title'] ) ) {
		$intro_title = (string) $why_us_block['intro_title'];
	}
	if ( ! empty( $why_us_block['intro_text'] ) ) {
		$intro_text = (string) $why_us_block['intro_text'];
	}
	if ( ! empty( $why_us_block['cards'] ) && is_array( $why_us_block['cards'] ) ) {
		$custom_cards = array_values(
			array_filter(
				array_map(
					static function ( $card ) {
						if ( ! is_array( $card ) ) {
							return null;
						}
						return array(
							'card_type'   => ! empty( $card['card_type'] ) ? (string) $card['card_type'] : 'icon',
							'image'       => ! empty( $card['image'] ) ? (string) $card['image'] : '',
							'icon'        => ! empty( $card['icon'] ) ? (string) $card['icon'] : '',
							'title'       => isset( $card['title'] ) ? (string) $card['title'] : '',
							'description' => isset( $card['description'] ) ? (string) $card['description'] : '',
						);
					},
					$why_us_block['cards']
				)
			)
		);
		foreach ( $custom_cards as $index => $custom_card ) {
			if ( $index > 5 ) {
				break;
			}
			$cards[ $index ] = wp_parse_args( $custom_card, $cards[ $index ] );
		}
	}
}
?>

<section class="why-us-block">
	<div class="why-us-container">
		<div class="why-us-heading">
			<div class="why-us-heading-pill">
				<span class="why-us-heading-text"><?php echo esc_html( $section_pill ); ?></span>
			</div>
			<div class="why-us-heading-line" aria-hidden="true"></div>
		</div>
			<?php if ( $show_intro ) : ?>
				<div class="why-us-intro">
					<div class="why-us-intro-title"><?php echo wp_kses_post( nl2br( $intro_title ) ); ?></div>
					<p class="why-us-intro-description"><?php echo wp_kses_post( nl2br( $intro_text ) ); ?></p>
				</div>
			<?php endif; ?>
			<div class="why-us-grid">
				<!-- Element 1: Image as background -->
				<div class="why-us-item why-us-item-1" style="--gts-card-bg: url('<?php echo esc_url( $cards[0]['image'] ); ?>');">
					<div class="why-us-item-title"><?php echo esc_html( gts_normalize_heading_text( $cards[0]['title'] ) ); ?></div>
					<p class="why-us-item-description"><?php echo wp_kses_post( nl2br( $cards[0]['description'] ) ); ?></p>
				</div>

			<!-- Element 2: Icon -->
				<div class="why-us-item why-us-item-2">
					<div class="why-us-item-icon-wrapper">
						<img src="<?php echo esc_url( $cards[1]['icon'] ); ?>" alt="" aria-hidden="true" class="why-us-item-icon" loading="lazy" width="48" height="48">
					</div>
					<div class="why-us-item-title"><?php echo esc_html( gts_normalize_heading_text( $cards[1]['title'] ) ); ?></div>
					<p class="why-us-item-description"><?php echo wp_kses_post( nl2br( $cards[1]['description'] ) ); ?></p>
				</div>

			<!-- Element 3: Icon -->
				<div class="why-us-item why-us-item-3">
					<div class="why-us-item-icon-wrapper">
						<img src="<?php echo esc_url( $cards[2]['icon'] ); ?>" alt="" aria-hidden="true" class="why-us-item-icon" loading="lazy" width="48" height="48">
					</div>
					<div class="why-us-item-title"><?php echo esc_html( gts_normalize_heading_text( $cards[2]['title'] ) ); ?></div>
					<p class="why-us-item-description"><?php echo wp_kses_post( nl2br( $cards[2]['description'] ) ); ?></p>
				</div>

			<!-- Element 4: Icon -->
				<div class="why-us-item why-us-item-4">
					<div class="why-us-item-icon-wrapper">
						<img src="<?php echo esc_url( $cards[3]['icon'] ); ?>" alt="" aria-hidden="true" class="why-us-item-icon" loading="lazy" width="48" height="48">
					</div>
					<div class="why-us-item-title"><?php echo esc_html( gts_normalize_heading_text( $cards[3]['title'] ) ); ?></div>
					<p class="why-us-item-description"><?php echo wp_kses_post( nl2br( $cards[3]['description'] ) ); ?></p>
				</div>

			<!-- Element 5: Icon -->
				<div class="why-us-item why-us-item-5">
					<div class="why-us-item-icon-wrapper">
						<img src="<?php echo esc_url( $cards[4]['icon'] ); ?>" alt="" aria-hidden="true" class="why-us-item-icon" loading="lazy" width="48" height="48">
					</div>
					<div class="why-us-item-title"><?php echo esc_html( gts_normalize_heading_text( $cards[4]['title'] ) ); ?></div>
					<p class="why-us-item-description"><?php echo wp_kses_post( nl2br( $cards[4]['description'] ) ); ?></p>
				</div>

			<!-- Element 6: Image as background -->
				<div class="why-us-item why-us-item-6" style="--gts-card-bg: url('<?php echo esc_url( $cards[5]['image'] ); ?>');">
					<div class="why-us-item-title"><?php echo esc_html( gts_normalize_heading_text( $cards[5]['title'] ) ); ?></div>
					<p class="why-us-item-description"><?php echo wp_kses_post( nl2br( $cards[5]['description'] ) ); ?></p>
				</div>
		</div>
	</div>
</section>
