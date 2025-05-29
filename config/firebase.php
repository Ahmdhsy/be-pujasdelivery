<?php

return [
    'default' => env('FIREBASE_PROJECT', 'default'),

    'projects' => [
        'default' => [
            'credentials' => [
                'file' => env('FIREBASE_CREDENTIALS', base_path('storage/app/firebase/firebase-adminsdk.json')),
                'auto_discovery' => true,
            ],
            'id' => env('FIREBASE_PROJECT_ID', 'pujas-delivery'),
            'auth' => [
                'tenant_id' => env('FIREBASE_AUTH_TENANT_ID', null),
            ],
            'database' => [
                'url' => env('FIREBASE_DATABASE_URL', 'https://pujas-delivery-default-rtdb.firebaseio.com'),
            ],
            'dynamic_links' => [
                'default_domain' => env('FIREBASE_DYNAMIC_LINKS_DEFAULT_DOMAIN', null),
            ],
            'storage' => [
                'default_bucket' => env('FIREBASE_STORAGE_DEFAULT_BUCKET', null),
            ],
        ],
    ],

    'cache_store' => env('FIREBASE_CACHE_STORE', 'file'),

    'logging' => [
        'http_log_channel' => env('FIREBASE_HTTP_LOG_CHANNEL', null),
        'http_debug_log_channel' => env('FIREBASE_HTTP_DEBUG_LOG_CHANNEL', null),
    ],

    'http_client_options' => [
        'timeout' => env('FIREBASE_HTTP_CLIENT_TIMEOUT', 30),
        'proxy' => env('FIREBASE_HTTP_CLIENT_PROXY', null),
        'verify' => env('FIREBASE_HTTP_CLIENT_VERIFY', true),
    ],
];