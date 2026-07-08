<?php
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $file="../database/driver_requests.json";

    if(!file_exists($file)){
        file_put_contents($file,"[]");
    }

    $requests=json_decode(file_get_contents($file),true);

    $requests[]=[

        "id"=>"REQ".str_pad(count($requests)+1,4,"0",STR_PAD_LEFT),

        "name"=>trim($_POST["name"]),

        "username"=>trim($_POST["username"]),

        "password"=>trim($_POST["password"]),

        "contact"=>trim($_POST["contact"]),

        "address"=>trim($_POST["address"]),

        "vehicle"=>$_POST["vehicle"],

        "license"=>trim($_POST["license"]),

        "status"=>"Pending"

    ];

    file_put_contents($file,json_encode($requests,JSON_PRETTY_PRINT));

    echo "<script>
            alert('Driver application submitted successfully!');
            window.location='../index.php';
          </script>";

    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Become a Driver</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="login-container">

    <div class="login-box">

        <img src="../assets/images/AklanRide.png" class="driver-logo">
        <h1>Become a Driver</h1>

        <p class="subtitle">
            Fill in your information to apply as an AklanRide Driver.
        </p>

        <form method="POST">

            <div class="input-group">

                <input
                    type="text"
                    name="name"
                    placeholder="Full Name"
                    required>

            </div>

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

            <div class="input-group">

                <input
                    type="text"
                    name="contact"
                    placeholder="Contact Number"
                    required>

            </div>

            <div class="input-group">

                <input
                    type="text"
                    name="address"
                    placeholder="Address"
                    required>

            </div>

            <div class="input-group">

                <select name="vehicle" required>

                    <option value="">Select Vehicle</option>

                    <option value="Motorcycle">🏍 Motorcycle</option>

                    <option value="Tricycle">🛺 Tricycle</option>

                </select>

            </div>

            <div class="input-group">

                <input
                    type="text"
                    name="license"
                    placeholder="License Number"
                    required>

            </div>

            <button type="submit" class="login-btn">

                Submit Application

            </button>

        </form>

        <div class="register-link">

            Already have an account?

            <a href="../user/login.php">

                Login

            </a>

        </div>

    </div>

</div>

</body>

</html>