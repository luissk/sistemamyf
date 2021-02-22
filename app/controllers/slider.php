<?php
class Slider extends Controlador{
    public function __construct(){
        $this->modeloSlider   = $this->model('SliderModel');

        $this->helperProducto = $this->helper('ProductoHelper');
    }

    public function saveSlider(){
        if(IS_AJAX){
            $caption = trim($_POST['caption']);
            $text    = trim($_POST['text']);

            $imagen = '';
            
            if($caption != '' && $text != ''){
                $aleatorio = $this->helperProducto->randomString();
                if(isset($_FILES["slide"]["tmp_name"])){
                    $directorio = "img/carousel";                    
                    if($_FILES["slide"]["type"] == "image/jpeg"){
                        $imagen = "$directorio/$aleatorio.jpg";
                        move_uploaded_file($_FILES["slide"]["tmp_name"], $imagen);
                    }else if($_FILES["slide"]["type"] == "image/png"){
                        $imagen = "$directorio/$aleatorio.png";
                        move_uploaded_file($_FILES["slide"]["tmp_name"], $imagen);
                    }
                    
                    if($this->modeloSlider->saveSlider($caption, $text, basename($imagen))){
                        echo "ok";
                    }
                }
            }else{
                echo 'revisar';
            }
        }
    }

    public function updateSlider(){
        if(IS_AJAX){
            $caption    = trim($_POST['captione']);
            $text       = trim($_POST['texte']);
            $imagen_ant = $_POST['imagen_anterior'];
            $idslider   = $_POST['idslider'];

            $imagen = $imagen_ant;
            if($caption != '' && $text != ''){
                $aleatorio = $this->helperProducto->randomString();
                if(isset($_FILES["slidee"]["tmp_name"]) && $_FILES["slidee"]["error"] == 0){
                    $directorio = "img/carousel";
                    
                    if(file_exists("$directorio/$imagen_ant")){
						unlink("$directorio/$imagen_ant");
					}
                    
                    if($_FILES["slidee"]["type"] == "image/jpeg"){
                        $imagen = "$directorio/$aleatorio.jpg";
                        move_uploaded_file($_FILES["slidee"]["tmp_name"], $imagen);
                    }else if($_FILES["slide"]["type"] == "image/png"){
                        $imagen = "$directorio/$aleatorio.png";
                        move_uploaded_file($_FILES["slidee"]["tmp_name"], $imagen);
                    }
                    $imagen = basename($imagen);
                }
                if($this->modeloSlider->updateSlider($caption, $text, $imagen, $idslider)){
                    echo "ok";
                }
            }else{
                echo 'revisar';
            }
        }
    }

    public function deleteSlider(){
        if(IS_AJAX){
            $idslider   = $_POST['idslider'];
            $slider = $this->modeloSlider->getSlider($idslider);
            if($slider){
                print_r($_POST);
                $imagen = $slider['imagen'];
                $directorio = "img/carousel";
                if(file_exists("$directorio/$imagen")){
                    unlink("$directorio/$imagen");
                }
                if($this->modeloSlider->deleteSlider($idslider)){
                    return true;
                }
            }
        }
    }

}