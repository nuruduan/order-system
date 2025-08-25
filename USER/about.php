
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
    <title>About</title>

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
	
        <div class="offcanvas__logo">
            <a href="<?= $base_path ?>/index.php"><img src="img/sukahaticafe.png" alt=""></a>
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
                                <a href="<?= $base_path ?>/index.php"><img src="img/sukahaticafe.png" alt=""></a>
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
							<li class="active"><a href="<?= $base_path ?>/about.php">About</a></li>
							<li><a href="/dessert-order/menu.php">Menu</a></li> <!-- Shared -->
							<li><a href="/dessert-order/orders.php">Orders</a></li> <!-- Shared -->
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
                        <h2>About</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="<?= $base_path ?>/index.php">Home</a>
                        <span>About</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
				<!--
                    <div class="about__video set-bg" data-setbg="img/about-video.jpg">
                        <a href="https://www.youtube.com/watch?v=8PJ3_p7VqHw&list=RD8PJ3_p7VqHw&start_radio=1"
                        class="play-btn video-popup"><i class="fa fa-play"></i></a>
                    </div>
					-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="about__text">
                        <div class="section-title">
                            <span>About Cake shop</span>
                            <h2>Cakes and bakes from the house of Sungai Petani!</h2>
                        </div>
                        <p>Sukahati Dessert Cafe is a cozy, heartwarming spot where sweet cravings meet comfort.
						Inspired by the phrase “suka hati” (“as you wish”), we serve handcrafted desserts and drinks made with love.
						From nostalgic flavors to modern twists, every treat is designed to delight—because happiness is always on the menu.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="about__bar">
                        <div class="about__bar__item">
                            <p>Cake design</p>
                            <div id="bar1" class="barfiller">
                                <div class="tipWrap"><span class="tip"></span></div>
                                <span class="fill" data-percentage="95"></span>
                            </div>
                        </div>
                        <div class="about__bar__item">
                            <p>Cake Class</p>
                            <div id="bar2" class="barfiller">
                                <div class="tipWrap"><span class="tip"></span></div>
                                <span class="fill" data-percentage="80"></span>
                            </div>
                        </div>
                        <div class="about__bar__item">
                            <p>Cake Recipes</p>
                            <div id="bar3" class="barfiller">
                                <div class="tipWrap"><span class="tip"></span></div>
                                <span class="fill" data-percentage="90"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->


    <!-- Testimonial Section Begin -->
	<!--
    <section class="testimonial spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <span>Testimonial</span>
                        <h2>Our client say</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="testimonial__slider owl-carousel">
                    <div class="col-lg-6">
                        <div class="testimonial__item">
                            <div class="testimonial__author">
                                <div class="testimonial__author__pic">
                                    <img src="img/testimonial/ta-1.jpg" alt="">
                                </div>
                                <div class="testimonial__author__text">
                                    <h5>Kerry D.Silva</h5>
                                    <span>New york</span>
                                </div>
                            </div>
                            <div class="rating">
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star-half_alt"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua viverra lacus vel facilisis.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="testimonial__item">
                            <div class="testimonial__author">
                                <div class="testimonial__author__pic">
                                    <img src="img/testimonial/ta-2.jpg" alt="">
                                </div>
                                <div class="testimonial__author__text">
                                    <h5>Kerry D.Silva</h5>
                                    <span>New york</span>
                                </div>
                            </div>
                            <div class="rating">
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star-half_alt"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua viverra lacus vel facilisis.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="testimonial__item">
                            <div class="testimonial__author">
                                <div class="testimonial__author__pic">
                                    <img src="img/testimonial/ta-1.jpg" alt="">
                                </div>
                                <div class="testimonial__author__text">
                                    <h5>Ophelia Nunez</h5>
                                    <span>London</span>
                                </div>
                            </div>
                            <div class="rating">
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star-half_alt"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua viverra lacus vel facilisis.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="testimonial__item">
                            <div class="testimonial__author">
                                <div class="testimonial__author__pic">
                                    <img src="img/testimonial/ta-2.jpg" alt="">
                                </div>
                                <div class="testimonial__author__text">
                                    <h5>Kerry D.Silva</h5>
                                    <span>New york</span>
                                </div>
                            </div>
                            <div class="rating">
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star-half_alt"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua viverra lacus vel facilisis.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="testimonial__item">
                            <div class="testimonial__author">
                                <div class="testimonial__author__pic">
                                    <img src="img/testimonial/ta-1.jpg" alt="">
                                </div>
                                <div class="testimonial__author__text">
                                    <h5>Ophelia Nunez</h5>
                                    <span>London</span>
                                </div>
                            </div>
                            <div class="rating">
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star-half_alt"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua viverra lacus vel facilisis.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="testimonial__item">
                            <div class="testimonial__author">
                                <div class="testimonial__author__pic">
                                    <img src="img/testimonial/ta-2.jpg" alt="">
                                </div>
                                <div class="testimonial__author__text">
                                    <h5>Kerry D.Silva</h5>
                                    <span>New york</span>
                                </div>
                            </div>
                            <div class="rating">
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star-half_alt"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua viverra lacus vel facilisis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	-->
    <!-- Testimonial Section End -->


    <!-- Team Section Begin -->
	<!--
    <section class="team spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <div class="section-title">
                        <span>Our team</span>
                        <h2>Sweet Baker </h2>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="team__btn">
                        <a href="#" class="primary-btn">Join Us</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="team__item set-bg" data-setbg="img/team/team-1.jpg">
                        <div class="team__item__text">
                            <h6>Randy Butler</h6>
                            <span>Decorater</span>
                            <div class="team__item__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="team__item set-bg" data-setbg="img/team/team-2.jpg">
                        <div class="team__item__text">
                            <h6>Randy Butler</h6>
                            <span>Decorater</span>
                            <div class="team__item__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="team__item set-bg" data-setbg="img/team/team-3.jpg">
                        <div class="team__item__text">
                            <h6>Randy Butler</h6>
                            <span>Decorater</span>
                            <div class="team__item__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="team__item set-bg" data-setbg="img/team/team-4.jpg">
                        <div class="team__item__text">
                            <h6>Randy Butler</h6>
                            <span>Decorater</span>
                            <div class="team__item__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	-->
    <!-- Team Section End -->

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