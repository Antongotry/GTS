<?php
/**
 * Template Name: Limousine Service
 * Template for displaying Limousine Service page
 *
 * @package GTS
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php get_template_part('template-parts/blocks/hero-limousine-service'); ?>

	<?php get_template_part('template-parts/blocks/booking-form-limousine-service'); ?>

	<?php get_template_part('template-parts/blocks/why-us'); ?>

	<?php get_template_part('template-parts/blocks/occasions'); ?>

	<?php get_template_part('template-parts/blocks/how-it-works'); ?>

	<div class="white-sections-wrapper">
		<?php get_template_part('template-parts/blocks/trusted-by'); ?>
		<?php get_template_part('template-parts/blocks/faq'); ?>
		<?php get_template_part('template-parts/blocks/custom-itinerary'); ?>
	</div>

</main><!-- #primary -->

<?php
get_footer();
