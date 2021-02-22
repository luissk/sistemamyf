<?php
class CategoriaModel{
    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    public function getCategorias($idcategoria = null){
        if($idcategoria == null){
            $this->db->query("select idcategoria,categoria from categoria");
            return $this->db->rows();
        }else{
            $this->db->query("select idcategoria,categoria from categoria where idcategoria=:idcategoria");
            $this->db->bind(":idcategoria", $idcategoria);
            return $this->db->row();
        }        
    }

    public function saveCategoria($categoria){
        $this->db->query("insert into categoria(categoria) values(:categoria)");
        $this->db->bind(":categoria", $categoria);
        return $this->db->execute();
    }

    public function updateCategoria($categoria,$idcategoria){
        $this->db->query("update categoria set categoria=:categoria where idcategoria=:idcategoria");
        $this->db->bind(":categoria", $categoria);
        $this->db->bind(":idcategoria", $idcategoria);
        return $this->db->execute();
    }

    public function deleteCategoria($idcategoria){
        $this->db->query("delete from categoria where idcategoria=:idcategoria");
        $this->db->bind(":idcategoria", $idcategoria);
        return $this->db->execute();
    }

    public function existsEnProducto($idcategoria){
        $query = "select count(idcategoria) total from producto where idcategoria=:idcategoria";
        $this->db->query($query);
        $this->db->bind(":idcategoria", $idcategoria);
        return $this->db->row();
    }
}