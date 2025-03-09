<?php
    include "dbconnect.php";

    // Hardcoded employee_id (Change this as needed)
    $employee_id = "342";

    // Get Student ID` 
    $student_id = $_POST['student_id'];

    // Retrieve form data from POST
    $enroll_category = $_POST["enroll_category"];
    $schoolyear = $_POST["schoolyear"];
    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $address = $_POST["address"];
    $birthdate = $_POST["birthdate"];
    $sex = $_POST["sex"];
    $parent1 = $_POST["parent1"];
    $parent1_contact = $_POST["parent1_contact"];
    $parent2 = $_POST["parent2"];
    $parent2_contact = $_POST["parent2_contact"];
    $emergency_fullname = $_POST["emergency_fullname"];
    $emergency_relationship = $_POST["emergency_relationship"];
    $emergency_address = $_POST["emergency_address"];
    $emergency_contact_no = $_POST["emergency_contact_no"];
    $is_active = isset($_POST["is_active"]) ? $_POST["is_active"] : 1;

    // Prepare the SQL CALL statement
    $stmt = $conn->prepare("CALL update_tbl_student_info(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters to the SQL statement
    $stmt->bind_param('issssssssssssssssii',
        $student_id,
        $enroll_category,
        $schoolyear,
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
        $employee_id,
        $is_active
    );

    // Execute the statement
    if ($stmt->execute()) {
        echo "
        <script>
            alert('✅ You successfully updated student');
            window.location.href = '../website/student-information.php';
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
?>
