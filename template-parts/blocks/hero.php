<?php
/**
 * Hero Block Template
 * 
 * @package GTS
 */

// Get image URL from WordPress media library
$image_url = get_site_url() . '/wp-content/uploads/2026/01/26_result-scaled.webp';
?>

<section class="hero-block" style="background-image: url('<?php echo esc_url( $image_url ); ?>');">
	<!-- Test: Image URL = <?php echo esc_url( $image_url ); ?> -->
</section>
