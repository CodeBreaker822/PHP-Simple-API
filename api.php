<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once 'includes/config.php';
require_once 'includes/verifytoken.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$requestMethod = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? $_GET['id'] : null;
$request = isset($_GET['request']) ? $_GET['request'] : null;
$token = $_GET['token'] ?? $_POST['token'] ?? null;



// Handle source code viewing before token verification - Please remove this once you are done testing and ready to deploy
if ($requestMethod === 'GET' && isset($_GET['getSource'])) {
    $file = $_GET['getSource'];
    $allowedFiles = [
        'get' => 'api_routes/get.php',
        'post' => 'api_routes/post.php',
        'put' => 'api_routes/put.php',
        'patch' => 'api_routes/patch.php',
        'delete' => 'api_routes/delete.php'
    ];
    
    if (isset($allowedFiles[$file])) {
        $filePath = $allowedFiles[$file];
        if (file_exists($filePath)) {
            header('Content-Type: text/plain');
            echo file_get_contents($filePath);
            exit;
        }
    }
    http_response_code(404);
    echo "File not found";
    exit;
}


$data = null;
if (in_array($requestMethod, ['POST', 'PUT', 'PATCH'])) {
    $rawData = file_get_contents('php://input');
    if (!empty($rawData)) {
        $data = json_decode($rawData, true);
    }
    if (empty($data) && !empty($_POST)) {
        $data = $_POST;
    }
    
    if ($data === null) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "No data provided"]);
        exit();
    }
}


verifyToken($token, $requestMethod);

switch ($requestMethod) {
    case 'GET':
        require_once 'api_routes/get.php';
        handleGet($request);
        break;
        
    case 'POST':
        require_once 'api_routes/post.php';
        handlePost($request, $data);
        break;
        
    case 'PUT':
        require_once 'api_routes/put.php';
        if (!$id) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "ID is required for PUT request"]);
            break;
        }
        handleUpdate($request, $id, $data);
        break;
        
    case 'PATCH':
        require_once 'api_routes/patch.php';
        if (!$id) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "ID is required for PATCH request"]);
            break;
        }
        handlePatch($request, $id, $data);
        break;
        
    case 'DELETE':
        require_once 'api_routes/delete.php';
        if (!$id) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "ID is required for DELETE request"]);
            break;
        }
        handleDelete($request, $id);
        break;
        
    default:
        http_response_code(405);
        echo json_encode(["status" => "error", "message" => "Method not allowed"]);
        break;
}
