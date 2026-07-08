<?php
session_start();

if(!isset($_SESSION["driver"])){
    header("Location: login.php");
    exit;
}

$file = "../database/drivers.json";

$drivers = json_decode(file_get_contents($file), true);

$currentDriver = $_SESSION["driver"];

if($_SERVER["REQUEST_METHOD"]=="POST"){

    foreach($drivers as &$driver){

        if($driver["username"] == $currentDriver["username"]){

            $driver["contact"] = trim($_POST["contact"]);
            $driver["address"] = trim($_POST["address"]);

            if(!empty($_POST["password"])){

                $driver["password"] = trim($_POST["password"]);

            }

            $_SESSION["driver"] = $driver;

            break;

        }

    }

    file_put_contents($file, json_encode($drivers, JSON_PRETTY_PRINT));

    header("Location: profile.php");

    exit;

}
?>

<!DOCTYPE html>
<html>

    <head>

        <title>Edit Profile</title>

        <link rel="stylesheet" href="../assets/css/style.css">

    </head>

    <body>

        <div class="dashboard">

            <aside class="sidebar">

                <div class="sidebar-logo">

                    <img src="../assets/images/AklanRide.png">

                    <h2>Driver Panel</h2>

                </div>

                <a href="dashboard.php">🏠 Dashboard</a>

                <a href="available_bookings.php">📋 Available Bookings</a>

                <a href="my_trips.php">🚗 My Trips</a>

                <a href="profile.php">👤 My Profile</a>

                <a href="../logout.php">🚪 Logout</a>

            </aside>

            <main class="main-content">

                <h1>Edit Profile</h1>

                <div class="edit-profile-card">

                    <form method="POST">
                        <div>
                            <label>Full Name</label>

                            <input
                            type="text"
                            value="<?= htmlspecialchars($currentDriver["name"]) ?>"
                            readonly>
                        </div>

                        <div>
                            <label>Username</label>

                            <input
                            type="text"
                            value="<?= htmlspecialchars($currentDriver["username"]) ?>"
                            readonly>
                        </div>

                        <div>
                            <label>Vehicle</label>

                            <input
                            type="text"
                            value="<?= htmlspecialchars($currentDriver["vehicle"]) ?>"
                            readonly>
                        </div>

                        <div>
                            <label>License Number</label>

                            <input
                            type="text"
                            value="<?= htmlspecialchars($currentDriver["license"]) ?>"
                            readonly>
                        </div>

                        <div>
                            <label>Contact Number</label>

                            <input
                            type="text"
                            name="contact"
                            value="<?= htmlspecialchars($currentDriver["contact"]) ?>"
                            required>
                        </div>

                        <div>
                            <label>Address</label>

                            <input
                            type="text"
                            name="address"
                            value="<?= htmlspecialchars($currentDriver["address"]) ?>"
                            required>
                        </div>

                        <div>
                            <label>New Password (Optional)</label>

                            <input
                            type="password"
                            name="password"
                            placeholder="Leave blank if unchanged">
                        </div>

                        <button class="login-btn">

                            💾 Save Changes

                        </button>

                    </form>

                </div>

            </main>

        </div>

    </body>

</html>