<?php
/**
 * Template Name: City-to-City
 * Template for displaying City-to-City service page
 *
 * @package GTS
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php get_template_part( 'template-parts/blocks/hero-city-to-city-service' ); ?>

	<?php get_template_part( 'template-parts/blocks/booking-form-limousine-service' ); ?>

	<?php get_template_part( 'template-parts/blocks/why-us' ); ?>

	<?php get_template_part( 'template-parts/blocks/fleet-slider' ); ?>

	<?php get_template_part( 'template-parts/blocks/occasions' ); ?>

	<?php get_template_part( 'template-parts/blocks/how-it-works' ); ?>

	<div class="white-sections-wrapper">
		<?php get_template_part( 'template-parts/blocks/trusted-by' ); ?>
		<?php get_template_part( 'template-parts/blocks/faq' ); ?>
		<?php get_template_part( 'template-parts/blocks/custom-itinerary', 'limousine' ); ?>
		<?php get_template_part( 'template-parts/blocks/services', 'limousine' ); ?>
	</div>

</main><!-- #primary -->

<?php
get_footer();
