<?php

/**
 * Template for displaying single Service posts
 *
 * All blocks read from ACF fields with fallback to original content.
 * Each block can be enabled/disabled via ACF toggle.
 *
 * @package GTS
 */

get_header();

// Get ACF blocks for this service
$blocks_data = array();
$block_enabled = array(
	'hero' => true,
	'service_context' => false,
	'service_intro' => true,
	'booking_form' => true,
	'why_us' => true,
	'fleet' => true,
	'occasions' => true,
	'how_it_works' => true,
	'testimonials' => true,
	'faq' => true,
	'cta' => true,
	'related_services' => true,
	'bottom_text' => true,
);

if (function_exists('get_field')) {
	$blocks = get_field('service_blocks');
	if ($blocks && is_array($blocks)) {
		foreach ($blocks as $block) {
			$layout = isset($block['acf_fc_layout']) ? $block['acf_fc_layout'] : '';
			if ($layout) {
				$blocks_data[$layout] = $block;
				$block_enabled[$layout] = isset($block['enabled']) ? (bool)$block['enabled'] : true;
				// Store blocks in order for dynamic rendering
				$blocks_ordered[] = array(
					'layout' => $layout,
					'data'   => $block,
					'enabled' => isset($block['enabled']) ? (bool)$block['enabled'] : true,
				);
			}
		}
	}
}
// Initialize empty ordered blocks if not set
if (!isset($blocks_ordered)) {
	$blocks_ordered = array();
}

$site_url = get_site_url();
$current_service_slug = '';
if (is_singular('service')) {
	$current_service_slug = (string) get_post_field('post_name', get_the_ID());
}

// Fill empty media fields in existing repeater rows with defaults by index.
// This keeps custom admin content untouched and prevents empty icons/images in templates.
$fill_missing_media = static function (array $items, array $defaults, array $media_keys): array {
	foreach ($items as $index => $item) {
		if (! is_array($item)) {
			continue;
		}
		$default_item = isset($defaults[$index]) && is_array($defaults[$index]) ? $defaults[$index] : array();
		if (empty($default_item)) {
			continue;
		}
		foreach ($media_keys as $media_key) {
			$current_value = isset($item[$media_key]) ? trim((string) $item[$media_key]) : '';
			$default_value = isset($default_item[$media_key]) ? trim((string) $default_item[$media_key]) : '';
			if ('' === $current_value && '' !== $default_value) {
				$items[$index][$media_key] = $default_item[$media_key];
			}
		}
	}

	return $items;
};

// =====================
// DEFAULT DATA
// =====================

// Hero defaults
$hero = isset($blocks_data['hero']) ? $blocks_data['hero'] : array();
$hero_pretitle_enabled = ! empty($hero['pretitle_enabled']);
$hero_pretitle = ! empty($hero['pretitle']) ? $hero['pretitle'] : '';
$hero_title = ! empty($hero['title']) ? $hero['title'] : 'City-to-City premium transfers';
$hero_subtitle = ! empty($hero['subtitle']) ? $hero['subtitle'] : 'for corporate and private clients who need reliable long-distance travel with full coordination.';
$hero_bg_mobile = ! empty($hero['background_mobile']) ? $hero['background_mobile'] : 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-of-city-375_result.webp';
$hero_bg_tablet = ! empty($hero['background_tablet']) ? $hero['background_tablet'] : 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-of-city-1024_result.webp';
$hero_bg_desktop = ! empty($hero['background_desktop']) ? $hero['background_desktop'] : 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-of-city-1920_result-scaled.webp';
$hero_cta_text = ! empty($hero['cta_text']) ? $hero['cta_text'] : 'Book a transfer';
$hero_cta_link = ! empty($hero['cta_link']) ? $hero['cta_link'] : '#';
$hero_features_enabled = ! isset($hero['features_enabled']) || (bool) $hero['features_enabled'];
$hero_icon_1 = file_get_contents(get_template_directory() . '/assets/icons/icon-1-l.svg');
$hero_icon_2 = file_get_contents(get_template_directory() . '/assets/icons/icon-2-l.svg');
$hero_icon_3 = file_get_contents(get_template_directory() . '/assets/icons/icon-3-l.svg');

// Service Intro defaults (under Hero, no background image / no blur)
$service_context = isset($blocks_data['service_context']) ? $blocks_data['service_context'] : array();

// Service Intro defaults (under Hero, no background image / no blur)
$service_intro = isset($blocks_data['service_intro']) ? $blocks_data['service_intro'] : array();
$has_service_intro_block = isset($blocks_data['service_intro']);
$service_intro_pill = ! empty($service_intro['pill_text']) ? $service_intro['pill_text'] : 'Preferences';
$service_intro_title = ! empty($service_intro['title']) ? $service_intro['title'] : 'A Better Way to Travel Between Cities';
$service_intro_description = ! empty($service_intro['description']) ? $service_intro['description'] : 'Airports, trains, rentals — they all take time, coordination, and patience. GTS offers a more refined way to move between cities: effortless, private, and precisely managed.';
$service_intro_button_text = ! empty($service_intro['button_text']) ? $service_intro['button_text'] : 'Book a transfer';
$service_intro_button_link = ! empty($service_intro['button_link']) ? $service_intro['button_link'] : '#';
$service_intro_items = ! empty($service_intro['items']) ? $service_intro['items'] : array();
$default_service_intro_items = array(
	array(
		'icon'        => $site_url . '/wp-content/uploads/2026/02/city-icon-1.svg',
		'title'       => 'Time is your real luxury',
		'description' => 'Skip queues and transfers — travel door-to-door, without waiting or interruptions.',
	),
	array(
		'icon'        => $site_url . '/wp-content/uploads/2026/02/city-icon-2.svg',
		'title'       => 'Confidence in every journey',
		'description' => 'No crowds, delays, or cancellations — just punctual, licensed chauffeurs and global coordination.',
	),
	array(
		'icon'        => $site_url . '/wp-content/uploads/2026/02/city-icon-3.svg',
		'title'       => 'Your schedule, your rules',
		'description' => 'Choose departure times and stops. Plans change? We adjust instantly, 24/7.',
	),
	array(
		'icon'        => $site_url . '/wp-content/uploads/2026/02/city-icon-4.svg',
		'title'       => 'Transparent, all-inclusive pricing',
		'description' => 'Pay per car, not per seat. Taxes, tolls, and waiting time are always included.',
	),
	array(
		'icon'        => $site_url . '/wp-content/uploads/2026/02/city-icon-5.svg',
		'title'       => 'Quiet comfort on every route',
		'description' => 'Relax in a premium car with a professional chauffeur, bottled water, and Wi-Fi on request.',
	),
	array(
		'icon'        => $site_url . '/wp-content/uploads/2026/02/city-icon-6.svg',
		'title'       => 'Flexible routes',
		'description' => 'Stop for meetings, meals, or sightseeing anytime.',
	),
);

if (empty($service_intro_items)) {
		$service_intro_items = $default_service_intro_items;
} else {
	$service_intro_items = $fill_missing_media($service_intro_items, $default_service_intro_items, array('icon'));
}

// Booking Form - unified block with desktop and mobile sections
$booking = isset($blocks_data['booking_form']) ? $blocks_data['booking_form'] : array();
$has_booking_block = isset($blocks_data['booking_form']);

// Desktop form settings
$desktop_form_enabled = isset($booking['desktop_enabled']) ? (bool)$booking['desktop_enabled'] : true;
$desktop_form_submit = ! empty($booking['desktop_submit_text']) ? $booking['desktop_submit_text'] : 'Get My Quote';
$desktop_form_checkbox1 = ! empty($booking['desktop_checkbox1_text']) ? $booking['desktop_checkbox1_text'] : 'Book a Jet';
$desktop_form_checkbox2 = ! empty($booking['desktop_checkbox2_text']) ? $booking['desktop_checkbox2_text'] : 'Book a Helicopter';
$desktop_form_stats_number = ! empty($booking['desktop_stats_number']) ? $booking['desktop_stats_number'] : '100+';
$desktop_form_stats_label = ! empty($booking['desktop_stats_label']) ? $booking['desktop_stats_label'] : 'countries';

// Mobile form settings
$mobile_form_enabled = isset($booking['mobile_enabled']) ? (bool)$booking['mobile_enabled'] : true;
$mobile_form_submit = ! empty($booking['mobile_submit_text']) ? $booking['mobile_submit_text'] : 'Get My Quote';
$mobile_form_checkbox1 = ! empty($booking['mobile_checkbox1_text']) ? $booking['mobile_checkbox1_text'] : 'Book a Jet';
$mobile_form_checkbox2 = ! empty($booking['mobile_checkbox2_text']) ? $booking['mobile_checkbox2_text'] : 'Book a Helicopter';
$mobile_form_stats_number = ! empty($booking['mobile_stats_number']) ? $booking['mobile_stats_number'] : '100+';
$mobile_form_stats_label = ! empty($booking['mobile_stats_label']) ? $booking['mobile_stats_label'] : 'countries';


// Why Us defaults
$why_us = isset($blocks_data['why_us']) ? $blocks_data['why_us'] : array();
$why_us_pill = ! empty($why_us['pill_text']) ? $why_us['pill_text'] : 'Why us?';
$default_why_us_intro_title = 'GTS Limousine Service was created for those who expect every moment to reflect precision and class.';
$default_why_us_intro_text = 'Every journey is coordinated by professionals who understand that timing, presentation, and reliability are not extras — they are essentials.';
$why_us_intro_title = ! empty($why_us['intro_title']) ? $why_us['intro_title'] : $default_why_us_intro_title;
$why_us_intro_text = ! empty($why_us['intro_text']) ? $why_us['intro_text'] : $default_why_us_intro_text;
$why_us_cards = ! empty($why_us['cards']) ? $why_us['cards'] : array();
$default_why_us_cards = array(
	array('card_type' => 'image', 'image' => $site_url . '/wp-content/uploads/2026/01/home-2-block-1-_result.webp', 'title' => 'Available worldwide', 'description' => 'Consistent excellence in executive<br>and luxury transfers — wherever<br>your journey takes you.'),
	array('card_type' => 'icon', 'icon' => $site_url . '/wp-content/uploads/2026/01/icon-block-2-1.svg', 'title' => 'World-class fleet', 'description' => 'Late-model business, premium and<br>VIP vehicles, perfectly maintained for<br>comfort, style and safety.'),
	array('card_type' => 'icon', 'icon' => $site_url . '/wp-content/uploads/2026/01/icon-block-2-2.svg', 'title' => 'Qualified chauffeurs', 'description' => 'Licensed, experienced and discreet<br>professionals trained to meet the<br>highest service standards.'),
	array('card_type' => 'icon', 'icon' => $site_url . '/wp-content/uploads/2026/01/icon-block-2-3.svg', 'title' => 'Security & discretion', 'description' => 'Strict safety protocols, discreet<br>coordination, and confidential service for<br>corporate & VIP clients.'),
	array('card_type' => 'icon', 'icon' => $site_url . '/wp-content/uploads/2026/01/icon-block-2-4.svg', 'title' => '24/7 Human Support', 'description' => 'Book directly on the website or through<br>your personal manager — 24/7 via<br>messenger, email or phone.'),
	array('card_type' => 'image', 'image' => $site_url . '/wp-content/uploads/2026/01/home-2-block-2_result.webp', 'title' => 'Seamless coordination', 'description' => 'We work directly with your planner or venue to<br>synchronise every detail — from arrivals to final<br>departures.'),
);

if (empty($why_us_cards)) {
	$why_us_cards = $default_why_us_cards;
} else {
	$why_us_cards = $fill_missing_media($why_us_cards, $default_why_us_cards, array('icon', 'image'));
}

// Page-specific Why Us presets for existing services.
// Admin values always have priority. Preset fills defaults and missing media only.
if ('hourly-hire' === $current_service_slug) {
	$hourly_intro_title = 'GTS Hourly Hire was designed for those who value control, comfort, and impeccable timing.';
	$hourly_intro_text = 'Every ride is managed by professionals who treat flexibility and precision not as a luxury — but as a standard.';
	$hourly_image_1 = $site_url . '/wp-content/uploads/2026/01/home-2-block-1-_result.webp';
	$hourly_image_6 = $site_url . '/wp-content/uploads/2026/01/home-2-block-2_result.webp';

	if ($why_us_intro_title === $default_why_us_intro_title || '' === trim((string) $why_us_intro_title)) {
		$why_us_intro_title = $hourly_intro_title;
	}
	if ($why_us_intro_text === $default_why_us_intro_text || '' === trim((string) $why_us_intro_text)) {
		$why_us_intro_text = $hourly_intro_text;
	}

	if (isset($why_us_cards[0]) && is_array($why_us_cards[0])) {
		$card_1_image = isset($why_us_cards[0]['image']) ? trim((string) $why_us_cards[0]['image']) : '';
		$card_1_icon = isset($why_us_cards[0]['icon']) ? trim((string) $why_us_cards[0]['icon']) : '';
		if ('' === $card_1_image && '' === $card_1_icon) {
			$why_us_cards[0]['card_type'] = 'image';
			$why_us_cards[0]['image'] = $hourly_image_1;
		}
	}

	if (isset($why_us_cards[5]) && is_array($why_us_cards[5])) {
		$card_6_image = isset($why_us_cards[5]['image']) ? trim((string) $why_us_cards[5]['image']) : '';
		$card_6_icon = isset($why_us_cards[5]['icon']) ? trim((string) $why_us_cards[5]['icon']) : '';
		if ('' === $card_6_image && '' === $card_6_icon) {
			$why_us_cards[5]['card_type'] = 'image';
			$why_us_cards[5]['image'] = $hourly_image_6;
		}
	}
}

// Occasions defaults
$occasions = isset($blocks_data['occasions']) ? $blocks_data['occasions'] : array();
$occasions_pill = ! empty($occasions['pill_text']) ? $occasions['pill_text'] : 'Full Service';
$occasions_title = ! empty($occasions['title']) ? $occasions['title'] : 'Perfect for Every Occasion';
$occasions_footer = ! empty($occasions['footer_text']) ? $occasions['footer_text'] : "Whether it's a business meeting, an exclusive event, or a long-distance journey – GTS Limousine Service adapts to your agenda with flawless precision and discretion.";

// How It Works defaults
$hiw = isset($blocks_data['how_it_works']) ? $blocks_data['how_it_works'] : array();
$hiw_pill = ! empty($hiw['pill_text']) ? $hiw['pill_text'] : 'How it works';
$hiw_title = ! empty($hiw['title']) ? $hiw['title'] : 'We handle the details —<br>you enjoy the moments';
$hiw_bg = ! empty($hiw['background']) ? $hiw['background'] : $site_url . '/wp-content/uploads/2026/01/home-3-block-banner_result-scaled.webp';
$hiw_steps = ! empty($hiw['steps']) ? $hiw['steps'] : array();
$default_hiw_steps = array(
	array('number' => '01', 'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-1.svg', 'title' => 'Book the way<br>you prefer', 'description' => 'Reserve instantly on our website or send a<br>request directly to our support team.'),
	array('number' => '02', 'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-2.svg', 'title' => 'Receive confirmation', 'description' => 'All details arrive by email — your itinerary, photo of the<br>car, driver info and contacts.'),
	array('number' => '03', 'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-3.svg', 'title' => 'Meet your driver', 'description' => 'A professional chauffeur arrives on time, helps<br>with luggage and ensures comfort.'),
	array('number' => '04', 'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-4.svg', 'title' => 'Travel with<br>confidence', 'description' => 'Transparent pricing, insured rides and real<br>24/7 assistance worldwide.'),
);

if (empty($hiw_steps)) {
	$hiw_steps = $default_hiw_steps;
} else {
	$hiw_steps = $fill_missing_media($hiw_steps, $default_hiw_steps, array('icon'));
}

// FAQ defaults
$faq = isset($blocks_data['faq']) ? $blocks_data['faq'] : array();
$faq_pill = ! empty($faq['pill_text']) ? $faq['pill_text'] : 'FAQ';
$faq_title = ! empty($faq['title']) ? $faq['title'] : 'Clear answers to help you book<br>with confidence';
$faq_items = ! empty($faq['items']) ? $faq['items'] : array();

// Bottom Text defaults (optional bottom block)
$bottom_text = isset($blocks_data['bottom_text']) ? $blocks_data['bottom_text'] : array();
$has_bottom_text_block = isset($blocks_data['bottom_text']);
$bottom_text_title = ! empty($bottom_text['title']) ? $bottom_text['title'] : '';
$bottom_text_description = ! empty($bottom_text['description']) ? $bottom_text['description'] : '';
$bottom_text_link_text = ! empty($bottom_text['link_text']) ? $bottom_text['link_text'] : 'Read more';
$bottom_text_link_url = ! empty($bottom_text['link_url']) ? $bottom_text['link_url'] : '#';

if (empty($faq_items)) {
	$faq_items = array(
		array('question' => 'Do you really operate worldwide?', 'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
		array('question' => 'How fast can I get a car?', 'answer' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.'),
		array('question' => 'Can I book a limousine for a few hours or for a full day?', 'answer' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.'),
		array('question' => 'Are your drivers professional?', 'answer' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.'),
		array('question' => 'Do you offer airport transfers with limousines?', 'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
		array('question' => 'How can I pay?', 'answer' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.'),
		array('question' => 'What if I need to cancel?', 'answer' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.'),
		array('question' => 'Can I book directly with a manager?', 'answer' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.'),
	);
}

$chevron_url = get_template_directory_uri() . '/assets/icons/chevron-down-faq.svg';
?>

<main id="primary" class="site-main">
	<?php if ('hourly-hire' === $current_service_slug) : ?>
		<style id="hourly-hire-why-us-gap">
			.why-us-block.why-us-block--hourly-hire-gap {
				padding-bottom: clamp(56px, 8vw, 120px);
			}
		</style>
		<style id="hourly-hire-fleet-lead-width">
			.fleet-slider-block.fleet-slider-block--hourly-hire .fleet-slider-title-row {
				flex-direction: row;
				align-items: center;
				justify-content: space-between;
			}

			.fleet-slider-block.fleet-slider-block--hourly-hire .fleet-slider-lead {
				max-width: 520px;
				width: 100%;
				margin-top: 8px;
			}
		</style>
	<?php endif; ?>

	<?php // ======================== HERO BLOCK ========================
	?>
	<?php if ($block_enabled['hero']) : ?>
		<style id="hero-limousine-service-bg">
			.hero-block {
				background-image: url('<?php echo esc_url($hero_bg_mobile); ?>') !important;
			}

			@media (min-width: 769px) {
				.hero-block {
					background-image: url('<?php echo esc_url($hero_bg_tablet); ?>') !important;
				}
			}

			@media (min-width: 1025px) {
				.hero-block {
					background-image: url('<?php echo esc_url($hero_bg_desktop); ?>') !important;
				}
			}
		</style>
		<section class="hero-block">
			<div class="hero-container">
				<div class="hero-left">
					<div class="hero-content<?php echo $hero_features_enabled ? '' : ' hero-content--no-features'; ?>">
						<?php if ( $hero_pretitle_enabled && ! empty( $hero_pretitle ) ) : ?>
							<p class="hero-subtitle"><?php echo esc_html( $hero_pretitle ); ?></p>
						<?php endif; ?>
						<h1 class="hero-title"><?php echo wp_kses_post($hero_title); ?></h1>
						<p class="hero-description"><?php echo wp_kses_post($hero_subtitle); ?></p>
						<div class="hero-buttons">
							<a href="<?php echo esc_url($hero_cta_link); ?>" class="btn btn-primary"><?php echo esc_html($hero_cta_text); ?></a>
						</div>
						<?php if ( $hero_features_enabled ) : ?>
							<div class="hero-features">
								<div class="hero-feature hero-feature-top-left">
									<div class="hero-feature-icon"><?php echo $hero_icon_1 ? wp_kses($hero_icon_1, gts_allowed_svg_hero()) : ''; ?></div>
									<p class="hero-feature-text">Available in 100+ countries</p>
								</div>
								<div class="hero-feature hero-feature-top-right"></div>
								<div class="hero-feature hero-feature-bottom-left">
									<div class="hero-feature-icon"><?php echo $hero_icon_2 ? wp_kses($hero_icon_2, gts_allowed_svg_hero()) : ''; ?></div>
									<p class="hero-feature-text">Operated by licensed chauffeurs<br>with 24/7 support</p>
								</div>
								<div class="hero-feature hero-feature-bottom-right">
									<div class="hero-feature-icon"><?php echo $hero_icon_3 ? wp_kses($hero_icon_3, gts_allowed_svg_hero()) : ''; ?></div>
									<p class="hero-feature-text">Licensed & insured, premium fleet</p>
								</div>
							</div>
							<div class="hero-features hero-features--mobile hero-features--mobile-in-hero">
								<div class="hero-feature hero-feature-top-left">
									<div class="hero-feature-icon"><?php echo $hero_icon_1 ? wp_kses($hero_icon_1, gts_allowed_svg_hero()) : ''; ?></div>
									<p class="hero-feature-text">Available in 100+ countries</p>
								</div>
								<div class="hero-feature hero-feature-top-right hero-feature-map">
									<div class="world-map-image"><img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/01/noun-world-17688-1_result.webp'); ?>" alt="World Map" width="100" height="100" loading="lazy"></div>
									<div class="world-map-text">
										<p class="world-map-label world-map-label-top">clients in</p>
										<div class="world-map-bottom">
											<p class="world-map-number"><?php echo esc_html($mobile_form_stats_number); ?></p>
											<p class="world-map-label world-map-label-bottom"><?php echo esc_html($mobile_form_stats_label); ?></p>
										</div>
									</div>
								</div>
								<div class="hero-feature hero-feature-bottom-left">
									<div class="hero-feature-icon"><?php echo $hero_icon_2 ? wp_kses($hero_icon_2, gts_allowed_svg_hero()) : ''; ?></div>
									<p class="hero-feature-text">Operated by licensed chauffeurs<br>with 24/7 support</p>
								</div>
								<div class="hero-feature hero-feature-bottom-right">
									<div class="hero-feature-icon"><?php echo $hero_icon_3 ? wp_kses($hero_icon_3, gts_allowed_svg_hero()) : ''; ?></div>
									<p class="hero-feature-text">Licensed & insured, premium fleet</p>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="hero-right hero-right--desktop">
					<?php if ($desktop_form_enabled): ?>
						<form class="booking-form" id="booking-form">
							<div class="form-row">
								<div class="form-group"><input type="text" id="full-name" name="full_name" placeholder="First and Last name *" required></div>
								<div class="form-group"><input type="tel" id="phone" name="phone" placeholder="Phone *" required></div>
							</div>
							<div class="form-row">
								<div class="form-group"><input type="email" id="email" name="email" placeholder="E-mail" required></div>
								<div class="form-group"><select id="service-type" name="service_type" required>
										<option value="">Select service type</option>
									</select></div>
							</div>
							<div class="form-checkboxes">
								<div class="form-group checkbox-group"><label><input type="checkbox" name="book_jet" value="jet" checked><span><?php echo esc_html($desktop_form_checkbox1); ?></span></label></div>
								<div class="form-group checkbox-group"><label><input type="checkbox" name="book_helicopter" value="helicopter"><span><?php echo esc_html($desktop_form_checkbox2); ?></span></label></div>
							</div>
							<div class="form-row form-row-after-checkboxes">
								<div class="form-group"><select id="vehicle" name="vehicle" required>
										<option value="">Select vehicle</option>
									</select></div>
								<div class="form-group"><select id="passengers" name="passengers" required>
										<option value="">Number of passengers</option>
									</select></div>
							</div>
							<div class="form-row">
								<div class="form-group form-group-datetime"><input type="datetime-local" id="pickup-time" name="pickup_time" required><span class="datetime-placeholder">Pick-up time</span></div>
								<div class="form-group form-group-with-add-stop">
									<input type="text" id="pickup-location" name="pickup_location" placeholder="Pick-up location" required>
									<a href="#" class="add-stop-link"><svg width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.5 0V9M0 4.5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
										</svg>Add Stop</a>
								</div>
							</div>
							<div class="form-row form-row-dropoff-notes">
								<div class="form-group"><input type="text" id="dropoff-location" name="dropoff_location" placeholder="Drop-off location" required></div>
								<div class="form-group"><textarea id="additional-notes" name="additional_notes" placeholder="Additional Notes" rows="1"></textarea></div>
							</div>
							<div class="form-group checkbox-group checkbox-consent">
								<label><input type="checkbox" name="email_consent" value="1" class="consent-checkbox" checked><span>I agree to receive email communication regarding my quote request.</span></label>
							</div>
							<button type="submit" class="booking-submit-btn"><?php echo esc_html($desktop_form_submit); ?></button>
						</form>
					<?php endif; ?>
					<div class="world-map-section">
						<div class="world-map-image"><img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/01/noun-world-17688-1_result.webp'); ?>" alt="World Map" loading="lazy" width="100" height="100"></div>
						<div class="world-map-divider"></div>
						<div class="world-map-text">
							<p class="world-map-label world-map-label-top">clients in</p>
							<div class="world-map-bottom">
								<p class="world-map-number"><?php echo esc_html($desktop_form_stats_number); ?></p>
								<p class="world-map-label world-map-label-bottom"><?php echo esc_html($desktop_form_stats_label); ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

		<?php // ======================== BOOKING FORM BLOCK (MOBILE) ========================
		?>
		<?php if ($has_booking_block && $block_enabled['booking_form'] && $mobile_form_enabled) : ?>
		<section class="booking-form-block booking-form-block--mobile">
				<div class="booking-form-container">
					<div class="booking-form-left"></div>
					<div class="booking-form-right">
						<?php if ($mobile_form_enabled): ?>
						<form class="booking-form" id="booking-form-mobile">
							<div class="form-row">
								<div class="form-group"><input type="text" id="full-name-m" name="full_name" placeholder="First and Last name *" required></div>
								<div class="form-group"><input type="tel" id="phone-m" name="phone" placeholder="Phone *" required></div>
							</div>
							<div class="form-row">
								<div class="form-group"><input type="email" id="email-m" name="email" placeholder="E-mail" required></div>
								<div class="form-group"><select id="service-type-m" name="service_type" required>
										<option value="">Select service type</option>
									</select></div>
							</div>
							<div class="form-checkboxes">
								<div class="form-group checkbox-group"><label><input type="checkbox" name="book_jet" value="jet" checked><span><?php echo esc_html($mobile_form_checkbox1); ?></span></label></div>
								<div class="form-group checkbox-group"><label><input type="checkbox" name="book_helicopter" value="helicopter"><span><?php echo esc_html($mobile_form_checkbox2); ?></span></label></div>
							</div>
							<div class="form-row form-row-after-checkboxes">
								<div class="form-group"><select id="vehicle-m" name="vehicle" required>
										<option value="">Select vehicle</option>
									</select></div>
								<div class="form-group"><select id="passengers-m" name="passengers" required>
										<option value="">Number of passengers</option>
									</select></div>
							</div>
							<div class="form-row">
								<div class="form-group form-group-datetime"><input type="datetime-local" id="pickup-time-m" name="pickup_time" required><span class="datetime-placeholder">Pick-up time</span></div>
								<div class="form-group form-group-with-add-stop">
									<input type="text" id="pickup-location-m" name="pickup_location" placeholder="Pick-up location" required>
									<a href="#" class="add-stop-link"><svg width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.5 0V9M0 4.5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
										</svg>Add Stop</a>
								</div>
							</div>
							<div class="form-row form-row-dropoff-notes">
								<div class="form-group"><input type="text" id="dropoff-location-m" name="dropoff_location" placeholder="Drop-off location" required></div>
								<div class="form-group"><textarea id="additional-notes-m" name="additional_notes" placeholder="Additional Notes" rows="1"></textarea></div>
							</div>
							<div class="form-group checkbox-group checkbox-consent">
								<label><input type="checkbox" name="email_consent" value="1" class="consent-checkbox" checked><span>I agree to receive email communication regarding my quote request.</span></label>
							</div>
							<button type="submit" class="booking-submit-btn"><?php echo esc_html($mobile_form_submit); ?></button>
						</form>
					<?php endif; ?>
				</div>
			</div>
			</section>
		<?php endif; ?>

		<?php if ($block_enabled['service_context']) : ?>
			<?php
			get_template_part(
				'template-parts/service/service-context',
				null,
				array(
					'block' => $service_context,
				)
			);
			?>
		<?php endif; ?>

		<?php // ======================== SERVICE INTRO BLOCK (UNDER HERO) ========================
		?>
	<?php if ($has_service_intro_block && $block_enabled['service_intro']) : ?>
		<section class="final-cta-block final-cta-block--service">
			<div class="final-cta-container final-cta-container--service">
				<div class="final-cta-left final-cta-left--service">
					<?php if ( ! empty( $service_intro_pill ) ) : ?>
						<div class="why-us-heading-pill final-cta-service-pill">
							<span class="why-us-heading-text"><?php echo esc_html( $service_intro_pill ); ?></span>
						</div>
					<?php endif; ?>
					<h2 class="final-cta-title"><?php echo wp_kses_post($service_intro_title); ?></h2>
					<p class="final-cta-description"><?php echo wp_kses_post($service_intro_description); ?></p>
					<a href="<?php echo esc_url($service_intro_button_link); ?>" class="btn btn-primary final-cta-button"><?php echo esc_html($service_intro_button_text); ?></a>
				</div>

				<div class="final-cta-right final-cta-right--desktop final-cta-right--service">
					<?php foreach ($service_intro_items as $intro_item) :
						$item_icon = ! empty($intro_item['icon']) ? $intro_item['icon'] : '';
						$item_title = ! empty($intro_item['title']) ? $intro_item['title'] : '';
						$item_description = ! empty($intro_item['description']) ? $intro_item['description'] : '';
					?>
						<div class="final-cta-item">
							<div class="final-cta-item-header">
								<?php if ($item_icon) : ?>
									<img src="<?php echo esc_url($item_icon); ?>" alt="<?php echo esc_attr($item_title); ?>" class="final-cta-icon" width="26" height="26" loading="lazy">
								<?php endif; ?>
								<h3 class="final-cta-item-title"><?php echo esc_html($item_title); ?></h3>
							</div>
							<p class="final-cta-item-description"><?php echo wp_kses_post($item_description); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ('hourly-hire' === $current_service_slug && $block_enabled['occasions']) : ?>
		<?php
		get_template_part(
			'template-parts/blocks/occasions',
			null,
			array(
				'block' => $occasions,
			)
		);
		?>
	<?php endif; ?>

	<?php // ======================== WHY US BLOCK ========================
	?>
	<?php if ($block_enabled['why_us'] && 'hourly-hire' !== $current_service_slug) : ?>
		<section class="why-us-block">
			<div class="why-us-container">
				<div class="why-us-heading">
					<div class="why-us-heading-pill">
						<span class="why-us-heading-text"><?php echo esc_html($why_us_pill); ?></span>
					</div>
					<div class="why-us-heading-line" aria-hidden="true"></div>
				</div>
				<div class="why-us-intro">
					<h2 class="why-us-intro-title"><?php echo esc_html($why_us_intro_title); ?></h2>
					<p class="why-us-intro-description"><?php echo esc_html($why_us_intro_text); ?></p>
				</div>
				<div class="why-us-grid">
					<?php $i = 1;
					foreach ($why_us_cards as $card) :
						$card_type = ! empty($card['card_type']) ? $card['card_type'] : 'icon';
						$image = ! empty($card['image']) ? $card['image'] : '';
						$icon = ! empty($card['icon']) ? $card['icon'] : '';
						$title = ! empty($card['title']) ? $card['title'] : '';
						$desc = ! empty($card['description']) ? $card['description'] : '';
					?>
						<?php if ('image' === $card_type && $image) : ?>
							<div class="why-us-item why-us-item-<?php echo $i; ?>" style="background-image: url('<?php echo esc_url($image); ?>');">
								<h3 class="why-us-item-title"><?php echo esc_html($title); ?></h3>
								<p class="why-us-item-description"><?php echo wp_kses_post($desc); ?></p>
							</div>
						<?php else : ?>
							<div class="why-us-item why-us-item-<?php echo $i; ?>">
								<?php if ($icon) : ?><div class="why-us-item-icon-wrapper"><img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title); ?>" class="why-us-item-icon" loading="lazy" width="48" height="48"></div><?php endif; ?>
								<h3 class="why-us-item-title"><?php echo esc_html($title); ?></h3>
								<p class="why-us-item-description"><?php echo wp_kses_post($desc); ?></p>
							</div>
						<?php endif; ?>
					<?php $i++;
					endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php // ======================== FLEET BLOCK ========================
	?>
	<?php if ($block_enabled['fleet']) : ?>
		<?php
		$fleet_slider_args = array();
		if ('hourly-hire' === $current_service_slug) {
			$fleet_slider_args['lead'] = 'That’s why every&nbsp;GTS limousine&nbsp;meets strict standards of<br>comfort, safety, and presentation.';
			$fleet_slider_args['section_modifier'] = 'fleet-slider-block--hourly-hire';
		}
		get_template_part('template-parts/blocks/fleet-slider', null, $fleet_slider_args);
		?>
	<?php endif; ?>

	<?php // ======================== OCCASIONS BLOCK ========================
	?>
	<?php if ($block_enabled['occasions'] && 'hourly-hire' !== $current_service_slug) : ?>
		<?php
		get_template_part(
			'template-parts/blocks/occasions',
			null,
			array(
				'block' => $occasions,
			)
		);
		?>
	<?php endif; ?>

	<?php // ======================== HOW IT WORKS BLOCK ========================
	?>
	<?php if ($block_enabled['how_it_works']) : ?>
		<section class="how-it-works-block" style="background-image: url('<?php echo esc_url($hiw_bg); ?>');">
			<div class="how-it-works-container">
				<div class="how-it-works-left">
					<div class="how-it-works-pill"><span class="how-it-works-pill-text"><?php echo esc_html($hiw_pill); ?></span></div>
					<h2 class="how-it-works-title"><?php echo wp_kses_post($hiw_title); ?></h2>
				</div>
				<div class="how-it-works-right">
					<div class="how-it-works-steps">
						<?php foreach ($hiw_steps as $step) :
							$num = ! empty($step['number']) ? $step['number'] : '';
							$icon = ! empty($step['icon']) ? $step['icon'] : '';
							$title = ! empty($step['title']) ? $step['title'] : '';
							$desc = ! empty($step['description']) ? $step['description'] : '';
						?>
							<div class="how-it-works-step">
								<div class="how-it-works-step-header">
									<h3 class="how-it-works-step-title"><?php echo wp_kses_post($title); ?></h3>
									<div class="how-it-works-step-badge">
										<span class="how-it-works-step-number"><?php echo esc_html($num); ?></span>
										<span class="how-it-works-step-icon"><img src="<?php echo esc_url($icon); ?>" alt="" aria-hidden="true" loading="lazy" width="24" height="24"></span>
									</div>
								</div>
								<p class="how-it-works-step-description"><?php echo wp_kses_post($desc); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ($block_enabled['why_us'] && 'hourly-hire' === $current_service_slug) : ?>
		<section class="why-us-block why-us-block--hourly-hire-gap">
			<div class="why-us-container">
				<div class="why-us-heading">
					<div class="why-us-heading-pill">
						<span class="why-us-heading-text"><?php echo esc_html($why_us_pill); ?></span>
					</div>
					<div class="why-us-heading-line" aria-hidden="true"></div>
				</div>
				<div class="why-us-intro">
					<h2 class="why-us-intro-title"><?php echo esc_html($why_us_intro_title); ?></h2>
					<p class="why-us-intro-description"><?php echo esc_html($why_us_intro_text); ?></p>
				</div>
				<div class="why-us-grid">
					<?php $i = 1;
					foreach ($why_us_cards as $card) :
						$card_type = ! empty($card['card_type']) ? $card['card_type'] : 'icon';
						$image = ! empty($card['image']) ? $card['image'] : '';
						$icon = ! empty($card['icon']) ? $card['icon'] : '';
						$title = ! empty($card['title']) ? $card['title'] : '';
						$desc = ! empty($card['description']) ? $card['description'] : '';
					?>
						<?php if ('image' === $card_type && $image) : ?>
							<div class="why-us-item why-us-item-<?php echo $i; ?>" style="background-image: url('<?php echo esc_url($image); ?>');">
								<h3 class="why-us-item-title"><?php echo esc_html($title); ?></h3>
								<p class="why-us-item-description"><?php echo wp_kses_post($desc); ?></p>
							</div>
						<?php else : ?>
							<div class="why-us-item why-us-item-<?php echo $i; ?>">
								<?php if ($icon) : ?><div class="why-us-item-icon-wrapper"><img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title); ?>" class="why-us-item-icon" loading="lazy" width="48" height="48"></div><?php endif; ?>
								<h3 class="why-us-item-title"><?php echo esc_html($title); ?></h3>
								<p class="why-us-item-description"><?php echo wp_kses_post($desc); ?></p>
							</div>
						<?php endif; ?>
					<?php $i++;
					endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<div class="white-sections-wrapper">
		<?php get_template_part('template-parts/blocks/trusted-by'); ?>

		<?php // ======================== FAQ BLOCK ========================
		?>
		<?php if ($block_enabled['faq']) : ?>
			<?php
			$half = ceil(count($faq_items) / 2);
			$faq_col1 = array_slice($faq_items, 0, $half);
			$faq_col2 = array_slice($faq_items, $half);
			?>
			<section class="faq-block">
				<div class="faq-container">
					<div class="faq-pill"><span class="faq-pill-text"><?php echo esc_html($faq_pill); ?></span></div>
					<h2 class="faq-title"><?php echo wp_kses_post($faq_title); ?></h2>
					<div class="faq-accordions">
						<div class="faq-accordion-col">
							<?php foreach ($faq_col1 as $idx => $item) : $id = 'faq-content-1-' . $idx; ?>
								<div class="faq-item" data-faq-item>
									<button type="button" class="faq-item__summary" aria-expanded="false" aria-controls="<?php echo esc_attr($id); ?>">
										<span class="faq-item__question"><?php echo esc_html($item['question']); ?></span>
										<img src="<?php echo esc_url($chevron_url); ?>" alt="" class="faq-item__icon" width="20" height="20" aria-hidden="true">
									</button>
									<div class="faq-item__content-wrapper" id="<?php echo esc_attr($id); ?>">
										<div class="faq-item__content">
											<p><?php echo esc_html($item['answer']); ?></p>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="faq-accordion-col">
							<?php foreach ($faq_col2 as $idx => $item) : $id = 'faq-content-2-' . $idx; ?>
								<div class="faq-item" data-faq-item>
									<button type="button" class="faq-item__summary" aria-expanded="false" aria-controls="<?php echo esc_attr($id); ?>">
										<span class="faq-item__question"><?php echo esc_html($item['question']); ?></span>
										<img src="<?php echo esc_url($chevron_url); ?>" alt="" class="faq-item__icon" width="20" height="20" aria-hidden="true">
									</button>
									<div class="faq-item__content-wrapper" id="<?php echo esc_attr($id); ?>">
										<div class="faq-item__content">
											<p><?php echo esc_html($item['answer']); ?></p>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php get_template_part('template-parts/blocks/custom-itinerary', 'limousine'); ?>
		<?php get_template_part('template-parts/blocks/services', 'limousine'); ?>
	</div>

	<?php if ($has_bottom_text_block && $block_enabled['bottom_text']) : ?>
		<section class="service-bottom-text">
			<div class="service-bottom-text__container">
				<?php if ( ! empty( $bottom_text_title ) ) : ?>
					<p class="service-bottom-text__title"><?php echo esc_html( $bottom_text_title ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $bottom_text_description ) ) : ?>
					<p class="service-bottom-text__description"><?php echo esc_html( $bottom_text_description ); ?></p>
				<?php endif; ?>

				<a class="service-bottom-text__link" href="<?php echo esc_url( $bottom_text_link_url ); ?>">
					<?php echo esc_html( $bottom_text_link_text ); ?>
				</a>
			</div>
		</section>
	<?php endif; ?>

</main>

<?php get_footer(); ?>
