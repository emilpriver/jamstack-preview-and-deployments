<?php
/**
 * Admin file. Is used to register settings fields and display information
 */

require_once 'functions.php';
require_once 'fields.php';
require_once 'admin-html.php';

add_action('admin_init', function () {
    $key = NEXTJS_SETTINGS_OPTIONS_KEY;

    register_setting($key, $key, [__CLASS__, 'sanitize']);
    add_settings_section('general', __('General', NEXTJS_TEXT_DOMAIN), '__return_empty_string', $key);
    add_settings_section('preview', __('Preview', NEXTJS_TEXT_DOMAIN), '__return_empty_string', $key);
    add_settings_section('postTypes', __('Post types', NEXTJS_TEXT_DOMAIN), '__return_empty_string', $key);

    $option = getNextjsPreviewOptions();

    add_settings_field(
        'webhook_url',
        __('Build Hook URL', NEXTJS_TEXT_DOMAIN),
        'nextjsPreviewFieldUrl',
        $key,
        'general', [
            'name' => "{$key}[webhook_url]",
            'value' => getNextjsPreviewWebhookUrl(),
            'description' => sprintf(
                __(
                    'Your Build Hook URL. This url is used to start a build when needed, ex on a post change. You have more information at your providers website. <br> <a href="%1s" target="_blank" rel="noopener noreferrer">Vercel Docs</a> <br><a href="%2s" target="_blank" rel="noopener noreferrer">Netlify Docs</a> <br>',
                    NEXTJS_TEXT_DOMAIN
                ),
                'https://vercel.com/docs/more/deploy-hooks',
                'https://docs.netlify.com/site-deploys/create-deploys/#build-hooks'
            ),
        ]
    );

    add_settings_field(
        'webhook_method',
        __('Hook Method', NEXTJS_TEXT_DOMAIN),
        'nextJSPreviewFieldSelect',
        $key,
        'general', [
            'name' => "{$key}[webhook_method]",
            'value' => getNextjsPreviewWebhookMethod(),
            'choices' => [
                'post' => 'POST',
                'get' => 'GET',
            ],
            'default' => 'post',
            'description' => __('The way the plugin send the request ', NEXTJS_TEXT_DOMAIN),
        ]
    );

    add_settings_field(
        'deployment_badge_url',
        __('Deployment Status Badge Image URL', NEXTJS_TEXT_DOMAIN),
        'nextjsPreviewFieldUrl',
        $key,
        'general', [
            'name' => "{$key}[deployment_badge_url]",
            'value' => getNextJSPreviewStatusBadgeUrl(),
            'description' => __('Your projects status image url. This image will be shown in admin top bar.', NEXTJS_TEXT_DOMAIN),
        ]
    );

    add_settings_field(
        'NextJSPreviewDivider1',
        '',
        'nextJSLineDivider',
        $key,
        'general', [
            'name' => "{$key}[NextJSPreviewDivider1]",
            'value' => '',
            'description' => null,
        ]
    );

    add_settings_field(
        'next_preview_endpoint',
        __('Nextjs Preview URL', NEXTJS_TEXT_DOMAIN),
        'nextjsPreviewFieldUrl',
        $key,
        'preview', [
            'name' => "{$key}[next_preview_endpoint]",
            'value' => getNextjsPreviewEndpointUrl(),
            'description' => sprintf(
                __(
                    'URL to your nextjs endpoint that show preview data. <br> ex: https://domain.ltd/api/preview/ <br> This plugin will add  <strong> id, secret </strong> and <strong> postType </strong> to the url. <br> ex: https://domain.ltd/api/preview?id=x&secret=x&postType=post',
                    NEXTJS_TEXT_DOMAIN
                )
            ),
        ]
    );

    add_settings_field(
        'next_preview_endpoint_secret',
        __('Nextjs Preview Secret', NEXTJS_TEXT_DOMAIN),
        'nextjsPreviewFieldText',
        $key,
        'preview', [
            'name' => "{$key}[next_preview_endpoint_secret]",
            'value' => getNextjsPreviewEndpointSecret(),
            'description' => __('Preview secret', NEXTJS_TEXT_DOMAIN ),
        ]
    );

    add_settings_field(
        'next_preview_method',
        __('Preview method', NEXTJS_TEXT_DOMAIN),
        'nextJSPreviewFieldSelect',
        $key,
        'general', [
            'name' => "{$key}[next_preview_method]",
            'value' => getNextjsPreviewMethod(),
            'choices' => [
                'redirect' => 'Redirect',
                'iframe' => 'Iframe',
            ],
            'default' => 'redirect',
            'description' => __('The way to show the website for the user. Either redirect the user to the preview page or show the preview page inside of an iframe', NEXTJS_TEXT_DOMAIN),
        ]
    );

    add_settings_field(
        'NextJSPreviewDivider2',
        '',
        'nextJSLineDivider',
        $key,
        'preview', [
            'name' => "{$key}[NextJSPreviewDivider2]",
            'value' => '',
            'description' => null,
        ]
    );

    add_settings_field(
        'webhook_post_types_selected',
        __('Post Types with changed preview url', NEXTJS_TEXT_DOMAIN),
        'nextJSPreviewFieldCheckboxes',
        $key,
        'postTypes', [
            'name' => "{$key}[webhook_post_types_selected]",
            'value' => isset($option['webhook_post_types_selected']) ? $option['webhook_post_types_selected'] : [],
            'choices' => getNextJSPreviewPostTypes(),
            'description' => __('Select post types that will use Next.JS preview url', NEXTJS_TEXT_DOMAIN),
            'legend' => 'Post Types',
        ]
    );

    add_settings_field(
        'webhook_post_types',
        __('Automatic Deploy Post Types', NEXTJS_TEXT_DOMAIN),
        'nextJSPreviewFieldCheckboxes',
        $key,
        'postTypes', [
            'name' => "{$key}[webhook_post_types]",
            'value' => isset($option['webhook_post_types']) ? $option['webhook_post_types'] : [],
            'choices' => getNextJSPreviewPostTypes(),
            'description' => __('Select post types that will trigger a deploy on deleted, edited or added.', NEXTJS_TEXT_DOMAIN),
            'legend' => 'Post Types',
        ]
    );
});
