<?php

header('Access-Control-Allow-Origin: *');
require_once "../classes/AppStart.php";

AppStart::startApp();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET': { 
        //get user

        if (isset($_SESSION['username'])) {
            $response = UserRequestHandler::get($_GET);
        } 
        else {
            http_response_code(401);
            $response = [
                'authorized' => false
            ];
        }

        break;
    }
    case 'POST': 
    {
        //register
        $postData = json_decode(file_get_contents("php://input"), true);

        try {
            $response = UserRequestHandler::post($postData);
        }
        catch (Exception $exception) {
            http_response_code(500);
            $response = [
                'success' => false,
                'error' => $exception->getMessage()
            ];
        }

        break;
    }
    default: {
        // request method not supported
    }
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);

?>
