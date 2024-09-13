<?php
include("admin-layouts/header.php");

$screenId = $theaterId = $screen_name = $total_seats = "";
$theaterIdErr = $screen_nameErr = $total_seatsErr = "";
$successMsg = "";
$error = "";

// Fetch theater options from the database


// Fetch existing screen details
if (isset($_GET['id'])) {
    $screenId = $_GET['id'];

    $sql = "SELECT * FROM screen WHERE screen_id='$screenId'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        $screen_name = $row['screen_name'];
        $total_seats = $row['total_seats_available'];
    } else {
        $error = "Screen not found.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $screen_name = test_input($_POST['screen_name']);
    $total_seats = test_input($_POST['total_seats']);

    if (empty($theaterId)) {
        $theaterIdErr = "Theater must be selected.";
    }

    if (empty($screen_name)) {
        $screen_nameErr = "Screen name is required.";
    } elseif (!preg_match("/^[a-zA-Z0-9 ]*$/", $screen_name)) {
        $screen_nameErr = "Only letters, numbers, and spaces are allowed in the screen name.";
    }

    if (empty($total_seats)) {
        $total_seatsErr = "Total seats are required.";
    } elseif (!is_numeric($total_seats)) {
        $total_seatsErr = "Total seats must be a number.";
    }

    if (empty($theaterIdErr) && empty($screen_nameErr) && empty($total_seatsErr)) {
        $sql = "UPDATE screen 
                SET , screen_name='$screen_name', total_seats='$total_seats' 
                WHERE screen_id='$screenId'";

        if (mysqli_query($conn, $sql)) {
            $successMsg = "Screen updated successfully";
            header("Location: list-screen.php");
            header("Location: list-screen.php");
            exit();
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    } else {
        $error = "Please correct the errors and try again.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit Screen</title>
</head>
<body>
    <!-- main content -->
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Edit Screen</h2>
                    </div>
                </div>

                <?php if (!empty($error)): ?>
                    <p class='error text-danger'>
                        <?php echo $error; ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($successMsg)): ?>
                    <p class='success text-success'>
                        <?php echo $successMsg; ?>
                    </p>
                <?php endif; ?>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . htmlspecialchars($screenId); ?>">
                    <div class="row">
                        <div class="col-12 col-xl-7">
                            <div class="row">
                               
                               

                                
                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="screen_name" class="form-label text-light">SCREEN NAME<span class="text-danger">*<?php echo $screen_nameErr ?></span></label>
                                        <input type="text" class="sign__input" name="screen_name" value="<?php echo htmlspecialchars($screen_name); ?>" required>
                                    </div>
                                </div>

                               
                                <div class="col-12">
                                    <div class="sign__group">
                                        <label for="total_seats" class="form-label text-light">TOTAL SEATS<span class="text-danger">*<?php echo $total_seatsErr ?></span></label>
                                        <input type="text" class="sign__input" name="total_seats" value="<?php echo htmlspecialchars($total_seats); ?>" required>
                                    </div>
                                </div>

                                
                                <div class="col-12">
                                    <input type="submit" value="Update Screen" class="sign__btn sign__btn--small">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
