// Function to fetch and display a random quote via AJAX
function displayRandomQuote() {
    jQuery.ajax({
        type: 'GET',
        url: ajax_object.ajaxurl,
        data: {
            action: 'get_random_quote',
        },
        success: function (response) {
            const quoteDisplay = document.getElementById('quoteDisplay');
            quoteDisplay.innerHTML = response;
        },
    });
}

// Function to refresh the quote every 2 days (in milliseconds)
function refreshQuote() {
    setInterval(function () {
        displayRandomQuote();
    }, 2 * 24 * 60 * 60 * 1000);
}

// Initialize the plugin
document.addEventListener('DOMContentLoaded', function () {
    const addQuoteButton = document.getElementById('addQuote');
    addQuoteButton.addEventListener('click', addQuote);

    // Display the initial quote
    displayRandomQuote();

    // Start the timer to refresh the quote
    refreshQuote();
});
