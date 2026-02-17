<?php
/**
 * Template Name: Fleet
 * Fleet page with tabs (Ground Fleet / Helicopters / Jets).
 *
 * @package GTS
 */

get_header();

$fleet_param = isset( $_GET['fleet'] ) ? sanitize_key( wp_unslash( $_GET['fleet'] ) ) : '';
$fleet_type  = in_array( $fleet_param, array( 'ground', 'helicopters', 'jets' ), true ) ? $fleet_param : 'ground';

?>

<main id="primary" class="site-main site-main--fleet">
	<?php
	set_query_var( 'gts_fleet_type', $fleet_type );
	get_template_part( 'template-parts/blocks/fleet-hero' );

	if ( 'ground' === $fleet_type ) {
		get_template_part( 'template-parts/blocks/fleet-ground' );
	}

	if ( 'helicopters' === $fleet_type ) {
		get_template_part( 'template-parts/blocks/fleet-helicopters' );
		get_template_part(
			'template-parts/blocks/fleet-slider',
			null,
			array(
				'category_slugs' => array( 'helicopter' ),
				'title'          => 'Helicopter fleet for urgent routes and premium transfers',
				'lead'           => 'Aircraft selection tailored to distance, passenger count, and mission profile.',
			)
		);
	}

	if ( 'jets' === $fleet_type ) {
		get_template_part(
			'template-parts/blocks/fleet-slider',
			null,
			array(
				'category_slugs' => array( 'light-jets', 'mid-jets', 'super-mid-jets' ),
				'title'          => 'Private jet options for regional and long-range travel',
				'lead'           => 'Choose from light, mid, and super-mid jet classes for the right cabin and range.',
			)
		);
	}
	?>
</main><!-- #primary -->

<?php
get_footer();
