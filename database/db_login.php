<?php

    session_start();
    include 'dbconnect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    try {
      if ($_SERVER['REQUEST_METHOD'] == "POST") {

    
        $user = verify_user($username, $password);
    
        if ($user) {
          
            // Store the username in the session
            $_SESSION["username"] = $user['username']; 
            $_SESSION["employee_id"] = $user['employee_id']; 


          echo"
          <script>
            alert('✅ Welcome to School System');
            window.location.href = '../website/dashboards.php';
          </script>";  
          exit;
          
        } else {
            echo 
            "<script>
                alert('❌ Credential Mismatch!');
                window.location.href = '../website/index.php';
            </script>";
            exit;
        }
      }
    } catch (\Exception $e) {
      echo "Error: " . $e->getMessage();
    }
    
    function verify_user($username, $password)
    {
      global $conn;
     
      $stmt = $conn->prepare("	SELECT 
                                        employee_id, username, password
                                      FROM 
                                        tbl_employee 
                                      WHERE 
                                        username = ?;");
                                        
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();
    
      if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
          return $row; // Return user info
        }
      }
      return false;
    }
?>