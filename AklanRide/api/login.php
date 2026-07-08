<?php
session_start();

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$email = trim($data["email"] ?? "");
$password = trim($data["password"] ?? "");

if ($email == "" || $password == "") {
    echo json_encode([
        "status" => false,
        "message" => "Please fill in all fields."
    ]);
    exit;
}

$file = "../database/users.json";

$users = json_decode(file_get_contents($file), true);

foreach ($users as $user) {

    if ($user["email"] == $email && password_verify($password, $user["password"])) {

        $_SESSION["user"] = [
            "id" => $user["id"],
            "name" => $user["name"],
            "email" => $user["email"],
            "role" => $user["role"]
        ];

        echo json_encode([
            "status" => true,
            "message" => "Login Successful!",
            "role" => $user["role"]
        ]);

        exit;
    }

}

echo json_encode([
    "status" => false,
    "message" => "Invalid email or password."
]);

?>