<?php

include "../helpers/session.php";
include "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_id'])) {
    
    //RETRIVE EMPLOYEE_ID
    $employee_id = $_SESSION["employee_id"];
    $student_id = $_POST['student_id'];

    // Debugging: Check if student_id is received
    echo "Received student ID: " . $student_id;

    // Prepare the SQL CALL statement
    
    $stmt = $conn->prepare(" DELETE FROM
                                        tbl_tutor_info
                                    WHERE 
                                        tutorial_id = ?;");

    $stmt->bind_param('i', $student_id);

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
    $stmt2 = $conn->prepare("CALL audit_delete_tutor(?, ?)");
    $stmt2->bind_param('is', $employee_id, $employee_position);
    $stmt2->execute();
    $stmt2->close();

    if ($stmt->execute()) {
        // Redirect after deletion
        header("Location: ../website/tutorial-listing.php");
        exit();
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "❌ Invalid request!";
}
?>
