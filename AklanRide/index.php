<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AklanRide | Home</title>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Header -->
    <header>
        <div class="container">
            <h2 class="logo"><img src="assets/images/AklanRide.png" class="nav-logo" alt="AklanRide"></h2>

            <nav>

                <?php if(isset($_SESSION["user"])) { ?>

                    <?php if($_SESSION["user"]["role"] == "admin") { ?>

                        <a href="index.php" class="active">Home</a>
                        <a href="admin/dashboard.php">Dashboard</a>
                        <a href="admin/bookings.php">Bookings</a>
                        <a href="admin/drivers.php">Drivers</a>
                        <a href="admin/users.php">Users</a>
                        <a href="logout.php">Logout</a>

                    <?php } else { ?>

                        <a href="index.php" class="active">Home</a>
                        <a href="user/dashboard.php">Book Ride</a>
                        <a href="user/history.php">History</a>
                        <a href="user/profile.php">Profile</a>
                        <a href="logout.php">Logout</a>

                    <?php } ?>

                <?php } else { ?>

                    <a href="#home" class="active">Home</a>
                    <a href="#about">About</a>
                    <a href="#services">Services</a>
                    <a href="#contact">Contact</a>
                    <a href="user/login.php">Login</a>
                    <a href="user/register.php">Register</a>
                    <a href="driver/login.php">Driver Login</a>
                    <a href="driver/register.php">Become a Driver</a>

                <?php } ?>

            </nav>

        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container hero-content">

            <div class="hero-text">

                <h1>Ride Around Aklan with Ease</h1>

                <p>
                    Safe • Fast • Affordable Transportation across Aklan.
                    Book your ride anytime, anywhere.
                </p>

                <div class="buttons">

                    <?php if(isset($_SESSION["user"])) { ?>

                        <?php if($_SESSION["user"]["role"] == "admin") { ?>

                            <button onclick="window.location.href='admin/dashboard.php'">
                                Go to Dashboard
                            </button>

                            <button class="secondary"
                                onclick="window.location.href='admin/bookings.php'">
                                Manage Bookings
                            </button>

                        <?php } else { ?>

                            <button onclick="window.location.href='user/dashboard.php'">
                                Book a Ride
                            </button>

                            <button class="secondary"
                                onclick="window.location.href='user/history.php'">
                                My History
                            </button>

                        <?php } ?>

                    <?php } else { ?>

                        <button onclick="window.location.href='user/login.php'">
                            Book a Ride
                        </button>

                        <button class="secondary"
                            onclick="document.getElementById('about').scrollIntoView({behavior:'smooth'})">
                            Learn More
                        </button>

                    <?php } ?>

                </div>

            </div>

            <div class="hero-image">

                <div class="circle">
                    <img src="assets/images/Scorpio.png"
                    class="hero-logo"
                    alt="AklanRide">
                </div>

            </div>

        </div>
    </section>

    <!-- Features -->
    <section class="features">

        <h2>Why Choose AklanRide?</h2>

        <div class="cards">

            <div class="card">
                <h3>🚖 Fast Booking</h3>
                <p>Book your ride within seconds.</p>
            </div>

            <div class="card">
                <h3>🛡 Safe Drivers</h3>
                <p>Verified and trusted local drivers.</p>
            </div>

            <div class="card">
                <h3>💰 Affordable Fare</h3>
                <p>Budget-friendly transportation.</p>
            </div>

            <div class="card">
                <h3>📍 Local Service</h3>
                <p>Travel easily anywhere in Aklan.</p>
            </div>

        </div>

    </section>

    <section class="about" id="about">

        <div class="container">

            <h2>About AklanRide</h2>

            <p>

                AklanRide is a web-based ride booking system designed to provide
                a fast, safe and convenient transportation service within Aklan.
                Users can register, book rides, view booking history and manage
                their profiles through a simple and user-friendly interface.

            </p>

        </div>

    </section>

    <section class="services" id="services">

        <h2>Our Services</h2>

        <div class="cards">

            <div class="card">
                <h3>🏍 Motorcycle Ride</h3>
                <p>Fast transportation for short and long trips.</p>
            </div>

            <div class="card">
                <h3>🛺 Tricycle Ride</h3>
                <p>Affordable rides within nearby municipalities.</p>
            </div>

            <div class="card">
                <h3>📱 Online Booking</h3>
                <p>Book your ride anytime using AklanRide.</p>
            </div>

        </div>

    </section>

    <section class="contact" id="contact">

        <h2>Contact Us</h2>

        <p>📍 Kalibo, Aklan</p>

        <p>📞 +63 954 279 4016</p>

        <p>✉ support@aklanride.com</p>

    </section>

    <!-- Footer -->
    <footer>
        <p>© 2026 AklanRide. All Rights Reserved.</p>
    </footer>

    <!-- JavaScript -->
    <script src="assets/js/script.js"></script>

</body>
</html>