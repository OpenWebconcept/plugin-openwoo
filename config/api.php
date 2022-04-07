<?php declare(strict_types=1);

return [
    'models' => [
        /**
         * Custom field creators.
         *
         * [
         *      'creator'   => CreatesFields::class,
         *      'condition' => \Closure
         * ]
         */
        'item'   => [
            'fields' => [
                'connected'   => Yard\OpenWOO\RestAPI\ItemFields\ConnectedField::class,
                'expired'     => Yard\OpenWOO\RestAPI\ItemFields\ExpiredField::class,
                'highlighted' => Yard\OpenWOO\RestAPI\ItemFields\HighlightedItemField::class,
                'taxonomies'  => Yard\OpenWOO\RestAPI\ItemFields\TaxonomyField::class,
                'image'       => Yard\OpenWOO\RestAPI\ItemFields\FeaturedImageField::class,
                'downloads'   => Yard\OpenWOO\RestAPI\ItemFields\DownloadsField::class,
                'links'       => Yard\OpenWOO\RestAPI\ItemFields\LinksField::class,
                'synonyms'    => Yard\OpenWOO\RestAPI\ItemFields\SynonymsField::class,
                'notes'       => Yard\OpenWOO\RestAPI\ItemFields\NotesField::class,
            ],
        ],
        'theme'  => [
            'fields' => [
                'connected' => Yard\OpenWOO\RestAPI\ItemFields\ConnectedThemeItemField::class,
            ],
        ],
        'search' => [
            'fields' => [
                'connected'  => Yard\OpenWOO\RestAPI\ItemFields\ConnectedField::class,
                'expired'    => Yard\OpenWOO\RestAPI\ItemFields\ExpiredField::class,
                'taxonomies' => Yard\OpenWOO\RestAPI\ItemFields\TaxonomyField::class,
                'image'      => Yard\OpenWOO\RestAPI\ItemFields\FeaturedImageField::class,
                'downloads'  => Yard\OpenWOO\RestAPI\ItemFields\DownloadsField::class,
                'links'      => Yard\OpenWOO\RestAPI\ItemFields\LinksField::class,
                'synonyms'   => Yard\OpenWOO\RestAPI\ItemFields\SynonymsField::class,
                'notes'      => Yard\OpenWOO\RestAPI\ItemFields\NotesField::class,
            ],
        ],
    ],
];
