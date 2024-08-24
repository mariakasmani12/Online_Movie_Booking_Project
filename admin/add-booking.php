<?php
include("admin-layouts/header.php");

// Fetching data from the database
$sql_show = "SELECT * FROM `show` AS shows
JOIN `screen` AS screen ON shows.screen_id=screen.id
JOIN `theater` AS theater ON screen.theater_id=theater.id";
$shows = mysqli_query($conn, $sql_show);

$sql_show_movie = "SELECT * FROM `show` AS shows
JOIN `movies` AS movie ON shows.movie_id=movie.id";
$shows_movies = mysqli_query($conn, $sql_show_movie);

$sql_show_time = "SELECT * FROM `show` AS shows
JOIN `show_timing` AS timing ON shows.show_time_id=timing.id";
$shows_times = mysqli_query($conn, $sql_show_time);

$sql_show_date = "SELECT * FROM `show`";
$shows_dates = mysqli_query($conn, $sql_show_date);

$sql_class = "SELECT * FROM `seat_class`";
$classes = mysqli_query($conn, $sql_class);

$sql_user = "SELECT * FROM `user`";
$users = mysqli_query($conn, $sql_user);

// Initialize variables
$userid = $show_id = $total_seats = $class_id = $movie_id = $theater_id = $show_time_id = $show_date_id = "";
$useridErr = $show_idErr = $class_idErr = $movie_idErr = $theater_idErr = $show_time_idErr = $show_date_idErr = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST["user_id"])) {
        $useridErr = "User is required";
    } else {
        $userid = test_input($_POST["user_id"]);
    }

    if (empty($_POST["theater_id"])) {
        $theater_idErr = "Theater is required";
    } else {
        $theater_id = test_input($_POST["theater_id"]);
    }

    if (empty($_POST["movie_id"])) {
        $movie_idErr = "Movie is required";
    } else {
        $movie_id = test_input($_POST["movie_id"]);
    }

    if (empty($_POST["show_time_id"])) {
        $show_time_idErr = "Show time is required";
    } else {
        $show_time_id = test_input($_POST["show_time_id"]);
    }

    if (empty($_POST["show_date_id"])) {
        $show_date_idErr = "Show date is required";
    } else {
        $show_date_id = test_input($_POST["show_date_id"]);
    }

    if (empty($_POST["seat_class_id"])) {
        $class_idErr = "Seat class is required";
    } else {
        $class_id = test_input($_POST["seat_class_id"]);
    }

    if (empty($_POST["total_seats"])) {
        $total_seats = "";
    } else {
        $total_seats = test_input($_POST["total_seats"]);
    }

    // Insert booking if no errors
    if (empty($useridErr) && empty($theater_idErr) && empty($movie_idErr) && empty($show_time_idErr) && empty($show_date_idErr) && empty($class_idErr)) {
        $sql_insert_booking = "INSERT INTO `bookings` (`id`, `show_id`, `seat_class_id`, `user_id`, `total_seats`, `total_amount`) 
                               VALUES (NULL, '$show_id', '$class_id', '$userid', '$total_seats', '13')";
        if (mysqli_query($conn, $sql_insert_booking)) {
            header("Location: booking-admin.php");
            exit();
        }
    }
}

// function test_input($data) {
//     return htmlspecialchars(stripslashes(trim($data)));
// }
?>

<!-- main content -->
<main class="main">
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Add Bookings</h2>
                </div>
            </div>
            <!-- end main title -->
            <!-- form -->
            <?php
            pr($_REQUEST);
            ?>
            <div class="col-12">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="sign__form sign__form--add">
                    <div class="row">
                        <div class="col-12 col-xl-7">
                            <div class="row">
                                <div class="col-3">
                                    <div class="sign__group">
                                        <select class="sign__selectjs" id="sign__quality" name="user_id">
                                            <option value="">Select User</option>
                                            <?php while ($user = mysqli_fetch_assoc($users)) { ?>
                                                <option value="<?php echo $user['id']; ?>"><?php echo $user['id']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="sign__group">
                                        <select class="sign__selectjs" id="sign__genre" name="theater_id">
                                            <option value="">Select Theater</option>
                                            <?php while ($show = mysqli_fetch_assoc($shows)) { ?>
                                          <option value="<?php echo $show['id']; ?>"><?php echo $show['theater_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="sign__group">
                                        <select class="sign__selectjs" id="sign__country" name="movie_id">
                                            <option value="">Select Movie</option>
                                            <?php while ($movie = mysqli_fetch_assoc($shows_movies)) { ?>
                                                <option value="<?php echo $movie['id']; ?>"><?php echo $movie['title']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="sign__group">
                                        <select class="sign__selectjs" id="sign__director" name="show_time_id">
                                            <option value="">Select Time</option>
                                            <?php while ($show_time = mysqli_fetch_assoc($shows_times)) { ?>
                                                <option value="<?php echo $show_time['id']; ?>"><?php echo $show_time['time']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-xl-8">
                                    <div class="sign__group">
                                        <select class="sign__selectjs" id="sign__actors" name="show_date_id">
                                            <option value="">Select Date</option>
                                            <?php while ($show_date = mysqli_fetch_assoc($shows_dates)) { ?>
                                                <option value="<?php echo $show_date['id']; ?>"><?php echo $show_date['show_date']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6 col-md-6">
                                    <div class="sign__group">
                                        <input type="number" class="sign__input" name="total_seats" placeholder="Total Seats">
                                    </div>
                                </div>

                                <div class="col-6 col-md-6 col-xl-8">
                                    <div class="sign__group">
                                        <select class="sign__select" id="rights" name="seat_class_id">
                                            <option value="">Select Seat Class</option>
                                            <?php while ($class = mysqli_fetch_assoc($classes)) { ?>
                                                <option value="<?php echo $class['id']; ?>"><?php echo $class['class_type']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="sign__btn sign__btn--small"><span>Publish</span></button>
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
