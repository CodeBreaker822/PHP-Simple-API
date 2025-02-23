<?php

require_once 'includes/config.php';

function handleUpdate($request, $id, $data) {
    global $conn;

    switch($request) {
        case "updateClass":
            updateClass("class", $id, $data, $conn); 
            break;
        case "updateGrade":
            updateGrade("grades", $id, $data, $conn);
            break;
        case "updateGradeLevel":
            updateGradeLevel("grade_level", $id, $data, $conn);
            break;
        case "updateInventory":
            updateInventory("inventory", $id, $data, $conn);
            break;
        case "updateStudent":
            updateStudent("students", $id, $data, $conn);
            break;
        case "updateSubject":
            updateSubject("subject", $id, $data, $conn);
            break;
        case "updateTeacher":
            updateTeacher("teacher", $id, $data, $conn);
            break;
        case "updateTeacherFile":
            updateTeacherFile("teacher_files", $id, $data, $conn);
            break;
        default:
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Request function not found']);
            break;
    }
}

//Update class - PUT (full update)
function updateClass($table, $id, $data, $conn) {
    try {
        // Prevent SQL injection
        $allowedTables = ['class'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate required fields for full update
        if (!isset($data['Capacity']) || !isset($data['Room_Type']) || !isset($data['Section']) || !isset($data['Teacher_ID'])) {
            throw new Exception("All fields are required for full update");
        }

        // Check if class exists
        $checkStmt = $conn->prepare("SELECT Class_ID FROM $table WHERE Class_ID = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Class not found");
        }

        // Check if new Teacher_ID is already assigned to another class (if different from current)
        $teacherStmt = $conn->prepare("SELECT Teacher_ID FROM $table WHERE Teacher_ID = ? AND Class_ID != ?");
        $teacherStmt->bind_param("si", $data['Teacher_ID'], $id);
        $teacherStmt->execute();
        $result = $teacherStmt->get_result();

        if($result->num_rows > 0) {
            throw new Exception("Teacher ID is already assigned to another class");
        }

        // Update the class
        $stmt = $conn->prepare("UPDATE $table SET Capacity = ?, Room_Type = ?, Section = ?, Teacher_ID = ? WHERE Class_ID = ?");
        $stmt->bind_param("iissi", 
            $data['Capacity'], 
            $data['Room_Type'], 
            $data['Section'], 
            $data['Teacher_ID'],
            $id
        );
        
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

//Update grade
function updateGrade($table, $id, $data, $conn) {
    try {
        $allowedTables = ['grades'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate required fields for full update
        if (!isset($data['Student_LRN']) || !isset($data['Advisory']) || !isset($data['Subject']) || 
            !isset($data['Quarter1']) || !isset($data['Quarter2']) || !isset($data['Quarter3']) || 
            !isset($data['Quarter4']) || !isset($data['school_year'])) {
            throw new Exception("All fields are required for full update");
        }

        // Check if grade exists
        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Grade not found");
        }

        // Check if Student LRN exists
        $studentStmt = $conn->prepare("SELECT Student_LRN FROM students WHERE Student_LRN = ?");
        $studentStmt->bind_param("s", $data['Student_LRN']);
        $studentStmt->execute();
        if($studentStmt->get_result()->num_rows === 0) {
            throw new Exception("Student LRN does not exist");
        }

        // Update grade
        $stmt = $conn->prepare("UPDATE $table SET Student_LRN = ?, Advisory = ?, Subject = ?, 
            Quarter1 = ?, Quarter2 = ?, Quarter3 = ?, Quarter4 = ?, school_year = ? WHERE id = ?");
        $stmt->bind_param("ssssssssi", 
            $data['Student_LRN'],
            $data['Advisory'],
            $data['Subject'],
            $data['Quarter1'],
            $data['Quarter2'],
            $data['Quarter3'],
            $data['Quarter4'],
            $data['school_year'],
            $id
        );
        
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

//Update grade level
function updateGradeLevel($table, $id, $data, $conn) {
    try {
        $allowedTables = ['grade_level'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate required fields
        if (!isset($data['Grade_Level']) || !isset($data['Grade 1']) || !isset($data['Grade 2']) || 
            !isset($data['Grade 3']) || !isset($data['Grade 4']) || !isset($data['Grade 5']) || 
            !isset($data['Grade 6'])) {
            throw new Exception("All fields are required for full update");
        }

        // Check if grade level exists
        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        if($checkStmt->get_result()->num_rows === 0) {
            throw new Exception("Grade level not found");
        }

        // Update grade level
        $stmt = $conn->prepare("UPDATE $table SET Grade_Level = ?, `Grade 1` = ?, `Grade 2` = ?, 
            `Grade 3` = ?, `Grade 4` = ?, `Grade 5` = ?, `Grade 6` = ? WHERE id = ?");
        $stmt->bind_param("sssssssi", 
            $data['Grade_Level'],
            $data['Grade 1'],
            $data['Grade 2'],
            $data['Grade 3'],
            $data['Grade 4'],
            $data['Grade 5'],
            $data['Grade 6'],
            $id
        );
        
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

//Update inventory
function updateInventory($table, $id, $data, $conn) {
    try {
        $allowedTables = ['inventory'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate required fields
        if (!isset($data['inventory_no']) || !isset($data['Item_Name']) || !isset($data['Description']) || 
            !isset($data['Quantity']) || !isset($data['School']) || !isset($data['Property_no']) || 
            !isset($data['Article']) || !isset($data['Date_acquired']) || !isset($data['Acquisition_cost']) || 
            !isset($data['Fund_source']) || !isset($data['Accountable_officer']) || !isset($data['Unit'])) {
            throw new Exception("All fields are required for full update");
        }

        // Check if inventory exists
        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        if($checkStmt->get_result()->num_rows === 0) {
            throw new Exception("Inventory not found");
        }

        // Update inventory
        $stmt = $conn->prepare("UPDATE $table SET inventory_no = ?, Item_Name = ?, Description = ?, 
            Quantity = ?, School = ?, Property_no = ?, Article = ?, Date_acquired = ?, 
            Acquisition_cost = ?, Fund_source = ?, Accountable_officer = ?, Unit = ? WHERE id = ?");
        $stmt->bind_param("ssssssssssssi", 
            $data['inventory_no'],
            $data['Item_Name'],
            $data['Description'],
            $data['Quantity'],
            $data['School'],
            $data['Property_no'],
            $data['Article'],
            $data['Date_acquired'],
            $data['Acquisition_cost'],
            $data['Fund_source'],
            $data['Accountable_officer'],
            $data['Unit'],
            $id
        );
        
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

//Update student
function updateStudent($table, $id, $data, $conn) {
    try {
        $allowedTables = ['students'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate required fields
        if (!isset($data['Teacher_ID']) || !isset($data['Parents_ID']) || !isset($data['Firstname']) || 
            !isset($data['Middlename']) || !isset($data['Lastname']) || !isset($data['Birthdate']) || 
            !isset($data['Age']) || !isset($data['Gender']) || !isset($data['Parents']) || 
            !isset($data['Nationality']) || !isset($data['Religion']) || !isset($data['Contact_No']) || 
            !isset($data['Address']) || !isset($data['Student_LRN']) || !isset($data['school_year']) || 
            !isset($data['Grade_Level']) || !isset($data['Section']) || !isset($data['Advisory'])) {
            throw new Exception("All fields are required for full update");
        }

        // Check if student exists
        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        if($checkStmt->get_result()->num_rows === 0) {
            throw new Exception("Student not found");
        }

        // Check if Teacher ID exists
        $teacherStmt = $conn->prepare("SELECT Teacher_ID FROM teacher WHERE Teacher_ID = ?");
        $teacherStmt->bind_param("s", $data['Teacher_ID']);
        $teacherStmt->execute();
        if($teacherStmt->get_result()->num_rows === 0) {
            throw new Exception("Teacher ID does not exist");
        }

        // Check if Parents ID exists
        $parentsStmt = $conn->prepare("SELECT id FROM parents WHERE id = ?");
        $parentsStmt->bind_param("s", $data['Parents_ID']);
        $parentsStmt->execute();
        if($parentsStmt->get_result()->num_rows === 0) {
            throw new Exception("Parents ID does not exist");
        }

        // Check if Grade Level exists
        $gradeLevelStmt = $conn->prepare("SELECT Grade_Level FROM grade_level WHERE Grade_Level = ?");
        $gradeLevelStmt->bind_param("s", $data['Grade_Level']);
        $gradeLevelStmt->execute();
        if($gradeLevelStmt->get_result()->num_rows === 0) {
            throw new Exception("Grade Level does not exist");
        }

        // Check if Section exists
        $sectionStmt = $conn->prepare("SELECT Section FROM class WHERE Section = ?");
        $sectionStmt->bind_param("s", $data['Section']);
        $sectionStmt->execute();
        if($sectionStmt->get_result()->num_rows === 0) {
            throw new Exception("Section does not exist");
        }

        // Update student
        $stmt = $conn->prepare("UPDATE $table SET Teacher_ID = ?, Parents_ID = ?, Firstname = ?, 
            Middlename = ?, Lastname = ?, Birthdate = ?, Age = ?, Gender = ?, Parents = ?, 
            Nationality = ?, Religion = ?, Contact_No = ?, Address = ?, Student_LRN = ?, 
            school_year = ?, Grade_Level = ?, Section = ?, Advisory = ? WHERE id = ?");
        $stmt->bind_param("iisssdissssississsi", 
            $data['Teacher_ID'],
            $data['Parents_ID'],
            $data['Firstname'],
            $data['Middlename'],
            $data['Lastname'],
            $data['Birthdate'],
            $data['Age'],
            $data['Gender'],
            $data['Parents'],
            $data['Nationality'],
            $data['Religion'],
            $data['Contact_No'],
            $data['Address'],
            $data['Student_LRN'],
            $data['school_year'],
            $data['Grade_Level'],
            $data['Section'],
            $data['Advisory'],
            $id
        );
        
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

//Update subject
function updateSubject($table, $id, $data, $conn) {
    try {
        $allowedTables = ['subject'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate required fields
        if (!isset($data['Mother_tounge']) || !isset($data['Mathematics']) || !isset($data['Science']) || 
            !isset($data['Filipino']) || !isset($data['MAPEH']) || !isset($data['Araling_panlipunan']) || 
            !isset($data['Esp']) || !isset($data['English'])) {
            throw new Exception("All fields are required for full update");
        }

        // Check if subject exists
        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        if($checkStmt->get_result()->num_rows === 0) {
            throw new Exception("Subject not found");
        }

        // Update subject
        $stmt = $conn->prepare("UPDATE $table SET Mother_tounge = ?, Mathematics = ?, Science = ?, 
            Filipino = ?, MAPEH = ?, Araling_panlipunan = ?, Esp = ?, English = ? WHERE id = ?");
        $stmt->bind_param("ssssssssi", 
            $data['Mother_tounge'],
            $data['Mathematics'],
            $data['Science'],
            $data['Filipino'],
            $data['MAPEH'],
            $data['Araling_panlipunan'],
            $data['Esp'],
            $data['English'],
            $id
        );
        
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

//Update teacher
function updateTeacher($table, $id, $data, $conn) {
    try {
        $allowedTables = ['teacher'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate required fields
        if (!isset($data['Firstname']) || !isset($data['Middlename']) || !isset($data['Lastname']) || 
            !isset($data['Birthdate']) || !isset($data['Age']) || !isset($data['Gender']) || 
            !isset($data['Contact_No']) || !isset($data['Address']) || !isset($data['Rank']) || 
            !isset($data['grade_level']) || !isset($data['Section']) || !isset($data['Status']) || 
            !isset($data['Religion']) || !isset($data['Nationality']) || !isset($data['Username']) || 
            !isset($data['Password']) || !isset($data['Subject_Taught']) || !isset($data['Joining_Date'])) {
            throw new Exception("All fields are required for full update");
        }

        // Check if teacher exists
        $checkStmt = $conn->prepare("SELECT Teacher_ID FROM $table WHERE Teacher_ID = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        if($checkStmt->get_result()->num_rows === 0) {
            throw new Exception("Teacher not found");
        }

        // Check if grade_level exists
        $gradeLevelStmt = $conn->prepare("SELECT Grade_Level FROM grade_level WHERE Grade_Level = ?");
        $gradeLevelStmt->bind_param("s", $data['grade_level']);
        $gradeLevelStmt->execute();
        if($gradeLevelStmt->get_result()->num_rows === 0) {
            throw new Exception("Grade Level does not exist");
        }

        // Check if section exists
        $sectionStmt = $conn->prepare("SELECT Section FROM class WHERE Section = ?");
        $sectionStmt->bind_param("s", $data['Section']);
        $sectionStmt->execute();
        if($sectionStmt->get_result()->num_rows === 0) {
            throw new Exception("Section does not exist");
        }

        // Hash the password if it's changed
        $hashedPassword = password_hash($data['Password'], PASSWORD_DEFAULT);

        // Update teacher
        $stmt = $conn->prepare("UPDATE $table SET Firstname = ?, Middlename = ?, Lastname = ?, 
            Birthdate = ?, Age = ?, Gender = ?, Contact_No = ?, Address = ?, Rank = ?, 
            grade_level = ?, Section = ?, Status = ?, Religion = ?, Nationality = ?, 
            Username = ?, Password = ?, Subject_Taught = ?, Joining_Date = ? WHERE Teacher_ID = ?");
        $stmt->bind_param("ssssssssssssssssssi", 
            $data['Firstname'],
            $data['Middlename'],
            $data['Lastname'],
            $data['Birthdate'],
            $data['Age'],
            $data['Gender'],
            $data['Contact_No'],
            $data['Address'],
            $data['Rank'],
            $data['grade_level'],
            $data['Section'],
            $data['Status'],
            $data['Religion'],
            $data['Nationality'],
            $data['Username'],
            $hashedPassword,
            $data['Subject_Taught'],
            $data['Joining_Date'],
            $id
        );
        
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

//Update teacher file
function updateTeacherFile($table, $id, $data, $conn) {
    try {
        $allowedTables = ['teacher_files'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate required fields
        if (!isset($data['Teacher_ID']) || !isset($data['File_Name']) || !isset($data['File_Type']) || 
            !isset($data['File_Path']) || !isset($data['Upload_Date'])) {
            throw new Exception("All fields are required for full update");
        }

        // Check if file exists
        $checkStmt = $conn->prepare("SELECT id FROM $table WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        if($checkStmt->get_result()->num_rows === 0) {
            throw new Exception("File not found");
        }

        // Check if Teacher exists
        $teacherStmt = $conn->prepare("SELECT Teacher_ID FROM teacher WHERE Teacher_ID = ?");
        $teacherStmt->bind_param("i", $data['Teacher_ID']);
        $teacherStmt->execute();
        if($teacherStmt->get_result()->num_rows === 0) {
            throw new Exception("Teacher does not exist");
        }

        // Update teacher file
        $stmt = $conn->prepare("UPDATE $table SET Teacher_ID = ?, File_Name = ?, File_Type = ?, 
            File_Path = ?, Upload_Date = ? WHERE id = ?");
        $stmt->bind_param("issssi", 
            $data['Teacher_ID'],
            $data['File_Name'],
            $data['File_Type'],
            $data['File_Path'],
            $data['Upload_Date'],
            $id
        );
        
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
