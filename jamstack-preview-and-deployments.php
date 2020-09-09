<?php
/**
 * Plugin Name:       JAMstack preview and deployments
 * Plugin URI:        https://github.com/emilpriver/jamstack-preview-and-deployments
 * Description:       Enable preview and deployments from the wordpress admin to your JAMstack application.
 * Version:           1
 * Author:            Emil Privér
 * Author URI:        https://priver.dev
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * php version 7.2.10
 * 
 * @category Plugins
 * @package  Wordpress
 * @author   Emil Priver <emil@priver.dev>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 * @link     https://priver.dev
 */

define('NEXTJS_PLUGIN_DIRECTORY', plugin_dir_path(__FILE__));
define('NEXTJS_URL_DIRECTORY', plugin_dir_url(__FILE__));
define('NEXTJS_TEXT_DOMAIN', 'NextJSTextDomain');
define('NEXTJS_SETTINGS_KEY', 'NextJSSettings');
define('NEXTJS_SETTINGS_OPTIONS_KEY', 'NextJSSettingsOptionsKey');

/**
 * Needed includes
 */
require_once NEXTJS_PLUGIN_DIRECTORY . 'admin/admin.php';
require_once NEXTJS_PLUGIN_DIRECTORY . 'admin/functions.php';
require_once NEXTJS_PLUGIN_DIRECTORY . 'preview/preview.php';
require_once NEXTJS_PLUGIN_DIRECTORY . 'actions.php';
require_once NEXTJS_PLUGIN_DIRECTORY . 'admin-bar.php';

/**
 * Include scripts and styles
 */
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_script('nextjsPreviewScripts', NEXTJS_URL_DIRECTORY . 'admin/js/admin.js', array(), false, true);
    wp_enqueue_style('nextjsPreviewStyles', NEXTJS_URL_DIRECTORY . 'admin/css/admin.css');
});

/**
 * Create Admin interface
 */

add_action('admin_menu', function () {
    add_options_page(
        __('NextJS Preview', NEXTJS_TEXT_DOMAIN),
        __('NextJS Preview', NEXTJS_TEXT_DOMAIN),
        'manage_options',
        'nextjs-preview-options-page',
        'nextJSPreviewSettingsPage'
    );
});

/**
 * Trigger deploy from admin bar
 */
add_action('wp_ajax_nextjs_preview_deploy_website', 'triggerDeploy');

/**
 * Ajax function that trigger a deploy only if user is loggedin 
 * 
 * @return Number
 */
function triggerDeploy()
{
    do_action('nextjs_preview_deploy_webhook');
    echo 1;
    exit();
}
