<?php

declare(strict_types=1);

return [

    /**
     * Service Providers.
     */
    'providers' => [
        /**
         * Global providers.
         */
        Yard\OpenWOO\OpenWOOServiceProvider::class,
        Yard\OpenWOO\ElasticPress\ElasticPressServiceProvider::class,
        Yard\OpenWOO\Metabox\MetaboxServiceProvider::class,
        Yard\OpenWOO\Taxonomy\TaxonomyServiceProvider::class,
        Yard\OpenWOO\Settings\SettingsServiceProvider::class,

        /**
         * Providers specific to the admin.
         */
        'admin' => [
            class_exists('\OWC\OpenPub\Base\Settings\SettingsPageOptions') ? Yard\OpenWOO\Admin\AdminServiceProvider::class : Yard\OpenWOO\Foundation\NullServiceProvider::class,
        ],
        'cli' => [
        ],
    ],
];
