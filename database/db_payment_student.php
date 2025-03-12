<?php
session_start();
include "dbconnect.php";

// Enable MySQLi exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // SESSION EMPLOYEE ID
    $employee_id = $_SESSION["tutorial_id"];
    // Retrieve form data from POST
    $student_id = $_POST["student_id"];
    $pay = $_POST["pay"];
    
    // Insert into student table
    $stmt = $conn->prepare("UPDATE  
                                    tbl_payment
                                   SET 
                                    pay = ?,
                                    total = ROUND(total + ?),
                                    balance = ROUND(balance - ?),
                                    updated_by = ?,
                                    date_created = NOW()
                                    WHERE
                                    student_id = ?;");

    $stmt->bind_param("dddis", $pay, $pay, $pay, $updated_by, $student_id);

    if ($stmt->execute()) {
        echo "Payment updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
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
