<?php
session_start();

if(!isset($_SESSION["user"])){
    header("Location: ../user/login.php");
    exit;
}

if($_SESSION["user"]["role"] != "admin"){
    header("Location: ../user/dashboard.php");
    exit;
}

$file = "../database/bookings.json";

$bookings = file_exists($file)
    ? json_decode(file_get_contents($file), true)
    : [];

$id = $_GET["id"] ?? "";

$newBookings = [];

foreach($bookings as $booking){

    if($booking["booking_id"] != $id){

        $newBookings[] = $booking;

    }

}

file_put_contents($file, json_encode($newBookings, JSON_PRETTY_PRINT));

header("Location: bookings.php");
exit;
?>