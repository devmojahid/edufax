<?php

/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

do_action('woocommerce_before_customer_login_form');


$woocommerce_enable_myaccount_registration = get_option('woocommerce_enable_myaccount_registration');
$form_col = get_option('woocommerce_enable_myaccount_registration') === 'yes' ? 'col-lg-6' : 'col-lg-6';
$form_row = get_option('woocommerce_enable_myaccount_registration') === 'yes' ? '' : 'justify-content-center';

?>



<div class="row <?php echo esc_attr($form_row); ?>" id="customer_login">

	<div class="<?php echo esc_attr($form_col); ?>">
		<div class="tp-woo-input-field tp-woo-form-login">
			<h2 class="tp-woo-myaccount-login-title"><?php esc_html_e('Login', 'edufax'); ?></h2>

			<form class="woocommerce-form woocommerce-form-login login" method="post">

				<?php do_action('woocommerce_login_form_start'); ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-row-first ">
					<label for="username"><?php esc_html_e('Username or email address', 'edufax'); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																																			?>
				</p>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-row-last">
					<label for="password"><?php esc_html_e('Password', 'edufax'); ?>&nbsp;<span class="required">*</span></label>
					<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
				</p>

				<?php do_action('woocommerce_login_form'); ?>

				<p class="form-row">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e('Remember me', 'edufax'); ?></span>
					</label>
					<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
					<button type="submit" class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="login" value="<?php esc_attr_e('Log in', 'edufax'); ?>"><?php esc_html_e('Log in', 'edufax'); ?></button>
				</p>
				<p class="woocommerce-LostPassword lost_password">
					<a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'edufax'); ?></a>
				</p>

				<?php do_action('woocommerce_login_form_end'); ?>

			</form>
		</div>
	</div>

	<?php if ('yes' === $woocommerce_enable_myaccount_registration) : ?>
		<div class="col-lg-6">
			<div class="tp-woo-input-field tp-woo-form-login tp-woo-myaccount-register">
				<h2 class="tp-woo-myaccount-login-title"><?php esc_html_e('Register', 'edufax'); ?></h2>

				<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?>>

					<?php do_action('woocommerce_register_form_start'); ?>

					<?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_username"><?php esc_html_e('Username', 'edufax'); ?>&nbsp;<span class="required">*</span></label>
							<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																																						?>
						</p>

					<?php endif; ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_email"><?php esc_html_e('Email address', 'edufax'); ?>&nbsp;<span class="required">*</span></label>
						<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																																	?>
					</p>

					<?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_password"><?php esc_html_e('Password', 'edufax'); ?>&nbsp;<span class="required">*</span></label>
							<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
						</p>

					<?php else : ?>

						<p><?php esc_html_e('A link to set a new password will be sent to your email address.', 'edufax'); ?></p>

					<?php endif; ?>

					<?php do_action('woocommerce_register_form'); ?>

					<p class="woocommerce-form-row form-row">
						<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
						<button type="submit" class="tp-login-btn woocommerce-Button woocommerce-button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e('Register', 'edufax'); ?>"><?php esc_html_e('Register', 'edufax'); ?></button>
					</p>

					<?php do_action('woocommerce_register_form_end'); ?>

				</form>
			</div>
		</div>
	<?php endif; ?>

</div>


<?php do_action('woocommerce_after_customer_login_form'); ?>