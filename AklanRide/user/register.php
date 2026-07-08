<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AklanRide | Register</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="auth-container">

    <div class="auth-card">

        <img src="../assets/images/AklanRide.png" class="auth-logo" alt="AklanRide">

        <h1>Create Account</h1>
        <p>Join AklanRide today.</p>

        <form id="registerForm">

            <input
                type="text"
                id="name"
                placeholder="Full Name"
                required
            >

            <input
                type="email"
                id="email"
                placeholder="Email Address"
                required
            >

            <input
                type="password"
                id="password"
                placeholder="Password"
                required
            >

            <button type="submit">
                Register
            </button>

        </form>

        <p class="auth-link">
            Already have an account?
            <a href="login.php">Login</a>
        </p>

    </div>

</div>

<script src="../assets/js/script.js"></script>

</body>
</html>