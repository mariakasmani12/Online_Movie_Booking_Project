<?php
include("admin-layouts/header.php");

// Fetch data for dropdowns
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

// Initialize variables
$name = $theater_id = $screen_id = $movie_id = $class_id = $show_time_id = $show_id = $tot_seat = $bookid = "";
$nameErr = $theater_idErr = $screen_idErr = $movie_idErr = $class_idErr = $show_time_idErr = $show_idErr = $tot_seatErr = "";

// Fetch booking details if GET request
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['bookid'])) {
    $bookid = test_input($_GET['bookid']);

    $sql_user = "SELECT * FROM `bookings` AS b
    JOIN shows AS sh ON b.show_id=sh.show_id
    JOIN movies AS m ON sh.movie_id=sh.movie_id
    JOIN screen AS sc ON sh.screen_id = sc.screen_id
    JOIN theater AS th ON sc.theater_id =th.theater_id
    WHERE b.b_id= $bookid";

    $bookingss = mysqli_query($conn, $sql_user);
    $booking = mysqli_fetch_assoc($bookingss);

    $name = $booking["user_id"];
    $theater_id = $booking["theater_id"];
    $screen_id = $booking["screen_id"];
    $movie_id = $booking["movie_id"];
    $class_id = $booking["seat_class_id"];
    $show_time_id = $booking["show_time_id"];
    $show_id = $booking["show_id"]; // Changed to show_id to match the database field
    $tot_seat = $booking["total_seats"];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $bookid = test_input($_POST["b_id"]);

    // Validate inputs
    if (empty($_POST["user_id"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["user_id"]);
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

    if (empty($_POST["total_seats"])) {
        $tot_seatErr = "Total seats is required";
    } else {
        $tot_seat = test_input($_POST["total_seats"]);
    }

    // If no errors, update booking
    if (empty($nameErr) && empty($theater_idErr) && empty($screen_idErr) && empty($movie_idErr) && empty($class_idErr) && empty($show_time_idErr) && empty($show_idErr) && empty($tot_seatErr)) {
        $sql_insert_booking = "UPDATE `bookings`
        SET `show_id` = '$show_id',
        `seat_class_id` = '$class_id', 
        `user_id` = '$name',
        `total_seats` = '$tot_seat'
        WHERE `bookings`.`b_id` = '$bookid'";

        if (mysqli_query($conn, $sql_insert_booking)) {
            header("Location: booking-admin.php");
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
                    <h2>Update Booking</h2>
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
                                        <label for="b_id" hidden class="form-label text-light">Booking ID</label>
                                        <input type="hidden" class="sign__input" name="b_id" value="<?php echo htmlspecialchars($bookid); ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="user_id" class="text-light">User <span class="text-danger">*<?php echo htmlspecialchars($nameErr); ?></span></label>
                                        <select class="sign__selectjs" id="sign__quality" name="user_id">
                                            <option value="0" <?php if (empty($name) || $name == "0") echo "selected"; ?>>Select User</option>
                                            <?php while ($nam = mysqli_fetch_assoc($users)) { ?>
                                                <option value="<?php echo htmlspecialchars($nam["user_id"]); ?>" <?php if (isset($name) && $name == $nam['user_id']) echo "selected"; ?>>
                                                    <?php echo htmlspecialchars($nam["user_id"]) . " -- " . htmlspecialchars($nam["name"]); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="movie_id" class="text-light">Movie <span class="text-danger">*<?php echo htmlspecialchars($movie_idErr); ?></span></label>
                                        <select class="sign__selectjs" id="sign__country" name="movie_id">
                                            <option value="0" <?php if (empty($movie_id) || $movie_id == "0") echo "selected"; ?>>Select movie</option>
                                            <?php while ($mov = mysqli_fetch_assoc($movies)) { ?>
                                                <option value="<?php echo htmlspecialchars($mov["movie_id"]); ?>" <?php if (isset($movie_id) && $movie_id == $mov['movie_id']) echo "selected"; ?>>
                                                    <?php echo htmlspecialchars($mov["title"]); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="theater_id" class="text-light">Theater <span class="text-danger">*<?php echo htmlspecialchars($theater_idErr); ?></span></label>
                                        <select class="sign__selectjs" id="sign__genre" name="theater_id">
                                            <option value="0" <?php if (empty($theater_id) || $theater_id == "0") echo "selected"; ?>>Select theater</option>
                                            <?php while ($theat = mysqli_fetch_assoc($theaters)) { ?>
                                                <option value="<?php echo htmlspecialchars($theat["theater_id"]); ?>" <?php if (isset($theater_id) && $theater_id == $theat['theater_id']) echo "selected"; ?>>
                                                    <?php echo htmlspecialchars($theat["theater_name"]); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="screen_id" class="text-light">Screen <span class="text-danger">*<?php echo htmlspecialchars($screen_idErr); ?></span></label>
                                        <select class="sign__selectjs" id="sign__director" name="screen_id">
                                            <option value="0" <?php if (empty($screen_id) || $screen_id == "0") echo "selected"; ?>>Select screen</option>
                                            <?php while ($scr = mysqli_fetch_assoc($screens)) { ?>
                                                <option value="<?php echo htmlspecialchars($scr["screen_id"]); ?>" <?php if (isset($screen_id) && $screen_id == $scr['screen_id']) echo "selected"; ?>>
                                                    <?php echo htmlspecialchars($scr["screen_name"]); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="show_id" class="text-light">Show Date <span class="text-danger">*<?php echo htmlspecialchars($show_idErr); ?></span></label>
                                        <select class="sign__selectjs" id="sign__actors" name="show_id">
                                            <option value="0" <?php if (empty($show_id) || $show_id == "0") echo "selected"; ?>>Select date</option>
                                            <?php while ($sho = mysqli_fetch_assoc($shows)) { ?>
                                                <option value="<?php echo htmlspecialchars($sho['show_id']); ?>" <?php if (isset($show_id) && $show_id == $sho['show_id']) echo "selected"; ?>>
                                                    <?php echo htmlspecialchars($sho['show_date']); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="seat_class_id" class="text-light">Seat Class <span class="text-danger">*<?php echo htmlspecialchars($class_idErr); ?></span></label>
                                        <select class="sign__select" id="subscription" name="seat_class_id">
                                            <option value="0" <?php if (empty($class_id) || $class_id == "0") echo "selected"; ?>>Select seat class</option>
                                            <?php while ($cl = mysqli_fetch_assoc($classes)) { ?>
                                                <option value="<?php echo htmlspecialchars($cl["seat_id"]); ?>" <?php if (isset($class_id) && $class_id == $cl['seat_id']) echo "selected"; ?>>
                                                    <?php echo htmlspecialchars($cl["class_type"]); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="total_seats" class="text-light">Total Seats <span class="text-danger">*<?php echo htmlspecialchars($tot_seatErr); ?></span></label>
                                        <input type="text" class="sign__input" name="total_seats" value="<?php echo htmlspecialchars($tot_seat); ?>">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="show_timing_id" class="text-light">Show Time <span class="text-danger">*<?php echo htmlspecialchars($show_time_idErr); ?></span></label>
                                        <select class="sign__select" id="rights" name="show_timing_id">
                                            <option value="0" <?php if (empty($show_time_id) || $show_time_id == "0") echo "selected"; ?>>Select time</option>
                                            <?php while ($tm = mysqli_fetch_assoc($times)) { ?>
                                                <option value="<?php echo htmlspecialchars($tm["show_time_id"]); ?>" <?php if (isset($show_time_id) && $show_time_id == $tm['show_time_id']) echo "selected"; ?>>
                                                    <?php echo htmlspecialchars($tm["time"]) . " -- " . htmlspecialchars($tm["time_name"]); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <input type="submit" value="Update Booking" class="sign__btn sign__btn--small">
                                </div>
                            </div>
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
