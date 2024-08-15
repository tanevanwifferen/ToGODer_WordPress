<?php
function togoder_activate_plugin()
{
    add_option('togoder_custom_url', 'http://chat.togoder.click');
    add_option('togoder_username', 'defaultusername');
    add_option('togoder_password', 'defaultpassword');
    add_option('togoder_custom_name', 'Default Name');
    add_option('togoder_jwt_key', '');
    add_option('togoder_jwt_expires', 0);
}