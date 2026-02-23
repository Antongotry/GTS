<?php
/**
 * Service Block: Context Grid Section
 *
 * @package GTS
 */

$block = isset( $args['block'] ) && is_array( $args['block'] ) ? $args['block'] : array();

$site_url = get_site_url();
$pill_text = ! empty( $block['pill_text'] ) ? $block['pill_text'] : 'Full Service';
$title = ! empty( $block['title'] ) ? $block['title'] : 'Where accuracy, tone, and context truly matter.';
$subtitle = ! empty( $block['subtitle'] ) ? $block['subtitle'] : '';
$variant = ! empty( $block['variant'] ) ? $block['variant'] : 'context';
$current_service_slug = '';
if ( is_singular( 'service' ) ) {
	$current_service_slug = (string) get_post_field( 'post_name', get_the_ID() );
}

$top_image = ! empty( $block['top_image'] ) ? $block['top_image'] : $site_url . '/wp-content/uploads/2026/02/photo-l-1_result.webp';
$bottom_image = ! empty( $block['bottom_image'] ) ? $block['bottom_image'] : $site_url . '/wp-content/uploads/2026/02/photo-l-2_result.webp';

$icon_business = $site_url . '/wp-content/uploads/2026/02/icon-l-1.svg';
$icon_group = $site_url . '/wp-content/uploads/2026/02/icon-l-2.svg';
$icon_medical = $site_url . '/wp-content/uploads/2026/02/icon-l-3.svg';
$icon_legal = $site_url . '/wp-content/uploads/2026/02/icon-l-5.svg';
$icon_property = $site_url . '/wp-content/uploads/2026/02/icon-l-4.svg';
$icon_private = $site_url . '/wp-content/uploads/2026/02/icon-l-3.svg';
$icon_schedule = $site_url . '/wp-content/uploads/2026/02/icon-l-2.svg';

$preset_cards = array(
	'context' => array(
		array( 'card_type' => 'text', 'theme' => 'dark', 'icon' => $icon_business, 'text' => 'Business meetings and negotiations', 'col_start' => 1, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'image', 'image' => $top_image, 'col_start' => 2, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'text', 'theme' => 'dark', 'icon' => $icon_group, 'text' => 'Corporate travel and executive visits', 'col_start' => 3, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'text', 'theme' => 'light', 'icon' => $icon_medical, 'text' => 'Medical appointments and consultations', 'col_start' => 4, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'text', 'theme' => 'dark', 'icon' => $icon_legal, 'text' => 'Legal, administrative, or official procedures', 'col_start' => 5, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'text', 'theme' => 'light', 'icon' => $icon_property, 'text' => 'Property viewings and real estate transactions', 'col_start' => 1, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'text', 'theme' => 'dark', 'icon' => $icon_private, 'text' => 'Private travel, events, and high-level appointments', 'col_start' => 2, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'text', 'theme' => 'dark', 'icon' => $icon_schedule, 'text' => 'Multi-day or multi-location travel programs', 'col_start' => 3, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'image', 'image' => $bottom_image, 'col_start' => 4, 'col_span' => 2, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 2 ),
	),
	'purpose' => array(
		array( 'card_type' => 'text', 'theme' => 'dark', 'icon' => $icon_business, 'text' => 'Boutique shopping across multiple districts', 'col_start' => 1, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'image', 'image' => $top_image, 'col_start' => 2, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'text', 'theme' => 'dark', 'icon' => $icon_property, 'text' => 'Designer outlets and premium shopping malls', 'col_start' => 3, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'image', 'image' => $bottom_image, 'col_start' => 4, 'col_span' => 2, 'row_start' => 1, 'row_span' => 2, 'mobile_span' => 2 ),
		array( 'card_type' => 'text', 'theme' => 'light', 'icon' => $icon_medical, 'text' => 'Personal shopping sessions and private appointments', 'col_start' => 1, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'text', 'theme' => 'dark', 'icon' => $icon_schedule, 'text' => 'Multi-location shopping itineraries in one or several cities', 'col_start' => 2, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'text', 'theme' => 'dark', 'icon' => $icon_group, 'text' => 'Shopping during business trips or travel', 'col_start' => 3, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1 ),
	),
	'partnership' => array(
		array( 'card_type' => 'text', 'theme' => 'dark', 'icon' => $icon_private, 'text' => 'Private tours and sightseeing programs', 'col_start' => 1, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'image', 'image' => $top_image, 'col_start' => 2, 'col_span' => 2, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 2 ),
		array( 'card_type' => 'text', 'theme' => 'light', 'icon' => $icon_medical, 'text' => 'Airport transfers and meet & greet', 'col_start' => 4, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'text', 'theme' => 'dark', 'icon' => $icon_schedule, 'text' => 'Multi-day itineraries and custom routes', 'col_start' => 5, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'text', 'theme' => 'light', 'icon' => $icon_property, 'text' => 'VIP and luxury travel services', 'col_start' => 1, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'text', 'theme' => 'dark', 'icon' => $icon_group, 'text' => 'Corporate and leisure client support', 'col_start' => 2, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'text', 'theme' => 'dark', 'icon' => $icon_business, 'text' => 'Individual bookings and group coordination', 'col_start' => 3, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1 ),
		array( 'card_type' => 'image', 'image' => $bottom_image, 'col_start' => 4, 'col_span' => 2, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 2 ),
	),
);

$cards = ! empty( $block['cards'] ) && is_array( $block['cards'] ) ? $block['cards'] : array();
if ( empty( $cards ) ) {
	$cards = isset( $preset_cards[ $variant ] ) ? $preset_cards[ $variant ] : $preset_cards['context'];
} elseif ( isset( $preset_cards[ $variant ] ) ) {
	$preset_for_variant = $preset_cards[ $variant ];
	foreach ( $cards as $index => $card ) {
		if ( ! is_array( $card ) ) {
			continue;
		}
		$preset_card = isset( $preset_for_variant[ $index ] ) && is_array( $preset_for_variant[ $index ] ) ? $preset_for_variant[ $index ] : array();
		if ( empty( $preset_card ) ) {
			continue;
		}
		$card_type = ! empty( $card['card_type'] ) ? $card['card_type'] : '';
		if ( 'image' === $card_type ) {
			$image = isset( $card['image'] ) ? trim( (string) $card['image'] ) : '';
			if ( '' === $image && ! empty( $preset_card['image'] ) ) {
				$cards[ $index ]['image'] = $preset_card['image'];
			}
		} else {
			$icon = isset( $card['icon'] ) ? trim( (string) $card['icon'] ) : '';
			if ( '' === $icon && ! empty( $preset_card['icon'] ) ) {
				$cards[ $index ]['icon'] = $preset_card['icon'];
			}
		}
	}
}
?>

<section class="service-context-block">
	<div class="service-context-container">
		<div class="service-context-heading">
			<div class="why-us-heading-pill">
				<span class="why-us-heading-text"><?php echo esc_html( $pill_text ); ?></span>
			</div>
			<div class="service-context-heading-copy">
				<h2 class="service-context-title"><?php echo esc_html( $title ); ?></h2>
				<?php if ( ! empty( $subtitle ) ) : ?>
					<p class="service-context-subtitle"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>
			</div>
		</div>

		<div class="service-context-grid">
			<?php foreach ( $cards as $index => $card ) :
					$card_type = ! empty( $card['card_type'] ) ? $card['card_type'] : 'text';
					$text = ! empty( $card['text'] ) ? $card['text'] : '';
					$theme = ! empty( $card['theme'] ) ? $card['theme'] : 'dark';
					if ( 'shoping' === $current_service_slug && 'text' === $card_type ) {
						if ( 4 === (int) $index ) {
							$theme = 'light';
						}
						if ( false !== stripos( wp_strip_all_tags( (string) $text ), 'Personal shopping sessions' ) ) {
							$theme = 'light';
						}
					}
					$icon = ! empty( $card['icon'] ) ? $card['icon'] : '';
				$image = ! empty( $card['image'] ) ? $card['image'] : '';

				$col_start = max( 1, (int) ( ! empty( $card['col_start'] ) ? $card['col_start'] : 1 ) );
				$col_span = max( 1, (int) ( ! empty( $card['col_span'] ) ? $card['col_span'] : 1 ) );
				$row_start = max( 1, (int) ( ! empty( $card['row_start'] ) ? $card['row_start'] : 1 ) );
				$row_span = max( 1, (int) ( ! empty( $card['row_span'] ) ? $card['row_span'] : 1 ) );
				$mobile_span = max( 1, min( 2, (int) ( ! empty( $card['mobile_span'] ) ? $card['mobile_span'] : 1 ) ) );

				$classes = 'service-context-card';
				if ( 'image' === $card_type ) {
					$classes .= ' service-context-card--image';
				} else {
					$classes .= ' light' === $theme ? ' service-context-card--light' : ' service-context-card--dark';
				}
				if ( $col_span > 1 ) {
					$classes .= ' service-context-card--wide';
				}
				if ( 2 === $mobile_span ) {
					$classes .= ' service-context-card--mobile-wide';
				}

				$style = '--sc-col:' . $col_start . ';--sc-col-span:' . $col_span . ';--sc-row:' . $row_start . ';--sc-row-span:' . $row_span . ';';
				if ( 'image' === $card_type && ! empty( $image ) ) {
					$style .= 'background-image:url(' . esc_url( $image ) . ');';
				}
			?>
				<div class="<?php echo esc_attr( $classes ); ?>" style="<?php echo esc_attr( $style ); ?>"<?php echo 'image' === $card_type ? ' role="img" aria-label="' . esc_attr__( 'Service context image', 'gts-theme' ) . '"' : ''; ?>>
					<?php if ( 'text' === $card_type ) : ?>
						<?php if ( ! empty( $icon ) ) : ?>
							<div class="service-context-icon-badge<?php echo 'light' === $theme ? ' service-context-icon-badge--light' : ''; ?>"><img src="<?php echo esc_url( $icon ); ?>" alt="" width="24" height="24" loading="lazy"></div>
						<?php endif; ?>
							<?php if ( ! empty( $text ) ) : ?>
								<p class="service-context-text"><?php echo wp_kses( $text, array( 'br' => array() ) ); ?></p>
							<?php endif; ?>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
