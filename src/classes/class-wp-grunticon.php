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
     * Plugin options from settings
     *
     * @var [type]
     */
    private $options;
    private $grunticonOptions;
    private $svgFile;
    private $pngFile;
    private $fallbackFile;
    private $path;


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
        add_action( 'admin_menu', array( $this, 'load_admin' ) );
        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_shortcode( 'grunticon', array( $this, 'icon_shortcode' ) );

        // TODO: Enable activation of integrating grunticons to template via settings page
        // add_action( 'wp_head', array( $this, 'load' ) );
    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Loads Grunticon and enqueues Grunticon resources.
     */
    public function load() {

        // TODO: Enable activation of integrating grunticons to template via settings page
        // $filter = 'wp_grunticon_enqueue_scripts';

        if ( is_admin() ) {

            $filter = 'wp_grunticon_admin_enqueue_scripts';
            $this->options = get_option( 'grunticon_options' );

            $this->svgFile =  isset( $this->options['svg'] ) ? esc_attr( $this->options['svg']) : 'icons.data.svg.css';
            $this->pngFile =  isset( $this->options['png'] ) ? esc_attr( $this->options['png']) : 'icons.data.png.css';
            $this->fallbackFile =  isset( $this->options['fallback'] ) ? esc_attr( $this->options['fallback']) : 'icons.data.fallback.css';

            $this->path = isset( $this->options['path'] ) ? esc_attr( get_template_directory_uri() . $this->options['path']) : get_template_directory_uri();
            $this->grunticonOptions = new WP_Grunticon_Options($this->path, $this->svgFile, $this->pngFile, $this->fallbackFile, '1.0' );
        }

        $queue = apply_filters( $filter, $this->grunticonOptions );

        if ( ! empty( $queue ) ) {

            $noscript = array();

            echo '<script>';
            echo 'window.grunticon=function(e){if(e&&3===e.length){var t=window,n=!(!t.document.createElementNS||!t.document.createElementNS("http://www.w3.org/2000/svg","svg").createSVGRect||!document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Image","1.1")||window.opera&&-1===navigator.userAgent.indexOf("Chrome")),o=function(o){var r=t.document.createElement("link"),a=t.document.getElementsByTagName("script")[0];r.rel="stylesheet",r.href=e[o&&n?0:o?1:2],a.parentNode.insertBefore(r,a)},r=new t.Image;r.onerror=function(){o(!1)},r.onload=function(){o(1===r.width&&1===r.height)},r.src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=="}};';

            echo $this->grunticonOptions->generate_javascript_markup();

            array_push( $noscript, $this->grunticonOptions->generate_noscript_markup() );

            echo '</script>';
            echo '<noscript>';
                echo implode( PHP_EOL, $noscript );
            echo '</noscript>';

        }

    }

    // [grunticon icon="xxx"]
    function icon_shortcode( $attr ) {
        if( !array_key_exists( 'icon', $attr ) ) {
            $icon = "NA";
        } else {
            $icon = $attr['icon'];
        }

        if( !array_key_exists( 'width', $attr ) ) {
            $width = "100px";
        } else {
            $width = $attr['width'];
        }

        if( !array_key_exists( 'center', $attr ) ) {
            $center = "0";
        } else {
            $center = "0 auto";
        }

        if( !array_key_exists( 'color', $attr ) ) {
            $color = "#000000";
        } else {
            $color = $attr['color'];
        }

        return '<div class="icon-'.$icon.'" data-grunticon-embed style="width: '.$width.'; margin: '.$center.'; color: '.$color.';""></div>';
    }

    public function admin_init() {

         if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
            add_action( 'admin_head', array($this, 'inject_data_tinymce') );
            add_filter( 'mce_buttons', array($this, 'register_tinymce_button' ) );
            add_filter( 'mce_external_plugins', array($this, 'add_tinymce_button') );
         }

        register_setting(
            'grunticon_group', // Option group
            'grunticon_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'grunticon_id', // ID
            'Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'grunticon-settings' // Page
        );      

        add_settings_field(
            'path', 
            'CSS Directory in Theme',
            array( $this, 'path_callback' ), 
            'grunticon-settings', 
            'grunticon_id'
        );  

        add_settings_field(
            'svg', 
            'SVG CSS Filename',
            array( $this, 'svg_callback' ), 
            'grunticon-settings', 
            'grunticon_id'
        );  

        add_settings_field(
            'png', 
            'PNG CSS Filename',
            array( $this, 'png_callback' ), 
            'grunticon-settings', 
            'grunticon_id'
        );  

        add_settings_field(
            'fallback', 
            'Fallback CSS Filename',
            array( $this, 'fallback_callback' ), 
            'grunticon-settings', 
            'grunticon_id'
        );  
    }

    public function print_section_info()
    {
        print 'Enter location of Grunticon CSS file.';
    }


    function register_tinymce_button( $buttons ) {
         array_push( $buttons, "add_icon" );
         return $buttons;
    }

    function add_tinymce_button( $plugin_array ) {
         $plugin_array['Grunticons'] = plugins_url( '../js/plugin.js', __FILE__ ) ;
         return $plugin_array;
    }

    public function get_all_icons() {
        $svgContents = file_get_contents($this->path . $this->svgFile);
        preg_match_all('/\.(.*?) {/', $svgContents, $match);

        if (!empty($match) && $match[1]) {
            return $match[1];
        }

        return FALSE;
    }

    public function sanitize( $input )
    {
        $new_input = array();

        if( isset( $input['path'] ) )
            $new_input['path'] = sanitize_text_field( $input['path'] );

        if( isset( $input['svg'] ) )
            $new_input['svg'] = sanitize_text_field( $input['svg'] );

        if( isset( $input['png'] ) )
            $new_input['png'] = sanitize_text_field( $input['png'] );

        if( isset( $input['fallback'] ) )
            $new_input['fallback'] = sanitize_text_field( $input['fallback'] );

        return $new_input;
    }


    public function path_callback()
    {
        printf(
            '<input type="text" id="path" name="grunticon_options[path]" class="regular-text" value="%s" />',
            isset( $this->options['path'] ) ? esc_attr( $this->options['path']) : get_template_directory_uri().'/css/'
        );
    }

    public function svg_callback()
    {
        printf(
            '<input type="text" id="svg" name="grunticon_options[svg]" class="regular-text" value="%s" />',
            isset( $this->options['svg'] ) ? esc_attr( $this->options['svg']) : 'icons.data.svg.css'
        );
    }

    public function png_callback()
    {
        printf(
            '<input type="text" id="png" name="grunticon_options[png]" class="regular-text" value="%s" />',
            isset( $this->options['png'] ) ? esc_attr( $this->options['png']) : 'icons.data.png.css'
        );
    }

    public function fallback_callback()
    {
        printf(
            '<input type="text" id="fallback" name="grunticon_options[fallback]" class="regular-text" value="%s" />',
            isset( $this->options['fallback'] ) ? esc_attr( $this->options['fallback']) : 'icons.data.fallback.css'
        );
    }

    /**
     * Hook some Javascript to our tinymce popup
     * @return [type] [description]
     */
    function inject_data_tinymce() {
        $icons = $this->get_all_icons();
        if ($icons) {
            $icons = implode($icons, ',');
        }
         ?>
         <script type='text/javascript'>
            var $GRUNTICON = {
                'icons': '<?php echo $icons; ?>',
                'js': '<?php echo $this->grunticonOptions->generate_javascript_markup(); ?>'
            };
         </script>
         <?php
    }

    public function load_admin() {
        add_options_page('Grunticon Management', 'Grunticon Management', 'manage_options', 'grunticon_management', array($this, 'render_admin'));
    }

    public function render_admin() {
?>
        <div class="wrap">
            <h2>Grunticon Management</h2>           
            <form method="post" action="options.php">
            <?php
                settings_fields( 'grunticon_group' );
                do_settings_sections( 'grunticon-settings' );
                $this->get_all_icons();
                submit_button(); 
            ?>
            </form>
        </div>
<?php
    }
    
}
