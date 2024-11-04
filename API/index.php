<?php

require_once __DIR__ . '/helpers/HeaderAccessControl.php';

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case "GET":
        echo json_encode(['status' => 'success', 'message' => 'Sipinjam API'], JSON_PRETTY_PRINT);
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
