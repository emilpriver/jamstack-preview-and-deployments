<?php

function getNextjsPreviewOptions()
{
    return get_option(NEXTJS_SETTINGS_OPTIONS_KEY, []);
}

function getNextjsPreviewWebhookUrl()
{
    $options = getNextjsPreviewOptions();
    return !empty($options['webhook_url']) ? $options['webhook_url'] : null;
}

function getNextjsPreviewWebhookMethod()
{
    $options = getNextjsPreviewOptions();
    return !empty($options['webhook_method']) ? $options['webhook_method'] : null;
}

function getNextjsPreviewMethod()
{
    $options = getNextjsPreviewOptions();
    return !empty($options['next_preview_method']) ? $options['next_preview_method'] : null;
}

function getNextJSPreviewStatusBadgeUrl()
{
    $options = getNextjsPreviewOptions();
    return !empty($options['deployment_badge_url']) ? $options['deployment_badge_url'] : null;
}

function getNextJSPreviewPostTypes()
{
    $return = [];
    foreach (get_post_types(null, 'objects') as $choice) {
        $return[$choice->name] = $choice->labels->name;
    }
    return $return;
}

function getNextJSPreviewActivePostTypes()
{
    $options = getNextjsPreviewOptions();
    return !empty($options['webhook_post_types']) ? $options['webhook_post_types'] : [];
}

function getNextJSPreviewSelectedPostTypes() {
    $options = getNextjsPreviewOptions();
    return !empty($options['webhook_post_types_selected']) ? $options['webhook_post_types_selected'] : [];
}

function getNextjsPreviewEndpointUrl()
{
    $options = getNextjsPreviewOptions();
    return !empty($options['next_preview_endpoint']) ? $options['next_preview_endpoint'] : null;
}

function getNextjsPreviewEndpointSecret()
{
    $options = getNextjsPreviewOptions();
    return !empty($options['next_preview_endpoint_secret']) ? $options['next_preview_endpoint_secret'] : null;
}
