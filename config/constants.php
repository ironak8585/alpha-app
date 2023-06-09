<?php

return [
    'APP' => [
        'DEFAULT_RPP' => 10,
        'RECORDS_PER_PAGES' => [10 => 10, 20 => 20, 30 => 30, 40 => 40, 50 => 50, 100 => 100],
        'EXCEL' => [
            'CREATOR' => 'Alpha-App',
            'PROTECT_PASSWORD' => 'Alpha@App',
        ],
        'CONFIG_CATEGORIES' => [
            'SYSTEM' => 'SYSTEM',
            'APP' => 'APP',
            'EMAIL' => 'EMAIL',
        ],
        'CONFIG_TYPES' => [
            'INT' => 'INT',
            'FLOAT' => 'FLOAT',
            'BOOL' => 'BOOL',
            'STRING' => 'STRING',
            'DATE' => 'DATE',
        ],
        'YES_NO' => [
            0 => 'NO',
            1 => 'YES',
        ],
        'REPORT_TYPES' => [
            'DISPLAY' => 'DISPLAY',
            'PDF' => 'PDF',
        ],
    ],
    'USER' => [
        'ROLES' => [
            'SUPER_ADMIN' => 'SUPER_ADMIN',
            'ADMIN' => 'ADMIN',
            'BILL_MANAGER' => 'BILL_MANAGER',
            'GUEST' => 'GUEST',
        ],
        'DEFAULT_ROLES' => [
            'ADMIN' => 'Administrator',
            'GUEST' => 'Guest',
        ],
    ],
];
