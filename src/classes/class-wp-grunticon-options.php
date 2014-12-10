<?php

class WP_Grunticon_Options {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Fallback Filename
    ---------------------------------------------- */

    /**
     * The filename for the fallback CSS.
     *
     * @var string
     */
    private $fallback_filename;

    /**
     * Set accessor method for fallback filename property.
     *
     * @param string $value
     */
    public function set_fallback_filename( $value ) {

        $this->fallback_filename = $value;

    }

    /* Path
    ---------------------------------------------- */

    /**
     * The path to Grunticon files.
     *
     * @var string
     */
    private $path;

    /**
     * Set accessor method for path property.
     *
     * @param string $value
     */
    public function set_path( $value ) {

        $this->path = $value;

    }

    /* PNG Filename
    ---------------------------------------------- */

    /**
     * The filename for the PNG CSS.
     *
     * @var string
     */
    private $png_filename;

    /**
     * Set accessor method for PNG filename property.
     *
     * @param string $value
     */
    public function set_png_filename( $value ) {

        $this->png_filename = $value;

    }

    /* SVG Filename
    ---------------------------------------------- */

    /**
     * The filename for the SVG CSS.
     *
     * @var string
     */
    private $svg_filename;

    /**
     * Set accessor method for SVG filename property.
     *
     * @param string $value
     */
    public function set_svg_filename( $value ) {

        $this->svg_filename = $value;

    }

    /* Version
    ---------------------------------------------- */

    /**
     * Version of the script to load, for cache busting.
     *
     * @var string
     */
    private $version;

    /**
     * Set accessor method for version property.
     *
     * @param string $value
     */
    public function set_version( $value ) {

        $this->version = $value;

    }

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     *
     * @param string $path Path to Grunticon file.
     * @param string $svg_filename Grunticon SVG filename.
     * @param string $png_filename Grunticon PNG filename.
     * @param string $fallback_filename Grunticon fallback filename.
     * @param string $version File versions, for cache busing.
     */
    function __construct( $path, $svg_filename, $png_filename, $fallback_filename, $version = '' ) {

        $this->path = $path;
        $this->svg_filename = $svg_filename;
        $this->png_filename = $png_filename;
        $this->fallback_filename = $fallback_filename;
        $this->version = $version;

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Generates JavaScript to load Grunticon assets.
     *
     * @return string JavaScript to load Grunticon assets.
     */
    public function generate_javascript_markup() {

        $svg = $this->assemble_grunticon_asset_path( $this->svg_filename );
        $png = $this->assemble_grunticon_asset_path( $this->png_filename );
        $fallback = $this->assemble_grunticon_asset_path( $this->fallback_filename );

        return 'grunticon(["' . $svg . '", "' . $png . '", "' . $fallback . '"]);';

    }

    /**
     * Generates noscript link markup for Grunticon fallback when JavaScript is disabled.
     *
     * @return string HTML link markup for loading Grunticon fallback styles.
     */
    public function generate_noscript_markup() {

        $fallback = $this->assemble_grunticon_asset_path( $this->fallback_filename );

        return '<link href="' . $fallback . '" rel="stylesheet">';

    }

    /**
     * Generates path to Grunticon assets.
     *
     * @param $current_directory string Current directory where Grunticon enqueueing is occurring, should typically be `__DIR__`.
     * @param $relative_path string The relative path from the current directory to the Grunticon assets.
     * @return mixed Path to Grunticon assets.
     */
    public function generate_grunticon_asset_path( $current_directory, $relative_path ) {

        return str_replace( ABSPATH, '/', realpath( $current_directory . $relative_path ) );

    }

    /* Helpers
    ---------------------------------------------------------------------------------- */

    /**
     * Generates the path to a Grunticon asset, which optional cache busting of resources.
     *
     * @param $filename string Grunticon asset filename.
     * @return string Full path and filename to Grunticon asset, with optional cache busting.
     */
    private function assemble_grunticon_asset_path( $filename ) {

        $asset_path = trailingslashit( $this->path ) . $filename;

        if ( empty( $this->version ) ) {

            return $asset_path;

        }

        return $asset_path . '?ver=' . $this->version;

    }
}