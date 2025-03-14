<?php
require '../database/dbconnect.php'; // Adjust this based on your setup

if (isset($_POST['tutorial_id'])) {
    $tutorial_id = $_POST['tutorial_id'];

    $query = "SELECT * FROM tbl_tutor_info WHERE tutorial_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $tutorial_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><th>Tutorial ID</th><td>{$row['tutorial_id']}</td></tr>";
        echo "<tr><th>Start Date</th><td>{$row['date_start']}</td></tr>";
        echo "<tr><th>School</th><td>{$row['school']}</td></tr>";
        echo "<tr><th>Grade Level</th><td>{$row['grade_level']}</td></tr>";
        echo "<tr><th>Time of Arrival</th><td>{$row['time_arrival']}</td></tr>";
        echo "<tr><th>Focus Subject</th><td>{$row['focus_subject']}</td></tr>";
        echo "<tr><th>Full Name</th><td>{$row['first_name']} {$row['middle_name']} {$row['last_name']}</td></tr>";
        echo "<tr><th>Sex</th><td>{$row['sex']}</td></tr>";
        echo "<tr><th>Address</th><td>{$row['street']}, {$row['city']}, {$row['zip_code']}</td></tr>";
        echo "<tr><th>Emergency Contact</th><td>{$row['emergency_fullname']} ({$row['emergency_relationship']})</td></tr>";
        echo "<tr><th>Emergency Address</th><td>{$row['emergency_address']}</td></tr>";
        echo "<tr><th>Emergency Contact No.</th><td>{$row['emergency_contact_no']}</td></tr>";
        
    } else {
        echo "<tr><td colspan='2' class='text-center'>No tutor student data found</td></tr>";
    }
    
    mysqli_stmt_close($stmt);
}
?>