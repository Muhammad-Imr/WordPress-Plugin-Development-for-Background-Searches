jQuery(document).ready(function($) {
    $('#tracers-search-form').submit(function(e) {
        e.preventDefault();

        let formData = {
            name: $('#name').val(),
            dob: $('#dob').val(),
            address: $('#address').val()
        };

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'tracers_search',
                search_data: formData
            },
            success: function(response) {
                $('#tracers-results').html('<pre>' + JSON.stringify(response, null, 2) + '</pre>');
            }
        });
    });
});
