<?php
class Categoria extends Controlador{
    public function __construct(){
        $this->modeloCategoria = $this->model('CategoriaModel');
    }

    public function saveCategoria(){
        if(IS_AJAX){
            $categoria = trim($_POST['nCategoria']);
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $categoria)){
                $result = $this->modeloCategoria->saveCategoria($categoria);
                if($result){
                    echo true;
                }else{
                    echo false;
                }
			}
        }
    }

    public function updateCategoria(){
        if(IS_AJAX){
            $categoria   = trim($_POST['nCategoriaE']);
            $idcategoria = $_POST['idCategoriaE'];
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $categoria)){
                $result = $this->modeloCategoria->updateCategoria($categoria,$idcategoria);
                if($result){
                    echo true;
                }else{
                    echo false;
                }
			}
        }
    }

    public function deleteCategoria(){
        if(IS_AJAX){
            $idcategoria = $_POST['idcategoria'];
            $fila = $this->modeloCategoria->existsEnProducto($idcategoria);
            if( $fila['total'] > 0 ){
                echo $fila['total'];
            }else{
                $result = $this->modeloCategoria->deleteCategoria($idcategoria);
                if($result){
                    echo "borrado";
                }else{
                    echo "error";
                }
            }            
        }
    }
}