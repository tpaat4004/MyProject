<?php

// config/cors.php

return [

    'paths' => ['*'], // Chỉ định các đường dẫn cần CORS cho API

    'allowed_methods' => ['*'], // Cho phép tất cả các phương thức HTTP (GET, POST, PUT, DELETE, v.v)

    'allowed_origins' => ['*'], // Cho phép tất cả các nguồn gốc (có thể thay đổi nếu cần chỉ định nguồn gốc cụ thể)

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Cho phép tất cả các header

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];

