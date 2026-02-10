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

	if ( 'helicopters' === $fleet_type ) {
		get_template_part( 'template-parts/blocks/fleet-helicopters' );
	}
	?>
</main><!-- #primary -->

<?php
get_footer();

