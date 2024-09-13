<?php
ob_start();

include("header.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id']; 


$sql_check_user = "SELECT * FROM `user` WHERE `user_id` = '$user_id'";
$user_check_result = mysqli_query($conn, $sql_check_user);

if (mysqli_num_rows($user_check_result) == 0) {
    echo "Error: User ID not found. Please check the user session or database.";
    exit();
}

// Fetching data from database
// $sq_screen="SELECT total_seats_avaible  FROM `screens`
// WHERE screen_name='$screen'";

$sql_show = "SELECT * FROM `shows`";
$shows = mysqli_query($conn, $sql_show);

$sql_screen = "SELECT * FROM `screen` ";
$screens = mysqli_query($conn, $sql_screen);

$sql_theater = "SELECT * FROM `theater`";
$theaters = mysqli_query($conn, $sql_theater);

$sql_movie = "SELECT * FROM `movies`";
$movies = mysqli_query($conn, $sql_movie);

$sql_show_time = "SELECT * FROM `show_timing`";
$show_times = mysqli_query($conn, $sql_show_time);

$sql_class = "SELECT * FROM `seat_class`";
$classes = mysqli_query($conn, $sql_class);

$theater = $screen = $movie = $show_time = $show_date = $showid = $class = $totalseat = $total_amount = "";
$theaterErr = $screenErr = $movieErr = $show_timeErr = $show_dateErr = $classErr = $totalseatErr = "";

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['book'])) {
    $showid = test_input($_GET['book']);

    $sql_show_details = "SELECT * FROM `shows` AS sh 
    JOIN screen AS s ON sh.screen_id = s.screen_id
    JOIN theater AS th ON sh.theater_id = th.theater_id
    JOIN show_timing AS st ON st.show_time_id = sh.show_time_id
    JOIN movies AS m ON sh.movie_id = m.movie_id
    WHERE `show_id` = $showid";
    
    $show_details = mysqli_query($conn, $sql_show_details);

    if ($show_details) {
        $show = mysqli_fetch_assoc($show_details);
        $theater = $show['theater_name'];
        $screen = $show['screen_name'];
        $show_time = $show["time_name"];
        $time = $show["time"];
        $show_date = $show["show_date"];
        $movie = $show["title"];
    } else {
        echo "Error fetching seat details: " . mysqli_error($conn);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $showid = test_input($_POST["show_id"]);

    // Validate input fields
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

    if (empty($_POST["movie_id"])) {
        $movieErr = "Movie is required";
    } else {
        $movie = test_input($_POST["movie_id"]);
    }

    if (empty($_POST["show_time_id"])) {
        $show_timeErr = "Time is required";
    } else {
        $show_time = test_input($_POST["show_time_id"]);
    }

    if (empty($_POST["show_date"])) {
        $show_dateErr = "Date is required";
    } else {
        $show_date = test_input($_POST["show_date"]);
    }

    if (empty($_POST["seat_id"])) {
        $classErr = "Seat class is required";
    } else {
        $class = test_input($_POST["seat_id"]);
    }

    if (empty($_POST["total_seats"])) {
        $totalseatErr = "Total seats are required";
    } else {
        $totalseat = test_input($_POST["total_seats"]);
    }

    if (empty($_POST["total_amount"])) {
        $total_amount = 0; 
    } else {
        $total_amount = test_input($_POST["total_amount"]);
    }

    // Fetch the total seats available for the selected screen
    $sql_fetch_seats = "SELECT total_seats_available FROM screen WHERE screen_id = 
        (SELECT screen_id FROM shows WHERE show_id = $showid)";
    $seat_result = mysqli_query($conn, $sql_fetch_seats);
    $screen_data = mysqli_fetch_assoc($seat_result);
    $total_seats_available = $screen_data['total_seats_available'];

    // Calculate remaining seats
    $remaining_seats = $total_seats_available - $totalseat;

    if ($totalseat > $total_seats_available) {
        
        $totalseatErr = "You have requested more seats than available. Only " . $total_seats_available . " seats are available.";
    } else {
       
        $new_total_seats_available = $total_seats_available - $totalseat;
        $sql_update_seats = "UPDATE screen SET total_seats_available = '$new_total_seats_available' 
                             WHERE screen_id = (SELECT screen_id FROM shows WHERE show_id = $showid)";
        
        if (mysqli_query($conn, $sql_update_seats)) {
           
            $sql_insert_booking = "INSERT INTO `bookings` 
            (`b_id`, `show_id`, `seat_class_id`, `user_id`, `total_seats`, `total_amount`) 
            VALUES (NULL, '$showid', '$class', '$user_id', '$totalseat', '$total_amount')";
           $bookings=mysqli_query($conn, $sql_insert_booking);
            if ($bookings) {
                $booking_id = mysqli_insert_id($conn);
                
                // Redirect to payment page with the booking ID
                header("Location: payment.php?b_id=" . $booking_id);
                exit();
            } else {
                echo "Error inserting booking: " . mysqli_error($conn);
            }
        } else {
            echo "Error updating available seats: " . mysqli_error($conn);
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="styles.css"> <!-- Your CSS file -->
    <script src="script.js" defer></script> <!-- Your JavaScript file -->
</head>
<body>
    <?php include("header.php"); ?>

    <!-- page title -->
    <section class="section section--first">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h1 class="section__title section__title--head">BOOKING</h1>
                        <!-- end section title -->

                        <!-- breadcrumbs -->
                        <ul class="breadcrumbs">
                            <li class="breadcrumbs__item"><a href="index.html">Home</a></li>
                            <li class="breadcrumbs__item breadcrumbs__item--active">Booking</li>
                        </ul>
                        <!-- end breadcrumbs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- contacts -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <!-- section title -->
                        <div class="col-12">
                            <h2 class="section__title">BOOK NOW</h2>
                        </div>
                        <!-- end section title -->

                        <div class="col-12">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="sign__form sign__form--full">
                                <div class="row">
                                    <input type="hidden" class="sign__input" name="show_id" value="<?php echo $showid ?>">

                                    <div class="col-12 col-xl-4">
                                        <div class="sign__group">
                                            <label class="sign__label">Theater</label>
                                            <input type="text" name="theater_name" class="sign__input" value="<?php echo $theater ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-4">
                                        <div class="sign__group">
                                            <label class="sign__label">Movie</label>
                                            <input type="text" name="movie_id" class="sign__input" value="<?php echo $movie ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-4">
                                        <div class="sign__group">
                                            <label class="sign__label">Screen</label>
                                            <input type="text" name="screen_name" class="sign__input" value="<?php echo $screen ?> " readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6">
                                        <div class="sign__group">
                                            <label class="sign__label">Time</label>
                                            <input type="text" name="show_time_id" class="sign__input" value="<?php echo $show_time ?>-<?php echo $time ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6">
                                        <div class="sign__group">
                                            <label class="sign__label">Date</label>
                                            <input type="text" name="show_date" class="sign__input" value="<?php echo $show_date ?>" readonly>
                                        </div>
                                    </div>

                                    <!-- Seat Class Selection -->
                                    <div class="col-12 col-xl-6">
                                        <div class="sign__group">
                                            <label class="sign__label">Seat Class</label>
                                            <select class="form-select text-light" id="seatClass" name="seat_id" style="background-color: #222028; border-color: #222028; padding:10px;">
                                                <option value="">Select seat class</option>
                                                <?php while ($seat = mysqli_fetch_assoc($classes)) { ?>
                                                    <option value="<?php echo $seat['seat_id']; ?>" data-price="<?php echo $seat['price']; ?>"><?php echo $seat['class_type']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Total Seats Input -->
                                    <div class="col-12 col-xl-6">
                                        <div class="sign__group">
                                            <label class="sign__label">Total Seats <span class="text-danger"><?php echo $totalseatErr ?></span></label>
                                            <input type="number" id="seatQuantity" name="total_seats" class="sign__input">
                                        </div>
                                    </div>

                                    <!-- Total Amount Input -->
                                    <div class="col-12 col-xl-4">
                                        <div class="sign__group">
											<h2 class="text-warning" style=" margin-left:62px;  margin-top:12px;"> Total Amount :</h2>
                                          
                                        </div>
                                    </div>
									<div class="col-12 col-xl-6">
                                        <div class="sign__group">
                                            
                                            <input type="text" id="totalAmount" name="total_amount" class="sign__input" style=" margin-right:62px;  margin-top:12px;"readonly>
                                            <input type="hidden" id="totalAmountHidden" name="total_amount">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <input type="submit" class="plan__btn"  name="submit"  value="submit">
                                      
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contacts -->

    <?php include("footer.php"); ?>
</body>
</html>

<!-- JavaScript for Dynamic Price Calculation -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    var seatClassSelect = document.getElementById('seatClass');
    var seatQuantityInput = document.getElementById('seatQuantity');
    var totalAmountInput = document.getElementById('totalAmount');
    var totalAmountHiddenInput = document.getElementById('totalAmountHidden');

    function calculateTotal() {
        var seatClass = seatClassSelect.options[seatClassSelect.selectedIndex];
        var pricePerSeat = seatClass.getAttribute('data-price');
        var seatQuantity = seatQuantityInput.value;

        if (pricePerSeat && seatQuantity) {
            var totalAmount = pricePerSeat * seatQuantity;
            totalAmountInput.value = totalAmount.toFixed(2);
            totalAmountHiddenInput.value = totalAmount.toFixed(2);
        } else {
            totalAmountInput.value = '';
            totalAmountHiddenInput.value = '';
        }
    }

    seatClassSelect.addEventListener('change', calculateTotal);
    seatQuantityInput.addEventListener('input', calculateTotal);
});
</script>
