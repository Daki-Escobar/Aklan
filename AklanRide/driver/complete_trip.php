<?php
session_start();

if(!isset($_SESSION["driver"])){
    header("Location: login.php");
    exit;
}

$id = $_GET["id"];

$file = "../database/bookings.json";

$bookings = json_decode(file_get_contents($file), true);

foreach($bookings as &$booking){

    if($booking["booking_id"] == $id){

        $booking["status"] = "Completed";

        break;

    }

}

file_put_contents($file, json_encode($bookings, JSON_PRETTY_PRINT));

header("Location: my_trips.php");

exit;
?>