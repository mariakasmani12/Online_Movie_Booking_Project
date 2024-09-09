<?php 
include("connection/connection.php");
include("labraries/function.php");

// Fetch data from the gender, login, and role tables
$sql_gender = "SELECT * FROM `gender`";
$genders = mysqli_query($conn, $sql_gender);

$sql_login = "SELECT * FROM `login`";
$logins = mysqli_query($conn, $sql_login);

$sql_role= "SELECT * FROM `role`";
$roles = mysqli_query($conn, $sql_role);

// Initialize form variables and error variables
$name=$email=$age=$username=$password=$gender_id=$role_id="";
$nameErr=$emailErr=$ageErr=$usernameErr=$passwordErr=$gender_idErr=$role_idErr="";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Name validation
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    // Email validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    // Username validation
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
    }

    // Password validation
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }

    // Gender validation
    if (empty($_POST["gender_id"])) {
        $gender_idErr = "Gender is required";
    } else {
        $gender_id = test_input($_POST["gender_id"]);
    }

    // Age validation
    if (empty($_POST["age"])) {
        $ageErr = "Age is required";
    } else {
        $age = test_input($_POST["age"]);
    }

    // If no validation errors, insert user and login data
    if (empty($nameErr) && empty($emailErr) && empty($usernameErr) && empty($passwordErr) && empty($gender_idErr) && empty($ageErr)) {
        $sql_insert_user = "INSERT INTO `user` (`user_id`, `name`, `email`, `age`, `role_id`, `gender_id`) 
                            VALUES (NULL, '$name', '$email', '$age', '3', " . ($gender_id === NULL ? "NULL" : "'$gender_id'") . ")";
        if (mysqli_query($conn, $sql_insert_user)) {
            $userid = mysqli_insert_id($conn);
            $sql_insert_login = "INSERT INTO `login` (`username`, `password`, `status`, `user_id`) 
                                 VALUES ('$username', '$password', '1', '$userid')";
            if (mysqli_query($conn, $sql_insert_login)) {
                header("Location: login.php");
                exit();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/splide.min.css">
	<link rel="stylesheet" href="css/slimselect.css">
	<link rel="stylesheet" href="css/plyr.css">
	<link rel="stylesheet" href="css/photoswipe.css">
	<link rel="stylesheet" href="css/default-skin.css">
	<link rel="stylesheet" href="css/main.css">

	<!-- Icon font -->
	<link rel="stylesheet" href="webfont/tabler-icons.min.css">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="icon/favicon-32x32.png">

	<meta name="description" content="Online Movies, TV Shows & Cinema HTML Template">
	<title>HotFlix – Sign Up</title>
</head>
<style>
.sign_up .dark { background-color:#222028 } 
</style>
<body>
	<div class="sign section--bg" data-bg="img/bg/section__bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="sign__content">
						<!-- Registration form -->
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="sign__form">
							<a href="index.html" class="sign__logo">
								<img src="img/logo.svg" alt="">
							</a>

							<!-- Name field -->
							<div class="sign__group">
								<label for="name" class="text-light">Name <span class="text-danger">*<?php echo htmlspecialchars($nameErr); ?></span></label>
								<input type="text" class="sign__input" name="name">
							</div>

							<!-- Email field -->
							<div class="sign__group">
								<label for="email" class="text-light">Email <span class="text-danger">*<?php echo htmlspecialchars($emailErr); ?></span></label>
								<input type="text" class="sign__input" name="email">
							</div>

							<!-- Username field -->
							<div class="sign__group">
								<label for="username" class="text-light">Username <span class="text-danger">*<?php echo htmlspecialchars($usernameErr); ?></span></label>
								<input type="text" class="sign__input" name="username">
							</div>

							<!-- Age field -->
							<div class="sign__group">
								<label for="age" class="text-light">Age <span class="text-danger">*<?php echo htmlspecialchars($ageErr); ?></span></label>
								<input type="tel" class="sign__input" name="age">
							</div>

							<!-- Gender field -->
							<div class="sign__group">
								<label for="gender_id" class="text-light">Gender <span class="text-danger">*<?php echo htmlspecialchars($gender_idErr); ?></span></label>
								<select class="form-select border-dark text-light" name="gender_id" aria-label="Default select example" style="background-color: #222028;">
									<option value="">Select Gender</option>
									<?php while ($scr = mysqli_fetch_assoc($genders)) { ?>
										<option value="<?php echo $scr['id']; ?>"><?php echo $scr['gender']; ?></option>
									<?php } ?>
								</select>
							</div>

							<!-- Password field -->
							<div class="sign__group">
								<label for="password" class="text-light">Password <span class="text-danger">*<?php echo htmlspecialchars($passwordErr); ?></span></label>
								<input type="password" class="sign__input" name="password" placeholder="Password">
							</div>

							<!-- Submit button -->
							<input class="sign__btn" type="submit" value="Sign up">

							<!-- Already have an account -->
							<span class="sign__text">Already have an account? <a href="login.php">Sign in!</a></span>
						</form>
						<!-- End registration form -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- JS -->
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/splide.min.js"></script>
	<script src="js/slimselect.min.js"></script>
	<script src="js/smooth-scrollbar.js"></script>
	<script src="js/plyr.min.js"></script>
	<script src="js/photoswipe.min.js"></script>
	<script src="js/photoswipe-ui-default.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
