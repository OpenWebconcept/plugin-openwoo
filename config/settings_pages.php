<?php

return [
    'openwoo-base' => [
        'id'           => '_owc_openwoo_base_settings',
        'title'        => __('OpenWOO settings', 'openwoo'),
        'object_types' => ['options-page'],
        'option_key'   => '_owc_openwoo_base_settings',
        'tab_group'    => 'openwoo-base',
        'tab_title'    => __('General', 'openwoo'),
        'position'     => 30,
        'icon_url'    => 'dashicons-admin-settings',
        'fields'       => [
            'portal_url' => [
                'name' => __('Fileserver URL', 'openwoo'),
                'desc' => __('URL including http(s)://', 'openwoo'),
                'id'   => 'openwoo_setting_file_server_url',
                'type' => 'text',
            ],
        ]
    ]
];
