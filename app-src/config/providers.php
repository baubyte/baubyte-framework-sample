<?php

return [
    'boot' => [
        Baubyte\Providers\ServerServiceProvider::class,
        Baubyte\Providers\DatabaseDriverServiceProvider::class,
        Baubyte\Providers\SessionStorageServiceProvider::class,
        Baubyte\Providers\ViewServiceProvider::class,
    ],
    'runtime' => [
        App\Providers\RuleServiceProvider::class,
        App\Providers\RouteServiceProvider::class
    ]
];