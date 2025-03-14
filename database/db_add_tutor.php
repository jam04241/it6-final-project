<?php

include "../helpers/session.php";
include "dbconnect.php";

// Enable MySQLi exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Check if employee_id is set
    if (!isset($_SESSION["employee_id"])) {
        throw new Exception("❌ Error: Employee ID not set in session.");
    }

    // SESSION EMPLOYEE ID
    $employee_id = $_SESSION["employee_id"];

    // Retrieve form data from POST
    $date_start = $_POST["date_start"];
    $school = $_POST["school"];
    $grade_level = $_POST["grade_level"];
    $time_arrival = $_POST["time_arrival"];
    $focus_subject = $_POST["focus_subject"];
    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"] ?? '';
    $birthdate = $_POST["birthdate"];
    $sex = $_POST["sex"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $zip_code = $_POST["zip_code"];
    $emergency_fullname = $_POST["emergency_fullname"];
    $emergency_relationship = $_POST["emergency_relationship"];
    $emergency_address = $_POST["emergency_address"];
    $emergency_contact_no = $_POST["emergency_contact_no"];

    // Ensure the connection is valid
    if ($conn->connect_error) {
        throw new Exception("❌ Connection failed: " . $conn->connect_error);
    }

    // Insert into student table
    $stmt = $conn->prepare("INSERT INTO tbl_tutor_info (
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
                                         ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 1
                                    )");

    $stmt->bind_param('sssssssssssssssssi',
        $date_start, $school, $grade_level, $time_arrival, $focus_subject,
        $last_name, $first_name, $middle_name, $birthdate, $sex, 
        $street, $city, $zip_code, $emergency_fullname, 
        $emergency_relationship, $emergency_address, $emergency_contact_no, 
        $employee_id
    );

    // Prepare the SQL statement
    $stmt1 = $conn->prepare("SELECT employee_position FROM tbl_employee WHERE employee_id = ?");
    $stmt1->bind_param('i', $employee_id);
    $stmt1->execute();

    // Fetch the result
    $result = $stmt1->get_result();
    if ($row = $result->fetch_assoc()) {
        $employee_position = $row['employee_position'];
    } else {
        die("❌ Error: Employee position not found!");
    }

    // ✅ Call stored procedure for audit logging
    $stmt2 = $conn->prepare("CALL audit_register_tutor(?, ?)");
    $stmt2->bind_param('is', $employee_id, $employee_position);
    $stmt2->execute();
    $stmt2->close();

    if ($stmt->execute()) {
        echo "<script>
        alert('✅ You successfully registered a tutor student');
        window.location.href = '../website/tutorial-listing.php'; 
    </script>";
    } else {
        echo "❌ Error: " . $e->getMessage();

        return false;
    }
    exit();

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
