<?php
require_once(plugin_dir_path(__FILE__) . 'core.php');

add_action('rest_api_init', 'togoder_register_custom_api_endpoints');

function togoder_register_custom_api_endpoints()
{
    register_rest_route('togoder/v1', '/send_message', array(
        'methods' => 'POST',
        'callback' => 'togoder_post_message',
        'permission_callback' => 'togoder_is_logged_in'
    )
    );
}

function togoder_post_message(WP_REST_Request $request)
{
    $core = new ToGODerCore();
    $body = json_decode($request->get_body());
    $messages = $body->messages;
    return $core->get_message($messages);
}

function togoder_is_logged_in()
{
    return !empty(wp_get_current_user());
}