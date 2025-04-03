<?php


include(dirname(__FILE__).'/../api/user.php');


$user->logout();

header('location:/php/gmaladies/auth/login.php');

