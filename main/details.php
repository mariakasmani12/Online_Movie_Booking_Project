<?php 
ob_start();
include("header.php");


// Initialize variables
$movie_id = "";
$title = "";
$director = "";
$youtube_url="";

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {
    // Sanitize the movie ID
    $movie_id = mysqli_real_escape_string($conn, $_GET['id']);

    // SQL query to fetch the movie with the specific ID
    $sql_time = "SELECT * FROM movies  WHERE movie_id = '$movie_id'";
    $movies_result = mysqli_query($conn, $sql_time);

    // Check if the query was successful and fetch movie details
    if ($movies_result && $movie = mysqli_fetch_assoc($movies_result)) {
        $title = $movie['title'];
        $director = $movie['director'];
		$youtube_url=$movie['trailer_url'];
    } else {
        echo "Error fetching movie details: " . mysqli_error($conn);
    }
}

?>

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
<!-- end details -->
 <?php include("reviews.php") ?>

<?php include("footer.php"); ?>
</html>
<?php
// End output buffering and flush
ob_end_flush();
?>