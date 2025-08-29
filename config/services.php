<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'firebase' => [
        'database_url' => env('FIREBASE_DATABASE_URL'),
        'project_id' => env('FIREBASE_PROJECT_ID'),
    ],
    
    'msg91' => [
        'api_url' => env('MSG91_API_URL', 'https://api.msg91.com/api/v5/whatsapp/whatsapp-outbound-message/bulk/'),
        'auth_key' => env('MSG91_AUTH_KEY'),
        'integrated_number' => env('MSG91_INTEGRATED_NUMBER', '918140303038'),
        'namespace' => env('MSG91_NAMESPACE', '880d83ae_fdcf_4364_a1da_9293c488f768'),
        'templates' => [
            'otp' => env('MSG91_OTP_TEMPLATE', 'grahchakra_otp'),
            'registration_success' => env('MSG91_REGISTRATION_SUCCESS_TEMPLATE', 'event_registration_success')
        ]
    ]

];
