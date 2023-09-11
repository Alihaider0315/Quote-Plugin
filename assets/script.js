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

// Function to change the quote after 2 days
function changeQuoteAfterTwoDays() {
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

    // Start the timer to change the quote after 2 days
    changeQuoteAfterTwoDays();
});
