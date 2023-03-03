<?php

return [
    /**
     * Services that will be loaded at boot time
     */
    'boot' => [
        /**
         * Baubyte framework services providers
         */
        Baubyte\Providers\ServerServiceProvider::class,
        Baubyte\Providers\DatabaseDriverServiceProvider::class,
        Baubyte\Providers\SessionStorageServiceProvider::class,
        Baubyte\Providers\ViewServiceProvider::class,
        Baubyte\Providers\FileStorageDriverServiceProvider::class,
        Baubyte\Providers\AuthenticatorServiceProvider::class,
        Baubyte\Providers\HasherServiceProvider::class,
        /**
         * Package services providers
         */
    ],
    /**
     * Services that will be loaded after the boot time
     */
    'runtime' => [
        App\Providers\RuleServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\AppServiceProvider::class
    ],
    /**
     * Services that will be loaded only when the application is running in cli mode
     */
    'cli' => [
        Baubyte\Providers\DatabaseDriverServiceProvider::class,
    ]
];