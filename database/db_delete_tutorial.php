<?php
include "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    // Debugging: Check if student_id is received
    echo "Received student ID: " . $student_id;

    // Prepare the SQL CALL statement
    
    $stmt = $conn->prepare(" DELETE FROM
                                        tbl_tutor_info
                                    WHERE 
                                        tutorial_id = ?;");

    $stmt->bind_param('i', $student_id);

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
