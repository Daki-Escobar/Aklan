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

$bookingsFile = "../database/bookings.json";
$driversFile = "../database/drivers.json";

$bookings = file_exists($bookingsFile)
    ? json_decode(file_get_contents($bookingsFile), true)
    : [];

$drivers = file_exists($driversFile)
    ? json_decode(file_get_contents($driversFile), true)
    : [];

$id = $_GET["id"] ?? "";

$bookingIndex = -1;

foreach($bookings as $index => $booking){

    if($booking["booking_id"] == $id){

        $bookingIndex = $index;
        break;

    }

}

if($bookingIndex == -1){

    die("Booking not found.");

}

$currentBooking = $bookings[$bookingIndex];

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $driverName = $_POST["driver"];

    $bookings[$bookingIndex]["driver"] = $driverName;

    foreach($drivers as &$driver){

        if($driver["name"] == $driverName){

            $driver["status"] = "Busy";

        }

    }

    file_put_contents($bookingsFile, json_encode($bookings, JSON_PRETTY_PRINT));
    file_put_contents($driversFile, json_encode($drivers, JSON_PRETTY_PRINT));

    header("Location: bookings.php");
    exit;

}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Assign Driver</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="dashboard">

    <aside class="sidebar">

        <h2>🚖 Admin Panel</h2>

        <a href="dashboard.php">
            🏠 Dashboard
        </a>

        <a href="bookings.php" class="active">
            📋 Bookings
        </a>

        <a href="drivers.php">
            🚗 Drivers
        </a>

        <a href="driver_requests.php">
            📩 Driver Applications
        </a>

        <a href="users.php">
            👥 Users
        </a>

        <a href="../logout.php">
            🚪 Logout
        </a>

    </aside>

    <main class="main-content">

        <div class="form-container">

            <h1>Assign Driver</h1>

            <p><strong>Booking ID:</strong> <?= $currentBooking["booking_id"] ?></p>

            <p><strong>Passenger:</strong> <?= htmlspecialchars($currentBooking["passenger"]) ?></p>

            <p><strong>Pickup:</strong> <?= htmlspecialchars($currentBooking["pickup"]) ?></p>

            <p><strong>Destination:</strong> <?= htmlspecialchars($currentBooking["destination"]) ?></p>

            <p><strong>Vehicle:</strong> <?= htmlspecialchars($currentBooking["vehicle"]) ?></p>

            <br>

            <form method="POST">

                <label>Select Driver</label>

                <select name="driver" required>

                    <option value="">-- Select Driver --</option>

                    <?php foreach($drivers as $driver){ ?>

                        <?php if($driver["status"] == "Available"){ ?>

                            <option value="<?= htmlspecialchars($driver["name"]) ?>">

                                <?= htmlspecialchars($driver["name"]) ?>

                                (<?= htmlspecialchars($driver["vehicle"]) ?>)

                            </option>

                        <?php } ?>

                    <?php } ?>

                </select>

                <br><br>

                <button type="submit">

                    Assign Driver

                </button>

            </form>

        </div>

    </main>

</div>

</body>

</html>