<?php

class Auth{
    private static $expires_time = 60000;
    public static function login($email, $senha){
        $usuario = UsuarioRepository::getByEmail($email);
        if($usuario){
            if($usuario->checkSenha($senha)){
                $_SESSION['is_authenticated'] = true;
                $_SESSION['usuario_id'] = $usuario->getId();
                $_SESSION['auth_expires_at'] = time() + self::$expires_time;
                return "Autenticado com sucesso";
            }
        return "Senha invalida - Tente Novamente";
        }
    return "Login não encontrado";
    }

    public static function logout(){
        unset($_SESSION['is_authenticated']);
        unset($_SESSION['usuario_id']);
        unset($_SESSION['auth_expires_at']);
    }

    public static function isAuthenticated(){
        if(isset($_SESSION['is_authenticated'])){
            if($_SESSION['is_authenticated']){
                if($_SESSION['is_authenticated'] >= time()){
                    $_SESSION['auth_expires_at'] = time() + self::$expires_time;

                    return true;
                }
            }
        }
        self::logout();
        return false;
    }

    public static function getUser(){
        if(self::isAuthenticated()){
            return  UsuarioRepository::get($_SESSION['usuario_id']);

        }
        return null;
    }
}