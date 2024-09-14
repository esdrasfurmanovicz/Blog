<?php
include_once('include/factory.php');

if(!isset($_POST['email'])){
    header("Location: login.php");
    exit();
}
if(empty($_POST['email'])){
    header("Location: login.php");
    exit();
}
if(!isset($_POST['username'])){
    header("Location: login.php");
    exit();
}
if(empty($_POST['username'])){
    header("Location: login.php");
    exit();
}
if(!isset($_POST['nome'])){
    header("Location: login.php");
    exit();
}
if(empty($_POST['nome'])){
    header("Location: login.php");
    exit();
}
if(!isset($_POST['sobrenome'])){
    header("Location: login.php");
    exit();
}
if(empty($_POST['sobrenome'])){
    header("Location: login.php");
    exit();
}
if(!isset($_POST['senha'])){
    header("Location: login.php");
    exit();
}
if(empty($_POST['senha'])){
    header("Location: login.php");
    exit();
}
if(!isset($_POST['dataNascimento'])){
    header("Location: login.php");
    exit();
}
if(empty($_POST['dataNascimento'])){
    header("Location: login.php");
    exit();
}
$email = $_POST["email"];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: login.php?ue");
    exit();
}
if(UsuarioRepository::verifyUsername($_POST["username"]) > 0){
    header("Location: login.php?teucu");
    exit();
}

date_default_timezone_set('America/Sao_Paulo');

$datetime = DateTime::createFromFormat('d/m/Y', $_POST["dataNascimento"]);
$dateFormatted = $datetime->format('Y-m-d');
$usuario = Factory::usuario();

$usuario->setUsername($_POST['username']);
$usuario->setNome($_POST['nome']);
$usuario->setSobrenome($_POST['sobrenome']);
$usuario->setPerfil('regular');
$usuario->setSenha($_POST['senha']);
$usuario->setEmail($email);
$usuario->setDataNascimento($dateFormatted);
$usuario->setDataInclusao(date('Y-m-d H:i:s'));

$usuario_retorno = UsuarioRepository::insert($usuario);
if($usuario_retorno > 0){
    header("Location: userConfirmCadastro.php?id=".$usuario_retorno);
    exit();
}

header("Location: login.php");
    exit();
