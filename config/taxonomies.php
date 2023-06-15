<?php declare(strict_types=1);

return [
    'openwoo-type' => [
        'object_types' => ['openwoo-item'],
        'args'         => [
            'public' => true,
            'show_in_rest' => true,
            'hierarchical' => false,
            'meta_box_cb' => 'post_categories_meta_box',
            'labels' => [
                'name' => __('Types', OWO_LANGUAGE_DOMAIN),
                'singular_name' => __('Type', OWO_LANGUAGE_DOMAIN),
                'search_items' => __('Search types', OWO_LANGUAGE_DOMAIN),
                'all_items' => __('All types', OWO_LANGUAGE_DOMAIN),
                'edit_item' => __('Edit type', OWO_LANGUAGE_DOMAIN),
                'view_item' => __('View type', OWO_LANGUAGE_DOMAIN),
                'update_item' => __('Update type', OWO_LANGUAGE_DOMAIN),
                'add_new_item' => __('Add type', OWO_LANGUAGE_DOMAIN),
                'new_item_name' => __('New type name', OWO_LANGUAGE_DOMAIN),
                'not_found' => __('No types found', OWO_LANGUAGE_DOMAIN)
            ]
        ],
    ],
    'openwoo-show-on' => [
        'object_types' => ['openwoo-item'],
        'args'         => [
            'public' => true,
            'show_in_rest' => true,
            'hierarchical' => false,
            'meta_box_cb' => 'post_categories_meta_box',
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
