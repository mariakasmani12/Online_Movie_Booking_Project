<?php
include("admin-layouts/header.php");

// Fetch screens and theaters
$sql_screen = "SELECT * FROM `screen`";
$screens = mysqli_query($conn, $sql_screen);

$sql_theater = "SELECT * FROM `theater`";
$theaters = mysqli_query($conn, $sql_theater);

$theater = $screen = $seat_class = $price =$seatid= "";
$theaterErr = $screenErr = $seat_classErr = $priceErr = "";


// if ($_SERVER['REQUEST_METHOD'] == "GET") {
// 	$reviewid= test_input($_GET['st_id']);


// $sql_seat="SELECT * FROM `seat_class`
//  WHERE 'seat_id' = $seatid";
// $seats = mysqli_query($conn,$sql_seat);

// $seat = mysqli_fetch_assoc($seats);

// $theater=$seat['theater_name'];
// $screen=$seat['screen_name'];
// $seat_class=$seat['class_type'];
// $price=$price['price'];
// }
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // Get the seat ID from the query string
    $seatid = test_input($_GET['st_id']);

    // Fetch seat details
    $sql_seat = "SELECT * FROM `seat_class` AS sc 
    JOIN screen AS s ON sc.screen_id=s.screen_id
     WHERE `seat_id` = $seatid";
    $seats = mysqli_query($conn, $sql_seat);

    if ($seats) {
        $seat = mysqli_fetch_assoc($seats);
        $theater = $seat['theater_id'];
        $screen = $seat['screen_id'];
        $seat_class = $seat['class_type'];
        $price = $seat['price'];
    } else {
        echo "Error fetching seat details: " . mysqli_error($conn);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $seatid = test_input($_POST["seat_id"]);

    if (empty($_POST["theater_name"])) {
        $theaterErr = "Theater is required";
    } else {
        $theater = test_input($_POST["theater_name"]);
    }

    if (empty($_POST["screen_name"])) {
        $screenErr = "Screen is required";
    } else {
        $screen = test_input($_POST["screen_name"]);
    }

    if (empty($_POST["class_type"])) {
        $seat_classErr = "Seat class is required";
    } else {
        $seat_class = test_input($_POST["class_type"]);
    }

    if (empty($_POST["price"])) {
        $priceErr = "Price is required";
    } else {
        $price = test_input($_POST["price"]);
    }

    if (empty($theaterErr) && empty($screenErr) && empty($seat_classErr) && empty($priceErr)) {
        $sql_seat_update = "UPDATE `seat_class` 
    SET
    `screen_id` = '$screen',
    `class_type` = '$seat_class',
    `price` = '$price'
    WHERE `seat_class`.`seat_id` = $seatid;";;
        if (mysqli_query($conn, $sql_seat_update)) {
            header("Location: seat-admin.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
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
                    <h2>Add reviews</h2>
                </div>
            </div>
            <!-- end main title -->

            <!-- form -->
            <div class="col-12">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="sign__form sign__form--add">
                    <div class="row">
                        <div class="col-12 col-xl-7">
                            <div class="row">
                            <div class="col-12">
										<div class="sign__group">
										<label for="seat_id" hidden  class="form-label text-light">seat id</label>
											<input type="hidden" class="sign__input"  name="seat_id" value="<?php echo $seatid ?>">
										</div>
									</div>
                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="theater_name" class="form-label text-light">theater <span class="text-danger">*<?php echo $theaterErr; ?></span></label>
                                        <select class="sign__selectjs" id="sign__genre" name="theater_name">
                                        <option value="0" <?php if (empty($theater) || $theater == "0") echo "selected"; ?>>Select theater</option>
                                    <?php while ($thet = mysqli_fetch_assoc($theaters)) { ?>
                                        <option value="<?php echo $thet['theater_id'] ?>" <?php if (isset($theater) && $theater == $thet['theater_id']) echo "selected"; ?>><?php echo $thet['theater_name'] ?></option>
                                    <?php } ?>
                            
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="screen_name" class="form-label text-light">screen <span class="text-danger">*<?php    echo $screenErr; ?></span></label>
                                        <select class="sign__selectjs" id="sign__director" name="screen_name">
                                            <option value="0" <?php if (empty($screen) || $screen == "0") echo "selected"; ?>>Select screen</option>
                                    <?php while ($scr = mysqli_fetch_assoc($screens)) { ?>
                                        <option value="<?php echo $scr['screen_id'] ?>" <?php if (isset($screen) && $screen == $scr['screen_id']) echo "selected"; ?>><?php echo $scr['screen_name'] ?></option>
                                    <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="class_type" class="form-label text-light">class_type <span class="text-danger">*<?php echo $seat_classErr; ?></span></label>
                                        <input type="text" class="sign__input" name="class_type" value="<?php  echo $seat_class?>">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="price" class="form-label text-light">price <span class="text-danger">*<?php echo $priceErr; ?></span></label>
                                        <input type="text" class="sign__input" name="price" value="<?php  echo $price?>">
                                    </div>
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
</html>
