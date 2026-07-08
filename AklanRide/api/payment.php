<?php
session_start();

header("Content-Type: application/json");

if(!isset($_SESSION["user"])){

    echo json_encode([
        "status"=>false,
        "message"=>"Please login first."
    ]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$file = "../database/payments.json";

if(!file_exists($file)){
    file_put_contents($file,"[]");
}

$payments = json_decode(file_get_contents($file), true);

if(!$payments){
    $payments = [];
}

$payments[] = [

    "booking_id"=>$data["booking_id"],
    "user_id"=>$_SESSION["user"]["id"],
    "method"=>$data["method"],
    "fare"=>$data["fare"],
    "status"=>"Paid",
    "date"=>date("Y-m-d H:i:s")

];

file_put_contents($file,json_encode($payments,JSON_PRETTY_PRINT));

echo json_encode([

    "status"=>true,
    "message"=>"Payment Successful!"

]);