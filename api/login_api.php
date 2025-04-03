<?php

header("Content-Type:application/json");
include("user.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        echo json_encode(["error" => "Missing email or password"]);
        exit;
    }else{
        $email=htmlentities($_POST['email']);
        $password=htmlentities($_POST['password']);
    }

    

    echo $user->login($email,$password);

}