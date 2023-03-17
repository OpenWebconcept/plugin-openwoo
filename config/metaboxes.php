<?php

declare(strict_types=1);

return [
    'woo_base' => [
        'id' => 'openwoo_metadata',
        'title' => __('Data', OWO_LANGUAGE_DOMAIN),
        'post_types' => ['openwoo-item'],
        'context' => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'validation' => [
            'rules' => [
                'woo_Kenmerk' => [
                    'required'  => true,
                ],
                'woo_Wooverzoek_informatie[woo_Tijdstip_laatste_wijziging][formatted]' => [
                    'required'  => true,
                ],
                'woo_Onderwerp' => [
                    'required'  => true,
                ],
                'woo_Ontvangstdatum' => [
                    'required'  => true,
                ],
                'woo_Besluitdatum' => [
                    'required'  => true,
                ],
                'woo_Besluit' => [
                    'required'  => true,
                ],
            ],
        ],
        'fields' => [
            [
                'name' => __('Kenmerk', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_Kenmerk',
                'type' => 'text',
            ],
            [
                'name' => __('Onderwerp', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_Onderwerp',
                'type' => 'text',
            ],
            [
                'name' => __('Wooverzoek informatie', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_Wooverzoek_informatie',
                'type' => 'group',
                'clone_as_multiple' => true,
                'fields' => [
                    [
                        'name'             => __('Status', OWO_LANGUAGE_DOMAIN),
                        'id'               => 'woo_Status',
                        'type'             => 'select',
                        'options'          => [
                            ''           => '',
                            'Nieuw'      => 'Nieuw',
                            'Gewijzigd'  => 'Gewijzigd',
                            'Verwijderd' => 'Verwijderd'
                        ]
                    ],
                    [
                        'name'             => __('Tijdstip laatste wijziging', OWO_LANGUAGE_DOMAIN),
                        'id'               => 'woo_Tijdstip_laatste_wijziging',
                        'type'             => 'datetime',
                        'timestamp'        => true,
                        'js_options'       => [
                            'dateFormat'       => 'dd-mm-yy',
                            'timeFormat'       => 'HH:mm',
                            'showTimepicker'   => true,
                            'controlType'      => 'select',
                            'showButtonPanel'  => false,
                            'oneLine'          => true,
                        ],
                        'inline'     => false,
                    ]
                ]
            ],
            [
                'name' => __('Volgnummer', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_Volgnummer',
                'type' => 'text',
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
                'name' => __('Ontvangstdatum', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_Ontvangstdatum',
                'type' => 'date',
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
                'name' => __('Besluitdatum', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_Besluitdatum',
                'type' => 'date',
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
                'name' => __('Besluit', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_Besluit',
                'type' => 'select',
                'options' => [
                    '' => '',
                    'Openbaar gemaakt' => 'Openbaar gemaakt',
                    'Niet openbaar gemaakt' => 'Niet openbaar gemaakt',
                    'Deels openbaar gemaakt' => 'Deels openbaar gemaakt',
                    'Reeds openbaar' => 'Reeds openbaar',
                ],
            ],
            [
                'name' => __('Bijlage informatieverzoek', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_Bijlage_informatieverzoek',
                'type' => 'file',
                'max_file_uploads' => 1,
            ],
            [
                'name' => __('Bijlage inventarisatielijst', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_Bijlage_inventarisatielijst',
                'type' => 'file',
                'max_file_uploads' => 1,
            ],
            [
                'name' => __('Bijlage besluit', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_Bijlage_besluit',
                'type' => 'file',
                'max_file_uploads' => 1,
            ],
            [
                'name' => __('URL informatieverzoek', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_URL_informatieverzoek',
                'type' => 'url',
            ],
            [
                'name' => __('URL inventarisatielijst', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_URL_inventarisatielijst',
                'type' => 'url',
            ],
            [
                'name' => __('URL besluit', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_URL_besluit',
                'type' => 'url',
            ],
            [
                'name' => __('Postcodegebied', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_Postcodegebied',
                'type' => 'text',
            ],
            [
                'name' => __('Themas', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_Themas',
                'type' => 'group',
                'clone' => true,
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
                'name' => __('Adres', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_Adres',
                'type' => 'text',
                'type' => 'group',
                'clone' => false,
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
                'name' => __('Geografische positie', OWO_LANGUAGE_DOMAIN),
                'id'   => 'woo_Geografische_positie',
                'type' => 'group',
                'fields' => [
                    [
                        'name' => __('Longitude', OWO_LANGUAGE_DOMAIN),
                        'id' => 'woo_Longitude',
                        'type' => 'text',
                    ],
                    [
                        'name' => __('Lattitude', OWO_LANGUAGE_DOMAIN),
                        'id'   => 'woo_Lattitude',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'name' => __('COORDS', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_COORDS',
                'type' => 'group',
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
                'name' => __('Bijlagen', OWO_LANGUAGE_DOMAIN),
                'id' => 'woo_Bijlagen',
                'type' => 'group',
                'clone' => true,
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
                        'type' => 'text',
                    ],
                    [
                        'name' => __('Bijlage', OWO_LANGUAGE_DOMAIN),
                        'id' => 'woo_Bijlage',
                        'type' => 'file',
                        'max_file_uploads' => 1,
                    ]
                ],
            ],
        ],
    ],
];
