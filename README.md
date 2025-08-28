# 🛒 One Stop Shopie - E-commerce Website

A complete PHP-based e-commerce website with admin panel for managing products, orders, and users.

## 📋 Features

### User Features
- **User Registration & Login**: Secure user authentication system
- **Product Browsing**: Browse products by categories
- **Search Functionality**: Search for specific products
- **Shopping Cart**: Add/remove items from cart
- **Wishlist**: Save favorite products for later
- **Order Management**: Place orders and track order history
- **User Profile**: Update personal information
- **Contact Form**: Send messages to admin

### Admin Features
- **Admin Dashboard**: Overview of orders, products, and users
- **Product Management**: Add, update, and delete products
- **Order Management**: View and update order status
- **User Management**: View and manage user accounts
- **Admin Accounts**: Manage multiple admin users
- **Messages**: View customer messages
- **Profile Management**: Update admin profile

## 🛠️ Technology Stack

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Libraries**: 
  - Font Awesome (Icons)
  - Swiper.js (Sliders)

## 📁 Project Structure

```
ecommerce website/
├── admin/                  # Admin panel files
│   ├── admin_accounts.php
│   ├── admin_login.php
│   ├── dashboard.php
│   ├── messages.php
│   ├── placed_orders.php
│   ├── products.php
│   ├── register_admin.php
│   ├── update_product.php
│   ├── update_profile.php
│   └── users_accounts.php
├── components/             # Reusable components
│   ├── admin_header.php
│   ├── admin_logout.php
│   ├── connect.php
│   ├── footer.php
│   ├── user_header.php
│   ├── user_logout.php
│   └── wishlist_cart.php
├── css/                    # Stylesheets
│   ├── admin_style.css
│   └── style.css
├── images/                 # Static images
├── js/                     # JavaScript files
│   ├── admin_script.js
│   └── script.js
├── project images/         # Sample product images
├── uploaded_img/           # User uploaded images
├── about.php
├── cart.php
├── category.php
├── checkout.php
├── contact.php
├── home.php
├── orders.php
├── quick_view.php
├── search_page.php
├── shop.php
├── shop_db.sql            # Database structure
├── update_user.php
├── user_login.php
├── user_register.php
└── wishlist.php
```

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/one-stop-shopie.git
   ```

2. **Set up XAMPP/WAMP**
   - Install XAMPP or WAMP server
   - Start Apache and MySQL services

3. **Database Setup**
   - Create a new database named `shop_db`
   - Import the `shop_db.sql` file into your database
   - Update database connection details in `components/connect.php`

4. **Configure Database Connection**
   ```php
   // components/connect.php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "shop_db";
   ```

5. **Access the Application**
   - User Panel: `http://localhost/ecommerce-website/home.php`
   - Admin Panel: `http://localhost/ecommerce-website/admin/admin_login.php`

## 👥 Default Admin Credentials

After importing the database, you can create an admin account through the registration page or use SQL:

```sql
INSERT INTO admins (name, password) VALUES ('admin', SHA1('admin123'));
```

## 🔧 Configuration

### Database Connection
Update the database connection settings in `components/connect.php`:

```php
$servername = "your_server";
$username = "your_username";
$password = "your_password";
$dbname = "shop_db";
```

### File Upload Settings
- Maximum file size: 2MB (can be modified in admin product upload)
- Supported formats: JPG, PNG, JPEG, WEBP
- Upload directory: `uploaded_img/`

## 📱 Responsive Design

The website is fully responsive and works on:
- Desktop computers
- Tablets
- Mobile phones

## 🔒 Security Features

- Password hashing using SHA1
- SQL injection prevention using prepared statements
- Input sanitization and validation
- Session management for user authentication

## 🚦 Getting Started

1. Set up your local development environment (XAMPP/WAMP)
2. Clone this repository to your `htdocs` folder
3. Import the database structure
4. Configure the database connection
5. Start browsing the website!

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/new-feature`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature/new-feature`)
5. Create a Pull Request

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 📞 Support

For support and questions, please contact:
- Email: itspotter1608@gmail.com
- Email: kushallakhani2803@gmail.com

## 🏆 Features to Add

- [ ] Payment gateway integration
- [ ] Email notifications
- [ ] Advanced search filters
- [ ] Product reviews and ratings
- [ ] Coupon/discount system
- [ ] Inventory management
- [ ] Multi-language support

---

**One Stop Shopie** - Your complete e-commerce solution! 🛍️
