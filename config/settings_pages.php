<?php

return [
    'openwoo-base' => [
        'id' => '_owc_openwoo_base_settings',
        'title' => __('OpenWOO instellingen', 'openwoo'),
        'object_types' => ['options-page'],
        'option_key' => '_owc_openwoo_base_settings',
        'tab_group' => 'openwoo-base',
        'tab_title' => __('Algemeen', 'openwoo'),
        'position' => 30,
        'icon_url' => 'dashicons-admin-settings',
        'fields' => [
            'fileserver_title' => [
                'name' => __('Fileserver', 'openwoo'),
                'desc' => __('Een eigen implementatie in een plug-in of thema is vereist voor het gebruik van een fileserver, deze plug-in biedt deze instellingen pagina aan waarmee je instellingen kunt gebruiken op elke gewenste plek.', 'openwoo'),
                'id' => 'openwoo_setting_fileserver_title',
                'type' => 'title',
            ],
            'fileserver_url' => [
                'name' => __('Fileserver URL', 'openwoo'),
                'desc' => __('URL met http(s)://', 'openwoo'),
                'id' => 'openwoo_setting_file_server_url',
                'type' => 'text',
            ],
        ],
    ],
];
