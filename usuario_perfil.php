<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}
$userLogado = Auth::getUser();
$usuario = UsuarioRepository::get($_GET['id'])
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - <?php echo $usuario->getNome() ?></title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/menu.css">
    <link rel="stylesheet" href="style/perfil.css">
    <style> 
        <?php if($usuario->getPerfil() === "adm") { ?> 
            .username{ 
                background: -webkit-linear-gradient(#5b0085, #aa02f8); 
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
        <?php } ?> 
    </style>
</style>
</head>
<body>
    <?php 
    include_once("include/menu.php");
    ?>

    <main>
        <section class="hedPerfil">
            <div class="ftName">
                <img src="img/perfil.png" alt="" class="fotoPerfil">
                <p class="nome"><?php echo $usuario->getNome() ?></p>
                <p class="sobrenome"><?php echo $usuario->getSobrenome() ?></p>
            </div>
            <?php if($usuario->getId() ===  $userLogado->getId()){ ?>
                <a href="usuario_editar.php?id=<?php echo $userLogado->getId(); ?>"><img src="svg/editar.svg" alt="Editar" class="editarSvg"></a>
            <?php } ?>
        </section>
        <p class="username"><?php echo $usuario->getUsername() ?></p>
        <div class="bioPerfil">
            <h3>Biografia</h3>
            <br>
            <p>"<?php echo $usuario->getBiografia(); ?>"</p>
        </div>
        <section class="postagens">
                <div class="hPost">
                    <h3>Postagens</h3>
                    <?php if($usuario->getId() ===  $userLogado->getId()){ ?>
                        <a href="novo_postagem.php?id=<?php echo $userLogado->getId(); ?>"><img src="svg/add.svg" alt="Adicionar Postagem" class="addSvg"></a>
                    <?php } ?>
                </div>
        </section>
    </main>
</body>
</html>