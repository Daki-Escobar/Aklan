<?php
session_start();

if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit;
}

$file = "../database/bookings.json";

$bookings = file_exists($file)
    ? json_decode(file_get_contents($file), true)
    : [];

$id = $_GET["id"] ?? "";

foreach($bookings as &$booking){

    if(
        $booking["booking_id"] == $id &&
        $booking["passenger"] == $_SESSION["user"]["name"] &&
        $booking["status"] == "Pending"
    ){

        $booking["status"] = "Cancelled";
        $booking["driver"] = "Not Assigned";

        break;
    }

}

file_put_contents($file, json_encode($bookings, JSON_PRETTY_PRINT));

header("Location: my_bookings.php");
exit;
?>