(function ($) {
    jQuery(document).ready(function ($) {
        var loading = false;
        var currentTermID = ssol_custom_ajax.current_term_id;
        function ssolSingleTermloadPosts(page) {
            if (loading) return;
            loading = true;

            $.ajax({
                url: ssol_custom_ajax.ajax_url,
                type: 'POST',

                data: {
                    action: 'ssol_single_term_page_posts',
                    page: page,
                    post_type: 'shutorder', // custom post type
                    term_id: currentTermID,
                },
                success: function (response) {
                    $('#ssol-single-term-post-ajax-container').html(response);

                    // Update total number of pages               
                    $('.ssol-tax-qur-current-page').text(page);

                    loading = false;

                    // Remove the 'current' class from all pagination links
                    $('.ssol-shutdown-pagination .page-numbers').removeClass('current');

                    // Add the 'current' class to the clicked pagination link
                    $('.ssol-shutdown-pagination .page-numbers').filter(function () {
                        return $(this).text() == page;
                    }).addClass('current');
                }
            });
        }

        // Load posts for the initial page (page 1)
        ssolSingleTermloadPosts(1);

        // Load posts when clicking on pagination numbers
        $('.ssol-shutdown-pagination').on('click', '.page-numbers', function (e) {
            e.preventDefault();
            var page = $(this).text(); // Get the page number from the clicked link
            ssolSingleTermloadPosts(page);
        });
    });


})(jQuery);