<?php
session_start();

if(!isset($_SESSION["driver"])){
    header("Location: login.php");
    exit;
}

$driver = $_SESSION["driver"];

$file = "../database/bookings.json";

$bookings = file_exists($file)
    ? json_decode(file_get_contents($file), true)
    : [];

$totalTrips = 0;
$completedTrips = 0;
$availableBookings = 0;
$totalEarnings = 0;

foreach($bookings as $booking){

    if(($booking["driver"] ?? "Not Assigned") == "Not Assigned"
        && $booking["status"] == "Pending"){

        $availableBookings++;

    }

    if(($booking["driver"] ?? "") == $driver["name"]){

        $totalTrips++;

        if($booking["status"] == "Completed"){

            $completedTrips++;

            $totalEarnings += $booking["fare"];

        }

    }

}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Driver Dashboard</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="dashboard">

    <aside class="sidebar">

        <div class="sidebar-logo">

            <img src="../assets/images/AklanRide.png">

            <h2>Driver Panel</h2>

        </div>

        <a href="dashboard.php" class="active">
            🏠 Dashboard
        </a>

        <a href="available_bookings.php">
            📋 Available Bookings
        </a>

        <a href="my_trips.php">
            🚗 My Trips
        </a>

        <a href="profile.php">
            👤 My Profile
        </a>

        <a href="../logout.php">
            🚪 Logout
        </a>

    </aside>

    <main class="main-content">

        <h1>
            Welcome,
            <?= htmlspecialchars($driver["name"]) ?> 👋
        </h1>

        <div class="dashboard-cards">

            <div class="dashboard-card">

                <h3>📋 Available Bookings</h3>

                <h1><?= $availableBookings ?></h1>

            </div>

            <div class="dashboard-card">

                <h3>🚗 My Trips</h3>

                <h1><?= $totalTrips ?></h1>

            </div>

            <div class="dashboard-card">

                <h3>✅ Completed Trips</h3>

                <h1><?= $completedTrips ?></h1>

            </div>

            <div class="dashboard-card">

                <h3>💰 Total Earnings</h3>

                <h1>₱<?= number_format($totalEarnings) ?></h1>

            </div>

        </div>

        <h2 style="margin:30px 0 15px;">📋 Recent Trips</h2>

        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>Booking ID</th>
                        <th>Passenger</th>
                        <th>Destination</th>
                        <th>Fare</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                <?php

                $hasTrips = false;

                foreach(array_reverse($bookings) as $booking){

                    if(($booking["driver"] ?? "") != $driver["name"]){
                        continue;
                    }

                    $hasTrips = true;

                ?>

                    <tr>

                        <td><?= $booking["booking_id"] ?></td>

                        <td><?= htmlspecialchars($booking["passenger"]) ?></td>

                        <td><?= htmlspecialchars($booking["destination"]) ?></td>

                        <td>₱<?= number_format($booking["fare"]) ?></td>

                        <td>

                            <?php if($booking["status"]=="Accepted"){ ?>

                                <span class="status accepted">

                                    Accepted

                                </span>

                            <?php }elseif($booking["status"]=="Completed"){ ?>

                                <span class="status completed">

                                    Completed

                                </span>

                            <?php }else{ ?>

                                <span class="status pending">

                                    Pending

                                </span>

                            <?php } ?>

                        </td>

                    </tr>

                <?php } ?>

                <?php if(!$hasTrips){ ?>

                    <tr>

                        <td colspan="5" style="text-align:center;padding:20px;">

                            No trips found.

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