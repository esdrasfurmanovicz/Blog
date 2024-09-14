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
    header("location: foto_perfilut.php");
    exit();
}


date_default_timezone_set('America/Sao_Paulo');

if($_POST['form'] == 1){
    if(isset($_FILES['fotoPerfil'])) {
        if($_FILES['fotoPerfil']!= null && $_FILES['fotoPerfil']!= '' && is_uploaded_file($_FILES['fotoPerfil']['tmp_name'])) {
            $caminho_foto_perfil = $_FILES['fotoPerfil']['tmp_name'];
            if (!empty($caminho_foto_perfil)) {
                $conteudo_foto_perfil = file_get_contents($caminho_foto_perfil);
                $img_base64 = base64_encode($conteudo_foto_perfil);
                if(!empty($img_base64)) {  
                    $usuario->setFotoPerfil($img_base64);
                }
            }
        }
    }
    $usuario->setDataAlteracao(date('Y-m-d H:i:s'));

    usuarioRepository::update($usuario);
}


if($_POST['form'] == 2){
    $datetime = DateTime::createFromFormat('d/m/Y', $_POST["dataNascimento"]);
    $dateFormatted = $datetime->format('Y-m-d');
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

    $usuario->setUsername($_POST['username']);
    $usuario->setBiografia($_POST['biografia']);
    $usuario->setEmail($email);
    $usuario->setPerfil('regular');
    $usuario->setDataNascimento($dateFormatted);
    $usuario->setDataAlteracao(date('Y-m-d H:i:s'));

    usuarioRepository::update($usuario);
}




header("Location: usuario_editar.php?id=".$usuario->getId());