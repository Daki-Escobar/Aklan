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

$file = "../database/users.json";

$users = file_exists($file)
    ? json_decode(file_get_contents($file), true)
    : [];
?>

<!DOCTYPE html>
<html>

<head>

    <title>User Management</title>

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

        <a href="drivers.php">
            🚗 Drivers
        </a>

        <a href="driver_applications.php">
            📝 Driver Applications
        </a>

        <a href="users.php" class="active">
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

        <h1>User Management</h1>

        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach($users as $user){ ?>

                <tr>

                    <td><?= $user["id"] ?></td>

                    <td><?= htmlspecialchars($user["name"]) ?></td>

                    <td><?= htmlspecialchars($user["email"]) ?></td>

                    <td><?= ucfirst($user["role"]) ?></td>

                    <td>

                        <?php if($user["role"] != "admin"){ ?>

                            <a href="delete_user.php?id=<?= $user["id"] ?>"
                            class="delete-btn"
                            onclick="return confirm('Delete this user?')">

                                🗑 Delete

                            </a>

                        <?php }else{ ?>

                            <span class="completed-btn">

                                🔒 Protected

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