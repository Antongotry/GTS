<?php
/**
 * Blog (posts index) template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GTS
 */

get_header();
?>

<main id="primary" class="site-main site-main--blog">

	<?php get_template_part( 'template-parts/blocks/blog-hero' ); ?>
	<?php get_template_part( 'template-parts/blocks/blog-archive' ); ?>

</main><!-- #primary -->

<?php
get_footer();

