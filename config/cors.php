<?php

return [
    'paths' => [
        'api/*', 
        'sanctum/csrf-cookie',
        'login',
        'logout',
        'register',
        'user/profile-information',
        'forgot-password',
        'reset-password'
    ],

    // Match your frontend's HTTP methods
    'allowed_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],

    // Dynamic origins for development/production
    'allowed_origins' => [
        env('APP_ENV') === 'local' 
            ? 'http://localhost:5173'
            : env('APP_FRONTEND_URL')
    ],

    'allowed_origins_patterns' => [],

    // Headers your React app might send
    'allowed_headers' => [
        'Authorization',
        'Content-Type',
        'X-Requested-With',
        'X-CSRF-TOKEN'
    ],

    // Headers your React app needs to access
    'exposed_headers' => [
        'Content-Disposition' 
    ],

    'max_age' => 0, 

    // Enable if using Sanctum or cookies
    'supports_credentials' => env('CORS_CREDENTIALS', false),
];