<?php
include('../registration/session.php');
include('../include/dbconn.php');

if ($_SESSION['level'] != 1) {
    header("Location: ../index.php");
    exit();
}

$level = $_SESSION['level'];
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$base_path = $_SESSION['base_path'];
$filter = $_GET['filter'] ?? 'weekly';

$start_date = $_GET['start_date'] ?? date('Y-m-d', strtotime('-7 days'));
$end_date = $_GET['end_date'] ?? date('Y-m-d');

$title = "📅 Order Report from " . date('d M Y', strtotime($start_date)) . " to " . date('d M Y', strtotime($end_date));


$sql = "
    SELECT o.order_id, o.order_date, u.username AS customer_name, o.total, su.fullName AS staff_name
    FROM orders o
    JOIN user u ON o.user_id = u.user_id
    LEFT JOIN staff_profile sp ON o.staff_id = sp.staff_id
    LEFT JOIN user su ON sp.user_id = su.user_id
    WHERE DATE(o.order_date) BETWEEN '$start_date' AND '$end_date'
    ORDER BY o.order_date DESC
";
$result = mysqli_query($dbconn, $sql);

$top_items_result = mysqli_query($dbconn, "
    SELECT p.name, SUM(od.quantity) as total_sold
    FROM orders o
    JOIN order_details od ON o.order_id = od.order_id
    JOIN products p ON od.product_id = p.product_id
    WHERE DATE(o.order_date) BETWEEN '$start_date' AND '$end_date'
    GROUP BY od.product_id
    ORDER BY total_sold DESC
    LIMIT 3
");
?>

<!DOCTYPE html>
<html lang="xxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cake Template">
    <meta name="keywords" content="Cake, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Report</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
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
							<li><a href="/dessert-order/orders.php">Orders</a></li> <!-- Shared -->
							
							<?php if ($level == 1): ?>
								<li><a href="/dessert-order/ADMIN/users_list.php">Users</a></li>
								<li><a href="/dessert-order/ADMIN/staffs_list.php">Staff</a></li>
								<li class="active"><a href="/dessert-order/ADMIN/report.php">Report</a></li>
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
                        <h2>Report</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="<?= $base_path ?>/index.php">Home</a>
                        <span>Report</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
	
	<div class="container">
		<div style="max-width: 1000px; margin: 30px auto;">
		<h2 class="text-center"><?= $title ?></h2>
		<p>Showing orders from <strong><?= date('d M Y', strtotime($start_date)) ?></strong> to <strong><?= date('d M Y', strtotime($end_date)) ?></strong></p>

		<form method="GET" action="report.php" class="d-flex flex-wrap align-items-center gap-2">
			<label for="start_date" class="me-2">Start Date:</label>
			<input type="date" name="start_date" id="start_date" value="<?= htmlspecialchars($start_date) ?>" class="form-control me-3" required>

			<label for="end_date" class="me-2">End Date:</label>
			<input type="date" name="end_date" id="end_date" value="<?= htmlspecialchars($end_date) ?>" class="form-control me-3" required>

			<button type="submit" class="btn btn-primary">🔍 Filter</button>
			<a href="generate_pdf.php?start_date=<?= $start_date ?>&end_date=<?= $end_date ?>" target="_blank" class="btn btn-danger ms-2">🖨️ Print PDF</a>
		</form>

		</div>
		
		<div style="max-width: 1000px; margin: 30px auto;">
		<h4>🔥 Top 3 Best-Selling Items</h4>
		
		<ol>
		<?php while ($item = mysqli_fetch_assoc($top_items_result)) : ?>
			<li><?= htmlspecialchars($item['name']) ?> - <?= $item['total_sold'] ?> sold</li>
		<?php endwhile; ?>
		</ol>
		
		</div>
		
		<div style="max-width: 1000px; margin: 30px auto;">
		<table>
			<tr>
				<th>Order ID</th>
				<th>Date</th>
				<th>Customer</th>
				<th>Total (RM)</th>
				<th>Handled By</th>
			</tr>
			<?php while ($row = mysqli_fetch_assoc($result)) : ?>
				<tr>
					<td><?= $row['order_id'] ?></td>
					<td><?= date('d M Y, h:i A', strtotime($row['order_date'])) ?></td>
					<td><?= htmlspecialchars($row['customer_name']) ?></td>
					<td><?= number_format($row['total'], 2) ?></td>
					<td><?= $row['staff_name'] ? $row['staff_name'] : '—' ?></td>
				</tr>
			<?php endwhile; ?>
		</table>
		</div>
	</div>
</body>
</html>


    <!-- Footer Section Begin -->
    <footer class="footer set-bg" data-setbg="img/footer-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>WORKING HOURS</h6>
                        <ul>
                            <li>Saturday - Wednesday: 11:00 am – 10:00 pm</li>
                            <li>Thursday: 11:00 am – 12:00 am</li>
                            <li>Firday: 11:00 am – 10:00 am, 11:00 am - 10:00 pm</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="img/footer-logo.png" alt=""></a>
                        </div>
                        <p>Sukahati Dessert Cafe is a cozy, heartwarming spot where sweet cravings meet comfort.
						Inspired by the phrase “suka hati” (“as you wish”), we serve handcrafted desserts and drinks made with love.
						From nostalgic flavors to modern twists, every treat is designed to delight—because happiness is always on the menu.</p>
                        <div class="footer__social">
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
