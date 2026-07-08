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

$file = "../database/driver_requests.json";

$requests = file_exists($file)
    ? json_decode(file_get_contents($file), true)
    : [];
?>

<!DOCTYPE html>
<html>

<head>

    <title>Driver Applications</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="dashboard">

    <aside class="sidebar">

        <div class="sidebar-logo">

            <img src="../assets/images/AklanRide.png">

            <h2>AklanRide</h2>

            <span>Admin Panel</span>

        </div>

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

        <a href="driver_requests.php" class="active">
            📩 Driver Applications
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

        <h1>Driver Applications</h1>

        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Vehicle</th>
                        <th>License</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach($requests as $request){ ?>

                <tr>

                    <td><?= $request["id"] ?></td>

                    <td><?= htmlspecialchars($request["name"]) ?></td>

                    <td><?= htmlspecialchars($request["contact"]) ?></td>

                    <td><?= htmlspecialchars($request["vehicle"]) ?></td>

                    <td><?= htmlspecialchars($request["license"]) ?></td>

                    <td>

                        <span class="status pending">

                            <?= $request["status"] ?>

                        </span>

                    </td>

                    <td>

                        <a href="approve_driver.php?id=<?= $request["id"] ?>" class="complete-btn">

                            ✅ Approve

                        </a>

                        <a href="reject_driver.php?id=<?= $request["id"] ?>"
                           class="delete-btn"
                           onclick="return confirm('Reject this application?')">

                            ❌ Reject

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