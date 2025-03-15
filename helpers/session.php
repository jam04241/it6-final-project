<?php
session_start();

// Store the username for use
if (!isset($_SESSION["username"]) || !isset($_SESSION["employee_id"])) {
    echo "Session not set!";
}// else {
//     echo "Welcome, " . $_SESSION["username"] . " (ID: " . $_SESSION["employee_id"] . ")";
// }

    $username = $_SESSION["username"]; 
    $employee_id = $_SESSION["employee_id"];

?>
