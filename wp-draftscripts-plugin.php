<?php

/**
 * @package WPDraftScripts
 * @version 1.0.0
 * @link https://draftscripts.com/wp-plugin/wp-draftscripts
 */
/**
 * Plugin Name: WP DraftScripts
 * Plugin URI: https://draftscripts.com/wp-plugin/wp-draftscripts
 * Description: This is a custom plugin for DraftScripts WordPress Plugin Development.
 * Version: 1.0.0
 * Author: Kamruzzaman
 * Author URI: https://draftscripts.com/wp-plugin
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp-draftscripts
 */


if (!defined('ABSPATH')) {
    die('You are not allowed to access this file.');
}


if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

define('WP_DRAFTSCRIPTS_VERSION', '1.0.0');
define('WP_DRAFTSCRIPTS_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WP_DRAFTSCRIPTS_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('WP_DRAFTSCRIPTS_PLUGIN_BASENAME', plugin_basename(__FILE__));


use WpDraftScripts\Application;

if (class_exists('WpDraftScripts\Application')) {
    Application::init();
}

if (class_exists('DraftScripts\Activate')) {
    register_activation_hook(__FILE__, array('DraftScripts\Activate', 'register'));
}

if (class_exists('DraftScripts\Deactivate')) {
    register_deactivation_hook(__FILE__, array('DraftScripts\Deactivate', 'register'));
}
