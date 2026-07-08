<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION["user"];
$bookingsFile = "../database/bookings.json";

$totalBookings = 0;
$pendingBookings = 0;
$completedBookings = 0;

if(file_exists($bookingsFile)){

    $bookings = json_decode(file_get_contents($bookingsFile), true);

    foreach($bookings as $booking){

        if($booking["user_id"] == $user["id"]){

            $totalBookings++;

            if($booking["status"] == "Pending"){
                $pendingBookings++;
            }

            if($booking["status"] == "Completed"){
                $completedBookings++;
            }

        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>User Dashboard</title>

<link rel="stylesheet" href="../assets/css/style.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>
<body>

<div class="dashboard">

    <!-- Sidebar -->

    <aside class="sidebar">

        <div class="sidebar-logo">

            <img src="../assets/images/AklanRide.png" alt="AklanRide Logo">

            <h2>Admin Panel</h2>

        </div>
        
        <a href="../index.php">
            🏠 Home
        </a>
        
        <a href="dashboard.php" class="active">
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

        <a href="profile.php">
            <i class="fa-solid fa-user"></i>
            Profile
        </a>

        <a href="../logout.php">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

    </aside>

    <!-- Main -->

    <main class="main-content">

        <h1>
            Welcome,
            <?php echo htmlspecialchars($user["name"]); ?> 👋
        </h1>

        <p>
            Ready to book your next ride?
        </p>

        <div class="dashboard-cards">

            <div class="dashboard-card">

                <i class="fa-solid fa-list"></i>

                <h3>Total Bookings</h3>

                <h1><?= $totalBookings ?></h1>

            </div>

            <div class="dashboard-card">

                <i class="fa-solid fa-clock"></i>

                <h3>Pending</h3>

                <h1><?= $pendingBookings ?></h1>

            </div>

            <div class="dashboard-card">

                <i class="fa-solid fa-circle-check"></i>

                <h3>Completed</h3>

                <h1><?= $completedBookings ?></h1>

            </div>

        </div>

    </main>

</div>

</body>
</html>