<?php

return [
    'statuses' => [
        'available' => [
            'name' => 'available',
            'value' => true,
            'title' => 'Доступен',
        ],
        'unavailable' => [
            'name' => 'unavailable',
            'value' => false,
            'title' => 'Недоступен',
        ],
    ],
    'roles' => [
        'user' => [
            'code' => 1,
            'title' => 'Пользователь',
        ],
        'admin' => [
            'code' => 2,
            'title' => 'Администратор',
        ],
    ],
    'email' => env('EMAIL'),
    'webhook' => env('WEBHOOK_URL'),
];