<?php

/**
 * Bct Bookmaker Popup
 *
 * Plugin Name: BCT Bookmaker Popup
 * Version: 1.0.2
 */

require 'plugin-update-checker/plugin-update-checker.php';

$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/sbaglaridis/bct-bookmaker-popup',
	__FILE__,
	'bct-bookmaker-popup'
);

$myUpdateChecker->setBranch( 'master' );
//$myUpdateChecker->setAuthentication( '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' );

//require_once 'vendor/autoload.php';

$cookie = $_COOKIE['bet_popup_closed'];

if ( isset($cookie) && $cookie === 'true' ) {
	return '';
}

define( 'BCT_BOOKMAKERS_PATH', plugin_dir_path( __FILE__ ) );
define( 'BCT_BOOKMAKERS_URL', plugin_dir_url( __FILE__ ) );

const BCT_BOOKMAKERS_VERSION   = '1.0.0';
const BCT_BOOKMAKERS_NAME      = 'BcBookmaker';
const BCT_BOOKMAKERS_TEMPLATES = BCT_BOOKMAKERS_PATH . 'templates';
const BCT_BOOKMAKERS_ASSETS    = BCT_BOOKMAKERS_URL . 'assets';
const BCT_BOOKMAKERS_IMAGES    = BCT_BOOKMAKERS_ASSETS . '/images';
const BCT_BOOKMAKERS_SCRIPTS   = BCT_BOOKMAKERS_ASSETS . '/js';
const BCT_BOOKMAKERS_STYLES    = BCT_BOOKMAKERS_ASSETS . '/css';

//register_activation_hook( __FILE__, 'bct_bookmaker_function_to_run' );

$bct_bookmaker_popup_errors = [];

if ( ! class_exists( 'Redux' ) ) {
	/**
	 * Show notice on plugins page
	 * @return void
	 */

	$bct_bookmaker_popup_errors[] = 'Install and activate Redux framework plugin';
}

if ( count( $bct_bookmaker_popup_errors ) > 0 ) {
	add_action( 'admin_notices', function () use ( $bct_bookmaker_popup_errors ) {
		require_once BCT_BOOKMAKERS_TEMPLATES . '/admin_notice.php';
	} );
} else {
	add_action( 'wp_enqueue_scripts', function () {
		wp_enqueue_style(
			'bct-bookmaker',
			BCT_BOOKMAKERS_STYLES . '/style.css',
			[],
			'1.0.0',
			'all'
		);

		wp_enqueue_script(
			'bct-bookmaker',
			BCT_BOOKMAKERS_SCRIPTS . '/bct-bookmaker.js',
			[],
			'1.0.0',
			true
		);
	} );

	add_action( 'bct_after_body', function () {
		require_once BCT_BOOKMAKERS_TEMPLATES . '/footer-popup.php';
	} );

	add_action( 'bct_bookmaker_btn', function ($args) {
		require_once BCT_BOOKMAKERS_TEMPLATES . '/bookmaker_btn.php';
	} );
}
