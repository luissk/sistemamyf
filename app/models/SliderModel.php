<?php
class SliderModel{
    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    public function getSlider($idslider = null){
        if($idslider == null){
            $this->db->query("select * from slider");
            return $this->db->rows();
        }else{
            $this->db->query("select * from slider where idslider=:idslider");
            $this->db->bind(":idslider", $idslider);
            return $this->db->row();
        }        
    }

    public function saveSlider($caption, $text, $imagen){
        $query = "insert into slider(caption, text, imagen) values(:caption, :text, :imagen)";
        $this->db->query($query);
        $this->db->bind(":caption", $caption);
        $this->db->bind(":text", $text);
        $this->db->bind(":imagen", $imagen);

        return $this->db->execute();
    }

    public function updateSlider($caption, $text, $imagen, $idslider){
        $query = "update slider set caption=:caption, text=:text, imagen=:imagen where idslider=:idslider";
        $this->db->query($query);
        $this->db->bind(":caption", $caption);
        $this->db->bind(":text", $text);
        $this->db->bind(":imagen", $imagen);
        $this->db->bind(":idslider", $idslider);

        return $this->db->execute();
    }

    public function deleteSlider($idslider){
        $query = "delete from slider where idslider=:idslider";
        $this->db->query($query);
        $this->db->bind(":idslider", $idslider);

        return $this->db->execute();
    }

}