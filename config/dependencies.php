<?php declare(strict_types=1);

return [
    'required' => [
        /**
         * Dependencies upon which the plugin relies.
         *
         * Required: type, label
         * Optional: message
         *
         * Type: plugin
         * - Required: file
         * - Optional: version
         *
         * Type: class
         * - Required: name
         */
        [
            'type'    => 'plugin',
            'label'   => 'CMB2',
            'version' => '2.10.1',
            'file'    => 'cmb2/init.php',
        ],
		[
			'type'  => 'function',
			'label' => '<a href="https://github.com/johnbillion/extended-cpts" target="_blank">Extended CPT library</a>',
			'name'  => 'register_extended_post_type'
		]
    ],
    'suggested' => [
        [
            'type'    => 'plugin',
            'label'   => 'ElasticPress',
            'version' => '4.0.0',
            'file'    => 'elasticpress/elasticpress.php',
        ]
    ]
];
