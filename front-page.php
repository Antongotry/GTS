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

	<?php get_template_part( 'template-parts/blocks/why-us' ); ?>

	<?php get_template_part( 'template-parts/blocks/how-it-works' ); ?>

	<?php get_template_part( 'template-parts/blocks/trusted-by' ); ?>

	<?php get_template_part( 'template-parts/blocks/services' ); ?>

</main><!-- #primary -->

<?php
get_footer();
