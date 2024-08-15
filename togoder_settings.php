<?php
// Check if user has submitted the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if nonce is set and valid
    if (isset($_POST['custom_settings_nonce']) && wp_verify_nonce($_POST['custom_settings_nonce'], 'save_custom_settings')) {
        // Save settings
        update_option('togoder_custom_url', sanitize_text_field($_POST['custom_url']));
        update_option('togoder_username', sanitize_text_field($_POST['custom_username']));
        update_option('togoder_password', sanitize_text_field($_POST['custom_password']));
        update_option('togoder_custom_name', sanitize_text_field($_POST['custom_name']));
    }
}

// Retrieve existing values
$custom_url = get_option('togoder_custom_url', '');
$custom_username = get_option('togoder_username', '');
$custom_password = get_option('togoder_password', '');
$custom_name = get_option('togoder_custom_name', '');
?>

<div class="wrap">
    <h2>Custom Settings</h2>
    <form method="post" action="">
        <?php wp_nonce_field('save_custom_settings', 'custom_settings_nonce'); ?>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="custom_url">URL</label></th>
                <td><input type="url" id="custom_url" name="custom_url" value="<?php echo esc_attr($custom_url); ?>"
                        class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="custom_username">Username</label></th>
                <td><input type="text" id="custom_username" name="custom_username"
                        value="<?php echo esc_attr($custom_username); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="custom_password">Password</label></th>
                <td><input type="password" id="custom_password" name="custom_password"
                        value="<?php echo esc_attr($custom_password); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="custom_name">Custom Name</label></th>
                <td><input type="text" id="custom_name" name="custom_name" value="<?php echo esc_attr($custom_name); ?>"
                        class="regular-text"></td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" class="button-primary" value="Save Changes">
        </p>
    </form>
</div>