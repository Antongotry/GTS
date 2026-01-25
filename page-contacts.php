<?php
/**
 * Template Name: Contacts
 * Template for displaying Contacts page
 *
 * @package GTS
 */

get_header();
?>

<main id="primary" class="site-main site-main--contacts">

	<?php get_template_part( 'template-parts/blocks/hero-contacts' ); ?>

	<?php get_template_part( 'template-parts/blocks/contacts-main' ); ?>

</main><!-- #primary -->

<?php
get_footer();
