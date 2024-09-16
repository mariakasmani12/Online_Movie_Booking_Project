<?php
include("header.php");

// Fetch all movies and store them in an array
$sql = "SELECT * FROM `movies`";
$movies_result = mysqli_query($conn, $sql);
$movies = mysqli_fetch_all($movies_result, MYSQLI_ASSOC);

// Fetch upcoming movies
$sql_upcoming = "SELECT * FROM movies WHERE released_date > CURDATE()";
$upcoming_movies_result = mysqli_query($conn, $sql_upcoming);
$upcoming_movies = mysqli_fetch_all($upcoming_movies_result, MYSQLI_ASSOC);
?>

<!-- home -->
<section class="home home--bg">
    <div class="container">
        <div class="row">
            <!-- home title -->
            <div class="col-12">
                <h1 class="home__title"><b>NEW ITEMS</b> OF THIS SEASON</h1>
            </div>
            <!-- end home title -->

            <!-- home carousel -->
            <div class="col-12">
                <div class="home__carousel splide splide--home">
                    <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev" type="button">
                            <i class="ti ti-chevron-left"></i>
                        </button>
                        <button class="splide__arrow splide__arrow--next" type="button">
                            <i class="ti ti-chevron-right"></i>
                        </button>
                    </div>

                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php 
                            foreach($movies as $movie) {
                            ?>
                            <li class="splide__slide">
                                <div class="item item--hero">
                                    <div class="item__cover">
                                        <img src="<?php echo $movie['image']; ?>" alt="">
                                        <a href="details.php?id=<?php echo $movie['movie_id']; ?>" class="item__play">
                                            <i class="ti ti-player-play-filled"></i>
                                        </a>
                                        <span class="item__rate item__rate--green">8.4</span>
                                        <button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
                                    </div>
                                    <div class="item__content">
                                        <h3 class="item__title"><a href="details.php?id=<?php echo $movie['movie_id']; ?>"><?php echo $movie['title']; ?></a></h3>
                                        <span class="item__category">
                                            <a href="details.php?id=<?php echo $movie['movie_id']; ?>"> Director</a>
                                            <a href="#"><?php echo $movie['director']; ?></a>
                                        </span>
                                    </div>
                                </div>
                            </li>
                            <?php 
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end home carousel -->
        </div>
    </div>
</section>
<!-- end home -->

<!-- section -->
<section class="section section--border">
    <div class="container">
        <div class="row">
            <!-- section title -->
            <div class="col-12">
                <div class="section__title-wrap">
                    <h2 class="section__title">Upcoming Movies</h2>
                    <a href="catalog.html" class="section__view section__view--carousel">View All</a>
                </div>
            </div>
            <!-- end section title -->
            
            <!-- carousel -->
            <div class="col-12">
                <div class="section__carousel splide splide--content">
                    <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev" type="button">
                            <i class="ti ti-chevron-left"></i>
                        </button>
                        <button class="splide__arrow splide__arrow--next" type="button">
                            <i class="ti ti-chevron-right"></i>
                        </button>
                    </div>

                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php 
                            foreach($upcoming_movies as $movie) {
                            ?>
                            <li class="splide__slide">
                                <div class="item item--carousel">
                                    <div class="item__cover">
                                        <img src="<?php echo $movie['image']; ?>" alt="">
                                        <a href="details.php?id=<?php echo $movie['movie_id']; ?>" class="item__play">
                                            <i class="ti ti-player-play-filled"></i>
                                        </a>
                                        <span class="item__rate item__rate--green">8.4</span>
                                        <button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
                                    </div>
                                    <div class="item__content">
                                        <h3 class="item__title"><a href="details.php?id=<?php echo $movie['movie_id']; ?>"><?php echo $movie['title']; ?></a></h3>
                                        <span class="item__category">
                                            <a href="#">Action</a>
                                            <a href="#">Thriller</a>
                                        </span>
                                    </div>
                                </div>
                            </li>
                            <?php 
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end carousel -->
        </div>
    </div>
</section>
<!-- end section -->

<!-- section -->
<section class="section section--border">
    <div class="container">
        <div class="row">
            <!-- section title -->
            <div class="col-12">
                <div class="section__title-wrap">
                    <h2 class="section__title">Watch Trailer Now</h2>
                    <a href="catalog.html" class="section__view section__view--carousel">View All</a>
                </div>
            </div>
            <!-- end section title -->

            <!-- carousel -->
            <div class="col-12">
                <div class="section__carousel splide splide--content">
                    <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev" type="button">
                            <i class="ti ti-chevron-left"></i>
                        </button>
                        <button class="splide__arrow splide__arrow--next" type="button">
                            <i class="ti ti-chevron-right"></i>
                        </button>
                    </div>

                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php 
                            foreach($movies as $movie) {
                            ?>
                            <li class="splide__slide">
                                <div class="item item--carousel">
                                    <div class="item__cover">
                                        <img src="<?php echo $movie['image']; ?>" alt="">
                                        <a href="details.php?id=<?php echo $movie['movie_id']; ?>" class="item__play">
                                            <i class="ti ti-player-play-filled"></i>
                                        </a>
                                        <span class="item__rate item__rate--green">8.4</span>
                                        <button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
                                    </div>
                                    <div class="item__content">
                                        <h3 class="item__title"><a href="details.php?id=<?php echo $movie['movie_id']; ?>"><?php echo $movie['title']; ?></a></h3>
                                        <span class="item__category">
                                            <a href="#">Action</a>
                                            <a href="#">Thriller</a>
                                        </span>
                                    </div>
                                </div>
                            </li>
                            <?php 
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end carousel -->
        </div>
    </div>
</section>
<!-- end section -->

<?php 
include("footer.php");
?>
</body>
</html>
