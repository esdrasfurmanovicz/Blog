<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}
$userLogado = Auth::getUser();
$user = UsuarioRepository::get($_GET['id'])
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - <?php echo $user->getNome() ?></title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/menu.css">
    <link rel="stylesheet" href="style/perfil.css">
</head>
<body>
    <?php include_once("include/menu.php") ?>

    <main>
        <div class="hedPerfil">
            <div class="ftName">
                <img src="img/perfil.png" alt="" class="fotoPerfil">
                <p class="nome"><?php echo $user->getNome() ?></p>
            </div>
            <?php if($user->getId() ===  $userLogado->getId()){ ?>
                <a href="usuario_editar.php?id=<?php echo $userLogado->getId(); ?>"><img src="svg/editar.svg" alt="Editar" class="editarSvg"></a>
            <?php } ?>
        </div>
        <div class="bioPerfil">
            <h3>Biografia</h3>
            <br>
            <p>"<?php echo $user->getBiografia(); ?>"</p>
        </div>
    </main>
</body>
</html>