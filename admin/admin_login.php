<?php

include '../components/connect.php';

session_start();

// Clear user session if exists (prevent simultaneous sessions)
if(isset($_SESSION['user_id'])){
   unset($_SESSION['user_id']);
}

// If admin is already logged in, redirect to dashboard
if(isset($_SESSION['admin_id'])){
   header('location:dashboard.php');
   exit();
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   // First get the admin by username only
   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
   $select_admin->execute([$name]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $password_verified = false;
      
      // Check if password is already in new format (starts with $2y$)
      if(strpos($row['password'], '$2y$') === 0) {
         // New secure hash - use password_verify
         $password_verified = password_verify($pass, $row['password']);
      } else {
         // Old format - check both SHA1 and plain text for backward compatibility
         $sha1_pass = sha1($pass);
         if($row['password'] === $sha1_pass || $row['password'] === $pass) {
            $password_verified = true;
            
            // Automatically upgrade to new secure hash
            $new_hash = password_hash($pass, PASSWORD_DEFAULT);
            $update_password = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
            $update_password->execute([$new_hash, $row['id']]);
         }
      }
      
      if($password_verified) {
         // Clear any existing user session when admin logs in
         if(isset($_SESSION['user_id'])){
            unset($_SESSION['user_id']);
         }
         $_SESSION['admin_id'] = $row['id'];
         header('location:dashboard.php');
      } else {
         $message[] = 'Incorrect username or password!';
      }
   } else {
      $message[] = 'Incorrect username or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<section class="form-container">

   <form action="" method="post">
      <h3>Login Now</h3>
      
      <input type="text" name="name" required placeholder="Enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Login Now" class="btn" name="submit">
   </form>

</section>
   
</body>
</html>