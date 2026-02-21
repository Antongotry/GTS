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
?>

<section class="why-us-block">
	<div class="why-us-container">
		<div class="why-us-heading">
			<div class="why-us-heading-pill">
				<span class="why-us-heading-text"><?php echo esc_html( 'Why us?' ); ?></span>
			</div>
			<div class="why-us-heading-line" aria-hidden="true"></div>
		</div>
		<?php if ( $show_intro ) : ?>
			<div class="why-us-intro">
				<h2 class="why-us-intro-title"><?php echo esc_html( $intro_title ); ?></h2>
				<p class="why-us-intro-description"><?php echo esc_html( $intro_text ); ?></p>
			</div>
		<?php endif; ?>
		<div class="why-us-grid">
			<!-- Element 1: Image as background -->
			<div class="why-us-item why-us-item-1" style="background-image: url('<?php echo esc_url( $image_1_url ); ?>');">
				<h3 class="why-us-item-title"><?php echo esc_html( 'Available worldwide' ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( 'Consistent excellence in executive<br>and luxury transfers — wherever<br>your journey takes you.' ); ?></p>
			</div>

			<!-- Element 2: Icon -->
			<div class="why-us-item why-us-item-2">
				<div class="why-us-item-icon-wrapper">
					<img src="<?php echo esc_url( $icon_2_url ); ?>" alt="World-class fleet" class="why-us-item-icon" loading="lazy" width="48" height="48">
				</div>
				<h3 class="why-us-item-title"><?php echo esc_html( 'World-class fleet' ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( 'Late-model business, premium and<br>VIP vehicles, perfectly maintained for<br>comfort, style and safety.' ); ?></p>
			</div>

			<!-- Element 3: Icon -->
			<div class="why-us-item why-us-item-3">
				<div class="why-us-item-icon-wrapper">
					<img src="<?php echo esc_url( $icon_3_url ); ?>" alt="Qualified chauffeurs" class="why-us-item-icon" loading="lazy" width="48" height="48">
				</div>
				<h3 class="why-us-item-title"><?php echo esc_html( 'Qualified chauffeurs' ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( 'Licensed, experienced and discreet<br>professionals trained to meet the<br>highest service standards.' ); ?></p>
			</div>

			<!-- Element 4: Icon -->
			<div class="why-us-item why-us-item-4">
				<div class="why-us-item-icon-wrapper">
					<img src="<?php echo esc_url( $icon_4_url ); ?>" alt="Security & discretion" class="why-us-item-icon" loading="lazy" width="48" height="48">
				</div>
				<h3 class="why-us-item-title"><?php echo esc_html( 'Security & discretion' ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( 'Strict safety protocols, discreet<br>coordination, and confidential service for<br>corporate & VIP clients.' ); ?></p>
			</div>

			<!-- Element 5: Icon -->
			<div class="why-us-item why-us-item-5">
				<div class="why-us-item-icon-wrapper">
					<img src="<?php echo esc_url( $icon_5_url ); ?>" alt="24/7 Human Support" class="why-us-item-icon" loading="lazy" width="48" height="48">
				</div>
				<h3 class="why-us-item-title"><?php echo esc_html( $item_5_title ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( $item_5_description ); ?></p>
			</div>

			<!-- Element 6: Image as background -->
			<div class="why-us-item why-us-item-6" style="background-image: url('<?php echo esc_url( $image_6_url ); ?>');">
				<h3 class="why-us-item-title"><?php echo esc_html( $item_6_title ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( $item_6_description ); ?></p>
			</div>
		</div>
	</div>
</section>
