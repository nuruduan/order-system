<?php
include('registration/session.php');
include('include/dbconn.php');

// Access session values
$order_id = $_GET['order_id'] ?? null;
$level = $_SESSION['level'];
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'] ?? 'User';

// Protect against missing ID
if (!$order_id) {
    echo "Invalid Order ID.";
    exit();
}

$sql = "SELECT * FROM orders WHERE order_id = '$order_id'";

$result = mysqli_query($dbconn, $sql);
$order = mysqli_fetch_assoc($result);

if (!$order) {
    echo "Order not found or access denied.";
    exit();
}

$order_items_sql = "
    SELECT od.*, p.name, p.image_url
    FROM order_details od
    JOIN products p ON od.product_id = p.product_id
    WHERE od.order_id = '$order_id'
";
$order_items_result = mysqli_query($dbconn, $order_items_sql);

function getStatusClass($status) {
    $status = strtolower($status);
    return match($status) {
        'pending' => 'status-badge status-pending',
        'processing' => 'status-badge status-processing',
        'completed' => 'status-badge status-completed',
        'cancelled' => 'status-badge status-cancelled',
        default => 'status-badge',
    };
}

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cake Template">
    <meta name="keywords" content="Cake, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order History</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #ffe0b3; }
        .status { background-color: #a4d9a4; padding: 5px; border-radius: 4px; }
        .btn-view, .btn-edit { padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; }
        .btn-view { background-color: #f7c873; }
        .btn-edit { background-color: #69a6f9; color: white; }

    </style>
	<!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>

    <!-- Offcanvas Menu Begin (atas kiri home) -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
	
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="img/sukahaticafe.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__option">
            <ul>
                
                <li>
                    <a href="#">Logout <span class="arrow_carrot-down"></span></a>
					<ul class="dropdown">
					  <li><a href="/dessert-order/registration/logout.php">Logout</a></li>
					</ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header__top__inner">
                            <div class="header__top__left">
                                <ul>
                                    <!--SIGNINGGGG-->
                                    <li>
										<a href="#">Hi, <?= htmlspecialchars($username) ?> <span class="arrow_carrot-down"></span></a>
										<ul class="dropdown">
											<li><a href="/dessert-order/registration/logout.php">Logout</a></li>
										</ul>
									</li>
                                    <!--SIGNING END-->
                                </ul>
                            </div>
                            <div class="header__logo">
                                <a href="./index.html"><img src="img/sukahaticafe.png" alt=""></a>
                            </div>
							
                        </div>
                    </div>
                </div>
                <div class="canvas__open"><i class="fa fa-bars"></i></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="header__menu mobile-menu">
                        <ul>
							<li><a href="/dessert-order/registration/update_profile.php">Profile</a></li>
							<li><a href="<?= $base_path ?>/index.php">Home</a></li>
							<li><a href="<?= $base_path ?>/about.php">About</a></li>
							<li><a href="/dessert-order/menu.php">Menu</a></li> <!-- Shared -->
							<li class="active"><a href="/dessert-order/orders.php">Orders</a></li> <!-- Shared -->
							
							<?php if ($level == 1): ?>
								<li><a href="/dessert-order/ADMIN/users_list.php">Users</a></li>
								<li><a href="/dessert-order/ADMIN/staffs_list.php">Staff</a></li>
								<li><a href="/dessert-order/ADMIN/report.php">Report</a></li>
							<?php endif; ?>
							
						</ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

	
	<!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Orders History</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="<?= $base_path ?>/index.php">Home</a>
                        <a href="/dessert-order/orders.php">Orders</a>
						<span>Order details</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->




<div style="max-width: 1000px; margin: 30px auto;">

    <table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Order ID</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Total (RM)</th>
    </tr>
    <tr>
        <td><?= $order['order_id'] ?></td>
        <td><?= date("d M Y, h:i A", strtotime($order['order_date'])) ?></td>
        <td><span class="<?= getStatusClass($order['status']) ?>"><?= htmlspecialchars(ucfirst($order['status'])) ?></span></td>
        <td><?= number_format($order['total'], 2) ?></td>
    </tr>
    </table>
	
</div>

<div style="max-width: 1000px; margin: 30px auto 60px auto;">
<div class="breadcrumb__text">
    <h2 style="margin-top: 30px;">Ordered Items</h2>
</div>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Product Image</th>
        <th>Product Name</th>
        <th>Price (RM)</th>
        <th>Quantity</th>
        <th>Subtotal (RM)</th>
    </tr>

    <?php
    $grand_total = 0;
    while ($item = mysqli_fetch_assoc($order_items_result)):
        $subtotal = $item['price'] * $item['quantity'];
        $grand_total += $subtotal;
    ?>
    <tr>
        <td><img src="/dessert-order/img/menu/<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" width="60"></td>
        <td><?= htmlspecialchars($item['name']) ?></td>
        <td><?= number_format($item['price'], 2) ?></td>
        <td><?= $item['quantity'] ?></td>
        <td><?= number_format($subtotal, 2) ?></td>
    </tr>
    <?php endwhile; ?>
    <tr>
        <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
        <td><strong><?= number_format($grand_total, 2) ?></strong></td>
    </tr>
</table>
</div>

<!-- Footer Section Begin -->
    <footer class="footer set-bg" data-setbg="img/footer-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>WORKING HOURS</h6>
                        <ul>
                            <li>Monday - Friday: 08:00 am – 08:30 pm</li>
                            <li>Saturday: 10:00 am – 16:30 pm</li>
                            <li>Sunday: 10:00 am – 16:30 pm</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="img/footer-logo.png" alt=""></a>
                        </div>
                        <p>Lorem ipsum dolor amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore dolore magna aliqua.</p>
                        <div class="footer__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <p class="copyright__text text-white"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                          Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                      </p>
                  </div>
                  <div class="col-lg-5">
                    <div class="copyright__widget">
                        <ul>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Site Map</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.barfiller.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
