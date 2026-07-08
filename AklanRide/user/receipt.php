<?php
session_start();

if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit;
}

if(!isset($_GET["id"])){
    die("Invalid Receipt.");
}

$file = "../database/bookings.json";
$bookings = json_decode(file_get_contents($file), true);

$receipt = null;

foreach($bookings as $booking){

    if($booking["booking_id"] == $_GET["id"]){

        if($booking["user_id"] == $_SESSION["user"]["id"]){

            $receipt = $booking;
            break;

        }

    }

}

if(!$receipt){
    die("Receipt not found.");
}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Receipt</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="receipt-container">

    <div class="receipt-card">

        <h1>🚖 AKLANRIDE</h1>

        <hr>

        <p><strong>Booking ID:</strong> <?= $receipt["booking_id"] ?></p>

        <p><strong>Passenger:</strong> <?= htmlspecialchars($receipt["passenger"]) ?></p>

        <p><strong>Pickup:</strong> <?= htmlspecialchars($receipt["pickup"]) ?></p>

        <p><strong>Destination:</strong> <?= htmlspecialchars($receipt["destination"]) ?></p>

        <p><strong>Vehicle:</strong> <?= htmlspecialchars($receipt["vehicle"]) ?></p>

        <p><strong>Payment:</strong> <?= htmlspecialchars($receipt["payment"]) ?></p>

        <p><strong>Fare:</strong> ₱<?= $receipt["fare"] ?></p>

        <p><strong>Status:</strong> <?= htmlspecialchars($receipt["status"]) ?></p>

        <p><strong>Driver:</strong> <?= htmlspecialchars($receipt["driver"]) ?></p>

        <p><strong>Date:</strong> <?= htmlspecialchars($receipt["date"]) ?></p>

        <hr>

        <button onclick="window.print()">
            🖨 Print Receipt
        </button>

        <br><br>

        <a href="history.php">⬅ Back to History</a>

    </div>

</div>

</body>

</html>