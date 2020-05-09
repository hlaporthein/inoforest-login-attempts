<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Forbidden' ); }
/**
 * Plugin Name: Login Limit
 * Plugin URI: http://hlaporthein.me
 * Description: Login Limit WordPress Plugin with timer
 * Version: 1.0
 * Author: Hla Por Thein
 * Author URI: http://hlaporthein.me
 * License: GPL2+
 * Text Domain: vd
 */

if ( file_exists( plugin_dir_path(__FILE__) . 'sources/autoload.php' ) ) {

    require plugin_dir_path(__FILE__) . 'sources/autoload.php';

} else {

    if ( file_exists( plugin_dir_path(__FILE__) . 'vendor/autoload.php' ) ) {

        require plugin_dir_path(__FILE__) . 'vendor/autoload.php';

    } else {

        /**
         * Show message to install composer
         */
        add_action('wp_footer', function(){
            echo "Need to install composer in inoforest var plugin.";
        });

    }

}

/**
 * Activate require functions when activated plugins
 */
function ino_minify_plugin_activate() {

//    set_transient( 'ino-fic-activate-plugin', true, 5 );
}

register_activation_hook( __FILE__, 'ino_minify_plugin_activate' );

/**
 * Activate require functions when deactivated plugins
 */
function ino_minify_plugin_deactivate() {

}

register_deactivation_hook( __FILE__, 'ino_minify_plugin_deactivate' );