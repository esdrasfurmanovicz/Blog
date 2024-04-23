<?php
include_once('include/factory.php');

$email = $_POST["email"];
$senha = $_POST["senha"];

if($email == null || $senha ==null){
    header("Location: login.php");
    exit();
}
if($email == "" || $senha ==""){
    header("Location: login.php");
    exit();
}
$auth = Auth::login($email, $senha);
if(Auth::isAuthenticated()){
    header("Location: index.php");
    exit();
}

header("Location: login.php");
    exit();

