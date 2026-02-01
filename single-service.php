<?php

/**
 * Template for displaying single Service posts
 *
 * Uses exact same HTML structure as page-limousine-service.php
 * but reads content from ACF fields for editability.
 * Each block can be enabled/disabled via ACF toggle.
 *
 * @package GTS
 */

get_header();

// Get ACF blocks for this service
$blocks_data = array();
$block_enabled = array(
	'hero' => true,
	'booking_form' => true,
	'why_us' => true,
	'fleet' => true,
	'occasions' => true,
	'how_it_works' => true,
	'testimonials' => true,
	'faq' => true,
	'cta' => true,
	'related_services' => true,
);

if (function_exists('get_field')) {
	$blocks = get_field('service_blocks');
	if ($blocks && is_array($blocks)) {
		foreach ($blocks as $block) {
			$layout = isset($block['acf_fc_layout']) ? $block['acf_fc_layout'] : '';
			if ($layout) {
				$blocks_data[$layout] = $block;
				// Check enabled status
				$block_enabled[$layout] = isset($block['enabled']) ? (bool)$block['enabled'] : true;
			}
		}
	}
}

// Site URL for fallback images
$site_url = get_site_url();

// =====================
// HERO BLOCK DATA
// =====================
$hero = isset($blocks_data['hero']) ? $blocks_data['hero'] : array();
$hero_title = ! empty($hero['title']) ? $hero['title'] : 'Chauffeur-driven<br>luxury limousine service';
$hero_subtitle = ! empty($hero['subtitle']) ? $hero['subtitle'] : 'for business leaders and private clients who expect<br>comfort, style, and flawless coordination.';
$hero_bg_mobile = ! empty($hero['background_mobile']) ? $hero['background_mobile'] : $site_url . '/wp-content/uploads/2026/01/375-lm-1_result.webp';
$hero_bg_tablet = ! empty($hero['background_tablet']) ? $hero['background_tablet'] : $site_url . '/wp-content/uploads/2026/01/1024-lm-1_result.webp';
$hero_bg_desktop = ! empty($hero['background_desktop']) ? $hero['background_desktop'] : $site_url . '/wp-content/uploads/2026/01/1920-lm-1_result-scaled.webp';
$hero_cta_text = ! empty($hero['cta_text']) ? $hero['cta_text'] : 'Book a transfer';
$hero_cta_link = ! empty($hero['cta_link']) ? $hero['cta_link'] : '#';

// Hero icons
$hero_icon_1 = file_get_contents(get_template_directory() . '/assets/icons/icon-1-l.svg');
$hero_icon_2 = file_get_contents(get_template_directory() . '/assets/icons/icon-2-l.svg');
$hero_icon_3 = file_get_contents(get_template_directory() . '/assets/icons/icon-3-l.svg');
?>

<main id="primary" class="site-main">

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
					<div class="hero-content">
						<h1 class="hero-title"><?php echo wp_kses_post($hero_title); ?></h1>
						<p class="hero-description"><?php echo wp_kses_post($hero_subtitle); ?></p>
						<div class="hero-buttons">
							<a href="<?php echo esc_url($hero_cta_link); ?>" class="btn btn-primary"><?php echo esc_html($hero_cta_text); ?></a>
						</div>
						<div class="hero-features">
							<div class="hero-feature hero-feature-top-left">
								<div class="hero-feature-icon" role="img" aria-label="<?php echo esc_attr(__('Available in 100+ countries', 'gts-theme')); ?>">
									<?php echo $hero_icon_1 ? wp_kses($hero_icon_1, gts_allowed_svg_hero()) : ''; ?>
								</div>
								<p class="hero-feature-text">Available in 100+ countries</p>
							</div>
							<div class="hero-feature hero-feature-top-right"></div>
							<div class="hero-feature hero-feature-bottom-left">
								<div class="hero-feature-icon" role="img" aria-label="<?php echo esc_attr(__('Operated by licensed chauffeurs', 'gts-theme')); ?>">
									<?php echo $hero_icon_2 ? wp_kses($hero_icon_2, gts_allowed_svg_hero()) : ''; ?>
								</div>
								<p class="hero-feature-text">Operated by licensed chauffeurs<br>with 24/7 support</p>
							</div>
							<div class="hero-feature hero-feature-bottom-right">
								<div class="hero-feature-icon" role="img" aria-label="<?php echo esc_attr(__('Licensed & insured, premium fleet', 'gts-theme')); ?>">
									<?php echo $hero_icon_3 ? wp_kses($hero_icon_3, gts_allowed_svg_hero()) : ''; ?>
								</div>
								<p class="hero-feature-text">Licensed & insured, premium fleet</p>
							</div>
						</div>
					</div>
				</div>
				<div class="hero-right hero-right--desktop">
					<form class="booking-form" id="booking-form">
						<div class="form-row">
							<div class="form-group">
								<input type="text" id="full-name" name="full_name" placeholder="First and Last name" required>
							</div>
							<div class="form-group">
								<input type="tel" id="phone" name="phone" placeholder="Phone" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group">
								<input type="email" id="email" name="email" placeholder="E-mail" required>
							</div>
							<div class="form-group">
								<select id="service-type" name="service_type" required>
									<option value="">Select service type</option>
								</select>
							</div>
						</div>
						<div class="form-checkboxes">
							<div class="form-group checkbox-group">
								<label><input type="checkbox" name="book_jet" value="jet" checked><span>Book a Jet</span></label>
							</div>
							<div class="form-group checkbox-group">
								<label><input type="checkbox" name="book_helicopter" value="helicopter"><span>Book a Helicopter</span></label>
							</div>
						</div>
						<div class="form-row form-row-after-checkboxes">
							<div class="form-group">
								<select id="vehicle" name="vehicle" required>
									<option value="">Select vehicle</option>
								</select>
							</div>
							<div class="form-group">
								<select id="passengers" name="passengers" required>
									<option value="">Number of passengers</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group form-group-datetime">
								<input type="datetime-local" id="pickup-time" name="pickup_time" placeholder="Pick-up time" required>
								<span class="datetime-placeholder">Pick-up time</span>
							</div>
							<div class="form-group">
								<input type="text" id="destination" name="destination" placeholder="Destination" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group">
								<textarea id="comments" name="comments" placeholder="Comments" rows="3"></textarea>
							</div>
						</div>
						<button type="submit" class="booking-submit-btn">Get My Quote</button>
					</form>
					<div class="world-map-section">
						<div class="world-map-image">
							<img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/01/noun-world-17688-1_result.webp'); ?>" alt="World Map" loading="lazy" width="100" height="100">
						</div>
						<div class="world-map-divider"></div>
						<div class="world-map-text">
							<p class="world-map-label world-map-label-top">clients in</p>
							<div class="world-map-bottom">
								<p class="world-map-number">100+</p>
								<p class="world-map-label world-map-label-bottom">countries</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ($block_enabled['booking_form']) : ?>
		<?php get_template_part('template-parts/blocks/booking-form-limousine-service'); ?>
	<?php endif; ?>

	<?php if ($block_enabled['why_us']) : ?>
		<?php get_template_part('template-parts/blocks/why-us'); ?>
	<?php endif; ?>

	<?php if ($block_enabled['fleet']) : ?>
		<?php get_template_part('template-parts/blocks/fleet-slider'); ?>
	<?php endif; ?>

	<?php if ($block_enabled['occasions']) : ?>
		<?php get_template_part('template-parts/blocks/occasions'); ?>
	<?php endif; ?>

	<?php if ($block_enabled['how_it_works']) : ?>
		<?php get_template_part('template-parts/blocks/how-it-works'); ?>
	<?php endif; ?>

	<div class="white-sections-wrapper">
		<?php get_template_part('template-parts/blocks/trusted-by'); ?>

		<?php if ($block_enabled['faq']) : ?>
			<?php get_template_part('template-parts/blocks/faq'); ?>
		<?php endif; ?>

		<?php get_template_part('template-parts/blocks/custom-itinerary', 'limousine'); ?>
		<?php get_template_part('template-parts/blocks/services', 'limousine'); ?>
	</div>

</main><!-- #primary -->

<?php
get_footer();
