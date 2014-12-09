<?php

class WP_Grunticon_Loader {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Grunticon_Loader
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Grunticon_Loader Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Version
    ---------------------------------------------- */

    /**
     * Version, used for cache-busting of style and script file references.
     *
     * @var string
     */
    protected $version = '0.0.0';

    /**
     * Getter method for version.
     *
     * @return string Plugin version.
     */
    public function get_version() {

        return $this->version;

    }

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    public function enqueue_scripts() {

        if ( apply_filters( 'wp_grunticon_add_loader', false ) ) {

            $wp_enqueue_util = WP_Enqueue_Util::get_instance();

            $handle = 'wp-grunticon-loader';
            $relative_path = __DIR__ . '/../js/';
            $filename = 'loader.js';
            $filename_debug = 'loader.js';
            $dependencies = array();

            $options = new WP_Enqueue_Options(
                $handle,
                $relative_path,
                $filename,
                $filename_debug,
                $dependencies,
                $this->get_version(),
                true
            );

            $wp_enqueue_util->enqueue_script( $options );
        }

    }
    
}
