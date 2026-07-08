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

$file = "../database/bookings.json";

$bookings = file_exists($file)
    ? json_decode(file_get_contents($file), true)
    : [];
?>

<!DOCTYPE html>
<html>

<head>

    <title>Booking Management</title>

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

        <a href="bookings.php" class="active">
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

        <h1>Booking Management</h1>

        <!-- FILTER -->

        <div class="filter-box">

            <form method="GET">

                <input
                    type="text"
                    name="search"
                    placeholder="🔍 Search passenger..."
                    value="<?= htmlspecialchars($_GET["search"] ?? "") ?>"
                >

                <select name="status">

                    <option value="">All Status</option>

                    <option value="Pending"
                        <?= (($_GET["status"] ?? "")=="Pending") ? "selected" : "" ?>>
                        Pending
                    </option>

                    <option value="Completed"
                        <?= (($_GET["status"] ?? "")=="Completed") ? "selected" : "" ?>>
                        Completed
                    </option>

                </select>

                <button type="submit">Filter</button>

                <a href="bookings.php" class="reset-btn">
                    Reset
                </a>

            </form>

        </div>

        <!-- TABLE -->

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
                        <th>Payment</th>
                        <th>Driver</th>
                        <th>Status</th>
                        <th>Date</th>
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

                    <td><?= htmlspecialchars($booking["vehicle"]) ?></td>

                    <td>₱<?= $booking["fare"] ?></td>

                    <td><?= htmlspecialchars($booking["payment"]) ?></td>

                    <td>

                        <?php

                        if(($booking["driver"] ?? "Not Assigned") == "Not Assigned"){

                            echo "<span class='status pending'>Not Assigned</span>";

                        }else{

                            echo "<span class='status completed'>".
                                    htmlspecialchars($booking["driver"]).
                                "</span>";

                        }

                        ?>

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
                        <?= date("M d, Y h:i A", strtotime($booking["date"])) ?>
                    </td>

                    <td>

                        <div class="action-buttons">

                            <a href="view_booking.php?id=<?= $booking["booking_id"] ?>" class="edit-btn">
                                👁 View
                            </a>

                            <?php if($booking["status"] == "Pending"){ ?>

                                <?php if(($booking["driver"] ?? "Not Assigned") == "Not Assigned"){ ?>

                                    <a href="assign_driver.php?id=<?= $booking["booking_id"] ?>" class="edit-btn">
                                        🚗 Assign Driver
                                    </a>

                                <?php }else{ ?>

                                    <a href="complete_booking.php?id=<?= $booking["booking_id"] ?>" class="complete-btn">
                                        ✔ Complete
                                    </a>

                                <?php } ?>

                                <a href="delete_booking.php?id=<?= $booking["booking_id"] ?>"
                                class="delete-btn"
                                onclick="return confirm('Are you sure you want to delete this booking?')">

                                    🗑 Delete

                                </a>

                            <?php }else{ ?>

                                <span class="completed-btn">
                                    ✅ Completed
                                </span>

                            <?php } ?>

                        </div>

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