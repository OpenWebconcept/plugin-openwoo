<?php

declare(strict_types=1);

/**
 * Plugin Name:       Yard | OpenWOO
 * Plugin URI:        https://www.yard.nl/
 * Description:       Adds OpenWOO implementation
 * Version:           4.1.0
 * Author:            Yard | Digital Agency
 * Author URI:        https://www.yard.nl/
 * License:           GPL-3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       openwoo
 * Domain Path:       /languages
 */

use Yard\OpenWOO\Autoloader;
use Yard\OpenWOO\Foundation\Plugin;

/**
 * If this file is called directly, abort.
 */
if (! defined('WPINC')) {
    die;
}

define('OWO_FILE', __FILE__);
define('OWO_SLUG', basename(__FILE__, '.php'));
define('OWO_LANGUAGE_DOMAIN', OWO_SLUG);
define('OWO_DIR', basename(__DIR__));
define('OWO_ROOT_PATH', __DIR__);
define('OWO_VERSION', '4.1.0');

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
    $plugin = (new Plugin(__DIR__))->boot();
}, 10);
