<?php

/**
 * Template for displaying single Service posts
 *
 * @package GTS
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while (have_posts()) :
		the_post();

		// Get service blocks from ACF
		if (function_exists('get_field')) {
			$blocks = get_field('service_blocks');

			if ($blocks && is_array($blocks)) {
				foreach ($blocks as $block) {
					// Skip disabled blocks
					if (empty($block['enabled'])) {
						continue;
					}

					// Get the layout name
					$layout = $block['acf_fc_layout'];

					// Load the corresponding template part
					get_template_part(
						'template-parts/service/' . $layout,
						null,
						array('block' => $block)
					);
				}
			} else {
				// No blocks configured - show a message in admin preview
				if (current_user_can('edit_posts')) {
	?>
					<div style="padding: 40px; text-align: center; background: #f5f5f5; margin: 20px;">
						<p><strong><?php esc_html_e('No blocks configured for this service.', 'gts-theme'); ?></strong></p>
						<p><?php esc_html_e('Edit this service in the admin panel to add blocks.', 'gts-theme'); ?></p>
					</div>
				<?php
				}
			}
		} else {
			// ACF not active
			if (current_user_can('edit_posts')) {
				?>
				<div style="padding: 40px; text-align: center; background: #fff3cd; margin: 20px;">
					<p><strong><?php esc_html_e('ACF Pro Required', 'gts-theme'); ?></strong></p>
					<p><?php esc_html_e('Please install and activate Advanced Custom Fields Pro to use Service pages.', 'gts-theme'); ?></p>
				</div>
	<?php
			}
		}

	endwhile;
	?>

</main><!-- #primary -->

<?php
get_footer();
