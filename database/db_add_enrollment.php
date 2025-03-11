<?php
include "dbconnect.php";

// Enable MySQLi exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // SESSION EMPLOYEE ID
    $employee_id = $_SESSION["employee_id"];

    $student_id = $_POST["student_id"];

    // Retrieve form data from POST
    $enroll_category = $_POST["enroll_category"] ?? '';
    $schoolyear = $_POST["schoolyear"] ?? '';

    // Insert into student table
    $stmt = $conn->prepare("UPDATE 
                                     tbl_student_info
                                   SET
                                     enroll_category = ?, 
                                     schoolyear = ?,
                                     date_updated = NOW() 
                                   WHERE
                                     student_id = ?;");

    $stmt->bind_param('ssi',
  $enroll_category,
 $schoolyear,
        $student_id
        
    );

    $stmt->execute();
    $stmt->close();

    echo "
    <script>
        alert('✅ You successfully enrolled a student');
        window.location.href = '../website/student-information.php'; 
    </script>";

} catch (Exception $e) {
    // Catch and display error message
    echo "❌ Error: " . $e->getMessage();
}
?>
