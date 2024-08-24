<?php
include("admin-layouts/header.php");

// $sql_theater="SELECT * FROM `theater`";
// $theaters=mysqli_query($conn,$sql_theater);

$image=$title=$cast=$director=$duration=$relased_date=$trailer_url=$synopsis=$movieid="";
$titleErr=$castErr=$directorErr=$durationErr=$relased_dateErr="";
$uploadErr = [];
$uploads_dir = '../images';
// $string = implode("", $uploadErr);


if ($_SERVER['REQUEST_METHOD'] == "GET") {
	$movieid= test_input($_GET['movie_id']);


$sql_movie="SELECT * FROM `movies` WHERE movie_id = $movieid";
$movies = mysqli_query($conn,$sql_movie);

$movie = mysqli_fetch_assoc($movies);

$title = $movie['title'];
$cast = $movie['cast'];
$director = $movie['director'];
$duration = $movie['duration'];
$relased_date = $movie['released_date'];
$trailer_url = $movie['trailer_url'];
$synopsis = $movie['synopsis'];
$to= $movie['image'];

}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// prx($_POST);
    $movieid = test_input($_POST["movie_id"]);
    $to = $uploads_dir . '/' . basename($_FILES['image']['name']);
        $from = $_FILES['image']['tmp_name'];
        $size = $_FILES['image']['size'];
    if (empty($_POST["title"])) {
        $titleErr = "title is required";
    } else {
        $title = test_input($_POST["title"]);
    }

    if (empty($_POST["cast"])) {
        $castErr = "cast is required";
    } else {
        $cast = test_input($_POST["cast"]);
    }
	if (empty($_POST["director"])) {
        $directorErr = "director is required";
    } else {
        $director = test_input($_POST["director"]);
    }
	if (empty($_POST["duration"])) {
        $durationErr = "duration is required";
    } else {
        $duration = test_input($_POST["duration"]);
    }
	if (empty($_POST["released_date"])) {
        $relased_dateErr = "relased_date is required";
    } else {
        $relased_date = test_input($_POST["released_date"]);
    }
	if (empty($_POST["trailer_url"])) {
        $trailer_url = " ";
    } else {
        $trailer_url = test_input($_POST["trailer_url"]);
    }
	if (empty($_POST["synopsis"])) {
        $synopsis = " ";
    } else {
        $synopsis = test_input($_POST["synopsis"]);
    }
	 // Check if file already exists


        // Your other checks and operations here

        if (file_exists($to)) {
            array_push($uploadErr, "Sorry, file already exists !");
        }

        if ($size > 2097152) { // 2MB limit
            array_push($uploadErr, "file size must be under 2MB !");
        }
	if (empty($titleErr) && empty($castErr)&& empty($directorErr)&& empty($durationErr)&& empty($relased_dateErr)) {
		$isUploaded = true;
        if(!empty($_FILES)) {
            if(move_uploaded_file($from, $to)) {
                echo ("file uploaded successfully");
            }else{
                $isUploaded = false;
            }
        }
	if($isUploaded){$sql_movie_update="UPDATE `movies` SET 
    `title` = '$title',
    `cast` = '$cast', 
    `director` = '$director',
    `duration` = '$duration',
    `released_date` = '$relased_date', 
    `trailer_url` = '$trailer_url',
    `synopsis` = '$synopsis', 
    `image` = '$to' WHERE `movies`.`movie_id` = $movieid";
	if (mysqli_query($conn, $sql_movie_update)) {
		header("Location: movie-admin.php");
		exit();
	}
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
						<h2>Edit movie</h2>
					</div>
				</div>
				<!-- end main title -->
				<?php
        //   pr($_REQUEST);
		
				?>
				<!-- form -->
				<div class="col-12">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="sign__form sign__form--add" enctype="multipart/form-data">
						<!-- @csrf -->
                        <div class="col-12">
                       <div class="sign__group">
                   <label for="current_image" class="form-label text-light"></label>
                   <div>
                   <img src="<?php echo $to; ?>" alt="Current Movie Image" style="max-width: 200px; height: auto;">
                 </div>
                </div>
                 </div>
					<div class="row">
							<div class="col-12 col-xl-7">
								<div class="row">
                                <div class="col-12">   
                                <div class="invisible">
                            <input type="text" name="to" value="<?php echo $to?>">
                        </div>
                        </div>
                                <div class="col-12">
										<div class="sign__group">
										<label for="movie_id" hidden  class="form-label text-light">moviw id</label>
											<input type="hidden" class="sign__input"  name="movie_id" value="<?php echo $movieid ?>">
										</div>
									</div>
								<div class="col-12">
										<div class="sign__group">
										<label for="image" class="form-label text-light">choose image <span class="text-danger"></span></label>
											<input type="file" class="sign__video-upload" id="sign__video-upload image"  name="image">
										</div>
									</div>
									<div class="col-12">
										<div class="sign__group">
										<label for="title" class="form-label text-light">title<span class="text-danger">*<?php  echo   $titleErr?></span></label>
											<input type="text" class="sign__input"  name="title" value="<?php echo $title?>">
										</div>
									</div>
									<div class="col-12">
										<div class="sign__group">
										<label for="cast" class="form-label text-light">cast</label>
											<textarea id="text"  class="sign__textarea"  name="cast" ><?php echo htmlspecialchars($cast); ?></textarea>
										</div>
									</div>
									<div class="col-12">
										<div class="sign__group">
										<label for="director" class="form-label text-light">director <span class="text-danger">*<?php  echo   $directorErr?></span></label>
											<input type="text" class="sign__input"  name="director" value="<?php echo $director?>">
										</div>
									</div>
									<div class="col-12">
										<div class="sign__group">
										<label for="duration" class="form-label text-light">duration<span class="text-danger">*<?php  echo   $durationErr?></span></label>
											<input type="text"  class="sign__input"  name="duration"placeholder="hh:mm" value="<?php echo $duration?>">
										</div>
									</div>
									<div class="col-12">
										<div class="sign__group">
										<label for="released_date" class="form-label text-light">released_date <span class="text-danger">*<?php  echo   $relased_dateErr?></span></label>
											<input type="date" class="sign__input"  name="released_date" value="<?php echo $relased_date?>">
										</div>
									</div>
									<div class="col-12">
										<div class="sign__group">
										<label for="trailer_url" class="form-label text-light">trailer_url </label>
											<input type="text" class="sign__input"  name="trailer_url" value="<?php echo $trailer_url?>">
										</div>
									</div>

									<div class="col-12">
										<div class="sign__group">
										<label for="synopsis" class="form-label text-light">synopsis</label>
											<textarea id="text"  class="sign__textarea"  name="synopsis" ><?php echo htmlspecialchars($synopsis); ?></textarea>
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

<!-- Mirrored from hotflix.volkovdesign.com/admin/add-item.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Aug 2024 08:51:43 GMT -->
</html>