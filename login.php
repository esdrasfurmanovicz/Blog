<?php
    include_once("include/factory.php");
    if(Auth::isAuthenticated()){
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <main>
        <div class="container">
            <div class="areaLogin">
                <div>
                    <h1>Bem vindo ao Neriety</h1>
                    <form action="logar.php" method="post">
                        <div class="input-group">
                            <label for="email">E-mail: </label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="input-group">
                            <label for="senha">Senha: </label>
                            <input type="text" id="senha" name="senha" required>
                        </div>
                        <button type="submit" class="btn">Entrar</button>
                        <p class="textCad">Ainda não tem uma conta? <strong class="strCad">Cadastre-se</strong></p>
                    </form>
                </div>
            </div>
            <div class="areaConvert">
            
            </div>
        </div>
    </main>
</body>
</html>