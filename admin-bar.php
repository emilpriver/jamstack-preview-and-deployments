<?php
function trigger_deploy_button($bar)
{
    $bar->add_node(
        array(
            'id' => 'nextjs-preview-deploy-button',
            'parent' => 'top-secondary',
            'href' => 'javascript:void(0)',
            'title' => 'Deploy Website',
            'href' => '',
            'meta' => [
                'class' => 'nextjs-preview-deploy-button'
            ]
        )
    );
}

add_action('admin_bar_menu', 'trigger_deploy_button', 50);
