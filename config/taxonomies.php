<?php declare(strict_types=1);

return [
    'openwoo-type' => [
        'object_types' => ['openwoo-item'],
        'args' => [
            'public' => true,
            'show_in_rest' => true,
            'hierarchical' => false,
            'meta_box_cb' => 'post_categories_meta_box',
            'show_in_quick_edit' => false,
            'labels' => [
                'name' => __('Typen', 'openwoo'),
                'singular_name' => __('Type', 'openwoo'),
                'search_items' => __('Zoek typen', 'openwoo'),
                'all_items' => __('Alle typen', 'openwoo'),
                'edit_item' => __('Type bewerken', 'openwoo'),
                'view_item' => __('Type bekijken', 'openwoo'),
                'update_item' => __('Type bijwerken', 'openwoo'),
                'add_new_item' => __('Type toevoegen', 'openwoo'),
                'new_item_name' => __('Nieuw type naam', 'openwoo'),
                'not_found' => __('Geen typen gevonden', 'openwoo')
            ]
        ],
    ],
    'openwoo-show-on' => [
        'object_types' => ['openwoo-item'],
        'args' => [
            'public' => true,
            'show_in_rest' => true,
            'hierarchical' => false,
            'meta_box_cb' => 'post_categories_meta_box',
            'show_in_quick_edit' => false,
            'labels' => [
                'name' => __('Tonen op', 'openwoo'),
                'singular_name' => __('Tonen op', 'openwoo'),
                'search_items' => __('Zoek tonen op', 'openwoo'),
                'all_items' => __('Alle tonen op', 'openwoo'),
                'edit_item' => __('Tonen op bewerken', 'openwoo'),
                'view_item' => __('Tonen op bekijken', 'openwoo'),
                'update_item' => __('Tonen op bijwerken', 'openwoo'),
                'add_new_item' => __('Tonen op toevoegen', 'openwoo'),
                'new_item_name' => __('Nieuw tonen op', 'openwoo'),
                'not_found' => __('Geen tonen op gevonden', 'openwoo')
            ]
        ],
    ],
];
