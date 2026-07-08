<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION["user"];

$bookingsFile = "../database/bookings.json";

$totalBookings = 0;

if(file_exists($bookingsFile)){

    $bookings = json_decode(file_get_contents($bookingsFile), true);

    foreach($bookings as $booking){

        if($booking["user_id"] == $user["id"]){

            $totalBookings++;

        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Profile</title>

<link rel="stylesheet" href="../assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="dashboard">

    <aside class="sidebar">

        <h2>
            🚖 AklanRide
            <p class="logo-subtitle">Ride Booking System</p>
        </h2>
        
        <a href="../index.php">
            🏠 Home
        </a>

        <a href="dashboard.php">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <a href="bookride.php">
            <i class="fa-solid fa-motorcycle"></i>
            Book Ride
        </a>

        <a href="history.php">
            <i class="fa-solid fa-clock-rotate-left"></i>
            History
        </a>

        <a href="profile.php" class="active">
            <i class="fa-solid fa-user"></i>
            Profile
        </a>

        <a href="../logout.php">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

    </aside>

    <main class="main-content">

        <h1>👤 My Profile</h1>

        <div class="profile-card">

            <div class="profile-icon">
                <i class="fa-solid fa-circle-user"></i>
            </div>

            <div class="profile-info">

                <p><strong>Name:</strong> <?= htmlspecialchars($user["name"]) ?></p>

                <p><strong>Email:</strong> <?= htmlspecialchars($user["email"]) ?></p>

                <p><strong>Role:</strong> <?= ucfirst(htmlspecialchars($user["role"])) ?></p>

                <p><strong>Total Bookings:</strong> <?= $totalBookings ?></p>

            </div>

        </div>

    </main>

</div>

</body>

</html>