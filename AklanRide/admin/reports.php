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

$users = file_exists("../database/users.json")
    ? json_decode(file_get_contents("../database/users.json"), true)
    : [];

$drivers = file_exists("../database/drivers.json")
    ? json_decode(file_get_contents("../database/drivers.json"), true)
    : [];

$bookings = file_exists("../database/bookings.json")
    ? json_decode(file_get_contents("../database/bookings.json"), true)
    : [];

$totalUsers = count($users);
$totalDrivers = count($drivers);
$totalBookings = count($bookings);

$pending = 0;
$completed = 0;
$totalRevenue = 0;

foreach($bookings as $booking){

    if($booking["status"] == "Pending"){
        $pending++;
    }

    if($booking["status"] == "Completed"){

        $completed++;
        $totalRevenue += (int)$booking["fare"];

    }

}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Reports</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="dashboard">

    <aside class="sidebar">

        <h2>🚖 Admin Panel</h2>

        <a href="../index.php">
            🏠 Home
        </a>

        <a href="dashboard.php">
            📊 Dashboard
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

        <a href="reports.php" class="active">
            📈 Reports
        </a>

        <a href="../logout.php">
            🚪 Logout
        </a>

    </aside>

    <main class="main-content">

        <h1>System Reports</h1>

        <div style="margin:20px 0;">

            <button class="edit-btn" onclick="window.print()">
                🖨 Print Report
            </button>

        </div>

        <div class="dashboard-cards">

            <div class="dashboard-card">

                <h3>Total Users</h3>

                <h1><?= $totalUsers ?></h1>

            </div>

            <div class="dashboard-card">

                <h3>Total Drivers</h3>

                <h1><?= $totalDrivers ?></h1>

            </div>

            <div class="dashboard-card">

                <h3>Total Bookings</h3>

                <h1><?= $totalBookings ?></h1>

            </div>

            <div class="dashboard-card">

                <h3>Completed</h3>

                <h1><?= $completed ?></h1>

            </div>

            <div class="dashboard-card">

                <h3>Pending</h3>

                <h1><?= $pending ?></h1>

            </div>

            <div class="dashboard-card">

                <h3>Total Revenue</h3>

                <h1>₱<?= number_format($totalRevenue) ?></h1>

            </div>

        </div>

    </main>

</div>

</body>

</html>