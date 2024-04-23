<?php

session_start();

include_once("db.php");
include_once('class/comentario.php');
include_once('class/postagem.php');
include_once('class/usuario.php');
include_once('class/repository/repository.php');
include_once('class/repository/comentario_repos.php');
include_once('class/repository/postagem_repos.php');
include_once('class/repository/usuario_repos.php');
include_once('class/auth.php');

class Factory{
    public static function db(){
        return DB::getInstance();
    }

    public static function comentario(){
        return new Comentario();
    }
    public static function postagem(){
        return new Postagem();
    }
    public static function usuario(){
        return new Usuario();
    }
    
}
