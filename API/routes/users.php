<?php
require_once __DIR__ . '/../controllers/UsersController.php';
require_once __DIR__ . '/../config/db.php';

$usersController = new UsersController();
$db = new Database();
$method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'GET':
            $usersController->getUsers();
            break;
    
        case 'POST':
            $usersController->createUser();
            break;
    
        default:
            http_response_code(405);
            echo json_encode(array("message" => "Metode tidak diizinkan."));
            break;
    
        }  
?>
