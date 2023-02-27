<?php

header('Access-Control-Allow-Origin: *');
require_once "../classes/AppStart.php";

AppStart::startApp();

$response = [];

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET': { 

        // check login status
        if (isset($_SESSION['username'])) {
            $response = [
                'logged' => true,
                'username' => $_SESSION['username']
            ];
        } 
        else {
            $response = [
                'logged' => false
            ];
        }
        break;
    }
    case 'POST': { 
        // login
        $sessionData = json_decode(file_get_contents("php://input"), true);
        $response = SessionRequestHandler::post($sessionData['username'], $sessionData['password']);

        break;
    }
    case 'DELETE': { 
        // logout
        session_destroy();
        break;
    }
    default: {
        // request method not supported
    }
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);

?>
