<?php 
function setupNextjsPreviewTemplate($template)
{
    if (is_preview()) {
        $id = get_the_ID();
        $postType = get_post_type($id);
        if (in_array($postType, getNextJSPreviewSelectedPostTypes())) {
            $previewURL = getNextjsPreviewEndpointUrl();
            $previewURLSecret = getNextjsPreviewEndpointSecret();
            if ($previewURL) {
                return NEXTJS_PLUGIN_DIRECTORY . 'preview/template.php';
            }

            return $template;
        }
    }
    return $template;
}
add_filter('template_include', 'setupNextjsPreviewTemplate', 1, 99);