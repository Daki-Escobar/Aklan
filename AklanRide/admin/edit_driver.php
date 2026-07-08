<?php
session_start();

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] != "admin"){
    header("Location: ../user/login.php");
    exit;
}

$file = "../database/drivers.json";
$drivers = json_decode(file_get_contents($file), true);

$id = $_GET["id"] ?? "";

$driverIndex = -1;

foreach($drivers as $index => $driver){

    if($driver["id"] == $id){

        $driverIndex = $index;
        break;

    }

}

if($driverIndex == -1){

    die("Driver not found.");

}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $drivers[$driverIndex]["name"] = trim($_POST["name"]);
    $drivers[$driverIndex]["contact"] = trim($_POST["contact"]);
    $drivers[$driverIndex]["vehicle"] = $_POST["vehicle"];
    $drivers[$driverIndex]["status"] = $_POST["status"];

    file_put_contents($file, json_encode($drivers, JSON_PRETTY_PRINT));

    header("Location: drivers.php");
    exit;

}

$driver = $drivers[$driverIndex];
?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Driver</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="dashboard">

    <aside class="sidebar">

        <h2>🚖 Admin Panel</h2>

        <a href="dashboard.php">🏠 Dashboard</a>

        <a href="bookings.php">
            📋 Bookings
        </a>

        <a href="drivers.php" class="active">🚗 Drivers</a>

        <a href="users.php">
            👥 Users
        </a>

        <a href="../logout.php">🚪 Logout</a>

    </aside>

    <main class="main-content">

        <h1>Edit Driver</h1>

        <div class="form-card">

            <form method="POST">

                <input
                    type="text"
                    name="name"
                    value="<?= htmlspecialchars($driver["name"]) ?>"
                    required
                >

                <input
                    type="text"
                    name="contact"
                    value="<?= htmlspecialchars($driver["contact"]) ?>"
                    required
                >

                <select name="vehicle">

                    <option <?= $driver["vehicle"]=="Motorcycle"?"selected":"" ?>>
                        Motorcycle
                    </option>

                    <option <?= $driver["vehicle"]=="Tricycle"?"selected":"" ?>>
                        Tricycle
                    </option>

                </select>

                <select name="status">

                    <option <?= $driver["status"]=="Available"?"selected":"" ?>>
                        Available
                    </option>

                    <option <?= $driver["status"]=="Unavailable"?"selected":"" ?>>
                        Unavailable
                    </option>

                </select>

                <button type="submit" class="primary-btn">

                    Update Driver

                </button>

            </form>

        </div>

    </main>

</div>

</body>

</html>