<?php
ob_start();
require "includes/session.php";
require "includes/config.php";
header('Content-Type: application/json');
ob_clean();

try {
    // Validate input
    if (!isset($_POST['id'])) {
        throw new Exception('Token ID is required');
    }

    $id = intval($_POST['id']);

    // First check if token exists
    $checkQuery = "SELECT user_name FROM api WHERE id = ?";
    $checkStmt = $conn->prepare($checkQuery);
    
    if (!$checkStmt) {
        throw new Exception("Prepare check failed: " . $conn->error);
    }

    $checkStmt->bind_param("i", $id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows === 0) {
        throw new Exception('Token not found');
    }

    $tokenData = $checkResult->fetch_assoc();
    $userName = $tokenData['user_name'];

    // Delete the token
    $deleteQuery = "DELETE FROM api WHERE id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    
    if (!$deleteStmt) {
        throw new Exception("Prepare delete failed: " . $conn->error);
    }

    $deleteStmt->bind_param("i", $id);

    if ($deleteStmt->execute()) {
        if ($deleteStmt->affected_rows > 0) {
            $response = [
                'status' => 'success',
                'message' => 'Token deleted successfully',
                'data' => [
                    'id' => $id,
                    'user_name' => $userName
                ]
            ];
        } else {
            throw new Exception('Failed to delete token');
        }
    } else {
        throw new Exception('Delete operation failed: ' . $deleteStmt->error);
    }

    ob_clean();
    echo json_encode($response);

} catch (Exception $e) {
    http_response_code(400);
    ob_clean();
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
ob_end_flush();
