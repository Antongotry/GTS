<?php

/**
 * Template for displaying single Service posts
 *
 * Uses exact same HTML structure as page-limousine-service.php
 * but reads content from ACF fields for editability.
 *
 * @package GTS
 */

get_header();

// Get ACF fields for this service
$hero_title = '';
$hero_subtitle = '';
$hero_bg_mobile = '';
$hero_bg_tablet = '';
$hero_bg_desktop = '';

if (function_exists('get_field')) {
	$blocks = get_field('service_blocks');
	if ($blocks && is_array($blocks)) {
		foreach ($blocks as $block) {
			$layout = isset($block['acf_fc_layout']) ? $block['acf_fc_layout'] : '';

			if ('hero' === $layout) {
				$hero_title = ! empty($block['title']) ? $block['title'] : '';
				$hero_subtitle = ! empty($block['subtitle']) ? $block['subtitle'] : '';
				$hero_bg_mobile = ! empty($block['background_mobile']) ? $block['background_mobile'] : '';
				$hero_bg_tablet = ! empty($block['background_tablet']) ? $block['background_tablet'] : '';
				$hero_bg_desktop = ! empty($block['background_desktop']) ? $block['background_desktop'] : '';
			}
		}
	}
}

// Fallback to original content
if (empty($hero_title)) {
	$hero_title = 'Chauffeur-driven<br>luxury limousine service';
}
if (empty($hero_subtitle)) {
	$hero_subtitle = 'for business leaders and private clients who expect<br>comfort, style, and flawless coordination.';
}

// Fallback images
$site_url = get_site_url();
if (empty($hero_bg_mobile)) {
	$hero_bg_mobile = $site_url . '/wp-content/uploads/2026/01/375-lm-1_result.webp';
}
if (empty($hero_bg_tablet)) {
	$hero_bg_tablet = $site_url . '/wp-content/uploads/2026/01/1024-lm-1_result.webp';
}
if (empty($hero_bg_desktop)) {
	$hero_bg_desktop = $site_url . '/wp-content/uploads/2026/01/1920-lm-1_result-scaled.webp';
}

// Hero icons
$hero_icon_1 = file_get_contents(get_template_directory() . '/assets/icons/icon-1-l.svg');
$hero_icon_2 = file_get_contents(get_template_directory() . '/assets/icons/icon-2-l.svg');
$hero_icon_3 = file_get_contents(get_template_directory() . '/assets/icons/icon-3-l.svg');
?>

<main id="primary" class="site-main">

	<style id="hero-limousine-service-bg">
		/* Hero responsive backgrounds for Service page - optimized for LCP */
		/* Mobile: 375px */
		.hero-block {
			background-image: url('<?php echo esc_url($hero_bg_mobile); ?>') !important;
		}

		/* Tablet: 1024px */
		@media (min-width: 769px) {
			.hero-block {
				background-image: url('<?php echo esc_url($hero_bg_tablet); ?>') !important;
			}
		}

		/* Desktop: 1440px and 1920px - same image */
		@media (min-width: 1025px) {
			.hero-block {
				background-image: url('<?php echo esc_url($hero_bg_desktop); ?>') !important;
			}
		}
	</style>

	<section class="hero-block">
		<div class="hero-container">
			<!-- Left side -->
			<div class="hero-left">
				<div class="hero-content">
					<h1 class="hero-title"><?php echo wp_kses_post($hero_title); ?></h1>

					<p class="hero-description"><?php echo wp_kses_post($hero_subtitle); ?></p>

					<div class="hero-buttons">
						<a href="#" class="btn btn-primary">Book a transfer</a>
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

			<!-- Right side with form -->
			<div class="hero-right hero-right--desktop">
				<form class="booking-form" id="booking-form">
					<!-- Row 1: First and Last name и Phone -->
					<div class="form-row">
						<div class="form-group">
							<input type="text" id="full-name" name="full_name" placeholder="First and Last name" required>
						</div>
						<div class="form-group">
							<input type="tel" id="phone" name="phone" placeholder="Phone" required>
						</div>
					</div>

					<!-- Row 2: E-mail и Select service type -->
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

					<!-- Checkboxes: Book a Jet и Book a Helicopter -->
					<div class="form-checkboxes">
						<div class="form-group checkbox-group">
							<label>
								<input type="checkbox" name="book_jet" value="jet" checked>
								<span>Book a Jet</span>
							</label>
						</div>
						<div class="form-group checkbox-group">
							<label>
								<input type="checkbox" name="book_helicopter" value="helicopter">
								<span>Book a Helicopter</span>
							</label>
						</div>
					</div>

					<!-- Row 3: Select vehicle и Number of passengers -->
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

					<!-- Row 4: Pick-up time и Destination -->
					<div class="form-row">
						<div class="form-group form-group-datetime">
							<input type="datetime-local" id="pickup-time" name="pickup_time" placeholder="Pick-up time" required>
							<span class="datetime-placeholder">Pick-up time</span>
						</div>
						<div class="form-group">
							<input type="text" id="destination" name="destination" placeholder="Destination" required>
						</div>
					</div>

					<!-- Row 5: Comments -->
					<div class="form-row">
						<div class="form-group">
							<textarea id="comments" name="comments" placeholder="Comments" rows="3"></textarea>
						</div>
					</div>

					<!-- Submit button -->
					<button type="submit" class="booking-submit-btn">Get My Quote</button>
				</form>

				<!-- World map section -->
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

	<?php // Rest of the blocks use original templates 
	?>
	<?php get_template_part('template-parts/blocks/booking-form-limousine-service'); ?>

	<?php get_template_part('template-parts/blocks/why-us'); ?>

	<?php get_template_part('template-parts/blocks/fleet-slider'); ?>

	<?php get_template_part('template-parts/blocks/occasions'); ?>

	<?php get_template_part('template-parts/blocks/how-it-works'); ?>

	<div class="white-sections-wrapper">
		<?php get_template_part('template-parts/blocks/trusted-by'); ?>
		<?php get_template_part('template-parts/blocks/faq'); ?>
		<?php get_template_part('template-parts/blocks/custom-itinerary', 'limousine'); ?>
		<?php get_template_part('template-parts/blocks/services', 'limousine'); ?>
	</div>

</main><!-- #primary -->

<?php
get_footer();
