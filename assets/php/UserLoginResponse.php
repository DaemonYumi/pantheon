<?php

namespace UserLoginResponseTrait;

require_once 'ResponseTrait.php';

trait UserLoginResponse {
    use Traits\ResponseTrait;

    public function sendResponse($data, $msg) {
        // Create an associative array to hold the response data
        $response = array(
            'status' => $responseCode,
            'message' => $msg,
            'data' => $data
        );

        // Send the JSON response with a 200 OK status code
        $this->response($response, 200);
    }
}

// Create an instance of the class and send the response with dynamic data
// $user_login_res = new UserLoginResponse();
// $user_login_res->sendResponse($data);