<?php
class PostagemRepository implements Repository{
    public static function listAll(){
        $db = DB::getInstance();
        $sql = "SELECT * FROM postagem";
        $query = $db->prepare($sql);
        $query->execute();

        $list = array(); 
        foreach($query->fetchAll(PDO::FETCH_OBJ) as  $row){
            $postagem = new postagem;
            $postagem->setId($row->id);
            $postagem->setTitulo($row->titulo);
            $postagem->setConteudo($row->conteudo);
            $postagem->setKeywords($row->keywords);
            $postagem->setInclusaoUsuarioId($row->inclusao_usuario_id);
            $postagem->setAlteracaoUsuarioId($row->alteracao_usuario_id);
            $postagem->setDataInclusao($row->data_inclusao);
            $postagem->setDataAlteracao($row->data_alteracao);
            $list[] = $postagem;
        }
        return $list;
    }

    public static function listAllByAutor($id){
        $db = DB::getInstance();
        $sql = "SELECT * FROM postagem where id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(":id", $id);
        $query->execute();

        $list = array(); 
        foreach($query->fetchAll(PDO::FETCH_OBJ) as  $row){
            $postagem = new postagem;
            $postagem->setId($row->id);
            $postagem->setTitulo($row->titulo);
            $postagem->setConteudo($row->conteudo);
            $postagem->setKeywords($row->keywords);
            $postagem->setInclusaoUsuarioId($row->inclusao_usuario_id);
            $postagem->setAlteracaoUsuarioId($row->alteracao_usuario_id);
            $postagem->setDataInclusao($row->data_inclusao);
            $postagem->setDataAlteracao($row->data_alteracao);
            $list[] = $postagem;
        }
        return $list;
    }
    public static function insert($obj){
        $db = DB::getInstance() ;//cria uma instancia da classe db (conexão com o bd).]
        $sql = "INSERT INTO postagem (titulo, conteudo, keywords, inclusao_usuario_id, data_inclusao) VALUES(:titulo, :conteudo, :keywords, :inclusao_usuario_id , :data_inclusao)";

        $query = $db->prepare($sql);//prepara a query para ser executada.
        $query->bindValue(":titulo", $obj->getTitulo());
        $query->bindValue(":conteudo", $obj->getConteudo());
        $query->bindValue(":keywords", $obj->getKeywords());
        $query->bindValue(":inclusao_usuario_id", $obj->getInclusaoUsuarioId());
        $query->bindValue(":data_inclusao", $obj->getDataInclusao());
        $query->execute();
        $id = $db->lastInsertId();//recupera o último Id inserido no BD.
        return $id;
    }
    public static function get($id){
        $db = DB::getInstance();
        $sql = "SELECT * FROM postagem WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindParam(":id",$id);
        $query->execute();

        $list = array();
        foreach($query->fetchAll(PDO::FETCH_OBJ) as  $row){
            $postagem = new postagem;
            $postagem->setId($row->id);
            $postagem->setTitulo($row->titulo);
            $postagem->setConteudo($row->conteudo);
            $postagem->setKeywords($row->keywords);
            $postagem->setInclusaoUsuarioId($row->inclusao_usuario_id);
            $postagem->setAlteracaoUsuarioId($row->alteracao_usuario_id);
            $postagem->setDataInclusao($row->data_inclusao);
            $postagem->setDataAlteracao($row->data_alteracao);
            return $postagem;
        }
        return null;
    }
    public static function update($obj){
        $db = DB::getInstance();
        $sql = "UPDATE postagem SET titulo = :titulo, conteudo = :conteudo, keywords = :keywords, alteracao_usuario_id = :alteracao_usuario_id, data_alteracao = :data_alteracao WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(":titulo",$obj->getTitulo()); 
        $query->bindValue(":conteudo",$obj->getConteudo());
        $query->bindValue(":keywords",$obj->getKeywords());
        $query->bindValue(":alteracao_usuario_id",$obj->getAlteracaoUsuarioId());
        $query->bindValue(":data_alteracao",$obj->getDataAlteracao());
        $query->bindValue(":id",$obj->getId());
        $query->execute();
    }
    public static function delete($id){
        $db = DB::getInstance();
        $sql = "DELETE FROM postagem WHERE id=:id";
        $query=$db->prepare($sql);
        $query->bindValue(":id",$id);
        $query->execute();
    }
}