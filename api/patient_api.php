<?php

header("Content-Type:application/json");
include("patient.php");


// var_dump( password_hash('$2y$10$h19mg61R8FK68Yv80feK5.FJfq1e9EW2lu8/ymiIZCERECQr9ZcRu',PASSWORD_DEFAULT) );
// var_dump( password_verify("jalim",'$2y$10$CbRMFr6xYpgeXi6Zc8/kM.qkWwPhqHM2HxCgvlccvEPq0Xslx0KR2') );

if($_SERVER["REQUEST_METHOD"]=="GET" && !empty($_GET)){


    
    $column=isset($_GET['column'])?$_GET['column']:"";
    $value=isset($_GET['value'])?$_GET['value']:"";

    echo $patient->get_patient($column,$value);
    // print_r( $_GET);
    

}elseif($_SERVER["REQUEST_METHOD"]=="DELETE"){

    $data = json_decode(file_get_contents('php://input'), true);

    echo $patient->delet_patient($data['id']);

}elseif($_SERVER["REQUEST_METHOD"]=="PUT"){

    $data = json_decode(file_get_contents('php://input'), true);

    echo $patient->update_patient($data);

}elseif($_SERVER["REQUEST_METHOD"]=="PATCH"){

    $data = json_decode(file_get_contents('php://input'), true);

    echo $user->update_password($data['password'],$data['id']);

}elseif($_SERVER["REQUEST_METHOD"]=="POST"){

    $data = json_decode(file_get_contents('php://input'), true);

    echo $patient->add_patient($data);
    // echo json_encode($data);
}