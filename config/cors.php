<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'broadcasting/auth'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:8000'], 

    'allowed_headers' => ['*'],

    'supports_credentials' => true,
];
