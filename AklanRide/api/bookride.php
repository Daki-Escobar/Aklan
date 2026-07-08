<?php
session_start();

header("Content-Type: application/json");

if (!isset($_SESSION["user"])) {
    echo json_encode([
        "status" => false,
        "message" => "Please login first."
    ]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$pickup = trim($data["pickup"] ?? "");
$destination = trim($data["destination"] ?? "");
$vehicle = trim($data["vehicle"] ?? "");
$payment = trim($data["payment"] ?? "");
$fare = intval($data["fare"] ?? 0);

if ($pickup == "" || $destination == "") {
    echo json_encode([
        "status" => false,
        "message" => "Please complete all fields."
    ]);
    exit;
}

$file = "../database/bookings.json";

if (!file_exists($file)) {
    file_put_contents($file, "[]");
}

$bookings = json_decode(file_get_contents($file), true);

$booking = [
    "booking_id" => "BK" . str_pad(count($bookings) + 1, 4, "0", STR_PAD_LEFT),
    "user_id" => $_SESSION["user"]["id"],
    "passenger" => $_SESSION["user"]["name"],
    "pickup" => $pickup,
    "destination" => $destination,
    "vehicle" => $vehicle,
    "payment" => $payment,
    "fare" => $fare,
    "status" => "Pending",
    "driver" => "Not Assigned",
    "date" => date("Y-m-d H:i:s")
];

$bookings[] = $booking;

file_put_contents($file, json_encode($bookings, JSON_PRETTY_PRINT));

echo json_encode([
    "status" => true,
    "message" => "Ride booked successfully!",
    "booking_id" => $booking["booking_id"],
    "fare" => $fare
]);
?>