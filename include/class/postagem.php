<?php 

class Postagem{
    private $id;
    private $titulo;
    private $conteudo;
    private $keywords;
    private $data_inclusao;
    private $data_alteracao;
    private $inclusao_usuario_id;
    private $alteracao_usuario_id;

    public function getId(){
        return $this->id;
    
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTitulo(){
        return $this->titulo;
    
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function getConteudo(){
        return $this->conteudo;
    
    }

    public function setConteudo($conteudo){
        $this->conteudo = $conteudo;
    }

    public function getkeywords(){
        return $this->keywords;
    
    }

    public function setkeywords($keywords){
        $this->keywords = $keywords;
    }

    public function getDataInclusao(){
        return $this->data_inclusao;
    }

    public function setDataInclusao($data_inclusao){
        $this->data_inclusao = $data_inclusao;
    }

    public function getDataAlteracao(){
        return $this->data_alteracao;
    }

    public function setDataAlteracao($data_alteracao){
        $this->data_alteracao = $data_alteracao;
    }

    public function getInclusaoUsuarioId(){
        return $this->inclusao_usuario_id;
    
    }

    public function setInclusaoUsuarioId($inclusao_usuario_id){
        $this->id = $inclusao_usuario_id;
    }

    public function getAlteracaoUsuarioId(){
        return $this->alteracao_usuario_id;
    
    }

    public function setAlteracaoUsuarioId($alteracao_usuario_id){
        $this->id = $alteracao_usuario_id;
    }

}