<?php
require("../connection/connection.php");
include("../labraries/function.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from hotflix.volkovdesign.com/main/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Aug 2024 08:39:39 GMT -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/splide.min.css">
	<link rel="stylesheet" href="css/slimselect.css">
	<link rel="stylesheet" href="css/plyr.css">
	<link rel="stylesheet" href="css/photoswipe.css">
	<link rel="stylesheet" href="css/default-skin.css">
	<link rel="stylesheet" href="css/main.css">

	<!-- Icon font -->
	<link rel="stylesheet" href="webfont/tabler-icons.min.css">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="icon/favicon-32x32.png">

	<meta name="description" content="Online Movies, TV Shows & Cinema HTML Template">
	<meta name="keywords" content="">
	<meta name="author" content="Dmitry Volkov">
	<title>HotFlix – Online Movies, TV Shows & Cinema HTML Template</title>
</head>
<style>
.header__nav-link {
    font-size: 18px; /* Increase the font size */
    padding: 10px 20px; /* Increase the padding */
    margin-right: 10px; /* Adjust spacing between links */
}

.header__nav-item:first-child .header__nav-link, 
.header__nav-item:last-child .header__nav-link {
    font-size: 18px; /* Increase font size */
    padding: 10px 20px; /* Increase padding */
    margin-right: 10px; /* Adjust spacing */
}
.dropdown-menu  .dropdown-item:hover{
	color : yellow;
	background:#1b1b1a;
}
	

</style>
<body>
	<!-- header -->
	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="header__content">
						<!-- header logo -->
						<a href="index.html" class="header__logo">
							<img src="img/logo.svg" alt="">
						</a>
						<!-- end header logo -->

						<!-- header nav -->
						<ul class="header__nav">
							<!-- dropdown -->
							<li class="header__nav-item">
								<a class="header__nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Home</a>
							</li>
							<!-- end dropdown -->

							<!-- dropdown -->
							<li class="header__nav-item">
								<a class="header__nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Movies </a>
							</li>
							<!-- end dropdown -->

							

							<!-- dropdown -->
							<li class="header__nav-item">
								<a class="header__nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Contacts Us</a>

							</li>
							<!-- end dropdown -->

							<!-- dropdown -->
							
							<!-- end dropdown -->
						</ul>
						<!-- end header nav -->

						<!-- header auth -->
						<div class="header__auth">
							<form action="#" class="header__search">
								<input class="header__search-input" type="text" placeholder="Search...">
								<button class="header__search-button" type="button">
									<i class="ti ti-search"></i>
								</button>
								<button class="header__search-close" type="button">
									<i class="ti ti-x"></i>
								</button>
							</form>

							<button class="header__search-btn" type="button">
								<i class="ti ti-search"></i>
							</button>

						

							<!-- dropdown -->
							<div class="header__profile">
                             <?php if( isset($_SESSION["login"]) && $_SESSION['role_id']==3) { ?>
                              <a class="header__sign-in header__sign-in--user" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             <i class="ti ti-user"></i>
                            <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                             </a>
                             <ul class="dropdown-menu dropdown-menu-end bg-dark ">
                             <li><a class="dropdown-item text-warning" href="profile.html"><i class="ti ti-ghost"></i>Profile</a></li>
                             <li><a class="dropdown-item text-warning" href="../logout.php"><i class="ti ti-logout"></i>Logout</a></li>
                            </ul>
                            <?php } else { ?>
                           <a class="header__sign-in text-warning" href="../login.php" role="button">Login</a>
                        <?php } ?>
                          </div>

						<!-- end header auth -->

						<!-- header menu btn -->
						<button class="header__btn" type="button">
							<span></span>
							<span></span>
							<span></span>
						</button>
						<!-- end header menu btn -->
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- end header -->