<?php

return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['https://nooralwahdah.com'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization', 'lang','Lang'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
