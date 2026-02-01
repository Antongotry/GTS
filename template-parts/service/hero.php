<?php

/**
 * Service Block: Hero Section
 *
 * Displays the hero for service pages, reading data from ACF fields.
 *
 * @package GTS
 */

// Get block data passed from single-service.php
$block = isset($args['block']) ? $args['block'] : array();

// Default background images (same as Limousine Service page)
$default_bg_mobile  = get_site_url() . '/wp-content/uploads/2026/01/375-lm-1_result.webp';
$default_bg_tablet  = get_site_url() . '/wp-content/uploads/2026/01/1024-lm-1_result.webp';
$default_bg_desktop = get_site_url() . '/wp-content/uploads/2026/01/1920-lm-1_result-scaled.webp';

// Extract fields with defaults
$title              = ! empty($block['title']) ? $block['title'] : get_the_title();
$subtitle           = ! empty($block['subtitle']) ? $block['subtitle'] : '';
$background_mobile  = ! empty($block['background_mobile']) ? $block['background_mobile'] : $default_bg_mobile;
$background_tablet  = ! empty($block['background_tablet']) ? $block['background_tablet'] : $default_bg_tablet;
$background_desktop = ! empty($block['background_desktop']) ? $block['background_desktop'] : $default_bg_desktop;
$cta_text           = ! empty($block['cta_text']) ? $block['cta_text'] : __('Book a transfer', 'gts-theme');
$cta_link           = ! empty($block['cta_link']) ? $block['cta_link'] : '#';
$features           = ! empty($block['features']) ? $block['features'] : array();
$stats_number       = ! empty($block['stats_number']) ? $block['stats_number'] : '100+';
$stats_label        = ! empty($block['stats_label']) ? $block['stats_label'] : 'countries';

// Get hero feature icons from theme assets as fallback
$hero_icon_1 = file_get_contents(get_template_directory() . '/assets/icons/icon-1-l.svg');
$hero_icon_2 = file_get_contents(get_template_directory() . '/assets/icons/icon-2-l.svg');
$hero_icon_3 = file_get_contents(get_template_directory() . '/assets/icons/icon-3-l.svg');
$default_icons = array($hero_icon_1, $hero_icon_2, $hero_icon_3);

// Default features if none set
if (empty($features)) {
	$features = array(
		array('icon' => '', 'text' => 'Available in 100+ countries'),
		array('icon' => '', 'text' => 'Operated by licensed chauffeurs with 24/7 support'),
		array('icon' => '', 'text' => 'Licensed & insured, premium fleet'),
	);
}
?>

<?php if ($background_mobile || $background_tablet || $background_desktop) : ?>
	<style id="hero-service-bg">
		/* Hero responsive backgrounds for Service page */
		<?php if ($background_mobile) : ?>.hero-block {
			background-image: url('<?php echo esc_url($background_mobile); ?>') !important;
		}

		<?php endif; ?><?php if ($background_tablet) : ?>@media (min-width: 769px) {
			.hero-block {
				background-image: url('<?php echo esc_url($background_tablet); ?>') !important;
			}
		}

		<?php endif; ?><?php if ($background_desktop) : ?>@media (min-width: 1025px) {
			.hero-block {
				background-image: url('<?php echo esc_url($background_desktop); ?>') !important;
			}
		}

		<?php endif; ?>
	</style>
<?php endif; ?>

<section class="hero-block">
	<div class="hero-container">
		<!-- Left side -->
		<div class="hero-left">
			<div class="hero-content">
				<h1 class="hero-title"><?php echo wp_kses_post($title); ?></h1>

				<?php if ($subtitle) : ?>
					<p class="hero-description"><?php echo wp_kses_post($subtitle); ?></p>
				<?php endif; ?>

				<div class="hero-buttons">
					<a href="<?php echo esc_url($cta_link); ?>" class="btn btn-primary"><?php echo esc_html($cta_text); ?></a>
				</div>

				<?php if (! empty($features)) : ?>
					<div class="hero-features">
						<?php
						$positions = array('hero-feature-top-left', '', 'hero-feature-bottom-left', 'hero-feature-bottom-right');
						foreach ($features as $index => $feature) :
							$position_class = isset($positions[$index]) ? $positions[$index] : '';
							$feature_icon   = ! empty($feature['icon']) ? $feature['icon'] : '';
							$feature_text   = ! empty($feature['text']) ? $feature['text'] : '';
						?>
							<div class="hero-feature <?php echo esc_attr($position_class); ?>">
								<?php if ($feature_icon) : ?>
									<div class="hero-feature-icon" role="img" aria-label="<?php echo esc_attr($feature_text); ?>">
										<img src="<?php echo esc_url($feature_icon); ?>" alt="" width="24" height="24" loading="lazy">
									</div>
								<?php elseif (isset($default_icons[$index]) && $default_icons[$index]) : ?>
									<div class="hero-feature-icon" role="img" aria-label="<?php echo esc_attr($feature_text); ?>">
										<?php echo wp_kses($default_icons[$index], gts_allowed_svg_hero()); ?>
									</div>
								<?php endif; ?>
								<?php if ($feature_text) : ?>
									<p class="hero-feature-text"><?php echo wp_kses_post($feature_text); ?></p>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<!-- Right side with form -->
		<div class="hero-right hero-right--desktop">
			<?php
			// Include booking form based on service settings
			get_template_part('template-parts/service/booking-form-inline');
			?>

			<?php if ($stats_number && $stats_label) : ?>
				<!-- World map section -->
				<div class="world-map-section">
					<div class="world-map-image">
						<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/noun-world-17688-1_result.webp'); ?>" alt="World Map" loading="lazy" width="100" height="100">
					</div>
					<div class="world-map-divider"></div>
					<div class="world-map-text">
						<p class="world-map-label world-map-label-top">clients in</p>
						<div class="world-map-bottom">
							<p class="world-map-number"><?php echo esc_html($stats_number); ?></p>
							<p class="world-map-label world-map-label-bottom"><?php echo esc_html($stats_label); ?></p>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
