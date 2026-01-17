<?php
/**
 * Template for displaying the front page
 *
 * @package GTS
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php get_template_part( 'template-parts/blocks/hero' ); ?>

	<?php get_template_part( 'template-parts/blocks/booking-form' ); ?>

	<?php get_template_part( 'template-parts/blocks/why-us' ); ?>

	<?php get_template_part( 'template-parts/blocks/how-it-works' ); ?>

	<div class="white-sections-wrapper">
		<?php get_template_part( 'template-parts/blocks/trusted-by' ); ?>

		<?php get_template_part( 'template-parts/blocks/services' ); ?>

		<?php get_template_part( 'template-parts/blocks/custom-itinerary' ); ?>
	</div>

	<?php get_template_part( 'template-parts/blocks/final-cta' ); ?>

</main><!-- #primary -->

<?php
get_footer();
