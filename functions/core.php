<?php

class ToGODerCore
{
    /**
     * @param array $messages
     * @return array
     */
    public function get_message($messages)
    {
        $jwt = $this->get_jwt();
        $body = wp_remote_post(
            get_option("togoder_custom_url") . "/api/chat",
            array(
                "body" => json_encode(array(
                    "prompts" => $messages,
                    "model" => "gpt4o-mini",
                    "humanPrompt" => true,
                    "keepGoing" => true,
                    "outsideBox"=> true,
                    "communicationStyle"=>"default"
                )),
                "headers" => array(
                    "Content-Type" => "application/json",
                    "Authorization" => "Bearer " . $jwt
                )
            )
        );

        if (is_wp_error($body)) {
            return ["Error"=>"An error has occurred"];
        }

        return json_decode($body["body"]);
    }

    private function get_jwt(): string
    {
        $jwt = get_option("togoder_jwt_key");
        $expires = intval(get_option("togoder_jwt_expires"));

        if ($expires == 0 || $expires < time() - 60 * 60 * 24) {
            $jwt = $this->generate_jwt();
            update_option("togoder_jwt_key", $jwt);
            update_option("togoder_jwt_expires", strval(time()));
        }

        return $jwt;
    }

    private function generate_jwt(): string
    {
        $username = get_option("togoder_username");
        $pw = get_option("togoder_password");

        $response = wp_remote_post(
            get_option("togoder_custom_url") . "/api/auth/signIn",
            array(
                "body" => json_encode(
                    array(
                        "email" => $username,
                        "password" => $pw
                    )
                ),
                "headers" => array(
                    "Content-Type" => "application/json"
                )
            )
        );

        if (is_wp_error($response)) {
            return "";
        }


        $jwt = json_decode($response["body"], true);
        return $jwt["token"];
    }
}