<?php
include("admin-layouts/header.php");

 $theater_name=$theater_location=$theaterid="";
 $theaterErr= $theaterlocationErr="";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	$theaterid= test_input($_GET['t_id']);


$sql_theater="SELECT * FROM `theater` WHERE theater_id = $theaterid";
$theaters = mysqli_query($conn,$sql_theater);

$theater = mysqli_fetch_assoc($theaters);

$theater_name = $theater['theater_name'];
$theater_location = $theater['location'];

}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//prx($_POST);

	$theaterid = test_input($_POST["theater_id"]);

    if (empty($_POST["theater_name"])) {
        $theaterErr = "theater is required";
    } else {
        $theater_name = test_input($_POST["theater_name"]);
    }

    if (empty($_POST["location"])) {
        $theaterlocationErr = "location is required";
    } else {
        $theater_location = test_input($_POST["location"]);
    }
	if (empty($theaterErr) && empty($theaterlocationErr)) {
		$sql_theater_update = "UPDATE `theater` 
		SET `theater_name` = '$theater_name',
			 `location` = '$theater_location'
		WHERE `theater`.`theater_id` = $theaterid";

		
	if (mysqli_query($conn, $sql_theater_update)) {
		header("Location: theater-admin.php");
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
						<h2>Add Theater</h2>
					</div>
				</div>
				<!-- end main title -->
				<?php
            // pr($_REQUEST);
            ?>
				<!-- form -->
				<div class="col-12">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="sign__form sign__form--add">
						<div class="row">
							<div class="col-12 col-xl-7">
								<div class="row">
									<div class="col-12">
										<div class="sign__group">
										<label for="theater_id" hidden  class="form-label text-light">theater id</label>
											<input type="hidden" class="sign__input"  name="theater_id" value="<?php echo $theaterid ?>">
										</div>
									</div>
									<div class="col-12">
										<div class="sign__group">
										<label for="theater_name" class="form-label text-light">theater <span class="text-danger">*<?php  echo   $theaterErr?></span></label>
											<input type="text" class="sign__input"  name="theater_name" value="<?php echo $theater_name ?>">
										</div>
									</div>

									<div class="col-12">
										<div class="sign__group">
										<label for="theater_name" class="form-label text-light">Location<span class="text-danger">*<?php  echo  $theaterlocationErr?></span></label>
										<textarea id="text" class="sign__textarea" name="location"><?php echo $theater_location ?></textarea>

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