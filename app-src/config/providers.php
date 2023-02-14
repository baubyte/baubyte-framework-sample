<?php

return [
    'boot' => [
        Baubyte\Providers\ServerServiceProvider::class,
        Baubyte\Providers\DatabaseDriverServiceProvider::class,
        Baubyte\Providers\SessionStorageServiceProvider::class,
        Baubyte\Providers\ViewServiceProvider::class,
        Baubyte\Providers\FileStorageDriverServiceProvider::class,
        Baubyte\Providers\AuthenticatorServiceProvider::class,
        Baubyte\Providers\HasherServiceProvider::class,
    ],
    'runtime' => [
        App\Providers\RuleServiceProvider::class,
        App\Providers\RouteServiceProvider::class
    ]
];