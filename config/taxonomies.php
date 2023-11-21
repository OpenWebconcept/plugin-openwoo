<?php

declare(strict_types=1);

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
                'name' => __('Types', OWO_LANGUAGE_DOMAIN),
                'singular_name' => __('Type', OWO_LANGUAGE_DOMAIN),
                'search_items' => __('Zoek typen', OWO_LANGUAGE_DOMAIN),
                'all_items' => __('Alle typen', OWO_LANGUAGE_DOMAIN),
                'edit_item' => __('Wijzig type', OWO_LANGUAGE_DOMAIN),
                'view_item' => __('Bekijk type', OWO_LANGUAGE_DOMAIN),
                'update_item' => __('Werk type bij', OWO_LANGUAGE_DOMAIN),
                'add_new_item' => __('Voeg type toe', OWO_LANGUAGE_DOMAIN),
                'new_item_name' => __('Nieuwe type naam', OWO_LANGUAGE_DOMAIN),
                'not_found' => __('Geen typen gevonden', OWO_LANGUAGE_DOMAIN)
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
                'name' => __('Show on', OWO_LANGUAGE_DOMAIN),
                'singular_name' => __('Show on', OWO_LANGUAGE_DOMAIN),
                'search_items' => __('Search show on', OWO_LANGUAGE_DOMAIN),
                'all_items' => __('All show on', OWO_LANGUAGE_DOMAIN),
                'edit_item' => __('Edit show on', OWO_LANGUAGE_DOMAIN),
                'view_item' => __('View show on', OWO_LANGUAGE_DOMAIN),
                'update_item' => __('Update show on', OWO_LANGUAGE_DOMAIN),
                'add_new_item' => __('Add show on', OWO_LANGUAGE_DOMAIN),
                'new_item_name' => __('New show on', OWO_LANGUAGE_DOMAIN),
                'not_found' => __('No show on found', OWO_LANGUAGE_DOMAIN)
            ]
        ],
    ],
];
