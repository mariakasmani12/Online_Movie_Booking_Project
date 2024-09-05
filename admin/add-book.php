<?php
include("admin-layouts/header.php");

$sql_show = "SELECT * FROM `shows`";
$shows = mysqli_query($conn, $sql_show);

$sql_movie = "SELECT * FROM `movies`";
$movies = mysqli_query($conn, $sql_movie);

$sql_theater= "SELECT * FROM `theater`";
$theaters = mysqli_query($conn, $sql_theater);

$sql_screen= "SELECT * FROM `screen`";
$screens = mysqli_query($conn, $sql_screen);

$sql_time= "SELECT * FROM `show_timing`";
$times = mysqli_query($conn, $sql_time);

$sql_user= "SELECT * FROM `user`";
$users = mysqli_query($conn, $sql_user);

$sql_class= "SELECT * FROM `seat_class`";
$classes = mysqli_query($conn, $sql_class);

$name = $theater_id = $screen_id = $movie_id = $class_id = $show_time_id = $show_id = $tot_seat = "";
$nameErr = $theater_idErr = $screen_idErr = $movie_idErr = $class_idErr = $show_time_idErr = $show_idErr = $tot_seatErr = "";



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["theater_id"])) {
        $theater_idErr = "Theater is required";
    } else {
        $theater_id = test_input($_POST["theater_id"]);
    }

    if (empty($_POST["screen_id"])) {
        $screen_idErr = "Screen is required";
    } else {
        $screen_id = test_input($_POST["screen_id"]);
    }

    if (empty($_POST["seat_class_id"])) {
        $class_idErr = "Seat class is required";
    } else {
        $class_id = test_input($_POST["seat_class_id"]);
    }

    if (empty($_POST["movie_id"])) {
        $movie_idErr = "Movie is required";
    } else {
        $movie_id = test_input($_POST["movie_id"]);
    }

    if (empty($_POST["show_timing_id"])) {
        $show_time_idErr = "Show time is required";
    } else {
        $show_time_id = test_input($_POST["show_timing_id"]);
    }

    if (empty($_POST["show_id"])) {
        $show_idErr = "Show date is required";
    } else {
        $show_id = test_input($_POST["show_id"]);
    }

    if (empty($_POST["total_seat"])) {
        $tot_seatErr = "Total seat is required";
    } else {
        $tot_seat = test_input($_POST["total_seat"]);
    }

    if (empty($nameErr) && empty($theater_idErr) && empty($screen_idErr) && empty($movie_idErr) && empty($class_idErr) && empty($show_time_idErr) && empty($show_idErr) && empty($tot_seatErr)) {
        $sql_insert_booking = "INSERT INTO `bookings` (`b_id`, `show_id`, `seat_class_id`, `user_id`, `total_seats`, `total_amount`) VALUES (NULL, '$show_id', '$class_id', '$name', '$tot_seat', '39.0')";

        if (mysqli_query($conn, $sql_insert_booking)) {
            header("Location: booking-admin.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
    
?>

	


	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Add  Booking</h2>
					</div>
				</div>
				<!-- end main title -->

				<!-- form -->
				<div class="col-12">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="sign__form sign__form--add">
						<div class="row">
							<div class="col-12 col-xl-7">
								<div class="row">
								<div class="col-12 ">
										<div class="sign__group">
                                        <label  for="show_id" class="text-light"> User <span class="text-danger">*<?php  echo   $nameErr?></span></label>
											<select class="sign__selectjs" id="sign__quality" name="name">
												<option value="">Select User</option>
                                                <?php  while($nam= mysqli_fetch_assoc($users)) {?>
												<option value="<?php  echo $nam["user_id"] ?>"><?php echo $nam["user_id"] ?>--<?php echo $nam["name"] ?></option>
                                                <?php }?>
											</select>
										</div>
                                    </div>

                                    <div class="col-12">
                                        <div class="sign__group">
                                        <label  for="show_id" class="text-light"> movie <span class="text-danger">*<?php  echo   $movie_idErr?></span></label>
                                            <select class="sign__selectjs" id="sign__country" name="movie_id">
                                            <option value="">Select movie</option>
                                                <?php  while($mov= mysqli_fetch_assoc($movies)) {?>
                                                <option value="<?php  echo $mov["movie_id"] ?>"><?php echo $mov["title"] ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
										<div class="sign__group">
                                        <label  for="theater_id" class="text-light"> theater <span class="text-danger">*<?php  echo   $theater_id?></span></label>
											<select class="sign__selectjs" id="sign__genre" name="theater_id">
                                            <option value="">Select theater</option>
                                                <?php  while($theat= mysqli_fetch_assoc($theaters)) {?>
												<option value="<?php  echo $theat["theater_id"] ?>"><?php echo $theat["theater_name"] ?></option>
                                                <?php }?>
											
											</select>
										</div>
									</div>

							<!-- <div class="col-12 col-xl-5">
								<div class="row"> -->
									

						

							<div class="col-12">
								<div class="sign__group">
                                <label  for="show_id" class="text-light"> Screen <span class="text-danger">*<?php  echo   $screen_idErr?></span></label>
									<select class="sign__selectjs" id="sign__director" name="screen_id">
                                    <option value="">Select screen</option>
                                                <?php  while($scr= mysqli_fetch_assoc($screens)) {?>
												<option value="<?php  echo $scr["screen_id"] ?>"><?php echo $scr["screen_name"] ?></option>
                                                <?php }?>
									</select>
								</div>
							</div>

							<div class="col-12 ">
								<div class="sign__group">
                                <label  for="show_id" class="text-light"> Show  Date <span class="text-danger">*<?php  echo   $show_idErr?></span></label>
									<select class="sign__selectjs" id="sign__actors" name="show_id">
									<option value="FullHD">Select date</option>
                                                <?php  while($sho= mysqli_fetch_assoc($shows)) {?>
												<option value="<?php  echo $sho["show_id"] ?>"><?php echo $sho["show_date"] ?></option>
                                                <?php }?>
									</select>
								</div>
							</div>
							              <div class="col-12 ">
												<div class="sign__group">
													<label class="text-light" for="subscription">seat class<span class="text-danger">*<?php  echo   $class_idErr?></span></label>
													<select class="sign__select" id="subscription" name="seat_class_id">
                                                    <option value="FullHD">Select seat class</option>
                                                <?php  while($cl= mysqli_fetch_assoc($classes)) {?>
												<option value="<?php  echo $cl["seat_id"] ?>"><?php echo $cl["class_type"] ?></option>
                                                <?php }?>
													</select>
												</div>
											</div>
                                            <div class="col-12">
										<div class="sign__group">
                                        <label for="name" class=" text-light">total seat <span class="text-danger">*<?php    echo $tot_seatErr; ?></span></label>
											<input type="text" class="sign__input" name="total_seat">
										</div>
									</div>

                                            <div class="col-12">
												<div class="sign__group">
													<label class="text-light" for="rights">time <span class="text-danger">*<?php  echo   $show_idErr?></span></label>
													<select class="sign__select" id="rights" name="show_timing_id">
													<option value="FullHD">Select time</option>
                                                <?php  while($tm= mysqli_fetch_assoc($times)) {?>
												<option value="<?php  echo $tm["show_time_id"] ?>"><?php echo $tm["time"] ?>--<?php echo $tm["time_name"] ?></option>
                                                <?php }?>
													</select>
												</div>
											</div>
							<!-- end tv series -->

							<div class="col-12">
                            <input type="submit" value="Publish" class="sign__btn sign__btn--small">
							</div>
						</div>
					</form>
				</div>
				<!-- end form -->
			</div>
		</div>
	</main>
	<!-- end main content -->

	<!-- JS -->
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/slimselect.min.js"></script>
	<script src="js/smooth-scrollbar.js"></script>
	<script src="js/admin.js"></script>
</body>

<!-- Mirrored from hotflix.volkovdesign.com/admin/add-item.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Aug 2024 08:51:43 GMT -->
</html>