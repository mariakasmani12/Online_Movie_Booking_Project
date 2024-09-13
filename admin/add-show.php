<?php
include("admin-layouts/header.php");

// Fetch screens and theaters
$sql_screen = "SELECT * FROM `screen`";
$screens = mysqli_query($conn, $sql_screen);

$sql_theater = "SELECT * FROM `theater`";
$theaters = mysqli_query($conn, $sql_theater);

$sql_movie = "SELECT * FROM `movies`";
$moviess = mysqli_query($conn, $sql_movie);

$sql_show_time = "SELECT * FROM `show_timing`";
$show_times = mysqli_query($conn, $sql_show_time);

$theater = $screen = $movies = $show_time = $show_date ="";
$theaterErr = $screenErr = $moviesErr = $show_timeErr = $show_dateErr ="";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
        $moviesErr = "movie is required";
    } else {
        $movies = test_input($_POST["movie_id"]);
    }

    if (empty($_POST["show_time_id"])) {
        $show_timeErr = "time is required";
    } else {
        $show_time = test_input($_POST["show_time_id"]);
    }

    if (empty($_POST["show_date"])) {
        $show_timeErr = "date is required";
    } else {
        $show_date = test_input($_POST["show_date"]);
    }

    if (empty($theaterErr) && empty($screenErr) && empty($moviesErr) && empty($show_timeErr) && empty($show_dateErr)) {
        $sql_show_insert = "
        INSERT INTO `shows` (`show_id`, `screen_id`, `movie_id`, `show_time_id`, `show_date`, `theater_id`) VALUES (NULL, '$screen', '$movies', '$show_time', '$show_date', '$theater')";
        if (mysqli_query($conn, $sql_show_insert)) {
            header("Location: show-admin.php");
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
                                        <label for="theater_name" class="form-label text-light">theater <span class="text-danger">*<?php echo $theaterErr; ?></span></label>
                                        <select class="sign__selectjs" id="sign__genre" name="theater_name">
                                            <option value="">Select theater</option>
                                            <?php while ($thet = mysqli_fetch_assoc($theaters)) { ?>
                                                <option value="<?php echo $thet['theater_id']; ?>"><?php echo $thet['theater_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="screen_name" class="form-label text-light">screen <span class="text-danger">*<?php    echo $screenErr; ?></span></label>
                                        <select class="sign__selectjs" id="sign__director" name="screen_name">
                                            <option value="">Select screen</option>
                                            <?php while ($scr = mysqli_fetch_assoc($screens)) { ?>
                                                <option value="<?php echo $scr['screen_id']; ?>"><?php echo $scr['screen_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-12">
								<div class="sign__group">
                                <label for="title" class="form-label text-light">movies <span class="text-danger">*<?php    echo $moviesErr; ?></span></label>
									<select class="sign__selectjs" id="sign__actors"  name="movie_id">
										<option value=""> select Movies</option>
                                       <?php  while($mt= mysqli_fetch_assoc($moviess)){?>
                                          <option value="<?php echo $mt["movie_id"] ?>">  <?php echo  $mt["title"] ?></option>;
                                            
                                        <?php } ?> 
									</select>
								</div>
							</div>

                            
									<div class="col-12">
										<div class="sign__group">
                                        <label for="show_time_id" class="form-label text-light">show time <span class="text-danger">*<?php    echo $moviesErr; ?></span></label>
											<select class="sign__selectjs" id="sign__country" name="show_time_id"> 
												<option value="">seelct show</option>
                                                <?php  while($st= mysqli_fetch_assoc($show_times)){?>
												<option value="<?php echo $st['show_time_id']  ?>"> <?php echo $st["time"] ?>-<?php echo $st["time_name"] ?></option>
                                            <?php } ?>
                                         </select>
								    </div>
							     </div>        
                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="class_type" class="form-label text-light">show Date <span class="text-danger">*<?php echo $show_dateErr; ?></span></label>
                                        <input type="date" class="sign__input" name="show_date">
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
