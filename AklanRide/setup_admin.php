<?php

$file = "database/users.json";

$users = json_decode(file_get_contents($file), true);

$adminExists = false;

foreach($users as $user){

    if($user["role"] == "admin"){

        $adminExists = true;
        break;

    }

}

if(!$adminExists){

    $users[] = [

        "id" => 1,
        "name" => "Administrator",
        "email" => "admin@aklanride.com",
        "password" => password_hash("admin123", PASSWORD_DEFAULT),
        "role" => "admin"

    ];

    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

    echo "✅ Admin account created successfully.";

}else{

    echo "⚠️ Admin account already exists.";

}

?>