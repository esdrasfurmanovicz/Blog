<?php
class UsuarioRepository implements Repository{
    public static function listAll(){
        $db = DB::getInstance();
        $sql = "SELECT * FROM usuario";
        $query = $db->prepare($sql);
        $query->execute();

        $list = array();
        foreach($query->fetchAll(PDO::FETCH_OBJ) as  $row){
            $usuario = new Usuario;
            $usuario->setId($row->id);
            $usuario->setPerfil($row->perfil);
            $usuario->setUsername($row->username);
            $usuario->setNome($row->nome);
            $usuario->setSobrenome($row->sobrenome);
            $usuario->setEmail($row->email);
            $usuario->setSenha($row->senha);
            $usuario->setDataNascimento($row->data_nascimento);
            $usuario->setBiografia($row->biografia);
            $usuario->setFotoPerfil($row->foto_perfil);
            $usuario->setDataInclusao($row->data_inclusao);
            $usuario->setDataAlteracao($row->data_alteracao);
            $list[] = $usuario;
        }
        return $list;
    }
    public static function insert($obj){
        $db = DB::getInstance() ;
        $sql = "INSERT INTO usuario (perfil, nome, sobrenome, username, senha, email, data_inclusao, data_nascimento) VALUES(:perfil, :nome, :sobrenome, :username, :senha, :email, :data_inclusao, :data_nascimento)";

        $query = $db->prepare($sql);
        $query->bindValue(":nome",$obj->getNome()); 
        $query->bindValue(":sobrenome",$obj->getSobrenome()); 
        $query->bindValue(":perfil",$obj->getPerfil()); 
        $query->bindValue(":username",$obj->getUsername());
        $query->bindValue(":senha",$obj->getSenha());
        $query->bindValue(":email",$obj->getEmail());
        $query->bindValue(":data_inclusao",$obj->getDataInclusao());
        $query->bindValue(":data_nascimento",$obj->getDataNascimento());
        $query->execute();
        $id = $db->lastInsertId();//recupera o último Id inserido no BD.
        return $id;
    }
    public static function get($id){
        $db = DB::getInstance();
        $sql = "SELECT * FROM usuario WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindParam(":id",$id);
        $query->execute();

        $list = array();
        foreach($query->fetchAll(PDO::FETCH_OBJ) as  $row){
            $usuario = new Usuario;
            $usuario->setId($row->id);
            $usuario->setPerfil($row->perfil);
            $usuario->setUsername($row->username);
            $usuario->setNome($row->nome);
            $usuario->setSobrenome($row->sobrenome);
            $usuario->setEmail($row->email);
            $usuario->setSenha($row->senha,true);
            $usuario->setDataNascimento($row->data_nascimento);
            $usuario->setBiografia($row->biografia);
            $usuario->setFotoPerfil($row->foto_perfil);
            $usuario->setDataInclusao($row->data_inclusao);
            $usuario->setDataAlteracao($row->data_alteracao);
            return $usuario;
        }
        return null;
    }
    public static function getByEmail($email){
        $db = DB::getInstance();
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $query = $db->prepare($sql);
        $query->bindParam(":email",$email);
        $query->execute();

        $list = array();
        foreach($query->fetchAll(PDO::FETCH_OBJ) as  $row){
            $usuario = new Usuario;
            $usuario->setId($row->id);
            $usuario->setPerfil($row->perfil);
            $usuario->setUsername($row->username);
            $usuario->setNome($row->nome);
            $usuario->setSobrenome($row->sobrenome);
            $usuario->setEmail($row->email);
            $usuario->setSenha($row->senha,true);
            $usuario->setDataNascimento($row->data_nascimento);
            $usuario->setBiografia($row->biografia);
            $usuario->setFotoPerfil($row->foto_perfil);
            $usuario->setDataInclusao($row->data_inclusao);
            $usuario->setDataAlteracao($row->data_alteracao);
            return $usuario;
        }
        return null;
    }
    public static function update($obj){
        $db = DB::getInstance();
        $sql = "UPDATE usuario SET perfil = :perfil, username = :username, senha = :senha, email = :email, biografia = :biografia, foto_perfil = :foto_perfil, data_alteracao = :data_alteracao, data_nascimento = :data_nascimento WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(":perfil",$obj->getPerfil()); 
        $query->bindValue(":username",$obj->getUsername());
        $query->bindValue(":senha",$obj->getSenha());
        $query->bindValue(":email",$obj->getEmail());
        $query->bindValue(":biografia",$obj->getBiografia());
        $query->bindValue(":foto_perfil",$obj->getFotoPerfil());
        $query->bindValue(":data_alteracao",$obj->getDataAlteracao());
        $query->bindValue(":data_nascimento",$obj->getDataNascimento());
        $query->bindValue(":id",$obj->getId());
        $query->execute();
    }
    public static function delete($id){
        $db = DB::getInstance();
        $sql = "DELETE FROM usuario WHERE id=:id";
        $query=$db->prepare($sql);
        $query->bindValue(":id",$id);
        $query->execute();
    }
    public static function verifyUsername($username){
        $db = DB::getInstance();

        $sql = 'SELECT count(*) FROM usuario WHERE username = :username'; 

        $query = $db->prepare($sql);
        $query->bindValue(":username",$username);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row["count(*)"];
    }
}