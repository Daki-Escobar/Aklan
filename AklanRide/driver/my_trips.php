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

    <title>My Trips</title>

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

        <a href="available_bookings.php">
            📋 Available Bookings
        </a>

        <a href="my_trips.php" class="active">
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

        <h1>My Trips</h1>

        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Passenger</th>
                        <th>Pickup</th>
                        <th>Destination</th>
                        <th>Fare</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach($bookings as $booking){

                    if(($booking["driver"] ?? "") != $driver["name"]){
                        continue;
                    }

                ?>

                <tr>

                    <td><?= $booking["booking_id"] ?></td>

                    <td><?= htmlspecialchars($booking["passenger"]) ?></td>

                    <td><?= htmlspecialchars($booking["pickup"]) ?></td>

                    <td><?= htmlspecialchars($booking["destination"]) ?></td>

                    <td>₱<?= $booking["fare"] ?></td>

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

                    <td>

                        <?php if($booking["status"]=="Accepted"){ ?>

                            <a href="complete_trip.php?id=<?= $booking["booking_id"] ?>" class="complete-btn">

                                ✅ Complete Ride

                            </a>

                        <?php }elseif($booking["status"]=="Completed"){ ?>

                            <span class="completed-btn">

                                ✔ Finished

                            </span>

                        <?php }else{ ?>

                            <span class="status pending">

                                Pending

                            </span>

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