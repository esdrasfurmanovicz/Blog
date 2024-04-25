<?php
class ComentarioRepository implements Repository{
    public static function listAll(){
        $db = DB::getInstance();
        $sql = "SELECT * FROM comentario";
        $query = $db->prepare($sql);
        $query->execute();

        $list = array();
        foreach($query->fetchAll(PDO::FETCH_OBJ) as  $row){
            $comentario = new comentario;
            $comentario->setId($row->id);
            $comentario->setComentario($row->comentario);
            $comentario->setComentarioId($row->comentario_id);
            $comentario->setPostagemId($row->postagem_id);
            $comentario->setUsuarioId($row->usuario_id);
            $comentario->setDataInclusao($row->data_inclusao);
            $list[] = $comentario;
        }
        return $list;
    }
    public static function insert($obj){
        $db = DB::getInstance() ;//cria uma instancia da classe db (conexão com o bd).]
        $sql = "INSERT INTO comentario (comentario, comentario_id, postagem_id, usuario_id, data_inclusao) VALUES(:comentario, :comentario_id, :postagem_id, :usuario_id , :data_inclusao)";

        $query = $db->prepare($sql);//prepara a query para ser executada.
        $query->bindValue(":comentario", $obj->getComentario());
        $query->bindValue(":comentario_id", $obj->getComentarioId());
        $query->bindValue(":postagem_id", $obj->getPostagemId());
        $query->bindValue(":usuario_id", $obj->getUsuarioId());
        $query->bindValue(":data_inclusao", $obj->getDataInclusao());
        $query->execute();
        $id = $db->lastInsertId();//recupera o último Id inserido no BD.
        return $id;
    }
    public static function get($id){
        $db = DB::getInstance();
        $sql = "SELECT * FROM comentario WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindParam(":id",$id);
        $query->execute();

        $list = array();
        foreach($query->fetchAll(PDO::FETCH_OBJ) as  $row){
            $comentario = new comentario;
            $comentario->setId($row->id);
            $comentario->setComentario($row->comentario);
            $comentario->setComentarioId($row->comentario_id);
            $comentario->setPostagemId($row->postagem_id);
            $comentario->setUsuarioId($row->usuario_id);
            $comentario->setDataInclusao($row->data_inclusao);
            return $comentario;
        }
        return null;
    }   
    public static function update($obj){
        // vazio, comentario não pode ser excluido
    }
    public static function delete($id){
        // vazio, comentario não pode ser editado
    }
}