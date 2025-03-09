<?php
session_start();
include '../database/dbconnect.php'; // Ensure the file path is correct

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "<script>alert('⚠️ Username and Password are required!'); window.location.href = '../website/index.php';</script>";
        exit;
    }

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT password FROM tbl_employee WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // If user exists, fetch password
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($password_hashed);
        $stmt->fetch();

        // Debugging: Show entered password & hashed password
        echo "<script>alert('Entered Password: $password \\nHashed Password: $password_hashed');</script>";

        // Check password
        if (password_verify($password, $password_hashed)) {
            $_SESSION['username'] = $username;
            echo "<script>alert('✅ Login successful!'); window.location.href = '../website/dashboards.php';</script>";
        } else {
            echo "<script>alert('❌ Incorrect password!'); window.location.href = '../website/index.php';</script>";
        }
    } else {
        echo "<script>alert('❌ Username not found!'); window.location.href = '../website/index.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
