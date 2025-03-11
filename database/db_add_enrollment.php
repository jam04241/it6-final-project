<?php
include "dbconnect.php";

// Enable MySQLi exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Hardcoded employee_id (Change this as needed)
    $employee_id = 5672;
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

    $stmt->bind_param('iss',
  $student_id,
 $enroll_category,
        $schoolyear
        
    );

    $stmt->execute();
    $stmt->close();

    sleep(2);

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
