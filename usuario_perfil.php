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
        <?php if($usuario->getPerfil() == "adm") { ?> 
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
            <div class="foto">
                        <?php if($usuario->getFotoPerfil() != null){
                            $codigo_base64 = $usuario->getFotoPerfil();
                            $imagem = base64_decode($codigo_base64);
                            echo '<img onclick="popUpFoto()" src="data:image/png;base64,' . $codigo_base64 . '" alt="Minha Imagem"   class="img-thumbnail  justify-content-center align-items-center ftPerfil"  >';
                        }else { ?>
                            <img src="img/perfil.png" alt="" class="fotoPerfil">
                        <?php } ?>
                    </div>
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
                <div class="bodyPost">
                    <?php foreach(PostagemRepository::listAllByAutor($usuario->getId()) as $postagem){ ?>
                        
                        <div class="postFA">
                        <div class="userIndentify">
                            <div class="img"></div>
                            <div class="nome"><p><?php echo $usuario->getNome()?></p></div>
                        </div>
                        <h3><?php echo $postagem->getTitulo() ?></h3>
                        </div>

                    <?php } ?>
                    
                </div>
        </section>
    </main>
</body>
</html>