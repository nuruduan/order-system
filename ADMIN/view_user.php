<?php
include('../registration/session.php');
include('../include/dbconn.php');

if ($_SESSION['level'] != 1) {
    header('Location: ../index.php');
    exit();
}

$level = $_SESSION['level'];
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$base_path = $_SESSION['base_path'];

$user_id = $_GET['id'] ?? null;

if (!$user_id) {
    echo "Invalid user ID.";
    exit();
}

$user_query = mysqli_query($dbconn, "SELECT user_id, username, level_id FROM user WHERE user_id = '$user_id'");
$user = mysqli_fetch_assoc($user_query);

if (!$user) {
    echo "User not found.";
    exit();
}

$name = $user['username'];
$level_target = $user['level_id'];

$order_query = "
SELECT o.*, 
       cu.username AS customer_name,
       su.username AS staff_name
FROM orders o
LEFT JOIN user cu ON o.user_id = cu.user_id
LEFT JOIN staff_profile sp ON o.staff_id = sp.staff_id
LEFT JOIN user su ON sp.user_id = su.user_id
WHERE ";

if ($level_target == 2) {
    $order_query .= "o.user_id = '$user_id'";
    $title = "Orders Placed by $name";
} elseif ($level_target == 3) {
    $order_query .= "sp.user_id = '$user_id'";
    $title = "Orders Handled by $name";
} else {
    $order_query = "";
    $title = "Unknown User Type";
}
$order_query .= " ORDER BY o.order_date DESC";

$orders = mysqli_query($dbconn, $order_query);
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Order View">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #ffe0b3; }
    </style>
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
							<li><a href="/dessert-order/orders.php">Orders</a></li> <!-- Shared -->
							
							<?php if ($_SESSION['level'] == 1): ?>
								<li class="active"><a href="/dessert-order/ADMIN/users_list.php">Users</a></li>
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

<!-- Breadcrumb -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="breadcrumb__text">
                    <h2><?= htmlspecialchars($title) ?></h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="breadcrumb__links">
                    <a href="<?= $_SESSION['base_path'] ?>/index.php">Home</a>
                    <span>View Orders</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Orders Table -->
<div style="max-width: 1000px; margin: 30px auto;">
    <?php if (mysqli_num_rows($orders) > 0): ?>
        <table>
            <tr>
                <th>ORDER ID</th>
                <th>ORDER DATE</th>
                <th>STATUS</th>
                <th>TOTAL (RM)</th>
				<th>ACTION</th>
				<th>PLACED BY</th>
				<th>HANDLED BY</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($orders)): ?>
                <tr>
					<td><?= $row['order_id'] ?></td>
					<td><?= date("d M Y, h:i A", strtotime($row['order_date'])) ?></td>
					<td><?= htmlspecialchars($row['status']) ?></td>
					<td><?= number_format($row['total'], 2) ?></td>
					<td>
						<a href="<?= $_SESSION['base_path'] ?>/../view_order.php?order_id=<?= $row['order_id'] ?>" class="btn btn-sm btn-warning">View Details</a>
					</td>
					<td><?= htmlspecialchars($row['customer_name'] ?? '-') ?></td>
					<td><?= htmlspecialchars($row['staff_name'] ?? '-') ?></td>
				</tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align:center;">No orders found for this user.</p>
    <?php endif; ?>
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
