<?php

include 'components/connect.php';

session_start();

// Clear admin session if exists (prevent simultaneous sessions)
if(isset($_SESSION['admin_id'])){
   unset($_SESSION['admin_id']);
}

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

// Check if category parameter exists
if(!isset($_GET['category']) || empty($_GET['category'])){
   header('location: shop.php');
   exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= isset($_GET['category']) ? ucfirst($_GET['category']) : 'Category' ?> - Shop</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products">

   <!-- Breadcrumb Navigation -->
   <div style="text-align: center; margin-bottom: 1rem; color: #666; font-size: 1.4rem;">
      <a href="home.php" style="color: #8e44ad; text-decoration: none;">Home</a> 
      <span style="margin: 0 0.5rem;">></span>
      <a href="shop.php" style="color: #8e44ad; text-decoration: none;">Shop</a>
      <span style="margin: 0 0.5rem;">></span>
      <span><?= ucfirst($_GET['category']) ?></span>
   </div>

   <h1 class="heading"><?= isset($_GET['category']) ? ucfirst($_GET['category']) : 'Category' ?> Products</h1>
   
   <div style="text-align: center; margin-bottom: 2rem;">
      <a href="shop.php" class="btn" style="display: inline-block;">← Back to All Products</a>
   </div>

   <div class="box-container">

   <?php
     $category = $_GET['category'];
     $category = filter_var($category, FILTER_SANITIZE_STRING);
     
     // Try to find products by category name first (new method)
     $select_category = $conn->prepare("SELECT id FROM `categories` WHERE LOWER(name) = LOWER(?)");
     $select_category->execute([$category]);
     
     if($select_category->rowCount() > 0){
        // Category exists in database, use category_id
        $category_data = $select_category->fetch(PDO::FETCH_ASSOC);
        $category_id = $category_data['id'];
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE category_id = ?"); 
        $select_products->execute([$category_id]);
     }else{
        // Fallback to old method for backward compatibility
        $category_terms = array();
        switch(strtolower($category)) {
           case 'laptop':
              $category_terms = ['laptop', 'macbook', 'hp laptop', 'lenovo'];
              break;
           case 'tv':
              $category_terms = ['tv', 'television', 'sony tv'];
              break;
           case 'camera':
              $category_terms = ['camera', 'canon camera'];
              break;
           case 'mouse':
              $category_terms = ['mouse'];
              break;
           case 'fridge':
              $category_terms = ['fridge', 'refrigerator', 'samsung fridge'];
              break;
           case 'washing':
              $category_terms = ['washing', 'machine'];
              break;
           case 'smartphone':
              $category_terms = ['phone', 'smartphone', 'mobile', 'realme phone'];
              break;
           case 'watch':
              $category_terms = ['watch', 'rolex', 'citizen', 'realme smart watch', 'smart watch'];
              break;
           default:
              $category_terms = [$category];
        }
        
        // Build the WHERE clause for multiple terms (case-insensitive)
        $where_conditions = array();
        $params = array();
        foreach($category_terms as $term) {
           $where_conditions[] = "LOWER(name) LIKE LOWER(?)";
           $params[] = '%' . $term . '%';
        }
        $where_clause = implode(' OR ', $where_conditions);
        
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE " . $where_clause); 
        $select_products->execute($params);
     }
     
     $product_count = $select_products->rowCount();
     
     if($product_count > 0){
        echo '<p style="text-align: center; margin-bottom: 2rem; font-size: 1.6rem; color: #666;">Found ' . $product_count . ' product(s) in ' . ucfirst($category) . ' category</p>';
        while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>Rs</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<div style="text-align: center; padding: 3rem;">';
      echo '<p class="empty">No products found in the ' . ucfirst($category) . ' category!</p>';
      echo '<p style="margin-top: 1rem; color: #666;">Try browsing other categories or check all products.</p>';
      echo '<a href="shop.php" class="btn" style="margin-top: 1rem; display: inline-block;">View All Products</a>';
      echo '</div>';
   }
   ?>

   </div>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>