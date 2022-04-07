<?php declare(strict_types=1);

return [
    'indexables' => [
        'openwoo-item'
    ],
    'postStatus' => [
        'publish'
    ],
    'language'   => 'dutch',
    'expire'     => [
        'offset' => '14d',
        'decay'  => 0.5,
    ],
    'search' => [
        'weight' => 2
    ],
    'mapping' => [
        'file' => OWO_ROOT_PATH . '/src/OpenWOO/ElasticPress/mappings/7-0.php'
    ]
];
