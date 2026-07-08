<?php

session_start();

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] != "admin"){

    header("Location: ../user/login.php");
    exit;

}

$file = "../database/users.json";

$users = json_decode(file_get_contents($file), true);

$id = $_GET["id"] ?? "";

$newUsers = [];

foreach($users as $user){

    if($user["id"] != $id){

        $newUsers[] = $user;

    }

}

file_put_contents($file, json_encode($newUsers, JSON_PRETTY_PRINT));

header("Location: users.php");
exit;

?>