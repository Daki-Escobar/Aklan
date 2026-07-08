<?php
session_start();

if(!isset($_SESSION["user"])){

    header("Location: ../user/login.php");
    exit;

}

if($_SESSION["user"]["role"] != "admin"){

    header("Location: ../user/dashboard.php");
    exit;

}

/* ===== ADMIN DATA ===== */

$usersFile = "../database/users.json";
$bookingsFile = "../database/bookings.json";

$users = file_exists($usersFile)
    ? json_decode(file_get_contents($usersFile), true)
    : [];

$bookings = file_exists($bookingsFile)
    ? json_decode(file_get_contents($bookingsFile), true)
    : [];

$totalUsers = count($users);
$totalBookings = count($bookings);

$pending = 0;
$completed = 0;

$availableDrivers = 0;
$busyDrivers = 0;

$driversFile = "../database/drivers.json";

$drivers = file_exists($driversFile)
    ? json_decode(file_get_contents($driversFile), true)
    : [];

foreach($drivers as $driver){

    if(($driver["status"] ?? "") == "Available"){

        $availableDrivers++;

    }

    if(($driver["status"] ?? "") == "Busy"){

        $busyDrivers++;

    }

}

foreach($bookings as $booking){

    if($booking["status"] == "Pending"){
        $pending++;
    }

    if($booking["status"] == "Completed"){
        $completed++;
    }

}

?>

<!DOCTYPE html>
<html>
    <head>

        <title>Admin Dashboard</title>

        <link rel="stylesheet" href="../assets/css/style.css">

    </head>

    <body>

        <div class="dashboard">

            <aside class="sidebar">

                <div class="sidebar-logo">

                    <img src="../assets/images/AklanRide.png" alt="AklanRide Logo">

                    <h2>Admin Panel</h2>

                </div>

                <a href="../index.php">
                    🏠 Home
                </a>

                <a href="dashboard.php" class="active">
                    🏠 Dashboard
                </a>

                <a href="bookings.php">
                    📋 Bookings
                </a>

                <a href="drivers.php">
                    🚗 Drivers
                </a>

                <a href="driver_applications.php">
                    📝 Driver Applications
                </a>

                <a href="users.php">
                    👥 Users
                </a>

                <a href="reports.php">
                    📈 Reports
                </a>

                <a href="../logout.php">
                    🚪 Logout
                </a>

            </aside>

            <main class="main-content">

                <h1>Welcome Administrator 👋</h1>

                <div class="dashboard-cards">

                    <div class="dashboard-card">
                        <h3>Total Users</h3>
                        <h1><?= $totalUsers ?></h1>
                    </div>

                    <div class="dashboard-card">
                        <h3>Total Bookings</h3>
                        <h1><?= $totalBookings ?></h1>
                    </div>

                    <div class="dashboard-card">
                        <h3>Pending</h3>
                        <h1><?= $pending ?></h1>
                    </div>

                    <div class="dashboard-card">
                        <h3>Completed</h3>
                        <h1><?= $completed ?></h1>
                    </div>

                    <div class="dashboard-card">

                        <h3>Available Drivers</h3>

                        <h1><?= $availableDrivers ?></h1>

                    </div>

                    <div class="dashboard-card">

                        <h3>Busy Drivers</h3>

                        <h1><?= $busyDrivers ?></h1>

                    </div>

                </div>

                <div class="table-container">

                    <h2>Recent Bookings</h2>

                    <table>

                        <thead>

                            <tr>

                                <th>ID</th>
                                <th>Passenger</th>
                                <th>Driver</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php

                        $recentBookings = array_reverse($bookings);
                        $count = 0;

                        foreach($recentBookings as $booking){

                            if($count >= 5){
                                break;
                            }

                            $count++;

                        ?>

                            <tr>

                                <td><?= $booking["booking_id"] ?></td>

                                <td><?= htmlspecialchars($booking["passenger"]) ?></td>

                                <td>

                                    <?= htmlspecialchars($booking["driver"] ?? "Not Assigned") ?>

                                </td>

                                <td>

                                    <?php if($booking["status"]=="Pending"){ ?>

                                        <span class="status pending">
                                            Pending
                                        </span>

                                    <?php }else{ ?>

                                        <span class="status completed">
                                            Completed
                                        </span>

                                    <?php } ?>

                                </td>

                                <td>

                                    <a href="view_booking.php?id=<?= $booking["booking_id"] ?>" class="edit-btn">

                                        👁 View

                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                        </tbody>

                    </table>

                </div>

                <div class="filter-box">

                    <form method="GET">

                        <input
                            type="text"
                            name="search"
                            placeholder="🔍 Search passenger..."
                            value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                        >

                        <select name="status">

                            <option value="">All Status</option>

                            <option value="Pending"
                                <?= (($_GET['status'] ?? '') == "Pending") ? "selected" : "" ?>>
                                Pending
                            </option>

                            <option value="Completed"
                                <?= (($_GET['status'] ?? '') == "Completed") ? "selected" : "" ?>>
                                Completed
                            </option>

                        </select>

                        <button type="submit">Filter</button> 
                        
                        <a href="dashboard.php" class="reset-btn">Reset</a>

                    </form>

                </div>

                <div class="table-container">

                    <table>

                        <thead>

                            <tr>

                                <th>ID</th>
                                <th>Passenger</th>
                                <th>Pickup</th>
                                <th>Destination</th>
                                <th>Status</th>
                                <th>Driver</th>
                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php 
                                $search = strtolower(trim($_GET["search"] ?? ""));
                                $statusFilter = $_GET["status"] ?? "";

                                foreach($bookings as $booking){

                                    if($search != "" &&
                                        strpos(strtolower($booking["passenger"]), $search) === false){

                                        continue;

                                    }

                                    if($statusFilter != "" &&
                                        $booking["status"] != $statusFilter){

                                        continue;

                                    }

                            ?>

                            <tr>

                                <td><?= $booking["booking_id"] ?></td>

                                <td><?= htmlspecialchars($booking["passenger"]) ?></td>

                                <td><?= htmlspecialchars($booking["pickup"]) ?></td>

                                <td><?= htmlspecialchars($booking["destination"]) ?></td>

                                <td>

                                    <?php if($booking["status"] == "Pending"){ ?>

                                        <a href="complete_booking.php?id=<?= $booking["booking_id"] ?>" class="complete-btn">

                                            ✔ Complete

                                        </a>

                                    <?php }else{ ?>

                                        <span class="completed-btn">

                                            ✅ Completed

                                        </span>

                                    <?php } ?>

                                </td>

                                <td><?= htmlspecialchars($booking["driver"] ?? "Not Assigned") ?></td>

                                <td>

                                    <?php if($booking["status"] == "Pending"){ ?>

                                        <a href="assign_driver.php?id=<?= $booking["booking_id"] ?>">
                                            Assign Driver
                                        </a>
                                        |
                                        <a href="complete_booking.php?id=<?= $booking["booking_id"] ?>">
                                            Complete
                                        </a>

                                    <?php }else{ ?>

                                        ✅

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