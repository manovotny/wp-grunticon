<?php
/**
 * Plugin Name: WP Grunticon Loader
 * Plugin URI: https://github.com/manovotny/wp-grunticon
 * Description: Enables the use of Grunticon within WordPress.
 * Version: 3.0.0
 * Author: Michael Novotny
 * Author URI: http://manovotny.com
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path: /lang
 * Text Domain: wp-grunticon
 * GitHub Plugin URI: https://github.com/manovotny/wp-grunticon
 */

/* Composer
---------------------------------------------------------------------------------- */

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {

    require_once __DIR__ . '/vendor/autoload.php';

}

/* Initialization
---------------------------------------------------------------------------------- */

require_once __DIR__ . '/src/initialize.php';