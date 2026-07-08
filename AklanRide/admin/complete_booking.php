<?php

session_start();

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] != "admin"){

    header("Location: ../user/login.php");
    exit;

}

$bookingsFile = "../database/bookings.json";
$driversFile = "../database/drivers.json";

$bookings = json_decode(file_get_contents($bookingsFile), true);
$drivers = json_decode(file_get_contents($driversFile), true);

$id = $_GET["id"] ?? "";

foreach($bookings as &$booking){

    if($booking["booking_id"] == $id){

        $booking["status"] = "Completed";

        foreach($drivers as &$driver){

            if($driver["name"] == $booking["driver"]){

                $driver["status"] = "Available";

            }

        }

        break;

    }

}

file_put_contents($bookingsFile, json_encode($bookings, JSON_PRETTY_PRINT));
file_put_contents($driversFile, json_encode($drivers, JSON_PRETTY_PRINT));

header("Location: bookings.php");
exit;

?>