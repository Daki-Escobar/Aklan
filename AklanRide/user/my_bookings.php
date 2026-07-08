<?php
session_start();

if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit;
}

$file = "../database/bookings.json";

$bookings = file_exists($file)
    ? json_decode(file_get_contents($file), true)
    : [];

$currentUser = $_SESSION["user"]["name"];
?>

<!DOCTYPE html>
<html>

<head>

    <title>My Bookings</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="dashboard">

    <aside class="sidebar">

        <h2>🚖 User Panel</h2>

        <a href="../index.php">
            🏠 Home
        </a>

        <a href="dashboard.php">
            🚖 Book Ride
        </a>

        <a href="my_bookings.php" class="active">
            📋 My Bookings
        </a>

        <a href="../logout.php">
            🚪 Logout
        </a>

    </aside>

    <main class="main-content">

        <h1>My Bookings</h1>

        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Pickup</th>
                        <th>Destination</th>
                        <th>Vehicle</th>
                        <th>Fare</th>
                        <th>Driver</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>
                    <?php

                    foreach($bookings as $booking){

                        if($booking["passenger"] != $currentUser){
                            continue;
                        }

                    ?>

                    <tr>

                        <td><?= $booking["booking_id"] ?></td>

                        <td><?= htmlspecialchars($booking["pickup"]) ?></td>

                        <td><?= htmlspecialchars($booking["destination"]) ?></td>

                        <td><?= htmlspecialchars($booking["vehicle"]) ?></td>

                        <td>₱<?= $booking["fare"] ?></td>

                        <td><?= htmlspecialchars($booking["driver"] ?? "Not Assigned") ?></td>

                        <td>

                            <?php if($booking["status"] == "Pending"){ ?>

                                <span class="status pending">

                                    Pending

                                </span>

                            <?php }elseif($booking["status"] == "Completed"){ ?>

                                <span class="status completed">

                                    Completed

                                </span>

                            <?php }elseif($booking["status"] == "Cancelled"){ ?>

                                <span class="status cancelled">

                                    Cancelled

                                </span>

                            <?php } ?>

                        </td>

                        <td><?= date("M d, Y h:i A", strtotime($booking["date"])) ?></td>

                        <td>

                            <a href="view_booking.php?id=<?= $booking["booking_id"] ?>" class="edit-btn">
                                👁 View
                            </a>

                            <?php if($booking["status"] == "Pending"){ ?>

                                <a href="cancel_booking.php?id=<?= $booking["booking_id"] ?>"
                                class="delete-btn"
                                onclick="return confirm('Cancel this booking?')">

                                    ❌ Cancel

                                </a>

                            <?php } ?>

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