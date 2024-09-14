<?php 
ob_start();
include("header.php");

// Check if the user is logged in, else redirect to login
if (!isset($_SESSION['login'])) {
    header("Location: ./../login.php");
    exit();
}

// Initialize variables
$movie_id = "";
$title = "";
$director = "";
$youtube_url = "";
$movie = "";

// Check if 'id' is in the URL query
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $movie_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch movie details using the 'id'
    $sql_time = "SELECT * FROM movies WHERE movie_id = '$movie_id'";
    $movies_result = mysqli_query($conn, $sql_time);

    // Check if movie exists
    if ($movies_result && mysqli_num_rows($movies_result) > 0) {
        $movie = mysqli_fetch_assoc($movies_result);
        $title = $movie['title'];
        $director = $movie['director'];
        $youtube_url = $movie['trailer_url'];
    } else {
        echo "Movie not found.";
        exit();
    }
} else {
    echo "Invalid Request. Movie ID is missing.";
    exit();
}

// Fetch show dates
$sql_show_dates = "SELECT DISTINCT show_date FROM shows WHERE movie_id = '$movie_id'";
$show_dates = mysqli_query($conn, $sql_show_dates);

$ratingErr=$commentsErr="";
// Handle review submission
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    // Validate rating
    if (empty($_POST["rating"])) {
        $ratingErr = "Rating is required";
    } else {
        $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    }

    // Validate comments
    if (empty($_POST["comments"])) {
        $commentsErr = "Comment is required";
    } else {
        $comments = mysqli_real_escape_string($conn, $_POST['comments']);
    }
  
    $movie_id = mysqli_real_escape_string($conn, $_POST['movie_id']);
    if( empty($ratingErr) && empty($commentsErr)){
    $sql_reviews_insert = "INSERT INTO reviews (review_id, user_id, movie_id, rating, comments, review_date)
     VALUES (NULL, '$user_id', '$movie_id', '$rating', '$comments', current_timestamp())";

    if (mysqli_query($conn, $sql_reviews_insert)) {
        header("Location: details.php?id=$movie_id"); 
        exit();
    } else {
        echo "Error inserting review: " . mysqli_error($conn);
    }
}
}

// Handle show time selection
$show_availability_displayed = false;
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['check_availability'])) {
    $show_date = mysqli_real_escape_string($conn, $_POST['show_date']);
    $show_time = mysqli_real_escape_string($conn, $_POST['show_time']);

    $sql_book = "SELECT * FROM shows AS sho 
    JOIN screen AS screen ON sho.screen_id = screen.screen_id
    JOIN theater AS th ON sho.theater_id = th.theater_id
    JOIN show_timing AS st ON sho.show_time_id = st.show_time_id
    JOIN movies AS m ON sho.movie_id = m.movie_id 
    WHERE sho.movie_id = '$movie_id' AND sho.show_date = '$show_date' AND st.show_time_id = '$show_time'";

    $th = mysqli_query($conn, $sql_book);
    if ($th && mysqli_num_rows($th) > 0) {
        $show_availability_displayed = true;
    } else {
        echo "Error: No shows available.";
    }
}

// Fetch reviews
$sql_reviews = "SELECT * FROM reviews AS r
JOIN user AS u ON r.user_id=u.user_id
JOIN movies AS m ON r.movie_id=m.movie_id
WHERE r.movie_id = '$movie_id'";
$reviews = mysqli_query($conn, $sql_reviews);

?>

<style>
    .table-warning tbody tr:nth-child(even) {
        background-color: #222028;
}

.table-warning tbody tr:nth-child(odd) {
    background-color: #222028;
     border-color: #f9ab00;}
</style>
<!-- details -->
<section class="section section--details">
    <!-- details content -->
    <div class="container">
        <div class="row">
            <?php if (!empty($movie)) { ?>
                <div class="col-12">
                    <div class="sign__group">
                        <label for="show_id" hidden class="form-label text-light">Show ID</label>
                        <input type="hidden" class="sign__input" name="show_id" value="<?php echo htmlspecialchars($movie_id); ?>">
                    </div>
                </div>
                <!-- title -->
                <div class="col-12">
                    <h1 class="section__title section__title--head"><?php echo htmlspecialchars($title); ?></h1>
                </div>
                <!-- end title -->

                <!-- content -->
                <div class="col-12 col-xl-6">
                    <div class="item item--details">
                        <div class="row">
                            <!-- card cover -->
                            <div class="col-12 col-sm-5 col-md-5 col-lg-4 col-xl-6 col-xxl-5">
                                <div class="item__cover">
                                    <img src="<?php echo htmlspecialchars($movie['image']); ?>" alt="">
                                    <span class="item__rate item__rate--green">8.4</span>
                                    <button class="item__favorite item__favorite--static" type="button">
                                        <i class="ti ti-bookmark"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- end card cover -->

                            <!-- card content -->
                            <div class="col-12 col-md-7 col-lg-8 col-xl-6 col-xxl-7">
                                <div class="item__content">
                                    <ul class="item__meta">
                                        <li><span>Director:</span> <a href="actor.html"><?php echo htmlspecialchars($director); ?></a></li>
                                        <li><span>Cast:</span> <a href="actor.html"> <?php echo htmlspecialchars($movie['cast']); ?></a>
                                        </li>
                                        <li><span>Genre:</span> <a href="catalog.html">Action</a> 
                                            <a href="catalog.html">Thriller</a>
                                        </li>
                                        <li><span>Premiere:</span><?php echo htmlspecialchars($movie['released_date']); ?></li>
                                        <li><span>Running time:</span><?php echo htmlspecialchars($movie['duration']); ?></li>
                                      
                                    </ul>

                                    <div class="item__description">
                                        <p><?php echo htmlspecialchars($movie['synopsis']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <!-- end card content -->
                        </div>
                    </div>
                </div>
                <!-- end content -->
				<!-- player -->
				<div class="col-12 col-xl-6">
				<?php if (!empty($youtube_url)) { ?>
					<iframe width="560" height="315" src="<?php echo  htmlspecialchars($movie['trailer_url'])  ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <?php } else { ?>
                        <p>No video available</p>
                    <?php } ?>
					
				</div>
				<?php } else { ?>
					<div class="col-12">
						<h1 class="section__title section__title--head">Movie not found</h1>
					</div>
				<?php } ?>
				
            <!-- end player -->
        </div>
    </div>
    <!-- end details content -->
                </section>
     
<!-- Show Availability Form -->
<?php if (!$show_availability_displayed) { ?>
    <div class="section section--notitle">
        <div class="container">    
            <div class="row">
                <div class="col-10">
                    <div class="plan">
                        <h3 class="plan__title">Show Availability</h3>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $movie_id; ?>" method="post" class="sign__form sign__form--comments">
                            <input type="hidden" name="movie_id" value="<?php echo htmlspecialchars($movie_id); ?>">
                            
                            <!-- Select Show Date -->
                            <select class="form-select text-light" name="show_date" required  style="background-color: #222028; border-color: #f9ab00;">
                                <option value="">Select show date</option>
                                <?php while ($date = mysqli_fetch_assoc($show_dates)) { ?>
                                    <option value="<?php echo $date['show_date']; ?>"><?php echo $date['show_date']; ?></option>
                                <?php } ?>
                            </select> 

                            <!-- Select Show Time -->
                            <select class="form-select text-light" name="show_time" required  style="background-color: #222028; border-color: #f9ab00;">
                                <option value="">Select show time</option>
                                <?php
                                // Fetch available show timings
                                $sql_show_times = "SELECT * FROM show_timing";
                                $show_times = mysqli_query($conn, $sql_show_times);
                                while ($time = mysqli_fetch_assoc($show_times)) { ?>
                                    <option value="<?php echo $time['show_time_id']; ?>"><?php echo $time['time']; ?></option>
                                <?php } ?>
                            </select>  

                            <input type="submit" name="check_availability" value="Check Availability" class="plan__btn">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Show Availability Results -->
<?php if ($show_availability_displayed) { ?>
    <div class="section section--notitle">
        <div class="container">
            <div class="row">
                <div class="col-10">
                    <div class="plan">
                        <h3 class="plan__title">Available Shows</h3>
                        <table class="table table-striped" style="background-color: #222028; border-color: #f9ab00; color:white;">
                            <thead>
                                <tr>
                                    <th>Theater</th>
                                    <th>Movie</th>
                                    <th>Screen</th>
                                    <th>Show Time</th>
                                    <th>Show Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($show = mysqli_fetch_assoc($th)) { ?>
                                    <tr style="background-color: #222028; border-color: #f9ab00; color:white;">
                                        <td class="text-light"><?php echo htmlspecialchars($show['theater_name']); ?></td>
                                        <td class="text-light"><?php echo htmlspecialchars($show['title']); ?></td>
                                        <td class="text-light"><?php echo htmlspecialchars($show['screen_name']); ?></td>
                                        <td class="text-light"><?php echo htmlspecialchars($show['time']); ?></td>
                                        <td class="text-light"><?php echo htmlspecialchars($show['show_date']); ?></td>
                                        <td>
                                            <a class="bg-warning text-light" href="booking-model.php?book=<?php echo htmlspecialchars($show['show_id']); ?>" class="catalog__btn">Book Now</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- content -->
<section class="content">
    <div class="content__head content__head--mt">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- content title -->
                    <h2 class="content__title">Reviews</h2>
                    <!-- end content title -->
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <!-- content tabs -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-2" role="tabpanel" aria-labelledby="2-tab" tabindex="0">
                        <div class="row">
                            <!-- reviews -->
                            <div class="col-12">
                                <div class="reviews">
                                    <ul class="reviews__list">
                                        <!-- Example reviews -->
                                        <li class="reviews__item">
                                        <?php
								$srno=1;
								while($review= mysqli_fetch_assoc($reviews)) 
								{
								?>
                                            <div class="reviews__autor">
                                            <img class="reviews__avatar" src="img/user.svg" alt="">
                                            <span class="reviews__name"> <?php echo $review['name']?></span>
                                                <span class="reviews__time"><?php  echo $review['review_date'] ?> </span>
                                                <span class="reviews__rating reviews__rating--yellow"><?php echo $review['rating'] ?></span>
                                            </div>
                                            <p class="reviews__text"><?php  echo $review['comments'] ?></p>
                                        </li>
                                        <?php 
                                         $srno++;}
                                        ?>

                                    </ul>

                                    <!-- Review submission form -->
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $movie_id; ?>" method="post" class="sign__form sign__form--comments">
                                        <!-- Hidden fields for user_id and movie_id -->
                                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                                        <input type="hidden" name="movie_id" value="<?php echo htmlspecialchars($movie_id); ?>">

                                        <!-- Rating input -->
                                        <div class="sign__group">
                                        <label  for="show_id" class="text-light"> Rating <span class="text-danger">*<?php echo $ratingErr;?></span></label>
                                            <input type="number" class="sign__input" name="rating" min="1" max="10" placeholder="Rating" required>
                                            
                                        </div>                                            

                                        <!-- Comments input -->
                                        <div class="sign__group">
                                        <label  for="show_id" class="text-light"> Comments <span class="text-danger">*<?php echo $commentsErr;?></span></label>
                                            <textarea id="comments" name="comments" class="sign__textarea" placeholder="Add your review" required></textarea>
                                            
                                        </div>

                                        <input type="submit" name="submit" class="sign__btn sign__btn--small" value="Submit">
                                    </form>
                                </div>
                            </div>
                            <!-- end reviews -->
                        </div>
                    </div>
                </div>
                <!-- end content tabs -->
            </div>
        </div>
    </div>
</section>
<!-- end content -->


<?php include("footer.php");
ob_flush();
?>
</html>
<?php
// End output buffering and flush
// ob_end_flush();
?>