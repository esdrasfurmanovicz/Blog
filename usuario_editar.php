<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}
$userLogado = Auth::getUser();
$user = UsuarioRepository::get($_GET['id']);
if (!$userLogado){
    header("Location: login.php");
    exit();
}
if($userLogado->getId() != $user->getId()){
    header("Location: index.php");
    exit();
}
if(!isset($_GET['id'])){
    header("Location: index.php");
    exit();
}
if($_GET['id'] == '' || $_GET['id'] == null){
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/menu.css">
    <link rel="stylesheet" href="style/perfil.css">
    <link rel="stylesheet" href="style/editarUsuario.css">
</head>
<body>
    <?php include_once("include/menu.php") ?>
    <main>
        <form action="usuario_editar_post.php" method="post">
            <div class="hedPerfil">
                <div class="ftName">
                    <img src="img/perfil.png" alt="" class="fotoPerfil">
                    <p class="nome"><?php echo $user->getNome() ?></p>
                </div>
                <?php if($user->getId() ===  $userLogado->getId()){ ?>
                    <button type="submit" class="salvar">Salvar</button>
                <?php } ?>
            </div>
            <div class="bioPerfil">
                <h3>Biografia</h3>
                <br>
                <textarea name="biografia" class="bio" cols="30" rows="10" maxlength="500"><?php echo $user->getBiografia() ?></textarea>
            </div>
        </form>
    </main>
</body>
</html>