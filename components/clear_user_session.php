<?php
session_start();

// Clear user session and redirect to admin login
if(isset($_SESSION['user_id'])){
    unset($_SESSION['user_id']);
}

// Redirect to admin login page
header('location: ../admin/admin_login.php');
exit();
?>
