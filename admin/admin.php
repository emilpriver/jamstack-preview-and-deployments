<?php
/**
 * Admin file. Is used to register settings fields and display information
 */

require_once 'functions.php';
require_once 'fields.php';
require_once 'admin-html.php';

add_action('admin_init', function () {
    $key = JAMSTACK_PREVIEW_AND_DEPLOYMENTS_OPTIONS_KEY;

    register_setting($key, $key, [__CLASS__, 'sanitize']);
    add_settings_section('general', __('General', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN), '__return_empty_string', $key);
    add_settings_section('preview', __('Preview', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN), '__return_empty_string', $key);
    add_settings_section('postTypes', __('Post types', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN), '__return_empty_string', $key);

    $option = jamstackPreviewAndDeploymentsGetOptions();

    add_settings_field(
        'webhook_url',
        __('Build Hook URL', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN),
        'jamstackPreviewAndDeploymentsFieldUrl',
        $key,
        'general', [
            'name' => "{$key}[webhook_url]",
            'value' => jamstackPreviewAndDeploymentsGetWebhookUrl(),
            'description' => sprintf(
                __(
                    'Your Build Hook URL. This url is used to start a build when needed, ex on a post change. You have more information at your providers website. <br> <a href="%1s" target="_blank" rel="noopener noreferrer">Vercel Docs</a> <br><a href="%2s" target="_blank" rel="noopener noreferrer">Netlify Docs</a> <br>',
                    JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN
                ),
                'https://vercel.com/docs/more/deploy-hooks',
                'https://docs.netlify.com/site-deploys/create-deploys/#build-hooks'
            ),
        ]
    );

    add_settings_field(
        'webhook_method',
        __('Hook Method', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN),
        'jamstackPreviewAndDeploymentsFieldSelect',
        $key,
        'general', [
            'name' => "{$key}[webhook_method]",
            'value' => jamstackPreviewAndDeploymentsGetWebhookMethod(),
            'choices' => [
                'post' => 'POST',
                'get' => 'GET',
            ],
            'default' => 'post',
            'description' => __('The way the plugin send the request ', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN),
        ]
    );

    add_settings_field(
        'deployment_badge_url',
        __('Deployment Status Badge Image URL', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN),
        'jamstackPreviewAndDeploymentsFieldUrl',
        $key,
        'general', [
            'name' => "{$key}[deployment_badge_url]",
            'value' => jamstackPreviewAndDeploymentsStatusBadgeUrl(),
            'description' => __('Your projects status image url. This image will be shown in admin top bar.', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN),
        ]
    );

    add_settings_field(
        'JamstackPreviewAndDeploymentsDivider1',
        '',
        'jamstackPreviewAndDeploymentsLineDivider',
        $key,
        'general', [
            'name' => "{$key}[JamstackPreviewAndDeploymentsDivider1]",
            'value' => '',
            'description' => null,
        ]
    );

    add_settings_field(
        'jamstack_preview_endpoint',
        __('Preview URL', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN),
        'jamstackPreviewAndDeploymentsFieldUrl',
        $key,
        'preview', [
            'name' => "{$key}[jamstack_preview_endpoint]",
            'value' => jamstackPreviewAndDeploymentsPreviewEndpointUrl(),
            'description' => sprintf(
                __(
                    'URL to your jamstack endpoint that show preview data. <br> ex: https://domain.ltd/api/preview/ <br> This plugin will add  <strong> id, secret </strong> and <strong> postType </strong> to the url. <br> ex: https://domain.ltd/api/preview?id=x&secret=x&postType=post',
                    JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN
                )
            ),
        ]
    );

    add_settings_field(
        'jamstack_preview_endpoint_secret',
        __('Preview Secret', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN),
        'jamstackPreviewAndDeploymentsFieldText',
        $key,
        'preview', [
            'name' => "{$key}[jamstack_preview_endpoint_secret]",
            'value' => jamstackPreviewAndDeploymentsEndpointSecret(),
            'description' => __('Preview secret', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN ),
        ]
    );

    add_settings_field(
        'jamstack_preview_method',
        __('Preview method', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN),
        'jamstackPreviewAndDeploymentsFieldSelect',
        $key,
        'general', [
            'name' => "{$key}[jamstack_preview_method]",
            'value' => jamstackPreviewAndDeploymentsPreviewMethod(),
            'choices' => [
                'redirect' => 'Redirect',
                'iframe' => 'Iframe',
            ],
            'default' => 'redirect',
            'description' => __('The way to show the website for the user. Either redirect the user to the preview page or show the preview page inside of an iframe', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN),
        ]
    );

    add_settings_field(
        'JamstackPreviewAndDeploymentsDivider2',
        '',
        'jamstackPreviewAndDeploymentsLineDivider',
        $key,
        'preview', [
            'name' => "{$key}[JamstackPreviewAndDeploymentsDivider2]",
            'value' => '',
            'description' => null,
        ]
    );

    add_settings_field(
        'webhook_post_types_selected',
        __('Post Types with changed preview url', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN),
        'jamstackPreviewAndDeploymentsFieldCheckboxes',
        $key,
        'postTypes', [
            'name' => "{$key}[webhook_post_types_selected]",
            'value' => isset($option['webhook_post_types_selected']) ? $option['webhook_post_types_selected'] : [],
            'choices' => jamstackPreviewAndDeploymentsPostTypes(),
            'description' => __('Select post types that will use the preview url', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN),
            'legend' => 'Post Types',
        ]
    );

    add_settings_field(
        'webhook_post_types',
        __('Automatic Deploy Post Types', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN),
        'jamstackPreviewAndDeploymentsFieldCheckboxes',
        $key,
        'postTypes', [
            'name' => "{$key}[webhook_post_types]",
            'value' => isset($option['webhook_post_types']) ? $option['webhook_post_types'] : [],
            'choices' => jamstackPreviewAndDeploymentsPostTypes(),
            'description' => __('Select post types that will trigger a deploy on deleted, edited or added.', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN),
            'legend' => 'Post Types',
        ]
    );
});
