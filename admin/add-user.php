<?php
include("admin-layouts/header.php");

// Fetch screens and theaters
$sql_gender = "SELECT * FROM `gender`";
$genders = mysqli_query($conn, $sql_gender);

$sql_login = "SELECT * FROM `login`";
$logins = mysqli_query($conn, $sql_login);

$sql_role= "SELECT * FROM `role`";
$roles = mysqli_query($conn, $sql_role);

$name=$email=$age=$username=$password=$gender_id=$role_id="";
$nameErr=$emailErr=$ageErr=$usernameErr=$passwordErr=$gender_idErr=$role_idErr="";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "email is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["username"])) {
        $usernameErr = "movie is required";
    } else {
        $username = test_input($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "password is required";
    } else {
        $password = test_input($_POST["password"]);
    }

    if (empty($_POST["gender_id"])) {
        $gender_idErr = "gender is required";
    } else {
        $gender_id = test_input($_POST["gender_id"]);
    }
    if (empty($_POST["age"])) {
        $ageErr = "age is required";
    } else {
        $age = test_input($_POST["age"]);
    }
 if (empty($_POST["role_id"])) {
        $role_idErr = "role is required";
    } else {
        $role_id = test_input($_POST["role_id"]);
    }
    if (empty($theaterErr) && empty($screenErr) && empty($moviesErr) && empty($show_timeErr) && empty($show_dateErr)) {
        $sql_insert_user = "INSERT INTO `user` (`user_id`, `name`, `email`, `age`, `role_id`, `gender_id`) VALUES (NULL, '$name', '$email', '$age', '$role_id', '$gender_id');";
  
        if (mysqli_query($conn, $sql_insert_user)) {
          $userid = mysqli_insert_id($conn);
          $sql_insert_login = "INSERT INTO `login` (`username`, `password`, `status`, `user_id`) VALUES ('$username', '$password', '1', '$userid')";
          if (mysqli_query($conn, $sql_insert_login)) {
            header("Location: user-admin.php");
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
                    <h2>Add reviews</h2>
                </div>
            </div>
            <!-- end main title -->

            <!-- form -->
            <div class="col-12">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="sign__form sign__form--add">
                    <div class="row">
                        <div class="col-12 col-xl-7">
                            <div class="row">
                            <div class="col-12">
										<div class="sign__group">
                                        <label for="name" class="form-label text-light">Name <span class="text-danger">*<?php    echo $nameErr; ?></span></label>
											<input type="text" class="sign__input" name="name">
										</div>
									</div>
                                    <div class="col-12">
										<div class="sign__group">
                                        <label for="email" class="form-label text-light">Email <span class="text-danger">*<?php    echo $emailErr; ?></span></label>
											<input type="email" class="sign__input" name="email">
										</div>
									</div>
                                    <div class="col-12">
										<div class="sign__group">
                                        <label for="username" class="form-label text-light">username <span class="text-danger">*<?php    echo $usernameErr; ?></span></label>
											<input type="text" class="sign__input" name="username">
										</div>
									</div>
                                    <div class="col-12">
										<div class="sign__group">
                                        <label for="password" class="form-label text-light">password <span class="text-danger">*<?php    echo $passwordErr; ?></span></label>
											<input type="pasword" class="sign__input" name="password">
										</div>
									</div>
                                    <div class="col-12">
										<div class="sign__group">
                                        <label for="age" class="form-label text-light">age <span class="text-danger">*<?php    echo $ageErr; ?></span></label>
											<input type="tel" class="sign__input" name="age">
										</div>
									</div>

                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="gender_id" class="form-label text-light">Gender <span class="text-danger">*<?php    echo $gender_idErr; ?></span></label>
                                        <select class="sign__selectjs" id="sign__director" name="gender_id">
                                            <option value="">Select Gender</option>
                                            <?php while ($scr = mysqli_fetch_assoc($genders)) { ?>
                                                <option value="<?php echo $scr['id']; ?>"><?php echo $scr['gender']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                       
                                       <div class="col-12">
										<div class="sign__group">
                                        <label for="role_id" class="form-label text-light"> Role <span class="text-danger">*<?php    echo $role_idErr; ?></span></label>
											<select class="sign__selectjs" id="sign__country" name="role_id"> 
												<option value="">seelct role</option>
                                                <?php  while($st= mysqli_fetch_assoc($roles)){?>
												<option value="<?php echo $st['role_id']  ?>"> <?php echo $st["role"] ?></option>
                                            <?php } ?>
                                         </select>
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
</html>
