<?php

declare(strict_types=1);

return [
    'woo_base' => [
        'id' => 'openwoo_metadata',
        'title' => __('Data', 'openwoo'),
        'object_types' => ['openwoo-item'],
        'context' => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields' => [
            'general' => [
                [
                    'name' => __('Kenmerk *', 'openwoo'),
                    'id' => 'woo_Kenmerk',
                    'type' => 'text',
                    'attributes' => [
                        'required' => 'required',
                    ],
                ],
                [
                    'name' => __('Samenvatting', 'openwoo'),
                    'id' => 'woo_Samenvatting',
                    'type' => 'textarea',
                ],
                [
                    'name' => __('Onderwerp *', 'openwoo'),
                    'id' => 'woo_Onderwerp',
                    'type' => 'text',
                    'attributes' => [
                        'required' => 'required',
                    ],
                ],
                [
                    'name' => __('Ontvanger informatieverzoek', 'openwoo'),
                    'id' => 'woo_Ontvanger_informatieverzoek',
                    'type' => 'text',

                ],
                [
                    'name' => __('Termijnoverschrijding', 'openwoo'),
                    'id'=> 'woo_Termijnoverschrijding',
                    'type' => 'select',
                    'options' => [
                        '' => '',
                        'Ja' => 'Ja',
                        'Nee' => 'Nee',
                    ],
                ],
                [
                    'name' => __('Ontvangstdatum *', 'openwoo'),
                    'id' => 'woo_Ontvangstdatum',
                    'type' => 'text_date',
                    'date_format' => 'd-m-Y',
                    'inline' => false,
                    'attributes' => [
                        'required' => 'required',
                    ],
                ],
                [
                    'name' => __('Besluitdatum *', 'openwoo'),
                    'id' => 'woo_Besluitdatum',
                    'type' => 'text_date',
                    'js_options' => [
                        'dateFormat' => 'dd-mm-yy',
                        'timeFormat' => 'HH:mm',
                        'showTimepicker' => true,
                        'controlType' => 'select',
                        'showButtonPanel' => false,
                        'oneLine' => true,
                    ],
                    'date_format' => 'd-m-Y',
                    'inline' => false,
                    'attributes' => [
                        'required' => 'required',
                    ],
                ],
                [
                    'name' => __('Besluit *', 'openwoo'),
                    'id' => 'woo_Besluit',
                    'type' => 'select',
                    'options' => [
                        '' => '',
                        'Openbaar gemaakt' => 'Openbaar gemaakt',
                        'Niet openbaar gemaakt' => 'Niet openbaar gemaakt',
                        'Deels openbaar gemaakt' => 'Deels openbaar gemaakt',
                        'Reeds openbaar' => 'Reeds openbaar',
                    ],
                    'attributes' => [
                        'required' => 'required',
                    ],
                ],
                [
                    'name' => __('Bijlage informatieverzoek', 'openwoo'),
                    'id' => 'woo_Bijlage_informatieverzoek',
                    'type' => 'file',
                    'options' => [
                        'url' => false, // Hide the text input for the url
                    ],
                ],
                [
                    'name' => __('Bijlage inventarisatielijst', 'openwoo'),
                    'id' => 'woo_Bijlage_inventarisatielijst',
                    'type' => 'file',
                    'options' => [
                        'url' => false, // Hide the text input for the url
                    ],
                ],
                [
                    'name' => __('Bijlage besluit', 'openwoo'),
                    'id' => 'woo_Bijlage_besluit',
                    'type' => 'file',
                    'options' => [
                        'url' => false, // Hide the text input for the url
                    ],
                ],
                [
                    'name' => __('URL informatieverzoek', 'openwoo'),
                    'id' => 'woo_URL_informatieverzoek',
                    'type' => 'text_url',
                ],
                [
                    'name' => __('URL inventarisatielijst', 'openwoo'),
                    'id' => 'woo_URL_inventarisatielijst',
                    'type' => 'text_url',
                ],
                [
                    'name' => __('URL besluit', 'openwoo'),
                    'id' => 'woo_URL_besluit',
                    'type' => 'text_url',
                ],
                [
                    'name' => __('Postcodegebied', 'openwoo'),
                    'id' => 'woo_Postcodegebied',
                    'type' => 'text',
                ],
                [
                    'id' => 'woo_Themas',
                    'type' => 'group',
                    'before_group' => sprintf('<div class="cmb-row"><div class="cmb-th"><label>%s</label></div></div>', __('Thema\'s', 'openwoo')),
                    'repeatable' => true,
                    'fields' => [
                        [
                            'name' => __('Hoofdthema', 'openwoo'),
                            'id' => 'woo_Hoofdthema',
                            'type' => 'text',
                        ],
                        [
                            'name' => __('Subthema', 'openwoo'),
                            'id' => 'woo_Subthema',
                            'type' => 'text',
                        ],
                        [
                            'name' => __('Aanvullend thema', 'openwoo'),
                            'id' => 'woo_Aanvullend_thema',
                            'type' => 'text',
                        ],
                    ]
                ],
                [
                    'name' => __('Geografisch gebied', 'openwoo'),
                    'id' => 'woo_Geografisch_gebied',
                    'type' => 'text',
                ],
                [
                    'id' => 'woo_Adres',
                    'type' => 'text',
                    'type' => 'group',
                    'before_group' => sprintf('<div class="cmb-row"><div class="cmb-th"><label>%s</label></div></div>', __('Adres', 'openwoo')),
                    'repeatable' => false,
                    'fields' => [
                        [
                            'name' => __('Straat + huisnummer', 'openwoo'),
                            'id' => 'woo_Straat__huisnummer',
                            'type' => 'text',
                        ],
                        [
                            'name' => __('Postcode', 'openwoo'),
                            'id' => 'woo_Postcode',
                            'type' => 'text',
                        ],
                        [
                            'name' => __('Stad', 'openwoo'),
                            'id' => 'woo_Stad',
                            'type' => 'text',
                        ],
                    ],
                ],
                [
                    'id'   => 'woo_Geografische_positie',
                    'type' => 'group',
                    'before_group' => sprintf('<div class="cmb-row"><div class="cmb-th"><label>%s</label></div></div>', __('Geografische positie', 'openwoo')),
                    'repeatable' => false,
                    'fields' => [
                        [
                            'name' => __('Longitude', 'openwoo'),
                            'id' => 'woo_Longitude',
                            'type' => 'text',
                        ],
                        [
                            'name' => __('Latitude', 'openwoo'),
                            'id'   => 'woo_Lattitude',
                            'type' => 'text',
                        ],
                    ],
                ],
                [
                    'id' => 'woo_COORDS',
                    'type' => 'group',
                    'before_group' => sprintf('<div class="cmb-row"><div class="cmb-th"><label>%s</label></div></div>', __('COORDS', 'openwoo')),
                    'repeatable' => false,
                    'fields' => [
                        [
                            'name' => __('X', 'openwoo'),
                            'id' => 'woo_X',
                            'type' => 'text',
                        ],
                        [
                            'name' => __('Y', 'openwoo'),
                            'id' => 'woo_Y',
                            'type' => 'text',
                        ],
                    ],
                ],
                [
                    'id' => 'woo_Bijlagen',
                    'type' => 'group',
                    'before_group' => sprintf('<div class="cmb-row"><div class="cmb-th"><label>%s</label></div></div>', __('Bijlagen', 'openwoo')),
                    'repeatable' => true,
                    'fields' => [
                        [
                            'name' => __('Type Bijlage', 'openwoo'),
                            'id' => 'woo_Type_Bijlage',
                            'type' => 'select',
                            'options' => [
                                '' => '',
                                'Procedureel' => 'Procedureel',
                                'Inhoudelijk' => 'Inhoudelijk',
                            ],
                        ],
                        [
                            'name' => __('Status Bijlage', 'openwoo'),
                            'id' => 'woo_Status_Bijlage',
                            'type' => 'select',
                            'options' => [
                                '' => '',
                                'Nieuw' => 'Nieuw',
                                'Gewijzigd' => 'Gewijzigd',
                                'Verwijderd' => 'Verwijderd',
                            ],
                        ],
                        [
                            'name' => __('Tijdstip laatste wijziging bijlage', 'openwoo'),
                            'id' => 'woo_Tijdstip_laatste_wijziging_bijlage',
                            'type' => 'datetime',
                            'timestamp' => true,
                            'js_options' => [
                                'dateFormat' => 'dd-mm-yy',
                                'timeFormat' => 'HH:mm',
                                'showTimepicker' => true,
                                'controlType' => 'select',
                                'showButtonPanel' => false,
                                'oneLine' => true,
                            ],
                            'inline' => false,
                        ],
                        [
                            'name' => __('Titel Bijlage', 'openwoo'),
                            'id' => 'woo_Titel_Bijlage',
                            'type' => 'text',
                        ],
                        [
                            'name' => __('URL Bijlage', 'openwoo'),
                            'id' => 'woo_URL_Bijlage',
                            'type' => 'text_url',
                        ],
                        [
                            'name' => __('Bijlage', 'openwoo'),
                            'id' => 'woo_Bijlage',
                            'type' => 'file',
                            'options' => [
                                'url' => false, // Hide the text input for the url
                            ],
                        ]
                    ],
                ],
            ],
        ]
    ],
];
