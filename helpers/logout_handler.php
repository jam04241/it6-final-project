<?php
include "../helpers/session.php";
include "../database/dbconnect.php";
if (!isset($_SESSION["employee_id"])) {
    die("❌ Error: Employee ID not found in session!");
}

// Get employee_id from session
$employee_id = $_SESSION["employee_id"];

// ✅ Fetch employee position
$stmt1 = $conn->prepare("SELECT employee_position FROM tbl_employee WHERE employee_id = ?");
$stmt1->bind_param('i', $employee_id);
$stmt1->execute();
$result = $stmt1->get_result();

if ($row = $result->fetch_assoc()) {
    $employee_position = $row['employee_position'];
} else {
    die("❌ Error: Employee position not found!");
}

// ✅ Call stored procedure for audit logging
$stmt2 = $conn->prepare("CALL audit_logout_employee(?, ?)");
$stmt2->bind_param('is', $employee_id, $employee_position);
$stmt2->execute();
$stmt2->close();

// ✅ Destroy session after logging the action
session_unset();
session_destroy();

// ✅ Redirect to login page
header("Location: ../website/index.php");
exit();
?>
