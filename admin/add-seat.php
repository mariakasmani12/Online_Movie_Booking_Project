<?php
include("admin-layouts/header.php");

// Fetch screens and theaters
$sql_screen = "SELECT * FROM `screen`";
$screens = mysqli_query($conn, $sql_screen);

$sql_theater = "SELECT * FROM `theater`";
$theaters = mysqli_query($conn, $sql_theater);

$theater = $screen = $seat_class = $price = "";
$theaterErr = $screenErr = $seat_classErr = $priceErr = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   

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

    if (empty($seat_classErr) && empty($priceErr)) {
        $sql_theater_insert = "INSERT INTO `seat_class` (`seat_id`,  `class_type`, `price`) 
                               VALUES (NULL, '$seat_class', '$price')";
        if (mysqli_query($conn, $sql_theater_insert)) {
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
                                        <label for="class_type" class="form-label text-light">class_type <span class="text-danger">*<?php echo $seat_classErr; ?></span></label>
                                        <input type="text" class="sign__input" name="class_type">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="price" class="form-label text-light">price <span class="text-danger">*<?php echo $priceErr; ?></span></label>
                                        <input type="text" class="sign__input" name="price">
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
