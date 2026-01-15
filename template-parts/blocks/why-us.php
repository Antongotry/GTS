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
?>

<section class="why-us-block">
	<div class="why-us-container">
		<div class="why-us-heading">
			<div class="why-us-heading-pill">
				<span class="why-us-heading-text"><?php echo esc_html( 'Why us?' ); ?></span>
			</div>
			<div class="why-us-heading-line" aria-hidden="true"></div>
		</div>
		<div class="why-us-grid">
			<!-- Element 1: Image as background -->
			<div class="why-us-item why-us-item-1" style="background-image: url('<?php echo esc_url( $image_1_url ); ?>');">
				<h3 class="why-us-item-title"><?php echo esc_html( 'Available worldwide' ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( 'Consistent excellence in executive<br>and luxury transfers — wherever<br>your journey takes you.' ); ?></p>
			</div>

			<!-- Element 2: Icon -->
			<div class="why-us-item why-us-item-2">
				<div class="why-us-item-icon-wrapper">
					<img src="<?php echo esc_url( $icon_2_url ); ?>" alt="World-class fleet" class="why-us-item-icon">
				</div>
				<h3 class="why-us-item-title"><?php echo esc_html( 'World-class fleet' ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( 'Late-model business, premium and<br>VIP vehicles, perfectly maintained for<br>comfort, style and safety.' ); ?></p>
			</div>

			<!-- Element 3: Icon -->
			<div class="why-us-item why-us-item-3">
				<div class="why-us-item-icon-wrapper">
					<img src="<?php echo esc_url( $icon_3_url ); ?>" alt="Qualified chauffeurs" class="why-us-item-icon">
				</div>
				<h3 class="why-us-item-title"><?php echo esc_html( 'Qualified chauffeurs' ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( 'Licensed, experienced and discreet<br>professionals trained to meet the<br>highest service standards.' ); ?></p>
			</div>

			<!-- Element 4: Icon -->
			<div class="why-us-item why-us-item-4">
				<div class="why-us-item-icon-wrapper">
					<img src="<?php echo esc_url( $icon_4_url ); ?>" alt="Security & discretion" class="why-us-item-icon">
				</div>
				<h3 class="why-us-item-title"><?php echo esc_html( 'Security & discretion' ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( 'Strict safety protocols, discreet<br>coordination, and confidential service for<br>corporate & VIP clients.' ); ?></p>
			</div>

			<!-- Element 5: Icon -->
			<div class="why-us-item why-us-item-5">
				<div class="why-us-item-icon-wrapper">
					<img src="<?php echo esc_url( $icon_5_url ); ?>" alt="24/7 Human Support" class="why-us-item-icon">
				</div>
				<h3 class="why-us-item-title"><?php echo esc_html( '24/7 Human Support' ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( 'Book directly on the website or through<br>your personal manager — 24/7 via<br>messenger, email or phone.' ); ?></p>
			</div>

			<!-- Element 6: Image as background -->
			<div class="why-us-item why-us-item-6" style="background-image: url('<?php echo esc_url( $image_6_url ); ?>');">
				<h3 class="why-us-item-title"><?php echo esc_html( 'Seamless coordination' ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( 'We work directly with your planner or venue to<br>synchronise every detail — from arrivals to final<br>departures.' ); ?></p>
			</div>
		</div>
	</div>
</section>
