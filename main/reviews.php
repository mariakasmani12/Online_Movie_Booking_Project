<?php 


// Check if the user is logged in and the username is available in the session
ob_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];  // Fetch the username from session
} else {
    // If the user is not logged in, redirect to login page or show an error
    header("Location: ../login.php");
    exit();
}

// Your code continues here...

// At the end of the script
ob_end_flush();

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
        $youtube_url = $movie['trailer_url'];
    } else {
        echo "Error fetching movie details: " . mysqli_error($conn);
    }
}
?>

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
                                        <li class="reviews__item">
                                            <div class="reviews__autor">
                                                <img class="reviews__avatar" src="img/user.svg" alt="">
                                                <span class="reviews__name">Best Marvel movie in my opinion</span>
                                                <span class="reviews__time">24.08.2018, 17:53 by John Doe</span>
                                                <span class="reviews__rating reviews__rating--yellow">6</span>
                                            </div>
                                            <p class="reviews__text">There are many variations of passages of Lorem Ipsum available...</p>
                                        </li>

                                        <li class="reviews__item">
                                            <div class="reviews__autor">
                                                <img class="reviews__avatar" src="img/user.svg" alt="">
                                                <span class="reviews__name">Best Marvel movie in my opinion</span>
                                                <span class="reviews__time">24.08.2018, 17:53 by John Doe</span>
                                                <span class="reviews__rating reviews__rating--green">9</span>
                                            </div>
                                            <p class="reviews__text">There are many variations of passages of Lorem Ipsum available...</p>
                                        </li>

                                        <li class="reviews__item">
                                            <div class="reviews__autor">
                                                <img class="reviews__avatar" src="img/user.svg" alt="">
                                                <span class="reviews__name">Best Marvel movie in my opinion</span>
                                                <span class="reviews__time">24.08.2018, 17:53 by John Doe</span>
                                                <span class="reviews__rating reviews__rating--red">5</span>
                                            </div>
                                            <p class="reviews__text">There are many variations of passages of Lorem Ipsum available...</p>
                                        </li>
                                    </ul>
<?php 
                                    // Fetch users and movies for the form
$sql_user = "SELECT * FROM `user`";
$users = mysqli_query($conn, $sql_user);

$sql_movie = "SELECT * FROM `movies`";
$movies = mysqli_query($conn, $sql_movie);

// Initialize variables and error messages
$username = $movie_id = $rating = $comments = "";
$usernameErr = $movie_idErr = $ratingErr = $commentsErr = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validate user_id
    if (empty($_POST["username"])) {
        $user_idErr = "User is required";
    } else {
        $user_id = test_input($_POST["username"]);
    }

    // Validate movie_id
    if (empty($_POST["movie_id"])) {
        $movie_idErr = "Movie is required";
    } else {
        $movie_id = test_input($_POST["movie_id"]);
    }

    // Validate rating
    if (empty($_POST["rating"])) {
        $ratingErr = "Rating is required";
    } else {
        $rating = test_input($_POST["rating"]);
    }

    // Validate comments
    if (empty($_POST["comments"])) {
        $commentsErr = "Comment is required";
    } else {
        $comments = test_input($_POST["comments"]);
    }

    // Check if there are no errors before executing the query
    if (empty($user_idErr) && empty($movie_idErr) && empty($ratingErr) && empty($commentsErr)) {
        $sql_reviews_insert = "INSERT INTO `reviews` (`review_id`, `user_id`, `movie_id`, `rating`, `comments`, `review_date`) 
                               VALUES (NULL, '$username', '$movie_id', '$rating', '$comments', current_timestamp())";
        if (mysqli_query($conn, $sql_reviews_insert)) {
            header("Location: details.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
                              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="sign__form sign__form--comments">
                                        <!-- Fetch username and movie_id from session and URL -->
                                        <div class="col-12">
                                            <div class="sign__group">
                                                <input type="hidden" class="sign__input" name="username" value="<?php echo htmlspecialchars($username); ?>">
                                                <input type="hidden" class="sign__input" name="movie_id" value="<?php echo htmlspecialchars($movie_id); ?>">
                                            </div>
                                        </div>

                                        <div class="sign__group">
                                            <input type="number" class="sign__input" name="rating" placeholder="Ratings">
                                        </div>

                                        <div class="sign__group">
                                            <textarea id="textreview" name="textreview" name="comments" class="sign__textarea" placeholder="Add review"></textarea>
                                        </div>

                                        <input type="submit" class="sign__btn sign__btn--small" value="Send">
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
