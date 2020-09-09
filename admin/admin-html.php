<?php
/**
 * This file is used to display information inside of Wordpress Admin
 */

/**
 * Dispaly information in admin
 * 
 * @return HTML
 */
function jamstackPreviewAndDeployments()
{
    ?>
    <div class="wrap">
        <h1><?php echo get_admin_page_title(); ?></h1>
        <p> This plugin is used to be able to send a user to a preview of your Jamstack website to show preview data.</p>
        <p> This plugin does not automatically make your jamstack web app work with preview data. You still need to make your web app be able to handle the data. </p>
        <p>
            More information here:
            <ol>
                <li>
                    How to setup Next.JS with preview: 
                    <a href="https://github.com/vercel/next.js/tree/canary/examples/cms-wordpress"> https://github.com/vercel/next.js/tree/canary/examples/cms-wordpress </a>
                </li>
            </ol>
        </p>
        <form method="post" action="<?php echo esc_url(admin_url('options.php')); ?>">
            <?php
            settings_fields(JAMSTACK_PREVIEW_AND_DEPLOYMENTS_OPTIONS_KEY);
            do_settings_sections(JAMSTACK_PREVIEW_AND_DEPLOYMENTS_OPTIONS_KEY);
            submit_button(__('Save Settings', JAMSTACK_PREVIEW_AND_DEPLOYMENTS_TEXT_DOMAIN), 'primary', 'submit', false);
            ?>
        </form>
    </div>
    <?php
}