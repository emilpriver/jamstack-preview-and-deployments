<?php 
/**
 * Handles preview page template
 */

/**
 * Setups preview page for 
 * 
 * @param string $template directory uri to template
 */
function JamstackPreviewAndDeploymentsPreviewTemplate($template)
{
    if (is_preview()) {
        $id = get_the_ID();
        $postType = get_post_type($id);
        if (in_array($postType, jamstackPreviewAndDeploymentsSelectedPostTypes())) {
            $previewURL = jamstackPreviewAndDeploymentsPreviewEndpointUrl();
            $previewURLSecret = jamstackPreviewAndDeploymentsEndpointSecret();
            if ($previewURL) {
                return JAMSTACK_PREVIEW_AND_DEPLYOMENTS_PLUGIN_DIRECTORY . 'preview/template.php';
            }

            return $template;
        }
    }
    return $template;
}
add_filter('template_include', 'JamstackPreviewAndDeploymentsPreviewTemplate', 1, 99);