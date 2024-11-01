<?php

function response($status, $message, $data = null, $statusCode = null) {
   header('Content-Type: application/json');
   http_response_code($statusCode);

   $response = ([
        "status" => $status,
        "message" => $message,
        "data" => $data,
        "code" => $statusCode,
    ]);

    echo json_encode($response);
    exit();
}

?>