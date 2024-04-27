<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php"); 
    exit();
}

$user = Auth::getUser();

if(!isset($_POST['id'])){
    header("location: index.php?1");
    exit();
}
if($_POST["id"] == "" || $_POST["id"] == null){
    header("location: index.php?2");
    exit();
}
$usuario = UsuarioRepository::get($_POST["id"]);
if(!$usuario){
    header("location: logout.php");
    exit();
}

if(!isset($_POST['username'])){
    header("Location: usuario_editar.php?id=".$usuario->getId());
    exit();
}
if($_POST["username"] == "" || $_POST["username"] == null){
    header("Location: usuario_editar.php?id=".$usuario->getId());
    exit();
}
if(!isset($_POST['dataNascimento'])){
    header("Location: usuario_editar.php?id=".$usuario->getId());
    exit();
}
if($_POST["dataNascimento"] == "" || $_POST["dataNascimento"] == null){
    header("Location: usuario_editar.php?id=".$usuario->getId());
    exit();
}

$email = $_POST["email"];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: usuario_editar.php?id=".$usuario->getId());
    exit();
}


$datetime = DateTime::createFromFormat('d/m/Y', $_POST["dataNascimento"]);
$dateFormatted = $datetime->format('Y-m-d');
date_default_timezone_set('America/Sao_Paulo');

$usuario->setPerfil($_POST['perfil']);
$usuario->setUsername($_POST['username']);
$usuario->setBiografia($_POST['biografia']);
$usuario->setEmail($email);
$usuario->setDataNascimento($dateFormatted);
$usuario->setDataAlteracao(date('Y-m-d H:i:s'));

usuarioRepository::update($usuario);



header("Location: usuario_editar.php?id=".$usuario->getId());