<?php
include("admin-layouts/header.php");

// $sql_theater="SELECT * FROM `theater`";
// $theaters=mysqli_query($conn,$sql_theater);

$time=$time_name=$show_time_id="";
$timeErr=$time_nameErr="";


if ($_SERVER['REQUEST_METHOD'] == "GET") {
	$show_time_id= test_input($_GET['sht_id']);


$sql_time="SELECT * FROM `show_timing` WHERE show_time_id = $show_time_id";
$times = mysqli_query($conn,$sql_time);

$timee = mysqli_fetch_assoc($times);

$time = $timee['time'];
$time_name = $timee['time_name'];
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $show_time_id = test_input($_POST["show_time_id"]);

    if (empty($_POST["time"])) {
        $timeErr = "time is required";
    } else {
        $time = test_input($_POST["time"]);
    }

    if (empty($_POST["time_name"])) {
        $time_nameErr = "time-name is required";
    } else {
        $time_name = test_input($_POST["time_name"]);
    }
	if (empty($timeErr) && empty($time_nameErr)) {
	$sql_time_insert="UPDATE `show_timing`
     SET 
     `time` = '$time',
      `time_name` = '$time_name' WHERE `show_timing`.`show_time_id` = $show_time_id";
	if (mysqli_query($conn, $sql_time_insert)) {
		header("Location: show-tim-admin.php");
		exit();
	}
}
}
?>
	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Edit Show Time</h2>
					</div>
				</div>
				<!-- end main title -->
				.
				<!-- form -->
				<div class="col-12">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="sign__form sign__form--add">
						<div class="row">
							<div class="col-12 col-xl-7">
								<div class="row">
                                <div class="col-12">
										<div class="sign__group">
										<label for="show_time_id" hidden  class="form-label text-light">show time Id</label>
											<input type="hidden" class="sign__input"  name="show_time_id" value="<?php echo $show_time_id ?>">
										</div>
									</div>

									<div class="col-12">
										<div class="sign__group">
										<label for="theater_name" class="form-label text-light">Time <span class="text-danger">*<?php  echo   $timeErr?></span></label>
											<input type="text" class="sign__input"  name="time" value="<?php echo $time ?>">
										</div>
									</div>

									<div class="col-12">
										<div class="sign__group">
										<label for="time_name" class="form-label text-light">time-name<span class="text-danger">*<?php  echo  $time_nameErr?></span></label>
										<input type="text" class="sign__input"  name="time_name" value="<?php  echo $time_name?>">
										</div>
									</div>
							</div>

						
										
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