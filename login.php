<?php 
include("connection/connection.php");
include("labraries/function.php");

session_start();

$usernames = $password = "";
$usernamesErr = $passwordErr = $loginErr = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST["username"])) {
        $usernamesErr = "Username is required";
    } else {
        $usernames = test_input($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }

    if (empty($usernamesErr) && empty($passwordErr)) {
        // Escape the username to prevent SQL injection
        $usernames = mysqli_real_escape_string($conn, $usernames);

        $logins_sql = "SELECT *
                       FROM login AS l 
                       LEFT JOIN user AS u ON l.user_id = u.user_id 
                       LEFT JOIN role AS r ON u.role_id = r.role_id
                       WHERE l.username = '$usernames'";

        $result = mysqli_query($conn, $logins_sql);

        if ($result && $login = mysqli_fetch_assoc($result)) {
            // Print stored password for debugging
            echo "Entered Password: $password <br>";
            echo "Stored Password: " . $login['password'] . "<br>";

            // Verify password (assuming passwords are hashed)
            if ($password==$login['password']) { 
                // Passwords match, continue
                $_SESSION["login"] = true;
                $_SESSION["user_id"] = $login['user_id'];
                $_SESSION["username"] = $login['username'];
                $_SESSION["name"] = $login['name'];
                $_SESSION["role_id"] = $login['role_id'];
                $_SESSION["role"] = $login['role'];

                if ($_SESSION['login'] && $_SESSION['role_id'] == 1) {
                    header("Location: admin/index.php");
                    exit();
                } else {
                    header("Location: main/index2.php");
                    exit();
                }
            } else {
                $loginErr = "Password is incorrect!";
            }
        } else {
            $loginErr = "Username is incorrect!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from hotflix.volkovdesign.com/main/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Aug 2024 08:40:08 GMT -->
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
	<meta name="keywords" content="">
	<meta name="author" content="Dmitry Volkov">
	<title>HotFlix – Online Movies, TV Shows & Cinema HTML Template</title>
</head>

<body>
<div class="sign section--bg" data-bg="img/bg/section__bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="sign__content">
						<!-- authorization form -->
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="sign__form">
							<a href="index.html" class="sign__logo">
								<img src="img/logo.svg" alt="">
							</a>

							<div class="sign__group">
                                <label for="username" class="text-light">Username <span class="text-danger">*<?php echo htmlspecialchars($usernamesErr); ?></span></label>
								<input type="text" class="sign__input" placeholder="Username" name="username" value="<?php echo htmlspecialchars($usernames); ?>">
							</div>

							<div class="sign__group">
                                <label for="password" class="text-light">Password <span class="text-danger">*<?php echo htmlspecialchars($passwordErr); ?></span></label>
								<input type="password" class="sign__input" placeholder="Password" name="password">
							</div>

                            <!-- Display login error if any -->
                            <?php if(!empty($loginErr)): ?>
                                <div class="text-danger"><?php echo htmlspecialchars($loginErr); ?></div>
                            <?php endif; ?>

							<div class="sign__group sign__group--checkbox">
								<input id="remember" name="remember" type="checkbox" checked="checked">
								<label for="remember">Remember Me</label>
							</div>

							<input class="sign__btn" type="submit" value="Sign in">

							<span class="sign__text">Don't have an account? <a href="signup.html">Sign up!</a></span>

							<span class="sign__text"><a href="forgot.html">Forgot password?</a></span>
						</form>
						<!-- end authorization form -->
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
</body>
</html>
