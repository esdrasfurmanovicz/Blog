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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/menu.css">
    <link rel="stylesheet" href="style/perfil.css">
    <link rel="stylesheet" href="style/editarUsuario.css">
</head>
<body>
    <?php include_once("include/menu.php") ?>
    <main>
        
        <form action="usuario_editar_post.php" method="POST">
            <input type="text" name="id" id="id" hidden value="<?php echo $user->getId() ?>">
            <div class="hedPerfil">
                <div class="ftName">
                    <img src="img/perfil.png" alt="" class="fotoPerfil">
                    <p class="nome"><?php echo $user->getNome() ?></p>
                    <p class="sobrenome"><?php echo $user->getSobrenome() ?></p>
                </div>
                <div>
                    <button class="voltar"><a href="usuario_perfil.php?id=<?php echo $user->getId() ?>">Voltar</a></button>
                    <?php if($user->getId() ===  $userLogado->getId()){ ?>
                        <button type="submit" class="salvar">Salvar</button>
                    <?php } ?>
                </div>
            </div>
            <div class="usN">
                <input type="text" name="username" required id="username" value="<?php echo $user->getUsername(); ?>">
                
                <?php if($user->getPerfil() === "adm" && $user->getId() != $userLogado->getId()){ ?>
                    <select name="perfil" id="perfil">
                        <option value="adm">Administrador</option>
                        <option value="regular">Usuario Regular</option>
                        <option value="autor">Autor</option>
                    </select>
                <?php } ?>
            </div>
            <div class="bioPerfil">
                <h3>Biografia</h3>
                <br>
                <textarea name="biografia" class="bio" rows="8" maxlength="500"><?php echo $user->getBiografia() ?></textarea>
            </div>
            <div class="outrosCampos">
                <input type="email" name="email" id="email" required value="<?php echo $user->getEmail(); ?>">
                <button class="altSenha"><a href="usuario_alterar_senha.php?id=<?php echo $user->getId() ?>">Alterar Senha</a></button>
                <input type="text" name="dataNascimento" id="datepicker" required class="nascimento" value="<?php echo $user->getDataNascimento('d/m/Y'); ?>">
            </div>
        </form>
    </main>
    
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script>
    
    $(document).ready(function(){
        $('.nascimento').mask('00/00/0000');
        
    })

</script>
</body>
</html>