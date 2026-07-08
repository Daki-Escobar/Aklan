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

$file = "../database/drivers.json";

$drivers = [];

if(file_exists($file)){

    $drivers = json_decode(file_get_contents($file), true);

}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Driver Management</title>

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
            🏠 Dashboard
        </a>

        <a href="bookings.php">
            📋 Bookings
        </a>

        <a href="drivers.php" class="active">
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

        <div class="page-header">

            <h1>Driver Management</h1>

            <a href="add_driver.php" class="btn-primary">

                + Add Driver

            </a>

        </div>

        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Vehicle</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach($drivers as $driver){ ?>

                <tr>

                    <td><?= $driver["id"] ?></td>

                    <td><?= htmlspecialchars($driver["name"]) ?></td>

                    <td><?= htmlspecialchars($driver["contact"]) ?></td>

                    <td><?= htmlspecialchars($driver["vehicle"]) ?></td>

                    <td><?= htmlspecialchars($driver["status"]) ?></td>

                   <td>

                        <a href="edit_driver.php?id=<?= $driver["id"] ?>" class="edit-btn">
                            ✏ Edit
                        </a>

                        <a href="delete_driver.php?id=<?= $driver["id"] ?>"
                        class="delete-btn"
                        onclick="return confirm('Delete this driver?')">
                            🗑 Delete
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