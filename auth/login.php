<?php


session_start();
if(isset($_COOKIE['role']) ){
  if($_SESSION['role']=='doctor' || $_COOKIE['role']=='doctor' ){
    header("location:/php/gmaladies/doctor.php");
  }elseif($_COOKIE['role']=='patient' ){
    header("location:/php/gmaladies/patient.php");

  }
};

$incorrect=false;

if($_SERVER["REQUEST_METHOD"]=="POST"){
  
    $data = [
        'email' => $_POST["email"],
        'password' => $_POST['password']
    ];
    $ch=curl_init("http://localhost/php/GMaladies/api/login_api.php");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    $reponse=curl_exec($ch);
    
    $user=json_decode($reponse,true);
    if(isset($user['incorrect'])){
        $incorrect=true;
        // print_r( $user);
    }else{
      $_SESSION=$user;
      // print_r( $user);
      // setcookie('nom', $user['nom'],time() + (365 * 24 * 60 * 60 * 2), "/");
      setcookie('role', $user['role'],time() + (365 * 24 * 60 * 60 * 2), "/");
      if($_SESSION["role"]=="doctor"){
        header("location:/php/gmaladies/doctor.php");
      }else{
        header("location:/php/gmaladies/patient.php");
      }
      

    }

    curl_close($ch);
    // echo $_SESSION["nom"];
}





?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </head>
  <body>
  <div class="container mt-5 w-50  ">

  <?php
    if($incorrect){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>incorrect</strong> incorrect password or invalid email.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    // if($noUser){
    //   echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //           <strong>we are sorry !</strong> There is no user with this email please sign in first.
    //           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //         </div>';
    // }
  ?>

    <div class="title text-center ">
      <h1 class="fw-bold">login page</h1>
    </div>
  <form action="login.php" method="post" class="">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input required type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input required type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    
    <button type="submit" name="submit" class="btn btn-primary w-100">login</button>
    <a class="w-100 text-center d-block" href="signin.php">create in account ?</a>
  </form>
  </div>
    
  </body>
</html>