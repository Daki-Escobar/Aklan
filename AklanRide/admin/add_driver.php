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

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $file = "../database/drivers.json";

    if(!file_exists($file)){
        file_put_contents($file,"[]");
    }

    $drivers = json_decode(file_get_contents($file), true);

    $drivers[] = [
        "id" => "DR".str_pad(count($drivers)+1,4,"0",STR_PAD_LEFT),
        "name" => trim($_POST["name"]),
        "contact" => trim($_POST["contact"]),
        "vehicle" => $_POST["vehicle"],
        "status" => "Available"
    ];

    file_put_contents($file, json_encode($drivers, JSON_PRETTY_PRINT));

    header("Location: drivers.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Add Driver</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

    <body>

        <div class="dashboard">

            <aside class="sidebar">

                <h2>🚖 Admin</h2>

                <a href="dashboard.php">
                    🏠 Dashboard
                </a>

                <a href="bookings.php">
                    📋 Bookings
                </a>

                <a href="drivers.php" class="active">
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

                <h1>Add Driver</h1>

                <div class="form-card">

                    <form method="POST">

                        <input
                            type="text"
                            name="name"
                            placeholder="Driver Name"
                            required
                        >

                        <input
                            type="text"
                            name="contact"
                            placeholder="Contact Number"
                            required
                        >

                        <select name="vehicle">

                            <option>Motorcycle</option>
                            <option>Tricycle</option>

                        </select>

                        <button type="submit" class="primary-btn">

                            Save Driver

                        </button>

                    </form>

                </div>

            </main>

        </div>

    </body>

</html>