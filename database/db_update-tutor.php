<?php
    include "../helpers/session.php";
    include "dbconnect.php";
    // Session employee id
    $employee_id = $_SESSION["employee_id"];

    // Get Student ID` 
    $tutorial_id = $_POST['tutorial_id'];

    // Retrieve form data from POST
    $date_start = $_POST["date_start"];
    $school = $_POST["school"];
    $grade_level = $_POST["grade_level"];
    $focus_subject = $_POST["focus_subject"];
    $time_arrival = $_POST["time_arrival"];
    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $birthdate = $_POST["birthdate"];
    $sex = $_POST["sex"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $zip_code = $_POST["zip_code"];
    $emergency_fullname = $_POST["emergency_fullname"];
    $emergency_relationship = $_POST["emergency_relationship"];
    $emergency_address = $_POST["emergency_address"];
    $emergency_contact_no = $_POST["emergency_contact_no"];
    $isactive = $_POST["isactive"];


    // Prepare the SQL CALL statement
    $stmt = $conn->prepare("	UPDATE
                                        tbl_tutor_info
                                    SET
                                        date_start = ?, 
                                        school = ?,
                                        grade_level = ?,
                                        time_arrival = ?,
                                        focus_subject = ?, 
                                        last_name = ?,
                                        first_name = ?,
                                        middle_name = ?,
                                        sex = ?,
                                        street = ?,
                                        city = ?,
                                        zip_code = ?, 
                                        birthdate = ?, 
                                        emergency_fullname = ?,
                                        emergency_relationship = ?,
                                        emergency_address = ?,
                                        emergency_contact_no = ?,   
                                        updated_by = ?,
                                        date_updated = NOW(), 
                                        isactive = ?
                                    WHERE
                                        tutorial_id = ?;");

    // Bind parameters to the SQL statement
    $stmt->bind_param('sssssssssssssssssiii',
        
    $date_start, 
    $school,
        $grade_level,
        $time_arrival,
        $focus_subject, 
        $last_name,
        $first_name,
        $middle_name,
        $sex,
        $street,
        $city,
        $zip_code, 
        $birthdate, 
        $emergency_fullname,
        $emergency_relationship,
        $emergency_address,
        $emergency_contact_no,
        $employee_id,   
        $isactive,
        $tutorial_id
    );

$stmt1 = $conn->prepare("SELECT employee_position FROM tbl_employee WHERE employee_id = ?");
$stmt1->bind_param('i', $employee_id);
$stmt1->execute();

    // Fetch the result
    $result = $stmt1->get_result();
    if ($row = $result->fetch_assoc()) {  // ✅ Correct variable usage
        $employee_position = $row['employee_position'];
    } else {
        die("❌ Error: Employee position not found!");
    }
    

    // ✅ Call stored procedure for audit logging
    $stmt2 = $conn->prepare("CALL audit_update_tutor(?, ?)");
    $stmt2->bind_param('is', $employee_id, $employee_position);
    $stmt2->execute();
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "
        <script>
            alert('✅ You successfully updated tutorial');
            window.location.href = '../website/tutorial-listing.php';
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $stmt1->close();
    $stmt2->close();
    $conn->close();
?>
