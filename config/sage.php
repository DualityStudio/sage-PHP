<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Api Services
    |--------------------------------------------------------------------------
    |
    | Here you can configure the required properties for each api service
    | used by the package.
    */

    'api_endpoint' => env('SAGE_ENDPOINT', 'https://api.accounting.sage.com/v3.1'),
    'auth_endpoint' => env('SAGE_AUTH_ENDPOINT', 'https://www.sageone.com/oauth2/auth/central?filter=apiv3.1'),

    'authentication' => [
        'client_id' => env('SAGE_CLIENT_ID'),
        'client_secret' => env('SAGE_CLIENT_SECRET'),
    ],
];
