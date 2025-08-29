<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Supabase Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Supabase integration
    |
    */

    'url' => env('SUPABASE_URL', ''),
    'key' => env('SUPABASE_ANON_KEY', ''),
    'service_key' => env('SUPABASE_SERVICE_KEY', ''),
    
    /*
    |--------------------------------------------------------------------------
    | Database Configuration
    |--------------------------------------------------------------------------
    */
    
    'database' => [
        'connection' => env('SUPABASE_DB_CONNECTION', 'supabase'),
        'host' => env('SUPABASE_DB_HOST', ''),
        'port' => env('SUPABASE_DB_PORT', 5432),
        'database' => env('SUPABASE_DB_DATABASE', ''),
        'username' => env('SUPABASE_DB_USERNAME', ''),
        'password' => env('SUPABASE_DB_PASSWORD', ''),
        'schema' => env('SUPABASE_DB_SCHEMA', 'public'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Storage Configuration
    |--------------------------------------------------------------------------
    */
    
    'storage' => [
        'bucket' => env('SUPABASE_STORAGE_BUCKET', 'event-assets'),
        'url' => env('SUPABASE_STORAGE_URL', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Configuration
    |--------------------------------------------------------------------------
    */
    
    'auth' => [
        'redirect_to' => env('SUPABASE_AUTH_REDIRECT_TO', ''),
        'jwt_secret' => env('SUPABASE_JWT_SECRET', ''),
    ],
];