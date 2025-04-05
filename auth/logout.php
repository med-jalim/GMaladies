<?php


include(dirname(__FILE__).'/../api/user.php');
include("../config.php");


$user->logout();

redirect('auth/login.php');
