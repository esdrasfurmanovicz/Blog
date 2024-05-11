<?php
include_once('include/factory.php');
?>
<header>
    <div class="lep">
        <h1><a href="index.php">Neriety</a></h1>
        <?php if(Auth::isAuthenticated()){ ?>
        <a href="usuario_perfil.php?id=<?php $user = Auth::getUser(); echo $user->getId() ?>" class="perfil"><img src="img/perfilMenu.png" alt=""></a>
        <?php } ?>
    </div>
    
    <div class="lep">
        <?php if(!Auth::isAuthenticated()){ ?>
            <a href="login.php" class="entrar">Entrar</a>
        <?php } ?>
        <?php if(Auth::isAuthenticated()){ ?>
            <a href="logout.php" class="sair">Sair</a>
        <?php } ?>
    </div>
</header>