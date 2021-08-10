<?php
/**
 * Aino functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Aino
 */

if ( ! function_exists( 'aino_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function aino_setup() {
		/**
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		*/
		load_theme_textdomain( 'aino', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1500, 99999 );

		/**
		 * Adds custom image sizes.
		 */
		add_image_size( 'aino-thumb', 1440, 810, true ); // Image Ratio 16:9.

		// Custom logo.
		$logo_width  = 170;
		$logo_height = 48;

		// If the retina setting is active, double the recommended width and height.
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width * 2 );
			$logo_height = floor( $logo_height * 2 );
		}

		// Add support for core custom logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => $logo_height,
				'width'       => $logo_width,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Register Navigation menus.
		register_nav_menus(
			array(
				'primary'       => esc_html__( 'Primary Menu', 'aino' ),
			)
		);

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( array( 'style-editor.min.css', aino_fonts_url() ) );

		// Add support for experimental link colour in blocks.
		add_theme_support('experimental-link-color');

		// Add support for custom custom line-heights in blocks.
		add_theme_support( 'custom-line-height' );

		// Add support for custom units in blocks.
		add_theme_support( 'custom-units' );

		// Remove core block patterns, since Aino ships its own patterns via the Aino blocks plugin.
		remove_theme_support( 'core-block-patterns' );

		// Add support for the WooCommerce eCommerce plugin.
		add_theme_support( 'woocommerce', array(
			'thumbnail_image_width' => 600,
			'single_image_width'	=> 1200,
		) );

		// Disable WooCommerce default styling.
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );

		remove_theme_support( 'wc-product-gallery-zoom' );
		remove_theme_support( 'wc-product-gallery-lightbox' );
		remove_theme_support( 'wc-product-gallery-slider' );

	}
	endif;
	add_action( 'after_setup_theme', 'aino_setup' );

/**
 * Enqueue scripts and styles.
 */
function aino_scripts() {

	// Enqueue fonts stylesheet.
	wp_enqueue_style( 'aino-fonts', aino_fonts_url(), array(), wp_get_theme()->get( 'Version' ) );

	// Theme stylesheet.
	wp_enqueue_style( 'aino-style', get_template_directory_uri() . '/style.min.css', false, wp_get_theme()->get( 'Version' ) );

}
add_action( 'wp_enqueue_scripts', 'aino_scripts' );

/**
 * Get Google fonts.
 */
/**
 * Register custom fonts.
 */
function aino_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Arimo, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$arimo = esc_html_x( 'on', 'Arimo font: on or off', 'aino' );

	if ( 'off' !== $arimo ) {
		$font_families = array();

		if ( 'off' !== $arimo ) {
			$font_families[] = 'Arimo:ital,wght@0,400;0,700;1,400;1,700&display=swap';
		}

		$query_args = array(
			'family' => rawurlencode( implode( '|', $font_families ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

// Separate WooCommerce User Registration form
function aino_separate_wc_registration_form() {
	if ( is_admin() ) return;
	if ( is_user_logged_in() ) return;
	ob_start();

	// Form copied from /woocommerce/myaccount/form-login.php (version 4.1.0) Update as needed.
	do_action( 'woocommerce_before_customer_login_form' ); ?>

	<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	<div class="u-columns col2-set" id="customer_login">

		<div class="u-column2 col-2">

			<?php endif; ?>

			<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</p>

				<?php endif; ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
					</p>

				<?php else : ?>

					<p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

				<?php endif; ?>

				<?php do_action( 'woocommerce_register_form' ); ?>

				<p class="woocommerce-form-row form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Sign up', 'woocommerce' ); ?>"><?php esc_html_e( 'Sign up', 'woocommerce' ); ?></button>
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>

	<?php

	return ob_get_clean();

}
add_shortcode( 'woocommerce_registration_form', 'aino_separate_wc_registration_form' );

// Separate WooCommerce User Login form
function aino_separate_wc_login_form() {
	if ( is_admin() ) return;
	if ( is_user_logged_in() ) return;
	ob_start();

	// Form copied from /woocommerce/myaccount/form-login.php (version 4.1.0) Update as needed.
	do_action( 'woocommerce_before_customer_login_form' ); ?>

	<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	<div class="u-columns col2-set" id="customer_login">

		<div class="u-column1 col-1">

			<?php endif; ?>

			<form class="woocommerce-form woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
				</label>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
			</p>
			<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

	<?php

	return ob_get_clean();

}
add_shortcode( 'woocommerce_login_form', 'aino_separate_wc_login_form' );

// Separate WooCommerce User reset password form
function aino_separate_wc_resetpassword_form() {
	if ( is_admin() ) return;
	if ( is_user_logged_in() ) return;
	ob_start();

	// Form copied from /woocommerce/myaccount/form-login.php (version 4.1.0) Update as needed.
	do_action( 'woocommerce_before_lost_password_form' ); ?>

		<form method="post" class="woocommerce-ResetPassword lost_reset_password">

			<p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

			<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
				<label for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" />
			</p>

			<div class="clear"></div>

			<?php do_action( 'woocommerce_lostpassword_form' ); ?>

			<p class="woocommerce-form-row form-row">
				<input type="hidden" name="wc_reset_password" value="true" />
				<button type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
			</p>

			<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

		</form>

	<?php

	return ob_get_clean();

}
add_shortcode( 'woocommerce_resetpassword_form', 'aino_separate_wc_resetpassword_form' );

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/defaults.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/sanitization-callbacks.php';

// SVG icons functions and filters.
require get_parent_theme_file_path( '/inc/icon-functions.php' );

// Aino Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Aino Block Styles.
require get_template_directory() . '/inc/block-styles.php';

/**
 * TGMPA plugin activation.
 */
require_once get_template_directory() . '/inc/classes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'aino_register_required_plugins' );

/** Add a checkbox to hide the Site Editor */
require get_template_directory() . '/inc/disable-site-editor.php';

/**
 * Register the required plugins for this theme.
 */
function aino_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 */
	$plugins = array(

		array(
			'name'      => 'Gutenberg',
			'slug'      => 'gutenberg',
			'required'  => true,
		),
		array(
			'name'      => 'Aino Blocks - Creative Block Collection',
			'slug'      => 'aino-blocks',
			'required'  => true,
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 */
	$config = array(
		'id'           => 'aino',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}
