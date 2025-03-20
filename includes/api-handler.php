<?php
if (!defined('ABSPATH')) {
    exit;
}

function tracers_api_search($searchData) {
    $api_url = 'https://api.galaxysearchapi.com/personsearch';
    $api_key = 'YOUR_TRACERS_API_KEY';

    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key
    ];

    $body = json_encode([
        'galaxy-search-type' => 'BackgroundReport',
        'search' => $searchData
    ]);

    $response = wp_remote_post($api_url, [
        'headers' => $headers,
        'body'    => $body,
        'method'  => 'POST'
    ]);

    if (is_wp_error($response)) {
        return ['error' => 'API request failed'];
    }

    return json_decode(wp_remote_retrieve_body($response), true);
}

function tracers_search_ajax_handler() {
    $searchData = $_POST['search_data'];
    $response = tracers_api_search($searchData);
    wp_send_json($response);
}
add_action('wp_ajax_tracers_search', 'tracers_search_ajax_handler');
add_action('wp_ajax_nopriv_tracers_search', 'tracers_search_ajax_handler');
