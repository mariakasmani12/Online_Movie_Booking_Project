

<?php 
ob_start();
include("header.php");


$sql="SELECT * FROM reviews AS r
JOIN user AS u ON r.user_id=u.user_id
JOIN movies AS m ON r.movie_id=m.movie_id";

$reviews=mysqli_query($conn,$sql);

$user_id=$movie_id=$rating=$comments="";
$ratingErr=$commentsErr="";

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];  
} else {
    header("Location: index2.php");
    exit();
}

$movie_id = "";
$title = "";
$director = "";
$youtube_url = "";
$movie = "";

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {
    $movie_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql_time = "SELECT * FROM movies WHERE movie_id = '$movie_id'";
    $movies_result = mysqli_query($conn, $sql_time);

    if ($movies_result && $movie = mysqli_fetch_assoc($movies_result)) {
        $title = $movie['title'];
        $director = $movie['director'];
        $youtube_url = $movie['trailer_url'];
    } else {
        echo "Error fetching movie details: " . mysqli_error($conn);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $movie_id = mysqli_real_escape_string($conn, $_POST['movie_id']);
    if (empty($_POST["rating"])) {
        $ratingErr = "Rating is required";
    } else {
        $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    }

    if (empty($_POST["comments"])) {
        $commentsErr = "Comments are required";
    } else {
        $comments = mysqli_real_escape_string($conn, $_POST['comments']);
    }

    if (empty($ratingErr) && empty($commentsErr)) {
        $sql_reviews_insert = "INSERT INTO reviews (review_id, user_id, movie_id, rating, comments, review_date)
         VALUES (NULL, '$user_id', '$movie_id', '$rating', '$comments', current_timestamp());";
        if (mysqli_query($conn, $sql_reviews_insert)) {
            header("Location: details.php?id=$movie_id"); 
            exit();
        } else {
            echo "Error inserting review: " . mysqli_error($conn);
        }
    }
}

$sql_theater = "SELECT * FROM theater";
$theaters = mysqli_query($conn, $sql_theater);

$sql_m = "SELECT * FROM movies";
$mo = mysqli_query($conn, $sql_m);

$show_availability_displayed = false;
$movie_id = mysqli_real_escape_string($conn, $_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['save']))
 {
    $theater = mysqli_real_escape_string($conn, $_POST['theater']);
    $movie_id = mysqli_real_escape_string($conn, $_POST['movie_id']);

    
    $sql_time = "SELECT * FROM movies WHERE movie_id = '$movie_id'";
    $movies_result = mysqli_query($conn, $sql_time);

    if ($movies_result && $movie = mysqli_fetch_assoc($movies_result)) {
        $title = $movie['title'];
        $director = $movie['director'];
        $youtube_url = $movie['trailer_url'];
    } else {
        echo "Error fetching movie details: " . mysqli_error($conn);
    }

    $sql_book = "SELECT * FROM shows AS sho 
    JOIN screen AS screen ON sho.screen_id = screen.screen_id
    JOIN theater AS th ON screen.theater_id = th.theater_id
    JOIN show_timing AS st ON sho.show_time_id = st.show_time_id
    JOIN movies AS m ON sho.movie_id = m.movie_id 
    WHERE th.theater_id = '$theater' AND sho.movie_id = '$movie_id'";

    if ($th = mysqli_query($conn, $sql_book)) {
        $show_availability_displayed = true;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
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
<?php if (!$show_availability_displayed) {?>
    <div class="section section--notitle">
        <div class="container">    
            <div class="row">
                <!-- plan -->
                <div class="col-10">
                    <div class="plan">
                        <h3 class="plan__title">Show Availability</h3>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $movie_id; ?>" method="post" class="sign__form sign__form--comments">
                       
                        <input type="hidden" class="sign__input" name="movie_id" value="<?php echo htmlspecialchars($movie_id); ?>">
                        <select class="form-select text-light" aria-label="Default select example" name="theater" style="background-color: #222028; border-color: #f9ab00;">
                                <option value="">Select theater</option>
                                <?php while ($thet = mysqli_fetch_assoc($theaters)) { ?>
                                    <option value="<?php echo $thet['theater_id']; ?>"><?php echo $thet['theater_name']; ?></option>
                                <?php } ?>
                            </select>  
                            <input type="submit" name="save" value="save" class="plan__btn">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }  ?>

<!-- Show Availability Results -->
<?php if ($show_availability_displayed) { ?>
    <div class="section section--notitle">
        <div class="container">
            <div class="row">
                <!-- plan -->
                <div class="col-10">
                    <div class="plan">
                        <h3 class="plan__title">Availability</h3>
                        <table class="table table-striped " style="background-color: #222028; border-color: #f9ab00; color:white;">
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
                            <tbody >
                                <?php while ($theater_info = mysqli_fetch_assoc($th)) { ?>
                                    <tr>
                                        <td  style="color:white;"><?php echo htmlspecialchars($theater_info['theater_name']); ?></td>
                                        <td  style="color:white;"><?php echo htmlspecialchars($theater_info['title']); ?></td>
                                        <td  style="color:white;"><?php echo htmlspecialchars($theater_info['screen_name']); ?></td>
                                        <td  style="color:white;"><?php echo htmlspecialchars($theater_info['time']); ?> - <?php echo htmlspecialchars($theater_info['time_name']); ?></td>
                                        <td  style="color:white;"><?php echo htmlspecialchars($theater_info['show_date']); ?></td>
                                        <td>
                                         <a  href="booking-model.php?book=<?php  echo htmlspecialchars($theater_info['show_id']); ?>"type="button" class="catalog__btn catalog__btn--view"  style="background-color: #f9ab00; border: 2px solid #f9ab00; magrin:4px; padding:4px;  color:white;">
                                          Book Now
                                </a>
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

<!-- end details -->
 

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