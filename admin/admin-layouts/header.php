<?php
ob_start();
require("./../connection/connection.php");
include("./../labraries/function.php");

// Check if the user is logged in and has the admin role

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/slimselect.css">
	<link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<!-- Icon font -->
	<link rel="stylesheet" href="webfont/tabler-icons.min.css">
	<!-- Favicons -->
	<link rel="icon" type="image/png" href="icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="icon/favicon-32x32.png">
	<meta name="description" content="Online Movies, TV Shows & Cinema HTML Template">
	<meta name="keywords" content="">
	<meta name="author" content="Dmitry Volkov">
	<title>Filmix</title>
</head>
<?php
session_start();
if(!($_SESSION['login'] && $_SESSION['role_id'] == 1)) {
	header("Location:./../login.php");
	exit();
  }

?>
<body>
	<!-- header -->
	<header class="header">
		<div class="header__content">
			<!-- header logo -->
			<a href="index.html" class="header__logo">
				<img src="img/logo.svg" alt="">
			</a>
			<!-- end header logo -->

			<!-- header menu btn -->
			<button class="header__btn" type="button">
				<span></span>
				<span></span>
				<span></span>
			</button>
			<!-- end header menu btn -->
		</div>
	</header>
	<!-- end header -->

	<!-- sidebar -->
	<div class="sidebar">
		<!-- sidebar logo -->
		<a href="index.html" class="sidebar__logo">
		<h1 class="text-bold" style="font-size:bold;"> <span class="text-warning">FILM</span><span class="text-light">IX</span></h1>
		</a>
		<!-- end sidebar logo -->
		
		<!-- sidebar user -->
		<div class="sidebar__user">
			<div class="sidebar__user-img">
				<img src="img/user.svg" alt="">
			</div>
			
			<div class="sidebar__user-title">
				<span>Admin</span>
				<p> <?php echo $_SESSION['username'] ?></p>
			</div>

			<!-- <a href="" class="sidebar__user-btn" type="button">
				<i class="ti ti-logout"></i> -->
			<a href="./../logout.php" class="sidebar__user-btn" ><i class="ti ti-logout"></i></a>
		</div>
		<!-- end sidebar user -->

		<!-- sidebar nav -->
		<div class="sidebar__nav-wrap">
			<ul class="sidebar__nav">
				<li class="sidebar__nav-item">
					<a href="index.php" class="sidebar__nav-link sidebar__nav-link"><i class="ti ti-layout-grid"></i> <span>Dashboard</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a href="user-admin.php" class="sidebar__nav-link"><i class="ti ti-users"></i> <span>Users</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a href="theater-admin.php" class="sidebar__nav-link"><i class="bi bi-film"></i> <span>Theater</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a href="movie-admin.php" class="sidebar__nav-link"><i class="bi bi-camera-reels-fill"></i> <span>Movies</span></a>
				</li>
                
				<li class="sidebar__nav-item">
					<a href="list-screen.php" class="sidebar__nav-link"><i class="bi bi-fullscreen"></i><span>Screens</span></a>
				</li>

                <li class="sidebar__nav-item">
					<a href="seat-admin.php" class="sidebar__nav-link"><i class="bi bi-border-width"></i> <span>Seats</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a href="reviews-admin.php" class="sidebar__nav-link"><i class="ti ti-star-half-filled"></i> <span>Reviews</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a href="show-admin.php" class="sidebar__nav-link"><i class="bi bi-shop-window"></i><span>Shows</span></a>
				</li>
				<li class="sidebar__nav-item">
					<a href="show-tim-admin.php" class="sidebar__nav-link"><i class="bi bi-clock"></i><span>Show Time</span></a>
				</li>
				<li class="sidebar__nav-item">
					<a href="booking-admin.php" class="sidebar__nav-link"><i class="bi bi-book"></i><span>Booking</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a href="../main/index2.php" class="sidebar__nav-link"><i class="ti ti-arrow-left"></i> <span>Back to FILMIX</span></a>
				</li>
			</ul>
		</div>
		<!-- end sidebar nav -->
		
		<!-- sidebar copyright -->
		<div class="sidebar__copyright">© HOTFLIX, 2019—2024. <br>Create by <a href="https://themeforest.net/user/dmitryvolkov/portfolio" target="_blank">Dmitry Volkov</a></div>
		<!-- end sidebar copyright -->
	</div>
	<!-- end sidebar -->
</body>
</html>
