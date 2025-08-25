<?php
include('../registration/session.php');

$username = $_SESSION['username'];
$base_path = $_SESSION['base_path'];

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cake Template">
    <meta name="keywords" content="Cake, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dessert Ordering System</title>

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
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin (atas kiri home) -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
	<!--
        <div class="offcanvas__cart">
            <div class="offcanvas__cart__links">
                <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                <a href="#"><img src="img/icon/heart.png" alt=""></a>
            </div>
        </div>
		-->
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="img/sukahaticafe.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__option">
            <ul>
                <li>
                    <a href="#">Hi, <?= htmlspecialchars($username) ?> <span class="arrow_carrot-down"></span></a>
                    <ul class="dropdown">
					<!--
                      <li><a href="./login.html">Login</a></li>
                      <li><a href="./signup.html">Sign up</a></li>
					  -->
					<li><a href="/dessert-order/registration/logout.php">Logout</a></li>
					<li><a href="/dessert-order/registration/register.php">Register New User</a></li>
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
										<!--
                                          <li><a href="registration/login.html">Login</a></li>
                                          <li><a href="registration/signup.html">Sign up</a></li>
										  -->
										<li><a href="/dessert-order/registration/logout.php">Logout</a></li>
										<li><a href="/dessert-order/registration/register.php">Register New User</a></li>
                                        </ul>
                                    </li>
                                    <!--SIGNING END-->
                                </ul>
                            </div>
                            <div class="header__logo">
                                <a href="./index.html"><img src="img/sukahaticafe.png" alt=""></a>
                            </div>
							<!--
                            <div class="header__top__right">
                                <div class="header__top__right__links">
                                    <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                                    <a href="#"><img src="img/icon/heart.png" alt=""></a>
                                </div>
                            </div>
							-->
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
                            <li class="active"><a href="<?= $base_path ?>/index.php">Home</a></li>
							<li><a href="<?= $base_path ?>/about.php">About</a></li>
							<li><a href="/dessert-order/menu.php">Menu</a></li> <!-- Shared -->
							<li><a href="/dessert-order/orders.php">Orders</a></li> <!-- Shared -->
							
							<?php if ($_SESSION['level'] == 1): ?>
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

    
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__item set-bg" data-setbg="img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="hero__text">
                                <h2>Suka Coklat, suka hati.</h2>
                                <!--<a href="#" class="primary-btn">Our cakes</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__item set-bg" data-setbg="img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="hero__text">
                                <h2>Suka Coklat, suka hati.</h2>
                                <!--<a href="#" class="primary-btn">Our cakes</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Instagram Section Begin -->
    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 p-0">
                    <div class="instagram__text">
                        <div class="section-title">
                            <span>Follow us on instagram</span>
                            <h2>Suka hati, suka dessert.</h2>
                        </div>
                        <h5><i class="fa fa-instagram"></i> @sukahati.cafe</h5>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                            <div class="instagram__pic">
                                <img src="img/instagram/instagram-1.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                            <div class="instagram__pic middle__pic">
                                <img src="img/instagram/instagram-2.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                            <div class="instagram__pic">
                                <img src="img/instagram/instagram-3.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                            <div class="instagram__pic">
                                <img src="img/instagram/instagram-4.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                            <div class="instagram__pic middle__pic">
                                <img src="img/instagram/instagram-5.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                            <div class="instagram__pic">
                                <img src="img/instagram/instagram-3.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <!-- Map Begin -->
    <div class="map">
        <!--
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-7">
                    <div class="map__inner">
                        <h6>COlorado</h6>
                        <ul>
                            <li>1000 Lakepoint Dr, Frisco, CO 80443, USA</li>
                            <li>Sweetcake@support.com</li>
                            <li>+1 800-786-1000</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        -->
        <div class="map__iframe">
            <iframe src="https://maps.google.com/maps?width=600&height=300&hl=en&q=Sukahati%20Cafe%20Sungai%20Petani&t=&z=14&ie=UTF8&iwloc=B&output=embed" height="300" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>
    <!-- Map End -->

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
<!--
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
-->
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