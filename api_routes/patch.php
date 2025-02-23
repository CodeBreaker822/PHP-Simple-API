<?php

require_once 'includes/config.php';

function handlePatch($request, $id, $data) {
    global $conn;

    switch($request) {
        case "updateClass":
            patchClass("class", $id, $data, $conn); 
            break;
        case "updateGrade":
            patchGrade("grades", $id, $data, $conn);
            break;
        case "updateGradeLevel":
            patchGradeLevel("grade_level", $id, $data, $conn);
            break;
        case "updateInventory":
            patchInventory("inventory", $id, $data, $conn);
            break;
        case "updateStudent":
            patchStudent("students", $id, $data, $conn);
            break;
        case "updateSubject":
            patchSubject("subject", $id, $data, $conn);
            break;
        case "updateTeacher":
            patchTeacher("teacher", $id, $data, $conn);
            break;
        case "updateTeacherFile":
            patchTeacherFile("teacher_files", $id, $data, $conn);
            break;
        default:
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Request function not found']);
            break;
    }
}

//Update class - PATCH (partial update)
function patchClass($table, $id, $data, $conn) {
    try {
        $allowedTables = ['class'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Check if class exists
        $checkStmt = $conn->prepare("SELECT Class_ID FROM $table WHERE Class_ID = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Class not found");
        }

        // Build dynamic UPDATE query based on provided fields
        $updateFields = [];
        $types = '';
        $values = [];

        if (isset($data['Capacity'])) {
            $updateFields[] = "Capacity = ?";
            $types .= "i";
            $values[] = $data['Capacity'];
        }

        if (isset($data['Room_Type'])) {
            $updateFields[] = "Room_Type = ?";
            $types .= "i";
            $values[] = $data['Room_Type'];
        }

        if (isset($data['Section'])) {
            $updateFields[] = "Section = ?";
            $types .= "s";
            $values[] = $data['Section'];
        }

        if (isset($data['Teacher_ID'])) {
            // Check if new Teacher_ID is already assigned
            $teacherStmt = $conn->prepare("SELECT Teacher_ID FROM $table WHERE Teacher_ID = ? AND Class_ID != ?");
            $teacherStmt->bind_param("si", $data['Teacher_ID'], $id);
            $teacherStmt->execute();
            if($teacherStmt->get_result()->num_rows > 0) {
                throw new Exception("Teacher ID is already assigned to another class");
            }
            
            $updateFields[] = "Teacher_ID = ?";
            $types .= "s";
            $values[] = $data['Teacher_ID'];
        }

        if (empty($updateFields)) {
            throw new Exception("No fields to update");
        }

        // Add ID to values array and types
        $values[] = $id;
        $types .= "i";

        // Prepare and execute update query
        $sql = "UPDATE $table SET " . implode(", ", $updateFields) . " WHERE Class_ID = ?";
        $stmt = $conn->prepare($sql);
        
        // Dynamically bind parameters
        $stmt->bind_param($types, ...$values);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows >= 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Class updated successfully'
                ]);
            } else {
                throw new Exception("Failed to update class");
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

//Update grade - PATCH (partial update)
function patchGrade($table, $id, $data, $conn) {
    try {
        $allowedTables = ['grades'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Check if grade exists
        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        if($checkStmt->get_result()->num_rows === 0) {
            throw new Exception("Grade not found");
        }

        // Build dynamic UPDATE query
        $updateFields = [];
        $types = '';
        $values = [];

        if (isset($data['Student_LRN'])) {
            // Check if Student LRN exists
            $studentStmt = $conn->prepare("SELECT Student_LRN FROM students WHERE Student_LRN = ?");
            $studentStmt->bind_param("s", $data['Student_LRN']);
            $studentStmt->execute();
            if($studentStmt->get_result()->num_rows === 0) {
                throw new Exception("Student LRN does not exist");
            }
            $updateFields[] = "Student_LRN = ?";
            $types .= "s";
            $values[] = $data['Student_LRN'];
        }

        $simpleFields = [
            'Advisory' => 's',
            'Subject' => 's',
            'Quarter1' => 's',
            'Quarter2' => 's',
            'Quarter3' => 's',
            'Quarter4' => 's',
            'school_year' => 's'
        ];

        foreach ($simpleFields as $field => $type) {
            if (isset($data[$field])) {
                $updateFields[] = "$field = ?";
                $types .= $type;
                $values[] = $data[$field];
            }
        }

        if (empty($updateFields)) {
            throw new Exception("No fields to update");
        }

        // Add ID to values array and types
        $values[] = $id;
        $types .= "i";

        $sql = "UPDATE $table SET " . implode(", ", $updateFields) . " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$values);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows >= 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Grade updated successfully'
                ]);
            } else {
                throw new Exception("Failed to update grade");
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

//Update grade level - PATCH (partial update)
function patchGradeLevel($table, $id, $data, $conn) {
    try {
        $allowedTables = ['grade_level'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Check if grade level exists
        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        if($checkStmt->get_result()->num_rows === 0) {
            throw new Exception("Grade level not found");
        }

        // Build dynamic UPDATE query
        $updateFields = [];
        $types = '';
        $values = [];

        $gradeFields = [
            'Grade_Level' => 's',
            'Grade 1' => 's',
            'Grade 2' => 's',
            'Grade 3' => 's',
            'Grade 4' => 's',
            'Grade 5' => 's',
            'Grade 6' => 's'
        ];

        foreach ($gradeFields as $field => $type) {
            if (isset($data[$field])) {
                $updateFields[] = "`$field` = ?";
                $types .= $type;
                $values[] = $data[$field];
            }
        }

        if (empty($updateFields)) {
            throw new Exception("No fields to update");
        }

        // Add ID to values array and types
        $values[] = $id;
        $types .= "i";

        $sql = "UPDATE $table SET " . implode(", ", $updateFields) . " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$values);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows >= 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Grade level updated successfully'
                ]);
            } else {
                throw new Exception("Failed to update grade level");
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

//Update inventory - PATCH (partial update)
function patchInventory($table, $id, $data, $conn) {
    try {
        $allowedTables = ['inventory'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Check if inventory exists
        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        if($checkStmt->get_result()->num_rows === 0) {
            throw new Exception("Inventory not found");
        }

        // Build dynamic UPDATE query
        $updateFields = [];
        $types = '';
        $values = [];

        $inventoryFields = [
            'inventory_no' => 's',
            'Item_Name' => 's',
            'Description' => 's',
            'Quantity' => 's',
            'School' => 's',
            'Property_no' => 's',
            'Article' => 's',
            'Date_acquired' => 's',
            'Acquisition_cost' => 's',
            'Fund_source' => 's',
            'Accountable_officer' => 's',
            'Unit' => 's'
        ];

        foreach ($inventoryFields as $field => $type) {
            if (isset($data[$field])) {
                $updateFields[] = "$field = ?";
                $types .= $type;
                $values[] = $data[$field];
            }
        }

        if (empty($updateFields)) {
            throw new Exception("No fields to update");
        }

        // Add ID to values array and types
        $values[] = $id;
        $types .= "i";

        $sql = "UPDATE $table SET " . implode(", ", $updateFields) . " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$values);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows >= 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Inventory updated successfully'
                ]);
            } else {
                throw new Exception("Failed to update inventory");
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

//Update student - PATCH (partial update)
function patchStudent($table, $id, $data, $conn) {
    try {
        $allowedTables = ['students'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Check if student exists
        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        if($checkStmt->get_result()->num_rows === 0) {
            throw new Exception("Student not found");
        }

        // Build dynamic UPDATE query
        $updateFields = [];
        $types = '';
        $values = [];

        // Handle fields that require validation
        if (isset($data['Teacher_ID'])) {
            $teacherStmt = $conn->prepare("SELECT Teacher_ID FROM teacher WHERE Teacher_ID = ?");
            $teacherStmt->bind_param("s", $data['Teacher_ID']);
            $teacherStmt->execute();
            if($teacherStmt->get_result()->num_rows === 0) {
                throw new Exception("Teacher ID does not exist");
            }
            $updateFields[] = "Teacher_ID = ?";
            $types .= "i";
            $values[] = $data['Teacher_ID'];
        }

        if (isset($data['Parents_ID'])) {
            $parentsStmt = $conn->prepare("SELECT id FROM parents WHERE id = ?");
            $parentsStmt->bind_param("s", $data['Parents_ID']);
            $parentsStmt->execute();
            if($parentsStmt->get_result()->num_rows === 0) {
                throw new Exception("Parents ID does not exist");
            }
            $updateFields[] = "Parents_ID = ?";
            $types .= "i";
            $values[] = $data['Parents_ID'];
        }

        if (isset($data['Grade_Level'])) {
            $gradeLevelStmt = $conn->prepare("SELECT Grade_Level FROM grade_level WHERE Grade_Level = ?");
            $gradeLevelStmt->bind_param("s", $data['Grade_Level']);
            $gradeLevelStmt->execute();
            if($gradeLevelStmt->get_result()->num_rows === 0) {
                throw new Exception("Grade Level does not exist");
            }
            $updateFields[] = "Grade_Level = ?";
            $types .= "s";
            $values[] = $data['Grade_Level'];
        }

        if (isset($data['Section'])) {
            $sectionStmt = $conn->prepare("SELECT Section FROM class WHERE Section = ?");
            $sectionStmt->bind_param("s", $data['Section']);
            $sectionStmt->execute();
            if($sectionStmt->get_result()->num_rows === 0) {
                throw new Exception("Section does not exist");
            }
            $updateFields[] = "Section = ?";
            $types .= "s";
            $values[] = $data['Section'];
        }

        // Handle simple fields
        $simpleFields = [
            'Firstname' => 's',
            'Middlename' => 's',
            'Lastname' => 's',
            'Birthdate' => 's',
            'Age' => 'd',
            'Gender' => 'i',
            'Parents' => 's',
            'Nationality' => 's',
            'Religion' => 's',
            'Contact_No' => 's',
            'Address' => 's',
            'Student_LRN' => 's',
            'school_year' => 's',
            'Advisory' => 's'
        ];

        foreach ($simpleFields as $field => $type) {
            if (isset($data[$field])) {
                $updateFields[] = "$field = ?";
                $types .= $type;
                $values[] = $data[$field];
            }
        }

        if (empty($updateFields)) {
            throw new Exception("No fields to update");
        }

        // Add ID to values array and types
        $values[] = $id;
        $types .= "i";

        $sql = "UPDATE $table SET " . implode(", ", $updateFields) . " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$values);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows >= 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Student updated successfully'
                ]);
            } else {
                throw new Exception("Failed to update student");
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

//Update subject - PATCH (partial update)
function patchSubject($table, $id, $data, $conn) {
    try {
        $allowedTables = ['subject'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Check if subject exists
        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        if($checkStmt->get_result()->num_rows === 0) {
            throw new Exception("Subject not found");
        }

        // Build dynamic UPDATE query
        $updateFields = [];
        $types = '';
        $values = [];

        $subjectFields = [
            'Mother_tounge' => 's',
            'Mathematics' => 's',
            'Science' => 's',
            'Filipino' => 's',
            'MAPEH' => 's',
            'Araling_panlipunan' => 's',
            'Esp' => 's',
            'English' => 's'
        ];

        foreach ($subjectFields as $field => $type) {
            if (isset($data[$field])) {
                $updateFields[] = "$field = ?";
                $types .= $type;
                $values[] = $data[$field];
            }
        }

        if (empty($updateFields)) {
            throw new Exception("No fields to update");
        }

        // Add ID to values array and types
        $values[] = $id;
        $types .= "i";

        $sql = "UPDATE $table SET " . implode(", ", $updateFields) . " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$values);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows >= 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Subject updated successfully'
                ]);
            } else {
                throw new Exception("Failed to update subject");
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

//Update teacher - PATCH (partial update)
function patchTeacher($table, $id, $data, $conn) {
    try {
        $allowedTables = ['teacher'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Check if teacher exists
        $checkStmt = $conn->prepare("SELECT Teacher_ID FROM $table WHERE Teacher_ID = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        if($checkStmt->get_result()->num_rows === 0) {
            throw new Exception("Teacher not found");
        }

        // Build dynamic UPDATE query
        $updateFields = [];
        $types = '';
        $values = [];

        // Handle fields that require validation
        if (isset($data['grade_level'])) {
            $gradeLevelStmt = $conn->prepare("SELECT Grade_Level FROM grade_level WHERE Grade_Level = ?");
            $gradeLevelStmt->bind_param("s", $data['grade_level']);
            $gradeLevelStmt->execute();
            if($gradeLevelStmt->get_result()->num_rows === 0) {
                throw new Exception("Grade Level does not exist");
            }
            $updateFields[] = "grade_level = ?";
            $types .= "s";
            $values[] = $data['grade_level'];
        }

        if (isset($data['Section'])) {
            $sectionStmt = $conn->prepare("SELECT Section FROM class WHERE Section = ?");
            $sectionStmt->bind_param("s", $data['Section']);
            $sectionStmt->execute();
            if($sectionStmt->get_result()->num_rows === 0) {
                throw new Exception("Section does not exist");
            }
            $updateFields[] = "Section = ?";
            $types .= "s";
            $values[] = $data['Section'];
        }

        // Handle password separately
        if (isset($data['Password'])) {
            $hashedPassword = password_hash($data['Password'], PASSWORD_DEFAULT);
            $updateFields[] = "Password = ?";
            $types .= "s";
            $values[] = $hashedPassword;
        }

        // Handle simple fields
        $simpleFields = [
            'Firstname' => 's',
            'Middlename' => 's',
            'Lastname' => 's',
            'Birthdate' => 's',
            'Age' => 'd',
            'Gender' => 's',
            'Contact_No' => 's',
            'Address' => 's',
            'Rank' => 's',
            'Status' => 's',
            'Religion' => 's',
            'Nationality' => 's',
            'Username' => 's',
            'Subject_Taught' => 's',
            'Joining_Date' => 's'
        ];

        foreach ($simpleFields as $field => $type) {
            if (isset($data[$field])) {
                $updateFields[] = "$field = ?";
                $types .= $type;
                $values[] = $data[$field];
            }
        }

        if (empty($updateFields)) {
            throw new Exception("No fields to update");
        }

        // Add ID to values array and types
        $values[] = $id;
        $types .= "i";

        $sql = "UPDATE $table SET " . implode(", ", $updateFields) . " WHERE Teacher_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$values);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows >= 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Teacher updated successfully'
                ]);
            } else {
                throw new Exception("Failed to update teacher");
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

//Update teacher file - PATCH (partial update)
function patchTeacherFile($table, $id, $data, $conn) {
    try {
        $allowedTables = ['teacher_files'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Check if file exists
        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        if($checkStmt->get_result()->num_rows === 0) {
            throw new Exception("File not found");
        }

        // Build dynamic UPDATE query
        $updateFields = [];
        $types = '';
        $values = [];

        if (isset($data['Teacher_ID'])) {
            $teacherStmt = $conn->prepare("SELECT Teacher_ID FROM teacher WHERE Teacher_ID = ?");
            $teacherStmt->bind_param("i", $data['Teacher_ID']);
            $teacherStmt->execute();
            if($teacherStmt->get_result()->num_rows === 0) {
                throw new Exception("Teacher does not exist");
            }
            $updateFields[] = "Teacher_ID = ?";
            $types .= "i";
            $values[] = $data['Teacher_ID'];
        }

        $fileFields = [
            'File_Name' => 's',
            'File_Type' => 's',
            'File_Path' => 's',
            'Upload_Date' => 's'
        ];

        foreach ($fileFields as $field => $type) {
            if (isset($data[$field])) {
                $updateFields[] = "$field = ?";
                $types .= $type;
                $values[] = $data[$field];
            }
        }

        if (empty($updateFields)) {
            throw new Exception("No fields to update");
        }

        // Add ID to values array and types
        $values[] = $id;
        $types .= "i";

        $sql = "UPDATE $table SET " . implode(", ", $updateFields) . " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$values);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows >= 0) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Teacher file updated successfully'
                ]);
            } else {
                throw new Exception("Failed to update teacher file");
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
