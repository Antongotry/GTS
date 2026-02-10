<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package GTS
 */

get_header();
?>

	<main id="primary" class="site-main site-main--single-post">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/blocks/post-hero' );
			get_template_part( 'template-parts/blocks/post-body' );
			get_template_part( 'template-parts/blocks/post-other' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
