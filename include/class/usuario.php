<?php
    class Usuario{
        private $id;
        private $perfil;
        private $username;
        private $email;
        private $senha;
        private $nome;
        private $sobrenome; 
        private $data_nascimento;
        private $biografia;
        private $foto_perfil;
        private $data_inclusao;
        private $data_alteracao;
    

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getPerfil(){
        return $this->perfil;
    }

    public function setPerfil($perfil){
        $this->perfil = $perfil;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($senha, $is_hashed = false){
        if($is_hashed){
            $this->senha = $senha;
        } else{
            $this->senha = hash("sha256",$senha);
        }
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getSobrenome(){
        return $this->sobrenome;
    }

    public function setSobrenome($sobrenome){
        $this->sobrenome = $sobrenome;
    }

    public function getDataNascimento($format = 'Y-m-d'){
        $datetime = DateTime::createFromFormat('Y-m-d', $this->data_nascimento);
        return $datetime->format($format);
    }

    public function setDataNascimento($data_nascimento){
        $this->data_nascimento = $data_nascimento;
    }

    public function getBiografia(){
        return $this->biografia;
    }

    public function setBiografia($biografia){
        $this->biografia = $biografia;
    }

    public function getFotoPerfil(){
        return $this->foto_perfil;
    }

    public function setFotoPerfil($foto_perfil){
        $this->foto_perfil = $foto_perfil;
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
    public function checkSenha($senha){
        $senha = hash('sha256',$senha);
        if($senha == $this->senha){
            return true;
        }
        return false;
    }
}