<?php
    session_start();
    
    session_unset(); //This removes all session variables
    session_destroy(); //Destroy session
header("Location:Login.php"); // Send back to login page
exit;
?>