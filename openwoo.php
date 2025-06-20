<?php

declare(strict_types=1);

/**
 * Plugin Name:       Yard | OpenWOO
 * Plugin URI:        https://www.yard.nl/
 * Description:       Voegt de OpenWOO functionaliteit toe aan de website.
 * Version:           4.2.10
 * Author:            Yard | Digital Agency
 * Author URI:        https://www.yard.nl/
 * License:           EUPL-1.2
 * License URI:       https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12
 * Text Domain:       openwoo
 * Domain Path:       /languages
 */

use Yard\OpenWOO\Autoloader;
use Yard\OpenWOO\Foundation\Plugin;

/**
 * If this file is called directly, abort.
 */
if (!defined('WPINC')) {
    die;
}

define('OWO_FILE', __FILE__);
define('OWO_SLUG', basename(__FILE__, '.php'));
define('OWO_DIR', basename(__DIR__));
define('OWO_ROOT_PATH', __DIR__);
define('OWO_VERSION', '4.2.10');

/**
 * Manual loaded file: the autoloader.
 */
require_once __DIR__ . '/autoloader.php';
$autoloader = new Autoloader();

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once(__DIR__ . '/vendor/autoload.php');
}

/**
 * Begin execution of the plugin
 *
 * This hook is called once any activated plugins have been loaded. Is generally used for immediate filter setup, or
 * plugin overrides. The plugins_loaded action hook fires early, and precedes the setup_theme, after_setup_theme, init
 * and wp_loaded action hooks.
 */
add_action('plugins_loaded', function () {
    $plugin = (new Plugin(__DIR__));

	add_action('after_setup_theme', function() use ($plugin) {
		$plugin->boot();
		do_action('yard/openwoo/plugin', $plugin);
	});
}, 10);
