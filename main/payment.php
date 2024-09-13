<?php 
ob_start();
include("header.php"); 

$total_amount = "";
$booking_id = "";

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['b_id'])) {
    $booking_id = test_input($_GET['b_id']);
    
    // Fetch booking details
    $sql_book = "SELECT * FROM `bookings` WHERE `b_id` = $booking_id";
    $books = mysqli_query($conn, $sql_book);

    if ($books) {
        $show = mysqli_fetch_assoc($books);
        $total_amount = $show['total_amount'];
    } else {
        echo "Error fetching seat details: " . mysqli_error($conn);
    }
}

$cardholder_name = $card_number = $expiry = $cvv = "";
$cardholder_nameErr = $card_numberErr = $expiryErr = $cvvErr = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $booking_id = test_input($_POST['b_id']);

    // Cardholder name validation
    if (empty($_POST["cardholder_name"])) {
        $cardholder_nameErr = "Card holder name is required";
    } else {
        $cardholder_name = test_input($_POST["cardholder_name"]);
    }

    // Card number validation
    if (empty($_POST["card_number"])) {
        $card_numberErr = "Card number is required";
    } else {
        $card_number = test_input($_POST["card_number"]);
    }

    // Expiry validation
    if (empty($_POST["card_expiry"])) {
        $expiryErr = "Card expiry is required";
    } else {
        $expiry = test_input($_POST["card_expiry"]);
    }

    // CVV validation
    if (empty($_POST["cvv"])) {
        $cvvErr = "CVV is required";
    } else {
        $cvv = test_input($_POST["cvv"]);
    }

    // Check if no validation errors
    if (empty($cardholder_nameErr) && empty($card_numberErr) && empty($expiryErr) && empty($cvvErr)) {
        // Insert into payment table
        $sql_payment_insert = "INSERT INTO `payment` (`payment_id`, `cardholder_name`, `card_number`, `cvv`, `card_expiry`, `b_id`)
        VALUES (NULL, '$cardholder_name', '$card_number', '$cvv', '$expiry', '$booking_id')";

        // Execute the query and check for errors
        if (mysqli_query($conn, $sql_payment_insert)) {
            header("Location:payment-conformation.php");
            exit();
        } else {
            // Display error message
            echo "Error inserting payment: " . mysqli_error($conn);
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
                        <h1 class="section__title section__title--head">Payment</h1>
                        <!-- end section title -->

                        <!-- breadcrumbs -->
                        <ul class="breadcrumbs">
                            <li class="breadcrumbs__item"><a href="index.html">Home</a></li>
                            <li class="breadcrumbs__item breadcrumbs__item--active">payment</li>
                        </ul>
                        <!-- end breadcrumbs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- contacts -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <!-- section title -->
                        <div class="col-12">
                            <h2 class="section__title">PAYMENT</h2>
                        </div>
                        <!-- end section title -->
                        
                        <div class="col-10">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="sign__form sign__form--full">
                                <div class="row">
                                <input type="hidden" name="b_id" value="<?php echo $booking_id; ?>">


                                    <div class="col-12">
                                        <div class="sign__group">
                                            <label class="sign__label">CardHolder Name</label>
                                            <input type="text" name="cardholder_name" class="sign__input" >
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="sign__group">
                                            <label class="sign__label">Card Number</label>
                                            <input type="text" name="card_number" class="sign__input" >
                                        </div>
                                    </div>

                                    <div class="col-8">
                                        <div class="sign__group">
                                            <label class="sign__label">expiry</label>
                                            <input type="date" name="card_expiry" class="sign__input">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="sign__group">
                                            <label class="sign__label">cvv</label>
                                            <input type="text" name="cvv" class="sign__input" >
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="sign__group">
											<h2 class="text-warning" style=" margin-left:62px;  margin-top:12px;"> Total Amount :</h2>
                                          
                                        </div>
                                    </div>
									<div class="col-12 col-xl-6">
                                        <div class="sign__group">
                                        
                                            <input type="text" id="totalamount" name="total_amount" class="sign__input" style=" margin-right:62px;  margin-top:12px;" value="<?php echo $total_amount?> Rs" readonly>
                                            
                                        </div>
                                    </div>


                                    

                                   
                                    <div class="col-12">
                                        <input type="submit" name="submit" value="Submit" class="plan__btn">
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contacts -->

    <?php include("footer.php"); ?>
</body>
</html>

<!-- JavaScript for Dynamic Price Calculation -->
<!-- <script>
document.addEventListener("DOMContentLoaded", function() {
    var seatClassSelect = document.getElementById('seatClass');
    var seatQuantityInput = document.getElementById('seatQuantity');
    var totalAmountInput = document.getElementById('totalAmount');
    var totalAmountHiddenInput = document.getElementById('totalAmountHidden');

    function calculateTotal() {
        var seatClass = seatClassSelect.options[seatClassSelect.selectedIndex];
        var pricePerSeat = seatClass.getAttribute('data-price');
        var seatQuantity = seatQuantityInput.value;

        if (pricePerSeat && seatQuantity) {
            var totalAmount = pricePerSeat * seatQuantity;
            totalAmountInput.value = totalAmount.toFixed(2);
            totalAmountHiddenInput.value = totalAmount.toFixed(2);
        } else {
            totalAmountInput.value = '';
            totalAmountHiddenInput.value = '';
        }
    }

    seatClassSelect.addEventListener('change', calculateTotal);
    seatQuantityInput.addEventListener('input', calculateTotal);
});
</script> -->
