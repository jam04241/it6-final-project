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

            //✅ Access tiem for employee
            $stmt3 = $conn->prepare("UPDATE 
                                              tbl_employee 
                                            SET 
                                              access_time = NOW()  
                                            WHERE 
                                              employee_id = ?");
            $stmt3->bind_param('i', $employee_id);
            $stmt3->execute();
            

            // ✅ Call stored procedure for audit logging
            $stmt2 = $conn->prepare("CALL audit_login_employee(?, ?)");
            $stmt2->bind_param('is', $employee_id, $employee_position);
            $stmt2->execute();
            
            $stmt1->close();
            $stmt2->close();
            $stmt3->close();
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