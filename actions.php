<?php
/**
 * Register function to send webhook
 */
function NextJSSendDeployWebhookRequest() {
    $url = getNextjsPreviewWebhookUrl();
    if(getNextjsPreviewWebhookMethod() === 'POST') {
        wp_safe_remote_post($url);
    } else {
        wp_safe_remote_get($url);
    }
}
add_action( 'nextjs_preview_deploy_webhook', 'NextJSSendDeployWebhookRequest' );

/**
 * Trigger deploy if post update
 */
function checkIfAutoDeployWebsite($id)
{
    if (get_post_status($id) === 'draft') {
        return;
    }
    if (wp_is_post_revision($id) || wp_is_post_autosave($id)) {
        return;
    }

    $postType = get_post_type($id);
    if (in_array($postType, getNextJSPreviewActivePostTypes())) {
        do_action('nextjs_preview_deploy_webhook');
    }
}
add_action('save_post', 'checkIfAutoDeployWebsite', 10, 3);
