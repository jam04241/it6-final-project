<?php
session_start();
include "dbconnect.php";

// Enable MySQLi exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Check if session variable is set
    if (!isset($_SESSION["employee_id"])) {
        throw new Exception("Employee ID is not set in the session.");
    }
    $employee_id = $_SESSION["employee_id"];

    // Check if POST variables are set
    if (!isset($_POST["student_id"], $_POST["pay"], $_POST["payment_method"])) {
        throw new Exception("Required form data is missing.");
    }

    // Retrieve form data from POST
    $student_id = $_POST["student_id"];
    $pay = $_POST["pay"];
    $payment_method = $_POST["payment_method"];

    // Validate numeric input
    if (!is_numeric($pay)) {
        throw new Exception("Invalid payment amount.");
    }
    $pay = (float)$pay;

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE tbl_payment
                            SET 
                                pay = ?,
                                total = ROUND(total + ?, 2),
                                balance = ROUND(balance - ?, 2),
                                payment_method = ?,
                                updated_by = ?,
                                date_updated = NOW()
                            WHERE
                                student_id = ?");

    // Bind parameters
    $stmt->bind_param("ddsssi", $pay, $pay, $pay, $payment_method, $employee_id, $student_id);


    // Prepare the SQL statement
    if (isset($_SESSION["employee_id"])) {
        $employee_id = $_SESSION["employee_id"];
    } else {
        die("❌ Error: Employee ID not found in session!");
    }
    
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
    $stmt2 = $conn->prepare("CALL audit_pay_student(?, ?)");
    $stmt2->bind_param('is', $employee_id, $employee_position);
    $stmt2->execute();
    $stmt2->close();
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>
            alert('✅ You successfully transacted payment for the student.\\nPrint the receipt.');
            window.location.href = '../website/payment-information.php';
        </script>";
    } else {
        throw new Exception("Error executing statement: " . $stmt->error);
    }

    // Close the statement
    $stmt->close();

} catch (Exception $e) {
    // Catch and display error message
    echo "❌ Error: " . $e->getMessage();
}
?>
