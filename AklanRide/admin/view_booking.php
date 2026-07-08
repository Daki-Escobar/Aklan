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

$id = $_GET["id"] ?? "";

$bookingData = null;

foreach($bookings as $booking){

    if($booking["booking_id"] == $id){

        $bookingData = $booking;
        break;

    }

}

if(!$bookingData){

    die("Booking not found.");

}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Booking Details</title>

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

        <a href="bookings.php" class="active">
            📋 Bookings
        </a>

        <a href="drivers.php">
            🚗 Drivers
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

        <h1>Booking Details</h1>

        <?php if($bookingData["status"] == "Completed"){ ?>

            <span class="status completed">
                ✅ Completed
            </span>

        <?php }else{ ?>

            <span class="status pending">
                ⏳ Pending
            </span>

        <?php } ?>

        <br><br>

        <div class="table-container">

            <table class="details-table">

                <tr>
                    <th>Booking ID</th>
                    <td>

                        <strong>

                        <?= $bookingData["booking_id"] ?>

                        </strong>

                    </td>
                </tr>

                <tr>
                    <th>Passenger</th>
                    <td><?= htmlspecialchars($bookingData["passenger"]) ?></td>
                </tr>

                <tr>
                    <th>Pickup</th>
                    <td><?= htmlspecialchars($bookingData["pickup"]) ?></td>
                </tr>

                <tr>
                    <th>Destination</th>
                    <td><?= htmlspecialchars($bookingData["destination"]) ?></td>
                </tr>

                <tr>
                    <th>Vehicle</th>
                    <td><?= htmlspecialchars($bookingData["vehicle"]) ?></td>
                </tr>

                <tr>
                    <th>Driver</th>
                    <td>

                        <?php if(($bookingData["driver"] ?? "Not Assigned") == "Not Assigned"){ ?>

                            <span class="status pending">
                                Not Assigned
                            </span>

                        <?php }else{ ?>

                            <?= htmlspecialchars($bookingData["driver"]) ?>

                        <?php } ?>

                    </td>
                </tr>

                <tr>
                    <th>Fare</th>
                    <td>

                        <strong style="color:#16A34A;font-size:18px;">

                        ₱<?= number_format($bookingData["fare"]) ?>

                        </strong>

                    </td>
                </tr>

                <tr>
                    <th>Payment</th>
                    <td><?= htmlspecialchars($bookingData["payment"]) ?></td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td><?= htmlspecialchars($bookingData["status"]) ?></td>
                </tr>

                <tr>
                    <th>Date</th>
                    <td><?= date("M d, Y h:i A", strtotime($bookingData["date"])) ?></td>
                </tr>

            </table>

            <br>

            <a href="bookings.php" class="reset-btn">
                ← Back to Bookings
            </a>

        </div>

    </main>

</div>

</body>

</html>