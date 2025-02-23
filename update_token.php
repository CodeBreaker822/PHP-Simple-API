<?php
ob_start();
require "includes/session.php";
require "includes/config.php";
header('Content-Type: application/json');
ob_clean();

try {
    if (!isset($_POST['id']) || !isset($_POST['permission']) || !isset($_POST['value'])) {
        throw new Exception('Missing required parameters. Received: ' . json_encode($_POST));
    }

    $id = intval($_POST['id']);
    $permission = mysqli_real_escape_string($conn, $_POST['permission']);
    $value = $_POST['value'] === 'true' ? 'true' : 'false';

    $allowedPermissions = ['canGET', 'canPOST', 'canPUT', 'canPATCH', 'canDELETE', 'status'];
    if (!in_array($permission, $allowedPermissions)) {
        throw new Exception('Invalid permission type: ' . $permission);
    }

    $query = "UPDATE api SET $permission = ?, last_modified = NOW() WHERE id = ?";

    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("si", $value, $id);

    if ($stmt->execute()) {
        error_log("Affected rows: " . $stmt->affected_rows);
        if ($stmt->affected_rows > 0 || $stmt->affected_rows === 0) {
            $response = [
                'status' => 'success',
                'message' => ucfirst($permission) . ' updated successfully',
                'data' => [
                    'id' => $id,
                    'permission' => $permission,
                    'value' => $value,
                    'timestamp' => date('Y-m-d H:i:s')
                ]
            ];
        } else {
            throw new Exception('Token not found');
        }
    } else {
        throw new Exception('Failed to update: ' . $stmt->error);
    }

    ob_clean();
    echo json_encode($response);

} catch (Exception $e) {
    error_log("Update token error: " . $e->getMessage());
    http_response_code(400);
    ob_clean();
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
ob_end_flush(); 