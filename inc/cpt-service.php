<?php
/**
 * Register Service Custom Post Type
 *
 * @package GTS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Service post type
 */
function gts_register_service_cpt() {
	$labels = array(
		'name'                  => _x( 'Services', 'Post type general name', 'gts-theme' ),
		'singular_name'         => _x( 'Service', 'Post type singular name', 'gts-theme' ),
		'menu_name'             => _x( 'Services', 'Admin Menu text', 'gts-theme' ),
		'name_admin_bar'        => _x( 'Service', 'Add New on Toolbar', 'gts-theme' ),
		'add_new'               => __( 'Add New', 'gts-theme' ),
		'add_new_item'          => __( 'Add New Service', 'gts-theme' ),
		'new_item'              => __( 'New Service', 'gts-theme' ),
		'edit_item'             => __( 'Edit Service', 'gts-theme' ),
		'view_item'             => __( 'View Service', 'gts-theme' ),
		'all_items'             => __( 'All Services', 'gts-theme' ),
		'search_items'          => __( 'Search Services', 'gts-theme' ),
		'parent_item_colon'     => __( 'Parent Services:', 'gts-theme' ),
		'not_found'             => __( 'No services found.', 'gts-theme' ),
		'not_found_in_trash'    => __( 'No services found in Trash.', 'gts-theme' ),
		'featured_image'        => _x( 'Service Cover Image', 'Overrides the "Featured Image" phrase', 'gts-theme' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the "Set featured image" phrase', 'gts-theme' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the "Remove featured image" phrase', 'gts-theme' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the "Use as featured image" phrase', 'gts-theme' ),
		'archives'              => _x( 'Service archives', 'The post type archive label', 'gts-theme' ),
		'insert_into_item'      => _x( 'Insert into service', 'Overrides the "Insert into post" phrase', 'gts-theme' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this service', 'Overrides the "Uploaded to this post" phrase', 'gts-theme' ),
		'filter_items_list'     => _x( 'Filter services list', 'Screen reader text', 'gts-theme' ),
		'items_list_navigation' => _x( 'Services list navigation', 'Screen reader text', 'gts-theme' ),
		'items_list'            => _x( 'Services list', 'Screen reader text', 'gts-theme' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array(
			'slug'       => 'services',
			'with_front' => false,
		),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-tickets',
		'supports'           => array( 'title', 'thumbnail', 'excerpt' ),
		'show_in_rest'       => true, // Enable Gutenberg editor support
	);

	register_post_type( 'service', $args );
}
add_action( 'init', 'gts_register_service_cpt' );

/**
 * Flush rewrite rules on theme activation
 */
function gts_service_rewrite_flush() {
	gts_register_service_cpt();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'gts_service_rewrite_flush' );

/**
 * Add custom columns to Service admin list
 */
function gts_service_admin_columns( $columns ) {
	$new_columns = array();
	foreach ( $columns as $key => $value ) {
		$new_columns[ $key ] = $value;
		if ( 'title' === $key ) {
			$new_columns['service_blocks'] = __( 'Blocks', 'gts-theme' );
		}
	}
	return $new_columns;
}
add_filter( 'manage_service_posts_columns', 'gts_service_admin_columns' );

/**
 * Display custom column content
 */
function gts_service_admin_column_content( $column, $post_id ) {
	if ( 'service_blocks' === $column ) {
		if ( function_exists( 'get_field' ) ) {
			$blocks = get_field( 'service_blocks', $post_id );
			if ( $blocks && is_array( $blocks ) ) {
				$enabled_count = 0;
				foreach ( $blocks as $block ) {
					if ( ! empty( $block['enabled'] ) ) {
						$enabled_count++;
					}
				}
				printf(
					/* translators: %1$d: enabled blocks, %2$d: total blocks */
					esc_html__( '%1$d / %2$d enabled', 'gts-theme' ),
					$enabled_count,
					count( $blocks )
				);
			} else {
				echo '<span style="color: #999;">' . esc_html__( 'Not configured', 'gts-theme' ) . '</span>';
			}
		} else {
			echo '<span style="color: #d63638;">' . esc_html__( 'ACF not active', 'gts-theme' ) . '</span>';
		}
	}
}
add_action( 'manage_service_posts_custom_column', 'gts_service_admin_column_content', 10, 2 );

/**
 * Add quick access to service-style pages under Services menu.
 */
function gts_register_service_pages_submenu() {
	add_submenu_page(
		'edit.php?post_type=service',
		__( 'Service Pages', 'gts-theme' ),
		__( 'Service Pages', 'gts-theme' ),
		'edit_pages',
		'gts-service-pages',
		'gts_render_service_pages_submenu'
	);
}
add_action( 'admin_menu', 'gts_register_service_pages_submenu' );

/**
 * Render "Service Pages" submenu content.
 */
function gts_render_service_pages_submenu() {
	if ( ! current_user_can( 'edit_pages' ) ) {
		wp_die( esc_html__( 'You do not have permission to access this page.', 'gts-theme' ) );
	}

	$page_ids = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => array( 'publish', 'draft', 'private', 'pending' ),
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'meta_query'     => array(
				array(
					'key'     => '_wp_page_template',
					'value'   => array( 'page-city-to-city.php', 'page-limousine-service.php' ),
					'compare' => 'IN',
				),
			),
		)
	);
	?>
	<div class="wrap">
		<h1><?php echo esc_html__( 'Service-Style Pages', 'gts-theme' ); ?></h1>
		<p><?php echo esc_html__( 'These pages use the same "Service Page Blocks" editor as Services.', 'gts-theme' ); ?></p>
		<table class="widefat striped">
			<thead>
				<tr>
					<th><?php echo esc_html__( 'Page', 'gts-theme' ); ?></th>
					<th><?php echo esc_html__( 'Template', 'gts-theme' ); ?></th>
					<th><?php echo esc_html__( 'Actions', 'gts-theme' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if ( empty( $page_ids ) ) : ?>
					<tr>
						<td colspan="3"><?php echo esc_html__( 'No pages with required templates found.', 'gts-theme' ); ?></td>
					</tr>
				<?php else : ?>
					<?php foreach ( $page_ids as $page_id ) : ?>
						<?php
						$template = (string) get_page_template_slug( $page_id );
						$edit_link = get_edit_post_link( $page_id, '' );
						$view_link = get_permalink( $page_id );
						?>
						<tr>
							<td><?php echo esc_html( get_the_title( $page_id ) ); ?></td>
							<td><code><?php echo esc_html( $template ); ?></code></td>
							<td>
								<a class="button button-primary" href="<?php echo esc_url( $edit_link ); ?>"><?php echo esc_html__( 'Edit Page', 'gts-theme' ); ?></a>
								<a class="button" href="<?php echo esc_url( $view_link ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html__( 'View', 'gts-theme' ); ?></a>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
	<?php
}
