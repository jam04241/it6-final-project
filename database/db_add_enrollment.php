<?php
include "../helpers/session.php";
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
                                     updated_by = ?,
                                     date_updated = NOW()
                                   WHERE
                                     student_id = ?;");

        $stmt->bind_param('ssii',
  $enroll_category,
 $schoolyear,
        $employee_id,
        $student_id
        
    );
    
    $stmt->execute();
    $stmt->close();

    // Calibrate the table
    $stmt = $conn->prepare(" UPDATE 
                                        tbl_payment
                                    SET
                                        pay = 0.00, 
                                        total = 0.00,
                                        balance = DEFAULT,
                                        updated_by = ?,
                                        date_updated = NOW()
                                    WHERE
                                        student_id = ?;");
    
    $stmt->bind_param('ii',$employee_id,$student_id);
    $stmt->execute();
    $stmt->close();

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT employee_position FROM tbl_employee WHERE employee_id = ?");
    $stmt->bind_param('i', $employee_id);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $employee_position = $row['employee_position'];
    } else {
        die("❌ Error: Employee position not found!");
    }

    // ✅ Call stored procedure for audit logging
    $stmt2 = $conn->prepare("CALL audit_enroll_student(?, ?)");
    $stmt2->bind_param('is', $employee_id, $employee_position);
    $stmt2->execute();
    $stmt2->close();

    // ✅ Redirect with success message
    echo "
    <script>
        alert('✅ You successfully enrolled a student');
        window.location.href = '../website/student-enrollment.php'; 
    </script>";
} catch (Exception $e) {
    // Catch and display error message
    echo "❌ Error: " . $e->getMessage();
}
?>
