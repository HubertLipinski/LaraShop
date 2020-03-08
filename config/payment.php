<?php

return [
    'continue_url' => env('PAYMENT_CONTINUE_URL', config('app.url')),
    'payU' => [
            'oauth_endpoint' => env('PAYU_OAUTH_ENDPOINT'),
            'order_endpoint' => env('PAYU_ORDER_ENDPOINT'),
            'client_id' => env('PAYU_CLIENT_ID'),
            'client_secret' => env('PAYU_CLIENT_SECRET'),
            'pos_id' => env('PAYU_POS_ID'),
            'notify' => config('app.url').'/api/pay-u/notify'
        ]

    //add other payment providers
];
