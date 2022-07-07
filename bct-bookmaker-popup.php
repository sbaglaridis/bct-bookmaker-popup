<?php

/**
 * Bct Bookmaker Popup
 *
 * Plugin Name: BCT Bookmaker Popup
 * Version: 1.0.3
 */

require 'plugin-update-checker/plugin-update-checker.php';

$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/sbaglaridis/bct-bookmaker-popup',
	__FILE__,
	'bct-bookmaker-popup'
);

$myUpdateChecker->setBranch( 'master' );

$cookie = $_COOKIE['bet_popup_closed'];

if ( isset($cookie) && $cookie === 'true' ) {
	return '';
}

define( 'BCT_BOOKMAKERS_PATH', plugin_dir_path( __FILE__ ) );
define( 'BCT_BOOKMAKERS_URL', plugin_dir_url( __FILE__ ) );

const BCT_BOOKMAKERS_NAME      = 'BcBookmaker';
const BCT_BOOKMAKERS_TEMPLATES = BCT_BOOKMAKERS_PATH . 'templates';
const BCT_BOOKMAKERS_ASSETS    = BCT_BOOKMAKERS_URL . 'assets';
const BCT_BOOKMAKERS_IMAGES    = BCT_BOOKMAKERS_ASSETS . '/images';
const BCT_BOOKMAKERS_SCRIPTS   = BCT_BOOKMAKERS_ASSETS . '/js';
const BCT_BOOKMAKERS_STYLES    = BCT_BOOKMAKERS_ASSETS . '/css';

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'bct-bookmaker',
		BCT_BOOKMAKERS_STYLES . '/bct-bookmaker-popup.css',
		[],
		filemtime(BCT_BOOKMAKERS_PATH . 'assets/css/bct-bookmaker-popup.css'),
		'all'
	);

	wp_enqueue_script(
		'bct-bookmaker',
		BCT_BOOKMAKERS_SCRIPTS . '/bct-bookmaker-popup.js',
		[],
		filemtime(BCT_BOOKMAKERS_PATH . 'assets/js/bct-bookmaker-popup.js'),
		true
	);
} );

add_action( 'bct_after_body', function () {
	require_once BCT_BOOKMAKERS_TEMPLATES . '/footer-popup.php';
} );

add_action( 'bct_bookmaker_btn', function ($args) {
	require_once BCT_BOOKMAKERS_TEMPLATES . '/bookmaker_btn.php';
} );
