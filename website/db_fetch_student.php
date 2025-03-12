<?php
require '../database/dbconnect.php'; // Adjust this based on your setup

if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    $query = "SELECT * FROM tbl_student_info WHERE student_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><th>Student ID</th><td>{$row['student_id']}</td></tr>";
        echo "<tr><th>Enrollment Category</th><td>{$row['enroll_category']}</td></tr>";
        echo "<tr><th>School Year</th><td>{$row['schoolyear']}</td></tr>";
        echo "<tr><th>Full Name</th><td>{$row['first_name']} {$row['middle_name']} {$row['last_name']}</td></tr>";
        echo "<tr><th>Address</th><td>{$row['street']}, {$row['city']}, {$row['zip_code']}</td></tr>";
        echo "<tr><th>Birthdate</th><td>{$row['birthdate']}</td></tr>";
        echo "<tr><th>Sex</th><td>{$row['sex']}</td></tr>";
        echo "<tr><th>Father</th><td>{$row['parent1']}";
        echo "<tr><th>Father Contact Number</th><td>({$row['parent1_contact']})</td></tr>";
        echo "<tr><th>Mother</th><td>{$row['parent2']}";
        echo "<tr><th>Mother Contact Number</th><td>({$row['parent2_contact']})</td></tr>";
        echo "<tr><th>Emergency Contact</th><td>{$row['emergency_fullname']} ({$row['emergency_relationship']})</td></tr>";
        echo "<tr><th>Emergency Address</th><td>{$row['emergency_address']}</td></tr>";
        echo "<tr><th>Emergency Contact No.</th><td>{$row['emergency_contact_no']}</td></tr>";
    } else {
        echo "<tr><td colspan='2' class='text-center'>No student data found</td></tr>";
    }
    
    mysqli_stmt_close($stmt);
}
?>