<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Book Ride</title>

<link rel="stylesheet" href="../assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="dashboard">

    <!-- Sidebar -->

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

        <a href="bookride.php" class="active">
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

    <!-- Main Content -->

    <main class="main-content">

        <h1>🚖 Book a Ride</h1>

        <div class="booking-card">

            <form id="bookingForm">

                <label>Passenger</label>

                <input
                    type="text"
                    value="<?php echo htmlspecialchars($user["name"]); ?>"
                    readonly
                >

                <label>Pickup Location</label>

                <select id="pickup" required>

                    <option value="">Select Pickup</option>

                    <option>Kalibo</option>
                    <option>Numancia</option>
                    <option>Banga</option>
                    <option>Lezo</option>
                    <option>Makato</option>
                    <option>New Washington</option>
                    <option>Batan</option>
                    <option>Ibajay</option>
                    <option>Malay</option>

                </select>

                <label>Destination</label>

                <select id="destination" required>

                    <option value="">Select Destination</option>

                    <option>Kalibo</option>
                    <option>Numancia</option>
                    <option>Banga</option>
                    <option>Lezo</option>
                    <option>Makato</option>
                    <option>New Washington</option>
                    <option>Batan</option>
                    <option>Ibajay</option>
                    <option>Malay</option>

                </select>

                <label>Vehicle</label>

                <select id="vehicle">

                    <option>Motorcycle</option>
                    <option>Tricycle</option>

                </select>

                <label>Payment Method</label>

                <select id="payment">

                    <option>Cash</option>
                    <option>GCash</option>

                </select>

                <div class="fare-box">

                    Estimated Fare

                    <h2 id="fare">₱80</h2>

                </div>

                <button type="submit">

                    Book Ride

                </button>

            </form>

        </div>

    </main>

</div>

<script src="../assets/js/script.js"></script>

</body>

</html>