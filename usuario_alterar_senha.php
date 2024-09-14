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
    <title>Alterar Senha</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/menu.css">
    <link rel="stylesheet" href="style/editarUsuario.css">
    <link rel="stylesheet" href="style/perfil.css">
</head>
<body>
    <?php include_once("include/menu.php") ?>
    <main>
        <button class="voltar"><a href="usuario_editar.php?id=<?php echo $user->getId()?>">Voltar</a></button>
        <form action="usuario_alterar_senha_post.php" method="POST" class="form">
            <div class="pass">
                <div class="passBlock">
                    <label for="senha">Senha</label> <br>
                    <input type="password" name="senha" id="senha" required class="senha">
                </div>
                <div class="passBlock">
                    <label for="repSenha">Repita a Senha</label> <br>
                    <input type="password" name="repSenha" id="repSenha" required class="senha">
                </div>
            </div>
            <input type="text" name="id" id="id" hidden value="<?php echo $user->getId() ?>">
            <button type="submit" class="salvar" id="savePass">Salvar</button>
        </form>
    </main>
</body>
</html>