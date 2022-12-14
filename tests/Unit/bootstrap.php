<?php

declare(strict_types=1);

/**
 * PHPUnit bootstrap file
 */

/**
 * Load dependencies with Composer autoloader.
 */
require __DIR__ . '/../../vendor/autoload.php';

/**
 * Load all stubs.
 */
$files = glob(__DIR__ . '/../Stubs/WordPress/*.php');
array_map(function ($file) {
    require_once $file;
}, $files);

define('WP_PLUGIN_DIR', __DIR__);
define('WP_DEBUG', false);
define('OWO_FILE', __FILE__);
define('OWO_SLUG', basename(__FILE__, '.php'));
define('OWO_LANGUAGE_DOMAIN', OWO_SLUG);
define('OWO_DIR', basename(__DIR__));
define('OWO_ROOT_PATH', __DIR__);
define('OWO_VERSION', '1.0.13');

/**
 * Bootstrap WordPress Mock.
 */
\WP_Mock::setUsePatchwork(true);
\WP_Mock::bootstrap();

$GLOBALS[OWO_LANGUAGE_DOMAIN] = [
    'active_plugins' => [OWO_DIR . '/' . OWO_FILE],
];

if (! function_exists('get_echo')) {

    /**
     * Capture the echo of a callable function.
     *
     * @param Callable $callable
     * @param array $args
     *
     * @return string
     */
    function get_echo(callable $callable, $args = []): string
    {
        ob_start();
        call_user_func_array($callable, $args);

        return ob_get_clean();
    }
}
