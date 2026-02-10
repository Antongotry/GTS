<?php
/**
 * Fleet hero with tabs.
 *
 * @package GTS
 */

$fleet_type = get_query_var( 'gts_fleet_type' );
$fleet_type = $fleet_type ? $fleet_type : 'ground';

$page_url = get_permalink();
?>

<section class="fleet-hero">
	<div class="fleet-hero__container">
		<a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>" class="fleet-hero__cta"><?php esc_html_e( 'Get in Touch with GTS', 'gts-theme' ); ?></a>

		<div class="fleet-hero__top">
			<h1 class="fleet-hero__title"><?php echo wp_kses_post( 'Mobility across ground, air,<br>and special transport' ); ?></h1>
			<p class="fleet-hero__desc"><?php esc_html_e( 'GTS provides access to a professionally managed fleet across ground and air transportation — selected to meet business, event, and private travel requirements worldwide.', 'gts-theme' ); ?></p>
		</div>

		<div class="fleet-hero__divider" aria-hidden="true"></div>

		<nav class="fleet-tabs" aria-label="<?php echo esc_attr__( 'Fleet categories', 'gts-theme' ); ?>">
			<?php
			$tabs = array(
				'ground'      => array(
					'label' => 'Ground Fleet',
					'url'   => remove_query_arg( 'fleet', $page_url ),
				),
				'helicopters' => array(
					'label' => 'Helicopters',
					'url'   => add_query_arg( 'fleet', 'helicopters', $page_url ),
				),
				'jets'        => array(
					'label' => 'Jets',
					'url'   => add_query_arg( 'fleet', 'jets', $page_url ),
				),
			);
			foreach ( $tabs as $key => $tab ) :
				$is_active = ( $key === $fleet_type );
				?>
				<a class="fleet-tabs__item <?php echo $is_active ? 'is-active' : ''; ?>" href="<?php echo esc_url( $tab['url'] ); ?>">
					<?php echo esc_html( $tab['label'] ); ?>
				</a>
			<?php endforeach; ?>
		</nav>
	</div>
</section>

