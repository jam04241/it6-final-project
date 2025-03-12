<?php
session_start();
include "dbconnect.php";

// Enable MySQLi exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // SESSION EMPLOYEE ID
    $employee_id = $_SESSION["tutorial_id"];
    // Retrieve form data from POST
    $date_start = $_POST["date_start"] ?? '';
    $school = $_POST["school"] ?? '';
    $grade_level = $_POST["grade_level"] ?? '';
    $time_arrival = $_POST["time_arrival"] ?? '';
    $focus_subject = $_POST["focus_subject"] ?? '';
    $last_name = $_POST["last_name"] ?? '';
    $first_name = $_POST["first_name"] ?? '';
    $middle_name = $_POST["middle_name"] ?? '';
    $birthdate = $_POST["birthdate"] ?? '';
    $sex = $_POST["sex"] ?? '';
    $street = $_POST["street"] ?? '';
    $city = $_POST["city"] ?? '';
    $zip_code = $_POST["zip_code"] ?? '';
    $emergency_fullname = $_POST["emergency_fullname"] ?? '';
    $emergency_relationship = $_POST["emergency_relationship"] ?? '';
    $emergency_address = $_POST["emergency_address"] ?? '';
    $emergency_contact_no = $_POST["emergency_contact_no"] ?? '';

    // Insert into student table
    $stmt = $conn->prepare("INSERT INTO tbl_tutorial_info (
                                        date_start,
                                        school,
                                        grade_level,
                                        time_arrival,
                                        focus_subject,
                                        last_name, 
                                        first_name,
                                        middle_name, 
                                        birthdate, 
                                        sex,
                                        street,
                                        city,
                                        zip_code,
                                        emergency_fullname, 
                                        emergency_relationship, 
                                        emergency_address, 
                                        emergency_contact_no, 
                                        created_by,
                                        date_created, 
                                        isactive
                                    ) 
                                    VALUES (
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
                                        ?, 
                                        ?,
                                        ?, 
                                        NOW(), 
                                        1
                                    );");

    $stmt->bind_param('ssssssssssssssssi',
        $last_name,
        $first_name,
        $middle_name,
        $street,
        $city,
        $zip_code,
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
    

    echo "
    <script>
        alert('✅ You successfully registered a student');
        window.location.href = '../website/student-enrollment.php'; 
    </script>";

} catch (Exception $e) {
    // Catch and display error message
    echo "❌ Error: " . $e->getMessage();
}
?>
