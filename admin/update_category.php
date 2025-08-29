<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update'])){

   $category_id = $_POST['category_id'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);

   $update_category = $conn->prepare("UPDATE `categories` SET name = ?, description = ? WHERE id = ?");
   $update_category->execute([$name, $description, $category_id]);

   $message[] = 'Category updated successfully!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../images/'.$image;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'Image size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `categories` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $category_id]);
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('../images/'.$old_image);
         $message[] = 'Image updated successfully!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Category</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="update-product">

   <h1 class="heading">Update Category</h1>

   <?php
      $update_id = $_GET['update'];
      $select_categories = $conn->prepare("SELECT * FROM `categories` WHERE id = ?");
      $select_categories->execute([$update_id]);
      if($select_categories->rowCount() > 0){
         while($fetch_categories = $select_categories->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="category_id" value="<?= $fetch_categories['id']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_categories['image']; ?>">
      <div class="image-container">
         <div class="main-image">
            <img src="../images/<?= $fetch_categories['image']; ?>" alt="">
         </div>
      </div>
      <span>Update Name</span>
      <input type="text" name="name" required class="box" maxlength="20" placeholder="Enter category name" value="<?= $fetch_categories['name']; ?>">
      <span>Update Description</span>
      <textarea name="description" class="box" required maxlength="500" placeholder="Enter category description" cols="30" rows="10"><?= $fetch_categories['description']; ?></textarea>
      <span>Update Image</span>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <div class="flex-btn">
         <input type="submit" name="update" class="btn" value="Update">
         <a href="categories.php" class="option-btn">Go Back</a>
      </div>
   </form>
   
   <?php
         }
      }else{
         echo '<p class="empty">No category found!</p>';
      }
   ?>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
