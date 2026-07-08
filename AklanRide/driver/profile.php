<?php
session_start();

if(!isset($_SESSION["driver"])){
    header("Location: login.php");
    exit;
}

$driver = $_SESSION["driver"];
?>

<!DOCTYPE html>
<html>

<head>

    <title>My Profile</title>

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

        <a href="my_trips.php">
            🚗 My Trips
        </a>

        <a href="profile.php" class="active">
            👤 My Profile
        </a>

        <a href="../logout.php">
            🚪 Logout
        </a>

    </aside>

    <main class="main-content">

        <h1>👤 Driver Profile</h1>

        <div class="profile-card">

            <table class="profile-table">

                <tr>
                    <th>Full Name</th>
                    <td><?= htmlspecialchars($driver["name"]) ?></td>
                </tr>

                <tr>
                    <th>Username</th>
                    <td><?= htmlspecialchars($driver["username"]) ?></td>
                </tr>

                <tr>
                    <th>Contact</th>
                    <td><?= htmlspecialchars($driver["contact"]) ?></td>
                </tr>

                <tr>
                    <th>Address</th>
                    <td><?= htmlspecialchars($driver["address"]) ?></td>
                </tr>

                <tr>
                    <th>Vehicle</th>
                    <td><?= htmlspecialchars($driver["vehicle"]) ?></td>
                </tr>

                <tr>
                    <th>License</th>
                    <td><?= htmlspecialchars($driver["license"]) ?></td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td><?= htmlspecialchars($driver["status"]) ?></td>
                </tr>

            </table>

            <div style="margin-top:25px;">

                <a href="edit_profile.php" class="edit-btn">

                    ✏ Edit Profile

                </a>

            </div>

        </div>

    </main>

</div>

</body>

</html>