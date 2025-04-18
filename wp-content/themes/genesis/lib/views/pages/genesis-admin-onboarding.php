<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package StudioPress\Genesis
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

$genesis_active_theme         = wp_get_theme();
$genesis_onboarding_plugins   = genesis_onboarding_plugins();
$genesis_onboarding_content   = genesis_onboarding_content();
$genesis_onboarding_nav_menus = genesis_onboarding_navigation_menus();
?>
<div class="wrap">
	<div class="genesis-onboarding-page-wrap">
		<main class="genesis-onboarding-main">
			<h1 class="genesis-onboarding-intro-title">
				<?php
				/* translators: %s: Theme name */
				echo esc_html( sprintf( __( 'Get started with %s.', 'genesis' ), $genesis_active_theme['Name'] ) );
				?>
			</h1>
			<p class="genesis-onboarding-intro-text">
				<?php
				/* translators: %s: Theme name */
				echo esc_html( sprintf( __( '%s supports automatic set up and import of demo content and/or recommended plugins.', 'genesis' ), esc_html( $genesis_active_theme['Name'] ) ) );
				?>
			</p>
			<p class="genesis-onboarding-intro-text">
				<?php
				esc_html_e( 'Use the "Set Up Your Website" button to get started. None of your existing content will be lost.', 'genesis' );
				?>
			</p>
			<div class="genesis-onboarding-progress-bar-wrapper">
				<span id="genesis-onboarding-progress-bar"></span>
			</div>

			<button id="genesis-onboarding-start" class="genesis-onboarding-button genesis-onboarding-button-blue" data-task="dependencies" data-step="0"><?php esc_html_e( 'Set up your website', 'genesis' ); ?></button>
			<a id="genesis-onboarding-settings-link" class="genesis-onboarding-button genesis-onboarding-button-alt" href="<?php echo esc_url( admin_url( 'customize.php?return=' . admin_url( 'admin.php?page=genesis-getting-started' ) ) ); ?>"><?php esc_html_e( 'Or go to Theme Settings', 'genesis' ); ?></a>

			<ul class="genesis-onboarding-list">
				<?php if ( $genesis_onboarding_plugins ) : ?>
				<li class="genesis-onboarding-task-dependencies">
					<div class="genesis-onboarding-task-steps">
						<div class="genesis-onboarding-step-one"></div>
						<div class="genesis-onboarding-step-two">
							<svg class="genesis-onboarding-list-spinner" viewBox="0 0 50 50" aria-hidden="true">
								<circle class="path" cx="25" cy="25" r="23" fill="none" stroke-width="4"></circle>
							</svg>
						</div>
						<div class="genesis-onboarding-step-three">
							<svg style="width:40px; height:40px;" viewBox="0 0 10 10" aria-hidden="true">
								<circle cx="5" cy="5" r="4.5" style="stroke:#6c8196; stroke-width:0.7; fill:none;"></circle>
								<polyline points="2.7,5 4.2,6.7 7.5,3.6" style="stroke:#6c8196; stroke-width:0.7; stroke-linejoin:round; stroke-linecap:round; fill:none;"></polyline>
							</svg>
						</div>
					</div>

					<h3><?php esc_html_e( 'Recommended plugins', 'genesis' ); ?></h3>
					<p><?php esc_html_e( 'The following plugins will be automatically installed and activated with this theme (links open in new window):', 'genesis' ); ?></p>
					<?php echo wp_kses_post( genesis_onboarding_plugins_list() ); ?>
				</li>
				<?php endif; ?>

				<?php if ( $genesis_onboarding_content || $genesis_onboarding_nav_menus ) : ?>
				<li class="genesis-onboarding-task-content">
					<div class="genesis-onboarding-task-steps">
						<div class="genesis-onboarding-step-one"></div>
						<div class="genesis-onboarding-step-two">
							<svg class="genesis-onboarding-list-spinner" viewBox="0 0 50 50" aria-hidden="true">
								<circle class="path" cx="25" cy="25" r="23" fill="none" stroke-width="4"></circle>
							</svg>
						</div>
						<div class="genesis-onboarding-step-three">
							<svg style="width:40px; height:40px;" viewBox="0 0 10 10" aria-hidden="true">
								<circle cx="5" cy="5" r="4.5" style="stroke:#6c8196; stroke-width:0.7; fill:none;"></circle>
								<polyline points="2.7,5 4.2,6.7 7.5,3.6" style="stroke:#6c8196; stroke-width:0.7; stroke-linejoin:round; stroke-linecap:round; fill:none;"></polyline>
							</svg>
						</div>
					</div>

					<h3><?php esc_html_e( 'Demo content', 'genesis' ); ?></h3>
					<p>
						<?php
						esc_html_e( 'Sample content for the theme will be added to make your theme look like the demo.', 'genesis' );
						if ( isset( $genesis_onboarding_content['homepage'] ) ) {
							echo ' ';
							esc_html_e( 'This will change your default homepage.', 'genesis' );
						}
						?>
					</p>
				</li>
				<?php endif; ?>

				<li class="genesis-onboarding-task-final">
					<div class="genesis-onboarding-task-steps">
						<div class="genesis-onboarding-step-one"></div>
						<div class="genesis-onboarding-step-two">
							<svg class="genesis-onboarding-list-spinner" viewBox="0 0 50 50" aria-hidden="true">
								<circle class="path" cx="25" cy="25" r="23" fill="none" stroke-width="4"></circle>
							</svg>
						</div>
						<div class="genesis-onboarding-step-three">
							<svg style="width:40px; height:40px;" viewBox="0 0 10 10" aria-hidden="true">
								<circle cx="5" cy="5" r="4.5" style="stroke:#6c8196; stroke-width:0.7; fill:none;"></circle>
								<polyline points="2.7,5 4.2,6.7 7.5,3.6" style="stroke:#6c8196; stroke-width:0.7; stroke-linejoin:round; stroke-linecap:round; fill:none;"></polyline>
							</svg>
						</div>
					</div>

					<h3><?php esc_html_e( 'All done!', 'genesis' ); ?></h3>
					<p><?php esc_html_e( 'Your website setup is complete! View or edit your homepage using the buttons below.', 'genesis' ); ?></p>

					<a id="genesis-onboarding-view-homepage" class="genesis-onboarding-button genesis-onboarding-button-blue" href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( 'View your homepage', 'genesis' ); ?></a>
					<a id="genesis-onboarding-edit-homepage" class="genesis-onboarding-button genesis-onboarding-button-blue" href="#"><?php esc_html_e( 'Edit your homepage', 'genesis' ); ?></a>
				</li>
			</ul>
		</main>

		<aside class="genesis-onboarding-sidebar">
			<section>
				<h3><?php esc_html_e( 'Helpful Links', 'genesis' ); ?></h3>
				<p><?php esc_html_e( 'Learn about the new WordPress editor (Gutenberg) and building with content blocks by using these resources below.', 'genesis' ); ?></p>
				<ul>
					<li><a href="https://wordpress.org/gutenberg/"><?php esc_html_e( 'Gutenberg Intro', 'genesis' ); ?></a></li>
					<li><a href="https://studiopress.blog"><?php esc_html_e( 'StudioPress Blog', 'genesis' ); ?></a></li>
					<li><a href="https://gutenberg.news"><?php esc_html_e( 'Gutenberg News', 'genesis' ); ?></a></li>
					<li><a href="https://atomicblocks.com"><?php esc_html_e( 'Atomic Blocks', 'genesis' ); ?></a></li>
				</ul>
			</section>
		</aside>
	</div><!-- .genesis-onboarding-page-wrap -->
</div>
