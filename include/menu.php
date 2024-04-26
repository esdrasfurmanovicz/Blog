
<header>
    <div class="lep">
        <h1><a href="index.php">Neriety</a></h1>
        <a href="usuario_perfil.php?id=<?php $user = Auth::getUser(); echo $user->getId() ?>" class="perfil"><img src="img/perfilMenu.png" alt=""></a>
    </div>
    
    <div class="lep">
        <a href="logout.php" class="sair">Sair</a>
    </div>
</header>