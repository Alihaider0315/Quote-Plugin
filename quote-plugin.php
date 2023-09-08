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

// Register Custom Post Type
function register_quote_post_type() {
    $labels = array(
        'name' => 'Quotes',
        'singular_name' => 'Quote',
        'menu_name' => 'Quotes',
        'add_new' => 'Add New Quote',
        'add_new_item' => 'Add New Quote',
        'edit_item' => 'Edit Quote',
        'new_item' => 'New Quote',
        'view_item' => 'View Quote',
        'search_items' => 'Search Quotes',
        'not_found' => 'No quotes found',
        'not_found_in_trash' => 'No quotes found in trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => array('title', 'editor'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'quotes'),
    );

    register_post_type('quote', $args);
}
add_action('init', 'register_quote_post_type');

// Display random quote
function display_random_quote() {
    $args = array(
        'post_type' => 'quote',
        'posts_per_page' => -1, // Get all quotes
        'orderby' => 'rand',   // Random order
    );

    $quotes = get_posts($args);

    if ($quotes) {
        $random_quote = $quotes[array_rand($quotes)]; // Get a random quote
        echo '<div id="quoteDisplay">' . esc_html($random_quote->post_content) . '</div>';
    } else {
        echo '<div id="quoteDisplay">No quotes available.</div>';
    }
}

// Shortcode handler
function quote_plugin_shortcode() {
    ob_start();
    display_random_quote();
    return ob_get_clean();
}
add_shortcode('quote-plugin', 'quote_plugin_shortcode');

// Schedule event to change quote every 2 days
function schedule_quote_change_event() {
    if (!wp_next_scheduled('change_quote_event')) {
        wp_schedule_event(time(), 'daily', 'change_quote_event');
    }
}
add_action('init', 'schedule_quote_change_event');

// Hook to change the quote
function change_quote_callback() {
    // Update the quote display
    display_random_quote();
}
add_action('change_quote_event', 'change_quote_callback');
