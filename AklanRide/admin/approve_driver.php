<?php
session_start();

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] != "admin"){
    header("Location: ../user/login.php");
    exit;
}

$id = $_GET["id"] ?? "";

$requestFile = "../database/driver_requests.json";
$driverFile = "../database/drivers.json";

$requests = file_exists($requestFile)
    ? json_decode(file_get_contents($requestFile), true)
    : [];

$drivers = file_exists($driverFile)
    ? json_decode(file_get_contents($driverFile), true)
    : [];

foreach($requests as $key => $request){

    if($request["id"] == $id){

        $drivers[] = [

            "id" => "DRV".str_pad(count($drivers)+1,4,"0",STR_PAD_LEFT),

            "name" => $request["name"],

            "username" => $request["username"],

            "password" => $request["password"],

            "contact" => $request["contact"],

            "address" => $request["address"],

            "vehicle" => $request["vehicle"],

            "license" => $request["license"],

            "status" => "Available"

        ];

        unset($requests[$key]);

        break;

    }

}

file_put_contents($driverFile, json_encode(array_values($drivers), JSON_PRETTY_PRINT));

file_put_contents($requestFile, json_encode(array_values($requests), JSON_PRETTY_PRINT));

header("Location: driver_requests.php");

exit;
?>