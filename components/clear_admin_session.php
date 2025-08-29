<?php
session_start();

// Clear admin session and redirect to home page
if(isset($_SESSION['admin_id'])){
    unset($_SESSION['admin_id']);
}

// Redirect to home page
header('location: ../home.php');
exit();
?>
