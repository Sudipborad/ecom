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

<header class="header">

   <section class="flex">

      <a href="../admin/dashboard.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="../admin/dashboard.php" <?= (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'class="active"' : ''; ?>>Home</a>
         <a href="../admin/products.php" <?= (basename($_SERVER['PHP_SELF']) == 'products.php') ? 'class="active"' : ''; ?>>Products</a>
         <a href="../admin/categories.php" <?= (basename($_SERVER['PHP_SELF']) == 'categories.php') ? 'class="active"' : ''; ?>>Categories</a>
         <a href="../admin/placed_orders.php" <?= (basename($_SERVER['PHP_SELF']) == 'placed_orders.php') ? 'class="active"' : ''; ?>>Orders</a>
         <a href="../admin/admin_accounts.php" <?= (basename($_SERVER['PHP_SELF']) == 'admin_accounts.php') ? 'class="active"' : ''; ?>>Admins</a>
         <a href="../admin/users_accounts.php" <?= (basename($_SERVER['PHP_SELF']) == 'users_accounts.php') ? 'class="active"' : ''; ?>>Users</a>
         <a href="../admin/messages.php" <?= (basename($_SERVER['PHP_SELF']) == 'messages.php') ? 'class="active"' : ''; ?>>Messages</a>
         <a href="../components/clear_admin_session.php" class="user-panel-link">User Panel</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="../admin/update_profile.php" class="btn">Update Profile</a>
         <div class="flex-btn">
            <a href="../admin/register_admin.php" class="option-btn">Register</a>
            <a href="../admin/admin_login.php" class="option-btn">Login</a>
         </div>
         <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('Logout from the website?');">Logout</a> 
      </div>

   </section>

</header>