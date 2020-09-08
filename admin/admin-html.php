<?php
/**
 * This file is used to display information inside of Wordpress Admin
 */

/**
 * Dispaly information in admin
 * 
 * @return HTML
 */
function nextJSPreviewSettingsPage()
{
    ?>
    <div class="wrap">
        <h1><?php echo get_admin_page_title(); ?></h1>
        <p> This plugin is used to be able to send a user to a preview of your Next.JS website to show preview data.</p>
        <p> This plugin does not automatically make your Next.JS website work with preview data. You still need to make your Next.JS application be able to handle the data. </p>
        <p>
            More information here:
            <ol>
                <li>
                    <a href="https://github.com/vercel/next.js/tree/canary/examples/cms-wordpress"> https://github.com/vercel/next.js/tree/canary/examples/cms-wordpress </a>
                </li>
                <li>
                    <a href="https://nextjs.org/docs/getting-started"> https://nextjs.org/docs/getting-started </a>
                </li>
            </ol>
        </p>
        <form method="post" action="<?php echo esc_url(admin_url('options.php')); ?>">
            <?php
            settings_fields(NEXTJS_SETTINGS_OPTIONS_KEY);
            do_settings_sections(NEXTJS_SETTINGS_OPTIONS_KEY);
            submit_button(__('Save Settings', NEXTJS_TEXT_DOMAIN), 'primary', 'submit', false);
            ?>
        </form>
    </div>
    <?php
}