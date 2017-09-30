<?php
/**
 * Plugin Name:     Themedd Toolkit
 * Plugin URI:      https://github.com/flowdee/themedd-toolkit
 * Description:     Compilation of most used enhancements
 * Version:         1.0.0
 * Author:          flowdee
 * Author URI:      https://flowdee.de
 * Text Domain:     teddtk
 *
 * @author          flowdee
 * @copyright       Copyright (c) flowdee
 *
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'Themedd_Toolkit' ) ) {

    /**
     * Main Themedd Toolkit class
     *
     * @since       1.0.0
     */
    class Themedd_Toolkit {

        /**
         * @var         Themedd_Toolkit $instance The one true Themedd_Toolkit
         * @since       1.0.0
         */
        private static $instance;


        /**
         * Get active instance
         *
         * @access      public
         * @since       1.0.0
         * @return      object self::$instance The one true Themedd_Toolkit
         */
        public static function instance() {
            if( !self::$instance ) {
                self::$instance = new Themedd_Toolkit();
                self::$instance->setup_constants();
                self::$instance->includes();
                self::$instance->load_textdomain();
            }

            return self::$instance;
        }


        /**
         * Setup plugin constants
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         */
        private function setup_constants() {

            // Plugin name
            define( 'TEDDTK_NAME', 'Themedd Toolkit' );

            // Plugin version
            define( 'TEDDTK_VER', '1.0.0' );

            // Plugin path
            define( 'TEDDTK_DIR', plugin_dir_path( __FILE__ ) );

            // Plugin URL
            define( 'TEDDTK_URL', plugin_dir_url( __FILE__ ) );
        }

        /**
         * Include necessary files
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         */
        private function includes() {

            // Include scripts
            //require_once TEDDTK_DIR . 'includes/helper.php';
            //require_once TEDDTK_DIR . 'includes/functions.php';
            //require_once TEDDTK_DIR . 'includes/scripts.php';
            //require_once TEDDTK_DIR . 'includes/hooks.php';

            if ( is_admin() ) {
                //require_once TEDDTK_DIR . 'includes/admin/plugins.php';
                //require_once TEDDTK_DIR . 'includes/admin/class.settings.php';
            }
        }

        /**
         * Internationalization
         *
         * @access      public
         * @since       1.0.0
         * @return      void
         */
        public function load_textdomain() {
            // Set filter for language directory
            $lang_dir = TEDDTK_DIR . '/languages/';
            $lang_dir = apply_filters( 'teddtk_languages_directory', $lang_dir );

            // Traditional WordPress plugin locale filter
            $locale = apply_filters( 'plugin_locale', get_locale(), 'teddtk' );
            $mofile = sprintf( '%1$s-%2$s.mo', 'teddtk', $locale );

            // Setup paths to current locale file
            $mofile_local   = $lang_dir . $mofile;
            $mofile_global  = WP_LANG_DIR . '/teddtk/' . $mofile;

            if( file_exists( $mofile_global ) ) {
                // Look in global /wp-content/languages/teddtk/ folder
                load_textdomain( 'teddtk', $mofile_global );
            } elseif( file_exists( $mofile_local ) ) {
                // Look in local /wp-content/plugins/teddtk/languages/ folder
                load_textdomain( 'teddtk', $mofile_local );
            } else {
                // Load the default language files
                load_plugin_textdomain( 'teddtk', false, $lang_dir );
            }
        }
    }
} // End if class_exists check

/**
 * The main function responsible for returning the one true Themedd_Toolkit
 * instance to functions everywhere
 *
 * @since       1.0.0
 * @return      \Themedd_Toolkit The one true Themedd_Toolkit
 *
 */
function teddtk_load() {

    $instance = Themedd_Toolkit::instance();

    return $instance;
}
add_action( 'plugins_loaded', 'teddtk_load' );