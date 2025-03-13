<?php


return [
    'paths' => ['api/*', 'categories/*', 'categories'], // Specify 'categories/*' to enable CORS for categories routes


   'allowed_methods' => ['*'], // Allow all HTTP methods (or specify ['GET', 'POST', etc.])


   'allowed_origins' => ['*'], // Allow requests from all origins (or specify specific origins like 'https://example.com')


   'allowed_origins_patterns' => [],


   'allowed_headers' => ['*'], // Allow all headers (or specify specific headers)


   'exposed_headers' => [],


   'max_age' => 0,


   'supports_credentials' => false,


];
