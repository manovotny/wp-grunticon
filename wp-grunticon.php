<?php
/**
 * Plugin Name: WP Grunticon Loader
 * Plugin URI: https://github.com/seripap/wp-grunticon
 * Description: Enables the use of Grunticon within WordPress.
 * Version: 4.0.0
 * Author: Michael Novotny, Daniel Seripap
 * Author URI: http://manovotny.com, http://anthroagency.com
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path: /lang
 * Text Domain: wp-grunticon
 * GitHub Plugin URI: https://github.com/seripap/wp-grunticon
 */

/* Composer
---------------------------------------------------------------------------------- */

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {

    require_once __DIR__ . '/vendor/autoload.php';

}

/* Initialization
---------------------------------------------------------------------------------- */

require_once __DIR__ . '/src/initialize.php';
