<?php
namespace arjitc\Cloudflare-Turnstile-PHP;

class Turnstile {

    private $post;
    private $secret;

    function __construct($secret) {
        $this->post   = $_POST;
        $this->secret = $secret;
    }

    public function verify() {
        // set post fields
        $post = [
            'response' => $this->post['cf-turnstile-response'],
            'secret'   => $this->secret,
        ];

        $ch = curl_init("https://challenges.cloudflare.com/turnstile/v0/siteverify");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3); // timeout in 5 seconds

        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);

        // do anything you want with your response
        $response = json_decode($response, true);

        if ($response['success'] == true) {
            return true;
        } elseif ($response['success'] == false) {
            return $response['error-codes']['0'];
        } else {
            return false;
        }
    }
}
