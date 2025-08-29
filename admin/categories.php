<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_category'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../images/'.$image;

   $select_categories = $conn->prepare("SELECT * FROM `categories` WHERE name = ?");
   $select_categories->execute([$name]);

   if($select_categories->rowCount() > 0){
      $message[] = 'Category name already exists!';
   }else{
      if($image_size > 2000000){
         $message[] = 'Image size is too large!';
      }else{
         $insert_category = $conn->prepare("INSERT INTO `categories`(name, description, image) VALUES(?,?,?)");
         $insert_category->execute([$name, $description, $image]);
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'New category added successfully!';
      }
   }

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_category_image = $conn->prepare("SELECT * FROM `categories` WHERE id = ?");
   $delete_category_image->execute([$delete_id]);
   $fetch_delete_image = $delete_category_image->fetch(PDO::FETCH_ASSOC);
   unlink('../images/'.$fetch_delete_image['image']);
   $delete_category = $conn->prepare("DELETE FROM `categories` WHERE id = ?");
   $delete_category->execute([$delete_id]);
   header('location:categories.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Categories</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="add-products">

   <h1 class="heading">Add Category</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>Category Name (required)</span>
            <input type="text" class="box" required maxlength="20" placeholder="Enter category name" name="name">
         </div>
         <div class="inputBox">
            <span>Category Description (required)</span>
            <textarea name="description" placeholder="Enter category description" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
         <div class="inputBox">
            <span>Category Icon (required)</span>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
         </div>
      </div>
      
      <input type="submit" value="Add Category" class="btn" name="add_category">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">Categories Added</h1>

   <div class="box-container">

   <?php
      $select_categories = $conn->prepare("SELECT * FROM `categories`"); 
      $select_categories->execute();
      if($select_categories->rowCount() > 0){
         while($fetch_categories = $select_categories->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="../images/<?= $fetch_categories['image']; ?>" alt="">
      <div class="name"><?= $fetch_categories['name']; ?></div>
      <div class="details"><span><?= $fetch_categories['description']; ?></span></div>
      <div class="flex-btn">
         <a href="update_category.php?update=<?= $fetch_categories['id']; ?>" class="option-btn">Update</a>
         <a href="categories.php?delete=<?= $fetch_categories['id']; ?>" class="delete-btn" onclick="return confirm('Delete this category?');">Delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">No categories added yet!</p>';
      }
   ?>
   
   </div>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
