# 🛒 One Stop Shopie - Complete E-commerce Platform

A comprehensive PHP-based e-commerce website with a modern admin panel for managing products, orders, and users. Built with a responsive design and secure authentication system.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)

## 📋 Table of Contents
- [Features](#-features)
- [Technology Stack](#-technology-stack)
- [Project Structure](#-project-structure)
- [Database Schema](#-database-schema)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Default Credentials](#-default-credentials)
- [Usage](#-usage)
- [Security Features](#-security-features)
- [API Documentation](#-api-documentation)
- [Contributing](#-contributing)
- [Support](#-support)

## ✨ Features

### 🛍️ Customer Features
- **User Authentication**: Secure registration and login system
- **Product Catalog**: Browse products with detailed descriptions and multiple images
- **Advanced Search**: Search products by name, category, or description
- **Shopping Cart**: Add/remove items with real-time cart updates
- **Wishlist**: Save favorite products for later purchase
- **Order Management**: Place orders and track order history with status updates
- **User Profile**: Update personal information and view account details
- **Contact System**: Send messages to administrators
- **Responsive Design**: Optimized for desktop, tablet, and mobile devices

### 🔧 Admin Features
- **Dashboard Analytics**: Overview of sales, orders, products, and user statistics
- **Product Management**: 
  - Add new products with multiple images (up to 3 per product)
  - Update existing product details, pricing, and images
  - Delete products (automatically removes from user carts/wishlists)
- **Order Management**: 
  - View all customer orders
  - Update order payment status (pending/completed)
  - Delete orders if necessary
- **User Management**: 
  - View all registered users
  - Delete user accounts (cascading delete for orders, cart, wishlist)
- **Admin Account Management**: Create and manage multiple admin users
- **Message Center**: View and respond to customer inquiries
- **Profile Management**: Update admin profile information
- **Navigation**: Quick switch between admin and user panels

## 🛠️ Technology Stack

### Backend
- **PHP 7.4+**: Server-side scripting
- **MySQL**: Database management
- **PDO**: Database abstraction layer for secure queries

### Frontend
- **HTML5**: Semantic markup
- **CSS3**: Modern styling with flexbox and grid
- **JavaScript**: Interactive functionality
- **Font Awesome 6.1.1**: Icon library
- **Swiper.js**: Touch slider functionality

### Security
- **SHA1 Hashing**: Password encryption
- **Prepared Statements**: SQL injection prevention
- **Input Sanitization**: XSS protection
- **Session Management**: Secure user authentication

## 📁 Project Structure

```
ecommerce-website/
├── admin/                          # Admin panel files
│   ├── admin_accounts.php          # Manage admin users
│   ├── admin_login.php             # Admin authentication
│   ├── dashboard.php               # Admin dashboard with analytics
│   ├── messages.php                # Customer message management
│   ├── placed_orders.php           # Order management
│   ├── products.php                # Product management (CRUD)
│   ├── register_admin.php          # New admin registration
│   ├── update_product.php          # Edit product details
│   ├── update_profile.php          # Admin profile management
│   └── users_accounts.php          # User account management
├── components/                     # Reusable PHP components
│   ├── admin_header.php            # Admin navigation header
│   ├── admin_logout.php            # Admin logout handler
│   ├── connect.php                 # Database connection
│   ├── footer.php                  # Website footer
│   ├── user_header.php             # User navigation header
│   ├── user_logout.php             # User logout handler
│   └── wishlist_cart.php           # Cart/wishlist functionality
├── css/                            # Stylesheets
│   ├── admin_style.css             # Admin panel styles
│   └── style.css                   # User interface styles
├── images/                         # Static website images
│   ├── about-img.svg               # About page illustration
│   ├── home-bg.png                 # Homepage background
│   ├── home-img-*.png              # Homepage feature images
│   ├── icon-*.png                  # Service/feature icons
│   └── pic-*.png                   # Customer testimonial images
├── js/                             # JavaScript files
│   ├── admin_script.js             # Admin panel interactions
│   └── script.js                   # User interface interactions
├── uploaded_img/                   # Product images uploaded by admin
├── about.php                       # Company information page
├── cart.php                        # Shopping cart page
├── category.php                    # Product category listing
├── checkout.php                    # Order placement page
├── contact.php                     # Customer contact form
├── home.php                        # Homepage/landing page
├── index.php                       # Entry point (redirects to home.php)
├── orders.php                      # User order history
├── quick_view.php                  # Product quick view modal
├── search_page.php                 # Product search results
├── shop.php                        # Main product listing
├── shop_db.sql                     # Database structure and sample data
├── update_user.php                 # User profile update
├── user_login.php                  # User authentication
├── user_register.php               # New user registration
└── wishlist.php                    # User wishlist page
```

## 🗄️ Database Schema

### Tables Overview
```sql
-- Core Tables
├── users          # Customer accounts
├── admins         # Administrator accounts
├── products       # Product catalog
├── cart           # Shopping cart items
├── wishlist       # Saved products
├── orders         # Customer orders
└── messages       # Customer inquiries
```

### Detailed Schema

#### Users Table
```sql
CREATE TABLE `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
);
```

#### Products Table
```sql
CREATE TABLE `products` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);
```

#### Orders Table
```sql
CREATE TABLE `orders` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
);
```

#### Cart Table
```sql
CREATE TABLE `cart` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);
```

## 🚀 Installation

### Prerequisites
- **XAMPP/WAMP/LAMP**: Local server environment
- **PHP 7.4+**: Server-side scripting
- **MySQL 5.7+**: Database server
- **Web Browser**: Chrome, Firefox, Safari, or Edge

### Step-by-Step Installation

1. **Download and Setup Server**
   ```bash
   # Download XAMPP from https://www.apachefriends.org/
   # Install and start Apache + MySQL services
   ```

2. **Clone/Download Project**
   ```bash
   # Place project in htdocs folder
   C:\xampp\htdocs\ecommerce-website\
   ```

3. **Database Setup**
   ```sql
   -- Open phpMyAdmin (http://localhost/phpmyadmin)
   -- Create new database named 'shop_db'
   -- Import shop_db.sql file
   ```

4. **Configuration**
   ```php
   // Update components/connect.php if needed
   $db_name = 'mysql:host=localhost;dbname=shop_db';
   $user_name = 'root';
   $user_password = '';
   ```

5. **File Permissions**
   ```bash
   # Ensure uploaded_img/ folder has write permissions
   chmod 755 uploaded_img/
   ```

6. **Access Application**
   ```
   User Panel: http://localhost/ecommerce-website/
   Admin Panel: http://localhost/ecommerce-website/admin/admin_login.php
   ```

## ⚙️ Configuration

### Database Connection
Update database settings in `components/connect.php`:
```php
<?php
$db_name = 'mysql:host=localhost;dbname=shop_db';
$user_name = 'root';
$user_password = '';
$conn = new PDO($db_name, $user_name, $user_password);
?>
```

### File Upload Settings
- **Maximum file size**: 2MB per image
- **Supported formats**: JPG, PNG, JPEG, WEBP
- **Upload directory**: `uploaded_img/`
- **Images per product**: 3 maximum

### Session Configuration
- **Session timeout**: Browser session
- **Security**: Regeneration on login
- **Storage**: Server-side PHP sessions

## 👥 Default Credentials

### Admin Accounts
```
Username: admin
Password: admin1

Username: Admin  
Password: Admin2
```

### Sample User Accounts
```
Email: dmkukadiya@2005.com
Password: [See database for hashed passwords]
```

### Creating New Admin
```sql
INSERT INTO `admins` (`name`, `password`) 
VALUES ('your_admin_name', SHA1('your_password'));
```

## 📖 Usage

### For Customers
1. **Registration**: Create account via user_register.php
2. **Browse Products**: Navigate through shop.php or search
3. **Add to Cart**: Select products and quantities
4. **Checkout**: Complete order with shipping details
5. **Track Orders**: View order history in orders.php

### For Administrators
1. **Login**: Access admin panel via admin_login.php
2. **Dashboard**: View business analytics and statistics
3. **Manage Products**: Add, edit, or remove products
4. **Process Orders**: Update order status and manage fulfillment
5. **Customer Service**: Respond to customer messages

### Key Workflows

#### Customer Purchase Flow
```
Browse Products → Add to Cart → Checkout → Place Order → Track Status
```

#### Admin Product Management
```
Login → Products Page → Add Product → Upload Images → Set Details → Save
```

#### Order Processing
```
New Order → Admin Dashboard → Order Management → Update Status → Complete
```

## 🔒 Security Features

### Authentication
- **Password Hashing**: SHA1 encryption for all passwords
- **Session Management**: Secure session handling with timeout
- **Access Control**: Role-based access for admin/user areas

### Data Protection
- **SQL Injection Prevention**: Prepared statements for all queries
- **XSS Protection**: Input sanitization and validation
- **CSRF Protection**: Form token validation (recommended addition)
- **File Upload Security**: Type and size validation for images

### Input Validation
```php
// Example sanitization
$name = filter_var($name, FILTER_SANITIZE_STRING);
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
```

## 📚 API Documentation

### Core Functions

#### User Authentication
```php
// Login validation
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}
```

#### Cart Operations
```php
// Add to cart
$insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
$insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
```

#### Order Processing
```php
// Place order
$insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
$insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);
```

### Database Relationships
- **Users** → **Cart** (1:N)
- **Users** → **Wishlist** (1:N)  
- **Users** → **Orders** (1:N)
- **Products** → **Cart** (1:N)
- **Products** → **Wishlist** (1:N)

## 🌟 Features Highlight

### Modern UI/UX
- **Responsive Design**: Mobile-first approach
- **Smooth Animations**: CSS transitions and hover effects
- **Modern Color Scheme**: Professional gradient backgrounds
- **Intuitive Navigation**: Clear menu structure
- **Loading States**: User feedback for actions

### Performance Optimizations
- **Efficient Queries**: Optimized database operations
- **Image Optimization**: Compressed product images
- **Minimal Dependencies**: Lightweight external libraries
- **Caching**: Browser caching for static assets

### Business Intelligence
- **Sales Analytics**: Total revenue tracking
- **Order Metrics**: Pending vs completed orders
- **User Statistics**: Registration and engagement tracking
- **Product Performance**: Popular items and inventory

## 🤝 Contributing

We welcome contributions to improve the platform! Please follow these guidelines:

### Development Setup
1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Make your changes
4. Test thoroughly
5. Commit changes (`git commit -m 'Add some AmazingFeature'`)
6. Push to branch (`git push origin feature/AmazingFeature`)
7. Open a Pull Request

### Code Standards
- **PHP**: Follow PSR-12 coding standards
- **JavaScript**: Use ES6+ features where supported
- **CSS**: Maintain consistent naming conventions
- **Database**: Use prepared statements for all queries

### Testing Checklist
- [ ] User registration and login
- [ ] Product CRUD operations
- [ ] Cart functionality
- [ ] Order placement and tracking
- [ ] Admin panel operations
- [ ] Mobile responsiveness
- [ ] Cross-browser compatibility

## 🛡️ Security Considerations

### Recommended Enhancements
- **CSRF Protection**: Add token validation to forms
- **Rate Limiting**: Implement login attempt limiting
- **HTTPS**: Use SSL certificates in production
- **Password Policies**: Enforce strong password requirements
- **File Upload Validation**: Enhanced image validation
- **Error Handling**: Implement proper error logging

### Production Deployment
- Change default admin credentials
- Update database connection settings
- Configure proper file permissions
- Enable error logging
- Set up regular database backups
- Implement SSL certificates

## 📞 Support

### Getting Help
- **Documentation**: Check this README and inline comments
- **Issues**: Report bugs via GitHub issues
- **Email**: Contact development team
- **Forums**: Community support available

### Common Issues
1. **Database Connection**: Check XAMPP services and credentials
2. **Image Upload**: Verify folder permissions for uploaded_img/
3. **Session Issues**: Clear browser cache and cookies
4. **Admin Access**: Ensure admin account exists in database

### Troubleshooting
```bash
# Check Apache/MySQL status
# Verify database exists
# Confirm file permissions
# Test with different browsers
```

## 📄 License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## 🙏 Acknowledgments

- **Font Awesome**: Icon library
- **Swiper.js**: Touch slider functionality
- **PHP Community**: Server-side scripting language
- **MySQL**: Database management system
- **XAMPP**: Development environment

## 📈 Roadmap

### Planned Features
- [ ] Payment Gateway Integration (PayPal, Stripe)
- [ ] Multi-currency Support
- [ ] Product Categories and Filters
- [ ] Customer Reviews and Ratings
- [ ] Email Notifications
- [ ] Inventory Management
- [ ] Sales Reports and Analytics
- [ ] Multi-language Support
- [ ] Social Media Integration
- [ ] API for Mobile Apps

### Performance Improvements
- [ ] Database Query Optimization
- [ ] Image Lazy Loading
- [ ] CDN Integration
- [ ] Caching Implementation
- [ ] Code Minification

---

## 🚀 Quick Start

Ready to get started? Follow these quick steps:

1. **Install XAMPP** and start Apache + MySQL
2. **Download** this project to `htdocs/ecommerce-website/`
3. **Import** `shop_db.sql` into phpMyAdmin
4. **Visit** `http://localhost/ecommerce-website/`
5. **Admin Login** at `/admin/admin_login.php` with credentials above

**Happy Coding! 🎉**

---

*Built with ❤️ for e-commerce excellence*
