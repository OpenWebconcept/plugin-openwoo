<?php declare(strict_types=1);

return [

    /**
     * Service Providers.
     */
    'providers'    => [
        /**
         * Global providers.
         */
        Yard\OpenWOO\OpenWOOServiceProvider::class,
        Yard\OpenWOO\ElasticPress\ElasticPressServiceProvider::class,
        /**
         * Providers specific to the admin.
         */
        'admin' => [

        ],
        'cli'   => [
        ],
    ]
];
