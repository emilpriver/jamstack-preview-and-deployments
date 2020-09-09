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
            'id' => 'jamstack-preview-deployments-deploy-button',
            'parent' => 'top-secondary',
            'href' => 'javascript:void(0)',
            'title' => 'Deploy Website',
            'href' => '',
            'meta' => [
                'class' => 'jamstack-preview-deployments-deploy-button'
            ]
        )
    );
}

add_action('admin_bar_menu', 'TriggerDeployButton', 50);
