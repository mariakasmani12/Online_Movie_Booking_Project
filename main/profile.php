<?php 
ob_start();
include("header.php");
session_start();
$user_id = $_SESSION['user_id']; 

$sql_join="SELECT * FROM `bookings` AS b
JOIN `shows` AS sh ON b.show_id = sh.show_id
JOIN `show_timing`AS st ON sh.show_time_id=st.show_time_id
JOIN `screen` AS sc ON sh.screen_id=sc.screen_id
JOIN `theater`AS th ON sc.theater_id=th.theater_id
JOIN `movies` AS m ON sh.movie_id=m.movie_id
JOIN `seat_class`AS class ON b.seat_class_id=class.seat_id
JOIN `user`AS u ON b.user_id=u.user_id  WHERE b.user_id='$user_id'";

$bookings=mysqli_query($conn,$sql_join);
?>
	<!-- page title -->
	<section class="section section--first">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h1 class="section__title section__title--head">My HotFlix</h1>
						<!-- end section title -->

						<!-- breadcrumbs -->
						<ul class="breadcrumbs">
							<li class="breadcrumbs__item"><a href="index.html">Home</a></li>
							<li class="breadcrumbs__item breadcrumbs__item--active">Profile</li>
						</ul>
						<!-- end breadcrumbs -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->

	<!-- content -->
	<div class="content">
		<!-- profile -->
		<div class="profile">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="profile__content">
							<div class="profile__user">
								<div class="profile__avatar">
									<img src="img/user.svg" alt="">
								</div>
								<div class="profile__meta">
									<h3><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
								
								</div>
							</div>

							<!-- content tabs nav -->
							<ul class="nav nav-tabs content__tabs content__tabs--profile" id="content__tabs" role="tablist">
								<li class="nav-item" role="presentation">
									<button href="#"id="1-tab" class="active" data-bs-toggle="tab" data-bs-target="#tab-1" type="button" role="tab" aria-controls="tab-1" aria-selected="true">bookings</a>
								</li>

								<li class="nav-item" role="presentation">
									<button   id="4-tab" data-bs-toggle="tab" data-bs-target="#tab-4" type="button" role="tab" aria-controls="tab-4" aria-selected="false"><a class="text-light" href="user-profile.php"> Profile</a></button>
								</li>
							</ul>
							<!-- end content tabs nav -->

							<!-- logout -->
							<a href="../logout.php" class="profile__logout" type="button">
								<i class="ti ti-logout"></i>
								<span>Logout</span>
</a>
							<!-- end logout -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end profile -->

					<div class="row">
						<!-- dashbox -->
						 <center>
						<div class="col-10 ">
							<div class="dashbox">
								<div class="dashbox__title">
									<h3><i class="ti ti-movie"></i> your bookings</h3>

									<div class="dashbox__wrap">
										<a class="dashbox__refresh" href="#"><i class="ti ti-refresh"></i></a>
										
									</div>
								</div>

								<div class="dashbox__table-wrap dashbox__table-wrap--1">
									<table class="dashbox__table">
										<thead>
											<tr>
											<th>#</th>
									     <th>BookingID</th>
									      <th>Theater</th>
									    <th>Movie</th>
									     <th>Screen</th>
									    <th>Seat_class</th>
									       <th>Date</th>
									      <th>Timing</th>
										  <th>total_seats</th>
										  <th>total_amount</th>
									    <th>cancel</th>
											</tr>
										</thead>

										<tbody>
										<?php
								$srno=1;
								while($booking = mysqli_fetch_assoc($bookings)) 
								{
								?>
											<tr>
												<td>
													<div class="dashbox__table-text dashbox__table-text--grey"><?php echo $srno?></div>
												</td>
												<td>
													<div class="dashbox__table-text"><?php echo $booking['b_id']?></div>
												</td>
												<td>
													<div class="dashbox__table-text"><?php echo $booking['theater_name']?></div>
												</td>
												<td>
													<div class="dashbox__table-text"><?php echo $booking['title']?></div>
												</td>
												<td>
													<div class="dashbox__table-text"><?php echo $booking['screen_name']?></div>
												</td>
												<td>
													<div class="dashbox__table-text"><?php echo $booking['class_type']?></div>
												</td>
												<td>
													<div class="dashbox__table-text"><?php echo $booking['show_date']?></div>
												</td>
												<td>
													<div class="dashbox__table-text"><?php echo $booking['time']?>-<?php echo $booking['time_name'] ?></div>
												</td>
												<td>
													<div class="dashbox__table-text"><?php echo $booking['total_seats']?></div>
												</td>
												<td>
													<div class="dashbox__table-text"><?php echo $booking['total_amount']?> RS</div>
												</td>
												<td>
										<div class="catalog__btns">
											

											<a href="delete-booking.php?bookid=<?php echo $booking['b_id']?>" type="button"class="catalog__btn catalog__btn--delete" >
												<span class="bg-danger text-light p-1">Cancel</span>
								            </a>
										</div>
									</td>
											</tr>
											<?php $srno++; }?>
										</tbody>
									</table>
								</div>
								</center>
								
							</div>
						</div>
						<!-- end dashbox -->

						<!-- dashbox -->
						
					</div>
				</div>
<?php
include("footer.php");
?>


</body>

<!-- Mirrored from hotflix.volkovdesign.com/main/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Aug 2024 08:40:02 GMT -->
</html>