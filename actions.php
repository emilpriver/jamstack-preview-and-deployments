<?php
/**
 * Register actions which should be triggered on surtain times
 */

/**
 * Register function to send webhook
 *
 * @return None
 */
function jamstackPreviewAndDeploymentsSendDeployWebhookRequest()
{
    $url = jamstackPreviewAndDeploymentsGetWebhookUrl();
    if (jamstackPreviewAndDeploymentsGetWebhookMethod() === 'POST') {
        return wp_safe_remote_post($url);
    }

    wp_safe_remote_get($url);
}
add_action('jamstack_preview_deployments_deploy_webhook', 'jamstackPreviewAndDeploymentsSendDeployWebhookRequest');

/**
 * Trigger deploy if post update
 *
 * @param integer $post_id post_id
 */
function jamstackPreviewAndDeploymentscheckIfAutoDeployWebsite($post_id)
{
    if (get_post_status($post_id) === 'draft') {
        return;
    }
    if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
        return;
    }

    $postType = get_post_type($post_id);
    if (in_array($postType, jamstackPreviewAndDeploymentsActivePostTypes())) {
        do_action('jamstack_preview_deployments_deploy_webhook');
    }
}
add_action('save_post', 'jamstackPreviewAndDeploymentscheckIfAutoDeployWebsite', 10, 3);
