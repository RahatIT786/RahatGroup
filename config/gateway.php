<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Gateway Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration file is used for defining sensitive information
    | related to payment gateways, specifically Atom in this case.
    |
    */

    'atom_prod' => [
        'login' => '667918',
        // 'login' => '573103',
        'password' => '4c570b84',
        'product_id' => 'TRAVELS',
        'encRequestKey' => '1122FC364C5A5B405E65D706F2A1CA17',
        'decResponseKey' => '5405E03AAF959F830846C9197F89D7A7',
        'api_url' => 'https://payment1.atomtech.in/ots/aipay/auth',
    ],

    'atom_sandbox' => [
        'login' => '446442',
        'password' => 'Test@123',
        'product_id' => 'NSE',
        'encRequestKey' => 'A4476C2062FFA58980DC8F79EB6A799E',
        'decResponseKey' => '75AEF0FA1B94B3C10D4F5B268F757F11',
        'api_url' => 'https://caller.atomtech.in/ots/aipay/auth',
    ],
];
