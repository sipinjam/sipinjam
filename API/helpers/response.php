<?php

function response($success, $message, $data = null, $error = null, $statusCode = null) {
   header('Content-Type: application/json');
   http_response_code($statusCode);

   $response = ([
        "success" => $success,
        "message" => $message,
        "data" => $data,
        "error" => $error,
    ]);

    echo json_encode($response);
    exit();
}

?>