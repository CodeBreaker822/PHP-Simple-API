<?php

require_once 'includes/config.php';

//Add Request Name and connect to a table
function handlePost($request, $data) {
    global $conn;

    switch($request) {
        case "addClass":
            addClass("class", $data, $conn); 
            break;
        case "addGrade":
            addGrade("grades", $data, $conn);
            break;
        case "addGradeLevel":
            addGradeLevel("grade_level", $data, $conn);
            break;
        case "addInventory":
            addInventory("inventory", $data, $conn);
            break;
        case "addStudent":
            addStudent("students", $data, $conn);
            break;
        case "addSubject":
            addSubject("subject", $data, $conn);
            break;
        case "addTeacher":
            addTeacher("teacher", $data, $conn);
            break;
        case "addTeacherFile":
            addTeacherFile("teacher_files", $data, $conn);
            break;
        default:
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Request function not found you entered: '.$request]);
            break;
    }
}

//Create new user
function addClass($table, $data, $conn) {
    try {
        // Prevent SQL injection
        $allowedTables = ['class'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate required fields
        if (!isset($data['Capacity']) || !isset($data['Room_Type']) || !isset($data['Section'])) {
            throw new Exception("Missing required fields");
        }

        //Return error if Teacher ID is not set
        if(!isset($data['Teacher_ID'])) {
            throw new Exception("Teacher ID is required");
        }
        
        // Check if teacher ID is already assigned to a class
        $classStmt = $conn->prepare("SELECT Teacher_ID FROM class WHERE Teacher_ID = ?");
        $classStmt->bind_param("s", $data['Teacher_ID']);
        $classStmt->execute();
        $result = $classStmt->get_result();

        //Return error if Teacher ID is already assigned to a class
        if($result->num_rows > 0) {
            throw new Exception("Teacher ID is already assigned to a class");
        }

        // Check if teacher ID exists
        $teacherStmt = $conn->prepare("SELECT Teacher_ID FROM teacher WHERE Teacher_ID = ?");
        $teacherStmt->bind_param("s", $data['Teacher_ID']);
        $teacherStmt->execute();
        $result = $teacherStmt->get_result();

        //Return error if Teacher ID does not exist
        if($result->num_rows === 0) {
            throw new Exception("Teacher ID does not exist");
        }

        //Create new class
        $stmt = $conn->prepare("INSERT INTO $table (Capacity, Room_Type, Section, Teacher_ID) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $data['Capacity'], $data['Room_Type'], $data['Section'], $data['Teacher_ID']);
        
        //Return error if failed to create class
        if ($stmt->execute()) {
            $insertId = $stmt->insert_id;
            if ($insertId) {
                http_response_code(201);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Class created successfully',
                    'id' => $insertId
                ]);
            } else {
                throw new Exception("Failed to create class");
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

//Create new grade for a student
function addGrade($table, $data, $conn) {
    try {
        // Prevent SQL injection
        $allowedTables = ['grades'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate required fields
        if (!isset($data['Student_LRN']) || !isset($data['Advisory']) || !isset($data['Subject']) || !isset($data['Quarter1']) || !isset($data['Quarter2']) || !isset($data['Quarter3']) || !isset($data['Quarter4']) || !isset($data['school_year'])) {
            throw new Exception("Missing required fields");
        }

        //Return error if Student LRN is not set
        if(!isset($data['Student_LRN'])) {
            throw new Exception("Student LRN is required");
        }

        // Check if Student LRN exists
        $studentStmt = $conn->prepare("SELECT Student_LRN FROM students WHERE Student_LRN = ?");
        $studentStmt->bind_param("s", $data['Student_LRN']);
        $studentStmt->execute();
        $result = $studentStmt->get_result();

        //Return error if Student LRN does not exist
        if($result->num_rows === 0) {
            throw new Exception("Student LRN does not exist");
        }
        
        // Check if Student LRN is already assigned to a grade
        $gradeStmt = $conn->prepare("SELECT Student_LRN FROM grades WHERE Student_LRN = ?");
        $gradeStmt->bind_param("s", $data['Student_LRN']);
        $gradeStmt->execute();
        $result = $gradeStmt->get_result();

        //Return error if Student LRN is already assigned to a grade
        if($result->num_rows > 0) {
            throw new Exception("Student LRN is already assigned to a grade");
        }

        //Create new grade
        $stmt = $conn->prepare("INSERT INTO $table (Student_LRN, Advisory, Subject, Quarter1, Quarter2, Quarter3, Quarter4, school_year) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $data['Student_LRN'], $data['Advisory'], $data['Subject'], $data['Quarter1'], $data['Quarter2'], $data['Quarter3'], $data['Quarter4'], $data['school_year']);
        
        //Return error if failed to create grade
        if ($stmt->execute()) {
            $insertId = $stmt->insert_id;
            if ($insertId) {
                http_response_code(201);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Grade created successfully',
                    'id' => $insertId
                ]);
            } else {
                throw new Exception("Failed to create grade");
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

//Create new grade level
function addGradeLevel($table, $data, $conn) {
    try {
        // Prevent SQL injection
        $allowedTables = ['grade_level'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate required fields
        if (!isset($data['Grade_Level']) || !isset($data['Grade 1']) || !isset($data['Grade 2']) || !isset($data['Grade 3']) || !isset($data['Grade 4']) || !isset($data['Grade 5']) || !isset($data['Grade 6'])) {
            throw new Exception("Missing required fields");
        }

        //Fixed the SQL query - removed single quotes from column names
        $stmt = $conn->prepare("INSERT INTO $table (Grade_Level, `Grade 1`, `Grade 2`, `Grade 3`, `Grade 4`, `Grade 5`, `Grade 6`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", 
            $data['Grade_Level'], 
            $data['Grade 1'], 
            $data['Grade 2'], 
            $data['Grade 3'], 
            $data['Grade 4'], 
            $data['Grade 5'], 
            $data['Grade 6']
        );
        
        //Return error if failed to create grade
        if ($stmt->execute()) {
            $insertId = $stmt->insert_id;
            if ($insertId) {
                http_response_code(201);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Grade level created successfully',
                    'id' => $insertId
                ]);
            } else {
                throw new Exception("Failed to create grade level");
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

//Create new inventory
function addInventory($table, $data, $conn) {
    try {
        // Prevent SQL injection
        $allowedTables = ['inventory'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate required fields
        if (!isset($data['inventory_no']) || !isset($data['Item_Name']) || !isset($data['Description']) || !isset($data['Quantity']) || !isset($data['School']) || !isset($data['Property_no']) || !isset($data['Article']) || !isset($data['Date_acquired']) || !isset($data['Acquisition_cost']) || !isset($data['Fund_source']) || !isset($data['Accountable_officer']) || !isset($data['Unit'])) {
            throw new Exception("Missing required fields");
        }

         // Check if inventory_no exists
         $inventoryStmt = $conn->prepare("SELECT inventory_no FROM inventory WHERE inventory_no = ?");
         $inventoryStmt->bind_param("s", $data['inventory_no']);
         $inventoryStmt->execute();
         $result = $inventoryStmt->get_result();
 
         //Return error if inventory_no already exists
         if($result->num_rows > 0) {
             throw new Exception("Inventory number already exists");
         }

         //Create new inventory
         $stmt = $conn->prepare("INSERT INTO $table (inventory_no, Item_Name, Description, Quantity, School, Property_no, Article, Date_acquired, Acquisition_cost, Fund_source, Accountable_officer, Unit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
         $stmt->bind_param("ssssssssssss", $data['inventory_no'], $data['Item_Name'], $data['Description'], $data['Quantity'], $data['School'], $data['Property_no'], $data['Article'], $data['Date_acquired'], $data['Acquisition_cost'], $data['Fund_source'], $data['Accountable_officer'], $data['Unit']);
        
        //Return error if failed to create grade
        if ($stmt->execute()) {
            $insertId = $stmt->insert_id;
            if ($insertId) {
                http_response_code(201);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Inventory created successfully',
                    'id' => $insertId
                ]);
            } else {
                throw new Exception("Failed to create inventory");
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

//Create new student
function addStudent($table, $data, $conn) {
    try {
        // Prevent SQL injection
        $allowedTables = ['students'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate required fields
        if (!isset($data['Teacher_ID']) || !isset($data['Parents_ID']) || !isset($data['Firstname']) || !isset($data['Middlename']) || !isset($data['Lastname']) || !isset($data['Birthdate']) || !isset($data['Age']) || !isset($data['Gender']) || !isset($data['Parents']) || !isset($data['Nationality']) || !isset($data['Religion']) || !isset($data['Contact_No']) || !isset($data['Address']) || !isset($data['Student_LRN']) || !isset($data['school_year']) || !isset($data['Grade_Level']) || !isset($data['Section']) || !isset($data['Advisory']))  {
            throw new Exception("Missing required fields");
        }

         // Check if Teacher ID exists
         $teacherStmt = $conn->prepare("SELECT Teacher_ID FROM teacher WHERE Teacher_ID = ?");
         $teacherStmt->bind_param("s", $data['Teacher_ID']);
         $teacherStmt->execute();
         $result = $teacherStmt->get_result();
 
         //Return error if Teacher ID does not exist
         if($result->num_rows === 0) {
             throw new Exception("Teacher ID does not exist");
         }

         // Check if Parents ID exists
         $parentsStmt = $conn->prepare("SELECT id, Parents FROM parents WHERE id = ?");
         $parentsStmt->bind_param("s", $data['Parents_ID']);
         $parentsStmt->execute();
         $result = $parentsStmt->get_result();
         
         //Return error if Parents ID does not exist
         if($result->num_rows === 0) {
             throw new Exception("Parents ID or Parents Name does not exist");
         }

         // Check if Grade Level exists
         $gradeLevelStmt = $conn->prepare("SELECT Grade_Level FROM grade_level WHERE Grade_Level = ?");
         $gradeLevelStmt->bind_param("s", $data['Grade_Level']);
         $gradeLevelStmt->execute();
         $result = $gradeLevelStmt->get_result();

         //Return error if Grade Level does not exist
         if($result->num_rows === 0) {
             throw new Exception("Grade Level does not exist");
         }

         // Check if Section exists
         $classStmt = $conn->prepare("SELECT Section FROM class WHERE Section = ?");
         $classStmt->bind_param("s", $data['Section']);
         $classStmt->execute();
         $result = $classStmt->get_result();

         //Return error if Section does not exist
         if($result->num_rows === 0) {
             throw new Exception("Section does not exist");
         }

         //Create new inventory
         $stmt = $conn->prepare("INSERT INTO $table (Teacher_ID, Parents_ID, Firstname, Middlename, Lastname, Birthdate, Age, Gender, Parents, Nationality, Religion, Contact_No, Address, Student_LRN, school_year, Grade_Level, Section, Advisory) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
         $stmt->bind_param("iisssdissssississs", $data['Teacher_ID'], $data['Parents_ID'], $data['Firstname'], $data['Middlename'], $data['Lastname'], $data['Birthdate'], $data['Age'], $data['Gender'], $data['Parents'], $data['Nationality'], $data['Religion'], $data['Contact_No'], $data['Address'], $data['Student_LRN'], $data['school_year'], $data['Grade_Level'], $data['Section'], $data['Advisory']);
        
        //Return error if failed to create grade
        if ($stmt->execute()) {
            $insertId = $stmt->insert_id;
            if ($insertId) {
                http_response_code(201);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Inventory created successfully',
                    'id' => $insertId
                ]);
            } else {
                throw new Exception("Failed to create inventory");
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

//Create new subject
function addSubject($table, $data, $conn) {
    try {
        // Prevent SQL injection
        $allowedTables = ['subject'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate required fields
        if (!isset($data['Mother_tounge']) || !isset($data['Mathematics']) || !isset($data['Science']) || !isset($data['Filipino']) || !isset($data['MAPEH']) || !isset($data['Araling_panlipunan']) || !isset($data['Esp']) || !isset($data['English'])) {
            throw new Exception("Missing required fields");
        }

         //Create new inventory
         $stmt = $conn->prepare("INSERT INTO $table (Mother_tounge, Mathematics, Science, Filipino, MAPEH, Araling_panlipunan, Esp, English) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
         $stmt->bind_param("ssssssss", $data['Mother_tounge'], $data['Mathematics'], $data['Science'], $data['Filipino'], $data['MAPEH'], $data['Araling_panlipunan'], $data['Esp'], $data['English']);
        
        //Return error if failed to create subject
        if ($stmt->execute()) {
            $insertId = $stmt->insert_id;
            if ($insertId) {
                http_response_code(201);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Subject created successfully',
                    'id' => $insertId
                ]);
            } else {
                throw new Exception("Failed to create subject");
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

//Create new teacher
function addTeacher($table, $data, $conn) {
    try {
        // Prevent SQL injection
        $allowedTables = ['teacher'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Invalid request name");
        }

        // Validate required fields
        if (!isset($data['Firstname']) || !isset($data['Middlename']) || !isset($data['Lastname']) || !isset($data['Birthdate']) || !isset($data['Age']) || !isset($data['Gender']) || !isset($data['Contact_No']) || !isset($data['Address']) || !isset($data['Rank']) || !isset($data['grade_level']) || !isset($data['Section']) || !isset($data['Status']) || !isset($data['Religion']) || !isset($data['Nationality']) || !isset($data['Username']) || !isset($data['Password']) || !isset($data['Subject_Taught']) || !isset($data['Joining_Date'])) {
            throw new Exception("Missing required fields");
        }

        //Check if grade_level exists
        $gradeLevelStmt = $conn->prepare("SELECT Grade_Level FROM grade_level WHERE Grade_Level = ?");
        $gradeLevelStmt->bind_param("s", $data['grade_level']);
        $gradeLevelStmt->execute();
        $result = $gradeLevelStmt->get_result();

        //Return error if grade_level does not exist        
        if($result->num_rows === 0) {
            throw new Exception("Grade Level does not exist");
        }

        //Check if section exists
        $sectionStmt = $conn->prepare("SELECT Section FROM class WHERE Section = ?");
        $sectionStmt->bind_param("s", $data['Section']);
        $sectionStmt->execute();
        $result = $sectionStmt->get_result();

        //Return error if section does not exist
        if($result->num_rows === 0) {
            throw new Exception("Section does not exist");
        }

        // Hash the password
        $hashedPassword = password_hash($data['Password'], PASSWORD_DEFAULT);
        
         //Create new teacher
         $stmt = $conn->prepare("INSERT INTO $table (Firstname, Middlename, Lastname, Birthdate, Age, Gender, Contact_No, Address, Rank, grade_level, Section, Status, Religion, Nationality, Username, Password, Subject_Taught, Joining_Date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
         $stmt->bind_param("sssssssssssssssssss", $data['Firstname'], $data['Middlename'], $data['Lastname'], $data['Birthdate'], $data['Age'], $data['Gender'], $data['Contact_No'], $data['Address'], $data['Rank'], $data['grade_level'], $data['Section'], $data['Status'], $data['Religion'], $data['Nationality'], $data['Username'], $hashedPassword, $data['Subject_Taught'], $data['Joining_Date']);
        
        //Return error if failed to create teacher
        if ($stmt->execute()) {
            $insertId = $stmt->insert_id;
            if ($insertId) {
                http_response_code(201);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Teacher created successfully',
                    'id' => $insertId
                ]);
            } else {
                throw new Exception("Failed to create teacher");
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



