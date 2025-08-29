-- Add Categories Table
CREATE TABLE `categories` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default categories
INSERT INTO `categories` (`name`, `description`, `image`) VALUES
('laptop', 'High-performance laptops and notebooks for work and gaming', 'icon-1.png'),
('tv', 'Smart TVs and entertainment systems', 'icon-2.png'),
('camera', 'Digital cameras and photography equipment', 'icon-3.png'),
('mouse', 'Computer mice and pointing devices', 'icon-4.png'),
('fridge', 'Refrigerators and cooling appliances', 'icon-5.png'),
('washing', 'Washing machines and laundry equipment', 'icon-6.png'),
('smartphone', 'Mobile phones and smartphones', 'icon-7.png'),
('watch', 'Watches and smartwatches', 'icon-8.png');

-- Add category_id column to products table
ALTER TABLE `products` ADD `category_id` int(100) DEFAULT NULL AFTER `id`;

-- Update existing products with category IDs based on their names
UPDATE `products` SET `category_id` = 1 WHERE LOWER(name) LIKE '%laptop%' OR LOWER(name) LIKE '%macbook%' OR LOWER(name) LIKE '%hp%';
UPDATE `products` SET `category_id` = 2 WHERE LOWER(name) LIKE '%tv%';
UPDATE `products` SET `category_id` = 3 WHERE LOWER(name) LIKE '%camera%';
UPDATE `products` SET `category_id` = 4 WHERE LOWER(name) LIKE '%mouse%';
UPDATE `products` SET `category_id` = 5 WHERE LOWER(name) LIKE '%fridge%';
UPDATE `products` SET `category_id` = 6 WHERE LOWER(name) LIKE '%washing%';
UPDATE `products` SET `category_id` = 7 WHERE LOWER(name) LIKE '%phone%' OR LOWER(name) LIKE '%smartphone%';
UPDATE `products` SET `category_id` = 8 WHERE LOWER(name) LIKE '%watch%';

-- Add foreign key constraint
ALTER TABLE `products` ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL;
