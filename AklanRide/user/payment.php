<?php
session_start();

if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit;
}

$booking_id = $_GET["booking_id"] ?? "";
$fare = $_GET["fare"] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>

    <title>Payment - AklanRide</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<div class="payment-container">

    <div class="payment-card">

        <h2>💳 Payment</h2>

        <p>Select your payment method.</p>

        <h1>₱<?php echo $fare; ?></h1>

        <form id="paymentForm">

            <input type="hidden" id="booking_id" value="<?= $booking_id ?>">
            <input type="hidden" id="fare" value="<?= $fare ?>">

            <select id="method" required>

                <option value="">Select Payment</option>

                <option>Cash</option>

                <option>GCash</option>

            </select>

            <button type="submit">

                Confirm Payment

            </button>

        </form>

    </div>

</div>

<script src="../assets/js/script.js"></script>

</body>
</html>