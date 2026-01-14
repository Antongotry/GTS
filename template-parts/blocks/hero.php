<?php
/**
 * Hero Block Template
 * 
 * @package GTS
 */

// Get image URL
$image_url = get_template_directory_uri() . '/assets/media/26_result.webp';
?>

<section class="hero-block" style="background-image: url('<?php echo esc_url( $image_url ); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
	<!-- Debug: <?php echo esc_url( $image_url ); ?> -->
</section>
