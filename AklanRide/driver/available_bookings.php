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
?>

<!DOCTYPE html>
<html>

<head>

    <title>Available Bookings</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="dashboard">

    <aside class="sidebar">

        <div class="sidebar-logo">

            <img src="../assets/images/AklanRide.png">

            <h2>Driver Panel</h2>

        </div>

        <a href="dashboard.php">
            🏠 Dashboard
        </a>

        <a href="available_bookings.php" class="active">
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

        <h1>Available Bookings</h1>

        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Passenger</th>
                        <th>Pickup</th>
                        <th>Destination</th>
                        <th>Vehicle</th>
                        <th>Fare</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach($bookings as $booking){

                    if(
                        ($booking["driver"] ?? "Not Assigned") != "Not Assigned"
                        || $booking["status"] != "Pending"
                    ){
                        continue;
                    }

                ?>

                <tr>

                    <td><?= $booking["booking_id"] ?></td>

                    <td><?= htmlspecialchars($booking["passenger"]) ?></td>

                    <td><?= htmlspecialchars($booking["pickup"]) ?></td>

                    <td><?= htmlspecialchars($booking["destination"]) ?></td>

                    <td><?= htmlspecialchars($booking["vehicle"]) ?></td>

                    <td>₱<?= $booking["fare"] ?></td>

                    <td>

                        <a href="accept_booking.php?id=<?= $booking["booking_id"] ?>"
                           class="complete-btn">

                            🚖 Accept Ride

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