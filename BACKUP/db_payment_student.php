<?php
session_start();
include "dbconnect.php";

// Enable MySQLi exceptions 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Validate session
    if (!isset($_SESSION["employee_id"])) {
        throw new Exception("Employee ID is not set in the session.");
    }
    $employee_id = $_SESSION["employee_id"];

    // Validate POST request
    if (!isset($_POST["student_id"], $_POST["pay"], $_POST["payment_method"])) {
        throw new Exception("Required form data is missing.");
    }

    // Retrieve form data
    $student_id = intval($_POST["student_id"]);
    $pay = floatval($_POST["pay"]);
    $payment_method = $_POST["payment_method"];

    if ($pay <= 0) {
        throw new Exception("Invalid payment amount.");
    }

    // Fetch current payment details
    $query = "SELECT payment_no, total, balance, payment_method, date_updated FROM tbl_payment WHERE student_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception("No payment record found for Student ID: $student_id.");
    }

    $payment = $result->fetch_assoc();
    $payment_no = $payment["payment_no"];
    $prev_payment_method = $payment["payment_method"]; // Fetch existing payment method
    $new_total = round($payment["total"] + $pay, 2);
    $new_balance = round($payment["balance"] - $pay, 2);

    // Update payment record
    $update_stmt = $conn->prepare("UPDATE tbl_payment 
                                   SET pay = ?, total = ?, balance = ?, payment_method = ?, updated_by = ?, date_updated = NOW()
                                   WHERE student_id = ?");
    $update_stmt->bind_param("dddsii", $pay, $new_total, $new_balance, $payment_method, $employee_id, $student_id);
    $update_stmt->execute();

    // Fetch employee position for audit logging
    $stmt1 = $conn->prepare("SELECT employee_position FROM tbl_employee WHERE employee_id = ?");
    $stmt1->bind_param("i", $employee_id);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    
    if ($row = $result1->fetch_assoc()) {
        $employee_position = $row['employee_position'];
    } else {
        throw new Exception("Employee position not found!");
    }

    // ✅ Call stored procedure for audit logging
    $stmt2 = $conn->prepare("CALL audit_pay_student(?, ?)");
    $stmt2->bind_param("is", $employee_id, $employee_position);
    $stmt2->execute();
    $stmt2->close();

    // Redirect to payment receipt
    echo "<script>
        alert('✅ Payment successful! Print the receipt.');
        window.location.href = '../print/payment-receipt.php?payment_no=' + encodeURIComponent($payment_no);
    </script>";
    exit;

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
