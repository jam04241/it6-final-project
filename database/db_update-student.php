<?php
    session_start();
    include "dbconnect.php";
    // Session employee id
    $employee_id = $_SESSION["employee_id"];

    // Get Student ID` 
    $student_id = $_POST['student_id'];

    // Retrieve form data from POST
    $enroll_category = $_POST["enroll_category"];
    $schoolyear = $_POST["schoolyear"];
    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $zip_code = $_POST["zip_code"];
    $birthdate = $_POST["birthdate"];
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
    $stmt = $conn->prepare("	UPDATE
                                        tbl_student_info
                                    SET
                                        enroll_category = ?,
                                        schoolyear = ?,
                                        last_name = ?,
                                        first_name = ?,
                                        middle_name = ?,
                                        street = ?,
                                        city = ?,
                                        zip_code = ?,
                                        birthdate = ?,
                                        sex = ?,
                                        parent1 = ?,
                                        parent1_contact = ?,
                                        parent2 = ?,
                                        parent2_contact = ?,
                                        emergency_fullname = ?,
                                        emergency_relationship = ?,
                                        emergency_address = ?,
                                        emergency_contact_no = ?,
                                        updated_by = ?,
                                        date_updated = NOW(),
                                        isactive = ?
                                    WHERE
                                        student_id = ?;");

    // Bind parameters to the SQL statement
    $stmt->bind_param('ssssssssssssssssssiii',
        
        $enroll_category,
        $schoolyear,
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
        $employee_id,
        $is_active,
        $student_id
    );

    // Execute the statement
    if ($stmt->execute()) {
        echo "
        <script>
            alert('✅ You successfully updated student');
            window.location.href = '../website/student-listing.php';
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
?>
