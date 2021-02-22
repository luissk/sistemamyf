<?php
class UsuarioModel{
    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    public function validaUsuario($email){
        $this->db->query("select * from usuario where email=:email");
        $this->db->bind(":email", $email);
        return $this->db->row();
    }
}