<?php

require_once 'includes/config.php';

//Add Request Name and connect to a table
function handleGet($request) {
    global $conn;

    
    switch($request) {
        case "getUsers":
            getUsers("user", $conn);
            break;
        case "getClass":
            getClass("class", $conn);
            break;
        case "getGrades":
            getGrades("grades", $conn);
            break;
        case "getGradeLevels":
            getGradeLevels("grade_level", $conn);
            break;
        case "getInventory":
            getInventory("inventory", $conn);
            break;
        case "getParents":
            getParents("parents", $conn);
            break;
        case "getStudents":
            getStudents("students", $conn);
            break;
        case "getSubjects":
            getSubjects("subject", $conn);
            break;
        case "getTeachers":
            getTeachers("teacher", $conn);
            break;
        case "getTeacherFiles":
            getTeacherFiles("teacher_files", $conn);
            break;
        default:
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Request function not found']);
            break;
    }
    
}

//Get all users
function getUsers($table, $conn) {
    try {
        // Prevent SQL injection
        $allowedTables = ['user'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        $stmt = $conn->prepare("SELECT * FROM $table");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $data = [];
                while($user = $result->fetch_assoc()) {

                    unset($user['otp']);
                    unset($user['activation_code']);
                    unset($user['Password']);
                    unset($user['role']);
                    $data[] = $user;
                }
                
                http_response_code(200);
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                http_response_code(404);
                echo json_encode(['status' => 'error', 'message' => 'No users found']);
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Internal server error']);
    }
}

//Get all classes
function getClass($table, $conn) {
    try {
        $allowedTables = ['class'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        $stmt = $conn->prepare("SELECT * FROM $table");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $data = [];
                while($class = $result->fetch_assoc()) {
                    $data[] = $class;
                }
                
                http_response_code(200);
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                http_response_code(404);
                echo json_encode(['status' => 'error', 'message' => 'No classes found']);
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Internal server error']);
    }
}

//Get all grades
function getGrades($table, $conn) {
    try {
        $allowedTables = ['grades'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        $stmt = $conn->prepare("SELECT * FROM $table");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $data = [];
                while($grade = $result->fetch_assoc()) {
                    $data[] = $grade;
                }

                http_response_code(200);
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                http_response_code(404);
                echo json_encode(['status' => 'error', 'message' => 'No grades found']);
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Internal server error']);
    }
}

//Get all grade levels
function getGradeLevels($table, $conn) {
    try {
        $allowedTables = ['grade_level'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        $stmt = $conn->prepare("SELECT * FROM $table");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $data = [];
                while($gradeLevel = $result->fetch_assoc()) {
                    $data[] = $gradeLevel;
                }

                http_response_code(200);
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                http_response_code(404);
                echo json_encode(['status' => 'error', 'message' => 'No grade levels found']);
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Internal server error']);
    }
}

//Get all inventory
function getInventory($table, $conn) {
    try {
        $allowedTables = ['inventory'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        $stmt = $conn->prepare("SELECT * FROM $table");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $data = [];
                while($inventory = $result->fetch_assoc()) {
                    $data[] = $inventory;
                }

                http_response_code(200);
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                http_response_code(404);
                echo json_encode(['status' => 'error', 'message' => 'No inventory found']);
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Internal server error']);
    }
}
//Get all parents
function getParents($table, $conn) {
    try {
        $allowedTables = ['parents'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        $stmt = $conn->prepare("SELECT * FROM $table");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $data = [];
                while($parents = $result->fetch_assoc()) {
                    $data[] = $parents;
                }

                http_response_code(200);
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                http_response_code(404);
                echo json_encode(['status' => 'error', 'message' => 'No parents found']);
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Internal server error']);
    }
}

//Get all students
function getStudents($table, $conn) {
    try {
        $allowedTables = ['students'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        $stmt = $conn->prepare("SELECT * FROM $table");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $data = [];
                while($student = $result->fetch_assoc()) {
                    $data[] = $student;
                }

                http_response_code(200);
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                http_response_code(404);
                echo json_encode(['status' => 'error', 'message' => 'No students found']);
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Internal server error']);
    }
}


//Get all subjects
function getSubjects($table, $conn) {
    try {
        $allowedTables = ['subject'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        $stmt = $conn->prepare("SELECT * FROM $table");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $data = [];
                while($subject = $result->fetch_assoc()) {
                    $data[] = $subject;
                }

                http_response_code(200);
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                http_response_code(404);
                echo json_encode(['status' => 'error', 'message' => 'No subjects found']);
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Internal server error']);
    }
}

//Get all teachers
function getTeachers($table, $conn) {
    try {
        $allowedTables = ['teacher'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        $stmt = $conn->prepare("SELECT * FROM $table");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $data = [];
                while($teacher = $result->fetch_assoc()) {
                    unset($teacher['Password']);

                    $data[] = $teacher;
                }

                http_response_code(200);
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                http_response_code(404);
                echo json_encode(['status' => 'error', 'message' => 'No teachers found']);
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Internal server error']);
    }
}

//Get all teachers files
function getTeacherFiles($table, $conn) {
    try {
        $allowedTables = ['teacher_files'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        $stmt = $conn->prepare("SELECT * FROM $table");
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $data = [];
                while($teacherFile = $result->fetch_assoc()) {
                    $data[] = $teacherFile;
                }

                http_response_code(200);
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                http_response_code(404);
                echo json_encode(['status' => 'error', 'message' => 'No teachers files found']);
            }
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Internal server error']);
    }
}