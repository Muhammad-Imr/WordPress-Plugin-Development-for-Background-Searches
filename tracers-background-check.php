<?php
/**
 * Plugin Name: Tracers Background Check
 * Plugin URI: http://harborviewpi.com
 * Description: A WordPress plugin that allows users to perform background searches using the Tracers API.
 * Version: 1.0
 * Author: Muhammad Imran
 * Author URI: http://harborviewpi.com
 */

if (!defined('ABSPATH')) {
    exit; 
}

define('TRACERS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('TRACERS_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once TRACERS_PLUGIN_DIR . 'includes/api-handler.php';
require_once TRACERS_PLUGIN_DIR . 'includes/payment-handler.php';
require_once TRACERS_PLUGIN_DIR . 'includes/form-handler.php';

function tracers_enqueue_scripts() {
    wp_enqueue_style('tracers-style', TRACERS_PLUGIN_URL . 'assets/css/style.css');
    wp_enqueue_script('tracers-script', TRACERS_PLUGIN_URL . 'assets/js/script.js', array('jquery'), null, true);
    wp_localize_script('tracers-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'tracers_enqueue_scripts');

function tracers_search_form() {
    ob_start();
    include TRACERS_PLUGIN_DIR . 'includes/form-handler.php';
    return ob_get_clean();
}
add_shortcode('tracers_search', 'tracers_search_form');
