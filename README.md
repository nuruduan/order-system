🍰 Dessert Ordering System
A web-based dessert ordering application built with PHP, MySQL, HTML, CSS, and JavaScript. The system is designed for Sukahati Cafe to manage dessert orders efficiently and supports three user roles: Customer, Staff, and Administrator.

📖 Features

👤 Customers
• Register and log in.
• Browse menu items with images.
• Add desserts to cart and place orders.
• View and track order history (Pending, Completed, Cancelled).

👨‍🍳 Staff
• Access assigned orders.
• Update order status (Pending → Completed / Cancelled).
• View history of handled orders.

🛠️ Administrators
• Manage users (Admin, Staff, Customer).
• Manage menu items (add, edit, delete).
• Monitor orders (Pending, Completed, Cancelled).
• Generate sales reports (daily, weekly, monthly, yearly).

🛠️ Technologies Used
• Frontend: HTML, CSS, JavaScript
• Backend: PHP
• Database: MySQL
• Local Server: XAMPP


▶️ How to Run the Project
1. Clone this repository into your htdocs folder in XAMPP:
git clone https://github.com/your-username/dessert-order.git

2. Import the database:
   
2.1) Open phpMyAdmin (http://localhost/phpmyadmin).

2.2) Create a new database (e.g., dessert_order).

2.3) Import the SQL file (found in include folder).

3. Run the project:
   
3.1) Start Apache and MySQL from XAMPP Control Panel.
   
3.2) Open your browser and visit:
http://localhost/dessert-order/

📂 Project Structure

dessert-order/

│── ADMIN/           # Admin dashboard & features

│── STAFF/           # Staff dashboard & features

│── USER/            # Customer dashboard & features

│── registration/    # Registration system

│── css/             # Stylesheets

│── js/              # JavaScript files

│── img/             # Images

│── fonts/           # Fonts used

│── include/         # Helper and config files

│── Source/          # Source files

│── sass/            # Sass styles

│── index.html        # Homepage

│── about.html        # About page

│── menu.php         # Menu listing

│── orders.php       # Order history

│── place_order.php  # Place an order

│── view_order.php  # View order

│── add_to_cart.php  # Add items to cart

│── remove_from_cart.php # Remove items from cart

│── update_status.php  # Update order status

│── checkout.php     # Checkout page

└── README.md        # Documentation

📬 Authors
• Nurul Alya binti Ruduan (Me, main programmer)
• Sakinah Binti Ahmad Hizlan
• Aida Afiqah Binti Amran
• Eliya Maisarah Binti Elias
