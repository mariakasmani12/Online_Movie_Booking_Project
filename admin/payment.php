<?php

include("admin-layouts/header.php");

// Initialize variables and errors
$cardholder_name = $card_number = $cvv = $card_expiry = $total_amount = $b_id = "";
$cardholder_nameErr = $card_numberErr = $cvvErr = $card_expiryErr = $total_amountErr = $b_idErr = "";
$successMsg = $error = "";

// Fetch booking IDs for the dropdown
$bookingQuery = "SELECT b_id FROM bookings";
$bookingResult = mysqli_query($conn, $bookingQuery);

if (!$bookingResult) {
    $error = "Error fetching bookings: " . mysqli_error($conn);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get input data and sanitize
    $cardholder_name = test_input($_POST['cardholder_name']);
    $card_number = test_input($_POST['card_number']);
    $cvv = test_input($_POST['cvv']);
    $card_expiry = test_input($_POST['card_expiry']);
    $total_amount = test_input($_POST['total_amount']);
    $b_id = test_input($_POST['b_id']);

    // Basic validation
    if (empty($cardholder_name)) {
        $cardholder_nameErr = "Cardholder name is required.";
    }
    if (!ctype_digit($card_number) || strlen($card_number) != 14) {
        $card_numberErr = "Card number must be 14 digits long.";
    }
    if (!ctype_digit($cvv) || strlen($cvv) != 3) {
        $cvvErr = "CVV must be 3 digits long.";
    }
    if (!preg_match("/^(0[1-9]|1[0-2])\/\d{2}$/", $card_expiry)) {
        $card_expiryErr = "Card expiry must be in the format MM/YY.";
    } else {
        // Validate that the expiry date is not in the past
        $currentMonth = date('m');
        $currentYear = date('y');
        list($expMonth, $expYear) = explode('/', $card_expiry);

        if ($expYear < $currentYear || ($expYear == $currentYear && $expMonth < $currentMonth)) {
            $card_expiryErr = "Card expiry date cannot be in the past.";
        }
    }
    if (empty($total_amount) || !is_numeric($total_amount)) {
        $total_amountErr = "Total amount must be a valid number.";
    }
    if (empty($b_id)) {
        $b_idErr = "Booking ID is required.";
    }

    // If no errors, insert data into the payment table
    if (empty($cardholder_nameErr) && empty($card_numberErr) && empty($cvvErr) && empty($card_expiryErr) && empty($total_amountErr) && empty($b_idErr)) {
        $insertQuery = "INSERT INTO payment (cardholder_name, card_number, cvv, card_expiry, total_amount, b_id) 
                        VALUES ('$cardholder_name', '$card_number', '$cvv', '$card_expiry', '$total_amount', '$b_id')";

        if (mysqli_query($conn, $insertQuery)) {
            $successMsg = "Payment done successfully.";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Payment</title>
    <link rel="stylesheet" href="path/to/your/styles.css"> <!-- Ensure this path is correct -->
</head>
<body>
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Add Payment</h2>
                    </div>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($successMsg)): ?>
                    <div class="col-12">
                        <div class="alert alert-success">
                            <?php echo $successMsg; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="sign__form sign__form--add">

                    <div class="row">
                        <div class="col-12">
                            <div class="sign__group">
                                <label for="cardholder_name" class="form-label text-light">Cardholder Name<span class="text-danger">*<?php echo $cardholder_nameErr; ?></span></label>
                                <input type="text" id="cardholder_name" name="cardholder_name" class="sign__input" value="<?php echo htmlspecialchars($cardholder_name); ?>" required>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="sign__group">
                                <label for="card_number" class="form-label text-light">Card Number<span class="text-danger">*<?php echo $card_numberErr; ?></span></label>
                                <input type="text" id="card_number" name="card_number" class="sign__input" maxlength="14" pattern="\d{14}" title="Please enter exactly 14 digits." value="<?php echo htmlspecialchars($card_number); ?>" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="sign__group">
                                <label for="cvv" class="form-label text-light">CVV<span class="text-danger">*<?php echo $cvvErr; ?></span></label>
                                <input type="text" id="cvv" name="cvv" class="sign__input" maxlength="3" pattern="\d{3}" title="Please enter exactly 3 digits." value="<?php echo htmlspecialchars($cvv); ?>" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="sign__group">
                                <label for="card_expiry" class="form-label text-light">Card Expiry<span class="text-danger">*<?php echo $card_expiryErr; ?></span></label>
                                <input type="text" id="card_expiry" name="card_expiry" class="sign__input" placeholder="MM/YY" pattern="(0[1-9]|1[0-2])\/\d{2}" title="Enter expiry in MM/YY format." value="<?php echo htmlspecialchars($card_expiry); ?>" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="sign__group">
                                <label for="total_amount" class="form-label text-light">Total Amount<span class="text-danger">*<?php echo $total_amountErr; ?></span></label>
                                <input type="text" id="total_amount" name="total_amount" class="sign__input" value="<?php echo htmlspecialchars($total_amount); ?>" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="sign__group">
                                <label for="b_id" class="form-label text-light">Booking ID<span class="text-danger">*<?php echo $b_idErr; ?></span></label>
                                <input type="text" id="booking_id" name="b_id" class="sign__input" value="<?php echo htmlspecialchars($total_amount); ?>" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="sign__group">
                                <input type="submit" value="Submit Payment" class="sign__btn sign__btn--small">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
