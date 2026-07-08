<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AklanRide | Login</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="auth-container">

    <div class="auth-card">

        <img src="../assets/images/AklanRide.png" class="auth-logo" alt="AklanRide">

        <h1>Welcome Back</h1>
        <p>Login to your AklanRide account.</p>

        <form id="loginForm">

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
                Login
            </button>

        </form>

        <p class="auth-link">
            Don't have an account?
            <a href="register.php">Register</a>
        </p>

    </div>

</div>

<script src="../assets/js/script.js"></script>

</body>
</html>