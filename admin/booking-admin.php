<?php
include("admin-layouts/header.php");

$sql_join="SELECT * FROM `bookings` AS b
JOIN `shows` AS sh ON b.show_id = sh.show_id
JOIN `show_timing`AS st ON sh.show_time_id=st.show_time_id
JOIN `screen` AS sc ON sh.screen_id=sc.screen_id
JOIN `theater`AS th ON sh.theater_id=th.theater_id
JOIN `movies` AS m ON sh.movie_id=m.movie_id
JOIN `seat_class`AS class ON b.seat_class_id=class.seat_id
JOIN `user`AS u ON b.user_id=u.user_id";

$bookings=mysqli_query($conn,$sql_join);
?>
	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Bookings</h2>

						<span class="main__title-stat">3,702 Total</span>

						<div class="main__title-wrap">
						<a href="add-book.php" class="main__title-link">add bookings</a>

							<select class="filter__select" name="sort" id="filter__sort">
								<option value="0">Date created</option>
								<option value="1">Pricing plan</option>
								<option value="2">Status</option>
							</select>

							<!-- search -->
							<form action="#" class="main__title-form">
								<input type="text" placeholder="Find user..">
								<button type="button">
									<i class="ti ti-search"></i>
								</button>
							</form>
							<!-- end search -->
						</div>
					</div>
				</div>
				<!-- end main title -->

				<!-- users -->
				<div class="col-12">
					<div class="catalog catalog--1">
						<table class="catalog__table">
							<thead>
								<tr>
								    <th>#</th>
									<th>BookingID</th>
									<th>Name</th>
									<th>Theater</th>
									<th>Movie</th>
									<th>Screen</th>
									<th>Seat_class</th>
									<th>Date</th>
									<th>Timing</th>
									<th>status</th>
									<th>ACTIONS</th>
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
										<div class="catalog__text"><?php echo $srno?></div>
									</td>
									<td>
										<div class="catalog__text">
										<?php echo $booking['b_id']?>
										</div>
									</td>
									<td>
										<div class="catalog__text">
											<?php echo $booking['name']?>
										</div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $booking['theater_name']?></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $booking['title']?></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $booking['screen_name']?></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $booking['class_type']?></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $booking['show_date']?></div>
									</td>
									<td>
										<div class="catalog__text"><?php echo $booking['time']?> <br> <?php echo$booking['time_name'];?></div>
									</td>
									<td>
										<div class="catalog__text catalog__text--green">Approved</div>
									</td>
									<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
												<i class="ti ti-lock"></i>
											</button>
											<a href="edit-booking.php?bookid=<?php echo $booking['b_id']?>" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>

											<a href="delete-booking.php?bookid=<?php echo $booking['b_id']?>" type="button"class="catalog__btn catalog__btn--delete" >
												<i class="ti ti-trash"></i>
								            </a>
										</div>
									</td>
								<?php }?>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- end users -->



			</div>
		</div>
	</main>
	<!-- end main content -->

	
	<!-- status modal -->
	<div class="modal fade" id="modal-status" tabindex="-1" aria-labelledby="modal-status" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<form action="#" class="modal__form">
						<h4 class="modal__title">Status change</h4>

						<p class="modal__text">Are you sure about immediately change status?</p>

						<div class="modal__btns">
							<button class="modal__btn modal__btn--apply" type="button"><span>Apply</span></button>
							<button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal" aria-label="Close"><span>Dismiss</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end status modal -->

	

	<!-- JS -->
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/slimselect.min.js"></script>
	<script src="js/smooth-scrollbar.js"></script>
	<script src="js/admin.js"></script>
</body>

<!-- Mirrored from hotflix.volkovdesign.com/admin/users.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Aug 2024 08:51:42 GMT -->
</html>