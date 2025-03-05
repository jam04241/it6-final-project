<?php 
include "dbconnect.php";

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Prepare the SQL query
        $stmt = $conn->prepare("SELECT first_name, middle_inital, last_name, enroll_category, `timestamp` FROM tbl_student_info");
        
        // Execute the query
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();
        
        // Fetch the data
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }

        // Return the data as JSON (optional, if used in an API)
        echo json_encode($students);

        // Close the statement
        $stmt->close();
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Close database connection
$conn->close();
?>
