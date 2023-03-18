<?php
/*
Plugin Name: MobilePhn Essentials
Plugin URI: https://mobilephn.com/
Description: Used for creating new post types and many more things...
Version: 0.0.1
Author: Autocircled
Author URI: https://devhelp.us/
License: GPLv2 or later
Text Domain: mbl-essen
*/
namespace MblEssen;

use \MblEssen\Bootstrap;
use \MblEssen\Autoloader;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! defined( 'MBLESSEN_FILE' ) ) {
	define( 'MBLESSEN_FILE', __FILE__ );
}

if ( ! defined( 'MBLESSEN_BASENAME' ) ) {
	define( 'MBLESSEN_BASENAME', plugin_basename( MBLESSEN_FILE ) );
}

if ( ! defined( 'MBLESSEN_DIR' ) ) {
	define( 'MBLESSEN_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'MBLESSEN_URL' ) ) {
	define( 'MBLESSEN_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
}

if ( ! defined( 'MBLESSEN_NAMESPACE' ) ) {
	define( 'MBLESSEN_NAMESPACE', 'MblEssen' );
}

if ( ! defined( 'MBLESSEN_VERSION' ) ) {
	define( 'MBLESSEN_VERSION', '0.0.1' );
}

// Run autoloader
require_once __DIR__ . '/autoloader.php';
Autoloader::run();

// Bootstrap the plugin
Bootstrap::instance();