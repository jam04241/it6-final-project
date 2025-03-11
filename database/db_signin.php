<?php

include 'dbconnect.php';
session_start();

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

    // Check if passwords match
    if ($password !== $verify_pass) {
        echo 
        "<script>
            alert('❌ Password Mismatch!');
            window.location.href = '../website/signin.php';
        </script>";
        exit;
    }

    // Check if username already exists
    if (username_exists($username)) {
        echo"
        <script>
            alert('❌ Username already taken!');
            window.location.href = '../website/signin.php';
        </script>
        ";
        exit;
    }

    
    if (create_account($employee_position, $username, $password, $last_name, $first_name, $middle_name, $verify_pass)) {
        echo"
        <script>
            alert('✅ Account successfully created!');
            window.location.href = '../website/index.php';
        </script>
        ";
        exit;           
      // Create an account if username does not exist
    } else {
        echo"
        <script>
            alert('❌ Account creation failed!');
            window.location.href = '../website/signin.php';
        </script>
        ";
        exit;
    }
  }
} catch (\Exception $e) {
  echo "Error: " . $e->getMessage();
}

function username_exists($username)
{
  global $conn;

  $stmt = $conn->prepare("SELECT employee_id FROM tbl_employee WHERE username = ?");
  if (!$stmt) {
    return false;
  }

  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->store_result();

  return $stmt->num_rows > 0;
}

function create_account($employee_position, $username, $password, $last_name, $first_name, $middle_name, $verify_pass)
{
  global $conn;

  $hashed_password = password_hash($password, PASSWORD_BCRYPT);

  $stmt = $conn->prepare("	INSERT INTO tbl_employee(
                                        employee_position,
                                        username,
                                        password,
                                        last_name,
                                        first_name,
                                        middle_name,
                                        verify_pass,
                                        timestamp
                                        )
                                  VALUES(
                                        ?,
                                        ?,
                                        ?,
                                        ?,
                                        ?,
                                        ?,
                                        ?,
                                        NOW()
                                        );");
  if (!$stmt) {
    return false;
  }

  $stmt->bind_param("sssssss", $employee_position, $username, $hashed_password, $last_name, $first_name, $middle_name, $verify_pass);
  return $stmt->execute();
}
