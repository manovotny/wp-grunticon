<?php

class WP_Grunticon {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Grunticon
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Grunticon Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'admin_head', array( $this, 'load' ) );
        add_action( 'wp_head', array( $this, 'load' ) );

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Loads Grunticon and enqueues Grunticon resources.
     */
    public function load() {

        $filter = 'wp_grunticon_enqueue_scripts';

        if ( is_admin() ) {

            $filter = 'wp_grunticon_admin_enqueue_scripts';

        }

        $queue = apply_filters( $filter, array() );

        if ( ! empty( $queue ) ) {

            $noscript = array();

            echo '<script type="text/javascript">';
                echo 'window.grunticon=function(e){if(e&&3===e.length){var t=window,n=!(!t.document.createElementNS||!t.document.createElementNS("http://www.w3.org/2000/svg","svg").createSVGRect||!document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Image","1.1")||window.opera&&-1===navigator.userAgent.indexOf("Chrome")),o=function(o){var r=t.document.createElement("link"),a=t.document.getElementsByTagName("script")[0];r.rel="stylesheet",r.href=e[o&&n?0:o?1:2],a.parentNode.insertBefore(r,a)},r=new t.Image;r.onerror=function(){o(!1)},r.onload=function(){o(1===r.width&&1===r.height)},r.src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=="}};';

                foreach ( $queue as $wp_grunticon_options ) {

                    echo $wp_grunticon_options->generate_javascript_markup();

                    array_push( $noscript, $wp_grunticon_options->generate_noscript_markup() );

                }

            echo '</script>';
            echo '<noscript>';
                echo implode( PHP_EOL, $noscript );
            echo '</noscript>';

        }

    }
    
}
