<?php

include "dbconnect.php";

// Enable MySQLi exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $employee_id = 8;
    // // Check if session exists
    // if (!isset($_SESSION["username"])) {
    //     echo "<script>
    //         alert('❌ Session expired. Please log in again.');
    //         window.location.href = '../website/index.php'; 
    //     </script>";
    //     exit();
    // }

    // //$username = $_SESSION["username"]; // Get the logged-in username

    // // Fetch employee_id based on the logged-in username
    // // $stmt_emp = $conn->prepare("SELECT employee_id FROM employees WHERE username = ?");
    // // $stmt_emp->bind_param("s", $username);
    // // $stmt_emp->execute();
    // // $stmt_emp->bind_result($employee_id);
    // // $stmt_emp->fetch();
    // // $stmt_emp->close();

    // // if (!$employee_id) {
    // //     throw new Exception("❌ Error: Employee ID not found for user $username.");
    // // }

    // Retrieve form data from POST
    $last_name = $_POST["last_name"] ?? '';
    $first_name = $_POST["first_name"] ?? '';
    $middle_name = $_POST["middle_name"] ?? '';
    $address = $_POST["address"] ?? '';
    $birthdate = $_POST["birthdate"] ?? '';
    $sex = $_POST["sex"] ?? '';
    $parent1 = $_POST["parent1"] ?? '';
    $parent1_contact = $_POST["parent1_contact"] ?? '';
    $parent2 = $_POST["parent2"] ?? '';
    $parent2_contact = $_POST["parent2_contact"] ?? '';
    $emergency_fullname = $_POST["emergency_fullname"] ?? '';
    $emergency_relationship = $_POST["emergency_relationship"] ?? '';
    $emergency_address = $_POST["emergency_address"] ?? '';
    $emergency_contact_no = $_POST["emergency_contact_no"] ?? '';

    // Insert into student table
    $stmt = $conn->prepare("INSERT INTO tbl_student_info (
                                        enroll_category,
                                        schoolyear,
                                        last_name, 
                                        first_name,
                                        middle_name, 
                                        address, 
                                        birthdate, 
                                        sex, 
                                        parent1, 
                                        parent1_contact, 
                                        parent2, 
                                        parent2_contact, 
                                        emergency_fullname, 
                                        emergency_relationship, 
                                        emergency_address, 
                                        emergency_contact_no, 
                                        created_by,
                                        date_created, 
                                        isactive
                                    ) 
                                    VALUES (
                                        NULL,
                                        NULL,
                                        ?, 
                                        ?, 
                                        ?, 
                                        ?, 
                                        ?, 
                                        ?, 
                                        ?, 
                                        ?, 
                                        ?,  
                                        ?, 
                                        ?, 
                                        ?, 
                                        ?, 
                                        ?, 
                                        ?, 
                                        NOW(), 
                                        1
                                    );");

    $stmt->bind_param('ssssssssssssssi',
        $last_name,
        $first_name,
        $middle_name,
        $address,
        $birthdate,
        $sex,
        $parent1,
        $parent1_contact,
        $parent2,
        $parent2_contact,
        $emergency_fullname,
        $emergency_relationship,
        $emergency_address,
        $emergency_contact_no,
        $employee_id
    );

    $stmt->execute();
    $stmt->close();

    sleep(3);

    // Fetch the last inserted student_id
    $stmt2 = $conn->prepare("SELECT 
                                        student_id FROM tbl_student_info 
                                    WHERE 
                                        last_name = ? 
                                    AND 
                                        first_name = ? 
                                    AND 
                                        middle_name = ? 
                                    ORDER BY 
                                        student_id 
                                    DESC LIMIT 
                                        1;");

    $stmt2->bind_param('sss', $last_name, $first_name, $middle_name);
    $stmt2->execute();
    $stmt2->bind_result($student_id);
    $stmt2->fetch();
    $stmt2->close();

    if (!$student_id) {
        throw new Exception("❌ Error: Unable to fetch student ID.");
    }

    sleep(3);

    $stmt1 = $conn->prepare("    INSERT INTO 
                                            tbl_payment 
                                        (student_id, date_created, status)
                                        VALUES(
                                            ?, 
                                            NOW(),
                                            1);");

    $stmt1->bind_param("i", $student_id);
    $stmt1->execute();
    $stmt1->close();

    echo "
    <script>
        alert('✅ You successfully registered a student');
        window.location.href = '../website/student-information.php'; 
    </script>";

} catch (Exception $e) {
    // Catch and display error message
    echo "❌ Error: " . $e->getMessage();
}
?>
