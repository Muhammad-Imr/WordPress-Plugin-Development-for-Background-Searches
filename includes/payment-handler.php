<?php
if (!defined('ABSPATH')) {
    exit;
}

function tracers_process_payment($amount, $cardDetails) {
    $api_url = 'https://apitest.authorize.net/xml/v1/request.api';
    $api_login_id = 'YOUR_LOGIN_ID';
    $transaction_key = 'YOUR_TRANSACTION_KEY';

    $request_data = [
        'createTransactionRequest' => [
            'merchantAuthentication' => [
                'name' => $api_login_id,
                'transactionKey' => $transaction_key
            ],
            'transactionRequest' => [
                'transactionType' => 'authCaptureTransaction',
                'amount' => $amount,
                'payment' => [
                    'creditCard' => $cardDetails
                ]
            ]
        ]
    ];

    $response = wp_remote_post($api_url, [
        'body' => json_encode($request_data),
        'headers' => ['Content-Type: application/json'],
        'method' => 'POST'
    ]);

    return json_decode(wp_remote_retrieve_body($response), true);
}
