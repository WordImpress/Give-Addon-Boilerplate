<?php namespace GiveAddon;
/**
 * Plugin Name: ADDON_NAME
 * Plugin URI:  https://givewp.com/addons/BOILERPLATE/
 * Description: ADDON_DESCRIPTION
 * Version:     1.0.0
 * Author:      GiveWP
 * Author URI:  https://givewp.com/
 * Text Domain: ADDON_TEXTDOMAIN
 * Domain Path: /languages
 */
defined( 'ABSPATH' ) or exit;

// Add-on name
define( 'ADDON_CONSTANT_NAME', 'ADDON_NAME' );
// Versions
define( 'ADDON_CONSTANT_VERSION',          '1.0.0' );
define( 'ADDON_CONSTANT_MIN_GIVE_VERSION', '2.8.0' );
// Add-on paths
define( 'ADDON_CONSTANT_FILE',     __FILE__ );
define( 'ADDON_CONSTANT_DIR',      plugin_dir_path( ADDON_CONSTANT_FILE ) );
define( 'ADDON_CONSTANT_URL',      plugin_dir_url( ADDON_CONSTANT_FILE ) );
define( 'ADDON_CONSTANT_BASENAME', plugin_basename( ADDON_CONSTANT_FILE ) );

require ADDON_CONSTANT_DIR . 'vendor/autoload.php';

// Register the add-on service provider with the GiveWP core.
add_action( 'before_give_init', function() {
	// Check Give min required version.
	if ( Addon\Helpers\Environment::giveMinRequiredVersionCheck() ) {
		give()->registerServiceProvider( Addon\AddonServiceProvider::class );
	}
} );

// Check to make sure GiveWP core is installed and compatible with this add-on.
add_action( 'admin_init', [ Addon\Helpers\Environment::class, 'checkEnvironment' ] );
