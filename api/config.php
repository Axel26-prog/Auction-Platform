<?php
return [
    'LOG_PATH' => __DIR__ . '/Log',
    'DB_USERNAME' => getenv('DB_USERNAME'),
    'DB_PASSWORD' => getenv('DB_PASSWORD'),
    'DB_HOST'     => getenv('DB_HOST'),
    'DB_PORT'     => getenv('DB_PORT') ?: '3306',
    'DB_DBNAME'   => getenv('DB_DBNAME'),
    'SECRET_KEY'  => 'e0d17975bc9bd57eee132eecb6da6f11048e8a88506cc3bffc7249078cf2a77a'
];