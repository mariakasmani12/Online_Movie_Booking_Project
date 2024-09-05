<?php
include("header.php");
$sql = "SELECT * FROM `movies`";
$movies = mysqli_query($conn, $sql);
?>

<!-- page title -->
<section class="section section--first">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__wrap">
                    <!-- section title -->
                    <h1 class="section__title section__title--head">Movies</h1>
                    <!-- end section title -->

                    <!-- breadcrumbs -->
                    <ul class="breadcrumbs">
                        <li class="breadcrumbs__item"><a href="index.html">Home</a></li>
                        <li class="breadcrumbs__item breadcrumbs__item--active">Movies</li>
                    </ul>
                    <!-- end breadcrumbs -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end page title -->

<!-- catalog -->
<div class="section section--catalog">
    <div class="container">
        <div class="row">
            <?php 
            while ($movie = mysqli_fetch_assoc($movies)) {
            ?>
            <!-- item -->
            <div class="col-md-4 col-sm-6">
                <div class="item">
                    <div class="item__cover">
                        <img src="<?php echo $movie['image'] ?>" alt="">
                        <a href="details.html" class="item__play">
                            <i class="ti ti-player-play-filled"></i>
                        </a>
                        <span class="item__rate item__rate--green">8.4</span>
                        <button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
                    </div>
                    <div class="item__content">
                        <h3 class="item__title"><a href="details.html"><?php echo $movie['title'] ?></a></h3>
                        <span class="item__category">
                            <a href="#">Action</a>
                            <a href="#">Thriller</a>
                        </span>
                    </div>
                </div>
            </div>
            <!-- end item -->
            <?php } ?>
        </div>
        <!-- more -->
        <div class="row">
            <div class="col-12">
                <button class="section__more" type="button">Load more</button>
            </div>
        </div>
        <!-- end more -->
    </div>
</div>
<!-- end catalog -->

<?php include("footer.php"); ?>
