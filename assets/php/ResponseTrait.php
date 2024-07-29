<?php

namespace Traits;

trait ResponseTrait {
    protected function response ($data, $responseCode = 200)
    {
        header('Content-Type: application/json');
        // Set the response status code
        http_response_code($responseCode);
        // Convert the array to a JSON string and send the response
        echo json_encode($data);
    }
}

