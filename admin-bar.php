<?php
/**
 * Register admin bar functions
 */

 /**
  * Register admin bar function to trigger deploy website from admin
  *
  * @return None
  */
function TriggerDeployButton($bar)
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

add_action('admin_bar_menu', 'TriggerDeployButton', 50);
