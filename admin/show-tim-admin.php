<?php
include("admin-layouts/header.php");

$sql="SELECT * FROM `show_timing` ";

$show_times=mysqli_query($conn,$sql);
?>
	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Theater</h2>

						<span class="main__title-stat">3,702 Total</span>
						
						<div class="main__title-wrap">
						<a href="add-show-time.php" class="main__title-link">add show-time</a>
						
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
							</div>	<!-- end search -->
						
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
									<th>Time</th>
									<th>Time-Name</th>
								</tr>
							</thead>

							<tbody>
							<?php
								$srno=1;
								while($show_time= mysqli_fetch_assoc($show_times)) 
								{
								?>
								<tr>
									<td>
										<div class="catalog__text"><?php echo $srno?></div>
									</td>
									<td>
										<div class="catalog__text">
										<?php echo $show_time['time']?>
										</div>
									</td>
									<td>
										<div class="catalog__text">
										<?php echo $show_time['time_name']?>
										</div>
									</td>
									<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
												<i class="ti ti-lock"></i>
											</button>
											<a href="edit-show-time.php?sht_id=<?php echo $show_time['show_time_id']?>" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<a href="delete-show-time.php?sht_id=<?php echo $show_time['show_time_id']?>" class="catalog__btn catalog__btn--delete">
												<i class="ti ti-trash"></i>
								            </a>
										</div>
									</td>
								</tr>
								<?php
                        $srno++;}
		?>

							</tbody>
						</table>
					</div>
				</div>
				<!-- end users -->
<!-- delete modal -->
	
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