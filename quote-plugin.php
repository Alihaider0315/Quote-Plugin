<?php 
// Add AJAX action for fetching random quotes
add_action('wp_ajax_get_random_quote', 'get_random_quote');
add_action('wp_ajax_nopriv_get_random_quote', 'get_random_quote');

// Function to fetch and return a random quote
function get_random_quote() {
    $args = array(
        'post_type' => 'quote',
        'posts_per_page' => -1, // Get all quotes
        'orderby' => 'rand',   // Random order
    );

    $quotes = get_posts($args);

    if ($quotes) {
        $random_quote = $quotes[array_rand($quotes)]; // Get a random quote
        echo wp_kses_post($random_quote->post_content);
    } else {
        echo 'No quotes available.';
    }

    wp_die();
}



?>