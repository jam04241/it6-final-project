<?php
include "../helpers/session.php";
session_start();
session_unset();  // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to the login page
header("Location: ../website/index.php");
exit();
?>
