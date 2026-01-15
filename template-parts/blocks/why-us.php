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
		<div class="why-us-grid">
			<!-- Element 1: Image -->
			<div class="why-us-item why-us-item-1">
				<img src="<?php echo esc_url( $image_1_url ); ?>" alt="Available worldwide" class="why-us-item-image">
				<h3 class="why-us-item-title"><?php echo esc_html( 'Available worldwide' ); ?></h3>
				<p class="why-us-item-description"><?php echo esc_html( 'Consistent excellence in executive and luxury transfers – wherever your journey takes you.' ); ?></p>
			</div>

			<!-- Element 2: Icon -->
			<div class="why-us-item why-us-item-2">
				<img src="<?php echo esc_url( $icon_2_url ); ?>" alt="World-class fleet" class="why-us-item-icon">
				<h3 class="why-us-item-title"><?php echo esc_html( 'World-class fleet' ); ?></h3>
				<p class="why-us-item-description"><?php echo esc_html( 'Late-model business, premium and VIP vehicles, perfectly maintained for comfort, style and safety.' ); ?></p>
			</div>

			<!-- Element 3: Icon -->
			<div class="why-us-item why-us-item-3">
				<img src="<?php echo esc_url( $icon_3_url ); ?>" alt="Qualified chauffeurs" class="why-us-item-icon">
				<h3 class="why-us-item-title"><?php echo esc_html( 'Qualified chauffeurs' ); ?></h3>
				<p class="why-us-item-description"><?php echo esc_html( 'Licensed, experienced and discreet professionals trained to meet the highest service standards.' ); ?></p>
			</div>

			<!-- Element 4: Icon -->
			<div class="why-us-item why-us-item-4">
				<img src="<?php echo esc_url( $icon_4_url ); ?>" alt="Security & discretion" class="why-us-item-icon">
				<h3 class="why-us-item-title"><?php echo esc_html( 'Security & discretion' ); ?></h3>
				<p class="why-us-item-description"><?php echo esc_html( 'Strict safety protocols, discreet coordination, and confidential service for corporate & VIP clients.' ); ?></p>
			</div>

			<!-- Element 5: Icon -->
			<div class="why-us-item why-us-item-5">
				<img src="<?php echo esc_url( $icon_5_url ); ?>" alt="24/7 Human Support" class="why-us-item-icon">
				<h3 class="why-us-item-title"><?php echo esc_html( '24/7 Human Support' ); ?></h3>
				<p class="why-us-item-description"><?php echo esc_html( 'Book directly on the website or through your personal manager – 24/7 via messenger, email or phone.' ); ?></p>
			</div>

			<!-- Element 6: Image -->
			<div class="why-us-item why-us-item-6">
				<img src="<?php echo esc_url( $image_6_url ); ?>" alt="Seamless coordination" class="why-us-item-image">
				<h3 class="why-us-item-title"><?php echo esc_html( 'Seamless coordination' ); ?></h3>
				<p class="why-us-item-description"><?php echo esc_html( 'We work directly with your planner or venue to synchronise every detail – from arrivals to final departures.' ); ?></p>
			</div>
		</div>
	</div>
</section>
