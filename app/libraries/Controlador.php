<?php 
class Controlador{
    //cargar modelo
    public function model($modelo){
        require_once '../app/models/'.$modelo.'.php';
        return new $modelo();
    }

    //cargar vista
    public function view($vista, $datos = []){
        //verificar si la vista existe
        if(file_exists('../app/views/'.$vista.'.php')){
            require_once '../app/views/'.$vista.'.php';
        }else{
            die('La vista no existe');
        }
    }

    //mis helpers
    public function helper($helper){
        require_once '../app/helpers/'.$helper.'.php';
        return new $helper();
    }
}