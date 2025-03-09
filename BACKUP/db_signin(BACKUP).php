<?php
session_start();
include 'dbconnect.php'; // Ensure this connects using MySQLi

// Get form input
$employee_position = $_POST['employee_position'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$username = $_POST['username'];
$password = $_POST['password'];
$verify_pass = $_POST['verify_pass'];

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Ensure fields are not empty
        // if (empty($username) || empty($password)) {
        //     echo "<script>alert('⚠️ Username and Password are required!'); window.location.href = '../website/signup.php';</script>";
        //     exit;
        // }
        
        // Check if passwords match before proceeding
        if ($password !== $verify_pass) {
            die("Error: Passwords do not match.");
        }

        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare the stored procedure call
        $stmt = $conn->prepare("CALL insert_tbl_employee(?,?,?,?,?,?,?);");

        if (!$stmt) {
            die("Error: Failed to prepare the statement.");
        }

        // Bind parameters using MySQLi
        $stmt->bind_param("sssssss", $employee_position, $username, $hashed_password, $last_name, $first_name, $middle_name, $verify_pass);

        // Execute the query
        if ($stmt->execute()) {
          echo "<script>
                  alert('User successfully registered!');
                  window.location.href = '../website/index.php';
                </script>";
          exit();
        } 
        else {
            echo "Error: Unable to register.";
        }

        // Close the statement
        $stmt->close();
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn->close();

?>
