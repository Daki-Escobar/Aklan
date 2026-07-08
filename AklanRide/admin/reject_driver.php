<?php
session_start();

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] != "admin"){
    header("Location: ../user/login.php");
    exit;
}

$id = $_GET["id"] ?? "";

$requestFile = "../database/driver_requests.json";

$requests = file_exists($requestFile)
    ? json_decode(file_get_contents($requestFile), true)
    : [];

foreach($requests as $key => $request){

    if($request["id"] == $id){

        unset($requests[$key]);

        break;

    }

}

file_put_contents(
    $requestFile,
    json_encode(array_values($requests), JSON_PRETTY_PRINT)
);

header("Location: driver_requests.php");
exit;
?>