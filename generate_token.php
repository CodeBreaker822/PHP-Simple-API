<?php
ob_start(); // Start output buffering
require "includes/session.php";
require "includes/config.php";

header('Content-Type: application/json');

// Clear any previous output
ob_clean();

function generateBase62Token($length = 255) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    
    // Get random bytes
    $bytes = random_bytes($length);
    
    // Convert to base62
    for ($i = 0; $i < $length; $i++) {
        $token .= $chars[ord($bytes[$i]) % 62];
    }
    
    return $token;
}

try {
    // Get POST data
    $postData = $_POST;

    // Validate input
    if (!isset($postData['user_name']) || empty($postData['user_name'])) {
        throw new Exception('Username is required');
    }

    // Generate new token
    $token = generateBase62Token();
    $username = mysqli_real_escape_string($conn, $postData['user_name']);
    
    // Fix permission checks - explicitly check for 'true' string
    $canGET = ($postData['canGET'] === 'true' || $postData['canGET'] === true) ? 'true' : 'false';
    $canPOST = ($postData['canPOST'] === 'true' || $postData['canPOST'] === true) ? 'true' : 'false';
    $canPUT = ($postData['canPUT'] === 'true' || $postData['canPUT'] === true) ? 'true' : 'false';
    $canPATCH = ($postData['canPATCH'] === 'true' || $postData['canPATCH'] === true) ? 'true' : 'false';
    $canDELETE = ($postData['canDELETE'] === 'true' || $postData['canDELETE'] === true) ? 'true' : 'false';
    $status = 'true'; // Default active status
    
    // Insert into database
    $query = "INSERT INTO api (user_name, token, canGET, canPOST, canPUT, canPATCH, canDELETE, status, last_modified) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssss", 
        $username, 
        $token, 
        $canGET, 
        $canPOST,
        $canPUT,
        $canPATCH, 
        $canDELETE,
        $status
    );
    
    if ($stmt->execute()) {
        $response = [
            'status' => 'success',
            'message' => 'Token generated successfully',
            'data' => [
                'token' => $token,
                'username' => $username,
                'permissions' => [
                    'canGET' => $canGET,
                    'canPOST' => $canPOST,
                    'canPUT' => $canPUT,
                    'canPATCH' => $canPATCH,
                    'canDELETE' => $canDELETE
                ],
                'status' => $status
            ]
        ];
        ob_clean(); // Clear buffer before output
        echo json_encode($response);
    } else {
        throw new Exception('Failed to save token');
    }

} catch (Exception $e) {
    http_response_code(400);
    $response = [
        'status' => 'error',
        'message' => $e->getMessage()
    ];
    ob_clean(); // Clear buffer before output
    echo json_encode($response);
}
ob_end_flush(); // End output buffering
