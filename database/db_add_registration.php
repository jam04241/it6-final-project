<?php
session_start();
include "dbconnect.php";

// Enable MySQLi exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $employee_id = $_SESSION["employee_id"];
    // Retrieve form data from POST
    $last_name = $_POST["last_name"] ?? '';
    $first_name = $_POST["first_name"] ?? '';
    $middle_name = $_POST["middle_name"] ?? '';
    $street = $_POST["street"] ?? '';
    $city = $_POST["city"] ?? '';
    $zip_code = $_POST["zip_code"] ?? '';
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
                                        street,
                                        city,
                                        zip_code, 
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

    sleep(1);

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


    $stmt1 = $conn->prepare("    INSERT INTO 
                                            tbl_payment 
                                        (student_id, balance,created_by, date_created, status)
                                        VALUES(
                                            ?,
                                            DEFAULT,
                                            ?,
                                            NOW(),
                                            1);");

    $stmt1->bind_param("ii", $student_id,$employee_id);
    $stmt1->execute();
    $stmt1->close();

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
