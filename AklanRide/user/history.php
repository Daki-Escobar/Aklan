<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION["user"];

$file = "../database/bookings.json";

$bookings = [];

if(file_exists($file)){
    $bookings = json_decode(file_get_contents($file), true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Booking History</title>

<link rel="stylesheet" href="../assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="dashboard">

    <aside class="sidebar">

        <h2>
            🚖 AklanRide
            <p class="logo-subtitle">Ride Booking System</p>
        </h2>
        
        <a href="../index.php">
            🏠 Home
        </a>

        <a href="dashboard.php">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <a href="bookride.php">
            <i class="fa-solid fa-motorcycle"></i>
            Book Ride
        </a>

        <a href="history.php" class="active">
            <i class="fa-solid fa-clock-rotate-left"></i>
            History
        </a>

        <a href="profile.php">
            <i class="fa-solid fa-user"></i>
            Profile
        </a>

        <a href="../logout.php">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

    </aside>

    <main class="main-content">

        <h1>Booking History</h1>

        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>Booking ID</th>
                        <th>Pickup</th>
                        <th>Destination</th>
                        <th>Vehicle</th>
                        <th>Fare</th>
                        <th>Status</th>
                        <th>Receipt</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                        foreach($bookings as $booking){

                            if($booking["user_id"] != $user["id"]){

                                continue;

                            }

                        ?>

                        <tr>

                            <td><?= $booking["booking_id"] ?></td>

                            <td><?= htmlspecialchars($booking["pickup"]) ?></td>

                            <td><?= htmlspecialchars($booking["destination"]) ?></td>

                            <td><?= htmlspecialchars($booking["vehicle"]) ?></td>

                            <td>₱<?= $booking["fare"] ?></td>

                            <td>

                                <?php if($booking["status"] == "Pending"){ ?>

                                    <span class="status pending">Pending</span>

                                <?php }else{ ?>

                                    <span class="status completed">Completed</span>

                                <?php } ?>


                            </td>

                            <td>

                                <a href="receipt.php?id=<?= $booking["booking_id"] ?>" class="receipt-btn">

                                    View Receipt

                                </a>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </main>

</div>

</body>

</html>