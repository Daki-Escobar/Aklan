<?php
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $file="../database/drivers.json";

    $drivers=file_exists($file)
        ? json_decode(file_get_contents($file),true)
        : [];

    foreach($drivers as $driver){

        if(
            $driver["username"]==$_POST["username"] &&
            $driver["password"]==$_POST["password"]
        ){

            $_SESSION["driver"]=$driver;

            header("Location: dashboard.php");
            exit;

        }

    }

    $error="Invalid username or password.";

}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Driver Login</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="login-container">

    <div class="login-box">

        <img src="../assets/images/AklanRide.png" class="auth-logo">

        <h1>Driver Login</h1>

        <p class="subtitle">
            Login using your approved driver account.
        </p>

        <?php if(isset($error)){ ?>

            <div class="error">

                <?= $error ?>

            </div>

        <?php } ?>

        <form method="POST">

            <div class="input-group">

                <input
                    type="text"
                    name="username"
                    placeholder="Username"
                    required>

            </div>

            <div class="input-group">

                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    required>

            </div>

            <button class="login-btn">

                Login

            </button>

        </form>

    </div>

</div>

</body>

</html>