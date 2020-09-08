<?php
/**
 * Functions file which is used to return information
 */

 /**
  * Get all options
  * 
  * @return Array
  */
function getNextjsPreviewOptions()
{
    return get_option(NEXTJS_SETTINGS_OPTIONS_KEY, []);
}

/**
 * Get webhook url
 * 
 * @return String
 */
function getNextjsPreviewWebhookUrl()
{
    $options = getNextjsPreviewOptions();
    return !empty($options['webhook_url']) ? $options['webhook_url'] : null;
}

/**
 * Get webhook method
 * 
 * @return String
 */
function getNextjsPreviewWebhookMethod()
{
    $options = getNextjsPreviewOptions();
    return !empty($options['webhook_method']) ? $options['webhook_method'] : null;
}

/**
 * Get preview method
 * 
 * @return String
 */
function getNextjsPreviewMethod()
{
    $options = getNextjsPreviewOptions();
    return !empty($options['next_preview_method']) ? $options['next_preview_method'] : null;
}

/**
 * Get status badge url
 * 
 * @return String
 */
function getNextJSPreviewStatusBadgeUrl()
{
    $options = getNextjsPreviewOptions();
    return !empty($options['deployment_badge_url']) ? $options['deployment_badge_url'] : null;
}

/**
 * Get all post types
 * 
 * @return Array
 */
function getNextJSPreviewPostTypes()
{
    $return = [];
    foreach (get_post_types(null, 'objects') as $choice) {
        $return[$choice->name] = $choice->labels->name;
    }
    return $return;
}

/**
 * Get active post types which is using auto deploy
 * 
 * @return Array
 */
function getNextJSPreviewActivePostTypes()
{
    $options = getNextjsPreviewOptions();
    return !empty($options['webhook_post_types']) ? $options['webhook_post_types'] : [];
}

/**
 * Get post types which is using preview method
 * 
 * @return Array
 */
function getNextJSPreviewSelectedPostTypes() {
    $options = getNextjsPreviewOptions();
    return !empty($options['webhook_post_types_selected']) ? $options['webhook_post_types_selected'] : [];
}

/**
 * Get preview endpoint
 * 
 * @return String
 */
function getNextjsPreviewEndpointUrl()
{
    $options = getNextjsPreviewOptions();
    return !empty($options['next_preview_endpoint']) ? $options['next_preview_endpoint'] : null;
}

/**
 * Get preview secret
 * 
 * @return String
 */
function getNextjsPreviewEndpointSecret()
{
    $options = getNextjsPreviewOptions();
    return !empty($options['next_preview_endpoint_secret']) ? $options['next_preview_endpoint_secret'] : null;
}
