<?php 
ob_start();
include("header.php");

// Ensure session is started once
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = (int) $_SESSION['user_id']; // Cast user_id to integer

// Connect to the database


// Query to get all genders
$sql_gender = "SELECT * FROM `gender`";
$genders = mysqli_query($conn, $sql_gender);

// Query to get all logins
$sql_login = "SELECT * FROM `login`";
$logins = mysqli_query($conn, $sql_login);

// Query to get all roles
$sql_role = "SELECT * FROM `role`";
$roles = mysqli_query($conn, $sql_role);

// Prepare statement to fetch user data based on session's user_id
$sql_user = "SELECT * FROM `user` AS u
            JOIN login AS l ON l.user_id = u.user_id
            WHERE u.user_id = $user_id";

$result = mysqli_query($conn, $sql_user); // Execute the query

// Fetch the user data
if ($user = mysqli_fetch_assoc($result)) {
    $name = $user['name'];
    $email = $user['email'];
    $age = $user['age'];
    $username = $user['username'];
    $password = $user['password'];
    $gender_id = $user['gender_id'];
    $role_id = $user['role_id'];
} else {
    echo "User not found.";
    exit();
}

// Initialize error variables
$nameErr = $emailErr = $ageErr = $usernameErr = $passwordErr = $gender_idErr = $role_idErr = "";

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
   

    // Validate the form fields
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = mysqli_real_escape_string($conn, trim($_POST["name"]));
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = mysqli_real_escape_string($conn, trim($_POST["email"]));
    }

    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = mysqli_real_escape_string($conn, trim($_POST["username"]));
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = mysqli_real_escape_string($conn, trim($_POST["password"]));
    }

    if (empty($_POST["gender_id"])) {
        $gender_idErr = "Gender is required";
    } else {
        $gender_id = (int) $_POST["gender_id"];
    }

    if (empty($_POST["age"])) {
        $ageErr = "Age is required";
    } else {
        $age = (int) $_POST["age"];
    }

  

    // If there are no validation errors
    if (empty($nameErr) && empty($emailErr) && empty($usernameErr) && empty($passwordErr) && empty($ageErr) && empty($gender_idErr) && empty($role_idErr)) {

        // Update user information
        $sql_update_user = "UPDATE `user` 
                            SET `name` = '$name',
                                `email` = '$email',
                                `age` = '$age',
                                `gender_id` = '$gender_id'
                            WHERE `user_id` = $user_id";

        if (mysqli_query($conn, $sql_update_user)) {
            // Update login information
            $sql_update_login = "UPDATE `login`
                                 SET `username` = '$username',
                                     `password` = '$password'
                                 WHERE `user_id` = $user_id";

            if (mysqli_query($conn, $sql_update_login)) {
                header("Location: profile.php");
                exit();
            } else {
                echo "Error updating login information: " . mysqli_error($conn);
            }
        } else {
            echo "Error updating user information: " . mysqli_error($conn);
        }
    }
}
?>

	<!-- page title -->
	<section class="section section--first">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h1 class="section__title section__title--head">My HotFlix</h1>
						<!-- end section title -->

						<!-- breadcrumbs -->
						<ul class="breadcrumbs">
							<li class="breadcrumbs__item"><a href="index.html">Home</a></li>
							<li class="breadcrumbs__item breadcrumbs__item--active">Profile</li>
						</ul>
						<!-- end breadcrumbs -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->

	<!-- content -->
	<div class="content">
		<!-- profile -->
		<div class="profile">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="profile__content">
							<div class="profile__user">
								<div class="profile__avatar">
									<img src="img/user.svg" alt="">
								</div>
								<div class="profile__meta">
									<h3><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
								
								</div>
							</div>

							<!-- content tabs nav -->
							<ul class="nav nav-tabs content__tabs content__tabs--profile" id="content__tabs" role="tablist">
								<li class="nav-item" role="presentation">
                                <button href="#"id="1-tab"  data-bs-toggle="tab" data-bs-target="#tab-1" type="button" role="tab" aria-controls="tab-1" aria-selected="true"><a class="text-light" href="profile.php">booking </a></a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button   id="4-tab" data-bs-toggle="tab" class="active" data-bs-target="#tab-4" type="button" role="tab" aria-controls="tab-4" aria-selected="false"><a class="text-light" href="user-profile.php"> Profile</a></button>
                            </li>

							
							</ul>
							<!-- end content tabs nav -->

							<!-- logout -->
							<button class="profile__logout" type="button">
								<i class="ti ti-logout"></i>
								<span>Logout</span>
							</button>
							<!-- end logout -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end profile -->

		<div class="container">
			<!-- content tabs -->
						

					<div class="row">
						<!-- details form -->
						<div class="col-12">
							<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"  class="sign__form sign__form--full">
							
							<div class="row">
									<div class="col-12">
										<h4 class="sign__title">Profile details</h4>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="sign__group">
											<label class="sign__label" for="username">Username <span class="text-danger">*<?php    echo $usernameErr; ?></span></label>
											<input id="username" type="text" name="username" class="sign__input" value="<?php echo $username ?>">
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="sign__group">
											<label class="sign__label" for="email">Email <span class="text-danger">*<?php    echo $emailErr; ?></span></label>
											<input id="email" type="text" name="email" class="sign__input" value="<?php  echo $email ?>"  >
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="sign__group">
											<label class="sign__label" for="fname">Name <span class="text-danger">*<?php    echo $nameErr; ?></span></label>
											<input id="fname" type="text" name="name" class="sign__input" value="<?php  echo $name ?>">
										</div>
									</div>
									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="sign__group">
											<label class="sign__label" for="age">age <span class="text-danger">*<?php    echo $ageErr; ?></span></label>
											<input id="email" type="tel" name="age" class="sign__input" value="<?php  echo $age ?>"  >
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="sign__group">
											<label class="sign__label" for="password">password <span class="text-danger">*<?php    echo $passwordErr; ?></span></label>
											<input id="fname" type="password" name="password" class="sign__input" value="<?php  echo $password ?>">
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="sign__group">
											<label class="sign__label" for="password">gender <span class="text-danger">*<?php    echo $gender_idErr; ?></span></label>
											<select class="form-select text-light" id="seatClass" name="gender_id" style="background-color: #222028; border-color: #222028; padding:10px;">
											<option value="0" <?php if (empty($gender_id) || $gender_id == "0") echo "selected"; ?>>Select Gender</option>
                                            <?php while ($scr = mysqli_fetch_assoc($genders)) { ?>
                                                <option value="<?php echo $scr['id']; ?>" <?php if (isset($gender_id) && $gender_id == $scr['id']) echo "selected"; ?> ><?php echo $scr['gender']; ?></option>
                                            <?php } ?>
                                            </select>
										</div>
									</div>

									<div class="col-12">
										<input class="sign__btn sign__btn--small" value="Save" type="submit">
									</div>
								</div>
							</form>
						</div>
						<!-- end details form -->

						<!-- end password form -->
					</div>
				</div>
			</div>
			<!-- end content tabs -->
		</div>
	</div>
	<!-- end content -->
<?php
include("footer.php");

?>