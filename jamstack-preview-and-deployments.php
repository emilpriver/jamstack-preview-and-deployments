<?php
/**
 * Plugin Name:       JAMstack preview and deployments
 * Plugin URI:        https://github.com/emilpriver/jamstack-preview-and-deployments
 * Description:       Enable preview and deployments from the wordpress admin to your JAMstack application.
 * Version:           1.1
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

define('JAMSTACK_PREVIEW_AND_DEPLYOMENTS_PLUGIN_DIRECTORY', plugin_dir_path(__FILE__));
define('JAMSTACK_PREVIEW_AND_DEPLOYMENTS_URL_DIRECTORY', plugin_dir_url(__FILE__));
define('JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN', 'JamstackPreviewAndDEeloymentsTextDomain');
define('JAMSTACK_PREVIEW_AND_DEPLOYMENTS_SETTINGS_KEY', 'JamstackPreviewAndDeploymentsSettings');
define('JAMSTACK_PREVIEW_AND_DEPLOYMENTS_OPTIONS_KEY', 'JamstackPreviewAndDeploymentsOptionsKey');

/**
 * Needed includes
 */
require_once JAMSTACK_PREVIEW_AND_DEPLYOMENTS_PLUGIN_DIRECTORY . 'admin/admin.php';
require_once JAMSTACK_PREVIEW_AND_DEPLYOMENTS_PLUGIN_DIRECTORY . 'admin/functions.php';
require_once JAMSTACK_PREVIEW_AND_DEPLYOMENTS_PLUGIN_DIRECTORY . 'preview/preview.php';
require_once JAMSTACK_PREVIEW_AND_DEPLYOMENTS_PLUGIN_DIRECTORY . 'actions.php';
require_once JAMSTACK_PREVIEW_AND_DEPLYOMENTS_PLUGIN_DIRECTORY . 'admin-bar.php';

/**
 * Include scripts and styles
 */
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_script('jamstackPreviewDeploymentsScripts', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_URL_DIRECTORY . 'admin/js/admin.js', array(), false, true);
    wp_enqueue_style('jamstackPreviewDeploymentsStyles', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_URL_DIRECTORY . 'admin/css/admin.css');
});

/**
 * Create Admin interface
 */

add_action('admin_menu', function () {
    add_options_page(
        __('Jamstack preview and deployments', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN),
        __('Jamstack preview and deployments', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN),
        'manage_options',
        'jamstack-preview-and-deployments',
        'jamstackPreviewAndDeployments'
    );
});

/**
 * Ajax function that trigger a deploy only if user is loggedin 
 * 
 * @return Number
 */
add_action('wp_ajax_jamstack_deploy_website', 'jamstackPreviewAndDeploymentsTriggerDeploy');
function jamstackPreviewAndDeploymentsTriggerDeploy()
{
    do_action('jamstack_preview_deployments_deploy_webhook');
    echo 1;
    wp_die();
}
