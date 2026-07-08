<?php

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$name = trim($data["name"] ?? "");
$email = trim($data["email"] ?? "");
$password = trim($data["password"] ?? "");

if ($name == "" || $email == "" || $password == "") {
    echo json_encode([
        "status" => false,
        "message" => "All fields are required."
    ]);
    exit;
}

$file = "../database/users.json";

if (!file_exists($file)) {
    file_put_contents($file, "[]");
}

$users = json_decode(file_get_contents($file), true);

foreach ($users as $user) {
    if ($user["email"] == $email) {
        echo json_encode([
            "status" => false,
            "message" => "Email already exists."
        ]);
        exit;
    }
}

$newUser = [
    "id" => time(),
    "name" => $name,
    "email" => $email,
    "password" => password_hash($password, PASSWORD_DEFAULT),
    "role" => "user"
];

$users[] = $newUser;

file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

echo json_encode([
    "status" => true,
    "message" => "Registration Successful!"
]);

?>