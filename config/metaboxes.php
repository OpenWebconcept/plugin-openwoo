<?php

declare(strict_types=1);

return [
    'woo_base' => [
        'id' => 'openwoo_metadata',
        'title' => __('Data', OWO_LANGUAGE_DOMAIN),
        'object_types' => ['openwoo-item'],
        'context' => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields' => [
            'general' => [
                [
                    'name' => __('Kenmerk *', OWO_LANGUAGE_DOMAIN),
                    'id' => 'woo_Kenmerk',
                    'type' => 'text',
                    'attributes' => [
                        'required' => 'required',
                    ],
                ],
                [
                    'name' => __('Samenvatting', OWO_LANGUAGE_DOMAIN),
                    'id' => 'woo_Samenvatting',
                    'type' => 'textarea',
                ],
                [
                    'name' => __('Onderwerp *', OWO_LANGUAGE_DOMAIN),
                    'id' => 'woo_Onderwerp',
                    'type' => 'text',
                    'attributes' => [
                        'required' => 'required',
                    ],
                ],
                [
                    'name' => __('Ontvanger informatieverzoek', OWO_LANGUAGE_DOMAIN),
                    'id' => 'woo_Ontvanger_informatieverzoek',
                    'type' => 'text',

                ],
                [
                    'name' => __('Termijnoverschrijding', OWO_LANGUAGE_DOMAIN),
                    'id'=> 'woo_Termijnoverschrijding',
                    'type' => 'select',
                    'options' => [
                        '' => '',
                        'Ja' => 'Ja',
                        'Nee' => 'Nee',
                    ],
                ],
                [
                    'name' => __('Ontvangstdatum *', OWO_LANGUAGE_DOMAIN),
                    'id' => 'woo_Ontvangstdatum',
                    'type' => 'text_date',
                    'date_format' => 'd-m-Y',
                    'inline' => false,
                    'attributes' => [
                        'required' => 'required',
                    ],
                ],
                [
                    'name' => __('Besluitdatum *', OWO_LANGUAGE_DOMAIN),
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
                    'name' => __('Besluit *', OWO_LANGUAGE_DOMAIN),
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
                    'name' => __('Bijlage informatieverzoek', OWO_LANGUAGE_DOMAIN),
                    'id' => 'woo_Bijlage_informatieverzoek',
                    'type' => 'file',
                    'options' => [
                        'url' => false, // Hide the text input for the url
                    ],
                ],
                [
                    'name' => __('Bijlage inventarisatielijst', OWO_LANGUAGE_DOMAIN),
                    'id' => 'woo_Bijlage_inventarisatielijst',
                    'type' => 'file',
                    'options' => [
                        'url' => false, // Hide the text input for the url
                    ],
                ],
                [
                    'name' => __('Bijlage besluit', OWO_LANGUAGE_DOMAIN),
                    'id' => 'woo_Bijlage_besluit',
                    'type' => 'file',
                    'options' => [
                        'url' => false, // Hide the text input for the url
                    ],
                ],
                [
                    'name' => __('URL informatieverzoek', OWO_LANGUAGE_DOMAIN),
                    'id' => 'woo_URL_informatieverzoek',
                    'type' => 'text_url',
                ],
                [
                    'name' => __('URL inventarisatielijst', OWO_LANGUAGE_DOMAIN),
                    'id' => 'woo_URL_inventarisatielijst',
                    'type' => 'text_url',
                ],
                [
                    'name' => __('URL besluit', OWO_LANGUAGE_DOMAIN),
                    'id' => 'woo_URL_besluit',
                    'type' => 'text_url',
                ],
                [
                    'name' => __('Postcodegebied', OWO_LANGUAGE_DOMAIN),
                    'id' => 'woo_Postcodegebied',
                    'type' => 'text',
                ],
                [
                    'id' => 'woo_Themas',
                    'type' => 'group',
                    'before_group' => sprintf('<div class="cmb-row"><div class="cmb-th"><label>%s</label></div></div>', __('Thema\'s', OWO_LANGUAGE_DOMAIN)),
                    'repeatable' => true,
                    'fields' => [
                        [
                            'name' => __('Hoofdthema', OWO_LANGUAGE_DOMAIN),
                            'id' => 'woo_Hoofdthema',
                            'type' => 'text',
                        ],
                        [
                            'name' => __('Subthema', OWO_LANGUAGE_DOMAIN),
                            'id' => 'woo_Subthema',
                            'type' => 'text',
                        ],
                        [
                            'name' => __('Aanvullend thema', OWO_LANGUAGE_DOMAIN),
                            'id' => 'woo_Aanvullend_thema',
                            'type' => 'text',
                        ],
                    ]
                ],
                [
                    'name' => __('Geografisch gebied', OWO_LANGUAGE_DOMAIN),
                    'id' => 'woo_Geografisch_gebied',
                    'type' => 'text',
                ],
                [
                    'id' => 'woo_Adres',
                    'type' => 'text',
                    'type' => 'group',
                    'before_group' => sprintf('<div class="cmb-row"><div class="cmb-th"><label>%s</label></div></div>', __('Adres', OWO_LANGUAGE_DOMAIN)),
                    'repeatable' => false,
                    'fields' => [
                        [
                            'name' => __('Straat + huisnummer', OWO_LANGUAGE_DOMAIN),
                            'id' => 'woo_Straat__huisnummer',
                            'type' => 'text',
                        ],
                        [
                            'name' => __('Postcode', OWO_LANGUAGE_DOMAIN),
                            'id' => 'woo_Postcode',
                            'type' => 'text',
                        ],
                        [
                            'name' => __('Stad', OWO_LANGUAGE_DOMAIN),
                            'id' => 'woo_Stad',
                            'type' => 'text',
                        ],
                    ],
                ],
                [
                    'id'   => 'woo_Geografische_positie',
                    'type' => 'group',
                    'before_group' => sprintf('<div class="cmb-row"><div class="cmb-th"><label>%s</label></div></div>', __('Geografische positie', OWO_LANGUAGE_DOMAIN)),
                    'repeatable' => false,
                    'fields' => [
                        [
                            'name' => __('Longitude', OWO_LANGUAGE_DOMAIN),
                            'id' => 'woo_Longitude',
                            'type' => 'text',
                        ],
                        [
                            'name' => __('Latitude', OWO_LANGUAGE_DOMAIN),
                            'id'   => 'woo_Lattitude',
                            'type' => 'text',
                        ],
                    ],
                ],
                [
                    'id' => 'woo_COORDS',
                    'type' => 'group',
                    'before_group' => sprintf('<div class="cmb-row"><div class="cmb-th"><label>%s</label></div></div>', __('COORDS', OWO_LANGUAGE_DOMAIN)),
                    'repeatable' => false,
                    'fields' => [
                        [
                            'name' => __('X', OWO_LANGUAGE_DOMAIN),
                            'id' => 'woo_X',
                            'type' => 'text',
                        ],
                        [
                            'name' => __('Y', OWO_LANGUAGE_DOMAIN),
                            'id' => 'woo_Y',
                            'type' => 'text',
                        ],
                    ],
                ],
                [
                    'id' => 'woo_Bijlagen',
                    'type' => 'group',
                    'before_group' => sprintf('<div class="cmb-row"><div class="cmb-th"><label>%s</label></div></div>', __('Bijlagen', OWO_LANGUAGE_DOMAIN)),
                    'repeatable' => true,
                    'fields' => [
                        [
                            'name' => __('Type Bijlage', OWO_LANGUAGE_DOMAIN),
                            'id' => 'woo_Type_Bijlage',
                            'type' => 'select',
                            'options' => [
                                '' => '',
                                'Procedureel' => 'Procedureel',
                                'Inhoudelijk' => 'Inhoudelijk',
                            ],
                        ],
                        [
                            'name' => __('Status Bijlage', OWO_LANGUAGE_DOMAIN),
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
                            'name' => __('Tijdstip laatste wijziging bijlage', OWO_LANGUAGE_DOMAIN),
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
                            'name' => __('Titel Bijlage', OWO_LANGUAGE_DOMAIN),
                            'id' => 'woo_Titel_Bijlage',
                            'type' => 'text',
                        ],
                        [
                            'name' => __('URL Bijlage', OWO_LANGUAGE_DOMAIN),
                            'id' => 'woo_URL_Bijlage',
                            'type' => 'text_url',
                        ],
                        [
                            'name' => __('Bijlage', OWO_LANGUAGE_DOMAIN),
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
