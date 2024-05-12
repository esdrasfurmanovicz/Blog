<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

$email = $_POST["email"];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: login.php");
    exit();
}

date_default_timezone_set('America/Sao_Paulo');

$datetime = DateTime::createFromFormat('d/m/Y', $_POST["dataNascimento"]);
$dateFormatted = $datetime->format('Y-m-d');
$usuario = Factory::usuario();

$usuario->setUsername($_POST['username']);
$usuario->setNome($_POST['nome']);
$usuario->setSobrenome($_POST['sobrenome']);
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
