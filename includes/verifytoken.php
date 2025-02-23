<?php

function verifyToken($token, $method) {
    global $conn;
    
    if (!$token) {
        http_response_code(401);
        echo json_encode(["status" => "error", "message" => "No API token provided"]);
        exit();
    }
    
    $stmt = $conn->prepare("SELECT * FROM api WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $api = $result->fetch_assoc();

    //Token Debug
    /*
    echo json_encode([
        "debug" => [
            "method" => $method,
            "token" => $token,
            "permissions" => [
                "canGET" => $api['canGET'],
                "canPOST" => $api['canPOST'],
                "canPUT" => $api['canPUT'],
                "canDELETE" => $api['canDELETE'],
                "canPATCH" => $api['canPATCH']
            ],
            "permissionNeeded" => 'can' . strtoupper($method)
        ]
    ]);
    */
    
    if (!$api) {
        http_response_code(401);
        echo json_encode(["status" => "error", "message" => "Invalid API token"]);
        exit();
    }
    
    $permissionColumn = 'can' . strtoupper($method);
    if ($api[$permissionColumn] == "false" || $api[$permissionColumn] == 0 || !$api[$permissionColumn]) {
        http_response_code(403);
        echo json_encode([
            "status" => "error", 
            "message" => "Token doesn't have permission for " . $method . " requests"
        ]);
        exit();
    }
    
    if ($api['status'] == "false" || $api['status'] == 0 || !$api['status']) {
        http_response_code(403);
        echo json_encode(["status" => "error", "message" => "API token is inactive"]);
        exit();
    }
    
    return true;
}