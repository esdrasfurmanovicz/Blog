<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

if(!isset($_POST['id'])){
    header("location: index.php");
    exit();
}
if($_POST["id"] == "" || $_POST["id"] == null){
    header("location: index.php");
    exit();
}
$usuario = usuarioRepository::get($_POST["id"]);
if(!$usuario){
    header("location: logout.php");
    exit();
}

if(!isset($_POST['senha'])){
    header("Location: usuario_alterar_senha.php?id=".$usuario->getId());
    exit();
}
if($_POST["senha"] == "" || $_POST["senha"] == null){
    header("Location: usuario_alterar_senha.php?id=".$usuario->getId());
    exit();
}

if($_POST["senha"] != $_POST["repSenha"]){
    header("Location: usuario_alterar_senha.php?id=".$usuario->getId());
    exit();
}
date_default_timezone_set('America/Sao_Paulo');

$usuario->setSenha($_POST['senha']);
$usuario->setDataAlteracao(date('Y-m-d H:i:s'));

UsuarioRepository::update($usuario);



header("Location: usuario_editar.php?id=".$usuario->getId());