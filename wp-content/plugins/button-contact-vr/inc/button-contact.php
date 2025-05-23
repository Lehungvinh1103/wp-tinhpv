<?php

final class PZF
{

	protected static $_instance = null;

	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct()
	{
		add_action('plugins_loaded', array($this, 'init_hooks'));
	}

	public function init_hooks()
	{
		add_action('wp_footer', array($this, 'pzf_frontend')); // add frontend to footer	
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts')); //add style to frontend	
		add_action('admin_enqueue_scripts', array($this, 'mw_enqueue_color_picker')); // add scripts to frontend
	}

	//add style to frontend
	public function enqueue_scripts()
	{
		wp_enqueue_style('pzf-style', PZF_URL . 'css/style.css', array(), 1);
	}
	// public function enqueue_scripts() {
	// }

	// add scripts to frontend
	function mw_enqueue_color_picker()
	{
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('my-script-handle', PZF_URL . 'js/script.js', array('wp-color-picker'), 1, true);
	}

	// add frontend to footer theme
	public function pzf_frontend()
	{ ?>
		<!-- if gom all in one show -->
		<?php if (get_option('pzf_hide_default_all_in_one')) {
			$class_active_allinone = '';
		} elseif (!get_option('pzf_enable_all_in_one')) {
			$class_active_allinone = '';
		} else {
			$class_active_allinone = 'active';
		} ?>
		<div id="button-contact-vr" class="<?php echo esc_html($class_active_allinone); ?>">
			<div id="gom-all-in-one"><!-- v3 -->
				<?php
				if (get_option('pzf_linkggmap')) {
				?>
					<!-- map -->
					<div id="map-vr" class="button-contact">
						<div class="phone-vr">
							<div class="phone-vr-circle-fill"></div>
							<div class="phone-vr-img-circle">
								<a target="_blank" href="<?php echo esc_html(get_option('pzf_linkggmap')); ?>">
									<img alt="google map" src="<?php echo esc_url(PZF_URL) . 'img/showroom4.png'; ?>" />
								</a>
							</div>
						</div>
					</div>
					<!-- end map -->
				<?php }; ?>

				<?php
				if (get_option('pzf_contact_link')) {
				?>
					<!-- contact -->
					<div id="contact-vr" class="button-contact">
						<div class="phone-vr">
							<div class="phone-vr-circle-fill"></div>
							<div class="phone-vr-img-circle">
								<a href="<?php echo esc_html(get_option('pzf_contact_link')); ?>">
									<img alt="Liên hệ" src="<?php echo esc_url(PZF_URL) . 'img/contact.png'; ?>" />
								</a>
							</div>
						</div>
					</div>
					<!-- end contact -->
				<?php }; ?>

				<?php
				if (get_option('pzf_viber')) {
				?>
					<!-- viber -->
					<div id="viber-vr" class="button-contact">
						<div class="phone-vr">
							<div class="phone-vr-circle-fill"></div>
							<div class="phone-vr-img-circle">
								<a target="_blank" href="viber://add?number=<?php echo esc_html(preg_replace('/\D/', '', get_option('pzf_viber'))); ?>">
									<img alt="Viber" src="<?php echo esc_url(PZF_URL) . 'img/viber.png'; ?>" />
								</a>
							</div>
						</div>
					</div>
					<!-- end viber -->
				<?php }; ?>

				<?php
				if (get_option('pzf_linkfanpage')) {
				?>
					<!-- fanpage -->
					<div id="fanpage-vr" class="button-contact">
						<div class="phone-vr">
							<div class="phone-vr-circle-fill"></div>
							<div class="phone-vr-img-circle">
								<a target="_blank" href="<?php echo esc_url(get_option('pzf_linkfanpage')); ?>">
									<img alt="Fanpage" src="<?php echo esc_url(PZF_URL) . 'img/Facebook.png'; ?>" />
								</a>
							</div>
						</div>
					</div>
					<!-- end fanpage -->
				<?php }; ?>


				<?php
				if (get_option('pzf_linkmessenger')) {
				?>
					<!-- messenger -->
					<div id="messenger-vr" class="button-contact">
						<div class="phone-vr">
							<div class="phone-vr-circle-fill"></div>
							<div class="phone-vr-img-circle">
								<a target="_blank" href="<?php echo esc_url(get_option('pzf_linkmessenger')); ?>">
									<img alt="messenger" src="<?php echo esc_url(PZF_URL) . 'img/messenger.png'; ?>" />
								</a>
							</div>
						</div>
					</div>
					<!-- end messenger -->
				<?php }; ?>

				<?php
				if (get_option('pzf_tiktok')) {
				?>
					<!-- tiktok -->
					<div id="tiktok-vr" class="button-contact">
						<div class="phone-vr">
							<div class="phone-vr-circle-fill"></div>
							<div class="phone-vr-img-circle">
								<a target="_blank" href="<?php echo esc_url(get_option('pzf_tiktok')); ?>">
									<img alt="tiktok" src="<?php echo esc_url(PZF_URL) . 'img/tiktok.png'; ?>" />
								</a>
							</div>
						</div>
					</div>
					<!-- end tiktok -->
				<?php }; ?>

				<?php
				if (get_option('pzf_telegram')) {
				?>
					<!-- telegram -->
					<div id="telegram-vr" class="button-contact">
						<div class="phone-vr">
							<div class="phone-vr-circle-fill"></div>
							<div class="phone-vr-img-circle">
								<a target="_blank" href="<?php echo esc_url(get_option('pzf_telegram')); ?>">
									<img alt="telegram" src="<?php echo esc_url(PZF_URL) . 'img/telegram.png'; ?>" />
								</a>
							</div>
						</div>
					</div>
					<!-- end telegam -->
				<?php }; ?>

				<?php
				if (get_option('pzf_instagram')) {
				?>
					<!-- instagram -->
					<div id="instagram-vr" class="button-contact">
						<div class="phone-vr">
							<div class="phone-vr-circle-fill"></div>
							<div class="phone-vr-img-circle">
								<a target="_blank" href="<?php echo esc_url(get_option('pzf_instagram')); ?>">
									<img alt="Instagram" src="<?php echo esc_url(PZF_URL) . 'img/instagram.png'; ?>" />
								</a>
							</div>
						</div>
					</div>
					<!-- end instagram -->
				<?php }; ?>

				<?php
				if (get_option('pzf_youtube')) {
				?>
					<!-- youtube -->
					<div id="youtube-vr" class="button-contact">
						<div class="phone-vr">
							<div class="phone-vr-circle-fill"></div>
							<div class="phone-vr-img-circle">
								<a target="_blank" href="<?php echo esc_url(get_option('pzf_youtube')); ?>">
									<img alt="youtube" src="<?php echo esc_url(PZF_URL) . 'img/youtube.png'; ?>" />
								</a>
							</div>
						</div>
					</div>
					<!-- end youtube -->
				<?php }; ?>

				<?php
				if (get_option('pzf_zalo')) {
				?>
					<!-- zalo -->
					<div id="zalo-vr" class="button-contact">
						<div class="phone-vr">
							<div class="phone-vr-circle-fill"></div>
							<div class="phone-vr-img-circle">
								<a target="_blank" href="https://zalo.me/<?php echo esc_html(preg_replace('/\D/', '', get_option('pzf_zalo'))); ?>">
									<img alt="Zalo" src="<?php echo esc_url(PZF_URL) . 'img/zalo.png'; ?>" />
								</a>
							</div>
						</div>
					</div>
					<!-- end zalo -->
				<?php }; ?>

				<?php
				if (get_option('pzf_whatsapp')) {
				?>
					<!-- whatsapp -->
					<div id="whatsapp-vr" class="button-contact">
						<div class="phone-vr">
							<div class="phone-vr-circle-fill"></div>
							<div class="phone-vr-img-circle">
								<a target="_blank" href=" https://wa.me/<?php echo esc_html(preg_replace('/\D/', '', get_option('pzf_whatsapp'))); ?>">
									<img alt="Whatsapp" src="<?php echo esc_url(PZF_URL) . 'img/whatsapp.png'; ?>" />
								</a>
							</div>
						</div>
					</div>
					<!-- end whatsapp -->
				<?php }; ?>

				<?php
				if (get_option('pzf_phone')) {
				?>
					<!-- Phone -->
					<div id="phone-vr" class="button-contact">
						<div class="phone-vr">
							<div class="phone-vr-circle-fill"></div>
							<div class="phone-vr-img-circle">
								<a href="tel:<?php echo esc_html(preg_replace('/\D/', '', get_option('pzf_phone'))); ?>">
									<img alt="Phone" src="<?php echo esc_url(PZF_URL) . 'img/phone.png'; ?>" />
								</a>
							</div>
						</div>
					</div>
					<?php
					if (get_option('pzf_phone_bar') == '1') { ?>
						<div class="phone-bar phone-bar-n">
							<a href="tel:<?php echo esc_html(preg_replace('/\D/', '', get_option('pzf_phone'))); ?>">
								<span class="text-phone"><?php echo esc_html(preg_replace('/\D/', '', get_option('pzf_phone'))); ?>
								</span>
							</a>
						</div>
					<?php }; ?>
					<!-- end phone -->

				<?php }; ?>
				<?php
				if (get_option('pzf_phone2')) {
				?>
					<!-- Phone -->
					<div id="phone-vr2" class="button-contact">
						<div class="phone-vr">
							<div class="phone-vr-circle-fill"></div>
							<div class="phone-vr-img-circle">
								<a href="tel:<?php echo esc_html(preg_replace('/\D/', '', get_option('pzf_phone2'))); ?>">
									<img alt="phone" src="<?php echo esc_url(PZF_URL) . 'img/phone.png'; ?>" />
								</a>
							</div>
						</div>
					</div>
					<?php
					if (get_option('pzf_phone_bar') == '1') { ?>
						<div class="phone-bar phone-bar2 phone-bar-n">
							<a href="tel:<?php echo esc_html(preg_replace('/\D/', '', get_option('pzf_phone2'))); ?>">
								<span class="text-phone"><?php echo esc_html(preg_replace('/\D/', '', get_option('pzf_phone2'))); ?></span>
							</a>
						</div>
					<?php }; ?>
					<!-- end phone 2 -->

				<?php }; ?>
				<?php
				if (get_option('pzf_phone3')) {
				?>
					<!-- Phone3 -->
					<div id="phone-vr3" class="button-contact">
						<div class="phone-vr">
							<div class="phone-vr-circle-fill"></div>
							<div class="phone-vr-img-circle">
								<a href="tel:<?php echo esc_html(preg_replace('/\D/', '', get_option('pzf_phone3'))); ?>">
									<img alt="Phone" src="<?php echo esc_url(PZF_URL) . 'img/phone.png'; ?>" />
								</a>
							</div>
						</div>
					</div>
					<?php
					if (get_option('pzf_phone_bar') == '1') { ?>
						<div class="phone-bar phone-bar3 phone-bar-n">
							<a href="tel:<?php echo esc_html(preg_replace('/\D/', '', get_option('pzf_phone3'))); ?>">
								<span class="text-phone"><?php echo esc_html(preg_replace('/\D/', '', get_option('pzf_phone3'))); ?></span>
							</a>
						</div>
					<?php }; ?>
					<!-- end phone 3-->

				<?php }; ?>
			</div><!-- end v3 class gom-all-in-one -->

			<?php
			if (get_option('pzf_enable_all_in_one')) { ?>
				<div id="all-in-one-vr" class="button-contact">
					<div class="phone-vr">
						<div class="phone-vr-circle-fill"></div>
						<div class="phone-vr-img-circle">
							<img alt="All in one" src="<?php echo esc_url(PZF_URL) . 'img/icon' . esc_html(get_option('pzf_icon_all_in_one')) . '.png'; ?>" />
						</div>
					</div>
					<?php
					if (get_option('pzf_note_bar_all_in_one') == '1') { ?>
						<div class="phone-bar" style="background-color: <?php echo esc_html(get_option('pzf_color_all_in_one')); ?>;">
							<span class="text-phone"><?php echo esc_html(get_option('pzf_note_all_in_one')); ?></span>
						</div>
					<?php }; ?>
				</div>
				<style type="text/css">
					.phone-bar-n {
						display: none;
					}
				</style>
			<?php }; ?>

		</div>

		<!-- Add custom css and js -->
		<?php //echo get_option('pzf_add_js'); 
		?>

		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('#all-in-one-vr').click(function() {
					$('#button-contact-vr').toggleClass('active');
				})
				$('#contact-form-vr').click(function() {
					$('#popup-form-contact-vr').addClass('active');
				})
				$('div#popup-form-contact-vr .bg-popup-vr,div#popup-form-contact-vr .content-popup-vr .close-popup-vr').click(function() {
					$('#popup-form-contact-vr').removeClass('active');
				})
				$('#contact-showroom').click(function() {
					$('#popup-showroom-vr').addClass('active');
				})
				$('div#popup-showroom-vr .bg-popup-vr,.content-popup-vr .close-popup-vr').click(function() {
					$('#popup-showroom-vr').removeClass('active');
				})
			});
		</script>

		<!-- end Add custom css and js -->


		<?php if (get_option('pzf_color_phone')) { ?>
			<!-- color phone -->
			<style>
				.phone-bar a,
				#phone-vr .phone-vr-circle-fill,
				#phone-vr .phone-vr-img-circle,
				#phone-vr .phone-bar a {
					background-color: <?php echo esc_html(get_option('pzf_color_phone')); ?>;
				}

				#phone-vr .phone-vr-circle-fill {
					opacity: 0.7;
					box-shadow: 0 0 0 0 <?php echo esc_html(get_option('pzf_color_phone')); ?>;
				}

				.phone-bar2 a,
				#phone-vr2 .phone-vr-circle-fill,
				#phone-vr2 .phone-vr-img-circle,
				#phone-vr2 .phone-bar a {
					background-color: <?php echo esc_html(get_option('pzf_color_phone2')); ?>;
				}

				#phone-vr2 .phone-vr-circle-fill {
					opacity: 0.7;
					box-shadow: 0 0 0 0 <?php echo esc_html(get_option('pzf_color_phone2')); ?>;
				}

				.phone-bar3 a,
				#phone-vr3 .phone-vr-circle-fill,
				#phone-vr3 .phone-vr-img-circle,
				#phone-vr3 .phone-bar a {
					background-color: <?php echo esc_html(get_option('pzf_color_phone3')); ?>;
				}

				#phone-vr3 .phone-vr-circle-fill {
					opacity: 0.7;
					box-shadow: 0 0 0 0 <?php echo esc_html(get_option('pzf_color_phone3')); ?>;
				}
			</style>
			<!-- color phone -->
		<?php }; ?>

		<?php if (get_option('pzf_color_contact_form')) { ?>
			<!-- color contact form -->
			<style>
				.phone-bar a,
				#contact-form-vr .phone-vr-circle-fill,
				#contact-form-vr .phone-vr-img-circle,
				#contact-form-vr .phone-bar a {
					background-color: <?php echo esc_html(get_option('pzf_color_contact_form')); ?>;
				}

				#contact-form-vr .phone-vr-circle-fill {
					opacity: 0.7;
					box-shadow: 0 0 0 0 <?php echo esc_html(get_option('pzf_color_contact_form')); ?>;
				}
			</style>
			<!-- color contact form -->
		<?php }; ?>

		<?php if (get_option('pzf_color_contact')) { ?>
			<style>
				#contact-vr .phone-vr-circle-fill,
				#contact-vr .phone-vr-img-circle {
					background-color: <?php echo esc_html(get_option('pzf_color_contact')); ?>;
				}

				#contact-vr .phone-vr-circle-fill {
					opacity: 0.7;
					box-shadow: 0 0 0 0 <?php echo esc_html(get_option('pzf_color_contact')); ?>;
				}
			</style>
		<?php }; ?>

		<?php if (esc_html(get_option('pzf_color_linkggmap'))) { ?>
			<style>
				#map-vr .phone-vr-circle-fill,
				#map-vr .phone-vr-img-circle {
					background-color: <?php echo esc_html(get_option('pzf_color_linkggmap')); ?>;
				}

				#map-vr .phone-vr-circle-fill {
					opacity: 0.7;
					box-shadow: 0 0 0 0 <?php echo esc_html(get_option('pzf_color_linkggmap')); ?>;
				}
			</style>
		<?php }; ?>

		<?php if (esc_html(get_option('pzf_color_showroom'))) { ?>
			<!-- color showroom -->
			<style>
				#contact-showroom .phone-vr-circle-fill,
				#contact-showroom .phone-vr-img-circle {
					background-color: <?php echo esc_html(get_option('pzf_color_showroom')); ?>;
				}

				#contact-showroom .phone-vr-circle-fill {
					opacity: 0.7;
					box-shadow: 0 0 0 0 <?php echo esc_html(get_option('pzf_color_showroom')); ?>;
				}
			</style>
		<?php }; ?>
		<?php if (esc_html(get_option('pzf_color_all_in_one'))) { ?>
			<!-- color all in one -->
			<style>
				#all-in-one-vr .phone-vr-circle-fill,
				#all-in-one-vr .phone-vr-img-circle {
					background-color: <?php echo esc_html(get_option('pzf_color_all_in_one')); ?>;
				}

				#all-in-one-vr .phone-vr-circle-fill {
					opacity: 0.7;
					box-shadow: 0 0 0 0 <?php echo esc_html(get_option('pzf_color_all_in_one')); ?>;
				}
			</style>
		<?php }; ?>

		<?php if (esc_html(get_option('setting_size'))) { ?>
			<!-- size scale -->
			<style>
				#button-contact-vr {
					transform: scale(<?php echo esc_html(get_option('setting_size')); ?>);
				}
			</style>
			<?php
			if (esc_html(get_option('setting_size')) < 0.9) { ?>
				<style>
					#button-contact-vr {
						margin: -10px;
					}
				</style>
			<?php
			} elseif (get_option('setting_size') > 1.3) { ?>
				<style>
					#button-contact-vr {
						margin: 10px;
					}
				</style>
		<?php };
		}; ?>

		<?php if (get_option('pzf_location') == 'right') { ?>
			<!-- location left right -->
			<style>
				#button-contact-vr {
					right: 0;
				}

				.phone-bar a {
					left: auto;
					right: 30px;
					padding: 8px 55px 7px 15px;
				}

				#button-contact-vr.active #gom-all-in-one .button-contact {
					margin-left: 100%;
				}
			</style>
		<?php }; ?>

		<?php if (get_option('pzf_location_bottom')) { ?>
			<!-- location bottom -->
			<style>
				#button-contact-vr {
					bottom: <?php echo esc_html(get_option('pzf_location_bottom')); ?>%;
				}
			</style>
		<?php }; ?>

		<?php if (get_option('pzf_hide_mobile')) { ?>
			<!-- hide mobile -->
			<style>
				@media(max-width: 736px) {
					#button-contact-vr {
						display: none;
					}
				}
			</style>
		<?php }; ?>

		<?php if (get_option('pzf_hide_desktop')) { ?>
			<!-- hide desktop -->
			<style>
				@media(min-width: 736px) {
					#button-contact-vr {
						display: none;
					}
				}
			</style>
		<?php }; ?>
		<?php if (get_option('pzf_off_effects')) { ?>
			<!-- hide desktop -->
			<style>
				.phone-vr-img-circle {
					animation: none;
				}

				.phone-vr-circle-fill {
					animation: none;
				}
			</style>
<?php };
	} // add frontend to footer theme
}
?>