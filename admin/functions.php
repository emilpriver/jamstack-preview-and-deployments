<?php
/**
 * Functions file which is used to return information
 */

 /**
  * Get all options
  * 
  * @return Array
  */
function jamstackPreviewAndDeploymentsGetOptions()
{
    return get_option(JAMSTACK_PREVIEW_AND_DEPLOYMENTS_OPTIONS_KEY, []);
}

/**
 * Get webhook url
 * 
 * @return String
 */
function jamstackPreviewAndDeploymentsGetWebhookUrl()
{
    $options = jamstackPreviewAndDeploymentsGetOptions();
    return !empty($options['webhook_url']) ? $options['webhook_url'] : null;
}

/**
 * Get webhook method
 * 
 * @return String
 */
function jamstackPreviewAndDeploymentsGetWebhookMethod()
{
    $options = jamstackPreviewAndDeploymentsGetOptions();
    return !empty($options['webhook_method']) ? $options['webhook_method'] : null;
}

/**
 * Get preview method
 * 
 * @return String
 */
function jamstackPreviewAndDeploymentsPreviewMethod()
{
    $options = jamstackPreviewAndDeploymentsGetOptions();
    return !empty($options['jamstack_preview_method']) ? $options['jamstack_preview_method'] : null;
}

/**
 * Get status badge url
 * 
 * @return String
 */
function jamstackPreviewAndDeploymentsStatusBadgeUrl()
{
    $options = jamstackPreviewAndDeploymentsGetOptions();
    return !empty($options['deployment_badge_url']) ? $options['deployment_badge_url'] : null;
}

/**
 * Get all post types
 * 
 * @return Array
 */
function jamstackPreviewAndDeploymentsPostTypes()
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
function jamstackPreviewAndDeploymentsActivePostTypes()
{
    $options = jamstackPreviewAndDeploymentsGetOptions();
    return !empty($options['webhook_post_types']) ? $options['webhook_post_types'] : [];
}

/**
 * Get post types which is using preview method
 * 
 * @return Array
 */
function jamstackPreviewAndDeploymentsSelectedPostTypes() {
    $options = jamstackPreviewAndDeploymentsGetOptions();
    return !empty($options['webhook_post_types_selected']) ? $options['webhook_post_types_selected'] : [];
}

/**
 * Get preview endpoint
 * 
 * @return String
 */
function jamstackPreviewAndDeploymentsPreviewEndpointUrl()
{
    $options = jamstackPreviewAndDeploymentsGetOptions();
    return !empty($options['jamstack_preview_endpoint']) ? $options['jamstack_preview_endpoint'] : null;
}

/**
 * Get preview secret
 * 
 * @return String
 */
function jamstackPreviewAndDeploymentsEndpointSecret()
{
    $options = jamstackPreviewAndDeploymentsGetOptions();
    return !empty($options['jamstack_preview_endpoint_secret']) ? $options['jamstack_preview_endpoint_secret'] : null;
}
