<?php

/**
 * @return void
 */
function custom_logo_login() { ?>
    <style>
			body.login {
				background-image: url(/wp-content/plugins/backend-optimize/assets/bg-login.jpg);
			}

			body.login #backtoblog a, body.login #nav a, body.login h1 a {
				color: #FFF;
			}

			#login h1 a, .login h1 a {
				opacity: 0;
			}

			.login form .input, .login input[type=password], .login input[type=text] {
				border-radius: 0;
			}

			.wp-core-ui .button-group.button-large .button, .wp-core-ui .button.button-large {
				border-radius: 0;
			}
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'custom_logo_login' );

function my_login_logo_url() {
	return home_url();
}

add_filter( 'login_headerurl', 'my_login_logo_url' );




