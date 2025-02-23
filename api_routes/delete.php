<?php

require_once 'includes/config.php';

function handleDelete($request, $id) {
    global $conn;

    switch($request) {
        case "deleteClass":
            deleteClass("class", $id, $conn); 
            break;
        case "deleteGrade":
            deleteGrade("grades", $id, $conn);
            break;
        case "deleteGradeLevel":
            deleteGradeLevel("grade_level", $id, $conn);
            break;
        case "deleteInventory":
            deleteInventory("inventory", $id, $conn);
            break;
        case "deleteStudent":
            deleteStudent("students", $id, $conn);
            break;
        case "deleteSubject":
            deleteSubject("subject", $id, $conn);
            break;
        case "deleteTeacher":
            deleteTeacher("teacher", $id, $conn);
            break;
        case "deleteTeacherFile":
            deleteTeacherFile("teacher_files", $id, $conn);
            break;
        default:
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Request function not found']);
            break;
    }
}

//Delete class
function deleteClass($table, $id, $conn) {
    try {
        // Prevent SQL injection
        $allowedTables = ['class'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate ID
        if (!isset($id)) {
            throw new Exception("Class ID is required");
        }

        // Check if class exists
        $checkStmt = $conn->prepare("SELECT Class_ID FROM $table WHERE Class_ID = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Class not found");
        }

        // Delete the class
        $stmt = $conn->prepare("DELETE FROM $table WHERE Class_ID = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Class deleted successfully'
                ]);
            } else {
                throw new Exception("Failed to delete class");
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(400);
        echo json_encode([
            'status' => 'error', 
            'message' => $e->getMessage()
        ]);
    }
}

//Delete grade
function deleteGrade($table, $id, $conn) {
    try {
        $allowedTables = ['grades'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        if (!isset($id)) {
            throw new Exception("Grade ID is required");
        }

        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Grade not found");
        }

        $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Grade deleted successfully'
                ]);
            } else {
                throw new Exception("Failed to delete grade");
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(400);
        echo json_encode([
            'status' => 'error', 
            'message' => $e->getMessage()
        ]);
    }
}

//Delete grade level
function deleteGradeLevel($table, $id, $conn) {
    try {
        $allowedTables = ['grade_level'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        if (!isset($id)) {
            throw new Exception("Grade Level ID is required");
        }

        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Grade Level not found");
        }

        $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Grade Level deleted successfully'
                ]);
            } else {
                throw new Exception("Failed to delete grade level");
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(400);
        echo json_encode([
            'status' => 'error', 
            'message' => $e->getMessage()
        ]);
    }
}

//Delete inventory
function deleteInventory($table, $id, $conn) {
    try {
        $allowedTables = ['inventory'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        if (!isset($id)) {
            throw new Exception("Inventory ID is required");
        }

        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Inventory not found");
        }

        $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Inventory deleted successfully'
                ]);
            } else {
                throw new Exception("Failed to delete inventory");
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(400);
        echo json_encode([
            'status' => 'error', 
            'message' => $e->getMessage()
        ]);
    }
}

//Delete student
function deleteStudent($table, $id, $conn) {
    try {
        $allowedTables = ['students'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        if (!isset($id)) {
            throw new Exception("Student ID is required");
        }

        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Student not found");
        }

        $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Student deleted successfully'
                ]);
            } else {
                throw new Exception("Failed to delete student");
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(400);
        echo json_encode([
            'status' => 'error', 
            'message' => $e->getMessage()
        ]);
    }
}

//Delete subject
function deleteSubject($table, $id, $conn) {
    try {
        $allowedTables = ['subject'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        if (!isset($id)) {
            throw new Exception("Subject ID is required");
        }

        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Subject not found");
        }

        $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Subject deleted successfully'
                ]);
            } else {
                throw new Exception("Failed to delete subject");
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(400);
        echo json_encode([
            'status' => 'error', 
            'message' => $e->getMessage()
        ]);
    }
}

//Delete teacher
function deleteTeacher($table, $id, $conn) {
    try {
        $allowedTables = ['teacher'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        if (!isset($id)) {
            throw new Exception("Teacher ID is required");
        }

        $checkStmt = $conn->prepare("SELECT Teacher_ID FROM $table WHERE Teacher_ID = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Teacher not found");
        }

        $stmt = $conn->prepare("DELETE FROM $table WHERE Teacher_ID = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Teacher deleted successfully'
                ]);
            } else {
                throw new Exception("Failed to delete teacher");
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(400);
        echo json_encode([
            'status' => 'error', 
            'message' => $e->getMessage()
        ]);
    }
}

//Delete teacher file
function deleteTeacherFile($table, $id, $conn) {
    try {
        $allowedTables = ['teacher_files'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        if (!isset($id)) {
            throw new Exception("File ID is required");
        }

        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("File not found");
        }

        $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'File deleted successfully'
                ]);
            } else {
                throw new Exception("Failed to delete file");
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(400);
        echo json_encode([
            'status' => 'error', 
            'message' => $e->getMessage()
        ]);
    }
}
