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

$file = "../database/drivers.json";

if(!file_exists($file)){

    header("Location: drivers.php");
    exit;

}

$drivers = json_decode(file_get_contents($file), true);

$id = $_GET["id"] ?? "";

$newDrivers = [];

foreach($drivers as $driver){

    if($driver["id"] != $id){

        $newDrivers[] = $driver;

    }

}

file_put_contents($file, json_encode($newDrivers, JSON_PRETTY_PRINT));

header("Location: drivers.php");
exit;
?>