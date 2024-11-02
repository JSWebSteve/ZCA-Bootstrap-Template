// -----
// AJAX search for the Zen Cart Bootstrap template.
//
// BOOTSTRAP v5.0.0
//
document.addEventListener('DOMContentLoaded', function() {
    // -----
    // When a search-icon is clicked, display the search form.
    //
    document.querySelectorAll('#search-icon, #mobile-search').forEach(function(element) {
        element.addEventListener('click', function(event) {
            var searchWrapper = document.getElementById('search-wrapper');
            var modal = new bootstrap.Modal(searchWrapper);
            modal.show();
        });
    });

    var searchWrapper = document.getElementById('search-wrapper');
    searchWrapper.addEventListener('shown.bs.modal', function() {
        document.getElementById('search-input').focus();
    });

    // -----
    // When a 'keyup' (devices with keyboards) or 'touchend' (those without) condition 
    // is seen on the search-input, gather the current keywords, submit them to the 
    // AJAX handler and display the returned HTML in the search-content section.
    //
    var searchInput = document.getElementById('search-input');
    searchInput.addEventListener('keyup', handleSearch);
    searchInput.addEventListener('touchend', handleSearch);

    function handleSearch(event) {
        // -----
        // If the "Enter/Go" key is pressed, send the customer to the advanced-search-results
        // page with the current keywords.  Replacing Safari's "smart quotes" with 'vanilla' quotes
        // for matching.
        //
        var keyword = this.value.replace(/"|"/g, '"');
        keyword = keyword.replace(/'|'/g, "'");

        var searchPage = document.getElementById('search-page').value;
        var separator = (searchPage.indexOf('?') == -1) ? '?' : '&';
        var searchLink = searchPage + separator + 'keyword=' + encodeURIComponent(keyword);

        if (event.keyCode == 13) {
            window.location.replace(searchLink);
            return;
        }

        fetch('ajax.php?act=ajaxBootstrapSearch&method=searchProducts', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Cache-Control': 'no-cache'
            },
            body: 'keywords=' + encodeURIComponent(keyword)
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('search-content').innerHTML = data.searchHtml;
            document.querySelectorAll('#search-content .sugg-button').forEach(function(button) {
                button.setAttribute('href', searchLink);
            });
        })
        .catch(error => console.error('Error:', error));
    }
});
