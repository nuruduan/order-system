<?php
include('registration/session.php');
include('include/dbconn.php');

$base_path = $_SESSION['base_path'];

// Get user_id
$username = $_SESSION['username'];
$user_result = mysqli_query($dbconn, "SELECT user_id, level_id FROM user WHERE username = '$username'");
$user = mysqli_fetch_assoc($user_result);
$user_id = $user['user_id'];
$level = $user['level_id'];

$_SESSION['user_id'] = $user_id; 
$_SESSION['level'] = $level; 

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get products
$product_query = mysqli_query($dbconn, "SELECT * FROM products");

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cake Template">
    <meta name="keywords" content="Cake, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>

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

    <!-- Page Preloder --><!--
    <div id="preloder">
        <div class="loader"></div>
    </div>
	-->

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="img/logo.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__option">
			<ul>
				<li><a href="<?= $base_path ?>/index.html">Home</a></li>
				<li><a href="<?= $base_path ?>/about.html">About</a></li>
				<li><a href="/dessert-order/menu.php">Menu</a></li>
				<li><a href="<?= $base_path ?>/orders.php">Orders</a></li>
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
                                    
                                    <li>
                                        <a href="#">Hi, <?= htmlspecialchars($username) ?> <span class="arrow_carrot-down"></span></a>
                                        <ul class="dropdown">
										  <li><a href="/dessert-order/registration/logout.php">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="header__logo">
                                <a href="./index.html"><img src="img/logo.png" alt=""></a>
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
							<li class="active"><a href="/dessert-order/menu.php">Menu</a></li> <!-- Shared -->
							<li><a href="/dessert-order/orders.php">Orders</a></li> <!-- Shared -->
							
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
                        <h2>Menu</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="<?= $base_path ?>/index.php">Home</a>
                        <span>Menu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
	<section class="shop spad">
		<div class="container">
		<div class="row">
		<?php if ($level == 1): ?>
			<div class="mb-4">
				<a href="./ADMIN/add_product.php" class="btn btn-primary">➕ Add New Menu Item</a>
			</div>
		<?php endif; ?>
			<!-- Product Listing -->
			<div class="col-lg-9">
				<div class="row">
				
					<?php while ($row = mysqli_fetch_assoc($product_query)) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic">
										<img src="/dessert-order/img/menu/<?= htmlspecialchars($row['image_url']) ?>" 
											 alt="<?= htmlspecialchars($row['name']) ?>" 
											 style="height: 200px; width: 100%; object-fit: cover;" 
											 class="img-fluid">

										<!--div class="product__label"><span>Cupcake</span></div>-->
									</div>
                                    <div class="product__item__text">
                                        <h6><?= htmlspecialchars($row['name']); ?></h6>
                                        <div class="product__item__price">RM <?= number_format($row['price'], 2); ?></div>
                                        <div class="cart_add">
                                            <!-- Add to Cart Form -->
										<?php if ($level == 2): // Only regular users ?>
											<form action="add_to_cart.php" method="POST">
												<input type="hidden" name="product_id" value="<?= htmlspecialchars($row['product_id']); ?>">
												<input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id); ?>">
												<input type="hidden" name="price" value="<?= $row['price']; ?>">
												<div class="p-2 mb-2 border rounded bg-light">
													<label for="quantity_<?= $row['product_id'] ?>">Quantity:</label>
													<input type="number" id="quantity_<?= $row['product_id'] ?>" name="quantity" value="1" min="1" style="width: 50px;">
												</div>
												<input type="submit" value="Add to Cart" class="btn btn-warning">
											</form>
										<?php endif; ?>


										<!-- Admin Only Buttons -->
										<?php if ($level == 1): ?>
											<a href="./ADMIN/edit_product.php?id=<?= htmlspecialchars($row['product_id']); ?>" class="btn btn-sm btn-warning mt-2" style="display: inline-block; padding: 4px 10px;">✏️ Edit</a>
											
											<!-- Delete Form -->
											<form action="./ADMIN/delete_product.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" style="display:inline-block;">
												<input type="hidden" name="product_id" value="<?= htmlspecialchars($row['product_id']); ?>">
												<button type="submit" class="btn btn-sm btn-danger mt-2" style="display: inline-block; padding: 6px 10px;">🗑 Delete</button>
											</form>
										<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
				</div>
			</div>

			<!-- Order Summary Sidebar -->
			<?php if ($level == 2): // Only regular users ?>
				<div class="col-lg-3">
					<div class="order-summary p-3 border rounded shadow-sm bg-light">
						<h4>🛒 Cart Summary</h4>
						
						<?php
						if (!empty($_SESSION['cart'])) {
							$grand_total = 0;
							foreach ($_SESSION['cart'] as $id => $item) {
							$subtotal = $item['price'] * $item['quantity'];
							$grand_total += $subtotal;
							echo "<div class='mb-2'>
									<strong>{$item['name']}</strong> × {$item['quantity']}<br>
									RM " . number_format($subtotal, 2) . "
									<form action='remove_from_cart.php' method='POST' style='display:inline; margin-left:10px;'>
										<input type='hidden' name='product_id' value='$id'>
										<button type='submit' class='btn btn-sm btn-danger'>🗑</button>
									</form>
								  </div>";
						}

							echo "<hr><strong>Total: RM " . number_format($grand_total, 2) . "</strong>";
							echo "<form action='checkout.php' method='POST'>
									<button class='btn btn-success mt-2'>Place Order</button>
								  </form>";
						} else {
							echo "<p>Your cart is empty.</p>";
						}
						?>

					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	</section>
	<!-- Shop Section End -->

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