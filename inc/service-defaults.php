<?php

/**
 * Service Defaults - Auto-populate block structure on new service creation
 *
 * @package GTS
 */

if (! defined('ABSPATH')) {
	exit;
}

/**
 * Get default block structure for new services
 *
 * This structure mirrors the City-to-City service layout.
 * Content is left empty/placeholder for the user to fill in.
 *
 * @return array Default service_blocks structure
 */
function gts_get_default_service_blocks()
{
	return array(
		// Block 1: Hero Section
		array(
			'acf_fc_layout'      => 'hero',
			'enabled'            => true,
			'title'              => 'City-to-City premium transfers',
			'subtitle'           => 'for corporate and private clients who need reliable long-distance travel with full coordination.',
			'background_mobile'  => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-of-city-375_result.webp',
			'background_tablet'  => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-of-city-1024_result.webp',
			'background_desktop' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-of-city-1920_result-scaled.webp',
			'cta_text'           => 'Book a transfer',
			'cta_link'           => '',
			'features'           => array(
				array(
					'icon' => '',
					'text' => 'Available in 100+ countries',
				),
				array(
					'icon' => '',
					'text' => 'Operated by licensed chauffeurs with 24/7 support',
				),
				array(
					'icon' => '',
					'text' => 'Licensed & insured, premium fleet',
				),
			),
			'stats_number'       => '100+',
			'stats_label'        => 'countries',
		),

		// Block 2: Service Intro Panel (under Hero)
		array(
			'acf_fc_layout' => 'service_intro',
			'enabled'       => true,
			'pill_text'     => 'Preferences',
			'title'         => 'A Better Way to Travel Between Cities',
			'description'   => 'Airports, trains, rentals — they all take time, coordination, and patience. GTS offers a more refined way to move between cities: effortless, private, and precisely managed.',
			'button_text'   => 'Book a transfer',
			'button_link'   => '',
			'items'         => array(
				array(
					'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-icon-1.svg',
					'title'       => 'Time is your real luxury',
					'description' => 'Skip queues and transfers — travel door-to-door, without waiting or interruptions.',
				),
				array(
					'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-icon-2.svg',
					'title'       => 'Confidence in every journey',
					'description' => 'No crowds, delays, or cancellations — just punctual, licensed chauffeurs and global coordination.',
				),
				array(
					'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-icon-3.svg',
					'title'       => 'Your schedule, your rules',
					'description' => 'Choose departure times and stops. Plans change? We adjust instantly, 24/7.',
				),
				array(
					'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-icon-4.svg',
					'title'       => 'Transparent, all-inclusive pricing',
					'description' => 'Pay per car, not per seat. Taxes, tolls, and waiting time are always included.',
				),
				array(
					'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-icon-5.svg',
					'title'       => 'Quiet comfort on every route',
					'description' => 'Relax in a premium car with a professional chauffeur, bottled water, and Wi-Fi on request.',
				),
				array(
					'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-icon-6.svg',
					'title'       => 'Flexible routes',
					'description' => 'Stop for meetings, meals, or sightseeing anytime.',
				),
			),
		),

		// Block 3: Booking Form
		array(
			'acf_fc_layout' => 'booking_form',
			'enabled'       => true,
			'form_type'     => 'default',
			'form_shortcode' => '',
		),

		// Block 4: Why Us Section
		array(
			'acf_fc_layout' => 'why_us',
			'enabled'       => true,
			'pill_text'     => 'Why us?',
			'cards'         => array(
				array(
					'card_type'   => 'image',
					'image'       => '',
					'icon'        => '',
					'title'       => 'Available worldwide',
					'description' => 'Consistent excellence in executive and luxury transfers — wherever your journey takes you.',
				),
				array(
					'card_type'   => 'icon',
					'image'       => '',
					'icon'        => '',
					'title'       => 'World-class fleet',
					'description' => 'Late-model business, premium and VIP vehicles, perfectly maintained for comfort, style and safety.',
				),
				array(
					'card_type'   => 'icon',
					'image'       => '',
					'icon'        => '',
					'title'       => 'Qualified chauffeurs',
					'description' => 'Licensed, experienced and discreet professionals trained to meet the highest service standards.',
				),
				array(
					'card_type'   => 'icon',
					'image'       => '',
					'icon'        => '',
					'title'       => 'Security & discretion',
					'description' => 'Strict safety protocols, discreet coordination, and confidential service for corporate & VIP clients.',
				),
				array(
					'card_type'   => 'icon',
					'image'       => '',
					'icon'        => '',
					'title'       => '24/7 Human Support',
					'description' => 'Book directly on the website or through your personal manager — 24/7 via messenger, email or phone.',
				),
				array(
					'card_type'   => 'image',
					'image'       => '',
					'icon'        => '',
					'title'       => 'Seamless coordination',
					'description' => 'We work directly with your planner or venue to synchronise every detail — from arrivals to final departures.',
				),
			),
		),

		// Block 5: Fleet Slider
		array(
			'acf_fc_layout' => 'fleet',
			'enabled'       => true,
			'pill_text'     => 'Fleet & Chauffeurs',
			'title'         => 'Every detail matters – from the car you travel in to the person behind the wheel',
			'subtitle'      => 'That\'s why every GTS limousine meets strict standards of comfort, safety, and presentation.',
			'vehicles'      => array(), // Empty = show all vehicles
		),

		// Block 6: Occasions Section
		array(
			'acf_fc_layout' => 'occasions',
			'enabled'       => true,
			'pill_text'     => 'Full Service',
			'title'         => 'Perfect for Every Occasion',
			'cards'         => array(
				array(
					'card_type'   => 'icon',
					'image'       => '',
					'icon'        => '',
					'title'       => 'Executive Travel',
					'description' => 'ensure a seamless experience for board members, CEOs, or international guests.',
				),
				array(
					'card_type'   => 'icon',
					'image'       => '',
					'icon'        => '',
					'title'       => 'Airport Limousine Service',
					'description' => 'punctual, monitored, and stress-free – from arrival gate to final destination.',
				),
				array(
					'card_type'   => 'image',
					'image'       => '',
					'icon'        => '',
					'title'       => '',
					'description' => '',
				),
				array(
					'card_type'   => 'icon',
					'image'       => '',
					'icon'        => '',
					'title'       => 'Multi-Day Itineraries',
					'description' => 'extended or multi-city travel managed with real-time coordination and dedicated support.',
				),
				array(
					'card_type'   => 'icon',
					'image'       => '',
					'icon'        => '',
					'title'       => 'Private Occasions',
					'description' => 'weddings, galas, proms, birthday and personal celebrations with impeccable service.',
				),
				array(
					'card_type'   => 'image',
					'image'       => '',
					'icon'        => '',
					'title'       => '',
					'description' => '',
				),
				array(
					'card_type'   => 'icon',
					'image'       => '',
					'icon'        => '',
					'title'       => 'Events & Conferences',
					'description' => 'coordinated logistics for delegations, summits, and VIP gatherings.',
				),
			),
			'footer_text'   => 'Whether it\'s a business meeting, an exclusive event, or a long-distance journey – GTS Limousine Service adapts to your agenda with flawless precision and discretion.',
		),

		// Block 7: How It Works
		array(
			'acf_fc_layout' => 'how_it_works',
			'enabled'       => true,
			'pill_text'     => 'How it works',
			'title'         => 'We handle the details — you enjoy the moments',
			'background'    => '',
			'steps'         => array(
				array(
					'number'      => '01',
					'icon'        => '',
					'title'       => 'Book the way you prefer',
					'description' => 'Reserve instantly on our website or send a request directly to our support team.',
				),
				array(
					'number'      => '02',
					'icon'        => '',
					'title'       => 'Receive confirmation',
					'description' => 'All details arrive by email — your itinerary, photo of the car, driver info and contacts.',
				),
				array(
					'number'      => '03',
					'icon'        => '',
					'title'       => 'Meet your driver',
					'description' => 'A professional chauffeur arrives on time, helps with luggage and ensures comfort.',
				),
				array(
					'number'      => '04',
					'icon'        => '',
					'title'       => 'Travel with confidence',
					'description' => 'Transparent pricing, insured rides and real 24/7 assistance worldwide.',
				),
			),
		),

		// Block 8: Testimonials
		array(
			'acf_fc_layout' => 'testimonials',
			'enabled'       => true,
			'pill_text'     => 'Trusted by clients worldwide',
			'title'         => 'Corporations, executives and private travellers rely on GTS for punctuality, comfort and flawless service.',
			'testimonials'  => array(
				array(
					'text'          => '',
					'author_name'   => '',
					'author_avatar' => '',
					'rating'        => 5,
				),
			),
		),

		// Block 9: FAQ
		array(
			'acf_fc_layout' => 'faq',
			'enabled'       => true,
			'pill_text'     => 'FAQ',
			'title'         => 'Clear answers to help you book with confidence',
			'items'         => array(
				array(
					'question' => 'Do you really operate worldwide?',
					'answer'   => '',
				),
				array(
					'question' => 'How fast can I get a car?',
					'answer'   => '',
				),
				array(
					'question' => 'Can I book a limousine for a few hours or for a full day?',
					'answer'   => '',
				),
				array(
					'question' => 'Are your drivers professional?',
					'answer'   => '',
				),
			),
		),

		// Block 10: CTA Section
		array(
			'acf_fc_layout'      => 'cta',
			'enabled'            => true,
			'title'              => 'Ready to Travel with GTS?',
			'description'        => 'Our team is available 24/7 to organize your limousine or executive transfer anywhere in the world.',
			'button_text'        => 'Book Now',
			'button_link'        => '',
			'show_contact_icons' => true,
		),

		// Block 11: Related Services
		array(
			'acf_fc_layout' => 'related_services',
			'enabled'       => true,
			'pill_text'     => 'Every journey, perfectly organized.',
			'title'         => 'From executive roadshows to private celebrations — GTS provides end-to-end transport solutions worldwide.',
			'services'      => array(
				array(
					'title'       => 'Book a Flight',
					'description' => 'Private aviation coordination with trusted partners worldwide. Helicopters, charter jets, or business flights – synchronized with ground transport for smooth connections.',
					'image'       => '',
					'link'        => '',
				),
				array(
					'title'       => 'City-to-City Rides',
					'description' => 'Comfortable long-distance rides across borders and regions. Luxury vehicles, experienced chauffeurs, flexible stops – your itinerary, our responsibility.',
					'image'       => '',
					'link'        => '',
				),
			),
		),

		// Block 12: Bottom Text Section
		array(
			'acf_fc_layout' => 'bottom_text',
			'enabled'       => false,
			'title'         => '',
			'description'   => '',
			'link_text'     => 'Read more',
			'link_url'      => '',
		),
	);
}

/**
 * Auto-populate service_blocks when a new service is created
 *
 * @param int     $post_id Post ID.
 * @param WP_Post $post    Post object.
 * @param bool    $update  Whether this is an existing post being updated.
 */
function gts_auto_populate_service_blocks($post_id, $post, $update)
{
	// Only proceed for new posts, not updates
	if ($update) {
		return;
	}

	// Bail if ACF is not active
	if (! function_exists('get_field') || ! function_exists('update_field')) {
		return;
	}

	// Check if service_blocks is already set
	$existing_blocks = get_field('service_blocks', $post_id);
	if (! empty($existing_blocks)) {
		return;
	}

	// Get default blocks and save them
	$default_blocks = gts_get_default_service_blocks();
	update_field('service_blocks', $default_blocks, $post_id);
}
add_action('save_post_service', 'gts_auto_populate_service_blocks', 10, 3);

/**
 * Alternative hook for wp_insert_post to catch auto-drafts becoming drafts
 *
 * @param int     $post_id Post ID.
 * @param WP_Post $post    Post object.
 * @param bool    $update  Whether this is an update.
 */
function gts_populate_service_on_status_change($post_id, $post, $update)
{
	// Only for services
	if ('service' !== $post->post_type) {
		return;
	}

	// Skip autosaves and revisions
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if (wp_is_post_revision($post_id)) {
		return;
	}

	// Bail if ACF is not active
	if (! function_exists('get_field') || ! function_exists('update_field')) {
		return;
	}

	// Check if service_blocks is already set
	$existing_blocks = get_field('service_blocks', $post_id);
	if (! empty($existing_blocks)) {
		return;
	}

	// Get default blocks and save them
	$default_blocks = gts_get_default_service_blocks();
	update_field('service_blocks', $default_blocks, $post_id);
}
add_action('wp_insert_post', 'gts_populate_service_on_status_change', 20, 3);

/**
 * Admin notice if ACF Pro is not active
 */
function gts_acf_required_notice()
{
	$screen = get_current_screen();
	if (! $screen || 'service' !== $screen->post_type) {
		return;
	}

	if (! function_exists('acf_add_local_field_group')) {
?>
		<div class="notice notice-error">
			<p>
				<strong><?php esc_html_e('ACF Pro Required', 'gts-theme'); ?></strong>:
				<?php esc_html_e('The Service page system requires Advanced Custom Fields Pro plugin to work properly. Please install and activate ACF Pro.', 'gts-theme'); ?>
			</p>
		</div>
<?php
	}
}
add_action('admin_notices', 'gts_acf_required_notice');
