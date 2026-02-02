<?php

/**
 * The template for displaying 404 pages (not found)
 * Premium luxury design with animated steering wheel
 *
 * @package GTS
 */

get_header();
$site_url = get_site_url();
?>

<style>
	/* 404 Page Premium Styles */
	.error-404-page {
		min-height: 100vh;
		background: linear-gradient(180deg, #1A1D26 0%, #0C0F17 100%);
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 40px 20px;
		position: relative;
		overflow: hidden;
	}

	.error-404-page::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: radial-gradient(ellipse at center, rgba(244, 197, 139, 0.05) 0%, transparent 70%);
		pointer-events: none;
	}

	.error-404-container {
		text-align: center;
		max-width: 800px;
		position: relative;
		z-index: 1;
	}

	.error-404-code {
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 10px;
		margin-bottom: 40px;
	}

	.error-404-digit {
		font-size: clamp(100px, 20vw, 200px);
		font-weight: 500;
		color: #c9a962;
		line-height: 1;
		letter-spacing: -0.02em;
		font-family: "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
	}

	/* Animated Steering Wheel as "0" */
	.steering-wheel-container {
		position: relative;
		width: clamp(100px, 18vw, 180px);
		height: clamp(100px, 18vw, 180px);
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.steering-wheel {
		width: 100%;
		height: 100%;
		animation: slowSpin 12s linear infinite;
	}

	.steering-wheel svg {
		width: 100%;
		height: 100%;
	}

	@keyframes slowSpin {
		0% {
			transform: rotate(0deg);
		}

		100% {
			transform: rotate(360deg);
		}
	}

	.steering-wheel:hover {
		animation-play-state: paused;
	}

	.error-404-title {
		font-family: "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: clamp(28px, 5vw, 48px);
		font-weight: 500;
		color: #fff;
		margin-bottom: 20px;
		letter-spacing: -0.02em;
		line-height: 1.2;
	}

	.error-404-subtitle {
		font-family: "Manrope", "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: clamp(14px, 2.5vw, 16px);
		font-weight: 400;
		color: rgba(255, 255, 255, 0.6);
		margin-bottom: 50px;
		line-height: 1.5;
		max-width: 500px;
		margin-left: auto;
		margin-right: auto;
	}

	.error-404-btn {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 12px;
		padding: 0 32px;
		height: 56px;
		background: linear-gradient(to right, #FDDFAE 0%, #F4C58B 50%, #F7CE95 100%);
		color: #000000;
		text-decoration: none;
		font-family: "Manrope", "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
		font-size: 14px;
		font-weight: 400;
		border-radius: 50px;
		border: none;
		cursor: pointer;
		position: relative;
		overflow: hidden;
		transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	}

	.error-404-btn::before {
		content: '';
		position: absolute;
		top: 0;
		left: -100%;
		width: 100%;
		height: 100%;
		background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
		transition: left 0.5s ease;
		z-index: 2;
	}

	.error-404-btn:hover {
		background: linear-gradient(to right, #FEE5C0 0%, #F5CE9B 50%, #F8D5A5 100%);
		color: #000000;
	}

	.error-404-btn:hover::before {
		left: 100%;
	}

	.error-404-btn:active {
		background: linear-gradient(to right, #FCD9A4 0%, #F3C17B 50%, #F6C88B 100%);
	}

	.error-404-btn svg {
		width: 18px;
		height: 18px;
		transition: transform 0.3s ease;
		position: relative;
		z-index: 1;
	}

	.error-404-btn-text {
		position: relative;
		z-index: 1;
	}

	.error-404-btn:hover svg {
		transform: translateX(-5px);
	}

	/* Decorative elements */
	.error-404-decoration {
		position: absolute;
		width: 300px;
		height: 300px;
		border: 1px solid rgba(253, 223, 174, 0.15);
		border-radius: 50%;
		pointer-events: none;
	}

	.error-404-decoration-1 {
		top: -100px;
		right: -100px;
		animation: pulse 4s ease-in-out infinite;
	}

	.error-404-decoration-2 {
		bottom: -150px;
		left: -150px;
		width: 400px;
		height: 400px;
		animation: pulse 4s ease-in-out infinite 2s;
	}

	@keyframes pulse {

		0%,
		100% {
			opacity: 0.3;
			transform: scale(1);
		}

		50% {
			opacity: 0.6;
			transform: scale(1.05);
		}
	}

	/* Road lines decoration */
	.road-lines {
		position: absolute;
		bottom: 0;
		left: 0;
		right: 0;
		height: 200px;
		overflow: hidden;
		pointer-events: none;
	}

	.road-line {
		position: absolute;
		left: 50%;
		bottom: 0;
		width: 4px;
		height: 40px;
		background: rgba(244, 197, 139, 0.3);
		transform: translateX(-50%);
		animation: roadMove 2s linear infinite;
	}

	.road-line:nth-child(1) {
		animation-delay: 0s;
	}

	.road-line:nth-child(2) {
		animation-delay: 0.5s;
	}

	.road-line:nth-child(3) {
		animation-delay: 1s;
	}

	.road-line:nth-child(4) {
		animation-delay: 1.5s;
	}

	@keyframes roadMove {
		0% {
			bottom: 200px;
			opacity: 0;
		}

		20% {
			opacity: 1;
		}

		80% {
			opacity: 1;
		}

		100% {
			bottom: -50px;
			opacity: 0;
		}
	}

	/* Mobile adjustments */
	@media (max-width: 768px) {
		.error-404-page {
			padding: 60px 20px;
		}

		.error-404-code {
			gap: 5px;
			margin-bottom: 30px;
		}

		.error-404-btn {
			padding: 16px 32px;
			font-size: 13px;
		}

		.error-404-decoration {
			display: none;
		}
	}

	@media (max-width: 480px) {
		.error-404-title {
			letter-spacing: 0.02em;
		}

		.error-404-subtitle {
			margin-bottom: 35px;
		}
	}
</style>

<main id="primary" class="site-main">
	<section class="error-404-page">
		<!-- Decorative circles -->
		<div class="error-404-decoration error-404-decoration-1"></div>
		<div class="error-404-decoration error-404-decoration-2"></div>

		<!-- Road lines animation -->
		<div class="road-lines">
			<div class="road-line"></div>
			<div class="road-line"></div>
			<div class="road-line"></div>
			<div class="road-line"></div>
		</div>

		<div class="error-404-container">
			<div class="error-404-code">
				<span class="error-404-digit">4</span>

				<!-- Animated Steering Wheel as "0" -->
				<div class="steering-wheel-container">
					<div class="steering-wheel">
						<svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
							<!-- Outer ring -->
							<circle cx="50" cy="50" r="46" stroke="#c9a962" stroke-width="3" fill="none" />
							<circle cx="50" cy="50" r="40" stroke="#c9a962" stroke-width="1.5" fill="none" opacity="0.5" />

							<!-- Center hub -->
							<circle cx="50" cy="50" r="12" stroke="#c9a962" stroke-width="2" fill="none" />
							<circle cx="50" cy="50" r="5" fill="#c9a962" />

							<!-- Spokes -->
							<line x1="50" y1="38" x2="50" y2="14" stroke="#c9a962" stroke-width="3" stroke-linecap="round" />
							<line x1="38.5" y1="56" x2="18" y2="68" stroke="#c9a962" stroke-width="3" stroke-linecap="round" />
							<line x1="61.5" y1="56" x2="82" y2="68" stroke="#c9a962" stroke-width="3" stroke-linecap="round" />

							<!-- Decorative dots -->
							<circle cx="50" cy="8" r="2" fill="#c9a962" />
							<circle cx="14" cy="72" r="2" fill="#c9a962" />
							<circle cx="86" cy="72" r="2" fill="#c9a962" />
						</svg>
					</div>
				</div>

				<span class="error-404-digit">4</span>
			</div>

			<h1 class="error-404-title">Lost on the road?</h1>
			<p class="error-404-subtitle">The page you're looking for seems to have taken a different route. Let us navigate you back to safety.</p>

			<a href="<?php echo esc_url(home_url('/')); ?>" class="error-404-btn">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<line x1="19" y1="12" x2="5" y2="12"></line>
					<polyline points="12 19 5 12 12 5"></polyline>
				</svg>
				<span class="error-404-btn-text">Return Home</span>
			</a>
		</div>
	</section>
</main>

<?php get_footer(); ?>
