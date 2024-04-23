<?php

class Comentario{
    private $id;
    private $comentario;
    private $comentario_id;
    private $postagem_id;
    private $usuario_id;
    private $data_inclusao;

    public function getId(){
        return $this->id;
    
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getComentario(){
        return $this->comentario;
    
    }

    public function setComentario($comentario){
        $this->comentario = $comentario;
    }

    public function getComentarioId(){
        return $this->comentario_id;
    
    }

    public function setComentarioId($comentario_id){
        $this->id = $comentario_id;
    }

    public function getPostagemId(){
        return $this->postagem_id;
    
    }

    public function setPostagemId($postagem_id){
        $this->id = $postagem_id;
    }

    public function getUsuarioId(){
        return $this->usuario_id;
    
    }

    public function setUsuarioId($usuario_id){
        $this->id = $usuario_id;
    }

    public function getDataInclusao(){
        return $this->data_inclusao;
    }

    public function setDataInclusao($data_inclusao){
        $this->data_inclusao = $data_inclusao;
    }

}