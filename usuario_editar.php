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
    
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/menu.css">
    <link rel="stylesheet" href="style/perfil.css">
    <link rel="stylesheet" href="style/editarUsuario.css">
</head>
<body>
    <form action="usuario_editar_post.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="id" id="id" hidden value="<?php echo $user->getId() ?>">
        <input type="text" name="form" id="form" hidden value="1">
        <div class="popUp">
            <div id="pu">
                <p>Apenas imagens png e jpg</p>
                <input type="file" name="fotoPerfil" id="fotoPerfil" accept="image/png,jpg" class="form-control" >
                <div id="ta">
                    <a id="cancelar">Cancelar</a>
                    <button type="submit" id="salvar">Salvar</button>
                </div>
            </div>
        </div>
    </form>
    <?php include_once("include/menu.php") ?>
    <main>
        
        <form action="usuario_editar_post.php" method="POST">
            <input type="text" name="id" id="id" hidden value="<?php echo $user->getId() ?>">
            <input type="text" name="form" id="form" hidden value="2">
            <div class="hedPerfil">
                <div class="ftName">
                    <div class="foto">
                        <?php if($user->getFotoPerfil() != null){
                            $codigo_base64 = $user->getFotoPerfil();
                            $imagem = base64_decode($codigo_base64);
                            echo '<img onclick="popUpFoto()" src="data:image/png;base64,' . $codigo_base64 . '" alt="Minha Imagem"   class="img-thumbnail  justify-content-center align-items-center ftPerfil"  >';
                        }else { ?>
                            <img src="img/perfil.png" onclick="popUpFoto()" alt="" class="fotoPerfil">
                        <?php } ?>
                    </div>
                    <p class="nome"><?php echo $user->getNome()?></p>
                        <p class="sobrenome"><?php echo $user->getSobrenome()?></p>
                </div>
                <div>
                    <button class="voltar"><a href="usuario_perfil.php?id=<?php echo $user->getId() ?>">Voltar</a></button>
                    <?php if($user->getId() ===  $userLogado->getId()){ ?>
                        <button type="submit" class="salvar">Salvar</button>
                    <?php } ?>
                </div>
            </div>
            <div class="usN">
                <div class="dados">
                    <label for="username">Username:</label>
                    <input type="text" name="username" required id="username" value="<?php echo $user->getUsername(); ?>">
                </div>
                <div class="dados">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" required value="<?php echo $user->getNome(); ?>" maxlength="100">
                </div>
                    <div class="dados">
                        <label for="sobrenome">Sobrenome:</label>
                        <input type="text" name="sobrenome" id="sobrenome" required value="<?php echo $user->getSobrenome(); ?>" maxlength="100">
                    </div>
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
                <div class="dados">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required value="<?php echo $user->getEmail(); ?>">
                </div>
                <button class="altSenha"><a href="usuario_alterar_senha.php?id=<?php echo $user->getId() ?>">Alterar Senha</a></button>
                <div class="dados">
                    <label for="nascimento">Data de Nascimento:</label>
                    <input type="text" name="dataNascimento" id="datepicker" required class="nascimento" value="<?php echo $user->getDataNascimento('d/m/Y'); ?>">
                </div>
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
    function popUpFoto(){
      popUp = document.querySelector(".popUp")
      popUp.style.display="flex"
      const cancelar = document.querySelector("#cancelar")
      const input = document.querySelector("#fotoPerfil")
      cancelar.addEventListener("click", function(){
          closePopup()
      })
    }

    function closePopup(){
        popUp.style.display="none"
    }

</script>
</body>
</html>