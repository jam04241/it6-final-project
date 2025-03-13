<?php
session_start();
include "dbconnect.php";
$employee_id = $_SESSION["employee_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    // Debugging: Check if student_id is received
    echo "Received student ID: " . $student_id;

    // Prepare the SQL CALL statement
    
    $stmt = $conn->prepare(" UPDATE 
                                        tbl_student_info
                                    SET 
                                        isactive = 1
                                    WHERE 
                                        student_id = ?;");

    $stmt->bind_param('i', $student_id);

    if ($stmt->execute()) {
        // Redirect after deletion
        header("Location: ../website/student-listing.php");
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
