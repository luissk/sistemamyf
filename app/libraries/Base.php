<?php
class Base{
    private $host   = DB_HOST;
    private $user   = DB_USER;
    private $pass   = DB_PASS;
    private $bdname = DB_NAME;

    private $dbhandler;
    private $stmt;
    private $error;

    public function __construct(){
        //configurar conexion
        $dns = 'mysql:host='.$this->host.';dbname='.$this->bdname;
        $opciones = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->dbhandler = new PDO($dns, $this->user, $this->pass, $opciones);
            $this->dbhandler->exec('set names utf8');
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query($sql){
        $this->stmt = $this->dbhandler->prepare($sql);
    }

    public function lastId(){
        return $this->dbhandler->lastInsertId();
    }

    public function bind($parametro, $valor, $tipo = null){
        if(is_null($tipo)){
            switch(true){
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                break;
                case is_string($valor):
                    $tipo = PDO::PARAM_STR;
                break;
                default:
                    $tipo = PDO::PARAM_NULL;
                break;                
            }
            $this->stmt->bindValue($parametro, $valor, $tipo);
        }
    }

    public function execute(){
        return $this->stmt->execute();
    }

    public function rows(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function row(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countRows(){
        $this->execute();
        return $this->stmt->rowCount();
    }
}