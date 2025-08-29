<?php
include 'components/connect.php';

echo "<h2>Category Management Database Setup</h2>";

try {
    // Check if categories table exists
    $check_table = $conn->query("SHOW TABLES LIKE 'categories'");
    
    if($check_table->rowCount() == 0) {
        echo "<p>Creating categories table...</p>";
        
        // Create categories table
        $create_table = "CREATE TABLE `categories` (
          `id` int(100) NOT NULL AUTO_INCREMENT,
          `name` varchar(50) NOT NULL,
          `description` varchar(500) NOT NULL,
          `image` varchar(100) NOT NULL,
          `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        
        $conn->exec($create_table);
        echo "<p style='color: green;'>✓ Categories table created successfully!</p>";
        
        // Insert default categories
        $insert_categories = "INSERT INTO `categories` (`name`, `description`, `image`) VALUES
        ('laptop', 'High-performance laptops and notebooks for work and gaming', 'icon-1.png'),
        ('tv', 'Smart TVs and entertainment systems', 'icon-2.png'),
        ('camera', 'Digital cameras and photography equipment', 'icon-3.png'),
        ('mouse', 'Computer mice and pointing devices', 'icon-4.png'),
        ('fridge', 'Refrigerators and cooling appliances', 'icon-5.png'),
        ('washing', 'Washing machines and laundry equipment', 'icon-6.png'),
        ('smartphone', 'Mobile phones and smartphones', 'icon-7.png'),
        ('watch', 'Watches and smartwatches', 'icon-8.png');";
        
        $conn->exec($insert_categories);
        echo "<p style='color: green;'>✓ Default categories inserted successfully!</p>";
        
    } else {
        echo "<p style='color: orange;'>Categories table already exists!</p>";
    }
    
    // Check if products table has category_id column
    $check_column = $conn->query("SHOW COLUMNS FROM `products` LIKE 'category_id'");
    
    if($check_column->rowCount() == 0) {
        echo "<p>Adding category_id column to products table...</p>";
        
        // Add category_id column
        $add_column = "ALTER TABLE `products` ADD `category_id` int(100) DEFAULT NULL AFTER `id`";
        $conn->exec($add_column);
        echo "<p style='color: green;'>✓ Category_id column added to products table!</p>";
        
        // Update existing products with category IDs
        $updates = [
            "UPDATE `products` SET `category_id` = 1 WHERE LOWER(name) LIKE '%laptop%' OR LOWER(name) LIKE '%macbook%' OR LOWER(name) LIKE '%hp%'",
            "UPDATE `products` SET `category_id` = 2 WHERE LOWER(name) LIKE '%tv%'",
            "UPDATE `products` SET `category_id` = 3 WHERE LOWER(name) LIKE '%camera%'",
            "UPDATE `products` SET `category_id` = 4 WHERE LOWER(name) LIKE '%mouse%'",
            "UPDATE `products` SET `category_id` = 5 WHERE LOWER(name) LIKE '%fridge%'",
            "UPDATE `products` SET `category_id` = 6 WHERE LOWER(name) LIKE '%washing%'",
            "UPDATE `products` SET `category_id` = 7 WHERE LOWER(name) LIKE '%phone%' OR LOWER(name) LIKE '%smartphone%'",
            "UPDATE `products` SET `category_id` = 8 WHERE LOWER(name) LIKE '%watch%'"
        ];
        
        foreach($updates as $update) {
            $conn->exec($update);
        }
        echo "<p style='color: green;'>✓ Existing products updated with category IDs!</p>";
        
        // Add foreign key constraint
        try {
            $add_fk = "ALTER TABLE `products` ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL";
            $conn->exec($add_fk);
            echo "<p style='color: green;'>✓ Foreign key constraint added!</p>";
        } catch(Exception $e) {
            echo "<p style='color: orange;'>⚠ Foreign key constraint already exists or couldn't be added.</p>";
        }
        
    } else {
        echo "<p style='color: orange;'>Category_id column already exists in products table!</p>";
    }
    
    echo "<br><h3 style='color: green;'>✅ Database setup complete!</h3>";
    echo "<p><strong>You can now:</strong></p>";
    echo "<ul>";
    echo "<li>Go to <a href='admin/categories.php'>Admin > Categories</a> to manage categories</li>";
    echo "<li>Add new products with category selection</li>";
    echo "<li>Categories will be dynamically loaded on the homepage</li>";
    echo "</ul>";
    echo "<br><p><a href='home.php' style='background: #8e44ad; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Homepage</a></p>";
    
} catch(Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}
?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; }
h2 { color: #333; }
p { margin: 10px 0; }
ul { margin-left: 20px; }
</style>
