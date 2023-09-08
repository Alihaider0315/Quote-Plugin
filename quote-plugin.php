<?php
/*
Plugin Name: Quote Plugin
Description: Allows users to add and display random quotes.
Version: 1.0
Author: Ali Haider
*/

// Enqueue CSS and JavaScript
function enqueue_quote_plugin_assets() {
    wp_enqueue_style('quote-plugin-style', plugins_url('assets/style.css', __FILE__));
    wp_enqueue_script('quote-plugin-script', plugins_url('assets/script.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_quote_plugin_assets');

// Shortcode handler
function quote_plugin_shortcode() {
    ob_start();
    include(plugin_dir_path(__FILE__) . 'quote-plugin-template.php');
    return ob_get_clean();
}
add_shortcode('quote-plugin', 'quote_plugin_shortcode');
