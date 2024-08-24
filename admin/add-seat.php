<?php

include("admin-layouts/header.php");

$sql_screen="SELECT * FROM `screen`";
$screens=mysqli_query($conn,$sql_screen);

$sql_theater="SELECT * FROM `screen` AS s
JOIN theater AS t ON s.theater_id=t.theater_id";
$theaters=mysqli_query($conn,$sql_theater);

$theater=$screen=$seat_class=$price="";
$theaterErr=$screenErr=$seat_classErr=$priceErr="";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST["theater_name"])) {
        $theaterErr = "theater is required";
    } else {
        $theater = test_input($_POST["theater_name"]);
    }

    if (empty($_POST["screen_name"])) {
        $screenErr ="screen is required";
    } else {
        $screen = test_input($_POST["screen_name"]);
    }
	if (empty($_POST["class_type"])) {
        $seat_classErr ="seat class is required";
    } else {
        $seat_class = test_input($_POST["class_type"]);
    }
	if (empty($_POST["price"])) {
        $seat_classErr ="price is required";
    } else {
        $seat_class = test_input($_POST["price"]);
    }
	if (empty($theaterErr) && empty($theaterlocationErr)) {
	$sql_theater_insert="INSERT INTO `seat_class` (`seat_id`, `screen_id`, `class_type`, `price`) VALUES (NULL, '2', 'gold', '13.0');";
	if (mysqli_query($conn, $sql_theater_insert)) {
		header("Location: seat-admin.php");
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
						<h2>Add seat</h2>
					</div>
				</div>
				<!-- end main title -->

				<!-- form -->
				<div class="col-12">
					<form action="#" class="sign__form sign__form--add">
						<div class="row">
							<div class="col-12 col-xl-7">
								<div class="row">
									

									<div class="col-12">
										<div class="sign__group">
											<select class="sign__selectjs" id="sign__genre"  name ="theater_name" >
												<option value="">select theater</option>
												<?php while ($theat = mysqli_fetch_assoc($theaters)) { ?>
                                                <option value="<?php echo $theat['theater_id']; ?>"><?php echo $theat['theater_name']; ?></option>
                                            <?php } ?>
											</select>
										</div>
									</div>

									<div class="col-12 col-md-6 col-xl-4">
								<div class="sign__group">
									<select class="sign__selectjs" id="sign__director" multiple>
										<option value="Matt Jones">Matt Jones</option>
										
										<option value="Sophie Moore">Sophie Moore</option>
									</select>
								</div>
							</div>
									<div class="col-12 col-md-6">
										<div class="sign__group">
											<input type="text" class="sign__input" placeholder="Running time">
										</div>
									</div>

									<div class="col-12 col-md-6">
										<div class="sign__group">
											<input type="text" class="sign__input" placeholder="Premiere date">
										</div>
									</div>

								</div>
							</div>

							
								

							<div class="col-12">
								<button type="button" class="sign__btn sign__btn--small"><span>Publish</span></button>
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