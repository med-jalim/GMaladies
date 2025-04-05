<?php


$protocol=(isset($_SERVER['HTTPS']) ? "https://" : "http://");
$projectFolder=str_replace($_SERVER['DOCUMENT_ROOT'],'',str_replace('\\', '/', realpath(__DIR__)));
$basUrl= $protocol . $_SERVER['HTTP_HOST'] . $projectFolder . "/";

function redirect($path){
    global $basUrl;
    header("location:".$basUrl . ltrim($path,"/"));
    exit();
}

function asset($path) {
    global $basUrl;
    return $basUrl . ltrim($path, '/');
}

// echo asset("api/login_api.php");
// echo $basUrl ."<br>";
// echo realpath(__DIR__); 
