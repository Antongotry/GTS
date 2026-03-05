<?php
/**
 * Template Name: Limousine Service
 * Template for displaying Limousine Service page
 *
 * @package GTS
 */

get_header();
$page_id = get_queried_object_id();
?>

<main id="primary" class="site-main">

	<?php if ( gts_is_page_service_block_enabled( 'hero', true, $page_id ) ) { get_template_part('template-parts/blocks/hero-limousine-service'); } ?>

	<?php if ( gts_is_page_service_block_enabled( 'booking_form', true, $page_id ) ) { get_template_part('template-parts/blocks/booking-form-limousine-service'); } ?>

	<?php if ( gts_is_page_service_block_enabled( 'why_us', true, $page_id ) ) { get_template_part('template-parts/blocks/why-us'); } ?>

	<?php if ( gts_is_page_service_block_enabled( 'fleet', true, $page_id ) ) { get_template_part('template-parts/blocks/fleet-slider'); } ?>

	<?php if ( gts_is_page_service_block_enabled( 'occasions', true, $page_id ) ) { get_template_part('template-parts/blocks/occasions'); } ?>

	<?php if ( gts_is_page_service_block_enabled( 'how_it_works', true, $page_id ) ) { get_template_part('template-parts/blocks/how-it-works'); } ?>

		<div class="white-sections-wrapper">
			<?php if ( gts_is_page_service_block_enabled( 'testimonials', true, $page_id ) ) { get_template_part('template-parts/blocks/trusted-by'); } ?>
			<?php if ( gts_is_page_service_block_enabled( 'faq', true, $page_id ) ) { get_template_part('template-parts/blocks/faq'); } ?>
			<?php if ( gts_is_page_service_block_enabled( 'cta', true, $page_id ) ) { get_template_part('template-parts/blocks/custom-itinerary', 'limousine'); } ?>
			<?php if ( gts_is_page_service_block_enabled( 'related_services', true, $page_id ) ) { get_template_part('template-parts/blocks/services', 'limousine'); } ?>
			<?php
			$bottom_text_block = function_exists( 'gts_get_page_service_block' ) ? gts_get_page_service_block( 'bottom_text', $page_id ) : array();
			if ( ! empty( $bottom_text_block ) ) {
				get_template_part( 'template-parts/blocks/service-bottom-text', null, array( 'block' => $bottom_text_block ) );
			}
			?>
		</div>

</main><!-- #primary -->

<?php
get_footer();
